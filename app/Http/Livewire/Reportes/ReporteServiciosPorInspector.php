<?php

namespace App\Http\Livewire\Reportes;

use App\Models\Certificacion;
use App\Models\ServiciosImportados;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReporteServiciosPorInspector extends Component
{   
    public $fechaInicio,$fechaFin,$services;

    protected $rules=[
                        "fechaInicio"=>'required|date',
                        "fechaFin"=>'required|date',
                     ];
    public function render()
    {
          
               
        return view('livewire.reportes.reporte-servicios-por-inspector');
    }

    public function generarReporte(){
        $this->validate();
        $services = DB::table('servicios_importados')                 
                ->select('servicios_importados.certificador', DB::raw('count(placa) as serviciosGasolution'),DB::raw('SUM(if(estado = 2, 1, 0)) AS serviciosMtg'))                        
                ->groupBy('certificador')      
                ->whereBetween('fecha',[$this->fechaInicio.' 00:00',$this->fechaFin.' 23:59'])              
        ->get(); 
        
        $this->services=$services;
    }

    public function calculaPorcentaje($total,$tiene){
        $resultado=0;
        if($tiene!=0){
            $resultado=($tiene*100)/$total;
        }
        return round($resultado,1);
    }
}
