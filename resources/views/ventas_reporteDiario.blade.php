<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas Diario</title>
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
            font-size: 30px;
            border-radius: 10px;
        }

        main {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 15px;
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

        tfoot {
            background-color: #e6e6e6;
            font-weight: bold;
        }

        .footer-text {
            font-size: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        Reporte de Ventas del Día: {{ $fecha }}
    </header>

    <main>
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
                    <td colspan="3">Total de Ventas</td>
                    <td>${{ number_format($totalVentas, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </main>

    <footer>
        <p class="footer-text">&copy; {{ date('Y') }} Sistema de Ventas. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

