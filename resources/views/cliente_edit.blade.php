@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-edit me-2"></i>
                    <h1 class="h3 mb-0">Editar Cliente</h1>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('clientes.update', [$cliente]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="razon" class="form-label fw-bold">Razón Social</label>
                            <input type="text" name="razon" id="razon" value="{{ old('razon', $cliente->razon) }}"
                                class="form-control form-control-lg @error('razon') is-invalid @enderror" placeholder="Ingrese la razón social">
                            @error('razon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="nit" class="form-label fw-bold">NIT/CI</label>
                            <input type="number" name="nit" id="nit" value="{{ old('nit', $cliente->nit) }}"
                                class="form-control form-control-lg @error('nit') is-invalid @enderror" placeholder="Ingrese el NIT o CI">
                            @error('nit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="direccion" class="form-label fw-bold">Dirección</label>
                            <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $cliente->direccion) }}"
                                class="form-control form-control-lg @error('direccion') is-invalid @enderror" placeholder="Ingrese la dirección">
                            @error('direccion')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="telefono" class="form-label fw-bold">Teléfono</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="number" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}"
                                    class="form-control @error('telefono') is-invalid @enderror" placeholder="Ingrese el teléfono">
                                @error('telefono')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Ingrese el correo electrónico">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-save me-2"></i>Guardar
                        </button>
                        <a href="{{ route('clientes.index') }}" class="btn btn-danger btn-lg px-4">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
