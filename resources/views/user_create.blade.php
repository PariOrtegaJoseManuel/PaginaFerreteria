@extends("layouts.app")

@section("content")

<div class="container col-md-10">
    <div class="card">
        <div class="card-header">
            Nuevo usuario
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
        <form action="{{route("users.store")}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{old("name")}}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="{{old("email")}}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" value="{{old("password")}}" class="form-control">
            </div>
            <div class="mb-3">
                <div class="row d-flex flex-wrap">
                    @foreach($roles as $role)
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input type="checkbox" name="roles[]" id="role-{{$role->id}}" value="{{$role->name}}" class="form-check-input">
                                <label for="role-{{$role->id}}" class="form-check-label">{{$role->name}}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center">

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{route("users.index")}}" class="btn btn-danger">Cancelar</a>

            </div>
        </form>
    </div>
</div>

@endsection
