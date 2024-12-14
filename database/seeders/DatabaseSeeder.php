<?php

namespace Database\Seeders;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Detalle;
use App\Models\Encargo;
use App\Models\Entrega;
use App\Models\MetodoPago;
use App\Models\Unidad;
use App\Models\User;
use App\Models\Venta;
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
            "detalles.index", "detalles.create", "detalles.edit", "detalles.destroy",
            "clientes.index", "clientes.create", "clientes.edit", "clientes.destroy",
            "articulos.index", "articulos.create", "articulos.edit", "articulos.destroy",
            "ventas.index", "ventas.create", "ventas.edit", "ventas.destroy",
            "users.index", "users.create", "users.edit", "users.destroy",
            "unidades.index", "unidades.create", "unidades.edit", "unidades.destroy",
            "roles.index", "roles.create", "roles.edit", "roles.destroy",
            "categorias.index", "categorias.create", "categorias.edit", "categorias.destroy",
            "encargos.index", "encargos.create", "encargos.edit", "encargos.destroy",
            "entregas.index", "entregas.create", "entregas.edit", "entregas.destroy",
            "metodo_pagos.index", "metodo_pagos.create", "metodo_pagos.edit", "metodo_pagos.destroy",
        ]);

        $rolVendedor->syncPermissions([
            "detalles.index", "detalles.create", "detalles.edit", "detalles.destroy",
            "ventas.index", "ventas.create", "ventas.edit", "ventas.destroy",
            "entregas.index", "entregas.create", "entregas.edit", "entregas.destroy",
            "encargos.index", "encargos.create", "encargos.edit", "encargos.destroy",
            "clientes.index", "clientes.create", "clientes.edit", "clientes.destroy",
            "articulos.index",
        ]);


        Unidad::create(['descripcion' => 'Pieza', 'foto' => 'pieza.png']);
        Unidad::create(['descripcion' => 'Bidon', 'foto' => 'bidon.png']);
        Unidad::create(['descripcion' => 'Kilogramo', 'foto' => 'kilogramo.png']);
        Unidad::create(['descripcion' => 'Litro', 'foto' => 'litro.png']);
        Unidad::create(['descripcion' => 'Caja', 'foto' => 'caja.png']);

        MetodoPago::create(['metodo' => 'Efectivo', 'foto' => 'efectivo.png']);
        MetodoPago::create(['metodo' => 'Tarjeta', 'foto' => 'tarjeta.jpg']);
        MetodoPago::create(['metodo' => 'Transferencia', 'foto' => 'transferencia.jpg']);
        MetodoPago::create(['metodo' => 'Cheque', 'foto' => 'cheque.jpg']);

        Categoria::create(['nombre' => 'Herramientas', 'foto' => 'herramientas.jpg']);
        Categoria::create(['nombre' => 'Maquinaria', 'foto' => 'maquinaria.jpg']);
        Categoria::create(['nombre' => 'Materiales', 'foto' => 'materiales.jpg']);
        Categoria::create(['nombre' => 'Pinturas', 'foto' => 'pinturas.jpg']);

        Cliente::create([
            "razon" => "Empresa A",
            "nit" => 123456789,
            "telefono" => "123456789",
            "email" => "empresaA@example.com",
            "direccion" => "direccion 1"
        ]);
        Cliente::create([
            "razon" => "Empresa B",
            "nit" => 123456789,
            "telefono" => "123456789",
            "email" => "empresaB@example.com",
            "direccion" => "direccion 2"
        ]);
        Cliente::create([
            "razon" => "Empresa C",
            "nit" => 123456789,
            "telefono" => "123456789",
            "email" => "empresaC@example.com",
            "direccion" => "direccion 3"
        ]);
        Cliente::create([
            "razon" => "Empresa D",
            "nit" => 123456789,
            "telefono" => "123456789",
            "email" => "empresaD@example.com",
            "direccion" => "direccion 4"
        ]);
        Cliente::create([
            "razon" => "Empresa E",
            "nit" => 123456789,
            "telefono" => "123456789",
            "email" => "empresaE@example.com",
            "direccion" => "direccion 5"
        ]);

        Articulo::create(["descripcion" => "Martillo", "cantidad" => 25, "precio_unitario" => 10, "foto" => "martillo.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Destornillador", "cantidad" => 50, "precio_unitario" => 5, "foto" => "destornillador.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 20]);
        Articulo::create(["descripcion" => "Taladro", "cantidad" => 20, "precio_unitario" => 60, "foto" => "taladro.png", "unidades_id" => 1, "categorias_id" => 2, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Pintura Roja (1L)", "cantidad" => 15, "precio_unitario" => 20, "foto" => "pintura_roja.png", "unidades_id" => 4, "categorias_id" => 4, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Cinta Métrica", "cantidad" => 30, "precio_unitario" => 8, "foto" => "cinta_metrica.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 20]);
        Articulo::create(["descripcion" => "Sierra Circular", "cantidad" => 10, "precio_unitario" => 150, "foto" => "sierra_circular.png", "unidades_id" => 1, "categorias_id" => 2, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Lija", "cantidad" => 100, "precio_unitario" => 1, "foto" => "lija.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 20]);
        Articulo::create(["descripcion" => "Tornillo (paquete de 50)", "cantidad" => 200, "precio_unitario" => 10, "foto" => "tornillo.png", "unidades_id" => 5, "categorias_id" => 3, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Brocha", "cantidad" => 40, "precio_unitario" => 5, "foto" => "brocha.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Llave Inglesa", "cantidad" => 25, "precio_unitario" => 20, "foto" => "llave_inglesa.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Cortadora de Metal", "cantidad" => 15, "precio_unitario" => 250, "foto" => "cortadora_metal.png", "unidades_id" => 1, "categorias_id" => 2, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Hacha", "cantidad" => 30, "precio_unitario" => 15, "foto" => "hacha.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 20]);
        Articulo::create(["descripcion" => "Pintura Blanca (1L)", "cantidad" => 20, "precio_unitario" => 18, "foto" => "pintura_blanca.png", "unidades_id" => 4, "categorias_id" => 4, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Tornillo Allen (paquete de 50)", "cantidad" => 150, "precio_unitario" => 12, "foto" => "tornillo_allen.png", "unidades_id" => 5, "categorias_id" => 3, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Rodillo de Pintura", "cantidad" => 25, "precio_unitario" => 7, "foto" => "rodillo_pintura.png", "unidades_id" => 1, "categorias_id" => 4, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Sierra de Mano", "cantidad" => 12, "precio_unitario" => 30, "foto" => "sierra_mano.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Lámpara de Trabajo", "cantidad" => 18, "precio_unitario" => 40, "foto" => "lampara_trabajo.png", "unidades_id" => 1, "categorias_id" => 2, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Cemento (saco 50kg)", "cantidad" => 100, "precio_unitario" => 80, "foto" => "cemento.png", "unidades_id" => 3, "categorias_id" => 3, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Destornillador Eléctrico", "cantidad" => 10, "precio_unitario" => 120, "foto" => "destornillador_electrico.png", "unidades_id" => 1, "categorias_id" => 2, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Silicona Transparente", "cantidad" => 50, "precio_unitario" => 4, "foto" => "silicona_transparente.png", "unidades_id" => 1, "categorias_id" => 3, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Machete", "cantidad" => 15, "precio_unitario" => 25, "foto" => "machete.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Pegamento para Madera", "cantidad" => 60, "precio_unitario" => 6, "foto" => "pegamento_madera.png", "unidades_id" => 2, "categorias_id" => 3, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Taladro Percutor", "cantidad" => 8, "precio_unitario" => 200, "foto" => "taladro_percutor.png", "unidades_id" => 1, "categorias_id" => 2, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Nivel de Burbuja", "cantidad" => 35, "precio_unitario" => 10, "foto" => "nivel_burbuja.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Guantes de Trabajo", "cantidad" => 80, "precio_unitario" => 3, "foto" => "guantes_trabajo.png", "unidades_id" => 1, "categorias_id" => 3, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Pintura Azul (1L)", "cantidad" => 15, "precio_unitario" => 18, "foto" => "pintura_azul.png", "unidades_id" => 4, "categorias_id" => 4, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Caja de Herramientas", "cantidad" => 10, "precio_unitario" => 75, "foto" => "caja_herramientas.png", "unidades_id" => 5, "categorias_id" => 1, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Adhesivo Epóxico", "cantidad" => 40, "precio_unitario" => 12, "foto" => "adhesivo_epoxico.png", "unidades_id" => 2, "categorias_id" => 3, "alerta_minima" => 10]);
        Articulo::create(["descripcion" => "Espátula", "cantidad" => 50, "precio_unitario" => 5, "foto" => "espatula.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 5]);
        Articulo::create(["descripcion" => "Llave Stilson", "cantidad" => 15, "precio_unitario" => 35, "foto" => "llave_stilson.png", "unidades_id" => 1, "categorias_id" => 1, "alerta_minima" => 10]);

        Encargo::create([
            "descripcion_articulo" => "Cortadora de Cerámica",
            "cantidad" => 5,
            "foto" => "cortadora_ceramica.png",
            "fecha_encargo" => "2024-12-01",
            "fecha_entrega" => "2024-12-03",
            "estado" => "Completado",
            "observaciones" => "Ninguna",
            "clientes_id" => 1,
        ]);

        Encargo::create([
            "descripcion_articulo" => "Llana Dentada",
            "cantidad" => 15,
            "foto" => "llana_dentada.png",
            "fecha_encargo" => "2024-12-01",
            "fecha_entrega" => "2024-12-04",
            "estado" => "Completado",
            "observaciones" => "Ninguna",
            "clientes_id" => 1,
        ]);

        Encargo::create([
            "descripcion_articulo" => "Manguera de Jardín (10m)",
            "cantidad" => 20,
            "foto" => "manguera_jardin.png",
            "fecha_encargo" => "2024-12-03",
            "fecha_entrega" => "2024-12-04",
            "estado" => "Completado",
            "observaciones" => "Ninguna",
            "clientes_id" => 1,
        ]);

        Encargo::create([
            "descripcion_articulo" => "Carretilla de Obra",
            "cantidad" => 8,
            "foto" => "carretilla.png",
            "fecha_encargo" => "2024-12-06",
            "fecha_entrega" => "2024-12-10",
            "estado" => "Completado",
            "observaciones" => "Ninguna",
            "clientes_id" => 1,
        ]);

        Encargo::create([
            "descripcion_articulo" => "Tijera de Podar",
            "cantidad" => 10,
            "foto" => "tijera_podar.png",
            "fecha_encargo" => "2024-12-07",
            "fecha_entrega" => "2024-12-12",
            "estado" => "Cancelado",
            "observaciones" => "Ninguna",
            "clientes_id" => 1,
        ]);

        Venta::create(['fecha' => '2024-12-01', 'clientes_id' => 1, 'users_id' => 1]);
        Venta::create(['fecha' => '2024-12-02', 'clientes_id' => 2, 'users_id' => 2]);
        Venta::create(['fecha' => '2024-12-03', 'clientes_id' => 3, 'users_id' => 1]);
        Venta::create(['fecha' => '2024-12-04', 'clientes_id' => 4, 'users_id' => 1]);
        Venta::create(['fecha' => '2024-12-05', 'clientes_id' => 5, 'users_id' => 1]);
        Venta::create(['fecha' => '2024-12-06', 'clientes_id' => 1, 'users_id' => 2]);
        Venta::create(['fecha' => '2024-12-07', 'clientes_id' => 2, 'users_id' => 2]);
        Venta::create(['fecha' => '2024-12-08', 'clientes_id' => 3, 'users_id' => 2]);
        Venta::create(['fecha' => '2024-12-09', 'clientes_id' => 4, 'users_id' => 1]);
        Venta::create(['fecha' => '2024-12-10', 'clientes_id' => 5, 'users_id' => 2]);

        Detalle::create(['cantidad' => 5, 'ventas_id' => 1, 'metodo_pagos_id' => 1, 'articulos_id' => 1]);
        Detalle::create(['cantidad' => 3, 'ventas_id' => 2, 'metodo_pagos_id' => 2, 'articulos_id' => 2]);
        Detalle::create(['cantidad' => 7, 'ventas_id' => 3, 'metodo_pagos_id' => 3, 'articulos_id' => 3]);
        Detalle::create(['cantidad' => 2, 'ventas_id' => 4, 'metodo_pagos_id' => 4, 'articulos_id' => 4]);
        Detalle::create(['cantidad' => 6, 'ventas_id' => 5, 'metodo_pagos_id' => 1, 'articulos_id' => 5]);
        Detalle::create(['cantidad' => 4, 'ventas_id' => 6, 'metodo_pagos_id' => 2, 'articulos_id' => 6]);
        Detalle::create(['cantidad' => 3, 'ventas_id' => 7, 'metodo_pagos_id' => 3, 'articulos_id' => 7]);
        Detalle::create(['cantidad' => 8, 'ventas_id' => 8, 'metodo_pagos_id' => 4, 'articulos_id' => 8]);
        Detalle::create(['cantidad' => 10, 'ventas_id' => 9, 'metodo_pagos_id' => 1, 'articulos_id' => 9]);
        Detalle::create(['cantidad' => 1, 'ventas_id' => 10, 'metodo_pagos_id' => 2, 'articulos_id' => 10]);

        Entrega::create(['encargos_id' => 1, 'ventas_id' => 1, 'total' => 500, 'precio' => 50, 'fecha_pago' => '2024-12-01', 'metodo_pagos_id' => 1]);
        Entrega::create(['encargos_id' => 2, 'ventas_id' => 2, 'total' => 300, 'precio' => 30, 'fecha_pago' => '2024-12-02', 'metodo_pagos_id' => 2]);
        Entrega::create(['encargos_id' => 3, 'ventas_id' => 3, 'total' => 450, 'precio' => 45, 'fecha_pago' => '2024-12-03', 'metodo_pagos_id' => 3]);
        Entrega::create(['encargos_id' => 4, 'ventas_id' => 4, 'total' => 600, 'precio' => 60, 'fecha_pago' => '2024-12-04', 'metodo_pagos_id' => 4]);
        /*Entrega::create(['encargos_id' => 5, 'ventas_id' => 5, 'total' => 700, 'precio' => 70, 'fecha_pago' => '2024-12-05', 'metodo_pagos_id' => 1]);
        Entrega::create(['encargos_id' => 1, 'ventas_id' => 6, 'total' => 500, 'precio' => 50, 'fecha_pago' => '2024-12-06', 'metodo_pagos_id' => 2]);
        Entrega::create(['encargos_id' => 2, 'ventas_id' => 7, 'total' => 300, 'precio' => 30, 'fecha_pago' => '2024-12-07', 'metodo_pagos_id' => 3]);
        Entrega::create(['encargos_id' => 3, 'ventas_id' => 8, 'total' => 450, 'precio' => 45, 'fecha_pago' => '2024-12-08', 'metodo_pagos_id' => 4]);
        Entrega::create(['encargos_id' => 4, 'ventas_id' => 9, 'total' => 600, 'precio' => 60, 'fecha_pago' => '2024-12-09', 'metodo_pagos_id' => 1]);
        Entrega::create(['encargos_id' => 5, 'ventas_id' => 10, 'total' => 700, 'precio' => 70, 'fecha_pago' => '2024-12-10', 'metodo_pagos_id' => 2]);*/
    }
}
