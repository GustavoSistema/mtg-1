<?php

namespace App\Http\Livewire;

use App\Models\Equipo;
use App\Models\TipoEquipo;
use App\Models\TipoServicio;
use App\Models\vehiculo;
use Livewire\Component;

class FormEquipos extends Component
{
    public $nombreDelInvocador;
    public $equipo;
    public $open=false;
    
    public $cantEquipos;    
    public $vehiculo;
    public $tipoServicio;
    protected $rules=
    [
        "equipo.*"=>"required",
        "equipo.numSerie"=>"required|min:3",
        "equipo.marca"=>"required|min:2",
        "equipo.modelo"=>"required|min:2",
        "equipo.capacidad"=>"required|min:3",
    
    ];

    protected $listeners=['render','delete'];
    

    public function mount(vehiculo $vehiculo,TipoServicio $tipoServicio){
        $this->vehiculo=$vehiculo;  
        $this->tipoServicio=$tipoServicio;             
    }

    public function render(){        
        $this->cantEquipos=$this->cuentaEquipos();         
        $equipos=$this->vehiculo->Equipos;               
        return view('livewire.form-equipos',compact('equipos'));
    }    

    public function delete(Equipo $eq){        
        $eq->delete();       
        $this->emitTo('form-equipos','mount'); 
        $this->emitTo('form-equipos','render');
        if($this->nombreDelInvocador!=null){
            $this->emitTo($this->nombreDelInvocador,'refrescaVehiculo');  
        }else{
            $this->emitTo('prueba','refrescaVehiculo');  
        }       
       
        $this->emit("minAlert",["titulo"=>"BUEN TRABAJO!","mensaje"=>"Eliminaste un item de tu lista de equipos","icono"=>"success",]); 
    }

    public function edit(Equipo $eq){
        $this->equipo=$eq;
        $this->open=true;
    }

    public function actualizar(){

        switch($this->equipo->idTipoEquipo){
            case 1:
                $this->salvaChip();
                $this->emitTo('form-equipos','mount'); 
                $this->emitTo('form-equipos','render'); 
            break;

            case 2:
                $this->salvaReductor();
                $this->emitTo('form-equipos','mount'); 
                $this->emitTo('form-equipos','render'); 
            break;

            case 3:
                $this->salvaTanque();
                $this->emitTo('form-equipos','mount'); 
                $this->emitTo('form-equipos','render'); 
            break;
        }
        
    }

    public function salvaTanque(){
        $this->validate([
                        "equipo.numSerie"=>"required|min:1",
                        "equipo.marca"=>"required|min:1",
                        "equipo.capacidad"=>"required|numeric|min:1",
                        "equipo.peso"=>"required|numeric|min:1",
                        "equipo.fechaFab"=>"required|date"
                        ]);
       
       
        $this->equipo->numSerie=strtoupper($this->equipo->numSerie);
        $this->equipo->marca=strtoupper($this->equipo->marca);        
        $this->equipo->save();

           
        $this->open=false;
        $this->emit("minAlert",["titulo"=>"BUEN TRABAJO!","mensaje"=>"El ".$this->equipo->tipo->nombre." con serie ".$this->equipo->numSerie." se añadio Correctamente","icono"=>"success"]);
        
        $this->reset(["equipo"]);   
    }

    public function salvaReductor(){
        $this->validate([
            "equipo.numSerie"=>"required|min:1",
            "equipo.marca"=>"required|min:1",
            "equipo.modelo"=>"required|min:1"
            ]); 

        $this->equipo->save();       
        $this->open=false;
        $this->emit("minAlert",["titulo"=>"BUEN TRABAJO!","mensaje"=>"El ".$this->equipo->tipo->nombre." con serie ".$this->equipo->numSerie." se añadio Correctamente","icono"=>"success"]);
        $this->reset(["equipo"]);   
    }

    public function salvaChip(){
        $this->validate([
            "equipo.numSerie"=>"required|min:1",           
            ]);      

        $this->equipo->numSerie=strtoupper($this->equipo->numSerie);
        $this->equipo->save();          
                  
        $this->open=false;        
        $this->emit("minAlert",["titulo"=>"BUEN TRABAJO!","mensaje"=>"El ".$this->equipo->tipo->nombre." con serie ".$this->equipo->numSerie." se añadio Correctamente","icono"=>"success"]);
        
        $this->reset(["equipo"]);  

        
    }

    public function cuentaDis($tipo){
        $cuenta=0;
        if(isset($this->vehiculo->Equipos)){
            if($this->vehiculo->Equipos->count() >0){
                foreach($this->vehiculo->Equipos as $eq){
                    if($eq->idTipoEquipo == $tipo){
                        $cuenta++;
                    }
                }
            }else{
                $cuenta=0;
            }
        }
        return $cuenta;
    }

    public function cuentaEquipos(){
        $estado=false;
        $chips=$this->cuentaDis(1);
        $reg=$this->cuentaDis(2);       
        $cil=$this->cuentaDis(3);
            if($chips>0 && $reg>0 && $cil >0){
                //$this->validaVehiculo();
                $estado=true;                
            }
        return $estado;
    }
    
    
}
