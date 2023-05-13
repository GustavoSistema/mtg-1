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
             //FORMATOS EN STOCK
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

        $disGnv=$this->todos->where("idTipoMaterial",1)->where("estado",3);
        $consuGnv=$this->todos->where("idTipoMaterial",1)->where("estado",4);
        $anulGnv=$this->todos->where("idTipoMaterial",1)->where("estado",5);       
        
        $this->disponiblesGnv=$disGnv->count();
        $this->consumidosGnv=$consuGnv->count();
        $this->anuladoGnv=$anulGnv->count();      
    }

    
}
