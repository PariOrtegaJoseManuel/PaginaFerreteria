@extends("layouts.app")

@section("content")
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Editar Encargo</h1>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body p-4">
                <form action="{{route("encargos.update",[$encargo])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="clientes_id" class="form-label fw-bold">Cliente</label>
                                <select name="clientes_id" id="clientes_id" class="form-select">
                                    @foreach($clientes as $cliente)
                                        <option value="{{$cliente->id}}" {{$cliente->id==old("clientes_id",$encargo->cliente_id)?"selected":""}}>
                                            {{$cliente->razon}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion_articulo" class="form-label fw-bold">Descripción del Artículo</label>
                                <input type="text" name="descripcion_articulo" id="descripcion_articulo" value="{{old("descripcion_articulo",$encargo->descripcion_articulo)}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cantidad" class="form-label fw-bold">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" value="{{old("cantidad",$encargo->cantidad)}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_encargo" class="form-label fw-bold">Fecha de Encargo</label>
                                <input type="date" name="fecha_encargo" id="fecha_encargo" value="{{old("fecha_encargo",$encargo->fecha_encargo)}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado" class="form-label fw-bold">Estado</label>
                                <select name="estado" id="estado" class="form-select">
                                    <option value="pendiente" {{$encargo->estado=="pendiente"?"selected":""}} class="text-warning">Pendiente</option>
                                    <option value="en_proceso" {{$encargo->estado=="en_proceso"?"selected":""}} class="text-info">En Proceso</option>
                                    <option value="completado" {{$encargo->estado=="completado"?"selected":""}} class="text-success">Completado</option>
                                    <option value="cancelado" {{$encargo->estado=="cancelado"?"selected":""}} class="text-danger">Cancelado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="observaciones" class="form-label fw-bold">Observaciones</label>
                                <textarea name="observaciones" id="observaciones" class="form-control" rows="3">{{old("observaciones",$encargo->observaciones)}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_entrega" class="form-label fw-bold">Fecha de Entrega</label>
                                <input type="date" name="fecha_entrega" id="fecha_entrega" value="{{old("fecha_entrega",$encargo->fecha_entrega)}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="foto" class="form-label fw-bold">Foto</label>
                                <input type="file" id="foto" name="foto" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group text-center">
                                <img src="{{url("fotos/$encargo->foto")}}" alt="{{$encargo->descripcion_articulo}}" class="img-thumbnail mt-2" style="height: 100px;">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{route("encargos.index")}}" class="btn btn-lg btn-danger">
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
