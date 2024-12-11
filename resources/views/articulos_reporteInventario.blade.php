<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Inventario</title>
    <style>
        @page {
            margin: 1cm;
            font-family: 'Arial', sans-serif;
            font-size: 10px;
        }

        header, footer {
            position: fixed;
            right: 0;
            left: 0;
            height: 2cm;
            background-color: #003366;
            color: white;
            text-align: center;
            line-height: 1.5cm;
            font-weight: bold;
            font-size: 25px;
        }

        header {
            top: 0;
            border-bottom: 2px solid #ffffff;
        }

        footer {
            bottom: 0;
            border-top: 2px solid #ffffff;
        }

        main {
            margin: 3cm 1cm 3cm 1cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1cm;
            font-size: 15px;
        }

        th {
            background-color: #003366;
            color: white;
            border: 1px solid #ffffff;
            padding: 8px;
            text-align: center;
        }

        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .total-row {
            font-weight: bold;
            background-color: #e6e6e6;
        }

        img {
            max-width: 50px;
            height: auto;
            border: 1px solid #ddd;
            padding: 2px;
            background-color: #f9f9f9;
        }

        .total {
            text-align: right;
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<header>
    Reporte de Inventario
</header>
<main>
    <table>
        <thead>
        <tr>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Precio Total</th>
            <th>Unidades_Id</th>
            <th>Foto</th>
        </tr>
        </thead>
        <tbody>
        @php $total = 0; @endphp
        @foreach($articulos as $articulo)
            <tr>
                <td style="text-align: left;">{{ $articulo->descripcion }}</td>
                <td>{{ $articulo->cantidad }}</td>
                <td>{{ number_format($articulo->precio_unitario, 2) }}</td>
                <td>{{ number_format($articulo->precio_unitario * $articulo->cantidad, 2) }}</td>
                <td>{{ $articulo->unidades_id }}</td>
                <td>
                    @if($articulo->foto)
                        <img src="{{ public_path('img/' . $articulo->foto) }}" style="max-width: 100px; height: auto;">
                    @endif
                </td>
            </tr>
            @php $total += $articulo->precio_unitario * $articulo->cantidad; @endphp
        @endforeach
        <tr class="total-row">
            <td colspan="3">TOTAL</td>
            <td colspan="3">{{ number_format($total, 2) }}</td>
        </tr>
        </tbody>
    </table>
</main>
<footer>
    Generado el {{ now()->format('d/m/Y H:i') }}
</footer>
</body>
</html>
