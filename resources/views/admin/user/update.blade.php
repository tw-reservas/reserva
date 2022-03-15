@extends('adminlte::page')


@section('content_header')
    <h4>Crear Usuario</h4>
@stop

@section('content')
    <div class="container-fluit">
        <div class="row">
            <div class="col-md-12">
                <div class="card2 card-outline">
                    <div class="card-header">

                    </div>
                    <div class="card-body2 pad table-responsive">
                        <div class="col-md-6">
                            <form action="{{ route('user.update', $user->id) }}" method="POST" id="form-grupo">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="" class="">Nombre:</label>
                                    <input id="nombre" disabled placeholder="Example: SA" name="nombre" autocomplete="off"
                                        value="{{ $user->name }}" type="text"
                                        class="form-control @error('nombre') is-invalid @enderror" tabindex="2">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="">Ap. Paterno:</label>
                                    <input id="paterno" disabled placeholder="Apellido paterno" name="paterno"
                                        autocomplete="off" value="{{ $user->apellidoPaterno }}" type="text"
                                        class="form-control @error('paterno') is-invalid @enderror" tabindex="2">
                                    @error('paterno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="">Ap. Materno:</label>
                                    <input id="materno" disabled placeholder="Apellido materno" name="materno"
                                        value="{{ $user->apellidoMaterno }}" autocomplete="off" type="text"
                                        class="form-control @error('materno') is-invalid @enderror" tabindex="2">
                                    @error('materno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="">Teléfono:</label>
                                    <input id="telefono" placeholder="telefono" name="telefono" autocomplete="off"
                                        value="{{ $user->telefono }}" type="text"
                                        class="form-control @error('telefono') is-invalid @enderror" tabindex="2">
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--<div class="mb-3">
                                        <label for="" class="">Correo electronico:</label>
                                        <input id="email" placeholder="email" name="email" autocomplete="off"
                                            value="{{ $user->email }}" type="text"
                                            class="form-control @error('email') is-invalid @enderror" tabindex="2">
                                        @error('email')
        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
    @enderror
                                    </div>-->

                                <div class="col-md-6">
                                    <div>
                                        <select name="roles" id="rol" required>
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->id }}"
                                                    @if ($rol->id == $user->rol_id) selected @endif> {{ $rol->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="" class="">Seleccione un rol:</label>
                                    </div>
                                </div>

                                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm"
                                    tabindex="5">Cancelar</a>
                                <button type="submit" class="btn btn-success btn-sm" id="guardar"
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
                telefono = document.getElementById('telefono').value;
                email = document.getElementById('email').value;

                if (telefono === '') {
                    toastr.error("El campo TELEFONO es requerido");
                }
                if (email === '') {
                    toastr.error("El campo CORREO es requerido");
                }

                if (email !== '' && telefono != '') {
                    toastr.success('CAMPOS CORRECTOS, !!GUARDANDO CALENDARIO!!');
                    document.getElementById('form-create-calendario').submit();
                }

                return false;
            }
        }
    </script>
@stop
