@extends('paciente.utils.header')


@section('contenido')
    <div class="tab-empty" style="height: 562px;">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tu Ticket Reservado =)</h3>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <img src="{{ asset('images/cps-logo.png') }}" alt="" width="90%">
                                </div>
                                <div class="col-md-5 d-flex align-items-center justify-content-center">
                                    @if ($reserva != null)
                                        <div class="text-center ">
                                            <h3>Orden Lab: <strong>{{ $reserva->ordenLab->codigo }}</strong></h3>
                                            <h4>Codigo ticket: {{ $reserva->id }}</h4>
                                            <h3> <strong>{{ $reserva->detalleCalendario->grupo->nombre }}</strong></h3>
                                            <h1>Fecha: <strong>{{ $reserva->detalleCalendario->fecha }}</strong></h1>
                                            <h3>Hora Reservada: <br>
                                                <strong>
                                                    {{ $reserva->detalleCalendario->grupo->horaInicio }} am -
                                                    {{ $reserva->detalleCalendario->grupo->horaFin }} am
                                                </strong>
                                            </h3>
                                        </div>
                                    @else
                                        <div class="m-auto">
                                            <h3>El orden de laboratorio {{ Session::get('ordenLab') }} no tiene una
                                                reserva.</h3>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('download-pdf') }}" class="btn btn-info btn-sm">imprimir</a>
                        <a href="{{ route('reserva.cancelar') }}" class="btn btn-danger btn-sm">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
