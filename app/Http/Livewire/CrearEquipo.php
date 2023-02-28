<?php

namespace App\Http\Livewire;

use App\Models\Equipo;
use App\Models\EquiposVehiculo;
use App\Models\TipoEquipo;
use App\Models\vehiculo;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CrearEquipo extends Component
{

    public $vehiculo;

    public $open=false;

    public $tiposDisponibles;

    public $tipoEquipo,$equipoSerie,$equipoMarca,$equipoModelo,$equipoCapacidad,$equipoPeso,$equipoFechaFab,$cantEquipos;
    public $equipos=[];
    

    public function mount(vehiculo $vehiculo){
        $this->vehiculo=$vehiculo;   
        $this->listaTiposDisponibles();    
    }

    public function render()
    {
        return view('livewire.crear-equipo');
    }

   
    public function guardaEquipo(){
        $this->validate([
            "tipoEquipo"=>"required|numeric|min:1"
            ]);
            switch ($this->tipoEquipo) {
            case 1:
                $chip=$this->salvaChip();
                $equipoVehiculo=EquiposVehiculo::create(["idEquipo"=>$chip->id,"idVehiculo"=>$this->vehiculo->id]);
               // $this->emit('form-equipos','mount'); 
                $this->emitTo('form-equipos','render');                
                //$this->actualizaListaEquipos();
                //$this->cantEquipos=$this->cuentaEquipos();
            break;
            case 2:
                $reductor=$this->salvaReductor();
                $equipoVehiculo=EquiposVehiculo::create(["idEquipo"=>$reductor->id,"idVehiculo"=>$this->vehiculo->id]);
              //  $this->emit('form-equipos','mount'); 
                $this->emitTo('form-equipos','render'); 
               
                //$this->actualizaListaEquipos();
               // $this->cantEquipos=$this->cuentaEquipos();
            break;
            case 3:
                $tanque=$this->salvaTanque();
                $equipoVehiculo=EquiposVehiculo::create(["idEquipo"=>$tanque->id,"idVehiculo"=>$this->vehiculo->id]);
               // $this->emit('form-equipos','mount'); 
                $this->emitTo('form-equipos','render'); 
               
               // $this->actualizaListaEquipos();
               // $this->cantEquipos=$this->cuentaEquipos();
            break;

            default:
                $this->emit("alert","ocurrio un error al guardar los datos");
                break;
            }
            
         $this->emitTo('prueba','refrescaVehiculo'); 
    }

    public function updatedOpen(){
        
        $this->listaTiposDisponibles();
        $this->tipoEquipo="";    
    }

    public function updatedEquipoCapacidad($var){
        if($var!=null && $var!='e'){
            $this->equipoPeso=$var+(mt_rand(5,8));
        }else{
            $this->equipoPeso=null;
        }   
    } 

    public function salvaTanque(){
        $this->validate([
                        "equipoSerie"=>"required|min:1",
                        "equipoMarca"=>"required|min:1",
                        "equipoCapacidad"=>"required|numeric|min:1",
                        "equipoPeso"=>"required|numeric|min:1",
                        "equipoFechaFab"=>"required|date"
                        ]);
        $equipo=new Equipo();
        $equipo->idTipoEquipo=$this->tipoEquipo;
        $equipo->numSerie=strtoupper($this->equipoSerie);
        $equipo->marca=strtoupper($this->equipoMarca);
        $equipo->capacidad=$this->equipoCapacidad;
        $equipo->fechaFab=$this->equipoFechaFab;
        $equipo->peso=$this->equipoPeso;  
        $equipo->save();

        $this->reset(["equipoSerie","equipoMarca","equipoModelo","equipoCapacidad","tipoEquipo","equipoFechaFab","equipoPeso"]);      
        $this->open=false;
        $this->emit("minAlert",["titulo"=>"BUEN TRABAJO!","mensaje"=>"El ".$equipo->tipo->nombre." con serie ".$equipo->numSerie." se añadio Correctamente","icono"=>"success"]);
        
        return $equipo; 
        
    }

    public function salvaReductor(){
        $this->validate([
            "equipoSerie"=>"required|min:1",
            "equipoMarca"=>"required|min:1",
            "equipoModelo"=>"required|min:1"
            ]);

        $equipo=new Equipo();
        $equipo->idTipoEquipo=$this->tipoEquipo;
        $equipo->numSerie=strtoupper($this->equipoSerie);
        $equipo->marca=strtoupper($this->equipoMarca);
        $equipo->modelo=strtoupper($this->equipoModelo);

        //array_push($this->equipos,$equipo);   
        $equipo->save();
        $this->reset(["equipoSerie","equipoMarca","equipoModelo","equipoCapacidad","tipoEquipo","equipoFechaFab","equipoPeso"]);
        $this->open=false;
        $this->emit("minAlert",["titulo"=>"BUEN TRABAJO!","mensaje"=>"El ".$equipo->tipo->nombre." con serie ".$equipo->numSerie." se añadio Correctamente","icono"=>"success"]);
        
        

        return $equipo;    
    }

    public function salvaChip(){
        $this->validate([
            "equipoSerie"=>"required|min:1",           
            ]);

        $equipo=new Equipo();
        $equipo->idTipoEquipo=$this->tipoEquipo;
        $equipo->numSerie=strtoupper($this->equipoSerie);

        $equipo->save();   
        
        $this->reset(["equipoSerie","equipoMarca","equipoModelo","equipoCapacidad","tipoEquipo","equipoFechaFab","equipoPeso","equipos"]);     
        $this->equipos=Equipo::make();   
        $this->open=false;
        //$this->emit("alert","El ".$equipo->tipo->nombre." con serie ".$equipo->numSerie." se añadio Correctamente");
        $this->emit("minAlert",["titulo"=>"BUEN TRABAJO!","mensaje"=>"El ".$equipo->tipo->nombre." con serie ".$equipo->numSerie." se añadio Correctamente","icono"=>"success"]);
        
        

        return $equipo;
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

    public function listaTiposDisponibles(){        
        $aux=[];
        $todos=TipoEquipo::all();
        foreach($todos as $tip){
            if($tip->id==3){
                array_push($aux,array("id"=>$tip->id,"nombre"=>$tip->nombre,"estado"=>1));
            }else{
                if($this->cuentaDis($tip->id) >= 1 ){
                    array_push($aux,array("id"=>$tip->id,"nombre"=>$tip->nombre,"estado"=>0));
                }else{
                    array_push($aux,array("id"=>$tip->id,"nombre"=>$tip->nombre,"estado"=>1));
                }
            }            
        } 
             
        $this->tiposDisponibles=$aux;   
           
      
    }
}
