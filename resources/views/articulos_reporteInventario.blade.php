<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Inventario</title>
    <style>
        @page {
            margin: 1.5cm;
            font-family: 'Times New Roman', serif;
            font-size: 11px;
            counter-increment: page;
        }

        header, footer {
            position: fixed;
            right: 0;
            left: 0;
            width: 100%;
            height: 90px;
            background-color: #1a4d80;
            color: white;
            text-align: center;
            line-height: 90px;
            font-weight: bold;
            font-size: 32px;
            border-radius: 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        header {
            top: 0;
            border-bottom: 3px solid #gold;
        }

        header::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 80px;
            height: 80px;
            background-image: url('img/logo.png');
            background-size: contain;
            background-repeat: no-repeat;
        }

        footer {
            bottom: 0;
            border-top: 3px solid #gold;
            font-size: 16px;
        }

        footer::after {
            content: 'Página ' counter(page);
            position: absolute;
            right: 20px;
            bottom: 10px;
            font-size: 14px;
        }

        main {
            margin: 5cm 1cm 3.5cm 1cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5cm;
            font-size: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        th {
            background-color: #1a4d80;
            color: white;
            border: 2px solid #ffffff;
            padding: 12px;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
        }

        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f0f5fa;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tr:hover {
            background-color: #e6f3ff;
        }

        .total-row {
            font-weight: bold;
            background-color: #dde6f3;
        }

        img {
            max-width: 80px;
            height: auto;
            border: 2px solid #1a4d80;
            padding: 3px;
            background-color: #ffffff;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        img:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<header>
    CC2 - Reporte de Inventario
</header>
<main>
    <table>
        <thead>
        <tr>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Precio Total</th>
            <th>Unidades</th>
            <th>Categoria</th>
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
                <td>{{ $articulo->relUnidad->descripcion }}</td>
                <td>{{ $articulo->relCategoria->nombre }}</td>
                <td>
                    <img src="{{ public_path('img/' . $articulo->foto) }}" alt="Foto del artículo">
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</main>
<footer>
    CC2 - Reporte generado el {{ now()->format('d/m/Y H:i') }}
</footer>
</body>
</html>
