@extends('adminlte::page')


@section('content_header')
    <h1>Listado de las recomendaciones</h1>
@stop


@section('content')
<?php
    session_start();
    if(isset($_SESSION['requisitosDatos'])==0){
        $_SESSION['requisitosDatos']=0;
    }
?>

<table class="m-auto table table-striped table-bordered shadow-lg mt-4" style="width:80%">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">DESCRIPCION</th>
            <th > Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($requisitosDatos as $req)
        <tr>
            <td>{{ $req->id}}</td>
            <td>{{$req->descripcion}}</td>
            <td>
                <form action="{{route("requisitos.delete",$req->id)}}" method="POST">
                    <a href= "{{route("requisitos.edit",$req->id)}}" class="btn btn-success btn-sm">
                        <i class="fas fa-edit"></i> Editar
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
    <a href= "{{route("requisitos.create")}}" class="btn btn-success btn-sm">
        <i class="fas fa-edit"></i> Crear Requisito
</a>
</table>

@stop
