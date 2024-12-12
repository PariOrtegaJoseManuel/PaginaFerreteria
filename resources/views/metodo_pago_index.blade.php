@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Metodo de Pagos</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                        Nuevo
                    </button>
                </div>
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
                                        <img class="card-img-top" src="{{ url("img/$metodo_pago->foto") }}"
                                            alt="{{ $metodo_pago->metodo }}">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">{{ $metodo_pago->metodo }}</h5>
                                        </div>
                                        <div class="card-body text-center">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
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
                    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrearLabel">Nuevo Metodo de Pago</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form action="{{ route('metodo_pagos.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="metodo" class="form-label fw-bold">Método de Pago</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                                <input type="text" name="metodo" id="metodo" value="{{ old('metodo') }}"
                                                    class="form-control form-control-lg" placeholder="Ingrese el método de pago">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="foto" class="form-label fw-bold">Imagen</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                <input type="file" id="foto" name="foto"
                                                    class="form-control form-control-lg" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                                <i class="fas fa-save me-2"></i>Guardar
                                            </button>
                                            <button type="button" class="btn btn-danger btn-lg px-4" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-2"></i>Cancelar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($metodo_pagos as $metodo_pago)
                        <div class="modal fade" id="editModal{{ $metodo_pago->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="editModalLabel">
                                            <i class="fas fa-edit me-2"></i>Editar Método de Pago
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <form action="{{ route('metodo_pagos.update', $metodo_pago) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4">
                                                <label for="metodo" class="form-label fw-bold">Método de Pago</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                                    <input type="text" name="metodo" id="metodo"
                                                        value="{{ old('metodo', $metodo_pago->metodo) }}"
                                                        class="form-control form-control-lg" placeholder="Ingrese el método de pago">
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="foto" class="form-label fw-bold">Imagen</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                    <input type="file" id="foto" name="foto"
                                                        class="form-control form-control-lg" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="mb-4 text-center">
                                                <p class="fw-bold mb-2">Imagen Actual</p>
                                                <img src="{{url("img/$metodo_pago->foto")}}"
                                                    alt="{{$metodo_pago->metodo}}"
                                                    class="img-thumbnail" style="max-height: 150px;">
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="button" class="btn btn-lg btn-danger"
                                                    data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-2"></i>Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-lg btn-primary">
                                                    <i class="fas fa-save me-2"></i>Guardar Cambios
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal{{ $metodo_pago->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <i class="fas fa-trash-alt me-2"></i>Eliminar Método de Pago
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="text-center mb-4">
                                            <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                                            <h5>¿Está seguro que desea eliminar el método de pago?</h5>
                                            <h1 class="text-muted mb-0">{{ $metodo_pago->metodo }}</h1>
                                            <img src="{{url("img/$metodo_pago->foto")}}" alt="{{$metodo_pago->metodo}}" class="img-thumbnail" style="max-height: 150px;">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0">
                                        <button type="button" class="btn btn-lg btn-primary"
                                            data-bs-dismiss="modal">
                                            <i class="fas fa-times me-2"></i>Cancelar
                                        </button>
                                        <form action="{{ route('metodo_pagos.destroy', $metodo_pago) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-lg btn-danger">
                                                <i class="fas fa-trash-alt me-2"></i>Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
