<?php

namespace App\Http\Livewire\Tablas\Create;

use App\Models\TipoServicio;
use Livewire\Component;

class CreateTipoServicio extends Component
{

    public $descripcion;
    public $open=false;

    protected $rules=[
        "descripcion"=>"required|min:3",       
    ];

    public function render()
    {
        return view('livewire.tablas.create.create-tipo-servicio');
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function crearTipoServicio(){
        $this->validate();
        $tiposer=TipoServicio::create(["name"=>$this->nombre]);
        $this->emitTo("tablas.tipos-servicios","render");
        $this->reset(["nombre","open"]);
        $this->emit("minAlert", ["titulo" => "¡BUEN TRABAJO!", "mensaje" => "Permiso creado Correctamente", "icono" => "success"]); 
    }
}
