@extends('adminlte::page')

@section('title', 'Gestionar calendarios')

@section('content_header')
    <h1>DETALLE CALENDARIOS</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 m-auto">
                <div class="card2">
                    <div class="card-body2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card2">
                                    <div class="card-header">
                                        <strong>Lista de calendarios</strong>
                                    </div>
                                    <div class="card-body2">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-md col-md-12 m-auto">
                                                <thead class="table-newcolor">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>DIAS</th>
                                                        <th>FECHA INICIO</th>
                                                        <th>FECHA FIN</th>
                                                        <th>ESTADO</th>
                                                        <th>OPCIÓN</th>
                                                    </tr>
                                                </thead>
                                                <tbody  class="tbody2">
                                                    @foreach ($calendarios as $calendario)
                                                        <tr>
                                                            <td>{{ $calendario->id }}</td>
                                                            <td>{{ $calendario->cantidad }}</td>
                                                            <td>{{ $calendario->fechaInicio }}</td>
                                                            <td>{{ $calendario->fechaFin }}</td>
                                                            @if ($calendario->estado)
                                                                <td><span class="badge bg-success">Repartido</span></td>
                                                                <td><a href="{{ route('detalle-calendario.ver', $calendario->id) }}"
                                                                        class="btn btn-verdetalle btn-sm">Ver Detalles</a>
                                                                </td>
                                                            @else
                                                                <td><span class="badge bg-info">Pendiente</span></td>

                                                                <td>
                                                                    @if (count($grupos) == 0)
                                                                        <a href="{{ route('grupo.index') }}"
                                                                            class="btn btn-info btn-sm"> Activar Grupos</a>
                                                                    @endif
                                                                    @if ($cupo == null)
                                                                        <a href="{{ route('cupo.index') }}"
                                                                            class="btn btn-info btn-sm"> Activar Cupo</a>
                                                                    @endif
                                                                    @if (count($grupos) > 0 && $cupo != null)
                                                                        <a href="{{ route('detalle-calendario.repartir', [$calendario->id, $cupo->id]) }}"
                                                                            class="btn btn-warning btn-sm"> Repartir </a>
                                                                    @endif
                                                                    @if ($cupo != null && $sumaCupo != $cupo->total)
                                                                        <a href="{{ route('grupo.conf-porcentaje') }}"
                                                                            class="btn btn-warning btn-sm"> Configurar
                                                                            porcentaje </a>
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card2">
                                    <div class="card-header">
                                        <strong>Grupos Activos</strong>
                                    </div>
                                    <div class="card-body2">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-md col-md-11 m-auto">
                                                <thead class="table-newcolor">
                                                    <tr class="tr-sm">
                                                        <th>#</th>
                                                        <th>NOMBRE</th>
                                                        <th>HORA INICIO</th>
                                                        <th>HORA FIN</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($grupos as $grupo)
                                                        <tr>
                                                            <td>{{ $grupo->id }}</td>
                                                            <td>{{ $grupo->nombre }}</td>
                                                            <td>{{ $grupo->horaInicio }}</td>
                                                            <td>{{ $grupo->horaFin }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <h6><span class="badge bg-success">Repartir</span> Repartira los cupos a todo el calendario</h6>
                        <h6><span class="badge bg-danger">ADVENTENCIA</span>: No se puede deshacer esta opcion</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        @if ($cupo != null && $sumaCupo != $cupo->total)
            toastr.error("La suma del stock de los grupos: ".$sumaCupo.", no es igual al cupo total activo: ".$cupo->total);
        @endif
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (Session::has('activado'))
            toastr.success("{{ session('activado') }}");
        @endif
        @if (Session::has('desactivado'))
            toastr.success("{{ session('desactivado') }}");
        @endif
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>

@stop
