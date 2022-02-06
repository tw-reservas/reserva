<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reserva PDF</title>
</head>
<style>
    .container {
        width: 100%;
    }

    .row {
        display: flex;
        margin-right: -7.5px;
        margin-left: -7.5px;

    }

    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
        position: relative;
        width: 100%;
        padding-right: 7.5px;
        padding-left: 7.5px;
    }

    .d-flex {
        display: flex;
    }

    .align-items-center {
        align-items: center;
    }

    .justify-content-center {
        justify-content: center;
    }

    .text-center {
        text-align: center;
    }

    .m-auto {
        margin: auto;
    }

    div {
        display: block;
    }

    .container {
        width: 100%;
        padding-right: 7.5px;
        padding-left: 7.5px;
        margin-right: auto;
        margin-left: auto;
    }

    .text-size {
        font-size: 8pt;
        line-height: 50%;
    }

</style>

<body>
    <table style="text-align:center;">
        <tr>
            <td>
                <img src="{{ asset('images/cps-logo.png') }}" alt="" height="250px">
            </td>
            <td>
                <p style="font-size: 150%">Orden Lab: <strong>{{ $reserva->ordenLab->codigo }}</strong>
                    <br>Codigo ticket: {{ $reserva->id }}
                    <br><strong>{{ $grupo->nombre }}</strong>
                </p>
                <p style="font-size: 180%">Fecha: <strong>{{ $reserva->detalleCalendario->fecha }}</strong></p>
                <p style="font-size: 150%">Hora Reservada: <br>
                    <strong>{{ $grupo->horaInicio }} am - {{ $grupo->horaFin }} am</strong>
                </p>
            </td>
        </tr>
    </table>
</body>

</html>
