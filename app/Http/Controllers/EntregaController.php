<?php

namespace App\Http\Controllers;

use App\Models\Encargo;
use App\Models\Entrega;
use App\Models\MetodoPago;
use App\Models\Venta;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:entregas.index')->only('index');
        $this->middleware('can:entregas.create')->only('create','store');
        $this->middleware('can:entregas.edit')->only('edit','update');
        $this->middleware('can:entregas.destroy')->only('destroy');
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

        $entregas = Entrega::all();
        $ventas = Venta::all();
        $encargos = Encargo::all();
        $metodo_pagos = MetodoPago::all();
        return view('entrega_index', ['entregas' => $entregas, 'ventas' => $ventas, 'encargos' => $encargos, 'metodo_pagos' => $metodo_pagos]);
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
        return view('entrega_create', ['ventas' => $ventas, 'encargos' => $encargos, 'metodo_pagos' => $metodo_pagos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validarForm($request);
        try {
        Entrega::create($request->all());
        return redirect()->route('entregas.index')->with(['mensaje' => 'Entrega creada']);
        } catch (\Exception $e) {
            return redirect()->route('entregas.index')->with(['error' => 'Ocurrió un error al crear la entrega: '.$e->getMessage()]);
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
        $entrega = Entrega::findOrFail($id);
        return view('entrega_edit', ['encargos' => $encargos, 'ventas' => $ventas, 'metodo_pagos' => $metodo_pagos , 'entrega' => $entrega]);
        } catch (\Exception $e) {
            return redirect()->route('entregas.index')->with(['error' => 'Ocurrió un error al mostrar la entrega: '.$e->getMessage()]);
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
        $entrega = Entrega::findOrFail($id);
        $entrega->update($request->all());
        return redirect()->route('entregas.index')->with(['mensaje' => 'Entrega editada']);
        } catch (\Exception $e) {
            return redirect()->route('entregas.index')->with(['error' => 'Ocurrió un error al editar la entrega: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
        $entrega = Entrega::findOrFail($id);
        // Verificar si tiene actividades relacionadas
        /*if ($pago->RelEncargo()->count() > 0){
            return redirect()->route('pagos.index')->with(['error' => 'No se puede eliminar un pago con encargos relacionados']);
        }
        if ($pago->RelVenta()->count() > 0){
            return redirect()->route('pagos.index')->with(['error' => 'No se puede eliminar un pago con ventas relacionadas']);
        }*/
        $entrega->delete();
        return redirect()->route('entregas.index')->with(['mensaje' => 'Entrega eliminada']);
        } catch (\Exception $e) {
        return redirect()->route('entregas.index')->with(['error' => 'Ocurrió un error al eliminar la entrega: '.$e->getMessage()]);
        }
    }
}
