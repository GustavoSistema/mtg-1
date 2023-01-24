<?php

namespace App\Http\Livewire;

use App\Models\Material;
use App\Models\Solicitud as ModelSolicitud;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Solicitud extends Component
{

    

    public function render()
    {
        $solicitudes=ModelSolicitud::all();
        return view('livewire.solicitud',compact("solicitudes"));
    }
}
