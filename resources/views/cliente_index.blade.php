@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">
                        <i class="fas fa-users me-2"></i>Clientes
                    </h1>
                    <a href="{{ route('clientes.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-2"></i>Nuevo Cliente
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (session('mensaje'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('mensaje') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">Razón Social</th>
                                <th scope="col">NIT/CI</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Correo</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td class="text-center">{{ $cliente->id }}</td>
                                    <td>{{ $cliente->razon }}</td>
                                    <td class="text-center">{{ $cliente->nit }}</td>
                                    <td>{{ $cliente->direccion }}</td>
                                    <td class="text-center">{{ $cliente->telefono }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-edit me-1"></i>Editar
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $cliente->id }}">
                                                <i class="fas fa-trash-alt me-1"></i>Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Eliminar -->
                                <div class="modal fade" id="exampleModal{{ $cliente->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    <i class="fas fa-trash-alt me-2"></i>Eliminar Cliente
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-0">¿Está seguro que desea eliminar al cliente <strong>{{ $cliente->razon }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-2"></i>Cancelar
                                                </button>
                                                <form action="{{ route('clientes.destroy', $cliente) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt me-2"></i>Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
