<?php

namespace App\Http\Livewire;

use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RevisionInventario extends Component
{

    public $inspector,$inspectores;
    public $resultado;

    protected $rules=["inspector"=>"required|numeric|min:1"];

    public function render()
    {
        return view('livewire.revision-inventario');
    }

    public function mount(){                
        $this->inspectores=User::role(['inspector','supervisor'])
        ->where('id','!=',Auth::id())
        ->orderBy('name')->get();
        $this->resultado= new Collection();
    }

    public function consultar(){
        $this->validate();
        $this->resultado=Material::where("idUsuario",$this->inspector)->get();
    }

    
}
