<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Detalle;
use App\Models\Venta;
use Illuminate\Http\Request;

class DetalleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:detalles.index')->only('index');
        $this->middleware('can:detalles.create')->only('create','store');
        $this->middleware('can:detalles.edit')->only('edit','update');
        $this->middleware('can:detalles.destroy')->only('destroy');
    }
    public function validarForm(Request $request)
    {
        $request->validate([
            'cantidad' => 'required|numeric|min:0',
            'ventas_id' => 'required|numeric|min:1',
            'articulos_id' => 'required|numeric|min:1'
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        session()->flashInput($request->input());
        $detalles = Detalle::all();
        $articulos = Articulo::all();
        $ventas = Venta::all();
        return view('detalle_index', ['detalles' => $detalles, 'articulos' => $articulos, 'ventas' => $ventas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $ventas = Venta::all();
        $articulos = Articulo::all();
        return view('detalle_create', ['ventas' => $ventas, 'articulos' => $articulos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validarForm($request);
        try {
        Detalle::create($request->all());
        return redirect()->route('detalles.index')->with(['mensaje' => 'Detalle creado']);
        } catch (\Exception $e) {
            return redirect()->route('detalles.index')->with(['error' => 'Ocurrió un error al crear el detalle: '.$e->getMessage()]);
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
        $articulos = Articulo::all();
        $ventas = Venta::all();
        try {
        $detalle = Detalle::findOrFail($id);
        return view('detalle_edit', ['articulos' => $articulos, 'detalle' => $detalle, 'ventas' => $ventas]);
        } catch (\Exception $e) {
            return redirect()->route('detalles.index')->with(['error' => 'Ocurrió un error al mostrar el detalle: '.$e->getMessage()]);
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
        $detalle = Detalle::findOrFail($id);
        $detalle->update($request->all());
        return redirect()->route('detalles.index')->with(['mensaje' => 'Detalle editado']);
        } catch (\Exception $e) {
            return redirect()->route('detalles.index')->with(['error' => 'Ocurrió un error al editar el detalle: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
        $detalle = Detalle::findOrFail($id);
        $detalle->delete();
        return redirect()->route('detalles.index')->with(['mensaje' => 'Detalle eliminado']);
        } catch (\Exception $e) {
            return redirect()->route('detalles.index')->with(['error' => 'Ocurrió un error al eliminar el detalle: '.$e->getMessage()]);
        }
    }
}
