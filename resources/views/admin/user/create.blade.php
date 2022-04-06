@extends('adminlte::page')


@section('content_header')
    <h4>Crear Usuario</h4>
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
                            <form action="{{ route('user.store') }}" method="POST" id="form-grupo">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="">matricula:</label>
                                    <input id="matricula" placeholder="Ingrese su matricula" name="matricula"
                                        autocomplete="off" type="text"
                                        class="form-control @error('matricula') is-invalid @enderror" tabindex="2">
                                    @error('matricula')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="">Contraseña:</label>
                                            <input id="password" placeholder="Ingrese su contraseña" name="password"
                                                autocomplete="off" type="password"
                                                class="form-control @error('password') is-invalid @enderror" tabindex="2">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="">repertir contraseña:</label>
                                            <input id="password1" placeholder="repita su contraseña" name="password1"
                                                autocomplete="off" type="password"
                                                class="form-control @error('password1') is-invalid @enderror" tabindex="1">
                                            @error('password1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="">Nombre:</label>
                                    <input id="nombre" placeholder="Example: SA" name="nombre" autocomplete="off"
                                        type="text" class="form-control @error('nombre') is-invalid @enderror" tabindex="2">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="">Ap. Paterno:</label>
                                    <input id="paterno" placeholder="Apellido paterno" name="paterno" autocomplete="off"
                                        type="text" class="form-control @error('paterno') is-invalid @enderror"
                                        tabindex="2">
                                    @error('paterno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="">Ap. Materno:</label>
                                    <input id="materno" placeholder="Apellido materno" name="materno" autocomplete="off"
                                        type="text" class="form-control @error('materno') is-invalid @enderror"
                                        tabindex="2">
                                    @error('materno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="">Teléfono:</label>
                                    <input id="telefono" placeholder="telefono" name="telefono" autocomplete="off"
                                        type="text" class="form-control @error('telefono') is-invalid @enderror"
                                        tabindex="2">
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="">Correo electronico:</label>
                                    <input id="email" placeholder="email" name="email" autocomplete="off" type="text"
                                        class="form-control @error('email') is-invalid @enderror" tabindex="2">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="object-group">
                                        <label for="" class="">Seleccione un rol:</label>
                                        <select name="roles" id="rol" required style="margin-left: 5px;">
                                            @foreach ($rols as $rol)
                                                <option value="{{ $rol->id }}"> {{ $rol->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <a href="{{ route('user.index') }}" class="btn btn-cancelar btn-sm"
                                    tabindex="5">Cancelar</a>
                                <button type="submit" class="btn btn-guardar btn-sm" id="guardar"
                                    tabindex="4">Guardar</button>
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
        window.onload = function() {
            document.getElementById('guardar').onclick = function() {
                const reg = new RegExp('^[0-9]+$');
                matricula = document.getElementById('matricula').value;
                password = document.getElementById('password').value;
                password1 = document.getElementById('password1').value;
                nombre = document.getElementById('nombre').value;
                paterno = document.getElementById('paterno').value;
                materno = document.getElementById('materno').value;
                telefono = document.getElementById('telefono').value;
                email = document.getElementById('email').value;
                if (matricula === '') {
                    toastr.error("El campo MATRICULA es requerido");
                }
                if (!reg.test(matricula) && matricula !== "") {
                    toastr.error("El campo MATRICULA debe ser un número");
                }
                if (password.lenght == 0 || password.lenght == 0 && password1 != password) {
                    toastr.error("El campo Verifique el campo contraseña ");
                    return false;
                }
                if (nombre === '') {
                    toastr.error("El campo NOMBRE es requerido");
                }
                if (paterno === '') {
                    toastr.error("El campo PATERNO es requerido");
                }
                if (materno === '') {
                    toastr.error("El campo MATERNO es requerido");
                }
                if (telefono === '') {
                    toastr.error("El campo TELEFONO es requerido");
                }
                if (email === '') {
                    toastr.error("El campo CORREO es requerido");
                }
                if (email !== '' && matricula !== '' && password == password1 && nombre !== '' && paterno !== '' &&
                    materno !== '' && telefono != ''
                ) {
                    toastr.success('CAMPOS CORRECTOS, !!GUARDANDO CALENDARIO!!');
                    document.getElementById('form-create-calendario').submit();
                }
                return false;
            }
        }
    </script>
@stop
