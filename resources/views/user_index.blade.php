@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0"><i class="fas fa-users me-2"></i>Usuarios</h1>
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

                <div class="text-end mb-3">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Nuevo Usuario
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nombre</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Password</th>
                                <th class="text-center">Rol</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $user->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                                                 class="rounded-circle me-2" width="40" height="40">
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">********</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info">{{ $user->roles->first()->name }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{route("users.editpassword",$user)}}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-key me-1"></i>Password
                                            </a>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit me-1"></i>Editar
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $user->id }}">
                                                <i class="fas fa-trash me-1"></i>Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal de eliminación -->
                                <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>Eliminar Usuario
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center py-4">
                                                <i class="fas fa-user-times fa-3x text-danger mb-3"></i>
                                                <p class="mb-0">¿Está seguro que desea eliminar al usuario <strong>{{ $user->name }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-2"></i>Cancelar
                                                </button>
                                                <form action="{{ route('users.destroy', $user) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash me-2"></i>Eliminar
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
