<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Detalle;
use App\Models\MetodoPago;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DetalleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:detalles.index')->only('index','indexVenta','notaVenta');
        $this->middleware('can:detalles.create')->only('create','store','createVentaDetalle','storeVentaDetalle');
        $this->middleware('can:detalles.edit')->only('edit','update','editVenta','updateVenta');
        $this->middleware('can:detalles.destroy')->only('destroy','destroyVenta');
    }
    public function validarForm(Request $request)
    {
        $request->validate([
            'cantidad' => 'required|numeric|min:1',
            'ventas_id' => 'required|numeric|min:1',
            'articulos_id' => 'required|numeric|min:1'
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalles = Detalle::all();
        $articulos = Articulo::all();
        $ventas = Venta::all();
        $metodo_pagos = MetodoPago::all();
        return view('detalle_index', ['detalles' => $detalles, 'articulos' => $articulos, 'metodo_pagos' => $metodo_pagos ,'ventas' => $ventas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $ventas = Venta::all();
        $articulos = Articulo::all();
        $metodo_pagos = MetodoPago::all();
        return view('detalle_create', ['ventas' => $ventas, 'articulos' => $articulos,'metodo_pagos' => $metodo_pagos]);
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


    public function edit(string $id)
    {
        //
        $articulos = Articulo::all();
        $ventas = Venta::all();
        $metodo_pagos = MetodoPago::all();
        try {
        $detalle = Detalle::findOrFail($id);
        return view('detalle_edit', ['articulos' => $articulos, 'detalle' => $detalle, 'metodo_pagos' => $metodo_pagos ,'ventas' => $ventas]);
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
    public function indexVenta(string $ventaId)
    {
        $ventaId = $ventaId;
        $venta = Venta::findOrFail($ventaId);
        $metodo_pagos = MetodoPago::all();
        $articulos = Articulo::all();
        $detalles = $venta->relDetalle; // Asumiendo que tienes una relación definida
        return view('detalleVenta_index', compact('venta', 'detalles', 'metodo_pagos', 'articulos'));
    }
    public function editVenta(string $id, string $ventaId)
    {
        $direccion = $ventaId;
        try {
            $detalle = Detalle::find($id);
            $metodo_pagos = MetodoPago::all();
            return view("detalle_cantidad", ["detalle" => $detalle, "ventaId" => $ventaId, "metodo_pagos" => $metodo_pagos]);
        } catch (\Exception $e) {
            $detalle = Detalle::find($id);
            return redirect()->route('detalles.indexVenta', $direccion)->with(['error' => 'Ocurrió un error al mostrar la cantidad: ' . $e->getMessage()]);
        }
    }
    public function updateVenta(Request $request, string $id, string $ventaId)
    {
        $direccion = $ventaId;
        $request->validate([
            "cantidad" => "required|numeric|min:1",
            "metodo_pagos_id" => "required|numeric|min:1"
        ]);

        try {
            $detalle = Detalle::find($id);
            $articulo = Articulo::find($detalle->articulos_id);

            // Calcular la diferencia de cantidad
            $diferencia = $request->cantidad - $detalle->cantidad;

            // Verificar si hay suficiente stock para el incremento
            if ($diferencia > 0 && $articulo->cantidad < $diferencia) {
                return back()->with('error', 'No hay suficiente stock. Stock disponible: ' . $articulo->cantidad);
            }

            // Actualizar el stock del artículo
            $articulo->cantidad -= $diferencia;
            $articulo->save();

            // Actualizar el detalle
            $detalle->cantidad = $request->cantidad;
            $detalle->metodo_pagos_id = $request->metodo_pagos_id;
            $detalle->save();

            return redirect()->route("detalles.indexVenta", $direccion)
                ->with(["mensaje" => "Cantidad modificada"]);
        } catch (\Exception $e) {
            return redirect()->route('detalles.indexVenta', $direccion)
                ->with(['error' => 'Ocurrió un error al modificar la cantidad: ' . $e->getMessage()]);
        }
    }

    public function createVentaDetalle(string $ventaId)
    {
        try {
            // Busca la venta específica por ID o lanza una excepción si no existe
            $venta = Venta::findOrFail($ventaId);
            // Obtiene todos los artículos disponibles de la base de datos
            $articulos = Articulo::all();
            $metodo_pagos = MetodoPago::all();
            // Retorna la vista detalle_createVenta pasando la venta y artículos como datos
            return view('detalle_createVenta', ['venta' => $venta, 'articulos' => $articulos, 'metodo_pagos' => $metodo_pagos]);
        } catch (\Exception $e) {
            return redirect()->route('ventas.indexVenta', $ventaId)->with(['error' => 'Error al cargar el formulario: ' . $e->getMessage()]);
        }
    }

    public function storeVentaDetalle(Request $request, string $ventasid)
    {
        $request->validate([
            'cantidad' => 'required|numeric|min:1',
            'articulos_id' => 'required|exists:articulos,id',
            'metodo_pagos_id' => 'required|exists:metodo_pagos,id'
        ]);

        try {
            // Obtener el artículo
            $articulo = Articulo::findOrFail($request->articulos_id);

            // Verificar si hay suficiente stock
            if ($articulo->cantidad < $request->cantidad) {
                return redirect()->back()->with([
                    'error' => 'No hay suficiente stock. Stock disponible: ' . $articulo->cantidad
                ]);
            }

            // Crear el detalle
            Detalle::create([
                'cantidad' => $request->cantidad,
                'articulos_id' => $request->articulos_id,
                'ventas_id' => $ventasid,
                'metodo_pagos_id' => $request->metodo_pagos_id
            ]);

            // Actualizar el stock del artículo
            $articulo->cantidad -= $request->cantidad;
            $articulo->save();

            return redirect()->route('detalles.indexVenta', ['detalle' => $ventasid])
                ->with(['mensaje' => 'Detalle creado exitosamente']);

        } catch (\Exception $e) {
            return redirect()->route('detalles.indexVenta', ['detalle' => $ventasid])
                ->with(['error' => 'Error al crear el detalle: ' . $e->getMessage()]);
        }
    }

    public function createVenta($ventaId)
    {
        try {
            $venta = Venta::findOrFail($ventaId);
            $articulos = Articulo::all();
            $metodo_pagos = MetodoPago::all();
            return view('detalle_createVenta', ['articulos' => $articulos, 'venta' => $venta, 'metodo_pagos' => $metodo_pagos]);
        } catch (\Exception $e) {
            return redirect()->route('ventas.index')->with(['error' => 'Error al cargar el formulario: ' . $e->getMessage()]);
        }
    }

    public function destroyVenta(string $id, string $ventaId)
    {
        //
        try {
        $detalle = Detalle::findOrFail($id);
        $detalle->delete();
        return redirect()->route('detalles.indexVenta', $ventaId)->with(['mensaje' => 'Detalle eliminado']);
        } catch (\Exception $e) {
            return redirect()->route('detalles.indexVenta', $ventaId)->with(['error' => 'Ocurrió un error al eliminar el detalle: '.$e->getMessage()]);
        }
    }
    public function notaVenta(string $id)
    {
        // Recibe el ID de la venta como parámetro
        $ventaId = $id;

        // Busca la venta en la base de datos o lanza excepción si no existe
        $venta = Venta::findOrFail($ventaId);

        // Obtiene los detalles relacionados a la venta
        $detalles = $venta->relDetalle;

        // Obtiene todos los artículos
        $articulos = Articulo::all();

        // Crea una instancia del generador de PDF
        $pdf = App::make("dompdf.wrapper");

        // Carga la vista detalle_notaVenta con los datos
        $pdf->loadView("detalle_notaVenta", [
            "detalles" => $detalles,
            "venta" => $venta,
            "articulos" => $articulos
        ]);

        // Configura el PDF en tamaño carta y orientación vertical
        $pdf->setPaper("letter", "portrait")->setWarnings(false);

        // Retorna el PDF para visualización en el navegador
        return $pdf->stream();
    }
}
