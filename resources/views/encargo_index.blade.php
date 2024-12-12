@extends("layouts.app")

@section("content")
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Encargos</h1>
                    <a href="{{route('encargos.create')}}" class="btn btn-light">
                        <i class="fas fa-plus me-2"></i>Nuevo Encargo
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('mensaje'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('mensaje') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    @foreach($encargos as $encargo)
                        <div class="col">
                            <div class="card h-100 shadow-sm hover-shadow transition">
                                <div class="position-relative">
                                    <img class="card-img-top" src="{{url("img/$encargo->foto")}}"
                                         alt="{{$encargo->descripcion_articulo}}" style="height: 200px; object-fit: cover;">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge bg-primary">ID: {{$encargo->id}}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center mb-3">{{$encargo->descripcion_articulo}}</h5>
                                    <div class="mb-3">
                                        <p class="mb-1"><strong>Cliente:</strong> {{$encargo->relCliente->razon}}</p>
                                        <p class="mb-1"><strong>Cantidad:</strong> <span class="badge bg-info">{{$encargo->cantidad}}</span></p>
                                        <p class="mb-1"><strong>Fecha Encargo:</strong> {{$encargo->fecha_encargo}}</p>
                                        <p class="mb-1"><strong>Estado:</strong>
                                            <span class="badge {{ $encargo->estado == 'Pendiente' ? 'bg-warning' : 'bg-success' }}">
                                                {{$encargo->estado}}
                                            </span>
                                        </p>
                                        <p class="mb-1"><strong>Observaciones:</strong> {{$encargo->observaciones}}</p>
                                        <p class="mb-1"><strong>Fecha Entrega:</strong> {{$encargo->fecha_entrega}}</p>
                                    </div>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('encargos.edit', $encargo) }}" class="btn btn-outline-primary">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $encargo->id }}">
                                            <i class="fas fa-trash-alt me-1"></i>Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Eliminar -->
                        <div class="modal fade" id="exampleModal{{ $encargo->id }}" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <i class="fas fa-trash-alt me-2"></i>Eliminar Encargo
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center p-4">
                                        <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                                        <h5 class="mb-3">¿Está seguro que desea eliminar este encargo?</h5>
                                        <h2 class="text-danger mb-4">Encargo #{{ $encargo->id }}</h2>
                                        <img src="{{url("img/$encargo->foto")}}" alt="{{$encargo->descripcion_articulo}}"
                                             class="img-thumbnail mb-3" style="max-height: 150px;">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-lg btn-light" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-2"></i>Cancelar
                                            </button>
                                            <form action="{{ route('encargos.destroy', $encargo) }}" method="post">
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

        .transition {
            transition: all 0.3s ease;
        }
    </style>
@endsection
