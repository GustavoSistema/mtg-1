<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentosController extends Controller
{
    public function downloadDocumentoTaller($id)
    {
        $doc=Documento::findOrFail($id);

        if($doc){
            $path=storage_path('app/'.$doc->ruta);
            return response()->download($path);            
        }else{
            return 404;
        }
    }

    public function streamDocumentoTaller($id)
    {
        $doc=Documento::findOrFail($id);

        if($doc){
            $path=storage_path('app/'.$doc->ruta);
            return response()->stream($path);            
        }else{
            return 404;
        }
    }
}
