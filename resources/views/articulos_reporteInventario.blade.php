<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Inventario</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 11px;
            margin: 0;
            padding: 0;
        }

        .main-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
        }

        .logo {
            width: 80px;
            height: 80px;
            position: absolute;
            left: 20px;
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            color: #1a4d80;
            text-align: center;
            margin-top: 25px;
            margin-bottom: 40px;
        }

        footer {
            width: 100%;
            height: 50px;
            background-color: #1a4d80;
            color: white;
            text-align: center;
            line-height: 50px;
            font-size: 16px;
            margin-top: 20px;
        }

        main {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        th {
            background-color: #1a4d80;
            color: white;
            border: 1px solid #ffffff;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }

        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f0f5fa;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .total-row {
            font-weight: bold;
            background-color: #dde6f3;
        }
    </style>
</head>
<body>
<main>
    <div class="main-header">
        <img src="img/logo.png" alt="Logo" class="logo">
        <div class="title">Reporte de Inventario</div>
    </div>
    <table>
        <thead>
        <tr>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Precio Total</th>
            <th>Unidades</th>
            <th>Categoria</th>
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
                <td>{{ $articulo->relUnidad->descripcion }}</td>
                <td>{{ $articulo->relCategoria->nombre }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</main>
<footer>
    Reporte generado el {{ now()->format('d/m/Y H:i') }}
</footer>
</body>
</html>
