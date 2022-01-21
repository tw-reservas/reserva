@extends('paciente.utils.header')


@section('contenido')

<?php
    session_start();
    if(isset($_SESSION['resultadosc'])==0){
        $_SESSION['resultadosc']=0;
    }
?>
<div class="col s12 ">
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
</div>

<div class="footer">
    <div class="footer-copyright">
        <div class="container" style="margin-top:5px ">
            © 2021 INF513 GRUPO 17 SC
            <a class="black-text text-lighten-4 right" href="#!">Visitas a la página:
                <?php echo $_SESSION['resultadosc'] += 1 ; ?></a>
        </div>
    </div>
</div>
</div>

@endsection
