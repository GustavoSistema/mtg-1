<?php

namespace App\Http\Livewire;

use App\Models\Expediente;
use App\Models\ExpedienteObservacion;
use App\Models\Imagen;
use App\Models\Observacion;
use App\Models\Servicio;
use App\Models\TipoServicio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RevisionExpedientes extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $documentos=[];
    public $observaciones=[
        array("id"=>1,              
              "detalle" => "Fotografias faltantes.",
              "tipo"=>1,
              "estado"=> 0),
        array("id"=>2,              
              "detalle" => "Serie de reductor no corresponde o no es visible.",
              "tipo"=>1,
              "estado" => 0),
        array("id"=>3,             
              "detalle" => "Serie de tanque no corresponde o no es visible.",
              "tipo"=>1,
              "estado" => 0),  
        array("id"=>4,              
              "detalle" => "Documentos faltantes o erroneos.",
              "tipo"=>1,
              "estado" => 0),  
    ];    
    public $observacionesEx=[];
    public $files=[];    
    public $idus,$expediente,$identificador,$tipoServicio;
    public $conteo;
    public $search="";
    public $cant="";
    public $sort="created_at";
    public $direction='desc';
    public $readyToLoad=false;
    public $editando=false;

    protected $listeners=['render','delete','deleteFile'];

    protected $queryString=[
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'created_at'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>'']
   ];

   protected $rules=[
        
        'expediente.estado'=>'required',   
        'conteo'=>'numeric|required|min:1',    
    ];


    
   public function loadExpedientes(){
    $this->readyToLoad=true;
    }

    public function mount(){
        $this->idus=Auth::id();
        $this->identitifcador=rand();        
        $this->expediente= new Expediente();
        $this->cant="10";  
        $this->conteo=0;                    
    }   

    public function agregaObservacion($id){
        if($this->observaciones[$id-1]['estado']==0){
            $this->observaciones[$id-1]['estado']=1;     
            $this->conteo++;
        }else{
            $this->observaciones[$id-1]['estado']=0;   
            $this->conteo--;        
        }        
    }

    public function creaGuardaObservaciones(){
        foreach($this->observaciones as $obs){
            if($obs['estado']==1){                   
                $ob=Observacion::create([
                    'detalle'=>$obs['detalle'],
                    'tipo'=>1,
                    'estado'=>1,
                ]);    
                ExpedienteObservacion::create([
                    'idExpediente'=>$this->expediente->id,
                    'idObservacion'=>$ob->id,
                ]);                            
            }
        }
    }



    public function render()
    {
        if($this->readyToLoad){            
            $expedientes= DB::table('expedientes') 
            ->select('expedientes.*', 'tiposervicio.descripcion','users.name','taller.nombre')             
            ->join('servicio', 'expedientes.servicio_idservicio', '=', 'servicio.id')
            ->join('tiposervicio', 'tiposervicio.id', '=', 'servicio.tipoServicio_idtipoServicio')
            ->join('users','users.id','=','expedientes.usuario_idusuario')
            ->join('taller','taller.id','=','servicio.taller_idtaller')          
            ->where('expedientes.placa','like','%'.$this->search.'%')
            ->orWhere('expedientes.certificado','like','%'.$this->search.'%')              
            ->orderBy($this->sort,$this->direction)
            ->paginate($this->cant);                            
        }else{
            $expedientes=[];
        }

        return view('livewire.revision-expedientes',compact('expedientes'));
    }

    public function order($sort)
    {
        if($this->sort=$sort){
            if($this->direction=='desc'){
                $this->direction='asc';
            }else{
                $this->direction='desc';
            }
        }else{
            $this->sort=$sort;
            $this->direction='asc';
        }        
    }

    public function cargaObservaciones(Expediente $expediente){
        $nobs=ExpedienteObservacion::where('idExpediente',$expediente->id)->get();
        if($nobs){
            $this->reset(['observacionesEx']);  
            foreach($nobs as $n){
                $ob=Observacion::find($n->idObservacion);
                array_push($this->observacionesEx,$ob);  
                $this->conteo++;              
            } 
        }else{
            $this->reset(['observacionesEx']);   
            
        }                
    }

    public function observacioneDisponibles(){
        foreach($this->observacionesEx as $exob){
            foreach($this->observaciones as $key=> $obser){
                if((string)$obser['detalle']==(string)$exob->detalle){
                    if($obser['tipo']==1){
                        $this->observaciones[$key]['tipo']=0;
                    }              
                }
            }
        }
    }


   
    public function pasaDatosExpediente(Expediente $expediente){
            $this->expediente=$expediente;  
            $s=Servicio::find($expediente->servicio_idservicio);
            $ts=TipoServicio::find($s->tipoServicio_idtipoServicio);
            $this->tipoServicio=$ts->descripcion;               
            $this->files=Imagen::where('Expediente_idExpediente','=',$expediente->id)->whereIn('extension',['jpg','jpeg','png','gif','tif','tiff','bmp'])->get();
            $this->documentos=Imagen::where('Expediente_idExpediente','=',$expediente->id)->whereIn('extension',['pdf','xlsx','xls','docx','doc'])->get();
            $this->cargaObservaciones($expediente);
            $this->reset(['observaciones']);   
            $this->observacioneDisponibles();            
            $this->identificador=rand();
    }



    public function edit(Expediente $expediente){        
        if($expediente->estado==2){
            $this->pasaDatosExpediente($expediente);
            $this->editando=true;
        }else{
            $this->pasaDatosExpediente($expediente);           
            $this->editando=true;
        }
    }

    public function actualizar(){        
        //$this->eligeObservaciones();
        $this->creaGuardaObservaciones();
        if($this->expediente->estado!=2){
            $this->conteo=1;
        } 
        
        $validatedData = $this->validate([
            'expediente.estado'=>'required',   
            'conteo'=>'numeric|required|min:1',
        ]);         
        $this->expediente->save();       
        $this->editando=false;        
        $this->emit('alert','El expediente se actualizo correctamente');
        $this->reset(['observaciones','observacionesEx','conteo']);   
        $this->conteo=0;
        $this->resetCheck();
    }

    public function deleteObservacion($id){
        $observacion=Observacion::find($id);
        $observacion->delete();
        $this->conteo--;
        $this->cargaObservaciones($this->expediente);
        $this->reset(['observaciones']);  
        $this->observacioneDisponibles();
    }

    public function download($ruta){   
        // emit an event with the path        
        $this->emit('startDownload',$ruta);
    }


    public function validaObservaciones(){
        
    }

    public function resetCheck(){
        $this->emit('quitaCheck');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }  

    
    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function updatingEditando(){        
         $this->conteo=0;    
         $this->resetCheck();
    }

    protected $messages = [
        'conteo.min' => 'Debe seleccionar por lo menos una observación',
        
    ];
    
}
