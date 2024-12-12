@extends("layouts.app")

@section("content")
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">
                        <i class="fas fa-file-invoice-dollar me-2"></i>Ventas
                    </h1>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid mb-4">
                    <form action="{{ route('ventas.index') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="razon" class="form-label fw-bold">
                                    <i class="fas fa-building me-1"></i>Razón Social:
                                </label>
                                <input type="text" list="razon" class="form-control shadow-sm" placeholder="Ingrese la razón social" name="razon" value="{{ old('razon') }}">
                                <datalist id="razon">
                                    @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->razon }}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="col-md-3">
                                <label for="fecha" class="form-label fw-bold">
                                    <i class="fas fa-calendar-alt me-1"></i>Fecha:
                                </label>
                                <input type="date" class="form-control shadow-sm" name="fecha" value="{{ old('fecha') }}">
                            </div>
                            <div class="col-md-2 align-self-end">
                                <button type="submit" class="btn btn-primary w-100 shadow-sm">
                                    <i class="fas fa-search me-1"></i>Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="container mb-4">
                    @if(session("mensaje"))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{session("mensaje")}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session("error"))
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{session("error")}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle shadow-sm">
                        <thead class="bg-light text-center">
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>
                                    <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                                        <i class="fas fa-plus me-1"></i>Nueva Venta
                                    </button>

                                    <!-- Modal Crear -->
                                    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-plus me-2"></i>Nueva Venta
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    @if($errors->any())
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <ul class="mb-0">
                                                                @foreach($errors->all() as $error)
                                                                    <li>{{$error}}</li>
                                                                @endforeach
                                                            </ul>
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    @endif

                                                    <form action="{{route('ventas.store')}}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="fecha" class="form-label fw-bold">
                                                                <i class="fas fa-calendar-alt me-1"></i>Fecha
                                                            </label>
                                                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha', now()->format('Y-m-d')) }}" class="form-control shadow-sm">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="clientes_id" class="form-label fw-bold">
                                                                <i class="fas fa-user me-1"></i>Cliente
                                                            </label>
                                                            <select name="clientes_id" id="clientes_id" class="form-select shadow-sm">
                                                                @foreach($clientes as $cliente)
                                                                    <option value="{{$cliente->id}}" {{$cliente->id==old("clientes_id")?"selected":""}}>
                                                                        {{$cliente->razon}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                <i class="fas fa-times me-1"></i>Cancelar
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fas fa-save me-1"></i>Guardar
                                                            </button>
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
                            @foreach($ventas as $venta)
                                <tr>
                                    <td class="text-center fw-bold">{{$venta->id}}</td>
                                    <td>{{$venta->fecha}}</td>
                                    <td>{{$venta->razon}}</td>
                                    <td>{{$venta->relUser->name}}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('detalles.indexVenta', ['detalle' => $venta->id]) }}" class="btn btn-outline-success shadow-sm">
                                                <i class="fas fa-list me-1"></i>Detalles
                                            </a>
                                            <a href="{{ route('entregas.indexVenta', ['entrega' => $venta->id]) }}" class="btn btn-outline-secondary shadow-sm">
                                                <i class="fas fa-truck me-1"></i>Entregas
                                            </a>
                                            <a href="{{ route('detalles.notaVenta', $venta) }}" class="btn btn-outline-warning shadow-sm">
                                                <i class="fas fa-file-alt me-1"></i>Nota
                                            </a>
                                            <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $venta->id }}">
                                                <i class="fas fa-edit me-1"></i>Editar
                                            </button>

                                            <!-- Modal Editar -->
                                            <div class="modal fade" id="editModal{{ $venta->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">
                                                                <i class="fas fa-edit me-2"></i>Editar Venta
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            @if($errors->any())
                                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <ul class="mb-0">
                                                                        @foreach($errors->all() as $error)
                                                                            <li>{{$error}}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>
                                                            @endif

                                                            <form action="{{route('ventas.update', $venta)}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="fecha" class="form-label fw-bold">Fecha</label>
                                                                    <input type="date" name="fecha" id="fecha" value="{{old('fecha',$venta->fecha)}}" class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="clientes_id" class="form-label fw-bold">Cliente</label>
                                                                    <select name="clientes_id" id="clientes_id" class="form-select">
                                                                        @foreach($clientes as $cliente)
                                                                            <option value="{{$cliente->id}}" {{$cliente->id==old('clientes_id',$venta->clientes_id)?'selected':''}}>
                                                                                {{$cliente->razon}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="text-center">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                        <i class="fas fa-times me-1"></i>Cancelar
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fas fa-save me-1"></i>Guardar
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $venta->id }}">
                                                <i class="fas fa-trash-alt me-1"></i>Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Eliminar -->
                                <div class="modal fade" id="exampleModal{{ $venta->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-trash-alt me-2"></i>Eliminar Venta
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center p-4">
                                                <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                                                <h5 class="mb-3">¿Está seguro que desea eliminar esta venta?</h5>
                                                <p class="text-muted">Esta acción no se puede deshacer</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-1"></i>Cancelar
                                                </button>
                                                <form action="{{ route('ventas.destroy', $venta) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="container mt-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('ventas.reporteDiario') }}" method="GET" class="row g-3 align-items-end">
                                    <div class="col-md-6">
                                        <label for="fecha_reporte" class="form-label fw-bold">
                                            <i class="fas fa-calendar-day me-1"></i>Fecha para reporte:
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" id="fecha_reporte" name="fecha" class="form-control shadow-sm" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-warning w-100 shadow-sm">
                                            <i class="fas fa-file-download me-1"></i>Reporte
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
