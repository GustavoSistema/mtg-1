<?php

namespace App\Http\Livewire;

use App\Models\TipoMaterial;
use App\Models\User;
use Livewire\Component;

class AsignacionMateriales extends Component
{
    public $open=false;
    public $inspectores,$inspector;

    

    public function mount(){
        $this->inspectores=User::role(['inspector','supervisor'])
        //->where('id','!=',Auth::id())
        ->orderBy('name')->get();
        
    }
    public function render()
    {
        return view('livewire.asignacion-materiales');
    }

    public function agregarArticulo(){
        $this->validate();
        $articulo= array("tipo"=>$this->tipo,"cantidad"=>$this->cantidad,"inicio"=>$this->numInicio,"final"=>$this->numFinal);
        $this->emit('addArticulo',$articulo);
        $this->emitTo('Expedientes','render');
    }
    
}
