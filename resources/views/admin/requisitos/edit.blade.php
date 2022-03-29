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
                            <form action="{{ route('requisitos.update', $requisitos->id) }}" method="POST"
                                id="form-grupo">
                                @csrf
                                @method("PUT")

                                <div class="mb-3">
                                    <label for="" class="form-label">Descripcion :</label>
                                    <input id="descripcion" name="descripcion"" value = " {{ $requisitos->descripcion }}"
                                        placeholder="inserte la descripcion de Requisito" type="text"
                                        class="form-control @error('horaInicio') is-invalid @enderror" tabindex="2">
                                    @error('descripcion"')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <a href="{{ route('requisitos.index') }}" class="btn btn-secondary btn-sm"
                                    tabindex="5">Cancelar</a>
                                <button type="submit" class="btn btn-success btn-sm" id="actualizar"
                                    tabindex="4">Actualizar</button>
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
                descripcion = document.getElementById('descripcion').value;
                id = document.getElementById('id').value;

                if (descripcion === '') {
                    toastr.error("El campo DESCRIPCION es requerido");
                }
                //if(nombre.length !== 2){
                //  toastr.error("El campo NOMBRE debe");
                //}

                if (id === '') {
                    toastr.error("El campo ID es requerido");
                }

                if (descripcion != '' && id != '') {
                    toastr.success('CAMPOS CORRECTOS, !!ACTUALIZADO REQUISITO!!');
                    document.getElementById('form-grupo').submit();
                }
                return false;
            }
        }
    </script>
@stop
