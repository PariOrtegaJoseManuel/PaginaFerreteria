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
                    @can('users.create')
                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                        <i class="fas fa-plus-circle me-2"></i>Nuevo Usuario
                    </button> -->
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Nuevo Usuario
                    </a>
                    @endcan

                    <!-- Modal de creación -->
                    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title text-center" id="createUserModalLabel">
                                        <i class="fas fa-plus-circle me-2"></i>Nuevo Usuario
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{route('users.store')}}" method="post">
                                        @csrf
                                        <div class="mb-3 text-center">
                                            <label for="name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                                        </div>
                                        <div class="mb-3 text-center">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                                        </div>
                                        <div class="mb-3 text-center">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="mb-3 text-center">
                                            <label class="form-label">Roles</label>
                                            <div class="row g-3 justify-content-center">
                                                @foreach($roles as $role)
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" name="roles[]" id="role-{{$role->id}}" value="{{$role->name}}">
                                                            <label class="form-check-label" for="role-{{$role->id}}">{{$role->name}}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-2"></i>Guardar
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-2"></i>Cancelar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            @can('users.edit')
                                            <a href="{{ route('users.editpassword', $user) }}" class="btn btn-outline-warning">
                                                <i class="fas fa-key me-1"></i>Password
                                            </a>
                                            <!-- <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#passwordModal{{ $user->id }}">
                                                <i class="fas fa-key me-1"></i>Password
                                            </button> -->

                                            <!-- Modal para cambiar contraseña -->
                                            <div class="modal fade" id="passwordModal{{ $user->id }}" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="passwordModalLabel">Cambiar Contraseña</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if($errors->any())
                                                                <div class="alert alert-danger">
                                                                    <ul>
                                                                        @foreach($errors->all() as $error)
                                                                            <li>{{$error}}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                            <form action="{{route("users.updatepassword",$user)}}" method="post">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="password" class="form-label">Nueva Contraseña</label>
                                                                    <input type="password" id="password" name="password" class="form-control" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                                                                </div>
                                                                <div class="text-center">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fas fa-save me-2"></i>Guardar
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                        <i class="fas fa-times me-2"></i>Cancelar
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary">
                                                <i class="fas fa-edit me-1"></i>Editar
                                            </a>

                                            <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                                <i class="fas fa-edit me-1"></i>Editar
                                            </button> -->
                                            @endcan

                                            <!-- Modal de edición -->
                                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="editModalLabel">
                                                                <i class="fas fa-edit me-2"></i>Editar Usuario
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if($errors->any())
                                                                <div class="alert alert-danger">
                                                                    <ul>
                                                                        @foreach($errors->all() as $error)
                                                                            <li>{{$error}}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                            <form action="{{route('users.update', $user)}}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="name{{ $user->id }}" class="form-label">Nombre</label>
                                                                    <input type="text" id="name{{ $user->id }}" name="name" value="{{old('name', $user->name)}}" class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                                    <input type="email" id="email{{ $user->id }}" name="email" value="{{old('email', $user->email)}}" class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Roles</label>
                                                                    <div class="row ps-3">
                                                                        @foreach($roles as $role)
                                                                            <div class="col-md-4">
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" id="role{{ $role->id }}{{ $user->id }}" name="roles[]" value="{{$role->id}}" class="form-check-input" {{$user->hasRole($role->name) ? 'checked' : ''}}>
                                                                                    <label for="role{{ $role->id }}{{ $user->id }}" class="form-check-label">{{$role->name}}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="text-center">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fas fa-save me-2"></i>Guardar
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                        <i class="fas fa-times me-2"></i>Cancelar
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @can('users.destroy')
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $user->id }}">
                                                <i class="fas fa-trash me-1"></i>Eliminar
                                            </button>
                                            @endcan
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
