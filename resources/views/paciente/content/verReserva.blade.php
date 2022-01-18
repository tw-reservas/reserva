@extends('paciente.utils.header')


@section('contenido')

<div class="card-header">
    <h3 class="card-title">Tu Ticket reservado =)</h3>
</div>

<table id="verReserva" class="m-auto table  shadow-lg mt-4" style="width:60%">
    <br>

    <tr style="text-align:center">
        <td scope="col" style="vertical-align:middle; text-align:center">
            <img class="d-none d-md-block" src="/images/cps-logo.png" alt="" style="width: 75%;" >
        </td>
        <td scope="col">
            @if ($reserva != null)

                <div class="col-16" >
                    <h3>Orden Lab: {{$reserva->ordenLab->codigo}}</h3>
                    <h4>Codigo ticket {{$reserva->id}}</h4>
                    <h3>{{$grupo->nombre}}</h3>
                    <h1>Fecha: {{$reserva->detalleCalendario->fecha}}</h1>
                    <h3>Hora Reservada: <br>
                    {{$grupo->horaInicio}} am - {{$grupo->horaFin}} am</h3>
                </div>
            @endif

        </td>
    </tr>
    <tbody>
    </tbody>
</table>

<br>
    <form action="" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="fas fa-trash"></i>
            CANCELAR
        </button>
</form>



@endsection
