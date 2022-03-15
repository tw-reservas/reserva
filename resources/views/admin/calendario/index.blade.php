@extends('adminlte::page')

@section('title', 'Gestionar calendarios')

@section('content_header')
    <h1>GESTIONAR CALENDARIOS</h1>

@stop

@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-10 m-auto">
                <div class="card2">
                    <!--<div class="card-header">
                                            Lista de calendarios
                                        </div>-->
                    <div class="card-body2">
                        <div class="row text-align-center">
                            <!--<h5>Crear calendario </h5>-->
                            <a href="{{ route('calendario.create') }}" class="btn btn-newcolor btn-sm mb-4">
                                <i class="fas fa-plus align-items-center mr-1 p-1"></i>Crear Calendario</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered col-md-10 m-auto">
                                <thead class="table-newcolor">
                                    <tr>
                                        <th>#</th>
                                        <th>RANGO DE DIAS</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA FIN</th>
                                        <th>ESTADO</th>
                                        <th>OPCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">
                                    @foreach ($calendarios as $calendario)
                                        <tr>
                                            <td>{{ $calendario->id }}</td>
                                            <td>{{ $calendario->cantidad }}</td>
                                            <td>{{ $calendario->fechaInicio }}</td>
                                            <td>{{ $calendario->fechaFin }}</td>
                                            @if ($calendario->estado)
                                                <td><span class="badge bg-success">Repartido</span></td>
                                            @else
                                                <td><span class="badge bg-info">Pendiente</span></td>
                                            @endif
                                            <td>
                                                <form action="{{ route('calendario.destroy', $calendario->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    @if (!$calendario->estado)
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @else
                                                        <a href="{{ route('detalle-calendario.ver', $calendario->id) }}"
                                                            class="btn btn-verdetalle btn-sm">Ver Detalles</a>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <h6><span class="badge bg-success">Activo</span> : El calendario sera utilizado para la reparticion
                            de calendarios</h6>
                        <h6><span class="badge bg-danger">Desactivado</span>: No hace nada</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
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
            toastr.success("{{ session('desactivado') }}");
        @endif
    </script>
@stop
