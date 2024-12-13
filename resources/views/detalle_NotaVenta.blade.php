<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota de Venta</title>
    <style>
        @page {
            margin: 2cm;
            font-family: 'Times New Roman', serif;
            font-size: 12px;
        }

        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            background-color: #f9f9f9;
        }

        .documento {
            border: 2px solid #000;
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
        }

        .encabezado {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .titulo {
            font-size: 24px;
            font-weight: bold;
            color: #8b0000;
            margin: 0;
        }

        .numero-venta {
            font-size: 16px;
            color: #444;
            margin-top: 5px;
        }

        .datos-cliente {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
        }

        .datos-cliente h2 {
            color: #8b0000;
            margin-top: 0;
            font-size: 18px;
            border-bottom: 1px solid #8b0000;
        }

        .datos-cliente-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .tabla-productos {
            width: 100%;
            border: 1px solid #000;
            margin: 20px 0;
        }

        .tabla-productos th {
            background-color: #8b0000;
            color: white;
            padding: 10px;
            border: 1px solid #000;
        }

        .tabla-productos td {
            padding: 8px;
            border: 1px solid #000;
        }

        .tabla-productos tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #8b0000;
            margin: 20px 0;
            border-top: 2px solid #000;
            padding-top: 10px;
        }

        .pie-pagina {
            text-align: center;
            margin-top: 30px;
            font-style: italic;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }

        .firma {
            margin-top: 50px;
            text-align: center;
        }

        .linea-firma {
            width: 200px;
            border-top: 1px solid #000;
            margin: 10px auto;
        }
    </style>
</head>
<body>
    <div class="documento">
        <div class="encabezado">
            <h1 class="titulo">NOTA DE VENTA</h1>
            <div class="numero-venta">No. {{ $venta->id }}</div>
            <div>Fecha: {{ date('d/m/Y', strtotime($venta->fecha)) }}</div>
        </div>

        <div class="datos-cliente">
            <h2>Datos del Cliente</h2>
            <div class="datos-cliente-grid">
                <div>
                    <strong>Razón Social:</strong> {{ $venta->relCliente->razon }}<br>
                    <strong>NIT:</strong> {{ $venta->relCliente->nit }}<br>
                    <strong>Teléfono:</strong> {{ $venta->relCliente->telefono }}
                </div>
                <div>
                    <strong>Email:</strong> {{ $venta->relCliente->email }}<br>
                    <strong>Dirección:</strong> {{ $venta->relCliente->direccion }}
                </div>
            </div>
        </div>

        <table class="tabla-productos">
            <thead>
                <tr>
                    <th>DESCRIPCIÓN</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO UNIT.</th>
                    <th>IMPORTE</th>
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
                        <td style="text-align: center;">{{ $detalle->cantidad }}</td>
                        <td style="text-align: right;">{{ number_format($detalle->relArticulo->precio_unitario, 2) }} Bs</td>
                        <td style="text-align: right;">{{ number_format($subtotal, 2) }} Bs</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            TOTAL A PAGAR: {{ number_format($total, 2) }} Bs
        </div>

        <div class="firma">
            <div class="linea-firma"></div>
            <strong>{{ $venta->relUser->name }}</strong><br>
            Vendedor Autorizado
        </div>

        <div class="pie-pagina">
            <p>¡Gracias por su preferencia!</p>
            <small>Documento generado el {{ now()->format('d/m/Y H:i:s') }}</small>
        </div>
    </div>
</body>
</html>
