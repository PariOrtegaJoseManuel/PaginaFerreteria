<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Encargo;
use Illuminate\Http\Request;

class EncargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:encargos.index')->only('index');
        $this->middleware('can:encargos.create')->only('create','store');
        $this->middleware('can:encargos.edit')->only('edit','update');
        $this->middleware('can:encargos.destroy')->only('destroy');
    }
    public function validarForm(Request $request)
    {
        $request->validate([
            'clientes_id' => 'required|numeric|min:1',
            'descripcion_articulo' => 'required|string|max:255',
            'cantidad' => 'required|numeric|min:1',
            'estado' => 'required|string|max:255',
            'observaciones' => 'nullable|string|max:255',
            // La fecha del encargo debe ser igual o anterior a la fecha de entrega
            'fecha_encargo' => 'required|date|before_or_equal:fecha_entrega',
            // La fecha de entrega debe ser igual o posterior a la fecha del encargo
            'fecha_entrega' => 'required|date|after_or_equal:fecha_encargo',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $encargos = Encargo::all();
        $clientes = Cliente::all();
        return view('encargo_index', ['encargos' => $encargos, 'clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clientes = Cliente::all();
        return view('encargo_create', ['clientes' => $clientes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validarForm($request);
        try {
            if (is_null($request->observaciones)) {
                $request->merge(['observaciones' => 'Sin observaciones']);
            }
        Encargo::create($request->all());
        return redirect()->route('encargos.index')->with(['mensaje' => 'Encargo creado']);
        } catch (\Exception $e) {
            return redirect()->route('encargos.index')->with(['error' => 'Ocurrió un error al crear el encargo: '.$e->getMessage()]);
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
        $clientes = Cliente::all();
        try {
        $encargo = Encargo::findOrFail($id);
        return view('encargo_edit', ['clientes' => $clientes, 'encargo' => $encargo]);
        } catch (\Exception $e) {
            return redirect()->route('encargos.index')->with(['error' => 'Ocurrió un error al mostrar el encargo: '.$e->getMessage()]);
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
        $encargo = Encargo::findOrFail($id);
        $encargo->update($request->all());
        return redirect()->route('encargos.index')->with(['mensaje' => 'Encargo editado']);
        } catch (\Exception $e) {
            return redirect()->route('encargos.index')->with(['error' => 'Ocurrió un error al editar el encargo: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
        $encargo = Encargo::findOrFail($id);
        // Verificar si tiene actividades relacionadas
        if ($encargo->relPago()->count() > 0)
            return redirect()->route('encargos.index')->with(['error' => 'No se puede eliminar un encargo con pagos relacionados']);

        $encargo->delete();
        return redirect()->route('encargos.index')->with(['mensaje' => 'Encargo eliminado']);
        } catch (\Exception $e) {
            return redirect()->route('encargos.index')->with(['error' => 'Ocurrió un error al eliminar el encargo: '.$e->getMessage()]);
        }
    }
}