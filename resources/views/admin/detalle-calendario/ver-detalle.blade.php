@extends('adminlte::page')

@section('title', 'Ver Detalle Calendario')

@section('content_header')
    <h1>VER DETALLES DEL CALENDARIO</h1>
@stop



@section('content')
<?php
    session_start();
    if(isset($_SESSION['calendarios'])==0){
        $_SESSION['calendarios']=0;
    }
?>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-10 m-auto">
                <div class="card">
                    <div class="card-header">
                        Lista detalle calendario
                    </div>
                    <div class="card-body">
                        <p class="text-center "><strong>Calendario:</strong>
                            {{$calendario->fechaInicio}}  -
                            {{$calendario->fechaFin}} </p>
                        <table class="table table-bordered col-md-10 m-auto">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th > Fecha</th>
                                    <th> Grupo </th>
                                    <th> Stock </th>
                                    <th>Ocupado</th>
                                    <th>Estado</th>

                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($detalles as $detalle)
                               <tr>
                                <td>{{$detalle->id}}</td>
                                <td>{{$detalle->fecha}}</td>
                                <td>{{$detalle->grupo->nombre}}</td>
                                <td>{{$detalle->cupoMaximo}}</td>
                                <td>{{$detalle->cupoOcupado}}</td>

                                @if ($detalle->estado)
                                   <td><span class="badge bg-success">Activo</span></td>
                                @else
                                    <td><span class="badge bg-danger">Desactivado</span></td>
                                @endif

                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                        <br><br>
                    </div>
                    <div class="card-footer clearfix">
                        <h6><span class="badge bg-success">Activo</span> : El cupo sera utilizado para la reparticion de cupos</h6>
                        <h6><span class="badge bg-danger">Desactivado</span>: No hace nada</h6>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="padding-right: 80px">
        <div class="row">
            <div class="col s6 m4 l2 offset-s6 offset-m8 offset-l10">
                <div class="left-align" >
                    <div class="card-panel teal">
                        <span class="white-text">Nro. de Visitas: <?php echo $_SESSION['calendarios'] += 1; ?></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
