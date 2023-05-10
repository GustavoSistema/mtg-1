<?php

namespace App\Http\Livewire;

use App\Models\Material;
use App\Models\TipoMaterial;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgregarArticuloPrestamo extends Component
{

    public $open=false;
    public $stockGlp,$stockGnv,$stockChips,$ruta,$estado,$envio,$tiposMateriales;

    public $cantidad,$numInicio,$numFinal,$motivo;
    public  $articulos=[];
    public $tipoM=0;
    public $stocks= [ ]; 

    protected $rules=[               
        "tipoM"=>"required|numeric",
        //"motivo"=>"required|min:3","cantidad"=>"required",      
    ];

    public function render()
    {
        return view('livewire.agregar-articulo-prestamo');
    }

    public function mount(){        
        $this->estado=1;
        $this->tiposMateriales=TipoMaterial::all()->sortBy("descripcion");
        $this->listaStock();
    }
    public function listaStock(){
        $materiales=TipoMaterial::all();
        foreach($materiales as $key=>$material){
            $lista=Material::where([
                                    ['estado',3],
                                    ['idTipoMaterial',$material->id],
                                    ['idUsuario',Auth::id()],
                                    ])
                            ->get();
            $this->stocks+=[$material->descripcion=>count($lista)];
        }
    }

    public function updatedCantidad(){
        //Muestra el formato con el numeroSerie mas bajo segun el Tipo de Material y Grupo Seleccionado
        if($this->validateOnly("cantidad")){
            $num=Material::where([
                ['estado',3],
                ['idTipoMaterial',$this->tipoM],
                ['idUsuario',Auth::id()],
                ])->orderBy("numSerie","asc")->min("numSerie");
            //dd($num);
                $this->numInicio=$num;
        }
    }

    public function updated($propertyName){

        switch ($this->tipoM) {
            case 1:               
                    $cant=Material::where([
                        ['estado',3],
                        ['idTipoMaterial',$this->tipoM],
                        ['idUsuario',Auth::id()],
                        ])->count();
                    //dd($cant);                                       
                    if (array_key_exists("cantidad",$this->rules)){
                        $this->rules["cantidad"]="required|numeric|min:1|max:".$cant;
                    }else{
                        $this->rules+=["cantidad"=>'required|numeric|min:1|max:'.$cant];
                    }
                
            break;
            case 2:
                $this->rules+=["cantidad"=>'required|numeric|min:1|max:'.$this->stocks["CHIP"]];
                break;
            case 3:
                //$this->guias=json_decode(Material::stockPorGruposGlp(),true);
                if($this->guia){
                    $cant=Material::where([
                        ['estado',3],
                        ['idTipoMaterial',$this->tipoM],
                        ['idUsuario',Auth::id()],
                        ])->count();
                    //dd($cant);
                    //$this->reset(["numInicio"]);                    
                    //$this->rules+=["cantidad"=>'required|numeric|min:1|max:'.$cant];
                    if (array_key_exists("cantidad",$this->rules)){
                        $this->rules["cantidad"]="required|numeric|min:1|max:".$cant;
                    }else{
                        $this->rules+=["cantidad"=>'required|numeric|min:1|max:'.$cant];
                    }
                }                   
            break;
            default:
               //$this->guias=new Collection();                         
            break;
        }   


        if($propertyName=="cantidad" && $this->numInicio>0){
            if($this->cantidad){               
                $this->numFinal=$this->numInicio+($this->cantidad-1);
            }else{
                $this->numFinal=0;
            }
        } 
        if($propertyName=="numInicio" && $this->cantidad>0){

            if($this->numInicio){               
                $this->numFinal=$this->numInicio+($this->cantidad-1);                
            }
        }
        $this->validateOnly($propertyName);
    }
}
