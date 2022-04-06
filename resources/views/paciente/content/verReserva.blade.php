@extends('paciente.utils.header')

@section('contenido')

    @include('global.ver-reserva', ['detalleReserva' => $reserva])
@stop

@section('js')

@include('global.script-toast')

@stop
