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
                <div class="text-center">
                    <div class="card text-center">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                            @foreach ($metodo_pagos as $metodo_pago)
                                <div class="col">
                                    <div class="card h-100">
                                        <img class="card-img-top" src="..." alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">{{ $metodo_pago->metodo }}</h5>
                                        </div>
                                        <div class="card-body text-center">
                                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $metodo_pago->id }}">
                                                Editar
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $metodo_pago->id }}">
                                                Eliminar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                        Nuevo
                    </button>
                    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrearLabel">Nuevo Metodo de Pago</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('metodo_pagos.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="metodo" class="form-label">Metodo</label>
                                            <input type="text" name="metodo" id="metodo" value="{{ old('metodo') }}"
                                                class="form-control">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editModal{{ $metodo_pago->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Editar Metodo de Pago</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('metodo_pagos.update', $metodo_pago) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="metodo" class="form-label">Metodo</label>
                                            <input type="text" name="metodo" id="metodo"
                                                value="{{ old('metodo', $metodo_pago->metodo) }}" class="form-control">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal{{ $metodo_pago->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Metodo de Pago
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Desea eliminar el metodo de pago {{ $metodo_pago->metodo }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('metodo_pagos.destroy', $metodo_pago) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
