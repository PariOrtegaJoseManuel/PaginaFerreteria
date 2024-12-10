@extends("layouts.app")

@section("content")

    <div class="container col-md-10">
        <div class="card">
            <div class="card-header">
                Editar usuario
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
            <form action="{{route("users.update",$user)}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" id="name" name="name" value="{{old("name",$user->name)}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="text" id="email" name="email" value="{{old("email",$user->email)}}" class="form-control">

                    <div class="mb-3">
                        <div class="row">
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <label for="{{$role->id}}" class="form-check-label">{{$role->name}}</label>
                                    <input type="checkbox" id="{{$role->id}}" name="roles[]" value="{{$role->id}}" class="form-check-input">
                                    {{$user->hasRole($role->name)?"checked":""}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{route("users.index")}}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

@endsection
