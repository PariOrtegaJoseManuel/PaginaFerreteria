@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Unidades</h1>
            </div>
            <div class="card-body">
                @if (session('mensaje'))
                    <div class="alert alert-success" role="alert">{{ session('mensaje') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered border-light">
                        <thead class="text-center table-light">
                            <tr class="align-middle">
                                <th>Id</th>
                                <th>Descripcion</th>
                                <th>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                        Nuevo
                                    </button>

                                    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCrearLabel">Nueva Unidad</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach($errors->all() as $error)
                                                                    <li>{{$error}}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <form action="{{route("unidades.store")}}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="descripcion" class="form-label">Descripcion</label>
                                                            <input type="text" name="descripcion" id="descripcion" value="{{old("descripcion")}}" class="form-control">
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($unidades as $unidad)
                                <tr class="align-middle">
                                    <td class="text-end">{{ $unidad->id }}</td>
                                    <td class="text-start">{{ $unidad->descripcion }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$unidad->id}}">
                                            Editar
                                        </button>
                                        <div class="modal fade" id="editModal{{$unidad->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Editar Unidad</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach($errors->all() as $error)
                                                                        <li>{{$error}}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <form action="{{route('unidades.update', $unidad)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="descripcion" class="form-label">Descripcion</label>
                                                                <input type="text" name="descripcion" id="descripcion" value="{{old('descripcion',$unidad->descripcion)}}" class="form-control">
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $unidad->id }}">
                                            Eliminar
                                        </button>

                                    </td>
                                </tr>
                                <div class="modal fade" id="exampleModal{{ $unidad->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Unidad</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Desea eliminar la unidad {{ $unidad->descripcion }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <form action="{{ route('unidades.destroy', $unidad) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
