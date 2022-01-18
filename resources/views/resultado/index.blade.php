@extends('paciente.utils.header')


@section('contenido')

<div class="card-header">
    <h3 class="card-title">Mis resultados</h3>
</div>
<br>
<table id="resultado" class="m-auto table  table-bordered shadow-lg mt-4" style="width:70%">
    <thead class="bg-info text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">FECHA</th>
            <th scope="col">DIRECCION_URL</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($resultadosc as $result)
        <tr>
            <td>{{$result->id}}</td>
            <td>{{$result->fecha}}</td>
            <td><a href='{{$result->direccion_url}}'>{{$result->direccion_url}}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--
<img class="d-none d-md-block" src="/images/resultadosLab/lab-resultado.jpg" alt="" style="width: 90%;" >
-->
@endsection