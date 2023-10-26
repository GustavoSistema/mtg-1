<?php

namespace App\Traits;

use App\Models\Certificacion;
use App\Models\Documento;
use App\Models\Expediente;
use App\Models\Imagen;
use DateTime;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

trait docTallerTrait
{
    public function listaDocumentos(){
        $docs=Documento::all();
        
        return $docs;
    }

    public function listaDocumentosProximosVencer(){
        $prox=now()->addMonth();
        $docs=Documento::
        whereBetween('fechaExpiracion', [now()->format('Y-m-d'), $prox->format('Y-m-d')])
        //->where('estadoDocumento',1)
        ->get();

        return $docs;
    }

    public function listaDocumentosVencidos(){
        $hoy=now()->format('Y-m-d');
        $documentosVencidos=null;
        $docs=Documento::where('estadoDocumento',1)->whereDate('fechaExpiracion', '<=', now()->format('Y-m-d'))->get();
        if( count($docs)){
            $documentosVencidos=$docs;
        }
        return $documentosVencidos;
    }

    public function cambiaEstadoDocumentos(){
        Documento::
        whereDate('fechaExpiracion', '<=', now()->format('Y-m-d'))
        ->where('estadoDocumento',1)
        ->update(['estadoDocumento'=>2]);
    }







}
