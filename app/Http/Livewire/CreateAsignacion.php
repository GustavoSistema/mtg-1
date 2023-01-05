<?php

namespace App\Http\Livewire;

use App\Models\Material;
use App\Models\TipoMaterial;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateAsignacion extends Component
{

    public $open=false;
    public $inspectores,$inspector,$tiposMateriales,$tipoM,$cantidad,$nombre,$motivo,$nombreTipo;
    public $stocks=[];   

    protected $rules=[               
        "tipoM"=>"required|numeric",
         "motivo"=>"required|numeric"           
    ];


    public function cargaStock(){
        $GLP=Material::where([
            ['estado',1],
            ['idTipoMaterial',3]
            ])
            ->get();
       
        $this->stocks+=["FORMATO GLP"=>count($GLP)];

        $CHIP=Material::where([
            ['estado',1],
            ['idTipoMaterial',2]
            ])
            ->get();
        $this->stocks+=["CHIP"=>count($CHIP)];

        $GNV=Material::where([
            ['estado',1],
            ['idTipoMaterial',1]
            ])
            ->get();
        $this->stocks+=["FORMATO GNV"=>count($GNV)];


    }
    public function mount(){
        $this->cargaStock();
        $this->inspectores=User::role(['inspector','supervisor'])        
        ->orderBy('name')->get();
        $this->tiposMateriales=TipoMaterial::all()->sortBy("descripcion");
    }

    public function render()
    {        
        return view('livewire.create-asignacion');
    }

    public function updated($propertyName){
        switch ($this->tipoM) {
            case 1:
                $this->rules+=["cantidad"=>'required|numeric|min:1|max:'.$this->stocks["FORMATO GNV"]];
                break;
            case 2:
                $this->rules+=["cantidad"=>'required|numeric|min:1|max:'.$this->stocks["CHIP"]];
                break;
            case 3:
                $this->rules+=["cantidad"=>'required|numeric|min:1|max:'.$this->stocks["FORMATO GLP"]];
            break;
            default:
                $this->rules+=["cantidad"=>'required|numeric|min:1'];
            break;
           }      
        $this->validateOnly($propertyName);
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
        $articulo= array("tipo"=>$this->tipoM,"nombreTipo"=>$this->nombreTipo,"cantidad"=>$this->cantidad,"motivo"=>$this->motivo);
        $this->emit('agregarArticulo',$articulo);
        $this->reset(['tipoM','motivo','cantidad']);
        $this->open=false;
    }      

    public function updatedOpen(){
       
        $this->reset(['tipoM','motivo','cantidad']);
    }

    
}
