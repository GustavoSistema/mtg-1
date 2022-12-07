<?php

namespace App\Http\Livewire;

use App\Models\Taller;
use Livewire\Component;

class Talleres extends Component
{

    public $sort;

    public function mount(){
        
    }

    public function render()
    {
        $talleres=Taller::all();
        return view('livewire.talleres',compact('talleres'));
    }

    protected $listeners=['render'];
}
