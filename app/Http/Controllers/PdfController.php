<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Certificacion;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    
    public function generarPdfAnualGnv($id){
        if(Certificacion::findorfail($id)){

        }
    }


}
