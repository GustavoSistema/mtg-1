<?php

namespace App\Http\Livewire;

use App\Models\Expediente;
use App\Models\Imagen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CreateExpediente extends Component 
{
    use WithFileUploads;
    
    
    public function idusuario(){
        return $id=Auth::id();
    }    
    
    public $files=[];
    public $open=false;   
    public $estado=1;    
    public $placa,$certificado,$servicio,$identificador;
    
    protected $rules=[
        'placa'=>'required|min:6|max:6',
        'certificado'=>'required|min:1|max:7|unique:expedientes,certificado',
        'servicio'=>'required',
        'files'=>'required|max:5120',
    ];

    

    public function mount(){
        $this->identificador=rand();
        $this->placa=strtoupper($this->placa);
    }


    public function render()
    {
        return view('livewire.create-expediente');
    }

    

    public function save(){

        $this->validate();        

        $expe=Expediente::create([
            'placa'=> strtoupper($this->placa),
            'certificado'=>$this->certificado,            
            'estado'=>$this->estado,
            'servicio_idservicio'=>$this->servicio,
            'usuario_idusuario'=>$this->idusuario(),

        ]);

        foreach($this->files as $file){
            $file_save= new imagen();
            $file_save->nombre=$this->placa;
            $file_save->ruta = $file->store('public/expedientes');
            $file_save->Expediente_idExpediente=$expe->id;

            Imagen::create([
                'nombre'=>$file_save->nombre,
                'ruta'=>$file_save->ruta,
                'Expediente_idExpediente'=>$file_save->Expediente_idExpediente,
            ]);
        }        
     
        $this->reset(['open','placa','certificado','servicio','files']);
        $this->identificador=rand();
        $this->emitTo('expedientes','render');
        $this->emit('alert','El Expediente se registro correctamente!');
    }

    public function deleteFileUpload($id){
        unset($this->files[$id]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingOpen(){
        if($this->open==false){
            $this->reset(['placa','certificado','servicio','files']);
            $this->identificador=rand();            
        }
    }
}
