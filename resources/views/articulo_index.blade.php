@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Artículos</h1>
                    <div class="d-flex gap-2">
                        @can('articulos.create')
                        <a href="{{ route('articulos.create') }}" class="btn btn-light">
                            <i class="fas fa-plus me-2"></i>Nuevo Artículo
                        </a>
                        @endcan
                        <a href="{{ route('articulos.reporteInventario') }}" class="btn btn-warning">
                            <i class="fas fa-file-alt me-2"></i>Reporte Inventario
                        </a>
                    </div>
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

                <div class="mb-4">
                </div>
                <form action="{{ route('articulos.index') }}" method="get">
                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <label class="form-label fw-bold mb-0">Categoría:</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-outline-dark">Todos</button>
                            @foreach ($categorias as $categoria)
                                @php
                                    $colors = [
                                        1 => 'primary',
                                        2 => 'success',
                                        3 => 'danger',
                                        4 => 'warning',
                                        5 => 'info',
                                        6 => 'secondary',
                                    ];
                                    $color = $colors[$categoria->id] ?? 'primary';
                                @endphp
                                <button type="submit" name="categorias_id" value="{{ $categoria->id }}"
                                    class="btn btn-outline-{{ $color }}">{{ $categoria->nombre }}</button>
                            @endforeach
                        </div>
                    </div>
                </form>
                <div class="mb-4">
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach ($articulos as $articulo)
                        <div class="col">
                            <div
                                class="card h-100 shadow-sm hover-shadow transition {{ $articulo->cantidad == 0 ? 'bg-danger' : ($articulo->cantidad <= $articulo->alerta_minima ? 'bg-warning' : '') }}">
                                <div class="position-relative">
                                    <div style="width: 100%; padding-bottom: 100%; position: relative;">
                                        <img class="card-img-top position-absolute w-100 h-100" src="{{ url("img/$articulo->foto") }}"
                                            alt="{{ $articulo->descripcion }}" style="object-fit: cover;">
                                    </div>
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge bg-primary">ID: {{ $articulo->id }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center mb-3">{{ $articulo->descripcion }}</h5>
                                    <div class="mb-3">
                                        <p class="mb-1"><strong>Cantidad:</strong> {{ $articulo->cantidad }}</p>
                                        <p class="mb-1"><strong>Precio:</strong> {{ $articulo->precio_unitario }} Bs</p>
                                        <p class="mb-1"><strong>Unidad:</strong> {{ $articulo->relUnidad->descripcion }}
                                        </p>
                                        <p class="mb-1"><strong>Categoría:</strong> {{ $articulo->relCategoria->nombre }}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-center gap-2">
                                        @can('articulos.edit')
                                            <a href="{{ route('articulos.edit', $articulo) }}" class="btn btn-outline-primary">
                                                <i class="fas fa-edit me-1"></i>Editar
                                            </a>
                                        @endcan
                                        @can('articulos.destroy')
                                        <button type="button" class="btn btn-outline-{{ $articulo->cantidad == 0 ? 'light' : 'danger' }}" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $articulo->id }}">
                                                <i class="fas fa-trash-alt me-1"></i>Eliminar
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Eliminar -->
                        <div class="modal fade" id="exampleModal{{ $articulo->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <i class="fas fa-trash-alt me-2"></i>Eliminar Artículo
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center p-4">
                                        <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                                        <h5 class="mb-3">¿Está seguro que desea eliminar este artículo?</h5>
                                        <h2 class="text-danger mb-4">{{ $articulo->descripcion }}</h2>
                                        <img src="{{ url("img/$articulo->foto") }}" alt="{{ $articulo->descripcion }}"
                                            class="img-thumbnail mb-3" style="max-height: 150px;">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-lg btn-light" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-2"></i>Cancelar
                                            </button>
                                            <form action="{{ route('articulos.destroy', $articulo) }}" method="post">
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
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-shadow {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
    </style>
@endsection
