@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Pagos</h1>
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
                            <th>Encargo</th>
                            <th>Venta</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th>Metodo</th>
                            <th>
                                <a href="{{route("pagos.create")}}" class="btn btn-primary">Nuevo</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @foreach($pagos as $pago)
                            <tr class="align-middle">
                                <td class="text-end">{{$pago->id}}</td>
                                <td class="text-start">{{$pago->relEncargo ? $pago->relEncargo->descripcion_articulo : 'no es encargo'}}</td>
                                <td class="text-end">{{$pago->relVenta->fecha}}</td>
                                <td class="text-end">{{$pago->monto}}</td>
                                <td class="text-end">{{$pago->fecha_pago}}</td>
                                <td class="text-end">{{$pago->relMetodoPago->metodo}}</td>
                                <td class="text-center">
                                    <a href="{{ route('pagos.edit', $pago) }}" class="btn btn-primary">
                                        Editar
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $pago->id }}">
                                        Eliminar
                                    </button>

                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{ $pago->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Articulo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Desea eliminar el pago {{ $pago->id }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{ route('pagos.destroy', $pago) }}" method="post">
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
