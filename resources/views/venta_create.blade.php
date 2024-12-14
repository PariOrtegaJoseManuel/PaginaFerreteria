@extends("layouts.app")

@section("content")

    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-plus me-2"></i>Nueva Venta
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{route("ventas.store")}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="fecha" class="form-label fw-bold">
                            <i class="fas fa-calendar-alt me-1"></i>Fecha
                        </label>
                        <input type="date" name="fecha" id="fecha"
                            value="{{ old('fecha', now()->format('Y-m-d')) }}"
                            class="form-control shadow-sm @error('fecha') is-invalid @enderror">
                        @error('fecha')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="clientes_id" class="form-label fw-bold">
                            <i class="fas fa-user me-1"></i>Cliente
                        </label>
                        <select name="clientes_id" id="clientes_id"
                            class="form-select shadow-sm @error('clientes_id') is-invalid @enderror">
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{$cliente->id}}"
                                    {{$cliente->id==old("clientes_id")?"selected":""}}>
                                    {{$cliente->razon}}
                                </option>
                            @endforeach
                        </select>
                        @error('clientes_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{route("ventas.index")}}" class="btn btn-danger">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
