@extends('adminlte::page')


@section('content_header')
    <h4>Configuracion Porcentaje</h4>
    <h3>Cupo Total: {{ $cupo->total }}</h3>
@stop

@section('content')
    <?php
    session_start();
    if (isset($_SESSION['grupos']) == 0) {
        $_SESSION['grupos'] = 0;
    }
    ?>
    <div class="container-fluit">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success card-outline">
                    <div class="card-header">

                    </div>
                    <div class="card-body pad table-responsive">
                        <div class="col-md-6">

                            @if (count($grupos) == 0)
                                <div class="text-center">
                                    <h4>!!! Usted No tiene GRUPOS activos.!!!</h4>
                                    <h4>Por favor active primero los grupos que va necesitar.</h4>
                                    <a href="{{ route('grupo.index') }}" class="btn btn-secondary btn-sm" tabindex="5">Ir a
                                        Activar</a>
                                </div>
                            @else
                                <form id="form-porc" action="{{ route('grupo.conf-porcentaje.post') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="cupo" name="cupo" value="{{ $cupo->total }}">
                                    @foreach ($grupos as $grupo)
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nombre: {{ $grupo->nombre }}</label>
                                            <input id="{{ $grupo->id }}" placeholder="Ingrese un número"
                                                name="{{ $grupo->id }}" value="" type="text"
                                                class="form-control @error('nombre') is-invalid @enderror">
                                            @error('nombre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @endforeach
                                    <a href="{{ route('grupo.index') }}" class="btn btn-info btn-sm" tabindex="5">Ir a
                                        Activar</a>
                                    <a href="{{ route('grupo.index') }}" class="btn btn-secondary btn-sm"
                                        tabindex="5">Cancelar</a>
                                    <button id="guardar" type="submit" class="btn btn-success btn-sm"
                                        tabindex="4">Guardar</button>
                                </form>
                            @endif

                        </div>
                    </div>
                    <div class="card-footer">
                        <p>
                            @if (count($grupos) <= 0)
                                Por favor ACTIVE los grupos que necesita.
                            @else
                                Puede repartir el CUPO TOTAL, en los GRUPOS activos.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="padding-right: 80px">
        <div class="row">
            <div class="col s6 m4 l2 offset-s6 offset-m8 offset-l10">
                <div class="left-align">
                    <div class="card-panel teal">
                        <span class="white-text">Nro. de Visitas: <?php echo $_SESSION['grupos'] += 1; ?></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


@section('js')
    <script>
        window.onload = function() {
            document.getElementById('guardar').onclick = function() {
                //document.getElementById('form-porc').submit();
                sum = 0;
                form = document.getElementById('form-porc');
                for (let index = 0; index < form.elements.length; index++) {
                    if (!isNaN(form.elements[index].name)) {
                        if (form.elements[index].value === '') {

                        } else {
                            //console.log(form.elements[index].value);
                            sum = parseInt(sum) + parseInt(form.elements[index].value);
                        }
                    }
                }
                cupo = document.getElementById('cupo').value;
                console.log(cupo);
                console.log(sum);
                if (sum <= 0) {
                    toastr.error("Los campos de los grupos no pueden estar vacios");
                    return false;
                }
                if (cupo < sum || cupo > sum) {
                    toastr.error("La suma de los stock de cupo de los  grupos no es igual a Cupo Total: " + cupo);
                    return false;
                }
                document.getElementById('form-porc').submit();
                return false;
            }
        }
    </script>
    <script>
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
@stop
