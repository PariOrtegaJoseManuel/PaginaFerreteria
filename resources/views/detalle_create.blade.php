@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-header">
                Nuevo Detalle
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
                <form action="{{route("detalles.store")}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" value="{{old("cantidad")}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="ventas_id" class="form-label">Venta</label>
                        <select name="ventas_id" id="ventas_id" class="form-select">
                            @foreach($ventas as $venta)
                                <option value="{{$venta->id}}" {{$venta->id==old("ventas_id")?"selected":""}}>
                                    {{$venta->fecha}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="articulos_id" class="form-label">Articulo</label>
                        <select name="articulos_id" id="articulos_id" class="form-select">
                            @foreach($articulos as $articulo)
                                <option value="{{$articulo->id}}" {{$articulo->id==old("articulos_id")?"selected":""}}>
                                    {{$articulo->descripcion}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{route("detalles.index")}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
