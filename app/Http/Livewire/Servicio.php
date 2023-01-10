<?php

namespace App\Http\Livewire;

use App\Models\Servicio as ModelServicio;
use App\Models\Taller;
use Livewire\Component;

class Servicio extends Component
{

    //Definiendo Variables de vehiculo
    public $placa,$categoria,$marca,$modelo,$version,$anioFab,$numSerie,$numMotor,
    $cilindros,$cilindrada,$combustible,$ejes,$ruedas,$asientos,$pasajeros,
    $largo,$ancho,$alto,$color,$pesoNeto,$pesoBruto;

    //Definiendo Variables de equipos
    public $equipos=[];

    //Variables del servicio
    public $talleres,$servicios,$serv,$taller;


    protected $rules=[
                    "taller"=>"require|numeric|min:1",
                    "servicio"=>"required|numeric|min:1",
                    "placa"=>"required|min:6",
                    "categoria"=>"required|min:2",
                    "marca"=>"required|min:2",
                    "modelo"=>"required|min:2",
                    "version"=>"required|min:2", 
                    "anioFab"=>"require|numeric|min:1",                  
                    
                    ];


    public function render()
    {
        return view('livewire.servicio');
    }

    public function updatedTaller($val){
        $this->servicios=ModelServicio::where("taller_idtaller",$val)->get();
    }
    public function mount(){
        //$this->servicios=ModelServicio::make();
        $this->talleres=Taller::all();
        $this->taller=Taller::make();
    }
}
