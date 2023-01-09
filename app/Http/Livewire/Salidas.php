<?php

namespace App\Http\Livewire;

use App\Models\Salida;
use Livewire\Component;

class Salidas extends Component
{
        
    public function render()
    {
        $salidas=Salida::all();
        return view('livewire.salidas',compact("salidas"));
    }

    
}
