@extends('adminlte::page')


@section('content_header')
    <h4>Editar Requisito</h4>
@stop

@section('content')
    <div class="container-fluit">
        <div class="row" style="justify-content: center;">
            <div class="col-md-10">
                <div class="card2 card-outline">
                    <!--<div class="card-header">

                                    </div>-->
                    <div class="card-body2 pad table-responsive">
                        <div class="col-md-6">
                            <form action="{{ route('area.update', $area->cod_serv) }}" method="POST" id="form-grupo">
                                @csrf
                                @method("PUT")
                                <div class="mb-3">
                                    <label for="" class="">Codigo Servicio :</label>
                                    <input id="cod_serv" value="{{ $area->cod_serv }}"
                                        placeholder="inserte codigo del area-CPS" name="cod_serv" autocomplete="off"
                                        type="text" class="form-control @error('nombre') is-invalid @enderror" tabindex="2">
                                    @error('cod_serv')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Nombre :</label>
                                    <input id="nombre" name="nombre" value="{{ $area->nombre }}"
                                        placeholder="inserte el nombre del area" type="text"
                                        class="form-control @error('horaInicio') is-invalid @enderror" tabindex="2">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <a href="{{ route('area.index') }}" class="btn btn-cancelar btn-sm"
                                    tabindex="5">Cancelar</a>
                                <button type="submit" class="btn btn-guardar btn-sm" id="actualizar" tabindex="4">Actualizar
                                </button>
                            </form>
                        </div>
                    </div>
                    <!--<div class="card-footer">
                                    </div>-->
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
                const regHora = new RegExp('^([01]?[0-9]|2[0-3]):[0-5][0-9]$');

                nombre = document.getElementById('nombre').value;
                cod_serv = document.getElementById('cod_serv').value;

                if (nombre === '') {
                    toastr.error("El campo NOMBRE es requerido");
                }

                if (cod_serv === '') {
                    toastr.error("El campo CODIGO DE SERVICIO es requerido");
                }

                if (nombre != '' && cod_serv != '') {
                    toastr.success('CAMPOS CORRECTOS, !!GUARDANDO AREA!!');
                    document.getElementById('form-grupo').submit();
                }
                return false;
            }
        }
    </script>
@stop
