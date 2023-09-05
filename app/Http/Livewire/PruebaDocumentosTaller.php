<?php

namespace App\Http\Livewire;

use App\Traits\docTallerTrait;
use Livewire\Component;

class PruebaDocumentosTaller extends Component
{
    use docTallerTrait;

    public function render()
    {
        $docs=$this->listaDocumentosVencidos();
        return view('livewire.prueba-documentos-taller',compact('docs'));
    }

    public function cambiar(){
        $this->emit("CustomAlert", ["titulo" => "ERROR", "mensaje" => "Número de serie no válido.", "icono" => "error"]);
    }
}
