@extends('adminlte::page')


@section('content_header')
    <h1>Listado de Areas de los Laboratorios</h1>
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
<div class="footer">
    <div class="footer-copyright">
        <div class="container" style="margin-top:5px ">
            © 2021 INF513 GRUPO 17 SC
            <a class="black-text text-lighten-4 right" href="#!">Visitas a la página:
                <?php echo $_SESSION['areasDatos'] += 1 ; ?></a>
        </div>
    </div>
</div>
@stop
