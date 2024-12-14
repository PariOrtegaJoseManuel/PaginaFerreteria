@extends("layouts.app")

@section("content")

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Unidad
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{route("unidades.store")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="descripcion" class="form-label fw-bold">Descripción</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                            <input type="text" name="descripcion" id="descripcion" value="{{old("descripcion")}}"
                                class="form-control @error('descripcion') is-invalid @enderror"
                                placeholder="Ingrese la descripción">
                            @error('descripcion')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="foto" class="form-label fw-bold">Imagen</label>
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
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{route("unidades.index")}}" class="btn btn-lg btn-danger">
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

@endsection
