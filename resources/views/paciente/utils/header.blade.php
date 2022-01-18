@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{asset('css/bs-stepper.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.min.css')}}">
@stop

@section('body')
<!--NAV BAR-->
<nav class="navbar navbar-expand-lg navbar-light bg-ligth">
    <div class="container-fluid">
        <a href="" class="navbar-brand">
            <img class="d-none d-md-block" src="/images/cps.jfif" alt="" style="width: 80%;">
            <img class="d-md-none" src="/images/cps-logo1.svg" alt="" style="width: 4rem; ">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/paciente/">Reservar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/paciente/reserva/ver">Ver Reserva</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/paciente/reserva/resultado">Ver Resultado</a>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cancelar Reserva</a>
                </li>
                <li class="nav-item">
                    <form action="{{route('logout.paciente')}}" method="post">
                        @csrf
                        @method('POST')
                        <button class="nav-link btn btn-ligth" type="submit">Salir</button>
                    </form>

                </li>
            </ul>
        </div>
    </div>
</nav>

    <section class="content " style="background: #f4f6f9;"  >
        <div class="container-fluid">
            @yield('contenido')
        </div>
    </section>

    @section('adminlte_js')
    <script src="{{asset('js/bs-stepper.min.js')}}"></script>
    <script src="{{asset('js/main.min.js')}}"></script>
        @yield('js')
    @stop
@stop
