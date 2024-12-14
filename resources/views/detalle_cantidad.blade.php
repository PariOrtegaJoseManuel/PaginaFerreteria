@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Editar Cantidad</h4>
                <a href="{{ route('detalles.indexVenta', $ventaId) }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </a>
            </div>
            <div class="card-body p-4">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('detalles.updateVenta', [$detalle, $ventaId]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="cantidad" class="form-label fw-bold">
                            <i class="fas fa-hashtag me-1"></i>Cantidad
                        </label>
                        <input type="number" name="cantidad" id="cantidad"
                            value="{{ old('cantidad', $detalle->cantidad) }}"
                            class="form-control @error('cantidad') is-invalid @enderror">
                        @error('cantidad')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <label for="metodo_pagos_id" class="form-label fw-bold">
                                    <i class="fas fa-credit-card me-1"></i>Método de Pago
                                </label>
                                <select name="metodo_pagos_id" id="metodo_pagos_id"
                                    class="form-select @error('metodo_pagos_id') is-invalid @enderror"
                                    onchange="mostrarImagenMetodo(this, 'imagenMetodo')">
                                    @foreach ($metodo_pagos as $metodo_pago)
                                        <option value="{{ $metodo_pago->id }}"
                                            data-imagen="{{url("img/$metodo_pago->foto")}}"
                                            {{ $metodo_pago->id == old('metodo_pagos_id', $detalle->metodo_pagos_id) ? 'selected' : '' }}>
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
                                <img id="imagenMetodo" src="{{url("img/".$detalle->relMetodoPago->foto)}}"
                                    alt="Método de pago" class="img-fluid" style="max-height: 50px;">
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Guardar
                        </button>
                        <a href="{{ route('detalles.indexVenta', $ventaId) }}" class="btn btn-danger">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
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
