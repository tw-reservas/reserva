@extends('adminlte::page')

@section('title', 'Administrar Reservas')

@section('content_header')
    @isset($ver)
        <h1>Ver Reserva</h1>
    @else
        <h1>Programar Reservas</h1>
    @endisset
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
                @isset($ver)
                    <form action="{{ route('reserva.verif-matricula-orden.ver') }}" id="form-mat-orden" method="POST"
                        class="form-horizontal" autocomplete="off">
                    @else
                        <form action="{{ route('reserva.verif-matricula-orden.programar') }}" id="form-mat-orden"
                            method="POST" class="form-horizontal" autocomplete="off">
                        @endisset

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
                                        <input type="text" class="form-control @error('orden_lab') is-invalid @enderror"
                                            id="orden_lab" name="orden_lab" placeholder="Ingrese el orden de laboratorio">
                                        @error('orden_lab')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success float-right">
                                    @isset($ver)
                                        Ver Reserva
                                    @else
                                        Reservar
                                    @endisset
                                </button>
                            </form>
                        </div>
                    </form>
            </div>
        </div>
    </div>

@stop

@section('js')

    <script>
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>

@stop
