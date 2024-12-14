@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Nuevo Detalle</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('detalles.storeVenta', ['ventas_id' => $venta->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="articulos_id" class="form-label">Articulo</label>
                        <select name="articulos_id" id="articulos_id" class="form-select @error('articulos_id') is-invalid @enderror" onchange="mostrarImagen(this)">
                            @foreach ($articulos as $articulo)
                                <option value="{{ $articulo->id }}" data-imagen="{{url("img/$articulo->foto")}}"
                                    {{ $articulo->id == old('articulos_id') ? 'selected' : '' }}>
                                    {{ $articulo->descripcion }}
                                </option>
                            @endforeach
                        </select>
                        @error('articulos_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center mb-3">
                        <img id="imagenArticulo" src="" alt="Imagen del artículo" class="img-fluid" style="max-height: 200px; display: none;">
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad') }}"
                            class="form-control @error('cantidad') is-invalid @enderror">
                        @error('cantidad')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <label for="metodo_pagos_id" class="form-label">Metodo</label>
                                <select name="metodo_pagos_id" id="metodo_pagos_id" class="form-select @error('metodo_pagos_id') is-invalid @enderror" onchange="mostrarImagenMetodo(this, 'imagenMetodoCreate')">
                                    @foreach ($metodo_pagos as $metodo_pago)
                                        <option value="{{ $metodo_pago->id }}" data-imagen="{{url("img/$metodo_pago->foto")}}"
                                            {{ $metodo_pago->id == old('metodo_pagos_id') ? 'selected' : '' }}>
                                            {{ $metodo_pago->metodo }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('metodo_pagos_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="ms-3">
                                <img id="imagenMetodoCreate" src="" alt="Método de pago" class="img-fluid" style="max-height: 50px; display: none;">
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('detalles.indexVenta', ['detalle' => $venta->id]) }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
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
