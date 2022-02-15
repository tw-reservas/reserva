@extends('adminlte::page')

@section('title', 'Gestionar calendarios')

@section('content_header')
<h1>GESTIONAR CALENDARIOS</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-10 m-auto">
            <div class="card">
                <div class="card-header">
                    Lista de calendarios
                </div>
                <div class="card-body">
                    <div class="row text-align-center">
                        <h5>Crear calendario </h5>
                        <a href="{{route ('calendario.create')}}" class="btn btn-success btn-sm mb-4">CREAR</a>
                    </div>
                    <br>

                    <table class="table table-bordered col-md-10 m-auto">
                        <thead>
                            <tr class="bg-primary">
                                <th style="width: 10px">#</th>
                                <th scope="col">RANGO DE DIAS</th>
                                <th scope="col">FECHA INICIO</th>
                                <th scope="col">FECHA FIN</th>
                                <th scope="col">ESTADO</th>
                                <th scope="col">OPCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calendarios as $calendario)
                            <tr>
                                <td>{{ $calendario->id}}</td>
                                <td>{{$calendario->cantidad}}</td>
                                <td>{{$calendario->fechaInicio}}</td>
                                <td>{{$calendario->fechaFin}}</td>
                                @if ($calendario->estado)
                                <td><span class="badge bg-success">Repartido</span></td>
                                @else
                                <td><span class="badge bg-info">Pendiente</span></td>
                                @endif
                                <td>
                                    <form action="{{route ('calendario.destroy',$calendario->id)}}" method="POST">

                                        @csrf
                                        @method('DELETE')
                                        @if (!$calendario->estado)
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Borrar
                                        </button>
                                        @else
                                        <a href="/admin/detalle-calendario/ver/{{$calendario->id}}"
                                            class="btn btn-info btn-sm">Ver Detalles</a>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
@if(Session::has('error'))
toastr.error("{{session('error')}}");
@endif
@if(Session::has('activado'))
toastr.success("{{session('activado')}}");
@endif
@if(Session::has('desactivado'))
toastr.success("{{session('desactivado')}}");
@endif
@if(Session::has('success'))
toastr.success("{{session('desactivado')}}");
@endif
</script>

<script>
< script >
    @stop
