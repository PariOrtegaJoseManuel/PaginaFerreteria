@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                Editar Pago
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('pagos.update', [$pago]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="encargos_id" class="form-label">Encargo</label>
                        <select name="encargos_id" id="encargos_id" class="form-select">
                            @foreach ($encargos as $encargo)
                                <option value="{{ $encargo->id }}"
                                    {{ $encargo->id == old('encargos_id', $pago->encargo_id) ? 'selected' : '' }}>
                                    {{ $encargo->descripcion_articulo }}
                                </option>
                            @endforeach
                        </select>
                        <label for="ventas_id" class="form-label">Venta</label>
                        <select name="ventas_id" id="ventas_id" class="form-select">
                        @foreach ($ventas as $venta)
                            <option value="{{ $venta->id }}"
                                {{ $venta->id == old('ventas_id', $pago->venta_id) ? 'selected' : '' }}>
                                {{ $venta->fecha }}
                            </option>
                            @endforeach
                        </select>
                        <label for="monto" class="form-label">Monto</label>
                        <input type="text" name="monto" id="monto" value="{{ old('monto', $pago->monto) }}"
                            class="form-control">
                        <label for="fecha_pago" class="form-label">Fecha</label>
                        <input type="date" name="fecha_pago" id="fecha_pago"
                            value="{{ old('fecha_pago', $pago->fecha_pago) }}" class="form-control">
                        <label for="metodo_pago" class="form-label">Metodo</label>
                        <input type="text" name="metodo_pago" id="metodo_pago"
                            value="{{ old('metodo_pago', $pago->metodo_pago) }}" class="form-control">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('pagos.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
