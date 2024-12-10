<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get("users/{user}/password","App\Http\Controllers\UserController@editpassword")->name("users.editpassword");
    Route::post("users/{user}/password","App\Http\Controllers\UserController@updatepassword")->name("users.updatepassword");
    Route::resource('clientes', 'App\Http\Controllers\ClienteController');
    Route::resource('articulos', 'App\Http\Controllers\ArticuloController');
    Route::resource('detalles', 'App\Http\Controllers\DetalleController');
    Route::resource('unidades', 'App\Http\Controllers\UnidadController');
    Route::resource('users', 'App\Http\Controllers\UserController');
    Route::resource('ventas', 'App\Http\Controllers\VentaController');
});

