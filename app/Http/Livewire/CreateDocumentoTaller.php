<?php

namespace App\Http\Livewire;

use App\Models\Documento;
use App\Models\DocumentoTaller;
use App\Models\Imagen;
use App\Models\Taller;
use App\Models\TipoDocumento;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateDocumentoTaller extends Component
{
    use WithFileUploads;

    public Taller $taller;
    public $addDocument=false;

    public $tiposDocumentos,$tipoSel,$documento,$fechaInicial,$fechaCaducidad,$tiposDisponibles,$empleado;    

    protected $rules=[
        "tipoSel"=>"required|numeric|min:1",
        "documento"=>"required|mimes:pdf",
        "fechaInicial"=>"required|date",
        "fechaCaducidad"=>"required|date",

        
    ];

    public function updated($nameProperty){

        $this->validateOnly($nameProperty);
    }

    public function mount(){
       // $this->tiposDocumentos=TipoDocumento::all();
        $this->listaDisponibles();    
    }
    
    
    public function render()
    {
        return view('livewire.create-documento-taller');
    }

    public function cuentaDis($tipo){
        $cuenta=0;
        if(isset($this->taller->Documentos)){
            if($this->taller->Documentos->count() >0){
                foreach($this->taller->Documentos as $doc){                    
                    if($doc->tipoDocumento == $tipo){
                        $cuenta++;
                    }
                }
            }else{
                $cuenta=0;
            }
        }
        return $cuenta;
    }

    public function updatedAddDocument(){
        $this->listaDisponibles();   
        $this->reset(["tipoSel","fechaInicial","fechaCaducidad","documento","empleado"]);
        $this->tipoSel=""; 
    }

    public function agregarDocumento(){

        $this->validate();

        if($this->tipoSel==9){
            $this->validate(["empleado"=>"required|string"]);
        }
        $nombre= $this->taller->id.'-doc-'.rand();
        $documento_guardado=Documento::create([

            'tipoDocumento'=>$this->tipoSel, 
            'fechaInicio'=>$this->fechaInicial,
            'fechaExpiracion'=>$this->fechaCaducidad, 
                       
            'ruta'=>$this->documento->storeAs('public/docsTaller',$nombre.'.'.$this->documento->extension()),
            'extension'=>$this->documento->extension(), 

        ]); 
        if($this->tipoSel==9){
            $documento_guardado->update(['nombreEmpleado'=>$this->empleado]);            
        }

        $docTaller=DocumentoTaller::create([
            'idDocumento'=>$documento_guardado->id,
            'idTaller'=>$this->taller->id,
            'estado'=>1,
        ]);

        $this->reset(["tipoSel","fechaInicial","fechaCaducidad","documento","empleado","addDocument"]);
        $this->tipoSel="";
        $this->emit("CustomAlert", ["titulo" => "BUEN TRABAJO!", "mensaje" => "Se ingreso correctamente un nuevo documento del taller ".$this->taller->nombre, "icono" => "success"]);

    }

    public function listaDisponibles(){        
        $aux=[];
        $todos=TipoDocumento::all();
        foreach($todos as $tip){
            if($tip->id==9){
                array_push($aux,array("id"=>$tip->id,"nombre"=>$tip->nombreTipo,"estado"=>1));
            }else{
                if($this->cuentaDis($tip->id) >= 1 ){
                    array_push($aux,array("id"=>$tip->id,"nombre"=>$tip->nombreTipo,"estado"=>0));
                }else{
                    array_push($aux,array("id"=>$tip->id,"nombre"=>$tip->nombreTipo,"estado"=>1));
                }
            }            
        }              
        $this->tiposDisponibles=$aux;             
    }
}
