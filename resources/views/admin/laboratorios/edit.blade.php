@extends('adminlte::page')


@section('content_header')
    <h4>Editar Laboratorio </h4>
@stop

@section('content')

<div class="container-fluit">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success card-outline">
                <div class="card-header">

                </div>
                <div class="card-body pad table-responsive">
                   <div class="col-md-6">
                    <form action="{{route ('laboratorios.update',$laboratorio->id)}}" method="POST" id = "form-grupo">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <label for="" class="">ID del laboratorio :</label>
                            <input id="id" value = "{{$laboratorio->id}}" placeholder="inserte el id del laboratorio : "
                             name="id" autocomplete="off" type="text" class="form-control @error('id')
                                is-invalid
                            @enderror" tabindex="2">
                            @error('id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="">Codigo Arancel :</label>
                            <input id="cod_arancel" value = "{{$laboratorio->cod_arancel}}" placeholder="inserte codigo del area-CPS"
                             name="cod_arancel" autocomplete="off" type="text" class="form-control @error('cod_arancel')
                                is-invalid
                            @enderror" tabindex="2">
                            @error('cod_arancel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="">Nombre del Laboratorio : </label>
                            <input id="nombre" value = "{{$laboratorio->nombre}}" placeholder="inserte el nombre del laboratorio"
                             name="nombre" autocomplete="off" type="text" class="form-control @error('nombre')
                                is-invalid
                            @enderror" tabindex="2">
                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="">Estado del Laboratorio : </label>
                            <input id="estado" value = "{{$laboratorio->estado}}" placeholder="inserte estado de ese laboratorio"
                             name="estado" autocomplete="off" type="text" class="form-control @error('estado')
                                is-invalid
                            @enderror" tabindex="2">
                            @error('estado')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="">Requisito ID :</label>
                            <input id="requisito_id" value = "{{$laboratorio->requisito_id}}" placeholder="inserte el id el requisito"
                             name="requisito_id" autocomplete="off" type="text" class="form-control @error('requisito_id')
                                is-invalid
                            @enderror" tabindex="2">
                            @error('requisito_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Area del Codigo :</label>
                                    <input id="area_cod" name="area_cod" value = "{{$laboratorio->area_cod}}"
                                     placeholder="inserte el codigo del area " type="text" class="form-control @error('area_cod')
                                        is-invalid
                                    @enderror" tabindex="2">
                                    @error('area_cod')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <a href="{{route('laboratorios.index')}}" class="btn btn-secondary btn-sm" tabindex="5">Cancelar</a>
                        <button type="submit" class="btn btn-success btn-sm" id = "actualizar" tabindex="4">Actualizar</button>
                      </form>
                   </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    window.onload= function(){
        document.getElementById('actualizar').onclick = function(){
            const reg = new RegExp('^[0-9]+$');
            const regHora = new RegExp('^([01]?[0-9]|2[0-3]):[0-5][0-9]$');

            id = document.getElementById('id').value;
            cod_arancel = document.getElementById('cod_arancel').value;
            nombre = document.getElementById('nombre').value;
            estado = document.getElementById('estado').value;
            requisito_id = document.getElementById('requisito_id').value;
            area_cod = document.getElementById('area_cod').value;

            if(id === ''){
                toastr.error("El campo ID es requerido");
            }
            if(cod_arancel === ''){
                toastr.error("El campo CODIGO DE ARANCEL es requerido");
            }
            if(nombre === ''){
                toastr.error("El campo NOMBRE es requerido");
            }
            if(estado === ''){
                toastr.error("El campo ESTADO es requerido");
            }
            if(requisito_id === ''){
                toastr.error("El campo REQUISITO es requerido");
            }
            if(area_cod === ''){
                toastr.error("El campo CODIGO DEL AREA es requerido");
            }
            if(id != ''  && cod_arancel != '' && nombre != '' && estado != '' && requisito_id != '' && area_cod != '' ){
                toastr.success('CAMPOS CORRECTOS, !! ACTUALIZANDO LABORATORIOS!!');
                document.getElementById('form-grupo').submit();
            }
            return false;
        }
    }
</script>
@stop
