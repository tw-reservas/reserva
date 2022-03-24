@extends('adminlte::page')


@section('content_header')
    <h4>Configuracion Porcentaje</h4>

@stop

@section('content')
    <div class="container-fluit">
        <div class="row" style="justify-content: center;">
            <div class="col-md-10">
                <div class="card2 card-outline">
                    <div class="card-header">
                        <h4 style="text-align: center;">Cupo Total: <strong>{{ $cupo->total }}</strong></h4>
                    </div>
                    <div class="card-body2 pad table-responsive">
                        <div class="col-md-6">
                            @if (count($grupos) == 0)
                            @endif

                            @if (count($grupos) == 0)
                                <div class="text-center">
                                    <h4>!!! Usted No tiene GRUPOS activos.!!!</h4>
                                    <h4>Por favor active primero los grupos que va necesitar.</h4>
                                    <a href="{{ route('grupo.index') }}" class="btn btn-activar btn-sm" tabindex="5">Ir a
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
                                    <a href="{{ route('grupo.index') }}" class="btn btn-activar btn-sm" tabindex="5">Ir a
                                        Activar</a>

                                    <button id="guardar" type="submit" class="btn btn-guardar btn-sm"
                                        tabindex="4">Guardar</button>

                                    <a href="{{ route('grupo.index') }}" class="btn btn-cancelar btn-sm"
                                        tabindex="5">Cancelar</a>
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
