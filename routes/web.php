<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get("detalles/{detalle}/venta", "App\Http\Controllers\DetalleController@indexVenta")->name("detalles.indexVenta");
    Route::get("detalles/{detalle}/{venta}/cantidad", "App\Http\Controllers\DetalleController@editVenta")->name("detalles.editVenta");
    Route::put("detalles/{detalle}/{venta}/cantidad", "App\Http\Controllers\DetalleController@updateVenta")->name("detalles.updateVenta");
    //Route::get("detalles/createVenta", "App\Http\Controllers\DetalleController@createVenta")->name("detalles.createVenta");
    //Route::post("detalles/createVenta", "App\Http\Controllers\DetalleController@storeVenta")->name("detalles.storeVenta");
    Route::get("detalles/createVenta/{ventas_id}", "App\Http\Controllers\DetalleController@createVenta")->name("detalles.createVenta");
    Route::post("detalles/createVenta/{ventas_id}", "App\Http\Controllers\DetalleController@storeVentaDetalle")->name("detalles.storeVenta");
    Route::get("users/{user}/password", "App\Http\Controllers\UserController@editpassword")->name("users.editpassword");
    Route::post("users/{user}/password", "App\Http\Controllers\UserController@updatepassword")->name("users.updatepassword");
    Route::resource('clientes', 'App\Http\Controllers\ClienteController');
    Route::resource('articulos', 'App\Http\Controllers\ArticuloController');
    Route::resource('detalles', 'App\Http\Controllers\DetalleController');
    Route::resource('unidades', 'App\Http\Controllers\UnidadController');
    Route::resource('users', 'App\Http\Controllers\UserController');
    Route::resource('ventas', 'App\Http\Controllers\VentaController');
});
