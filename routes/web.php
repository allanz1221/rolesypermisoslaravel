<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\HomeController;



use App\Http\Controllers\ManualController;
use App\Http\Controllers\TutoriaController;
use App\Http\Controllers\PasaController;
use App\Http\Controllers\EgresadoController;
use App\Http\Controllers\Impresora3DController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ServicioSocialController;
use App\Http\Controllers\PracticaProfesionalController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PracticaCampoController;
use App\Http\Controllers\MercadoLibreController;
use App\Http\Controllers\MaterialSolicitudController;


Route::resource('materials', MaterialController::class)->middleware('auth');
Route::resource('requests', RequestController::class)->middleware('auth');
Route::get('/materiales/search', [HomeController::class, 'search'])->name('materials.search');
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

Route::get('/manuales', [ManualController::class, 'index'])->name('manuales');
Route::get('/tutorias', [TutoriaController::class, 'index'])->name('tutorias');

Route::get('/', [HomeController::class, 'index'])->name('index')->middleware('auth');

Route::resource('/perfil', PerfilController::class)->names('perfil');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', function () {
    echo "admin";
})->middleware('role:admin');

Route::resource('users', UserController::class)->names('users');


Route::patch('/requests/{request}/change-status/{newStatus}', [RequestController::class, 'changeStatus'])
    ->name('requests.changeStatus')
    ->middleware('auth');


Route::get('/manuales', [ManualController::class, 'index'])->name('manuales');
Route::get('/tutorias', [TutoriaController::class, 'index'])->name('tutorias');
Route::get('/pasa', [PasaController::class, 'index'])->name('pasa');
Route::get('/egresados', [EgresadoController::class, 'index'])->name('egresados');
Route::get('/impresoras3d', [Impresora3DController::class, 'index'])->name('impresoras3d');
Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios');
Route::get('/servicio-social', [ServicioSocialController::class, 'index'])->name('servicio-social');
Route::get('/practicas-profesionales', [PracticaProfesionalController::class, 'index'])->name('practicas-profesionales');
Route::get('/notas', [NotaController::class, 'index'])->name('notas');
Route::get('/practicas-de-campo', [PracticaCampoController::class, 'index'])->name('practicas-de-campo');
Route::get('/mercado-libre', [MercadoLibreController::class, 'index'])->name('mercado-libre');
Route::get('/solicitudes-material', [MaterialSolicitudController::class, 'index'])->name('solicitudes-material');