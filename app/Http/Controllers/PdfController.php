<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Certificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    
    public function generarFichaTecnica($id){
        if(Certificacion::findOrFail($id)){
            $certificacion=Certificacion::find($id);
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            //$fechaL=date('d').' días del mes de '.$meses[date('m')-1].' del '.date('Y').'.';              
            $chip=$certificacion->vehiculo->Equipos->where("idTipoEquipo",1)->first();           
            $equipos=$certificacion->vehiculo->Equipos->where("idTipoEquipo","!=",1)->sortBy("idTipoEquipo");                     
            //dd($equipos); 
            $hoja=$certificacion->Materiales->where('idTipoMaterial',1)->first();
            $fechaCert=$certificacion->created_at;
            $fec=$fechaCert->format("d/m/Y");
            $data=[
            "fecha"=>$fec,
            "empresa"=>"MOTORGAS COMPANY S.A.",
            "carro"=>$certificacion->Vehiculo,
            "taller"=>$certificacion->Taller,
            "servicio"=>$certificacion->Servicio, 
            "hoja"=>$hoja, 
            "equipos"=>$equipos,
            "chip"=>$chip,
            ];                 
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('fichaTecnicaGnv',$data);        
            //return $pdf->stream($id.'-'.date('d-m-Y').'-cargo.pdf');
            return  $pdf->stream($certificacion->Vehiculo->placa.'-'.$hoja->numSerie.'.pdf');
        }else{
            return abort(404);
        }

    }


}
