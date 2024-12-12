@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-header">
                Editar Cliente
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
                <form action="{{route("clientes.update",[$cliente])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="razon" class="form-label">Razon</label>
                        <input type="text" name="razon" id="razon" value="{{old("razon",$cliente->razon)}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nit" class="form-label">Nit/CI</label>
                        <input type="text" name="nit" id="nit" value="{{old("nit",$cliente->nit)}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" name="direccion" id="direccion" value="{{old("direccion",$cliente->direccion)}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="number" name="telefono" id="telefono" value="{{old("telefono",$cliente->telefono)}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" value="{{old("email",$cliente->email)}}" class="form-control">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{route("clientes.index")}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
