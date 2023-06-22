<?php

namespace App\Http\Livewire\Reportes;

use App\Models\Certificacion;
use App\Models\ServiciosImportados;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReporteServiciosPorInspector extends Component
{   
    public $desde,$hasta;

    public function mount(){
        $this->desde='2023-06-01 00:00';
        $this->hasta='2023-06-05 23:59';
    }
    
    public function render()
    {
       $services = DB::table('servicios_importados')                 
                ->select('servicios_importados.certificador', DB::raw('count(placa) as serviciosGasolution'),DB::raw('SUM(if(estado = 2, 1, 0)) AS serviciosMtg'))                        
                ->groupBy('certificador')      
                ->whereBetween('fecha',[$this->desde,$this->hasta])              
                ->get();    
               //dd($services);
        return view('livewire.reportes.reporte-servicios-por-inspector',compact('services'));
    }
}
