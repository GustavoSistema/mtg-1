<?php

namespace App\Http\Livewire;

use App\Models\CertificacionPendiente;
use App\Models\Servicio;
use App\Models\TipoServicio;
use App\Models\vehiculo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActivacionDeChips extends Component
{

    public $tipoServicio,$vehiculo,$idTaller,$estado;


    protected $listeners = ['cargaVehiculo' => 'carga', "refrescaVehiculo" => "refrescaVe"];


    public function render()
    {
        return view('livewire.activacion-de-chips');
    }

    public function refrescaVe()
    {
        $this->vehiculo->refresh();
    }

    public function carga($id)
    {
        $this->vehiculo = vehiculo::find($id);
    }

    public function guardar(){
        if (isset($this->vehiculo)) {
            if ($this->vehiculo->esCertificable) {
                $serv=Servicio::where([["taller_idtaller",$this->idTaller],["tipoServicio_idtipoServicio",2]])->first();
               if($serv!=null){
                    $certi=CertificacionPendiente::create([
                        "idInspector"=>Auth::id(),
                        "idServicio"=>$serv->id,
                        "idTaller"=>$this->idTaller,
                        "idVehiculo"=>$this->vehiculo->id,
                        "estado"=>1,
                        "pagado"=>0,
                        "precio"=>$serv->precio,                        
                    ]);
                    $this->estado="realizado";
                    $this->emit("minAlert", ["titulo" => "¡BUEN TRABAJO!", "mensaje" => "Se agrego correctamente una certificacion pendiente para este vehículo", "icono" => "success"]);
               }else{
                $this->emit("minAlert", ["titulo" => "AVISO DEL SISTEMA", "mensaje" => "Completa los datos de los equipos para poder continuar", "icono" => "warning"]);
               }
            }else{
                $this->emit("minAlert", ["titulo" => "AVISO DEL SISTEMA", "mensaje" => "Completa los datos de los equipos para poder continuar", "icono" => "warning"]);
            }
        }else{
            $this->emit("minAlert", ["titulo" => "AVISO DEL SISTEMA", "mensaje" => "Ingresa un vehículo valido para poder continuar", "icono" => "warning"]);
        }
    }

    

    

}
