@extends('adminlte::page')

@section('title', 'Gestionar Grupos')

@section('content_header')
    <h1>GESTIONAR GRUPOS</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-10 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row text-align-center">
                            <!--<h5>Crear grupo   </h5>-->
                            <a href="{{route ('grupo.create')}}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus align-items-center  p-1 "></i>Crear Grupo</a>
                        </div>
                        <br>

                        <table class="table table-bordered col-md-10 m-auto">
                            <thead>
                                <tr class="btn-info">
                                    <th style="width: 10px">#</th>
                                    <th>Nombre</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                    <th>Stock</th>
                                    <th >Estado</th>
                                    <th > Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($grupos as $grupo)
                               <tr>
                                <td> {{$grupo->id}} </td>
                                <td> {{$grupo->nombre}} </td>
                                <th> {{$grupo->horaInicio }} </th>
                                <th> {{$grupo->horaFin}} </th>
                                <th> {{$grupo->porcentaje}} </th>
                                @if ($grupo->estado)
                                   <td><span class="badge bg-success">Activo</span></td>
                                @else
                                    <td><span class="badge bg-danger">Desactivado</span></td>
                                @endif
                                    <td>
                                        <form action="{{route ('grupo.destroy',$grupo->id)}}" method="POST">
                                            @if ($grupo->estado)
                                                <a id ="desactivar" href="grupo/activar/{{$grupo->id}}" class="btn btn-warning btn-sm">Desactivar</a>
                                            @else
                                                <a href="grupo/activar/{{$grupo->id}}" class="btn btn-info btn-sm">Activar</a>
                                            @endif
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-10 m-auto pt-3 text-right">
                            <a href="{{route('grupo.conf-porcentaje.get')}}" role="button" class="btn btn-secondary btn-sm"><i class="fas fa-sliders-h pr-2"></i>Config. % Grupos</a>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <h6><span class="badge bg-success">Activo</span> : El grupo sera utilizado para la reparticion de grupos</h6>
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

@section('js')
<script>
    @if (Session::has('error'))
        toastr.error("{{session('error')}}");
    @endif
    @if (Session::has('activado'))
        toastr.success("{{session('activado')}}");
    @endif
    @if (Session::has('desactivado'))
        toastr.success("{{session('desactivado')}}");
    @endif
    @if (Session::has('success'))
        toastr.success("{{session('desactivado')}}");
    @endif
</script>

<script>

<script>
@stop
