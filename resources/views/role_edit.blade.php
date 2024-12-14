@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-edit me-2"></i>
                    <h1 class="h3 mb-0">Editar Rol</h1>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-body p-4">
                <form action="{{ route('roles.update', [$role]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}"
                            class="form-control form-control-lg" placeholder="Ingrese el nombre del rol">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold mb-3">Permisos</label>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                            @foreach ($permissions as $permission)
                                <div class="col">
                                    <div class="form-check custom-checkbox">
                                        <input type="checkbox" class="form-check-input" id="permission_{{ $permission->id }}"
                                            name="permissions[]" value="{{$permission->name}}"
                                            {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}}>
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-save me-2"></i>Guardar
                        </button>
                        <a href="{{ route('roles.index') }}" class="btn btn-danger btn-lg px-4">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
