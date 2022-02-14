@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
@stop
<style>
.navbar-brand.abs
    {
        position: absolute;
        width: auto;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
    }

</style>
@section('body')
    <!--NAV BAR-->
    <nav class="navbar navbar-expand-lg navbar-light bg-ligth">
        <div class="d-flex flex-grow-1">
            <a href="" class="navbar-brand">
                <img class="d-none d-md-block" src="{{ asset('/images/cps.png') }}" alt="" style="width: 80%;">
                <img class="d-md-none" src="{{ asset('/images/cps-logo1.svg') }}" alt="" style="width: 4rem; ">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-grow-1 text-right" id="navbarNav">
                <ul class="navbar-nav ml-auto flex-nowrap">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('paciente.home') }}">Reservar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ver-reserva') }}">Ver Reserva</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ver-resultado') }}">Ver Resultado</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout.paciente') }}" method="post">
                            @csrf
                            @method('POST')
                            <button class="nav-link btn btn-ligth" type="submit">Salir</button>
                        </form>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="content " style="background: #f4f6f9;">
        <div class="container-fluid">
            @yield('contenido')
        </div>
    </section>
    <div class="fixed-bottom text-center container">
        @yield('footer')
    </div>

@section('adminlte_js')

    @yield('js')
@stop
@stop
