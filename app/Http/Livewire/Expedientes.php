<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Expediente;
use App\Models\ExpedienteObservacion;
use App\Models\Imagen;
use App\Models\Observacion;
use App\Models\Taller;
use App\Models\User;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Expedientes extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $observaciones=[];
    public $talleres=[];
    public $fotosnuevas=[];
    public $documentosnuevos=[];
    public $files=[];
    public $documentos=[];
    public $servicios=[];
    public $idus,$expediente,$identificador,$tallerSeleccionado,$servicioSeleccionado,$es;
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
        'search'=>['except'=>''],
        'es'=>['except'=>''],
   ];

   protected $rules=[
        'expediente.placa'=>'required|min:6|max:6',
        'expediente.certificado'=>'required|min:1|max:7',       
        'fotosnuevas'=>'array|max:10',
        'documentosnuevos'=>'array|max:10',
        'tallerSeleccionado'=>'required',
        'servicioSeleccionado'=>'required',        
    ];

   public function loadExpedientes(){
    $this->readyToLoad=true;
    }

    public function listaServicios(){
        if($this->tallerSeleccionado != null){
            $this->servicios=json_decode(DB::table('servicio')
            ->select('servicio.*','tiposervicio.descripcion')
            ->join('tiposervicio','servicio.tipoServicio_idtipoServicio','=','tiposervicio.id')
            ->where('taller_idtaller',$this->tallerSeleccionado)
            ->get(),true);             
        }
    }

    public function mount(){
        $this->idus=Auth::id();
        $this->identitifcador=rand();        
        $this->expediente= new Expediente();
        $this->cant="10";
        $this->talleres=Taller::all(); 
        $user=User::find($this->idus);
        /*                
        $this->servicios= json_decode(DB::table('servicio')
        ->select('servicio.*','tiposervicio.descripcion')
        ->join('tiposervicio','servicio.tipoServicio_idtipoServicio','=','tiposervicio.id')
        ->where('taller_idtaller',$user->taller_idtaller)
        ->get(),true); 
        */
    }




    public function render()
    {
        $filtros1=[['expedientes.placa','like','%'.$this->search.'%'],['expedientes.usuario_idusuario', '=', Auth::id()]];  
        $filtros2=[['expedientes.certificado','like','%'.$this->search.'%'],['expedientes.usuario_idusuario', '=', Auth::id()],];  
        if($this->es!=null){
           array_push($filtros1,['expedientes.estado','like','%'.$this->es.'%']);
           array_push($filtros2,['expedientes.estado','like','%'.$this->es.'%']);
        }

        if($this->readyToLoad){            
            $expedientes= DB::table('expedientes') 
            ->select('expedientes.*', 'tiposervicio.descripcion')             
            ->join('servicio', 'expedientes.servicio_idservicio', '=', 'servicio.id')
            ->join('tiposervicio', 'tiposervicio.id', '=', 'servicio.tipoServicio_idtipoServicio')           
            ->where($filtros1)
            ->orWhere($filtros2)           
            ->orderBy($this->sort,$this->direction)
            ->paginate($this->cant);                 
        }else{
            $expedientes=[];
        }

        return view('livewire.expedientes',compact('expedientes'));
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
            $this->reset(['observaciones']);  
            foreach($nobs as $n){
                $ob=Observacion::find($n->idObservacion);
                array_push($this->observaciones,$ob);
            } 
        }else{
            $this->reset(['observaciones']);   
            
        }                
    }

   

    public function edit(Expediente $expediente){        
        if($expediente->id!=null){
            $this->expediente=$expediente;           
            $this->files=Imagen::where('Expediente_idExpediente','=',$expediente->id)->whereIn('extension',['jpg','jpeg','png','gif','tif','tiff','bmp'])->get();
            $this->documentos=Imagen::where('Expediente_idExpediente','=',$expediente->id)->whereIn('extension',['pdf','xlsx','xls','docx','doc'])->get();
            $this->identificador=rand();
            $this->tallerSeleccionado=$expediente->idTaller;
            $this->listaServicios();
            $this->servicioSeleccionado=$expediente->servicio_idservicio;   
            $this->cargaObservaciones($expediente);       
            $this->editando=true;
        }
    }

    public function actualizar(){       
        
        $this->validate();        

        foreach($this->fotosnuevas as $file){
            $file_save= new imagen();
            $file_save->nombre=$this->expediente->placa;
            $file_save->extension=$file->extension();
            $file_save->ruta = $file->store('public/expedientes');
            $file_save->Expediente_idExpediente=$this->expediente->id;
            Imagen::create([
                'nombre'=>$file_save->nombre,
                'ruta'=>$file_save->ruta,
                'extension'=>$file_save->extension,
                'Expediente_idExpediente'=>$file_save->Expediente_idExpediente,
            ]);
        }

        foreach($this->documentosnuevos as $file){
            $file_save= new imagen();
            $file_save->nombre=$this->expediente->placa;
            $file_save->extension=$file->extension();
            $file_save->ruta = $file->store('public/expedientes');
            $file_save->Expediente_idExpediente=$this->expediente->id;
            Imagen::create([
                'nombre'=>$file_save->nombre,
                'ruta'=>$file_save->ruta,
                'extension'=>$file_save->extension,
                'Expediente_idExpediente'=>$file_save->Expediente_idExpediente,
            ]);
        }
        $this->expediente->idTaller=$this->tallerSeleccionado;

        $this->expediente->estado=1;

        $this->expediente->servicio_idservicio=$this->servicioSeleccionado;

        $this->expediente->save();        
        
        $this->reset(['editando','expediente','documentosnuevos','fotosnuevas']);        
        
        $this->emit('alert','El expediente se actualizo correctamente');

        $this->identificador=rand();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function delete(Expediente $expediente){
        $imgs=Imagen::where('Expediente_idExpediente','=',$expediente->id)->get();
        foreach($imgs as $img ){
            Storage::delete($img->ruta);
        }
        $expediente->delete();        
        $this->emitTo('expedientes','render');
        $this->identificador=rand();
        $this->resetPage();
    }

    public function deleteFile(Imagen $file){
        Storage::delete([$file->ruta]);
        $file->delete();        
        $this->emitTo('expedientes','render');
        $this->identificador=rand();
        $this->resetPage();
    }

    public function deleteFileUpload($id){
        unset($this->otros[$id]);
    }

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function updatingEditando(){
        //$this->identificador=rand(); 
        $this->reset(['documentosnuevos','fotosnuevas']);       
    }
}
