@extends("layouts.app")

@section("content")

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Editar Categoría
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{route("categorias.update",[$categoria])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                            <input type="text" name="nombre" id="nombre" value="{{old("nombre",$categoria->nombre)}}"
                                class="form-control @error('nombre') is-invalid @enderror"
                                placeholder="Ingrese el nombre">
                            @error('nombre')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="foto" class="form-label fw-bold">Nueva Imagen</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light"><i class="fas fa-image"></i></span>
                            <input type="file" id="foto" name="foto"
                                class="form-control @error('foto') is-invalid @enderror"
                                accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="fw-bold text-center mb-2">Imagen Actual</p>
                        <div class="text-center">
                            <img src="{{url("img/$categoria->foto")}}"
                                alt="{{$categoria->nombre}}"
                                class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{route("categorias.index")}}" class="btn btn-lg btn-danger">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-lg btn-primary">
                            <i class="fas fa-save me-2"></i>Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
