<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reserva PDF</title>
</head>
<style>
    .container{
        width: 100%;
    }
    .row{
        display: flex;
        margin-right: -7.5px;
        margin-left: -7.5px;

    }
    .col-md-6{
        flex: 0 0 50%;
        max-width: 50%;
        position: relative;
        width: 100%;
        padding-right: 7.5px;
        padding-left: 7.5px;
    }
    .d-flex{
        display: flex;
    }

    .align-items-center{
        align-items: center;
    }
    .justify-content-center{
        justify-content: center;
    }

    .text-center{
        text-align: center;
    }
    .m-auto{
        margin: auto;
    }
    div{
        display: block;
    }
    .container{
        width: 100%;
        padding-right: 7.5px;
        padding-left: 7.5px;
        margin-right: auto;
        margin-left: auto;
    }
</style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img  src="{{asset('images/cps-logo.png')}}" alt="" width="90%">
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <div class="text-center " >
                        <h3>Orden Lab: <strong>{{$reserva->ordenLab->codigo}}</strong></h3>
                        <h4>Codigo ticket:  {{$reserva->id}}</h4>
                        <h3> <strong>{{$grupo->nombre}}</strong></h3>
                        <h1>Fecha: <strong>{{$reserva->detalleCalendario->fecha}}</strong></h1>
                        <h3>Hora Reservada: <br>
                        <strong>{{$grupo->horaInicio}} am - {{$grupo->horaFin}} am</strong> </h3>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>
