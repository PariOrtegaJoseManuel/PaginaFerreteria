<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create', 'store');
        $this->middleware('can:users.edit')->only('edit', 'update','editPassword','updatePassword');
        $this->middleware('can:users.destroy')->only('destroy');
    }
    public function validarForm(Request $request, $isCreate = true)
    {
        $request->validate([
            "name" => "required|string|min:4|max:100",
            "email" => $isCreate ? "required|email|unique:users,email" : "required|email",
            "password" => $isCreate ? "required|string|min:6|max:100" : ""
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        session()->flashInput($request->input());
        $users = User::all();
        $roles = Role::all();
        return view('user_index', ['users' => $users, 'roles' => $roles]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view("user_create", ["roles" => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validarForm($request, true);
        try {
            if (!$request->has('roles')) {
                return redirect()->route("users.index")->with(['error' => 'Debe seleccionar al menos un rol']);
            }
            $user = User::create($request->all());
            $user->syncRoles($request->roles);
            return redirect()->route("users.index")->with(["mensaje" => "Usuario creado"]);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with(['error' => 'Ocurrió un error al crear el usuario: ' . $e->getMessage()]);
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
            $user = User::find($id);
            $roles = Role::all();
            return view("user_edit", ["user" => $user, "roles" => $roles]);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with(['error' => 'Ocurrió un error al mostrar el usuario: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validarForm($request, false);
        try {
            if (!$request->has('roles')) {
                return redirect()->route("users.index")->with(['error' => 'Debe seleccionar al menos un rol']);
            }
            $user = User::find($id);
            $user->update($request->all());
            $user->syncRoles($request->roles);
            return redirect()->route("users.index")->with(["mensaje" => "Usuario actualizado"]);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with(['error' => 'Ocurrió un error al editar el usuario: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            // Verificar si tiene actividades relacionadas
            if ($user->RelVenta()->count() > 0)
                return redirect()->route('users.index')->with(['error' => 'No se puede eliminar un usuario con ventas relacionadas']);

            $user->delete();
            return redirect()->route('users.index')->with(['mensaje' => 'Usuario eliminado']);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with(['error' => 'Ocurrió un error al eliminar el usuario: ' . $e->getMessage()]);
        }
    }
    public function editpassword(string $id)
    {
        try {
            $user = User::find($id);
            return view("user_password", ["user" => $user]);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with(['error' => 'Ocurrió un error al mostrar la contraseña: ' . $e->getMessage()]);
        }
    }
    public function updatepassword(Request $request, string $id)
    {
        $request->validate([
            "password" => "required|string|min:3|max:50",
            "password_confirmation" => "required|same:password"
        ]);
        try {
            $user = User::find($id);
            $user->password = $request->password;
            $user->save();
            return redirect()->route("users.index")
                ->with(["mensaje" => "Contraseña modificada"]);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with(['error' => 'Ocurrió un error al modificar la contraseña: ' . $e->getMessage()]);
        }
    }
}
