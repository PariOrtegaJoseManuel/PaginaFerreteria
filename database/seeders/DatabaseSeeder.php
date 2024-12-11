<?php

namespace Database\Seeders;

use App\Models\Unidad;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::create(["name" => "admin", "email" => "admin@admin.com", "password" => "12345678"]);
        $vendedor = User::create(["name" => "vendedor", "email" => "vendedor@vendedor.com", "password" => "12345678"]);

        $rolAdmin = Role::create(["name" => "admin"]);
        $rolVendedor = Role::create(["name" => "vendedor"]);

        Permission::create(["name" => "detalles.index"]);
        Permission::create(["name" => "detalles.create"]);
        Permission::create(["name" => "detalles.edit"]);
        Permission::create(["name" => "detalles.destroy"]);

        Permission::create(["name" => "clientes.index"]);
        Permission::create(["name" => "clientes.create"]);
        Permission::create(["name" => "clientes.edit"]);
        Permission::create(["name" => "clientes.destroy"]);

        Permission::create(["name" => "articulos.index"]);
        Permission::create(["name" => "articulos.create"]);
        Permission::create(["name" => "articulos.edit"]);
        Permission::create(["name" => "articulos.destroy"]);

        Permission::create(["name" => "ventas.index"]);
        Permission::create(["name" => "ventas.create"]);
        Permission::create(["name" => "ventas.edit"]);
        Permission::create(["name" => "ventas.destroy"]);

        Permission::create(["name" => "users.index"]);
        Permission::create(["name" => "users.create"]);
        Permission::create(["name" => "users.edit"]);
        Permission::create(["name" => "users.destroy"]);

        Permission::create(["name" => "unidades.index"]);
        Permission::create(["name" => "unidades.create"]);
        Permission::create(["name" => "unidades.edit"]);
        Permission::create(["name" => "unidades.destroy"]);

        Permission::create(["name" => "roles.index"]);
        Permission::create(["name" => "roles.create"]);
        Permission::create(["name" => "roles.edit"]);
        Permission::create(["name" => "roles.destroy"]);

        Permission::create(["name" => "categorias.index"]);
        Permission::create(["name" => "categorias.create"]);
        Permission::create(["name" => "categorias.edit"]);
        Permission::create(["name" => "categorias.destroy"]);

        Permission::create(["name" => "encargos.index"]);
        Permission::create(["name" => "encargos.create"]);
        Permission::create(["name" => "encargos.edit"]);
        Permission::create(["name" => "encargos.destroy"]);

        Permission::create(["name" => "pagos.index"]);
        Permission::create(["name" => "pagos.create"]);
        Permission::create(["name" => "pagos.edit"]);
        Permission::create(["name" => "pagos.destroy"]);

        $admin->syncRoles($rolAdmin);
        $vendedor->syncRoles($rolVendedor);

        $rolAdmin->syncPermissions([
            "detalles.index","detalles.create","detalles.edit","detalles.destroy",
            "clientes.index","clientes.create","clientes.edit","clientes.destroy",
            "articulos.index","articulos.create","articulos.edit","articulos.destroy",
            "ventas.index","ventas.create","ventas.edit","ventas.destroy",
            "users.index","users.create","users.edit","users.destroy",
            "unidades.index","unidades.create","unidades.edit","unidades.destroy",
            "roles.index","roles.create","roles.edit","roles.destroy",
            "categorias.index","categorias.create","categorias.edit","categorias.destroy",
            "encargos.index","encargos.create","encargos.edit","encargos.destroy",
            "pagos.index","pagos.create","pagos.edit","pagos.destroy",
        ]);

        $rolVendedor->syncPermissions([
            "detalles.index","detalles.create","detalles.edit","detalles.destroy",
            "ventas.index","ventas.create","ventas.edit","ventas.destroy",
        ]);

        Unidad::create(['descripcion' => 'Pieza']);
        Unidad::create(['descripcion' => 'Bidon']);
        Unidad::create(['descripcion' => 'Kilogramo']);
        Unidad::create(['descripcion' => 'Litro']);
        Unidad::create(['descripcion' => 'Otro']);
    }
}
