<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota de Venta</title>
    <style>
        @page {
            margin: 1cm;
            font-family: 'Arial', sans-serif;
            font-size: 10px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        header, footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-weight: bold;

        }

        main {
            margin: 20px;
        }

        .cliente-info {
            margin-bottom: 20px;
        }

        .cliente-info h3 {
            margin-bottom: 5px;
            color: #003366;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }

        th {
            background-color: #003366;
            color: white;
            border: 1px solid #ffffff;
            padding: 10px;
            text-align: center;
        }

        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tfoot td {
            background-color: #e6e6e6;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <header style="font-size: 25px;">
        Nota de Venta
    </header>

    <main>
        <div class="cliente-info">
            <h3>Razon Social del Cliente</h3>
            <p> <strong>Cliente:</strong> {{ $venta->relCliente->razon }}</p>
            <p> <strong>Fecha:</strong> {{ $venta->fecha}}</p>
            <p> <strong>No. Venta:</strong> {{ $venta->id }}</p>
            <p> <strong>Nit:</strong> {{ $venta->relCliente->nit }}</p>
            <p> <strong>Telefono:</strong> {{ $venta->relCliente->telefono }}</p>
            <p> <strong>Email:</strong> {{ $venta->relCliente->email }}</p>
            <p> <strong>Direccion:</strong> {{ $venta->relCliente->direccion }}</p>
        </div>

        <table>
            <thead>
                <tr>

                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($detalles as $detalle)
                    @php
                        $subtotal = $detalle->cantidad * $detalle->relArticulo->precio_unitario;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $detalle->relArticulo->descripcion }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>${{ number_format($detalle->relArticulo->precio_unitario, 2) }}</td>
                        <td>${{ number_format($subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                    <td><strong>${{ number_format($total, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p>Vendedor: {{ $venta->relUser->name }}</p>
            <p>¡Gracias por su compra!</p>
        </div>
    </main>

    <footer style="font-size: 15px;">
        &copy; {{ now()->format('d/m/Y H:i:s') }} Sistema de Ventas. Todos los derechos reservados.
    </footer>
</body>
</html>

