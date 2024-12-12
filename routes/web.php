<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('caratula');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get("detalles/{detalle}/venta", "App\Http\Controllers\DetalleController@indexVenta")->name("detalles.indexVenta");
    Route::get("detalles/{detalle}/{venta}/cantidad", "App\Http\Controllers\DetalleController@editVenta")->name("detalles.editVenta");
    Route::put("detalles/{detalle}/{venta}/cantidad", "App\Http\Controllers\DetalleController@updateVenta")->name("detalles.updateVenta");
    Route::get("detalles/{venta}/notaVenta", "App\Http\Controllers\DetalleController@notaVenta")->name("detalles.notaVenta");
    Route::get("detalles/createVenta/{ventas_id}", "App\Http\Controllers\DetalleController@createVenta")->name("detalles.createVenta");
    Route::post("detalles/createVenta/{ventas_id}", "App\Http\Controllers\DetalleController@storeVentaDetalle")->name("detalles.storeVenta");
    Route::get("users/{user}/password", "App\Http\Controllers\UserController@editpassword")->name("users.editpassword");
    Route::post("users/{user}/password", "App\Http\Controllers\UserController@updatepassword")->name("users.updatepassword");
    Route::get('ventas/reporteDiario', 'App\Http\Controllers\VentaController@reporteDiario')->name('ventas.reporteDiario');
    Route::get('articulos/reporteInventario', 'App\Http\Controllers\ArticuloController@reporteInventario')->name('articulos.reporteInventario');
    Route::resource('clientes', 'App\Http\Controllers\ClienteController');
    Route::resource('articulos', 'App\Http\Controllers\ArticuloController');
    Route::resource('detalles', 'App\Http\Controllers\DetalleController');
    Route::resource('unidades', 'App\Http\Controllers\UnidadController');
    Route::resource('users', 'App\Http\Controllers\UserController');
    Route::resource('ventas', 'App\Http\Controllers\VentaController');
    Route::resource("roles", "App\Http\Controllers\RoleController");
    Route::resource("categorias", "App\Http\Controllers\CategoriaController");
    Route::resource("encargos", "App\Http\Controllers\EncargoController");
    Route::resource("pagos", "App\Http\Controllers\PagoController");
    Route::resource("metodo_pagos", "App\Http\Controllers\MetodoPagoController");
});
