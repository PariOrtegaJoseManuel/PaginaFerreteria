@extends("layouts.app")

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                Nueva Entrega
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('entregas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="encargos_id" class="form-label">Encargo</label>
                        <select name="encargos_id" id="encargos_id" class="form-select">
                            <option value="">No es encargo</option>
                            @foreach($encargos as $encargo)
                                <option value="{{$encargo->id}}" {{$encargo->id==old("encargos_id")?"selected":""}}>
                                    {{$encargo->descripcion_articulo}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ventas_id" class="form-label">Venta</label>
                        <select name="ventas_id" id="ventas_id" class="form-select">
                            @foreach($ventas as $venta)
                            <option value="{{$venta->id}}"
                                {{ $venta->id == old('ventas_id') ? 'selected' : '' }}>
                                {{$venta->fecha}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="any" name="precio" id="precio" value="{{ old('precio') }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" step="any" name="total" id="total" value="{{ old('total') }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="metodo_pagos_id" class="form-label">Metodo</label>
                        <select name="metodo_pagos_id" id="metodo_pagos_id" class="form-select">
                            @foreach($metodo_pagos as $metodo_pago)
                            <option value="{{$metodo_pago->id}}"
                                {{ $metodo_pago->id == old('metodo_pagos_id') ? 'selected' : '' }}>
                                {{$metodo_pago->metodo}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_pago" class="form-label">Fecha de Pago</label>
                        <input type="date" name="fecha_pago" id="fecha_pago" value="{{ old('fecha_pago') }}"
                            class="form-control">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('entregas.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
