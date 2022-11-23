<?php

use App\Http\Livewire\Expedientes;
use App\Http\Livewire\RevisionExpedientes;
use App\Http\Livewire\Servicios;
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
    return view('welcome');
});
Route::get('phpmyinfo', function () {
    phpinfo(); 
})->name('phpmyinfo');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
->group(function () {
    Route::get('/Expedientes',Expedientes::class)->name('expedientes');
    Route::get('/RevisionExpedientes',RevisionExpedientes::class)->name('revisionExpedientes');  
    Route::get('/dashboard', function (){
        return view('dashboard');
    })->name('dashboard');
});
