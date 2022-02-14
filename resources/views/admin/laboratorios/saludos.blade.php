@extends('adminlte::page')


@section('content_header')
    <h1>Listado de labs</h1>
@stop


@section('content')
<?php
    session_start();
    if(isset($_SESSION['laboratoriosDatos'])==0){
        $_SESSION['laboratoriosDatos']=0;
    }
?>

<table class="m-auto table table-striped table-bordered shadow-lg mt-4" style="width:80%">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">COD_ARANCEL</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">ESTADO</th>
            <th scope="col">REQUISITO_ID</th>
            <th scope="col">AREA_COD</th>
            <th > Opciones</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($laboratoriosDatos as $labs)
        <tr>
            <td>{{ $labs->id}}</td>
            <td>{{$labs->cod_arancel}}</td>
            <td>{{ $labs->nombre}}</td>
            @if ($labs->estado)
                <td>Activo</td>
            @else
                <td>Desactivado</td>
            @endif
            <td>{{ $labs->requisito_id}} </td>
            <td>{{ $labs->area_cod}} </td>

            <td>
                <form action="{{route("laboratorios.delete",$labs->id)}}" method="POST">
                    <a href= "{{route("laboratorios.edit",$labs->id)}}" class="btn btn-success btn-sm">
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
    <a href= "{{route("laboratorios.create")}}" class="btn btn-success btn-sm">
        <i class="fas fa-edit"></i> Crear Laboratorio
</a>
</table>

@stop
