@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                Editar Cantidad
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
            <div class="card-body"
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('detalles.updateVenta', [$detalle, $ventaId]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad"
                            value="{{ old('cantidad', $detalle->cantidad) }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="metodo_pagos_id" class="form-label">Metodo</label>
                        <select name="metodo_pagos_id" id="metodo_pagos_id" class="form-select">
                            @foreach ($metodo_pagos as $metodo_pago)
                                <option value="{{ $metodo_pago->id }}"
                                    {{ $metodo_pago->id == old('metodo_pagos_id', $detalle->metodo_pagos_id) ? 'selected' : '' }}>
                                    {{ $metodo_pago->metodo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('detalles.indexVenta', $ventaId) }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
