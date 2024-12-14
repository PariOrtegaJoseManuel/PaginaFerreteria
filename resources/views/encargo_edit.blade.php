@extends("layouts.app")

@section("content")
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-0 fw-bold">Editar Encargo</h1>
                </div>
            </div>

            <div class="card-body p-5">
                <form action="{{route("encargos.update",[$encargo])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="clientes_id" class="form-label fw-bold mb-3">Cliente</label>
                                <select name="clientes_id" id="clientes_id" class="form-select form-select-lg @error('clientes_id') is-invalid @enderror">
                                    @foreach($clientes as $cliente)
                                        <option value="{{$cliente->id}}" {{$cliente->id==old("clientes_id",$encargo->clientes_id)?"selected":""}}>
                                            {{$cliente->razon}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('clientes_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="descripcion_articulo" class="form-label fw-bold mb-3">Descripción del Artículo</label>
                                <input type="text" name="descripcion_articulo" id="descripcion_articulo" value="{{old("descripcion_articulo",$encargo->descripcion_articulo)}}" class="form-control form-control-lg @error('descripcion_articulo') is-invalid @enderror">
                                @error('descripcion_articulo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cantidad" class="form-label fw-bold mb-3">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" value="{{old("cantidad",$encargo->cantidad)}}" class="form-control form-control-lg @error('cantidad') is-invalid @enderror">
                                @error('cantidad')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_encargo" class="form-label fw-bold mb-3">Fecha de Encargo</label>
                                <input type="date" name="fecha_encargo" id="fecha_encargo" value="{{old("fecha_encargo",$encargo->fecha_encargo)}}" class="form-control form-control-lg @error('fecha_encargo') is-invalid @enderror">
                                @error('fecha_encargo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_entrega" class="form-label fw-bold mb-3">Fecha de Entrega</label>
                                <input type="date" name="fecha_entrega" id="fecha_entrega" value="{{old("fecha_entrega",$encargo->fecha_entrega)}}" class="form-control form-control-lg @error('fecha_entrega') is-invalid @enderror">
                                @error('fecha_entrega')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observaciones" class="form-label fw-bold mb-3">Observaciones</label>
                                <textarea name="observaciones" id="observaciones" class="form-control form-control-lg @error('observaciones') is-invalid @enderror" rows="4">{{old("observaciones",$encargo->observaciones)}}</textarea>
                                @error('observaciones')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="foto" class="form-label fw-bold mb-3">Foto</label>
                                <input type="file" id="foto" name="foto" class="form-control form-control-lg @error('foto') is-invalid @enderror">
                                @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group text-center">
                                <label class="form-label fw-bold mb-3">Vista Previa</label>
                                <img src="{{url("img/$encargo->foto")}}" alt="{{$encargo->descripcion_articulo}}" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-4 mt-5">
                        <a href="{{route("encargos.index")}}" class="btn btn-danger btn-lg px-5">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-save me-2"></i>Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
