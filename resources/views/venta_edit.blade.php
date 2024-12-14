@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="fas fa-edit me-1">Editar Venta</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('ventas.update', [$venta]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="fecha" class="form-label fw-bold">
                            <i class="fas fa-calendar-alt me-1"></i>Fecha
                        </label>
                        <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $venta->fecha) }}"
                            class="form-control @error('fecha') is-invalid @enderror">
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
                            class="form-select @error('clientes_id') is-invalid @enderror">
                            <option value="">Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}"
                                    {{ $cliente->id == old('clientes_id', $venta->clientes_id) ? 'selected' : '' }}>
                                    {{ $cliente->razon }}
                                </option>
                            @endforeach
                        </select>
                        @error('clientes_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Guardar
                        </button>
                        <a href="{{ route('ventas.index') }}" class="btn btn-danger">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
