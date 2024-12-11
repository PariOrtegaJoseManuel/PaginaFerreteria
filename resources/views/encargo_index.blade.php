@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Encargos</h1>
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
                            <th>Cliente</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Fecha Encargo</th>
                            <th>Estado</th>
                            <th>Observaciones</th>
                            <th>Fecha Entrega</th>
                            <th>
                                <a href="{{route("encargos.create")}}" class="btn btn-primary">Nuevo</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @foreach($encargos as $encargo)
                            <tr class="align-middle">
                                <td class="text-end">{{$encargo->id}}</td>
                                <td class="text-start">{{$encargo->relCliente->razon}}</td>
                                <td class="text-end">{{$encargo->descripcion_articulo}}</td>
                                <td class="text-end">{{$encargo->cantidad}}</td>
                                <td class="text-end">{{$encargo->fecha_encargo}}</td>
                                <td class="text-end">{{$encargo->estado}}</td>
                                <td class="text-end">{{$encargo->observaciones}}</td>
                                <td class="text-end">{{$encargo->fecha_entrega}}</td>
                                <td class="text-center">
                                    <a href="{{ route('encargos.edit', $encargo) }}" class="btn btn-primary">
                                        Editar
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $encargo->id }}">
                                        Eliminar
                                    </button>

                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{ $encargo->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Encargo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Desea eliminar el encargo {{ $encargo->id }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{ route('encargos.destroy', $encargo) }}" method="post">
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
