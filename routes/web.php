<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RequestController;

Route::resource('materials', MaterialController::class)->middleware('auth');
Route::resource('requests', RequestController::class)->middleware('auth');
Route::get('/materiales/search', [MaterialController::class, 'search'])->name('materials.search');
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
    return view('index');
})->middleware('auth');

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