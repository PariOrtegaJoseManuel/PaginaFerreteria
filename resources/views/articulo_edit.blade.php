@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-header">
                Editar Articulo
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <form action="{{route("articulos.update",[$articulo])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <input type="text" name="descripcion" id="descripcion" value="{{old("descripcion",$articulo->descripcion)}}" class="form-control">
                        <label for="precio_unitario" class="form-label">Precio Unitario</label>
                        <input type="text" name="precio_unitario" id="precio_unitario" value="{{old("precio_unitario",$articulo->precio_unitario)}}" class="form-control">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="text" name="cantidad" id="cantidad" value="{{old("cantidad",$articulo->cantidad)}}" class="form-control">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" id="foto" name="foto" class="form-control">
                        <img src="{{url("img/$articulo->foto")}}" alt={{$articulo->descripcion}} height="50" width="50">
                        <label for="unidades_id" class="form-label">Unidad</label>
                        <select name="unidades_id" id="unidades_id" class="form-select">
                            @foreach($unidades as $unidad)
                                <option value="{{$unidad->id}}" {{$unidad->id==old("unidad_id",$articulo->unidad_id)?"selected":""}}>
                                    {{$unidad->descripcion}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{route("articulos.index")}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
