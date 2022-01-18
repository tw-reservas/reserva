@extends('adminlte::page')


@section('content_header')
    <h1>Listado de Areas de los Laboratorios</h1>
@stop


@section('content')


<table class="m-auto table table-striped table-bordered shadow-lg mt-4" style="width:80%">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">CODIGO</th>
            <th scope="col">NOMBRE</th>
                        
        </tr>
    </thead>
    <tbody>
        @foreach ($areasDatos as $labs)
        <tr>
            <td>{{ $labs->cod_serv}}</td>
            <td>{{$labs->nombre}}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>

@stop