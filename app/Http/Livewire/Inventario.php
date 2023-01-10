<?php

namespace App\Http\Livewire;

use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PharIo\Manifest\Author;

class Inventario extends Component
{
    
    public function render()
    {
        $materiales=Material::where([
            ['estado',3],
            ['idUsuario',Auth::id()],
            ['idTipoMaterial',3],
            ])
            ->get();       

        return view('livewire.inventario',compact('materiales'));
    }
}
