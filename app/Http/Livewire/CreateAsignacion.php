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
    public $inspectores,$inspector,$tiposMateriales,$cantidad,$nombre,$motivo,$nombreTipo;
    public $tipoM=0;
    public $stocks=[];   

    protected $rules=[               
        "tipoM"=>"required|numeric",
         "motivo"=>"required|numeric"           
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
        
        $this->reset(['tipoM','motivo','cantidad','stocks']);
        $this->listaStock();
    }

    
}
