<?php

namespace App\Http\Livewire;

use App\Models\DetalleIngreso;
use App\Models\Material;
use App\Models\TipoMaterial;
use Livewire\Component;

class CreateIngreso extends Component
{
    

    public $cantidad,$estado,$material,$numInicio,$numFinal,$tiposMaterial,$tipoMat,$prefijo;

    public $open,$numguia,$motivo;
    
    protected $rules=[
        'numguia'=>'required',       
        'motivo'=>'required',
        "cantidad"=>"required|numeric|min:1",
        "estado"=>"required|numeric",
        "numInicio"=>"required|numeric|min:1",
        "numFinal"=>"required|numeric|min:1", 
        "tipoMat"=>"required|numeric",    
    ];

    public function mount(){
        $this->open=false;
        $this->tiposMaterial=TipoMaterial::all();
        //$this->prefijo=0;
    }

    public function render()
    {
        return view('livewire.create-ingreso');
    }

   

    public function save(){
        $this->validate(); 
        $aux=[];  
        for($i = $this->numInicio; $i < ($this->numInicio+$this->cantidad); $i++):
            $formato=Material::create([
                "estado"=>1,
                "numSerie"=>((string)$this->prefijo.(string)$i),                
                "idTipoMaterial"=>$this->tipoMat,                
            ]);
            array_push($aux,$formato->id);              
        endfor;   
             
        $this->open=false;
    }

    public function updated($propertyName){
        if($propertyName=="numInicio" && $this->cantidad>0){
            if($this->numInicio){
                $aux=(string)$this->numInicio;  
                $this->numFinal=$this->numInicio+($this->cantidad-1);
            }
        }
        $this->validateOnly($propertyName);
    }
}
