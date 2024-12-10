<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class DetalleVentaController extends Controller
{
    public function indexVenta($detalle)
    {
        try {
            $venta = Venta::findOrFail($detalle->venta_id);
            $cliente = $venta->RelCliente->razon;
            $fecha = $venta->fecha;
            $usuario = $venta->relUser->name;
            $idventa = $venta->id;
            $detalles = $venta->RelDetalle()->with('relArticulo')->get();
            return view('detalleVenta_index', ['detalles' => $detalles, 'cliente' => $cliente, 'fecha' => $fecha, 'usuario' => $usuario, 'idventa' => $idventa]);
        } catch (\Exception $e) {
            return redirect()->route('ventas.index')->with(['error' => 'Ocurrió un error al mostrar los detalles de la venta: '.$e->getMessage()]);
        }
    }
}

