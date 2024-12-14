@extends("layouts.app")

@section("content")

    <div class="container col-md-10">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Editar Usuario
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{route('users.update',$user)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name{{$user->id}}" class="form-label">Nombre</label>
                        <input type="text" id="name{{$user->id}}" name="name" value="{{old('name',$user->name)}}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email{{$user->id}}" class="form-label">Email</label>
                        <input type="email" id="email{{$user->id}}" name="email" value="{{old('email',$user->email)}}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Roles</label>
                        <div class="row ps-3">
                            @foreach($roles as $role)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="role{{$role->id}}{{$user->id}}"
                                            name="roles[]" value="{{$role->id}}"
                                            class="form-check-input @error('roles') is-invalid @enderror"
                                            {{$user->hasRole($role->name) ? 'checked' : ''}}>
                                        <label for="role{{$role->id}}{{$user->id}}" class="form-check-label">{{$role->name}}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('roles')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Guardar
                        </button>
                        <a href="{{route('users.index')}}" class="btn btn-danger">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
