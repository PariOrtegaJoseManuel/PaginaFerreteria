@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-header">
                Editar Venta
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
                <form action="{{route("ventas.update",[$venta])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" value="{{old("fecha",$venta->fecha)}}" class="form-control">
                        <label for="clientes_id" class="form-label">Cliente</label>
                        <select name="clientes_id" id="clientes_id" class="form-select">
                            @foreach($clientes as $cliente)
                                <option value="{{$cliente->id}}" {{$cliente->id==old("clientes_id",$venta->clientes_id)?"selected":""}}>
                                    {{$cliente->razon}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{route("ventas.index")}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
