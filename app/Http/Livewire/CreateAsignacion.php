<?php

namespace App\Http\Livewire;

use App\Models\Material;
use App\Models\TipoMaterial;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateAsignacion extends Component
{

    public $open=false;  

    public $inspectores,$inspector,$tiposMateriales,$cantidad,$nombre,$motivo,$nombreTipo,$grupo,$numInicio,$numFinal;
    public $grupos;
    public $tipoM=0;
    public $stocks=[];   

    protected $rules=[               
        "tipoM"=>"required|numeric",
        "motivo"=>"required|min:3"           
    ];
   

    public function listaStock(){
        $materiales=TipoMaterial::all();
        foreach($materiales as $key=>$material){
            $lista=Material::where([
                                    ['estado',1],
                                    ['idTipoMaterial',$material->id]
                                    ])
                            ->get();
            $this->stocks+=[$material->descripcion=>count($lista)];
        }
    }

    public function mount(){
        $this->listaStock();
        $this->inspectores=User::role(['inspector','supervisor'])        
                                ->orderBy('name')
                                ->get();
        $this->tiposMateriales=TipoMaterial::all()->sortBy("descripcion");
    }

    public function render(){        
        return view('livewire.create-asignacion');
    }

    public function updated($propertyName){
        switch ($this->tipoM) {
            case 1:                
                $this->grupos=Material::stockPorGruposGnv();
                if($this->grupo){
                    $cant=Material::where([
                        ['estado',1],
                        ['idTipoMaterial',$this->tipoM],
                        ['grupo',$this->grupo],
                        ])->count();
                    //dd($cant);
                    //$this->reset(["numInicio"]);                    
                    $this->rules+=["cantidad"=>'required|numeric|min:1|max:'.$cant];
                }
            break;
            case 2:
                //$this->rules+=["cantidad"=>'required|numeric|min:1|max:'.$this->stocks["CHIP"]];
                break;
            case 3:
                $this->rules+=["cantidad"=>'required|numeric|min:1|max:'.$this->stocks["FORMATO GLP"]];
            break;
            default:
                //$this->rules+=["cantidad"=>'required|numeric|min:1'];
            break;
           }     
           
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

        $this->validateOnly($propertyName);

    
    }

    public function updatedCantidad(){
        //Muestra el formato con el numeroSerie mas bajo segun el Tipo de Material y Grupo Seleccionado
        if($this->validateOnly("cantidad")){
            $num=Material::where([
                ['estado',1],
                ['idTipoMaterial',$this->tipoM],
                ['grupo',$this->grupo],
                ])->orderBy("numSerie","asc")->min("numSerie");;
                $this->numInicio=$num;
        }
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
        if($this->tipoM==1 || $this->tipoM==3){
            if($this->numInicio && $this->grupo){
                $series=$this->creaColeccion($this->numInicio,$this->numFinal);
                $mat=Material::where([['idTipoMaterial',$this->tipoM],['grupo',$this->grupo],["estado",1]])->pluck('numSerie');
                $result=$mat->intersect($series);
            }
        }           
        return $result;
    }

    public function addArticulo(){
        $rule=[];

        switch ($this->tipoM) {
            case 1:
                $rule=["cantidad"=>'required|numeric|min:1|max:'.$this->stocks["FORMATO GNV"]];
                break;
            case 2:
                $rule=["cantidad"=>'required|numeric|min:1|max:'.$this->stocks["CHIP"]];
                break;
            case 3:
                $rule=["cantidad"=>'required|numeric|min:1|max:'.$this->stocks["FORMATO GLP"]];
            break;
            default:
                $rule=["cantidad"=>'required|numeric|min:1'];
            break;
        } 
        $this->validate($rule);  

        $temp=$this->validaSeries();
        if($temp->count()>0){
           
           // $this->emit("minAlert",["titulo"=>"TODO OK","mensaje"=>"BIEN HECHO ".$temp->count(),"icono"=>"success"]); 
            $articulo= array("tipo"=>$this->tipoM,"nombreTipo"=>$this->nombreTipo,"cantidad"=>$this->cantidad,"inicio"=>$this->numInicio,"final"=>$this->numFinal,"motivo"=>$this->motivo);
            $this->emit('agregarArticulo',$articulo);
            $this->reset(['tipoM','motivo','cantidad','grupo','numInicio','numFinal']);
            $this->open=false;
            //$this->reset(["grupo"]);
        }else{
            $this->emit("minAlert",["titulo"=>"ERROR","mensaje"=>"Las series ingresadas no pertenecen al grupo seleccionado o no existen ","icono"=>"error"]); 
            $this->reset(['tipoM','motivo','cantidad','grupo','numInicio','numFinal']);            
        }          
    }      

    public function updatedOpen(){        
        $this->reset(['tipoM','motivo','cantidad','stocks','grupo','numInicio','numFinal']);
        $this->listaStock();
    }

    
}
