@extends("layouts.app")

@section("content")

    <div class="container col-md-10">
        <div class="card">
            <div class="card-header">
                Cambiar password
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
                <form action="{{route("users.updatepassword",$user)}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="text" id="password" name="password" value="{{old("password",$user->password)}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Confirmar password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{route("users.index")}}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

@endsection
