@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Articulos</h1>
            </div>
            <div class="card-body">
                @if(session("mensaje"))
                    <div class="alert alert-success" role="alert">{{session("mensaje")}}</div>
                @endif
                @if(session("error"))
                    <div class="alert alert-danger" role="alert">{{session("error")}}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover table-striped-columns table table-bordered border-light">
                        <thead class="text-center table-light">
                        <tr class="align-middle">
                            <th>Id</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Foto</th>
                            <th>Unidad</th>
                            <th>
                                <a href="{{route("articulos.create")}}" class="btn btn-primary">Nuevo</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @foreach($articulos as $articulo)
                            <tr class="align-middle">
                                <td class="text-end">{{$articulo->id}}</td>
                                <td class="text-start">{{$articulo->descripcion}}</td>
                                <td class="text-center">{{$articulo->cantidad}}</td>
                                <td class="text-end">{{$articulo->precio_unitario}}</td>
                                <td class="text-start"><img src="{{url("img/$articulo->foto")}}" alt={{$articulo->descripcion}} height="100" width="100"></td>
                                <td class="text-start">{{$articulo->relUnidad->descripcion}}</td>
                                <td class="text-center">
                                    <a href="{{ route('articulos.edit', $articulo) }}" class="btn btn-primary">
                                        Editar
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $articulo->id }}">
                                        Eliminar
                                    </button>

                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{ $articulo->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Articulo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Desea eliminar el articulo {{ $articulo->descripcion }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{ route('articulos.destroy', $articulo) }}" method="post">
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
