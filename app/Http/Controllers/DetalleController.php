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
    public function indexVenta($ventaId)
    {
        $venta = Venta::findOrFail($ventaId);
        $detalles = $venta->relDetalle; // Asumiendo que tienes una relación definida
        return view('detalleVenta_index', compact('venta', 'detalles'));
    }
    public function editVenta(string $id)
    {
        try {
            $detalle = Detalle::find($id);
            return view("detalle_cantidad", ["detalle" => $detalle]);
        } catch (\Exception $e) {
            $detalle = Detalle::find($id);
            return redirect()->route('detalles.index')->with(['error' => 'Ocurrió un error al mostrar la cantidad: ' . $e->getMessage()]);
        }
    }
    public function updateVenta(Request $request, string $id)
    {
        $request->validate([
            "cantidad"=>"required|numeric|min:1"
        ]);
        try {
            $detalle = Detalle::find($id);
            $detalle->cantidad = $request->cantidad;
            $detalle->save();
            return redirect()->route("detalles.index")
            ->with(["mensaje"=>"Cantidad modificada"]);
        } catch (\Exception $e) {
            return redirect()->route('detalles.index')->with(['error' => 'Ocurrió un error al modificar la cantidad: ' . $e->getMessage()]);
        }
    }
    public function createVenta()
    {
        //
        // Este código obtiene todos los artículos disponibles
        $articulos = Articulo::all();

        // Busca la venta específica usando el ID que viene en la petición
        // Si no encuentra la venta, lanzará una excepción 404
        $venta = Venta::findOrFail(request()->ventas_id);

        // Retorna la vista detalle_createVenta pasando la venta y los artículos
        // como variables disponibles para la plantilla
        return view('detalle_createVenta', ['venta' => $venta, 'articulos' => $articulos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeVenta(Request $request)
    {
        //
        $request->validate([
            'cantidad' => 'required|numeric|min:1',
            'articulos_id' => 'required|exists:articulos,id'
        ]);
        try {
            Detalle::create([
                'cantidad' => $request->cantidad,         // Almacena la cantidad del detalle que viene del formulario
                'articulos_id' => $request->articulos_id, // Almacena el ID del artículo seleccionado en el formulario
                'ventas_id' => request()->ventas_id      // Almacena el ID de la venta que viene como parámetro en la URL
            ]);
            return redirect()->route('detalles.index')->with(['mensaje' => 'Detalle creado']);
        } catch (\Exception $e) {
            return redirect()->route('detalles.index')->with(['error' => 'Ocurrió un error al crear el detalle: '.$e->getMessage()]);
        }
    }
    public function createVentaDetalle($ventas_id)
    {
        try {
            // Obtener todos los artículos disponibles
            $articulos = Articulo::all();

            // Buscar la venta específica
            $venta = Venta::findOrFail($ventas_id);

            // Retornar vista con los datos
            return view('detalle_create', [
                'articulos' => $articulos,
                'venta' => $venta,
                'ventas_id' => $ventas_id
            ]);

        } catch (\Exception $e) {
            return redirect()->route('detalles.index')
                ->with(['error' => 'Error al cargar el formulario: ' . $e->getMessage()]);
        }
    }

    public function storeVentaDetalle(Request $request, $ventas_id)
    {
        $request->validate([
            'cantidad' => 'required|numeric|min:1',
            'articulos_id' => 'required|exists:articulos,id'
        ]);

        try {
            Detalle::create([
                'cantidad' => $request->cantidad,
                'articulos_id' => $request->articulos_id,
                'ventas_id' => $ventas_id
            ]);

            return redirect()->route('detalles.index')
                ->with(['mensaje' => 'Detalle creado exitosamente']);

        } catch (\Exception $e) {
            return redirect()->route('detalles.index')
                ->with(['error' => 'Error al crear el detalle: ' . $e->getMessage()]);
        }
    }
}
