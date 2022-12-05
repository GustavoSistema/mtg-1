<?php

namespace App\Http\Livewire;

use App\Models\Taller;
use Livewire\Component;

class Talleres extends Component
{

    public $talleres,$sort;

    public function mount(){
        $this->talleres=Taller::all();
    }

    public function render()
    {
        return view('livewire.talleres');
    }
}
