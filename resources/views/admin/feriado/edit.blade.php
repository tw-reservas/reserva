@extends('adminlte::page')


@section('content_header')
    <h4>Editar Feriado</h4>

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
                            <form action="{{ route('feriados.update', $feriado->id) }}" method="POST"
                                id="form-update-feriado">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="" class="">Titulo: </label>
                                    <input id="titulo" name="titulo" value="{{ $feriado->titulo }}" type="text"
                                        class="form-control @error('titulo') is-invalid @enderror" tabindex="2">
                                    @error('titulo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Fecha: </label>
                                    <input id="fecha" name="fecha" type="date" value="{{ $feriado->fecha }}"
                                        class="form-control @error('fecha') is-invalid @enderror" tabindex="2">
                                    @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <a href="{{ route('feriados.index') }}" class="btn btn-cancelar btn-sm"
                                    tabindex="5">Cancelar</a>
                                <button id="actualizar" type="submit" class="btn btn-guardar btn-sm"
                                    tabindex="4">Actualizar</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p>
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
            document.getElementById('actualizar').onclick = function() {
                const reg = new RegExp('^[0-9]+$');
                const regDate = new RegExp(
                    '^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$'
                );
                titulo = document.getElementById('titulo').value;
                fecha = document.getElementById('fecha').value;
                console.log(regDate.test(fecha), fecha);
                if (titulo === '') {
                    toastr.error("El campo titulo es requerido");
                }

                if (fecha === '') {
                    toastr.error("El campo FECHA es requerido");
                    return false;
                }
                if (regDate.test(fecha) && fecha !== "") {
                    toastr.error("El campo FECHA debe ser una fecha");
                    return false;
                }
                toastr.success('CAMPOS CORRECTOS, !!Actualizando Feriado!!');
                document.getElementById('form-update-feriado').submit();
                return false;
            }

        }
    </script>
    @include('global.script-toast')
@stop
