@extends('adminlte::page')


@section('content_header')
    <h4>Crear calendario</h4>

@stop

@section('content')
    <div class="container-fluit">
        <div class="row" style="justify-content: center;">
            <div class="col-md-8">
                <div class="card2 card-outline">
                    <!--<div class="card-header">

                            </div>-->
                    <div class="card-body2 pad table-responsive">
                        <div class="col-md-6">
                            <form action="{{ route('calendario.store') }}" method="POST" id="form-create-calendario">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="">Rango de Dias:</label>
                                    <input id="cantidad"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        name="cantidad" type="text"
                                        class="form-control @error('cantidad') is-invalid @enderror" tabindex="2">
                                    @error('cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Fecha Inicio: </label>
                                    <input id="fechaInicio" name="fechaInicio" value="{{ $fecha }}" type="date"
                                        class="form-control @error('fechaInicio') is-invalid @enderror" tabindex="2">
                                    @error('fechaInicio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <a href="{{ route('calendario.index') }}" class="btn btn-cancelar btn-sm"
                                    tabindex="5">Cancelar</a>
                                <button id="guardar" type="submit" class="btn btn-guardar btn-sm"
                                    tabindex="4">Guardar</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p>
                            Rango de dias: es la cantidad de dias que se va habilitar para la reserva;
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
                const reg = new RegExp('^[0-9]+$');
                const regDate = new RegExp(
                    '^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$'
                );
                cantidad = document.getElementById('cantidad').value;
                fechaInicio = document.getElementById('fechaInicio').value;
                console.log(regDate.test(fechaInicio), fechaInicio);
                if (cantidad === '') {
                    toastr.error("El campo RANGO DE DIAS es requerido");
                }
                if (!reg.test(cantidad) && cantidad !== "") {
                    toastr.error("El campo RANGO DE DIA debe ser un número");
                }
                if (fechaInicio === '') {
                    toastr.error("El campo FECHA DE INICIO es requerido");
                    return false;
                }
                if (regDate.test(fechaInicio) && fechaInicio !== "") {
                    toastr.error("El campo FECHA DE INICIO debe ser una fecha");
                    return false;
                }
                toastr.success('CAMPOS CORRECTOS, !!GUARDANDO CALENDARIO!!');
                document.getElementById('form-create-calendario').submit();
                return false;
            }

        }
    </script>
    @include('global.script-toast')
@stop
