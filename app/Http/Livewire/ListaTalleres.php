<?php

namespace App\Http\Livewire;

use App\Models\Taller;
use Livewire\Component;

class ListaTalleres extends Component
{
    public $talleres;

    public function mount(){
        $this->talleres=Taller::all();
    }

    public function render()
    {
        return view('livewire.lista-talleres');
    }
}
