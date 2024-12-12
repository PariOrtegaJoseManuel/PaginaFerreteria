<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:categorias.index')->only('index');
        $this->middleware('can:categorias.create')->only('create','store');
        $this->middleware('can:categorias.edit')->only('edit','update');
        $this->middleware('can:categorias.destroy')->only('destroy');
    }
    public function validarForm(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|min:4|max:100'
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        session()->flashInput($request->input());
        $categorias = Categoria::all();
        return view('categoria_index', ['categorias' => $categorias]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //;
        return view('categoria_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validarForm($request);
        try {
        Categoria::create($request->all());
        return redirect()->route('categorias.index')->with(['mensaje' => 'Categoria creada']);
        } catch (\Exception $e) {
            return redirect()->route('categorias.index')->with(['error' => 'Ocurrió un error al crear la categoria: '.$e->getMessage()]);
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
        $categoria = Categoria::findOrFail($id);
        return view('categoria_edit', ['categoria' => $categoria]);
        } catch (\Exception $e) {
            return redirect()->route('categorias.index')->with(['error' => 'Ocurrió un error al mostrar la categoria: '.$e->getMessage()]);
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
        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());
        return redirect()->route('categorias.index')->with(['mensaje' => 'Categoria editada']);
        } catch (\Exception $e) {
            return redirect()->route('categorias.index')->with(['error' => 'Ocurrió un error al editar la Categoria: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        $categoria = Categoria::findOrFail($id);
         // Verificar si tiene actividades relacionadas
        if ($categoria->RelArticulo()->count() > 0)
            return redirect()->route('categorias.index')->with(['error' => 'No se puede eliminar una categoria con articulos relacionados']);

        $categoria->delete();
        return redirect()->route('categorias.index')->with(['mensaje' => 'Categoria eliminada']);
        } catch (\Exception $e) {
            return redirect()->route('categorias.index')->with(['error' => 'Ocurrió un error al eliminar la categoria: '.$e->getMessage()]);
        }
    }
}