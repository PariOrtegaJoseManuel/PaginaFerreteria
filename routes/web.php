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
    Route::delete("detalles/{detalle}/{venta}/cantidad", "App\Http\Controllers\DetalleController@destroyVenta")->name("detalles.destroyVenta");

    Route::get("entregas/{entrega}/venta", "App\Http\Controllers\EntregaController@indexVenta")->name("entregas.indexVenta");
    Route::get("entregas/createEntrega/{ventas_id}", "App\Http\Controllers\EntregaController@createEntrega")->name("entregas.createEntrega");
    Route::post("entregas/createEntrega/{ventas_id}", "App\Http\Controllers\EntregaController@storeEntrega")->name("entregas.storeEntrega");
    Route::delete("entregas/{entrega}/{ventaId}", "App\Http\Controllers\EntregaController@destroyEntrega")->name("entregas.destroyEntrega");
    Route::get("entregas/{entrega}/{ventaId}/edit", "App\Http\Controllers\EntregaController@editEntrega")->name("entregas.editEntrega");
    Route::put("entregas/{entrega}/{ventaId}/update", "App\Http\Controllers\EntregaController@updateEntrega")->name("entregas.updateEntrega");

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
    Route::resource("entregas", "App\Http\Controllers\EntregaController");
    Route::resource("metodo_pagos", "App\Http\Controllers\MetodoPagoController");
});
