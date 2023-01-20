<?php
use App\Http\Livewire\AsignacionMateriales;
use App\Http\Livewire\Expedientes;
use App\Http\Livewire\Ingresos;
use App\Http\Livewire\Inventario;
use App\Http\Livewire\RecepcionMateriales;
use App\Http\Livewire\Talleres;
use App\Http\Livewire\RevisionExpedientes;
use App\Http\Livewire\Salidas;
use App\Http\Livewire\Servicio;
use App\Http\Livewire\Servicios;
use App\Models\Ingreso;
use Illuminate\Support\Facades\Route;

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
    Route::get('/Servicio',Servicio::class)->name('servicio');
    Route::get('/Talleres',Talleres::class)->name('talleres');
    Route::get('/Ingresos',Ingresos::class)->name('ingresos');
    Route::get('/Salidas',Salidas::class)->name('salidas');
    Route::get('/Inventario',Inventario::class)->name('inventario');
    Route::get('/CargoPdf/{id}', function ($id) {
        $am= new AsignacionMateriales();
        return  $am->enviar($id);
    })->name('cargoPdf');
    Route::get('/Certificado/{id}', function ($id) {
        $ser= new Servicio();
        return  $ser->generaPdfAnualGnv($id);
    })->name('certificado');
    Route::get('/CertificadoInicial/{id}', function ($id) {
        $ser= new Servicio();
        return  $ser->generaPdfInicialGnv($id);
    })->name('certificadoInicial');
    Route::get('/Asignacion-de-materiales',AsignacionMateriales::class)->name('asignacion');
    Route::get('/Recepcion-de-materiales',RecepcionMateriales::class)->name('recepcion');
    Route::get('/RevisionExpedientes',RevisionExpedientes::class)->middleware('can:revisionExpedientes')->name('revisionExpedientes');  
    Route::get('/dashboard', function (){return view('dashboard');})->name('dashboard');
    Route::get('download/{path}', function($path) { return Illuminate\Support\Facades\Storage::download($path);})->where('path','.*');
});
