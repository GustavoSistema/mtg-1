<?php

namespace App\Http\Livewire;

use App\Models\TipoServicio;
use Livewire\Component;

class CreateTaller extends Component
{

    public $nombre,$direccion,$ruc,$servicios,$precio,$serv,$tiposervicio;

    public $open=false; 
     
    public function render()
    {
        return view('livewire.create-taller');
    }


    public function mount(){
        $this->servicios=TipoServicio::all();
    }

    public function agregaServicio(){
        $this->serv++;
        $this->emitTo('createTaller','render');
    }
    public function borraServicio(){
        $this->serv--;
        $this->emitTo('createTaller','render');
    }
}
