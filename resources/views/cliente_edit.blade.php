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
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-body p-4">
                <form action="{{ route('clientes.update', [$cliente]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="razon" class="form-label fw-bold">Razón Social</label>
                            <input type="text" name="razon" id="razon" value="{{ old('razon', $cliente->razon) }}"
                                class="form-control form-control-lg" placeholder="Ingrese la razón social">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="nit" class="form-label fw-bold">NIT/CI</label>
                            <input type="text" name="nit" id="nit" value="{{ old('nit', $cliente->nit) }}"
                                class="form-control form-control-lg" placeholder="Ingrese el NIT o CI">
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="direccion" class="form-label fw-bold">Dirección</label>
                            <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $cliente->direccion) }}"
                                class="form-control form-control-lg" placeholder="Ingrese la dirección">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="telefono" class="form-label fw-bold">Teléfono</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="number" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}"
                                    class="form-control" placeholder="Ingrese el teléfono">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}"
                                    class="form-control" placeholder="Ingrese el correo electrónico">
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
