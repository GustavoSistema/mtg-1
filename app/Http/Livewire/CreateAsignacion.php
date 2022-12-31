<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateAsignacion extends Component
{

    public $open=false;
    public $inspectores,$inspector;

    public function mount(){
        $this->inspectores=User::role(['inspector','supervisor'])
        //->where('id','!=',Auth::id())
        ->orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.create-asignacion');
    }
}
