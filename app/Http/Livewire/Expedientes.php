<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Expediente;
use App\Models\Imagen;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Expedientes extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $otros=[];
    public $files=[];
    public $expediente,$identificador;
    public $search="";
    public $cant="";
    public $sort="created_at";
    public $direction='desc';
    public $readyToLoad=false;
    public $editando=false;

    protected $listeners=['render','delete','deleteFile'];

    protected $queryString=[
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'placa'],
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
        $this->identitifcador=rand();        
        $this->expediente= new Expediente();
        $this->cant="10";
    }




    public function render()
    {
        if($this->readyToLoad){
            $expedientes=Expediente::where('placa','like','%'.$this->search.'%')
                        ->orWhere('certificado','like','%'.$this->search.'%')
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
            $this->files=Imagen::where('Expediente_idExpediente','=',$this->expediente->id)->get();
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
        $imgs=Imagen::where('Expediente_idExpediente','=',$this->expediente->id)->get();
        foreach($imgs as $img ){
            Storage::delete([$img]);
        }
        $expediente->delete();        
        $this->emitTo('expedientes','render');
        $this->identificador=rand();
    }
    public function deleteFile(Imagen $file){
        Storage::delete([$file]);
        $file->delete();        
        $this->emitTo('expedientes','render');
        $this->identificador=rand();
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
