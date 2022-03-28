@extends('adminlte::page')

@section('title', 'ver reserva')

@section('content_header')
    <h1>Orden reservado</h1>
@stop

@section('content')
    @include('global.ver-reserva', ['detalleReserva' => $detalleReserva,"admin" => "admin"])
@stop

@section('js')

@include('global.script-toast')

@stop
