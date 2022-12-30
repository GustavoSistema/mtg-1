<?php

namespace App\Http\Livewire;

use App\Models\DetalleIngreso;
use App\Models\IngresoDetalle;
use App\Models\TipoMaterial;
use Livewire\Component;

class CreateDetalleIngreso extends Component
{

    public $cantidad,$estado,$material,$numInicio,$numFinal,$tiposMaterial,$tipoMat;

    protected $rules=[
        "cantidad"=>"required|numeric|min:1",
        "estado"=>"required|numeric",
        "numInicio"=>"required|numeric|min:1",
        "numFinal"=>"required|numeric|min:1", 
        "tipoMat"=>"required|numeric",       
    ];

    public function mount(){
        $this->estado=1;
        $this->tiposMaterial=TipoMaterial::all();
    }
    
    public function render()
    {
        return view('livewire.create-detalle-ingreso');
    }

    public function guardar(){
        $this->validate();
        $detalleI= new IngresoDetalle();
        $aux=1;
        
            
            $formato=Material::create([
                "estado"=>1,
                "numSerie"=>$this->numInicio,                
                "idTipoMaterial"=>$this->tipoMat                
            ]);

        dd($formato);
        

    }

    public function updated($propertyName){
        if($propertyName=="numInicio" && $this->cantidad>0){
            if($this->numInicio){
                $this->numFinal=$this->numInicio+($this->cantidad-1);
            }
        }
        $this->validateOnly($propertyName);
    }
    
}
