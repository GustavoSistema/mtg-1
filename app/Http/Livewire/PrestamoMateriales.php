<?php

namespace App\Http\Livewire;

use App\Models\Material;
use App\Models\TipoMaterial;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PrestamoMateriales extends Component
{
    public $inspectores,$inspector;
    public $estado=1;  
    public $stocks=[];
    public $articulos=[];


    public function render()
    {
        return view('livewire.prestamo-materiales');
    }

    public function mount(){
        $this->inspectores=User::role(['inspector','supervisor'])
        ->where('id','!=',Auth::id())
        ->orderBy('name')->get();
    }
   
}
