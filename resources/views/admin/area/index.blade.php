@extends('adminlte::page')


@section('content_header')
    <h1>Listado de Areas</h1>
@stop


@section('content')
<?php
    session_start();
    if(isset($_SESSION['areasDatos'])==0){
        $_SESSION['areasDatos']=0;
    }
?>

<table class="m-auto table table-striped table-bordered shadow-lg mt-4" style="width:80%">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">CODIGO</th>
            <th scope="col">NOMBRE</th>
            <th > Opciones</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($areasDatos as $ar)
        <tr>
            <td>{{ $ar->cod_serv}}</td>
            <td>{{$ar->nombre}}</td>
            <td>
                <form action="{{route("area.delete",$ar->cod_serv)}}" method="POST">
                    <a href= "{{route("area.edit",$ar->cod_serv)}}" class="btn btn-success btn-sm">
                        <i class="fas fa-edit"></i> Editar Datos
                    </a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Borrar
                    </button>
                 </form>
            </td>

        </tr>
        @endforeach

    </tbody>
<a href= "{{route("area.create")}}" class="btn btn-success btn-sm">
        <i class="fas fa-edit"></i> Crear Area
</a>
</table>


@stop
