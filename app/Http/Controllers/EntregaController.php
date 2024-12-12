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
            'total' => 'nullable|numeric|min:0',
            'precio' => 'required|numeric|min:0',
            'fecha_pago' => 'nullable|date|before_or_equal:today',
            'metodo_pagos_id' => 'required|numeric|min:1',
            'encargos_id' => 'required|numeric|min:1',
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
            $encargo = Encargo::find($request->encargos_id);
            $venta = Venta::find($request->ventas_id);

            $total = $request->precio * $encargo->cantidad;
            $request->merge([
                'total' => $total,
                'fecha_pago' => $venta->fecha
            ]);
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

    public function indexVenta(string $ventaId)
    {
        try {
            // Buscar la venta
            $venta = Venta::findOrFail($ventaId);

            // Obtener las entregas relacionadas con esta venta
            $entregas = Entrega::where('ventas_id', $ventaId)->get();

            // Si no hay entregas, inicializar como array vacío para evitar el error
            if ($entregas->isEmpty()) {
                $entregas = collect([]);
            }

            return view('entregaVenta_index', ['venta' => $venta, 'entregas' => $entregas]);
        } catch (\Exception $e) {
            return redirect()->route('ventas.index')
                ->with(['error' => 'Error al cargar las entregas: ' . $e->getMessage()]);
        }
    }

    public function editEntrega(string $id, string $ventaId)
    {
        try {
            $entrega = Entrega::findOrFail($id);
            $metodo_pagos = MetodoPago::all();
            return view("entrega_precio", ["entrega" => $entrega, "ventaId" => $ventaId, "metodo_pagos" => $metodo_pagos]);
        } catch (\Exception $e) {
            return redirect()->route('entregas.indexEntrega', $ventaId)->with(['error' => 'Ocurrió un error al mostrar la entrega: ' . $e->getMessage()]);
        }
    }

    public function updateEntrega(Request $request, string $id, string $ventaId)
    {
        $request->validate([
            "precio" => "required|numeric|min:1",
            "metodo_pagos_id" => "required|numeric|min:1"
        ]);

        try {
            $entrega = Entrega::findOrFail($id);
            $encargo = Encargo::findOrFail($entrega->encargos_id);
            // Actualizar la entrega
            $entrega->precio = $request->precio;
            $entrega->total = $request->precio * $encargo->cantidad;
            $entrega->metodo_pagos_id = $request->metodo_pagos_id;
            $entrega->save();

            return redirect()->route("entregas.indexVenta", $ventaId)
                ->with(["mensaje" => "Entrega modificada"]);
        } catch (\Exception $e) {
            return redirect()->route('entregas.indexVenta', $ventaId)
                ->with(['error' => 'Ocurrió un error al modificar la entrega: ' . $e->getMessage()]);
        }
    }

    public function createEntrega(string $ventaId)
    {
        try {
            $venta = Venta::findOrFail($ventaId);
            $encargos = Encargo::all();
            $metodo_pagos = MetodoPago::all();
            return view('entrega_createVenta', ['venta' => $venta, 'encargos' => $encargos, 'metodo_pagos' => $metodo_pagos]);
        } catch (\Exception $e) {
            return redirect()->route('entregas.indexVenta', $ventaId)->with(['error' => 'Error al cargar el formulario: ' . $e->getMessage()]);
        }
    }

    public function storeEntrega(Request $request, string $ventaId)
    {
        $request->validate([
            'precio' => 'required|numeric|min:1',
            'encargos_id' => 'required|exists:encargos,id',
            'metodo_pagos_id' => 'required|exists:metodo_pagos,id'
        ]);

        try {
            $encargo = Encargo::findOrFail($request->encargos_id);
            $venta = Venta::findOrFail($ventaId);
            Entrega::create([
                'precio' => $request->precio,
                'encargos_id' => $request->encargos_id,
                'ventas_id' => $ventaId,
                'total' => $request->precio * $encargo->cantidad,
                'fecha_pago' => $venta->fecha,
                'metodo_pagos_id' => $request->metodo_pagos_id
            ]);



            return redirect()->route('entregas.indexVenta', $ventaId)
                ->with(['mensaje' => 'Entrega creada exitosamente']);

        } catch (\Exception $e) {
            return redirect()->route('entregas.indexVenta', $ventaId)
                ->with(['error' => 'Error al crear la entrega: ' . $e->getMessage()]);
        }
    }

    public function destroyEntrega(string $id, string $ventaId)
    {
        try {
            $entrega = Entrega::findOrFail($id);
            $entrega->delete();
            return redirect()->route('entregas.indexVenta', $ventaId)->with(['mensaje' => 'Entrega eliminada']);
        } catch (\Exception $e) {
            return redirect()->route('entregas.indexVenta', $ventaId)->with(['error' => 'Ocurrió un error al eliminar la entrega: '.$e->getMessage()]);
        }
    }

}
