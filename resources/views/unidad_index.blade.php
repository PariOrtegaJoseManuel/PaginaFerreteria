@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Unidades</h1>
                    @can('unidades.create')
                    <!-- <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalCrear">
                        <i class="fas fa-plus me-2"></i>Nueva Unidad
                    </button> -->
                    <a href="{{ route('unidades.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-2"></i>Nueva Unidad
                    </a>
                    @endcan
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
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach ($unidades as $unidad)
                        <div class="col">
                            <div class="card h-100 shadow-sm hover-shadow transition">
                                <div class="position-relative">
                                    <div style="width: 100%; padding-bottom: 100%; position: relative;">
                                        <img class="card-img-top position-absolute w-100 h-100"
                                            src="{{ url("img/$unidad->foto") }}"
                                            alt="{{ $unidad->descripcion }}"
                                            style="object-fit: cover;">
                                    </div>
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge bg-primary">ID: {{ $unidad->id }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center mb-3">{{ $unidad->descripcion }}</h5>
                                    <div class="d-flex justify-content-center gap-2">
                                        @can('unidades.edit')
                                        <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{$unidad->id}}">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </button> -->
                                        <a href="{{ route('unidades.edit', $unidad) }}" class="btn btn-outline-primary">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>
                                        @endcan
                                        @can('unidades.destroy')
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $unidad->id }}">
                                            <i class="fas fa-trash-alt me-1"></i>Eliminar
                                        </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Modal Crear -->
                <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="modalCrearLabel">
                                    <i class="fas fa-plus-circle me-2"></i>Nueva Unidad
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
                                <form action="{{ route('unidades.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="descripcion" class="form-label fw-bold">Descripción</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                                            <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion') }}"
                                                class="form-control" placeholder="Ingrese la descripción">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="foto" class="form-label fw-bold">Imagen</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light"><i class="fas fa-image"></i></span>
                                            <input type="file" id="foto" name="foto"
                                                class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-2"></i>Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            <i class="fas fa-save me-2"></i>Guardar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modales de Editar y Eliminar -->
                @foreach ($unidades as $unidad)
                    <!-- Modal Editar -->
                    <div class="modal fade" id="editModal{{ $unidad->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="editModalLabel">
                                        <i class="fas fa-edit me-2"></i>Editar Unidad
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
                                    <form action="{{ route('unidades.update', $unidad) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-4">
                                            <label for="descripcion" class="form-label fw-bold">Descripción</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                                                <input type="text" name="descripcion" id="descripcion"
                                                    value="{{ old('descripcion', $unidad->descripcion) }}"
                                                    class="form-control" placeholder="Ingrese la descripción">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="foto" class="form-label fw-bold">Nueva Imagen</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-light"><i class="fas fa-image"></i></span>
                                                <input type="file" id="foto" name="foto"
                                                    class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <p class="fw-bold text-center mb-2">Imagen Actual</p>
                                            <div class="text-center">
                                                <img src="{{url("img/$unidad->foto")}}"
                                                    alt="{{$unidad->descripcion}}"
                                                    class="img-thumbnail" style="max-height: 150px;">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2">
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

                    <!-- Modal Eliminar -->
                    <div class="modal fade" id="exampleModal{{ $unidad->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <i class="fas fa-trash-alt me-2"></i>Eliminar Unidad
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center p-4">
                                    <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                                    <h5 class="mb-3">¿Está seguro que desea eliminar esta unidad?</h5>
                                    <h2 class="text-danger mb-4">{{ $unidad->descripcion }}</h2>
                                    <img src="{{url("img/$unidad->foto")}}" alt="{{$unidad->descripcion}}"
                                        class="img-thumbnail mb-3" style="max-height: 150px;">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-lg btn-light"
                                            data-bs-dismiss="modal">
                                            <i class="fas fa-times me-2"></i>Cancelar
                                        </button>
                                        <form action="{{ route('unidades.destroy', $unidad) }}" method="post">
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
