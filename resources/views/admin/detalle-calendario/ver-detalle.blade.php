@extends('adminlte::page')

@section('title', 'Ver Detalle Calendario')

@section('content_header')
    <h1>VER DETALLES DEL CALENDARIO</h1>
    <link href="{{ asset('css/estiloadm.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card2">
                    <div class="card-header">
                        <h5><strong>Lista detalle calendario</strong></h5>
                    </div>
                    <div class="card-body2">
                        <p class="text-center "><strong>Calendario:</strong>
                            {{ $calendario->fechaInicio }} -
                            {{ $calendario->fechaFin }} </p>
                        <div class="table-responsive">
                            <table class="table table-bordered col-md-10 m-auto">
                                <thead class="table-newcolor">
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Grupo </th>
                                        <th>Stock </th>
                                        <th>Ocupado</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">
                                    @foreach ($detalles as $detalle)
                                        <tr>
                                            <td>{{ $detalle->id }}</td>
                                            <td>{{ $detalle->fecha }}</td>
                                            <td>{{ $detalle->grupo->nombre }}</td>
                                            <td>{{ $detalle->cupoMaximo }}</td>
                                            <td>{{ $detalle->cupoOcupado }}</td>

                                            @if ($detalle->estado)
                                                <td><span class="badge bg-success">Activo</span></td>
                                            @else
                                                <td><span class="badge bg-danger">Desactivado</span></td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br><br>
                    </div>
                    <div class="card-footer clearfix">
                        <h6><span class="badge bg-success">Activo</span> : El cupo sera utilizado para la reparticion de
                            cupos</h6>
                        <h6><span class="badge bg-danger">Desactivado</span>: No hace nada</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
