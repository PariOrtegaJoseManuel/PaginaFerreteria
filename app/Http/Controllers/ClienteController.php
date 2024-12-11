<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:clientes.index')->only('index');
        $this->middleware('can:clientes.create')->only('create','store');
        $this->middleware('can:clientes.edit')->only('edit','update');
        $this->middleware('can:clientes.destroy')->only('destroy');
    }
    public function validarForm(Request $request)
    {
        $request->validate([
            'razon' => 'required|string|min:4|max:100',
            'nit' => 'required|numeric|min:0',
            'telefono' => 'required|numeric|min:0',
            'direccion' => 'required|string|min:4|max:100',
            'email' => 'required|email|unique'
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        session()->flashInput($request->input());
        $clientes = Cliente::all();
        return view('cliente_index', ['clientes' => $clientes]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //;
        return view('cliente_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validarForm($request);
        try {
        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with(['mensaje' => 'Cliente creado']);
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with(['error' => 'Ocurrió un error al crear el cliente: '.$e->getMessage()]);
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
        $cliente = Cliente::findOrFail($id);
        return view('cliente_edit', ['cliente' => $cliente]);
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with(['error' => 'Ocurrió un error al mostrar el cliente: '.$e->getMessage()]);
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
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with(['mensaje' => 'Cliente editado']);
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with(['error' => 'Ocurrió un error al editar el cliente: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        $cliente = Cliente::findOrFail($id);
         // Verificar si tiene actividades relacionadas
        if ($cliente->RelVenta()->count() > 0)
            return redirect()->route('clientes.index')->with(['error' => 'No se puede eliminar un cliente con ventas relacionadas']);
        if ($cliente->RelEncargo()->count() > 0)
            return redirect()->route('clientes.index')->with(['error' => 'No se puede eliminar un cliente con encargos relacionados']);
        $cliente->delete();
            return redirect()->route('clientes.index')->with(['mensaje' => 'Cliente eliminado']);
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with(['error' => 'Ocurrió un error al eliminar el cliente: '.$e->getMessage()]);
        }
    }
}
