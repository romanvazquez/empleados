<?php

use App\Http\Livewire\Users;
use App\Http\Livewire\Empleados;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('home');
    })->name('home');

    Route::get('usuarios', Users::class)->name('usuarios');

    Route::get('empleados', Empleados::class)->name('empleados');
});
