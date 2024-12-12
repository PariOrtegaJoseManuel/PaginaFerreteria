<?php

namespace Database\Seeders;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\MetodoPago;
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

        Permission::create(["name" => "entregas.index"]);
        Permission::create(["name" => "entregas.create"]);
        Permission::create(["name" => "entregas.edit"]);
        Permission::create(["name" => "entregas.destroy"]);

        Permission::create(["name" => "metodo_pagos.index"]);
        Permission::create(["name" => "metodo_pagos.create"]);
        Permission::create(["name" => "metodo_pagos.edit"]);
        Permission::create(["name" => "metodo_pagos.destroy"]);

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
            "entregas.index","entregas.create","entregas.edit","entregas.destroy",
            "metodo_pagos.index","metodo_pagos.create","metodo_pagos.edit","metodo_pagos.destroy",
        ]);

        $rolVendedor->syncPermissions([
            "detalles.index","detalles.create","detalles.edit","detalles.destroy",
            "ventas.index","ventas.create","ventas.edit","ventas.destroy",
        ]);

        Unidad::create(['descripcion' => 'Pieza', 'foto' => 'pieza.png']);
        Unidad::create(['descripcion' => 'Bidon', 'foto' => 'bidon.png']);
        Unidad::create(['descripcion' => 'Kilogramo', 'foto' => 'kilogramo.png']);
        Unidad::create(['descripcion' => 'Litro', 'foto' => 'litro.png']);
        Unidad::create(['descripcion' => 'Otro', 'foto' => 'otro.png']);

        MetodoPago::create(['metodo' => 'Efectivo', 'foto' => 'efectivo.png']);
        MetodoPago::create(['metodo' => 'Tarjeta', 'foto' => 'tarjeta.jpg']);
        MetodoPago::create(['metodo' => 'Transferencia', 'foto' => 'transferencia.jpg']);
        MetodoPago::create(['metodo' => 'Cheque', 'foto' => 'cheque.jpg']);

        Categoria::create(['nombre' => 'Herramientas', 'foto' => 'herramientas.jpg']);
        Categoria::create(['nombre' => 'Maquinaria', 'foto' => 'maquinaria.jpg']);
        Categoria::create(['nombre' => 'Materiales', 'foto' => 'materiales.jpg']);
        Categoria::create(['nombre' => 'Otros', 'foto' => 'otros.jpg']);

        Cliente::create(["razon" => "Empresa A","nit" => 123456789, "telefono" => "123456789",
        "email" => "empresaA@example.com", "direccion" => "direccion 1"]);
        Cliente::create(["razon" => "Empresa B","nit" => 123456789, "telefono" => "123456789",
        "email" => "empresaB@example.com", "direccion" => "direccion 2"]);
        Cliente::create(["razon" => "Empresa C","nit" => 123456789, "telefono" => "123456789",
        "email" => "empresaC@example.com", "direccion" => "direccion 3"]);
        Cliente::create(["razon" => "Empresa D","nit" => 123456789, "telefono" => "123456789",
        "email" => "empresaD@example.com", "direccion" => "direccion 4"]);
        Cliente::create(["razon" => "Empresa E","nit" => 123456789, "telefono" => "123456789",
        "email" => "empresaE@example.com", "direccion" => "direccion 5"]);

        Articulo::create([
            "descripcion" => "Martillo",
            "cantidad" => 25,
            "precio_unitario" => 10,
            "foto" => "martillo.png",
            "unidades_id" => 1,
            "categorias_id" => 1,
        ]);
        Articulo::create([
            "descripcion" => "Clavos (caja)",
            "cantidad" => 100,
            "precio_unitario" => 3,
            "foto" => "clavos.jpeg",
            "unidades_id" => 1,
            "categorias_id" => 2,
        ]);
        Articulo::create([
            "descripcion" => "Pintura Blanca (galón)",
            "cantidad" => 15,
            "precio_unitario" => 50,
            "foto" => "pintura_blanca.png",
            "unidades_id" => 2,
            "categorias_id" => 3,
        ]);
        Articulo::create([
            "descripcion" => "Taladro Eléctrico",
            "cantidad" => 8,
            "precio_unitario" => 75,
            "foto" => "taladro.jpeg",
            "unidades_id" => 1,
            "categorias_id" => 1,
        ]);
        Articulo::create([
            "descripcion" => "Cemento (bolsa 50kg)",
            "cantidad" => 50,
            "precio_unitario" => 120,
            "foto" => "cemento.png",
            "unidades_id" => 3,
            "categorias_id" => 2,
        ]);
    }
}
