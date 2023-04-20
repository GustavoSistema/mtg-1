<?php

namespace App\Http\Livewire;

use App\Models\Documento;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ComandosDocumento extends Component
{

    use WithFileUploads;

    public $documento,$idDocumento,$nuevoPdf;

    

    public $openEdit;

    protected $rules=[
        "documento.tipoDocumento"=>"required|numeric|min:1",        
        "documento.fechaInicio"=>"required|date",
        "documento.fechaExpiracion"=>"required|date",  
        "documento.nombreEmpleado"=>"required|string"      
    ];

    protected $listeners=["eliminar"];

    public function mount(){
        $this->documento=Documento::find($this->idDocumento);
    }

    public function render()
    {
        return view('livewire.comandos-documento');
    }

    public function abrirModal(){
        $this->openEdit=true;
    }

    public function eliminar($id){
        $doc=Documento::findOrFail($id);
        Storage::delete($doc->ruta);
        $doc->delete();
        $doc=Documento::make();
        $this->documento=null;
        $this->emitTo('editar-taller','refrescaTaller'); 
        $this->emitTo('editar-taller','render');         

       

    }

    public function editarDocumento(){

        $rules=[
            "documento.tipoDocumento"=>"required|numeric|min:1",        
            "documento.fechaInicio"=>"required|date",
            "documento.fechaExpiracion"=>"required|date", 
        ];
        if($this->documento->tipoDocumento==9){
           
               $rules+=["documento.nombreEmpleado"=>"required|string"];
            
        }
        if($this->nuevoPdf!=null){
            $rules+=["nuevoPdf"=>"required|mimes:pdf"];
            $this->validate($rules);
            $nombre= rand().'-doc-'.rand();  
            $nuevaRuta=$this->guardaNuevoArchivo($nombre,$this->nuevoPdf);
            Storage::delete([$this->documento->ruta]); 
            $this->documento->ruta=$nuevaRuta;
            $this->documento->save(); 
            $this->emit("minAlert", ["titulo" => "BUEN TRABAJO!", "mensaje" => "El documento ".$this->documento->TipoDocumento->nombreTipo." se actualizo correctamente", "icono" => "success"]);
        }else{
            $this->validate($rules);
            $this->documento->save(); 
            $this->emit("minAlert", ["titulo" => "BUEN TRABAJO!", "mensaje" => "El documento ".$this->documento->TipoDocumento->nombreTipo." se actualizo correctamente", "icono" => "success"]);
        }     
        $this->reset(["openEdit","nuevoPdf"]);
    }


    public function guardaNuevoArchivo($nombre,$file){
        $ruta=null;
        if($file != null){
            $ruta=$file->storeAs('public/docsTaller',$nombre.'.'.$file->extension());
        }
       
        return $ruta;
    }

}
