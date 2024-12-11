<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas Diario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        tfoot {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Reporte de Ventas del Día: {{ $fecha }}</h1>
        </div>
    </header>

    <main class="container">
        <table>
            <thead>
                <tr>
                    <th>ID de Venta</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Valor de la Venta</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->relCliente->razon }}</td>
                        <td>{{ $venta->relUser->name }}</td>
                        <td>${{ number_format($venta->relDetalle->sum(function ($detalle) {
                            return $detalle->cantidad * $detalle->relArticulo->precio_unitario;
                        }), 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total de Ventas</strong></td>
                    <td><strong>${{ number_format($totalVentas, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </main>

    <footer class="container">
        <p>&copy; {{ date('Y') }} Sistema de Ventas. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
