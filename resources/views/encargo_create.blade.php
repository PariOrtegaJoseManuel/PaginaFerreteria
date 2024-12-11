@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-header">
                Nuevo Encargo
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
                <form action="{{ route('encargos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="clientes_id" class="form-label">Cliente</label>
                        <select name="clientes_id" id="clientes_id" class="form-select">
                            @foreach($clientes as $cliente)
                                <option value="{{$cliente->id}}"
                                    {{ $cliente->id == old('clientes_id') ? 'selected' : '' }}>
                                    {{$cliente->razon}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion_articulo" class="form-label">Descripción del Articulo</label>
                        <input type="text" name="descripcion_articulo" id="descripcion_articulo" value="{{ old('descripcion_articulo') }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad') }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="fecha_encargo" class="form-label">Fecha de Encargo</label>
                        <input type="date" name="fecha_encargo" id="fecha_encargo" value="{{ old('fecha_encargo') }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" id="estado" class="form-select">
                            <option value="" {{ old('estado') == '' ? 'selected' : '' }}>Seleccione un estado</option>
                            <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="completado" {{ old('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                            <option value="cancelado" {{ old('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <input type="text" name="observaciones" id="observaciones" value="{{ old('observaciones') }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
                        <input type="date" name="fecha_entrega" id="fecha_entrega" value="{{ old('fecha_entrega') }}"
                            class="form-control">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{route("encargos.index")}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
