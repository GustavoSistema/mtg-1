<?php

namespace App\Http\Livewire;

use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PharIo\Manifest\Author;

class Inventario extends Component
{

    public $consumidosGnv,$disponiblesGnv;


    public function mount(){
        $this->disponiblesGnv=Material::where([
            ['estado',3], //FORMATOS EN STOCK
            ['idUsuario',Auth::id()],
            ['idTipoMaterial',1],
            ])
            ->count();
        $this->consumidosGnv=Material::where([
            ['estado',4], //FORMATOS CONSUMIDOS
            ['idUsuario',Auth::id()],
            ['idTipoMaterial',1],
            ])
            ->count();
    }
    
    public function render()
    {
        $materiales=Material::where([
            ['estado',3],
            ['idUsuario',Auth::id()],
            ['idTipoMaterial',1],
            ])
            ->get();       

        return view('livewire.inventario');
    }
}
