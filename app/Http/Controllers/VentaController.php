<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ventas.index')->only('index');
        $this->middleware('can:ventas.create')->only('create','store');
        $this->middleware('can:ventas.edit')->only('edit','update');
        $this->middleware('can:ventas.destroy')->only('destroy');
    }
    public function validarForm(Request $request,$isUpdate)
    {
        $request->validate([
            'fecha' => 'required|date',
            'clientes_id' => 'required|numeric|min:1',
            'users_id' => $isUpdate?'nullable|numeric|min:1':'required|numeric|min:1',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        session()->flashInput($request->input());
        $ventas = Venta::all();
        $clientes = Cliente::all();
        $users = User::all();
        return view('venta_index', ['ventas' => $ventas, 'clientes' => $clientes, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clientes = Cliente::all();
        $users = User::all();
        return view('venta_create', ['clientes' => $clientes, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['users_id'] = Auth::user()->id;
        $this->validarForm($request,false);
        try {

            Venta::create($request->all());
            return redirect()->route('ventas.index')->with(['mensaje' => 'Venta creada']);
        } catch (\Exception $e) {
            return redirect()->route('ventas.index')->with(['error' => 'Ocurrió un error al crear la venta: '.$e->getMessage()]);
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
        $clientes = Cliente::all();
        $users = User::all();
        try {
        $venta = Venta::findOrFail($id);
        return view('venta_edit', ['clientes' => $clientes, 'users' => $users, 'venta' => $venta]);
        } catch (\Exception $e) {
            return redirect()->route('ventas.index')->with(['error' => 'Ocurrió un error al mostrar la venta: '.$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validarForm($request,true);
        try {
        $venta = Venta::findOrFail($id);
        $venta->update($request->all());
        return redirect()->route('ventas.index')->with(['mensaje' => 'Venta editada']);
        } catch (\Exception $e) {
            return redirect()->route('ventas.index')->with(['error' => 'Ocurrió un error al editar la venta: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
        $venta = Venta::findOrFail($id);
        $venta->delete();
        return redirect()->route('ventas.index')->with(['mensaje' => 'Venta eliminada']);
        } catch (\Exception $e) {
            return redirect()->route('ventas.index')->with(['error' => 'Ocurrió un error al eliminar la venta: '.$e->getMessage()]);
        }
    }
}
