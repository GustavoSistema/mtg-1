<?php

namespace App\Http\Livewire;

use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PharIo\Manifest\Author;

class Inventario extends Component
{

    public $consumidosGnv,$disponiblesGnv,$anuladoGnv,$todos;


    public function mount(){
        $this->todos=Material::where([
            ['estado',3], //FORMATOS EN STOCK
            ['idUsuario',Auth::id()],
            ])->get();
        $this->listaStock();
    }
    
    public function render()
    {   
        return view('livewire.inventario');
    }


    public function listaStock(){
        $user=Auth::user();
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
        $this->anuladoGnv=Material::where([
            ['estado',5], //FORMATOS ANULADOS
            ['idUsuario',Auth::id()],
            ['idTipoMaterial',1],
            ])
            ->count();
    }
}
