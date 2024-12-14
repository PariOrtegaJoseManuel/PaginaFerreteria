@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-plus-circle me-2"></i>
                    <h1 class="h3 mb-0">Nuevo Rol</h1>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control form-control-lg shadow-sm @error('name') is-invalid @enderror"
                            placeholder="Ingrese el nombre del rol">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold mb-3">Permisos</label>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                            @foreach ($permissions as $permission)
                                <div class="col">
                                    <div class="form-check custom-checkbox">
                                        <input type="checkbox"
                                            class="form-check-input shadow-sm @error('permissions') is-invalid @enderror"
                                            id="permission_{{ $permission->id }}"
                                            name="permissions[]"
                                            value="{{$permission->name}}">
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('permissions')
                            <div class="text-danger mt-2">
                                Debe seleccionar al menos un permiso
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="fas fa-save me-2"></i>Guardar
                        </button>
                        <a href="{{ route('roles.index') }}" class="btn btn-danger btn-lg px-4 shadow-sm">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
