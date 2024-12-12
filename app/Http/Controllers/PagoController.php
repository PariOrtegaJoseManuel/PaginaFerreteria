<?php

namespace App\Http\Controllers;

use App\Models\Encargo;
use App\Models\MetodoPago;
use App\Models\Pago;
use App\Models\Venta;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:pagos.index')->only('index');
        $this->middleware('can:pagos.create')->only('create','store');
        $this->middleware('can:pagos.edit')->only('edit','update');
        $this->middleware('can:pagos.destroy')->only('destroy');
    }
    public function validarForm(Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date|before_or_equal:today',
            'metodo_pagos_id' => 'required|numeric|min:1',
            'encargos_id' => 'nullable|numeric|min:1',
            'ventas_id' => 'required|numeric|min:1'
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pagos = Pago::all();
        $ventas = Venta::all();
        $encargos = Encargo::all();
        $metodo_pagos = MetodoPago::all();
        return view('pago_index', ['pagos' => $pagos, 'ventas' => $ventas, 'encargos' => $encargos, 'metodo_pagos' => $metodo_pagos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $ventas = Venta::all();
        $encargos = Encargo::all();
        $metodo_pagos = MetodoPago::all();
        return view('pago_create', ['ventas' => $ventas, 'encargos' => $encargos, 'metodo_pagos' => $metodo_pagos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validarForm($request);
        try {
        Pago::create($request->all());
        return redirect()->route('pagos.index')->with(['mensaje' => 'Pago creado']);
        } catch (\Exception $e) {
            return redirect()->route('pagos.index')->with(['error' => 'Ocurrió un error al crear el pago: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
        $encargos = Encargo::all();
        $ventas = Venta::all();
        $metodo_pagos = MetodoPago::all();
        try {
        $pago = Pago::findOrFail($id);
        return view('pago_edit', ['encargos' => $encargos, 'ventas' => $ventas, 'metodo_pagos' => $metodo_pagos , 'pago' => $pago]);
        } catch (\Exception $e) {
            return redirect()->route('pagos.index')->with(['error' => 'Ocurrió un error al mostrar el pago: '.$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        //
        $this->validarForm($request);
        try {
        $pago = Pago::findOrFail($id);
        $pago->update($request->all());
        return redirect()->route('pagos.index')->with(['mensaje' => 'Pago editado']);
        } catch (\Exception $e) {
            return redirect()->route('pagos.index')->with(['error' => 'Ocurrió un error al editar el pago: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
        $pago = Pago::findOrFail($id);
        // Verificar si tiene actividades relacionadas
        /*if ($pago->RelEncargo()->count() > 0){
            return redirect()->route('pagos.index')->with(['error' => 'No se puede eliminar un pago con encargos relacionados']);
        }
        if ($pago->RelVenta()->count() > 0){
            return redirect()->route('pagos.index')->with(['error' => 'No se puede eliminar un pago con ventas relacionadas']);
        }*/
        $pago->delete();
        return redirect()->route('pagos.index')->with(['mensaje' => 'Pago eliminado']);
        } catch (\Exception $e) {
            return redirect()->route('pagos.index')->with(['error' => 'Ocurrió un error al eliminar el pago: '.$e->getMessage()]);
        }
    }
}
