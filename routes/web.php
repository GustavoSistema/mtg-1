<?php

use App\Http\Controllers\DocumentosController;
use App\Http\Livewire\AsignacionMateriales;
use App\Http\Livewire\CreateSolicitud;
use App\Http\Livewire\Expedientes;
use App\Http\Livewire\Ingresos;
use App\Http\Livewire\Inventario;
use App\Http\Livewire\RecepcionMateriales;
use App\Http\Livewire\Talleres;
use App\Http\Livewire\RevisionExpedientes;
use App\Http\Livewire\Salidas;
use App\Http\Livewire\Servicio;
use App\Http\Livewire\Servicios;
use App\Http\Livewire\Solicitud;
use App\Http\Livewire\VistaSolicitud;
use App\Models\Ingreso;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\uploadController;
use App\Http\Livewire\AdministracionCertificaciones;
use App\Http\Livewire\Arreglando;
use App\Http\Livewire\EditarTaller;
use App\Http\Livewire\ListaCertificaciones;
use App\Http\Livewire\ListaServicios;
use App\Http\Livewire\Prueba;
use App\Http\Livewire\TallerRevision;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('phpmyinfo', function () {
    phpinfo(); 
})->name('phpmyinfo');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
->group(function () {
        
    Route::get('/Expedientes',Expedientes::class)->middleware('can:expedientes')->name('expedientes');
    //Route::get('/Servicio',Servicio::class)->middleware('can:servicio')->name('servicio');
    Route::get('/Talleres',Talleres::class)->middleware('can:talleres')->name('talleres');
    Route::get('/Ingresos',Ingresos::class)->middleware('can:ingresos')->name('ingresos');
    Route::get('/Salidas',Salidas::class)->middleware('can:salidas')->name('salidas');
    Route::get('/Inventario',Inventario::class)->middleware('can:inventario')->name('inventario');
    Route::get('/Asignacion-de-materiales',AsignacionMateriales::class)->middleware('can:asignacion')->name('asignacion');
    Route::get('/Recepcion-de-materiales',RecepcionMateriales::class)->middleware('can:recepcion')->name('recepcion');
    Route::get('/Solicitud-de-materiales',Solicitud::class)->middleware('can:solicitud')->name('solicitud');
    Route::get('/Crear-solicitud',CreateSolicitud::class)->middleware('can:nuevaSolicitud')->name('nuevaSolicitud');
    Route::get('/RevisionExpedientes',RevisionExpedientes::class)->middleware('can:revisionExpedientes')->name('revisionExpedientes');  
    Route::get('/dashboard', function (){return view('dashboard');})->name('dashboard');
    Route::get('/Listado-Certificaciones',ListaCertificaciones::class)->middleware('can:certificaciones')->name('certificaciones');
    Route::get('/Administracion-de-certificaciones',AdministracionCertificaciones::class)->middleware('can:admin.certificaciones')->name('admin.certificaciones');
    Route::get('/Solicitud/{soliId}',VistaSolicitud::class)->name('vistaSolicitud');
    Route::get('/Servicio',Prueba::class)->middleware('can:servicio')->name('servicio');
    Route::get('/Solucion',Arreglando::class)->name('solucion');
    Route::get('/TalleresRevision',TallerRevision::class)->name('talleres.revision');
    Route::get('/Taller/edit/{idTaller}',EditarTaller::class)->name('editar-taller');
    

    Route::post('/Solucion/upload-images',[uploadController::class,'uploadImagesExpediente'])->name('expediente.upload-images');

    Route::get('/Taller/Documents/{id}/download',[DocumentosController::class,'downloadDocumentoTaller'])->name('download_doctaller');
    Route::get('/Taller/Documents/{id}/ver',[DocumentosController::class,'streamDocumentoTaller'])->name('stream_doctaller');
    


    //RUTAS PARA STREAM Y DESCARGA DE PDFS
    Route::controller(PdfController::class)->group(function () {
        Route::get('/certificado-anual/{id}', 'generaPdfAnualGnv')->name("certificadoAnualGnv");
        Route::get('/duplicado-anual/{id}', 'generaDuplicadoAnualGnv')->name("duplicadoAnualGnv");
        Route::get('/duplicado-anual-ex/{id}', 'generaDuplicadoExternoAnualGnv')->name("duplicadoExternoAnualGnv");

        Route::get('/certificado-anual/{id}/descargar', 'descargarPdfAnualGnv')->name("descargarCertificadoAnualGnv"); 
        Route::get('/duplicado-anual/{id}/descargar', 'descargarDuplicadoAnualGnv')->name("descargarDuplicadoAnualGnv"); 
        Route::get('/duplicado-anual-ex/{id}/descargar', 'descargarDuplicadoExternoAnualGnv')->name("descargarDuplicadoExternoAnualGnv"); 

       
        Route::get('/certificado-inicial/{id}', 'generaPdfInicialGnv')->name("certificadoInicialGnv"); 
        Route::get('/duplicado-inicial/{id}', 'generaDuplicadoInicialGnv')->name("duplicadoInicialGnv");
        Route::get('/duplicado-inicial-ex/{id}', 'generaDuplicadoExternoInicialGnv')->name("duplicadoExternoInicialGnv");

        Route::get('/certificado-inicial/{id}/descargar', 'descargarPdfInicialGnv')->name("descargarCertificadoInicialGnv");
        Route::get('/duplicado-inicial/{id}/descargar', 'descargarDuplicadoInicialGnv')->name("descargarDuplicadoInicialGnv");
        Route::get('/duplicado-inicial-ex/{id}/descargar', 'descargarDuplicadoExternoInicialGnv')->name("descargarDuplicadoExternoInicialGnv");

        Route::get('/cargo/{id}','generaCargo')->name('generaCargo');

        Route::get('/fichaTecnicaGnv/{idCert}', 'generarFichaTecnica')->name("fichaTecnicaGnv");
        Route::get('/fichaTecnicaGnv/{idCert}/download', 'descargarFichaTecnica')->name("descargarFichaTecnicaGnv");
        Route::get('/preConversionGnv/{idCert}', 'generarPreConversionGnv')->name("preConversionGnv");
        Route::get('/checkListArriba/{idCert}', 'generarCheckListArribaGnv')->name("checkListArribaGnv");
        Route::get('/checkListAbajo/{idCert}', 'generarCheckListAbajoGnv')->name("checkListAbajoGnv");    
        
        Route::get('/boletoAnalizadorDeGases/{id}', 'generaBoletoDeAnalizador')->name("analizadorGnv"); 
    });

    //RUTAS PARA STREAM Y DESCARGA DE PDFS
    /*
    Route::get("certificado-anual/{id}","App\Http\Controllers\PdfController@generaPdfAnualGnv")->name("certificadoAnualGnv");       
    Route::get("duplicado-anual/{id}","App\Http\Controllers\PdfController@generaDuplicadoAnualGnv")->name("duplicadoAnualGnv");
    Route::get("duplicado-anual-ex/{id}","App\Http\Controllers\PdfController@generaDuplicadoExternoAnualGnv")->name("duplicadoExternoAnualGnv");

    Route::get("certificado-anual/{id}/descargar","App\Http\Controllers\PdfController@descargarPdfAnualGnv")->name("descargarCertificadoAnualGnv"); 
    Route::get("duplicado-anual/{id}/descargar","App\Http\Controllers\PdfController@descargarDuplicadoAnualGnv")->name("descargarDuplicadoAnualGnv");
    Route::get("duplicado-anual-ex/{id}/descargar","App\Http\Controllers\PdfController@descargarDuplicadoExternoAnualGnv")->name("descargarDuplicadoExternoAnualGnv");
  


    Route::get("certificado-inicial/{id}","App\Http\Controllers\PdfController@generaPdfInicialGnv")->name("certificadoInicialGnv");
    Route::get("duplicado-inicial/{id}","App\Http\Controllers\PdfController@generaDuplicadoInicialGnv")->name("duplicadoInicialGnv");
    Route::get("duplicado-inicial-ex/{id}","App\Http\Controllers\PdfController@generaDuplicadoExternoInicialGnv")->name("duplicadoExternoInicialGnv");
  
    Route::get("certificado-inicial/{id}/descargar","App\Http\Controllers\PdfController@descargarPdfInicialGnv")->name("descargarCertificadoInicialGnv");
    Route::get("duplicado-inicial/{id}/descargar","App\Http\Controllers\PdfController@descargarDuplicadoInicialGnv")->name("descargaDuplicadoInicialGnv");
    Route::get("duplicado-inicial-ex/{id}/descargar","App\Http\Controllers\PdfController@descargarDuplicadoExternoInicialGnv")->name("descargaDuplicadoExternoInicialGnv");

    Route::get("fichaTecnicaGnv/{idCert}","App\Http\Controllers\PdfController@generarFichaTecnica")->name("fichaTecnicaGnv");    
    Route::get("fichaTecnicaGnv/{idCert}/download","App\Http\Controllers\PdfController@descargarFichaTecnica")->name("descargarFichaTecnicaGnv");
    Route::get("checkListArriba/{idCert}","App\Http\Controllers\PdfController@generarCheckListArribaGnv")->name("checkListArribaGnv");
    Route::get("checkListAbajo/{idCert}","App\Http\Controllers\PdfController@generarCheckListAbajoGnv")->name("checkListAbajoGnv");
    */

    Route::get("expediente-fotos/{id}/download","App\Http\Controllers\ZipController@descargaFotosExpediente")->name("descargaFotosExp");
    Route::get("Notification/{idNoti}/{idSoli}","App\Http\Controllers\NotificationController@marcarUnaNotificación")->name("leerNotificacion");

    Route::get('download/{path}', function($path) { return Illuminate\Support\Facades\Storage::download($path);})->where('path','.*');
   
    Route::get('/CargoPdf/{id}', function ($id) {
        $am= new AsignacionMateriales();
        return  $am->enviar($id);
    })->name('cargoPdf');
    
    Route::get('/Certificado/{id}', function ($id) {
        $ser= new Servicio();
        return  $ser->generaPdfAnualGnv($id);
    })->name('certificado');
    Route::get('/Certificado/{id}/download', function ($id) {
        $ser= new Servicio();
        return  $ser->descargaPdfAnualGnv($id);
    })->name('descargarCertificado');
    Route::get('/CertificadoInicial/{id}', function ($id) {
        $ser= new Servicio();
        return  $ser->generaPdfInicialGnv($id);
    })->name('certificadoInicial');  
    Route::get('/CertificadoInicial/{id}/download', function ($id) {
        $ser= new Servicio();
        return  $ser->descargaPdfInicialGnv($id);
    })->name('descargarInicial'); 
    
});
