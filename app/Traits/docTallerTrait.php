<?php

namespace App\Traits;

use App\Models\Certificacion;
use App\Models\Documento;
use App\Models\Expediente;
use App\Models\Imagen;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

trait docTallerTrait
{

    public function listaDocumentosVencidos(){
        //$hoy=now()->format('Y-m-d');
        $documentosVencidos=null;
        $docs=Documento::where('estadoDocumento',1)->whereDate('fechaExpiracion', '<=', now()->format('Y-m-d'))->get();
        if( count($docs)){
            $documentosVencidos=$docs;
        }
        return $documentosVencidos;
    }

    public function cambiaEstadoDocumentos($lista){
        foreach($lista as $doc){
            $doc->update(['estado',2]);
        }
    }

}
