<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UserController;

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
});

Route::resource('/perfil', PerfilController::class)->names('perfil');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', function () {
    echo "admin";
})->middleware('role:admin');

Route::resource('users', UserController::class)->names('users');
