<?php

namespace App\Http\Livewire;

use App\Models\Ingreso;
use App\Models\IngresoDetalle;
use App\Models\Material;
use App\Models\TipoMaterial;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class CreateIngreso extends Component
{
    

    public $cantidad,$estado,$material,$numInicio,$numFinal,$tiposMaterial,$tipoMat,$anioActivo,$numguia,$motivo,$mostrar,$temp,$mensaje;

    public $open=false;
    
    protected $rules=[
        'numguia'=>'required',       
        'motivo'=>'required',         
        "tipoMat"=>"required|numeric",            
    ];

    

    public function mount(){
        //$this->open=false;
        $this->tiposMaterial=TipoMaterial::all()->sortBy("descripcion");
        $this->anioActivo=Date('Y');
        $this->mensaje="Procesando su solicitud espere un momento";
        //$this->prefijo=0;
    }

    public function render()
    {
        return view('livewire.create-ingreso');
    }

   

    public function save(){
        $this->validate(); 
        $this->temp=$this->validaSeries();

        if($this->validaSeries()->count() <= 0){
            $aux=[];          
            $ingreso=Ingreso::create([
                "motivo"=>$this->motivo,
                "numeroguia"=>$this->numguia,
                "estado"=>1,
                "idUsuario"=>Auth::id(),           
            ]);             
            switch ($this->mostrar) {
                case 1:
                    for($i = $this->numInicio; $i < ($this->numInicio+$this->cantidad); $i++){
                        $formato=Material::create([
                            "estado"=>1,
                            //"numSerie"=>((string)$this->prefijo.(string)$i),
                            "numSerie"=>$i,
                            "anioActivo"=>$this->anioActivo,
                            "grupo"=>$this->numguia,                
                            "idTipoMaterial"=>$this->tipoMat,
                            "ubicacion"=>'MOTORGAS COMPANY S.A.', 
                            "idUsuario"=>Auth::id(),               
                        ]);
                        
                        array_push($aux,$formato->id);           
                    }      
                    $this->mensaje="se termino de crear ".$this->cantidad." formatos";     
                    foreach ($aux  as $key=>$id){
                        $detalleIng=IngresoDetalle::create([
                            "idIngreso"=>$ingreso->id,
                            "idMaterial"=>$id,
                            "estado"=>1
                        ]);
                        
                    }                
                    break;
                case 2:
                    for($i = 0; $i < $this->cantidad; $i++){
                        $formato=Material::create([
                            "estado"=>1,                        
                            "grupo"=>$this->numguia,                
                            "idTipoMaterial"=>$this->tipoMat,
                            "ubicacion"=>'MOTORGAS COMPANY S.A.', 
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
                    break;            
                default:        
                    
                    break;
            }
            
            $this->reset(['motivo','numguia','numInicio','numFinal','anioActivo','tipoMat','estado','cantidad','mensaje']); 
            $this->open=false;   
            $this->emitTo('ingresos','render');
            $this->emit("CustomAlert",["titulo"=>"BUEN TRABAJO!","mensaje"=>"Tu nuevo ingreso se registro correctamente y se crearon todos los materiales","icono"=>"success"]);
        }
    }

    public function updated($propertyName){
        if($propertyName=="numInicio" && $this->cantidad>0){
            if($this->numInicio){               
                $this->numFinal=$this->numInicio+($this->cantidad-1);
            }
        }
        if($propertyName=="cantidad" && $this->numInicio>0){
            if($this->cantidad){               
                $this->numFinal=$this->numInicio+($this->cantidad-1);
            }else{
                $this->numFinal=0;
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

    public function creaColeccion($inicio,$fin){
        $cole= new Collection();
        for ($i=$inicio; $i <=$fin; $i++) { 
            $cole->push($i);
        }
        return $cole;
    }

    public function validaSeries(){
        $result= new Collection();
        $errorMessage=null;
        if($this->tipoMat==1 || $this->tipoMat==3){
            if($this->numInicio && $this->anioActivo){
                $series=$this->creaColeccion($this->numInicio,$this->numFinal);
                $materiales=Material::where([['idTipoMaterial',$this->tipoMat],['anioActivo',$this->anioActivo]])->pluck('numSerie');
                $result=$materiales->intersect($series);
            }
        }           
        return $result;
    }
}
