<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:metodo_pagos.index')->only('index');
        $this->middleware('can:metodo_pagos.create')->only('create','store');
        $this->middleware('can:metodo_pagos.edit')->only('edit','update');
        $this->middleware('can:metodo_pagos.destroy')->only('destroy');
    }
    public function validarForm(Request $request)
    {
        $request->validate([
            'metodo' => 'required|string|min:2|max:100'
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        session()->flashInput($request->input());
        $metodo_pagos = MetodoPago::all();
        return view('metodo_pago_index', ['metodo_pagos' => $metodo_pagos]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //;
        return view('metodo_pago_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validarForm($request);
        try {
        MetodoPago::create($request->all());
        return redirect()->route('metodo_pagos.index')->with(['mensaje' => 'Metodo de pago creado']);
        } catch (\Exception $e) {
            return redirect()->route('metodo_pagos.index')->with(['error' => 'Ocurrió un error al crear el metodo de pago: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
        $metodo_pago = MetodoPago::findOrFail($id);
        return view('metodo_pago_edit', ['metodo_pago' => $metodo_pago]);
        } catch (\Exception $e) {
            return redirect()->route('metodo_pagos.index')->with(['error' => 'Ocurrió un error al mostrar el metodo de pago: '.$e->getMessage()]);
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
        $metodo_pago = MetodoPago::findOrFail($id);
        $metodo_pago->update($request->all());
        return redirect()->route('metodo_pagos.index')->with(['mensaje' => 'Metodo de pago editado']);
        } catch (\Exception $e) {
            return redirect()->route('metodo_pagos.index')->with(['error' => 'Ocurrió un error al editar el metodo de pago: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        $metodo_pago = MetodoPago::findOrFail($id);
         // Verificar si tiene actividades relacionadas
        if ($metodo_pago->RelPagos()->count() > 0)
            return redirect()->route('metodo_pagos.index')->with(['error' => 'No se puede eliminar un metodo de pago con pagos relacionados']);
        if ($metodo_pago->RelDetalle()->count() > 0)
            return redirect()->route('metodo_pagos.index')->with(['error' => 'No se puede eliminar un metodo de pago con detalles relacionados']);
        $metodo_pago->delete();
        return redirect()->route('metodo_pagos.index')->with(['mensaje' => 'Metodo de pago eliminado']);
        } catch (\Exception $e) {
            return redirect()->route('metodo_pagos.index')->with(['error' => 'Ocurrió un error al eliminar el metodo de pago: '.$e->getMessage()]);
        }
    }
}
