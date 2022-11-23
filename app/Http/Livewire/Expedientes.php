<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Expediente;
use App\Models\Imagen;
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

    public $otros=[];
    public $files=[];
    public $servicios=[];
    public $idus,$expediente,$identificador;
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
        'expediente.placa'=>'required|min:6|max:6',
        'expediente.certificado'=>'required|min:1|max:7',
        'expediente.servicio_idservicio'=>'required',
        'otros'=>'max:5120',         
    ];

   public function loadExpedientes(){
    $this->readyToLoad=true;
    }

    public function mount(){
        $this->idus=Auth::id();
        $this->identitifcador=rand();        
        $this->expediente= new Expediente();
        $this->cant="10";
        $user=User::find($this->idus);
                
        $this->servicios= json_decode(DB::table('servicio')
        ->select('servicio.*','tiposervicio.descripcion')
        ->join('tiposervicio','servicio.tipoServicio_idtipoServicio','=','tiposervicio.id')
        ->where('taller_idtaller',$user->taller_idtaller)
        ->get(),true);  
    }




    public function render()
    {
        if($this->readyToLoad){            
            $expedientes= DB::table('expedientes') 
            ->select('expedientes.*', 'tiposervicio.descripcion')             
            ->join('servicio', 'expedientes.servicio_idservicio', '=', 'servicio.id')
            ->join('tiposervicio', 'tiposervicio.id', '=', 'servicio.tipoServicio_idtipoServicio')           
            ->where([
                ['expedientes.placa','like','%'.$this->search.'%'],
                ['expedientes.usuario_idusuario', '=', Auth::id()],                
            ])
            ->orWhere([
                ['expedientes.certificado','like','%'.$this->search.'%'],
                ['expedientes.usuario_idusuario', '=', Auth::id()],                
            ])           
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
   

    public function edit(Expediente $expediente){        
        if($expediente->id!=null){
            $this->expediente=$expediente;           
            $this->files=Imagen::where('Expediente_idExpediente','=',$expediente->id)->get();
            $this->identificador=rand();
            $this->editando=true;
        }
    }

    public function actualizar(){
        
        
        $this->validate();        

        foreach($this->otros as $file){
            $file_save= new imagen();
            $file_save->nombre=$this->expediente->placa;
            $file_save->ruta = $file->store('public/expedientes');
            $file_save->Expediente_idExpediente=$this->expediente->id;
            Imagen::create([
                'nombre'=>$file_save->nombre,
                'ruta'=>$file_save->ruta,
                'Expediente_idExpediente'=>$file_save->Expediente_idExpediente,
            ]);
        }
        $this->expediente->estado=1;
        $this->expediente->save();

        
        
        $this->reset(['editando','expediente','otros']);        
        
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
        $this->reset(['otros']);       
    }
}
