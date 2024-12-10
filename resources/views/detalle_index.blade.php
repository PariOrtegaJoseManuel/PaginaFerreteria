@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Detalles</h1>
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
                            <th>Cantidad</th>
                            <th>Venta</th>
                            <th>Articulo</th>
                            <th>
                                <a href="{{route("detalles.create")}}" class="btn btn-primary">Nuevo</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @foreach($detalles as $detalle)
                            <tr class="align-middle">
                                <td class="text-end">{{$detalle->id}}</td>
                                <td class="text-start">{{$detalle->cantidad}}</td>
                                <td class="text-start">{{$detalle->relVenta->fecha}}</td>
                                <td class="text-start">{{$detalle->relArticulo->descripcion}}</td>
                                <td class="text-center">
                                    <a href="{{ route('detalles.edit', $detalle) }}" class="btn btn-primary">
                                        Editar
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $detalle->id }}">
                                        Eliminar
                                    </button>

                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{ $detalle->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Articulo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Desea eliminar el detalle {{ $detalle->id }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{ route('detalles.destroy', $detalle) }}" method="post">
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
