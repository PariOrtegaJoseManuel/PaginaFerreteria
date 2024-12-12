@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Metodo de Pagos</h1>
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
                                <th>Metodo</th>
                                <th>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                        Nuevo
                                    </button>

                                    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCrearLabel">Nuevo Metodo de Pago</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                    <form action="{{route("metodo_pagos.store")}}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="metodo" class="form-label">Metodo</label>
                                                            <input type="text" name="metodo" id="metodo" value="{{old("metodo")}}" class="form-control">
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($metodo_pagos as $metodo_pago)
                                <tr class="align-middle">
                                    <td class="text-end">{{ $metodo_pago->id }}</td>
                                    <td class="text-start">{{ $metodo_pago->metodo }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$metodo_pago->id}}">
                                            Editar
                                        </button>
                                        <div class="modal fade" id="editModal{{$metodo_pago->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Editar Metodo de Pago</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                        <form action="{{route('metodo_pagos.update', $metodo_pago)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="metodo" class="form-label">Metodo</label>
                                                                <input type="text" name="metodo" id="metodo" value="{{old('metodo',$metodo_pago->metodo)}}" class="form-control">
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $metodo_pago->id }}">
                                            Eliminar
                                        </button>

                                    </td>
                                </tr>
                                <div class="modal fade" id="exampleModal{{ $metodo_pago->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Metodo de Pago</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Desea eliminar el metodo de pago {{ $metodo_pago->metodo }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal" >Cerrar</button>
                                                <form action="{{ route('metodo_pagos.destroy', $metodo_pago) }}" method="post">
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
