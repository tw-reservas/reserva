@extends('adminlte::page')

@section('content_header')
    <h2>Crear Rol</h2>
@endsection

@section('content')
    <div class="row" style="justify-content: center;">
        <div class="col-md-8">
            <div class="card2">
                <div class="card-body2 pad table-responsive">
                    <div class="col-md-6">
                        <form action="{{ route('rol.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="inputNombre" class="">Nombre: </label>
                                <input type="text" autocomplete="off"
                                    class="form-control @error('nombre') is-valid @enderror" id="nombre" name="nombre"
                                    placeholder="Ingrese un nombre">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputNombre" class="">Abreviatura: </label>
                                <input type="text" autocomplete="off" class="form-control" id="abreviatura"
                                    name="abreviatura" placeholder="Abreviatura del rol">
                            </div>
                            <a href="{{ route('rol.index') }}" class="btn btn-cancelar btn-sm" tabindex="5">Cancelar</a>
                            <button type="submit" class="btn btn-guardar btn-sm" id="guardar">Guardar</button>
                        </form>
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
                nombre = document.getElementById('nombre').value;
                abreviatura = document.getElementById('abreviatura').value;
                if (nombre === '') {
                    toastr.error("El campo nombre es requerido");
                }

                if (abreviatura === '') {
                    toastr.error("El campo abreviatura es requerido");
                    return false;
                }

                toastr.success('CAMPOS CORRECTOS, !!GUARDANDO ROL!!');
                document.getElementById('form-create-rol').submit();
                return false;
            }

        }
    </script>
    @include('global.script-toast')
@stop
