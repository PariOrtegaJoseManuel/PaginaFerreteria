<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /** Constructor de la clase
     * Se utiliza el middleware para controlar el acceso a las funciones
     * Solo se pueden acceder a las funciones que tengan permisos de role.create, role.index, role.update y role.delete
    */
    public function __construct(){
        $this->middleware('can:roles.create')->only(['create', 'store']);
        $this->middleware('can:roles.index')->only(['index']);
        $this->middleware('can:roles.edit')->only(['edit', 'update']);
        $this->middleware('can:roles.destroy')->only(['destroy']);
    }

    /** Validar el formulario de creación de un rol */
    public function validarForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4|max:100',

            // Agrega otras validaciones según sea necesario
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('role_index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('role_create',["permissions" => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validarForm($request);
        try {
            if (!$request->has('permissions')) {
                return redirect()->route("roles.index")->with(['error' => 'Debe seleccionar al menos un permiso']);
            }
            $role = Role::create($request->all());
            $role->syncPermissions($request->permissions);
            return redirect()->route('roles.index')->with(['mensaje' => 'Rol creado']);
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with(['error' => 'Ocurrió un error al crear el rol: '.$e->getMessage()]);
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
            $role = Role::findOrFail($id);
            $permissions = Permission::all();
            return view('role_edit', ['role' => $role, 'permissions' => $permissions]);
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with(['error' => 'Ocurrió un error al mostrar el rol: '.$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validarForm($request);
        try {
            if (!$request->has('permissions')) {
                return redirect()->route("roles.index")->with(['error' => 'Debe seleccionar al menos un permiso']);
            }
            $role = Role::findOrFail($id);
            $role->update($request->all());
            $role->syncPermissions($request->permissions);
            return redirect()->route('roles.index')->with(['mensaje' => 'Rol editado']);
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with(['error' => 'Ocurrió un error al editar el rol: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            if ($role->users()->count() > 0) {
                return redirect()->route('roles.index')->with(['error' => 'No se puede eliminar un rol que tiene usuarios asignados']);
            }

            $role->delete();
            return redirect()->route('roles.index')->with(['mensaje' => 'Rol eliminado']);
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with(['error' => 'Ocurrió un error al eliminar el rol: '.$e->getMessage()]);
        }
    }
}
