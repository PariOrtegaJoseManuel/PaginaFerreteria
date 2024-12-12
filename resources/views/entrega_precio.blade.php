@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                Editar Entrega
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
                <form action="{{ route('entregas.updateEntrega', [$entrega, $ventaId]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="any" name="precio" id="precio"
                            value="{{ old('precio', $entrega->precio) }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="metodo_pagos_id" class="form-label">Metodo</label>
                        <select name="metodo_pagos_id" id="metodo_pagos_id" class="form-select">
                            @foreach ($metodo_pagos as $metodo_pago)
                                <option value="{{ $metodo_pago->id }}"
                                    {{ $metodo_pago->id == old('metodo_pagos_id', $entrega->metodo_pagos_id) ? 'selected' : '' }}>
                                    {{ $metodo_pago->metodo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('entregas.indexVenta', $ventaId) }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
