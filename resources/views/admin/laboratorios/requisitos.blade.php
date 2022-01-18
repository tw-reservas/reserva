@extends('adminlte::page')


@section('content_header')
    <h1>Listado de las recomendaciones</h1>
@stop


@section('content')


<table class="m-auto table table-striped table-bordered shadow-lg mt-4" style="width:80%">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">DESCRIPCION</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($requisitosDatos as $labs)
        <tr>
            <td>{{ $labs->id}}</td>
            <td>{{$labs->descripcion}}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>

@stop