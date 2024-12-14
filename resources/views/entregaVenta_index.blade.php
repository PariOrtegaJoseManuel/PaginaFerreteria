@extends("layouts.app")

@section("content")
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Entregas</h1>
                <a href="{{ route('ventas.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </a>
            </div>
            <div class="card-body">
                @if(session("mensaje"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{session("mensaje")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session("error"))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{session("error")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class=" p-4 rounded mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="text-muted mb-2">Cliente</h5>
                            <p class="h5">{{$venta->relCliente->razon}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5 class="text-muted mb-2">Fecha</h5>
                            <p class="h5">{{$venta->fecha}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5 class="text-muted mb-2">Usuario</h5>
                            <p class="h5">{{$venta->relUser->name}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5 class="text-muted mb-2">ID Venta</h5>
                            <p class="h5">#{{$venta->id}}</p>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Id</th>
                                <th>Encargo</th>
                                <th>Venta</th>
                                <th>Precio/Unidad</th>
                                <th>Total</th>
                                <th>Fecha de Pago</th>
                                <th>Metodo</th>
                                @can('entregas.create')
                                <th>
                                    <a href="{{ route('entregas.createEntrega', $venta->id) }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Nueva Entrega
                                    </a>

                                    <!-- Modal de Creación -->
                                    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="createModalLabel">Nueva Entrega</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul class="mb-0">
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    @if (session('error'))
                                                        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                                                    @endif
                                                    <form action="{{ route('entregas.storeEntrega', ['ventas_id' => $venta->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="precio" class="form-label">Precio</label>
                                                            <input type="number" name="precio" id="precio" value="{{ old('precio') }}" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="encargos_id" class="form-label">Encargo</label>
                                                            <select name="encargos_id" id="encargos_id" class="form-select" onchange="mostrarImagen(this)">
                                                                @foreach ($encargos as $encargo)
                                                                    @if($encargo->estado == 'Pendiente')
                                                                        <option value="{{ $encargo->id }}" data-imagen="{{url("img/$encargo->foto")}}"
                                                                            {{ $encargo->id == old('encargos_id') ? 'selected' : '' }}>
                                                                            {{ $encargo->descripcion_articulo }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="d-flex justify-content-center mb-3">
                                                            <img id="imagenEncargo" src="" alt="Imagen del encargo" class="img-fluid" style="max-height: 200px; display: none;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1">
                                                                    <label for="metodo_pagos_id" class="form-label">Metodo</label>
                                                                    <select name="metodo_pagos_id" id="metodo_pagos_id" class="form-select" onchange="mostrarImagenMetodo(this, 'imagenMetodoCreate')">
                                                                        @foreach ($metodo_pagos as $metodo_pago)
                                                                            <option value="{{ $metodo_pago->id }}" data-imagen="{{url("img/$metodo_pago->foto")}}"
                                                                                {{ $metodo_pago->id == old('metodo_pagos_id') ? 'selected' : '' }}>
                                                                                {{ $metodo_pago->metodo }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="ms-3">
                                                                    <img id="imagenMetodoCreate" src="" alt="Método de pago" class="img-fluid" style="max-height: 50px; display: none;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end gap-2">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entregas as $entrega)
                                <tr>
                                    <td class="text-center">{{$entrega->id}}</td>
                                    <td>{{$entrega->relEncargo->descripcion_articulo}}</td>
                                    <td class="text-end">{{$entrega->relVenta->fecha}}</td>
                                    <td class="text-end">{{number_format($entrega->precio, 2)}} Bs</td>
                                    <td class="text-end">{{number_format($entrega->total, 2)}} Bs</td>
                                    <td class="text-end">{{$entrega->fecha_pago}}</td>
                                    <td>{{$entrega->relMetodoPago->metodo}}</td>
                                    @can('entregas.edit')
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('entregas.editEntrega', [$entrega, $venta->id]) }}" class="btn btn-outline-primary">
                                                <i class="fas fa-edit me-1"></i>Editar
                                            </a>
                                            @can('entregas.destroy')
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $entrega->id , $venta->id }}">
                                                <i class="fas fa-trash-alt me-1"></i>Eliminar
                                            </button>
                                            @endcan
                                        </div>

                                        <!-- Modal de Edición -->
                                        <div class="modal fade" id="editModal{{ $entrega->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="editModalLabel">Editar Entrega</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <form action="{{ route('entregas.updateEntrega', [$entrega, $venta->id]) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="precio" class="form-label">Precio</label>
                                                                <input type="number" step="any" name="precio" id="precio" value="{{ old('precio', $entrega->precio) }}" class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-grow-1">
                                                                        <label for="metodo_pagos_id" class="form-label">Metodo</label>
                                                                        <select name="metodo_pagos_id" id="metodo_pagos_id_{{$entrega->id}}" class="form-select" onchange="mostrarImagenMetodo(this, 'imagenMetodoEdit{{$entrega->id}}')">
                                                                            @foreach ($metodo_pagos as $metodo_pago)
                                                                                <option value="{{ $metodo_pago->id }}" data-imagen="{{url("img/$metodo_pago->foto")}}"
                                                                                    {{ $metodo_pago->id == old('metodo_pagos_id', $entrega->metodo_pagos_id) ? 'selected' : '' }}>
                                                                                    {{ $metodo_pago->metodo }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="ms-3">
                                                                        <img id="imagenMetodoEdit{{$entrega->id}}" src="{{url("img/".$entrega->relMetodoPago->foto)}}" alt="Método de pago" class="img-fluid" style="max-height: 50px;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end gap-2">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Eliminar -->
                                        <div class="modal fade" id="exampleModal{{ $entrega->id , $venta->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Entrega</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center p-4">
                                                        <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                                                        <h5>¿Desea eliminar la entrega #{{ $entrega->id }}?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('entregas.destroyEntrega', [$entrega->id, $venta->id]) }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function mostrarImagen(select) {
            const imagen = document.getElementById('imagenEncargo');
            const selectedOption = select.options[select.selectedIndex];
            const urlImagen = selectedOption.getAttribute('data-imagen');

            imagen.src = urlImagen;
            imagen.style.display = 'block';
        }

        function mostrarImagenMetodo(select, imgId) {
            const imagen = document.getElementById(imgId);
            const selectedOption = select.options[select.selectedIndex];
            const urlImagen = selectedOption.getAttribute('data-imagen');

            imagen.src = urlImagen;
            imagen.style.display = 'block';
        }

        // Mostrar la imagen del primer encargo y método de pago al cargar la página
        window.onload = function() {
            const select = document.getElementById('encargos_id');
            const selectMetodo = document.getElementById('metodo_pagos_id');
            mostrarImagen(select);
            mostrarImagenMetodo(selectMetodo, 'imagenMetodoCreate');
        }
    </script>
@endsection
