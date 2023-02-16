<?php

namespace App\Http\Livewire;

use App\Models\Salida;
use Livewire\Component;
use Livewire\WithPagination;

class Salidas extends Component
{

    use WithPagination;
        
    public function render()
    {
        $salidas=Salida::all();
        return view('livewire.salidas',compact("salidas"));
    }

    
}
