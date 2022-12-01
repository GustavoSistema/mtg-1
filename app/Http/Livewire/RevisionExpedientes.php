<?php

namespace App\Http\Livewire;

use App\Models\Expediente;
use App\Models\Imagen;
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
    public $files=[];    
    public $idus,$expediente,$identificador,$tipoServicio;
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
    ];

   public function loadExpedientes(){
    $this->readyToLoad=true;
    }

    public function mount(){
        $this->idus=Auth::id();
        $this->identitifcador=rand();        
        $this->expediente= new Expediente();
        $this->cant="10";                       
        
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
   

    public function edit(Expediente $expediente){        
        if($expediente->id!=null){
            $this->expediente=$expediente;  
            $s=Servicio::find($expediente->servicio_idservicio);
            $ts=TipoServicio::find($s->tipoServicio_idtipoServicio);
            $this->tipoServicio=$ts->descripcion;               
            $this->files=Imagen::where('Expediente_idExpediente','=',$expediente->id)->whereIn('extension',['jpg','jpeg','png','gif','tif','tiff','bmp'])->get();
            $this->documentos=Imagen::where('Expediente_idExpediente','=',$expediente->id)->whereIn('extension',['pdf','xlsx','xls','docx','doc'])->get();
            $this->identificador=rand();
            $this->editando=true;
        }
    }

    public function actualizar(){        
        
        $this->validate();    
        $this->expediente->save();       
        $this->editando=false;        
        $this->emit('alert','El expediente se actualizo correctamente');
        //$this->reset(['expediente']);   
        $this->identificador=rand();
    }

    public function download($ruta){   
        // emit an event with the path        
        $this->emit('startDownload',$ruta);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }  

    
    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function updatingEditando(){        
             
    }
}