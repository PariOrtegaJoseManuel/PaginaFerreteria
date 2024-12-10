<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
</div>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .cliente-info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Nota de Venta</h1>
        <p>Fecha: {{ $venta->fecha }}</p>
        <p>No. Venta: {{ $venta->id }}</p>
    </div>

    <div class="cliente-info">
        <h3>Información del Cliente:</h3>
        <p>Cliente: {{ $venta->relCliente->razon }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No. Venta</th>
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
                    <td>{{ $venta->id }}</td>
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
</body>
</html>
