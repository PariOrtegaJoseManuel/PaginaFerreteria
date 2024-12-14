@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Editar Entrega</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('entregas.updateEntrega', [$entrega, $ventaId]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="any" name="precio" id="precio"
                            value="{{ old('precio', $entrega->precio) }}"
                            class="form-control @error('precio') is-invalid @enderror">
                        @error('precio')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <label for="metodo_pagos_id" class="form-label">Metodo</label>
                                <select name="metodo_pagos_id" id="metodo_pagos_id_{{$entrega->id}}"
                                    class="form-select @error('metodo_pagos_id') is-invalid @enderror"
                                    onchange="mostrarImagenMetodo(this, 'imagenMetodoEdit{{$entrega->id}}')">
                                    @foreach ($metodo_pagos as $metodo_pago)
                                        <option value="{{ $metodo_pago->id }}"
                                            data-imagen="{{url("img/$metodo_pago->foto")}}"
                                            {{ $metodo_pago->id == old('metodo_pagos_id', $entrega->metodo_pagos_id) ? 'selected' : '' }}>
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
                                <img id="imagenMetodoEdit{{$entrega->id}}"
                                    src="{{url("img/".$entrega->relMetodoPago->foto)}}"
                                    alt="Método de pago" class="img-fluid" style="max-height: 50px;">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Guardar
                        </button>
                        <a href="{{ route('entregas.indexVenta', $ventaId) }}" class="btn btn-danger">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function mostrarImagenMetodo(select, imgId) {
            const imagen = document.getElementById(imgId);
            const selectedOption = select.options[select.selectedIndex];
            const urlImagen = selectedOption.getAttribute('data-imagen');

            imagen.src = urlImagen;
            imagen.style.display = 'block';
        }
    </script>
@endsection
