@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Clientes</h1>
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
                                <th>Razon</th>
                                <th>Nit</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>
                                    <a href="{{ route('clientes.create') }}" class="btn btn-primary">Nuevo</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($clientes as $cliente)
                                <tr class="align-middle">
                                    <td class="text-end">{{ $cliente->id }}</td>
                                    <td class="text-start">{{ $cliente->razon }}</td>
                                    <td class="text-center">{{ $cliente->nit }}</td>
                                    <td class="text-center">{{ $cliente->direccion }}</td>
                                    <td class="text-center">{{ $cliente->telefono }}</td>
                                    <td class="text-center">{{ $cliente->email }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-primary">
                                            Editar
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $cliente->id }}">
                                            Eliminar
                                        </button>

                                    </td>
                                </tr>
                                <div class="modal fade" id="exampleModal{{ $cliente->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Cliente</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Desea eliminar el cliente {{ $cliente->razon }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <form action="{{ route('clientes.destroy', $cliente) }}" method="post">
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
