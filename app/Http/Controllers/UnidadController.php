<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:unidades.index')->only('index');
        $this->middleware('can:unidades.create')->only('create', 'store');
        $this->middleware('can:unidades.edit')->only('edit', 'update');
        $this->middleware('can:unidades.destroy')->only('destroy');
    }
    public function validarForm(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|min:4|max:100',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        session()->flashInput($request->input());
        $unidades = Unidad::all();
        return view('unidad_index', ['unidades' => $unidades]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //;
        return view('unidad_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validarForm($request);
        try {
            if ($foto = $request->file("foto")) {
                $input = $request->all();
                $fotoNombre = $request->descripcion . "." . $foto->getClientOriginalExtension();
                $fotoRuta = "img";
                $foto->move($fotoRuta, $fotoNombre);
                $input["foto"] = $fotoNombre;
                Unidad::create($input);
            } else
                Unidad::create($request->all());
            return redirect()->route('unidades.index')->with(['mensaje' => 'Unidad creada']);
        } catch (\Exception $e) {
            return redirect()->route('unidades.index')->with(['error' => 'Ocurrió un error al crear la unidad: ' . $e->getMessage()]);
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
            $unidad = Unidad::findOrFail($id);
            return view('unidad_edit', ['unidad' => $unidad]);
        } catch (\Exception $e) {
            return redirect()->route('unidades.index')->with(['error' => 'Ocurrió un error al mostrar la unidad: ' . $e->getMessage()]);
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
            $unidad = Unidad::findOrFail($id);
            if ($foto = $request->file("foto")) {
                $archivoAEliminar = "img/$unidad->foto";
                if (file_exists($archivoAEliminar))
                    unlink($archivoAEliminar);
                $input = $request->all();
                $fotoNombre = $request->descripcion . "." . $foto->getClientOriginalExtension();
                $fotoRuta = "img";
                $foto->move($fotoRuta, $fotoNombre);
                $input["foto"] = $fotoNombre;
                $unidad->update($input);
            } else
                $unidad->update($request->all());
            return redirect()->route('unidades.index')->with(['mensaje' => 'Unidad editada']);
        } catch (\Exception $e) {
            return redirect()->route('unidades.index')->with(['error' => 'Ocurrió un error al editar la Unidad: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $unidad = Unidad::findOrFail($id);
            // Verificar si tiene actividades relacionadas
            if ($unidad->RelArticulo()->count() > 0)
                return redirect()->route('unidades.index')->with(['error' => 'No se puede eliminar una unidad con articulos relacionados']);
            $archivoAEliminar = "img/$unidad->foto";
            if (file_exists($archivoAEliminar))
                unlink($archivoAEliminar);
            $unidad->delete();
            return redirect()->route('unidades.index')->with(['mensaje' => 'Unidad eliminada']);
        } catch (\Exception $e) {
            return redirect()->route('unidades.index')->with(['error' => 'Ocurrió un error al eliminar la unidad: ' . $e->getMessage()]);
        }
    }
}
