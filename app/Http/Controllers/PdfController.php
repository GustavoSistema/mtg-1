<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Certificacion;
use App\Models\Duplicado;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class PdfController extends Controller
{
    
    public function generarFichaTecnica($id){
        if(Certificacion::findOrFail($id)){
            $certificacion=Certificacion::find($id);
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
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
            return  $pdf->stream("FT-".$certificacion->Vehiculo->placa.'-'.$hoja->numSerie.'.pdf');
        }else{
            return abort(404);
        }
    }

    public function descargarFichaTecnica($idCert){
        if(Certificacion::findOrFail($idCert)){
            $certificacion=Certificacion::find($idCert);                         
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
            return  $pdf->download('FT-'.$certificacion->Vehiculo->placa.'-'.$hoja->numSerie.'.pdf');
        }else{
            return abort(404);
        }
    }

    public function generarCheckListArribaGnv($idCert){
        if(Certificacion::findOrFail($idCert)){
            $certificacion=Certificacion::find($idCert);
            //$hoja=$certificacion->Materiales->where('idTipoMaterial',1)->first();    
            $hoja=$certificacion->Hoja;        
            $data=[
                'hoja'=>$hoja,
                "vehiculo"=>$certificacion->Vehiculo,
                "servicio"=>$certificacion->Servicio,
                "inspector"=>$certificacion->Inspector,
                "taller"=>$certificacion->taller,
                "fecha"=>$certificacion->created_at->format('d/m/Y'), 
                "reductor"=>$certificacion->Reductor,
                "chip"=>$certificacion->Chip,
                "cilindros"=>$certificacion->Cilindros,
                "certificacion"=>$certificacion,               
            ];
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('checkListCilindroArribaGnv',$data);        
            //return $pdf->stream($id.'-'.date('d-m-Y').'-cargo.pdf');
            return  $pdf->stream('CHKL_ARRIBA-'.$certificacion->Vehiculo->placa.'-'.$hoja->numSerie.'.pdf');
        }else{
            return abort(404);
        }
    }


    public function generarCheckListAbajoGnv($idCert){
        if(Certificacion::findOrFail($idCert)){
            $certificacion=Certificacion::find($idCert);
            //$hoja=$certificacion->Materiales->where('idTipoMaterial',1)->first();    
            $hoja=$certificacion->Hoja;        
            $data=[
                'hoja'=>$hoja,
                "vehiculo"=>$certificacion->Vehiculo,
                "servicio"=>$certificacion->Servicio,
                "inspector"=>$certificacion->Inspector,
                "taller"=>$certificacion->taller,
                "fecha"=>$certificacion->created_at->format('d/m/Y'), 
                "reductor"=>$certificacion->Reductor,
                "chip"=>$certificacion->Chip,
                "cilindros"=>$certificacion->Cilindros,
                "certificacion"=>$certificacion,               
            ];
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('checkListCilindroAbajoGnv',$data);        
            //return $pdf->stream($id.'-'.date('d-m-Y').'-cargo.pdf');
            return  $pdf->stream('CHKL_ABAJO-'.$certificacion->Vehiculo->placa.'-'.$hoja->numSerie.'.pdf');
        }else{
            return abort(404);
        }
    }


    public function generaPdfAnualGnv($id){
        if(Certificacion::findOrFail($id)){
            $certificacion=Certificacion::find($id);
            if($certificacion->Servicio->tipoServicio->id){
                if($certificacion->Servicio->tipoServicio->id==2){
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    $fechaCert=$certificacion->created_at;
                    $fecha=$fechaCert->format('d').' días del mes de '.$meses[$fechaCert->format('m')-1].' del '.$fechaCert->format('Y').'.';  
                    $hoja=$certificacion->Materiales->where('idTipoMaterial',1)->first();              
                    $data=[
                    "fecha"=>$fecha,
                    "empresa"=>"MOTORGAS COMPANY S.A.",
                    "carro"=>$certificacion->Vehiculo,
                    "taller"=>$certificacion->Taller, 
                    "hoja"=>$hoja, 
                    "fechaCert"=>$fechaCert,
                    ];                 
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadView('anualGnv',$data);        
                    return $pdf->stream($certificacion->Vehiculo->placa.'-'.$hoja->numSerie.'-anual.pdf');
                }
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }

    public function descargarPdfAnualGnv($id){
        if(Certificacion::findOrFail($id)){
            $certificacion=Certificacion::find($id);
            
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    $fechaCert=$certificacion->created_at;
                    $fecha=$fechaCert->format('d').' días del mes de '.$meses[$fechaCert->format('m')-1].' del '.$fechaCert->format('Y').'.';  
                    $hoja=$certificacion->Materiales->where('idTipoMaterial',1)->first();              
                    $data=[
                    "fecha"=>$fecha,
                    "empresa"=>"MOTORGAS COMPANY S.A.",
                    "carro"=>$certificacion->Vehiculo,
                    "taller"=>$certificacion->Taller, 
                    "hoja"=>$hoja, 
                    "fechaCert"=>$fechaCert,
                    ];                 
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadView('anualGnv',$data);        
                    return $pdf->download($certificacion->Vehiculo->placa.'-'.$hoja->numSerie.'-anual.pdf');
                
        }else{
            return abort(404);
        }
    }

    public function generaPdfInicialGnv($id){
        if(Certificacion::findOrFail($id)){
            $certificacion=Certificacion::find($id);
            if($certificacion->Servicio->tipoServicio->id){
                if($certificacion->Servicio->tipoServicio->id==1){
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    $fechaCert=$certificacion->created_at;
                    $fecha=$fechaCert->format('d').' días del mes de '.$meses[$fechaCert->format('m')-1].' del '.$fechaCert->format('Y').'.';              
                    $chip=$certificacion->vehiculo->Equipos->where("idTipoEquipo",1)->first();           
                    $equipos=$certificacion->vehiculo->Equipos->where("idTipoEquipo","!=",1)->sortBy("idTipoEquipo");                     
                    //dd($equipos); 
                    $hoja=$certificacion->Materiales->where('idTipoMaterial',1)->first();
                    $data=[
                    "fecha"=>$fecha,
                    "empresa"=>"MOTORGAS COMPANY S.A.",
                    "carro"=>$certificacion->Vehiculo,
                    "taller"=>$certificacion->Taller, 
                    "hoja"=>$hoja, 
                    "equipos"=>$equipos,
                    "chip"=>$chip,
                    "fechaCert"=>$fechaCert,
                    ];                 
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadView('conversionGnv',$data);        
                    //return $pdf->stream($id.'-'.date('d-m-Y').'-cargo.pdf');
                    return  $pdf->stream($certificacion->Vehiculo->placa.'-'.$hoja->numSerie.'-inicial.pdf');
                }
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }

    public function descargarPdfInicialGnv($id){
        if(Certificacion::findOrFail($id)){
            $certificacion=Certificacion::find($id);
           
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    $fechaCert=$certificacion->created_at;
                    $fecha=$fechaCert->format('d').' días del mes de '.$meses[$fechaCert->format('m')-1].' del '.$fechaCert->format('Y').'.';              
                    $chip=$certificacion->vehiculo->Equipos->where("idTipoEquipo",1)->first();           
                    $equipos=$certificacion->vehiculo->Equipos->where("idTipoEquipo","!=",1)->sortBy("idTipoEquipo");                     
                    //dd($equipos); 
                    $hoja=$certificacion->Materiales->where('idTipoMaterial',1)->first();
                    $data=[
                    "fecha"=>$fecha,
                    "empresa"=>"MOTORGAS COMPANY S.A.",
                    "carro"=>$certificacion->Vehiculo,
                    "taller"=>$certificacion->Taller, 
                    "hoja"=>$hoja, 
                    "equipos"=>$equipos,
                    "chip"=>$chip,
                    "fechaCert"=>$fechaCert,
                    ];                 
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadView('conversionGnv',$data);        
                    //return $pdf->stream($id.'-'.date('d-m-Y').'-cargo.pdf');
                    return  $pdf->download($certificacion->Vehiculo->placa.'-'.$hoja->numSerie.'-inicial.pdf');
               
        }else{
            return abort(404);
        }
    }

    public function generaDuplicadoAnualGnv($id){

        if(Certificacion::findOrFail($id)){
            $duplicado=Certificacion::find($id);
            $antiguo=Certificacion::find($duplicado->Duplicado->idAnterior);
            if($duplicado->Servicio->tipoServicio->id){
                if($antiguo->Servicio->tipoServicio->id==2){
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    $fechaCert=$duplicado->created_at;
                    $fechaAntiguo=$antiguo->created_at;
                    $fecha=$fechaCert->format('d').' días del mes de '.$meses[$fechaCert->format('m')-1].' del '.$fechaCert->format('Y').'.';  
                    $hoja=$duplicado->Hoja;        
                    $hojaAntiguo=$antiguo->Hoja; 
                    $data=[
                    "fecha"=>$fecha,
                    "empresa"=>"MOTORGAS COMPANY S.A.",
                    "carro"=>$duplicado->Vehiculo,
                    "taller"=>$antiguo->Taller, 
                    "hoja"=>$hoja, 
                    "fechaCert"=>$fechaCert,
                    "fechaAntiguo"=>$fechaAntiguo,
                    "hojaAntiguo"=>$hojaAntiguo,
                    ];                 
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadView('duplicadoAnualGnv',$data);        
                    return $pdf->stream($duplicado->Vehiculo->placa.'-'.$hoja->numSerie.'-duplicado-anual.pdf');
                }
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }


    public function generaDuplicadoInicialGnv($id){
        if(Certificacion::findOrFail($id)){
            $duplicado=Certificacion::find($id);
            $antiguo=Certificacion::find($duplicado->Duplicado->idAnterior);
            if($antiguo->Servicio->tipoServicio->id){
                if($antiguo->Servicio->tipoServicio->id==1){
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    $fechaCert=$duplicado->created_at;
                    $fechaAntiguo=$antiguo->created_at;
                    $fecha=$fechaCert->format('d').' días del mes de '.$meses[$fechaCert->format('m')-1].' del '.$fechaCert->format('Y').'.';              
                    $chip=$duplicado->vehiculo->Equipos->where("idTipoEquipo",1)->first();           
                    $equipos=$duplicado->vehiculo->Equipos->where("idTipoEquipo","!=",1)->sortBy("idTipoEquipo");                     
                    //dd($equipos); 
                    $hoja=$duplicado->Hoja;
                    $hojaAntiguo=$antiguo->Hoja;
 
                    $data=[
                    "fecha"=>$fecha,
                    "empresa"=>"MOTORGAS COMPANY S.A.",
                    "carro"=>$duplicado->Vehiculo,
                    "taller"=>$duplicado->Taller, 
                    "hoja"=>$hoja, 
                    "equipos"=>$equipos,
                    "chip"=>$chip,
                    "fechaAntiguo"=>$fechaAntiguo,
                    "hojaAntiguo"=>$hojaAntiguo,
                    ];                 
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadView('duplicadoInicialGnv',$data);        
                    //return $pdf->stream($id.'-'.date('d-m-Y').'-cargo.pdf');
                    return  $pdf->stream($duplicado->Vehiculo->placa.'-'.$hoja->numSerie.'-duplicado-inicial.pdf');
                }
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }


    public function generaDuplicadoExternoAnualGnv($id){
        if(Certificacion::findOrFail($id)){
            $duplicado=Certificacion::find($id);
            $dupli=Duplicado::find($duplicado->idDuplicado);
           // $fec=$dupli->fecha;
            //$hojaAntiguo=$antiguo->Hoja; 
           // dd($dupli->fecha->format("d/m/Y"));
            //dd($duplicado);
            //$antiguo=Certificacion::find($duplicado->Duplicado->idAnterior);            
                if($dupli->servicio==2){
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    $fechaCert=$duplicado->created_at;
                    //$fechaAntiguo=$antiguo->created_at;
                    $fecha=$fechaCert->format('d').' días del mes de '.$meses[$fechaCert->format('m')-1].' del '.$fechaCert->format('Y').'.';  
                    $hoja=$duplicado->Hoja;     
                    //$fec=$dupli->fecha;
                    //$hojaAntiguo=$antiguo->Hoja; 
                    
                    $data=[
                    "fecha"=>$fecha,
                    "empresa"=>"MOTORGAS COMPANY S.A.",
                    "carro"=>$duplicado->Vehiculo,
                    "taller"=>$duplicado->Duplicado->taller, 
                    "hoja"=>$hoja, 
                    "fechaCert"=>$fechaCert,
                    "fechaAntiguo"=>Carbon::parse($dupli->fecha),
                    //"hojaAntiguo"=>$hojaAntiguo,
                    ];                 
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadView('duplicadoExternoAnualGnv',$data);        
                    return $pdf->stream($duplicado->Vehiculo->placa.'-'.$hoja->numSerie.'-duplicadoEx-anual.pdf');
                }
                return abort(404);
            
        }else{
            return abort(404);
        }
    }

    public function generaDuplicadoExternoInicialGnv($id){
        if(Certificacion::findOrFail($id)){
            $duplicado=Certificacion::find($id);
            $dupli=Duplicado::find($duplicado->idDuplicado);           
                if($dupli->servicio==1){
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    $fechaCert=$duplicado->created_at;
                    //$fechaAntiguo=$antiguo->created_at;
                    $fecha=$fechaCert->format('d').' días del mes de '.$meses[$fechaCert->format('m')-1].' del '.$fechaCert->format('Y').'.';              
                    $chip=$duplicado->vehiculo->Equipos->where("idTipoEquipo",1)->first();           
                    $equipos=$duplicado->vehiculo->Equipos->where("idTipoEquipo","!=",1)->sortBy("idTipoEquipo");                     
                    //dd($equipos); 
                    $hoja=$duplicado->Hoja;
                   // $hojaAntiguo=$antiguo->Hoja;
 
                    $data=[
                    "fecha"=>$fecha,
                    "empresa"=>"MOTORGAS COMPANY S.A.",
                    "carro"=>$duplicado->Vehiculo,
                    "taller"=>$duplicado->Duplicado->taller, 
                    "hoja"=>$hoja, 
                    "equipos"=>$equipos,
                    "chip"=>$chip,
                    "fechaAntiguo"=>Carbon::parse($dupli->fecha),
                    
                    ];                 
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadView('duplicadoExternoInicialGnv',$data);        
                    //return $pdf->stream($id.'-'.date('d-m-Y').'-cargo.pdf');
                    return  $pdf->stream($duplicado->Vehiculo->placa.'-'.$hoja->numSerie.'-duplicado-inicial.pdf');
                }
                return abort(404);
            
        }else{
            return abort(404);
        }
    }


}
