<?php

namespace App\Http\Livewire;

use App\Models\Certificacion;
use Livewire\Component;

class ResumenServicios extends Component
{
    public $servicios,$total;

    public array $dataset = [];
    public array $labels = [];  
    public array $colores = [];  

    public function mount(){
        $this->servicios=Certificacion::all()->count();
        $this->total=Certificacion::sum("precio");        
    }



    public function render()
    {        
        return view('livewire.resumen-servicios');
    }
}
