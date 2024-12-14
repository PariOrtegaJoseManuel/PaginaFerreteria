@extends("layouts.app")

@section("content")
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Nuevo Artículo</h1>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{route("articulos.store")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion" class="form-label fw-bold">Descripción</label>
                                <input type="text" name="descripcion" id="descripcion" value="{{old("descripcion")}}"
                                    class="form-control @error('descripcion') is-invalid @enderror">
                                @error('descripcion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="precio_unitario" class="form-label fw-bold">Precio Unitario</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" name="precio_unitario" id="precio_unitario" value="{{old("precio_unitario")}}"
                                        class="form-control @error('precio_unitario') is-invalid @enderror">
                                    @error('precio_unitario')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cantidad" class="form-label fw-bold">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" value="{{old("cantidad")}}"
                                    class="form-control @error('cantidad') is-invalid @enderror">
                                @error('cantidad')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alerta_minima" class="form-label fw-bold">Alerta Mínima</label>
                                <input type="number" name="alerta_minima" id="alerta_minima" value="{{old("alerta_minima")}}"
                                    class="form-control @error('alerta_minima') is-invalid @enderror">
                                @error('alerta_minima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto" class="form-label fw-bold">Foto</label>
                                <input type="file" id="foto" name="foto"
                                    class="form-control @error('foto') is-invalid @enderror">
                                @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="unidades_id" class="form-label fw-bold">Unidad</label>
                                        <select name="unidades_id" id="unidades_id"
                                            class="form-select @error('unidades_id') is-invalid @enderror"
                                            onchange="mostrarImagenUnidad(this)">
                                            @foreach($unidades as $unidad)
                                                <option value="{{$unidad->id}}" data-imagen="{{url('img/'.$unidad->foto)}}" {{$unidad->id==old("unidad_id")?"selected":""}}>
                                                    {{$unidad->descripcion}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('unidades_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img id="imagenUnidad" src="" alt="Imagen unidad" class="img-thumbnail mt-4" style="height: 50px; display: none;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="categorias_id" class="form-label fw-bold">Categoría</label>
                                        <select name="categorias_id" id="categorias_id"
                                            class="form-select @error('categorias_id') is-invalid @enderror"
                                            onchange="mostrarImagenCategoria(this)">
                                            @foreach($categorias as $categoria)
                                                <option value="{{$categoria->id}}" data-imagen="{{url('img/'.$categoria->foto)}}" {{$categoria->id==old("categoria_id")?"selected":""}}>
                                                    {{$categoria->nombre}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('categorias_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img id="imagenCategoria" src="" alt="Imagen categoría" class="img-thumbnail mt-4" style="height: 50px; display: none;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{route("articulos.index")}}" class="btn btn-lg btn-danger">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-lg btn-primary">
                            <i class="fas fa-save me-2"></i>Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function mostrarImagenUnidad(select) {
            const imagen = document.getElementById('imagenUnidad');
            const selectedOption = select.options[select.selectedIndex];
            const urlImagen = selectedOption.getAttribute('data-imagen');

            imagen.src = urlImagen;
            imagen.style.display = 'block';
        }

        function mostrarImagenCategoria(select) {
            const imagen = document.getElementById('imagenCategoria');
            const selectedOption = select.options[select.selectedIndex];
            const urlImagen = selectedOption.getAttribute('data-imagen');

            imagen.src = urlImagen;
            imagen.style.display = 'block';
        }

        // Mostrar las imágenes al cargar la página
        window.onload = function() {
            const selectUnidad = document.getElementById('unidades_id');
            const selectCategoria = document.getElementById('categorias_id');
            mostrarImagenUnidad(selectUnidad);
            mostrarImagenCategoria(selectCategoria);
        }
    </script>
@endsection
