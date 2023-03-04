<?php

namespace App\Http\Livewire;

use App\Models\Material;
use Livewire\Component;

class Arreglando extends Component
{

    public $materiales;

    protected $listernes=["cambiarEstado"];

    public function mount(){
        $this->materiales=Material::where("idTipoMaterial","1")->get();
    }

    public function render()
    {
        $materiales=$this->materiales;
        return view('livewire.arreglando',compact("materiales"));
    }


    public function cambiarEstado(){
        foreach ($this->materiales as $key => $material) {
            $material->update(["añoActivo"=>2023]);
        }

        $this->emit("arreglando","render");
    }
}
