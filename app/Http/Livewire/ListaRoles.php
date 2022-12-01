<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Roles;



class ListaRoles extends Component
{
    public $roles;

    public function mount(){
       $this->roles=Roles::all();
    }

    
    public function render()
    {
        return view('livewire.lista-roles');
    }
}
