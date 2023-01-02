<?php

namespace App\Http\Livewire;

use App\Models\Ingreso;
use App\Models\IngresoDetalle;
use App\Models\Material;
use App\Models\TipoMaterial;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateIngreso extends Component
{
    

    public $cantidad,$estado,$material,$numInicio,$numFinal,$tiposMaterial,$tipoMat,$prefijo,$numguia,$motivo,$mostrar;

    public $open=false;
    
    protected $rules=[
        'numguia'=>'required',       
        'motivo'=>'required',         
        "tipoMat"=>"required|numeric",            
    ];

    

    public function mount(){
        //$this->open=false;
        $this->tiposMaterial=TipoMaterial::all()->sortBy("descripcion");
        //$this->prefijo=0;
    }

    public function render()
    {
        return view('livewire.create-ingreso');
    }

   

    public function save(){
        $aux=[];  
        $this->validate(); 
        $ingreso=Ingreso::create([
            "motivo"=>$this->motivo,
            "numeroguia"=>$this->numguia,
            "estado"=>1,
            "idUsuario"=>Auth::id(),           
        ]);       
        for($i = $this->numInicio; $i < ($this->numInicio+$this->cantidad); $i++){
            $formato=Material::create([
                "estado"=>1,
                "numSerie"=>((string)$this->prefijo.(string)$i),
                "grupo"=>$this->numguia,                
                "idTipoMaterial"=>$this->tipoMat, 
                "idUsuario"=>Auth::id(),               
            ]);
            array_push($aux,$formato->id);           
        }           
        foreach ($aux as $id){
            $detalleIng=IngresoDetalle::create([
                "idIngreso"=>$ingreso->id,
                "idMaterial"=>$id,
                "estado"=>1
            ]);
        } 
        $this->reset(['motivo','numguia','numInicio','numFinal','prefijo','tipoMat','estado']); 
        $this->open=false;   
        $this->emitTo('ingresos','render');
        $this->emit('alert','El expediente se registro correctamente!');
        
    }

    public function updated($propertyName){
        if($propertyName=="numInicio" && $this->cantidad>0){
            if($this->numInicio){               
                $this->numFinal=$this->numInicio+($this->cantidad-1);
            }
        }
        if($propertyName=="tipoMat"){
            switch ($this->tipoMat) {
                case 1:
                    $this->mostrar=1;
                    $this->rules+=["cantidad"=>"required|numeric|min:1",        
                                    "numInicio"=>"required|numeric|min:1",
                                    "numFinal"=>"required|numeric|min:1",];
                    break;
                case 2:
                    $this->mostrar=2;
                    $this->rules+=["cantidad"=>"required|numeric|min:1",];
                        break;
                case 3:
                    $this->mostrar=1;
                    $this->rules+=["cantidad"=>"required|numeric|min:1",        
                                    "numInicio"=>"required|numeric|min:1",
                                    "numFinal"=>"required|numeric|min:1",];
                        break;
                default:
                    $this->mostrar=0;
                    break;
            }

        }
        $this->validateOnly($propertyName);
    }
}
