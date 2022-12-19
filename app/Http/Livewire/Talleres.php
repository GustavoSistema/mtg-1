<?php

namespace App\Http\Livewire;

use App\Models\Imagen;
use App\Models\Taller;
use Livewire\Component;

class Talleres extends Component
{

    //public $sort;
    //public $files=[];
    public $index;

    public function mount(){
      $this->index=359;   
    }

    public function render()
    {
        $files=Imagen::where('Expediente_idExpediente','=',359)->whereIn('extension',['jpg','jpeg','png','gif','tif','tiff','bmp'])->get();
        //$talleres=Taller::all();
        return view('livewire.talleres',compact('files'));
    }

    protected $listeners=['render'];
}
