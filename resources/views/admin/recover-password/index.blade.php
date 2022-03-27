@extends('adminlte::page')
@section('title', 'Recuperar Contraseña')

@section('content_header')
    <h1>RESTABLECER CONSTRASEÑA</h1>
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
                            <form action="{{ route('restore.password') }}" method="POST" id="form-recover-pass">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="">Matricula:</label>
                                    <input id="matricula" placeholder="Ingrese la matricula" name="matricula"
                                        autocomplete="off" type="text"
                                        class="form-control @error('matricula') is-invalid @enderror" tabindex="2">
                                    @error('matricula')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-guardar btn-sm" id="recover"
                                    tabindex="4">Restablecer</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p>
                            Al restablecer la contraseña, se le asigna como contraseña el numero de matricula.
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
            document.getElementById('recover').onclick = function() {
                const reg = new RegExp('^[0-9]+$');
                matricula = document.getElementById('matricula').value;


                if (matricula === '') {
                    toastr.error("El campo MATRICULA es requerido");
                    return false;;
                }
                if (!reg.test(matricula) && matricula !== "") {
                    toastr.error("El campo MATRICULA debe ser un número");
                    return false;;
                }


                toastr.success('CAMPOS CORRECTOS, !!Restableciendo Contraseña!!');
                document.getElementById('form-recover-pass').submit();
                return false;
            }
        }
    </script>



@include('global.script-toast')
@stop
