@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                Nuevo Rol
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <label for="{{ $permission->id }} " class="form-check-label">{{ $permission->name }}</label>
                                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{$permission->name}}"></input>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center">

                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancelar</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
