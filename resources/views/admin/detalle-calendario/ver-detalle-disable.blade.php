@extends('adminlte::page')

@section('title', 'Ver Detalle Calendario')

@section('content_header')
    <h1>Desabilitar Fecha</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive">
                <div class="col-md-10 m-auto">
                    <div class="card2">
                        <div class="card-header2">
                            <h5><strong>Lista detalle calendario</strong></h5>
                        </div>
                        <div class="card-body2">
                            <p class="text-center "><strong>Calendario:</strong>
                                {{ $calendario->fechaInicio }} -
                                {{ $calendario->fechaFin }} </p>

                            <table id="datatable" class="table table-bordered">
                                <thead class="table-newcolor">
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>

                                        <th>Stock </th>
                                        <th>Ocupado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">
                                    @foreach ($detalles as $detalle)
                                        <tr>
                                            <td>{{ $detalle->id }}</td>
                                            <td>{{ $detalle->fecha }}</td>
                                            <td>{{ $detalle->cupoocupado }}</td>
                                            <td>{{ $detalle->cupomaximo }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('detalle-calendario.deshabilitar', $detalle->fecha) }}"
                                                    method="POST">
                                                    <div class="btn-group btn-group-sm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-eliminar btn-sm">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @include('global.script-toast')
@endsection
