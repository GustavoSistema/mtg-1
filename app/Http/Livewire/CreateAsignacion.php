<?php

namespace App\Http\Livewire;

use App\Models\TipoMaterial;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateAsignacion extends Component
{

    public $open=false;
    public $inspectores,$inspector,$tiposMateriales,$tipo,$mostrar,$cantidad,$numFinal,$numInicio,$prefijo,$articulos;

    protected $listeners = ['addArticulo'];

    protected $rules=[               
        "tipo"=>"required|numeric",            
    ];

    public function mount(){
        $this->mostrar=0;
        $this->inspectores=User::role(['inspector','supervisor'])        
        ->orderBy('name')->get();
        $this->tiposMateriales=TipoMaterial::all()->sortBy("descripcion");
    }

    public function render()
    {
        return view('livewire.create-asignacion');
    }

    public function updated($propertyName){
        if($propertyName=="numInicio" && $this->cantidad>0){
            if($this->numInicio){               
                $this->numFinal=$this->numInicio+($this->cantidad-1);
            }
        }
        if($propertyName=="tipo"){
            switch ($this->tipo) {
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

    public function addArticulo($articulo){
        array_push($this->articulos,$articulo);       
    }

    
}
