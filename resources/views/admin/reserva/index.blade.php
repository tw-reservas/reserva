@extends('adminlte::page')

@section('title', 'Administrar Reservas')

@section('content_header')
    <h1>Administrar Reservas</h1>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
@endsection


@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-12 m-auto">
            <div class="card">
                <div class="card-header">
                    INGRESE LOS DATOS:
                </div>
                <form action="{{ route('reserva.verificar-matricula-orden') }}" id="form-mat-orden" method="POST"
                    class="form-horizontal">
                    @csrf
                    <div class="card-body">
                        <form action="" method="POST" id="form-grupo">
                            <div class="form-group row">
                                <label for="label-matricula" class="col-sm-4 col-form-label"> Matricula: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('matricula') is-invalid @enderror"
                                        id="matricula" name="matricula" placeholder="Ingrese la matricula">

                                    @error('matricula')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="label-orden-lab" class="col-sm-4 col-form-label"> Nro. de Orden: </label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control
                                    @error('orden_lab') is-invalid @enderror"
                                        id="orden_lab" name="orden_lab" placeholder="Ingrese el orden de laboratorio">
                                    @error('orden_lab')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success float-right"> verificar </button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-sm-12 m-auto">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">bs-stepper</h3>
                </div>
                <div class="card-body p-0">
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step" data-target="#logins-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="logins-part"
                                    id="logins-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Logins</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#information-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                                    id="information-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Various information</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <div class="" id="calendar"></div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    <!--<div class="row">
                                <div class="" id="calendar"></div>
                            </div>-->
@stop

@section('js')
    <script src="{{ asset('js/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('js/main.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendario = new FullCalendar.Calendar(calendarEl, {

                initialView: 'dayGridMonth',
            });
            calendario.render();
        });
    </script>
    <script>
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>

@stop
