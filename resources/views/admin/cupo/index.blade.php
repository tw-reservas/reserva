@extends('adminlte::page')

@section('title', 'Administrar Cupos')

@section('content_header')
    <h1>GESTIONAR CUPOS</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-10 m-auto">
                <div class="card">
                    <!--<div class="card-header">
                        CUPOS
                    </div>-->
                    <div class="card-body">
                        <div class="row text-align-center">
                            <!--<h5>Crear Cupo   </h5>-->
                            <a href="{{route ('cupo.create')}}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus align-items-center  p-1 "></i>Crear Cupo</a>
                        </div>
                        <br>
                        <table class="table table-bordered col-md-10 m-auto">
                            <thead>
                                <tr class="btn-info">
                                    <th style="width: 10px">#</th>
                                    <th>Total</th>
                                    <th >Estado</th>
                                    <th > Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($cupos as $cupo)
                               <tr>
                                <td>{{$cupo->id}}</td>
                                <td>{{$cupo->total}}</td>

                                @if ($cupo->estado)
                                   <td><span class="badge bg-success">Activo</span></td>
                                @else
                                    <td><span class="badge bg-danger">Desactivado</span></td>
                                @endif
                                    <td>
                                        @if (!$cupo->estado)
                                            <form action="{{route ('cupo.destroy',$cupo->id)}}" method="POST">
                                            <a href="cupo/activar/{{$cupo->id}}" class="btn btn-info btn-sm">
                                                Activar
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            </form>
                                        @else
                                            <span>Active otro cupo para poder ver estas funciones</span>
                                        @endif
                                    </td>
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
    <style>
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -7.5px;
            margin-left: -7.5px;
            justify-content: flex-end;
        }
        </style>
@stop
