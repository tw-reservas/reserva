@extends('adminlte::page')
@section('title', 'Recuperar Contraseña')

@section('content_header')
    <h1>Cambiar contraseña</h1>
@stop
@section('content')
    <div class="container-fluit">
        <div class="row" style="justify-content: center;">
            <div class="col-md-8">
                <div class="card2 card-outline">
                    <div class="card-body2 pad table-responsive">
                        <div class="col-md-6">
                            <form action="{{ route('show.change-password.post') }}" method="POST" id="form-change-pass">
                                @csrf

                                <label for="" class="">Contraseña actual:</label>
                                <div class="input-group mb-3">
                                    <input id="password_actual" placeholder="contraseña actual" name="password_actual"
                                        autocomplete="off" type="password"
                                        class="form-control @error('password_actual') is-invalid @enderror" tabindex="2">
                                    @error('password_actual')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>

                                <label for="" class="">Contraseña nueva:</label>
                                <div class="input-group mb-3">
                                    <input id="password" placeholder="contraseña nueva" name="password" autocomplete="off"
                                        type="password" class="form-control @error('password') is-invalid @enderror"
                                        tabindex="2">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>

                                <label for="" class="">Confirmar contraseña:</label>
                                <div class="input-group mb-3">
                                    <input id="verify_password" placeholder="confirmar contraseña" name="verify_password"
                                        autocomplete="off" type="password"
                                        class="form-control @error('verify_password') is-invalid @enderror" tabindex="2">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @error('verify_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-guardar btn-sm" id="recover"
                                    tabindex="4">Cambiar</button>
                            </form>
                        </div>
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
                password = document.getElementById('password').value;
                verify_password = document.getElementById('verify_password').value;

                if (password === '' || verify_password === "") {
                    toastr.error("El campo no pueden estar vacio");
                    return false;;
                }
                if (password != verify_password) {
                    toastr.error("Los campos no coinciden");
                    return false;;
                }


                toastr.success('CAMPOS CORRECTOS,\n !!Cambiando Contraseña!!');
                document.getElementById('form-recover-pass').submit();
                return false;
            }
        }
    </script>


    @include('global.script-toast')

@stop
