@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Ventas</h1>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="{{ route('ventas.index') }}" method="GET">
                        <div class="row">
                            <div class="container col-4">
                                <label for="razon" class="form-label">Razon Social:</label>
                                <input type="text" list="razon" class="form-control" placeholder="Ingrese la razon social" name="razon" value="{{ old('razon') }}">
                                <datalist id="razon">
                                    @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->razon }}"></option>
                                    @endforeach
                                  </datalist>
                                </div>
                            <div class="container col-3">
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input type="date" class="form-control" name="fecha" value="{{ old('fecha') }}">
                            </div>
                            <div class="container col-1 align-self-end">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="container">
                    @if(session("mensaje"))
                        <div class="alert alert-success" role="alert">{{session("mensaje")}}</div>
                    @endif
                    @if(session("error"))
                        <div class="alert alert-danger" role="alert">{{session("error")}}</div>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped-columns table table-bordered border-light">
                        <thead class="text-center table-light">
                            <tr class="align-middle">
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>
                                    <a href="{{route("ventas.create")}}" class="btn btn-primary">Nuevo</a>
                                </th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @foreach($ventas as $venta)
                            <tr class="align-middle">
                                <td class="text-end">{{$venta->id}}</td>
                                <td class="text-start">{{$venta->fecha}}</td>
                                <td class="text-start">{{$venta->razon}}</td>
                                <td class="text-start">{{$venta->relUser->name}}</td>
                                <td class="text-center">
                                    <a href="{{ route('detalles.indexVenta', ['detalle' => $venta->id]) }}" class="btn btn-primary">
                                        Detalles
                                    </a>
                                    <a href="{{ route('ventas.edit', $venta) }}" class="btn btn-primary">
                                        Editar
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $venta->id }}">
                                        Eliminar
                                    </button>

                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{ $venta->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Articulo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Desea eliminar la venta {{ $venta->descripcion }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{ route('ventas.destroy', $venta) }}" method="post">
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
