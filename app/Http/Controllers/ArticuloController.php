<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Unidad;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:articulos.index')->only('index');
        $this->middleware('can:articulos.create')->only('create','store');
        $this->middleware('can:articulos.edit')->only('edit','update');
        $this->middleware('can:articulos.destroy')->only('destroy');
    }
    public function validarForm(Request $request, $isUpdate)
    {
        $request->validate([
            'descripcion' => 'required|string|min:4|max:100',
            'cantidad' => 'required|numeric|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            "foto" => $isUpdate ? "image|mimes:jpg,jpeg,png,gif|max:2048" : "required|mimes:jpg,jpeg,png,gif|max:2048",
            'unidades_id' => 'required|numeric|min:1'
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        session()->flashInput($request->input());
        $articulos = Articulo::all();
        $unidades = Unidad::all();
        return view('articulo_index', ['articulos' => $articulos, 'unidades' => $unidades]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $unidades = Unidad::all();
        return view('articulo_create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validarForm($request, false);
        try {

            if ($foto = $request->file("foto")) {
                $input = $request->all();
                $fotoNombre = date("YmdHis") . "." . $foto->getClientOriginalExtension();
                $fotoRuta = "img";
                $foto->move($fotoRuta, $fotoNombre);
                $input["foto"] = $fotoNombre;
                Articulo::create($input);
            } else
                Articulo::create($request->all());
            return redirect()->route("articulos.index")->with(["mensaje", "Articulo creado con exito"]);
        } catch (\Exception $e) {
            return redirect()->route('articulos.index')->with(['error' => 'Ocurrió un error al crear el articulo: '.$e->getMessage()]);
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
        $unidades = Unidad::all();
        try {
        $articulo = Articulo::findOrFail($id);
        return view('articulo_edit', ['unidades' => $unidades, 'articulo' => $articulo]);
        } catch (\Exception $e) {
            return redirect()->route('articulos.index')->with(['error' => 'Ocurrió un error al mostrar el articulo: '.$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validarForm($request, true);
        $articulo = Articulo::findOrFail($id);
        try {
        if ($foto = $request->file("foto")) {
            $input = $request->all();
            $fotoNombre = date("YmdHis") . "." . $foto->getClientOriginalExtension();
            $fotoRuta = "img";
            $foto->move($fotoRuta, $fotoNombre);
            $input["foto"] = $fotoNombre;
            $articulo->update($input);
        } else
            $articulo->update($request->all());
        return redirect()->route('articulos.index')->with(['mensaje' => 'Articulo editado']);
        } catch (\Exception $e) {
            return redirect()->route('articulos.index')->with(['error' => 'Ocurrió un error al editar el articulo: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
        $articulo = Articulo::findOrFail($id);
        $archivoAEliminar = "img/$articulo->foto";
        if (file_exists($archivoAEliminar))
            unlink($archivoAEliminar);
        $articulo->delete();
        return redirect()->route("articulos.index")->with(["mensaje", "Articulo eliminado con exito"]);
        } catch (\Exception $e) {
            return redirect()->route('articulos.index')->with(['error' => 'Ocurrió un error al eliminar el articulo: '.$e->getMessage()]);
        }
    }
}
