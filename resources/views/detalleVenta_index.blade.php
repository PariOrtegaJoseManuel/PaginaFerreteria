@extends("layouts.app")

@section("content")
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <h1 class="h3 mb-0">Detalles</h1>
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

                <div class="bg-light p-4 rounded mb-4">
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
                                <th>Articulo</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                                <th>Metodo de Pago</th>
                                <th>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                        <i class="fas fa-plus me-2"></i>Añadir Articulo
                                    </button>

                                    <!-- Modal de Creación -->
                                    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="createModalLabel">Nuevo Detalle</h5>
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
                                                    <form action="{{ route('detalles.storeVenta', ['ventas_id' => $venta->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="articulos_id" class="form-label">Articulo</label>
                                                            <select name="articulos_id" id="articulos_id" class="form-select" onchange="mostrarImagen(this)">
                                                                @foreach ($articulos as $articulo)
                                                                    <option value="{{ $articulo->id }}" data-imagen="{{url("img/$articulo->foto")}}"
                                                                        {{ $articulo->id == old('articulos_id') ? 'selected' : '' }}>
                                                                        {{ $articulo->descripcion }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="d-flex justify-content-center mb-3">
                                                            <img id="imagenArticulo" src="" alt="Imagen del artículo" class="img-fluid" style="max-height: 200px; display: none;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="cantidad" class="form-label">Cantidad</label>
                                                            <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad') }}"
                                                                class="form-control">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detalles as $detalle)
                                <tr>
                                    <td class="text-center">{{$detalle->id}}</td>
                                    <td>{{$detalle->relArticulo->descripcion}}</td>
                                    <td class="text-end">{{$detalle->cantidad}}</td>
                                    <td class="text-end">${{number_format($detalle->relArticulo->precio_unitario, 2)}}</td>
                                    <td class="text-end">${{number_format($detalle->cantidad * $detalle->relArticulo->precio_unitario, 2)}}</td>
                                    <td>{{$detalle->relMetodoPago->metodo}}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $detalle->id }}">
                                                <i class="fas fa-edit me-1"></i>Editar
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $detalle->id, $venta->id}}">
                                                <i class="fas fa-trash-alt me-1"></i>Eliminar
                                            </button>

                                        </div>

                                        <!-- Modal de Edición -->
                                        <div class="modal fade" id="editModal{{ $detalle->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="editModalLabel">Editar Cantidad</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <form action="{{ route('detalles.updateVenta', [$detalle, $venta->id]) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="cantidad" class="form-label">Cantidad</label>
                                                                <input type="number" name="cantidad" id="cantidad"
                                                                    value="{{ old('cantidad', $detalle->cantidad) }}" class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-grow-1">
                                                                        <label for="metodo_pagos_id" class="form-label">Método</label>
                                                                        <select name="metodo_pagos_id" id="metodo_pagos_id_{{$detalle->id}}" class="form-select" onchange="mostrarImagenMetodo(this, 'imagenMetodoEdit{{$detalle->id}}')">
                                                                            @foreach ($metodo_pagos as $metodo_pago)
                                                                                <option value="{{ $metodo_pago->id }}" data-imagen="{{url("img/$metodo_pago->foto")}}"
                                                                                    {{ $metodo_pago->id == old('metodo_pagos_id', $detalle->metodo_pagos_id) ? 'selected' : '' }}>
                                                                                    {{ $metodo_pago->metodo }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="ms-3">
                                                                        <img id="imagenMetodoEdit{{$detalle->id}}" src="{{url("img/".$detalle->relMetodoPago->foto)}}" alt="Método de pago" class="img-fluid" style="max-height: 50px;">
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
                                    </td>
                                </tr>

                                <!-- Modal Eliminar -->
                                <div class="modal fade" id="exampleModal{{ $detalle->id, $venta->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Articulo</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center p-4">
                                                <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                                                <h5>¿Desea eliminar el detalle #{{ $detalle->id }}?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('detalles.destroyVenta', [$detalle, $venta->id]) }}" method="post">
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

    <script>
        function mostrarImagen(select) {
            const imagen = document.getElementById('imagenArticulo');
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

        // Mostrar la imagen del primer artículo y método de pago al cargar la página
        window.onload = function() {
            const select = document.getElementById('articulos_id');
            const selectMetodo = document.getElementById('metodo_pagos_id');
            mostrarImagen(select);
            mostrarImagenMetodo(selectMetodo, 'imagenMetodoCreate');
        }
    </script>
@endsection
