<?php

namespace App\Http\Livewire;

use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChipPorDeterioro extends Component
{

    public $chips,$nombre,$placa,$estado="esperando";

    protected $rules=[
        "nombre"=>"required|string|min:3",
        "placa"=>"required|min:6|max:7"
    ];
    public function mount(){
        $this->chips=Material::where([["idUsuario",Auth::id()],["estado",3],["idTipoMaterial",2]])->get();
    }

    public function render()
    {
        return view('livewire.chip-por-deterioro');
    }

    public function consumirChip(){
        $this->validate();

        $chip=$this->chips->first();
        
        if($chip->update(["estado"=>4,"ubicacion"=>"En poder del cliente ".$this->nombre."/".$this->placa])){
            $this->estado="ChipConsumido";
            dd($chip);
            $this->emit("minAlert", ["titulo" => "¡BUEN TRABAJO!", "mensaje" => "El chip fue consumido correctamente", "icono" => "success"]);
        }else{
            $this->emit("minAlert", ["titulo" => "AVISO DEL SISTEMA", "mensaje" => "Ocurrio un error al consumir el chip", "icono" => "warning"]);
        }
            
    }
}
