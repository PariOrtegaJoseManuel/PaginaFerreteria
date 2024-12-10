@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Usuarios</h1>
            </div>
            <div class="card-body">
                @if (session('mensaje'))
                    <div class="alert alert-success" role="alert">{{ session('mensaje') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered border-light">
                        <thead class="text-center table-light">
                            <tr class="align-middle">
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Rol</th>
                                <th>
                                    <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($users as $user)
                                <tr class="align-middle">
                                    <td class="text-end">{{ $user->id }}</td>
                                    <td class="text-start">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">********</td>
                                    <td class="text-center">{{ $user->roles->first()->name }}</td>
                                    <td class="text-center">
                                        <a href="{{route("users.editpassword",$user)}}" class="btn btn-warning">
                                            Cambiar password
                                        </a>
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
                                            Editar
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $user->id }}">
                                            Eliminar
                                        </button>

                                    </td>
                                </tr>
                                <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Desea eliminar el usuario {{ $user->name }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <form action="{{ route('users.destroy', $user) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
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
