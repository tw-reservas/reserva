@extends('paciente.utils.header')

@section('contenido')

    <div class="tab-content">
        <div class="tab-empty" style="height: 100%;">
            <br>
            <div class="col-md-6  m-auto p-3">
                <div class="card card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Ingresar</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ route('verificar.orden') }}" method="POST" id="form-orden">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="id_remedy" class="col-form-label">Orden de Laboratorio: </label>
                                <div class="col-sm-8">
                                    <input id="orden" name="orden" type="text" autocomplete="off"
                                        class="form-control @error('cupo')
                                is-invalid
                              @enderror"
                                        tabindex="2">
                                    @error('cupo')
                                        @method('POST')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-body">
                            <button type="submit" class="btn bg-olive color-palette btn-sm" tabindex="4"
                                id="verificar">Verificar</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .label {
            display: inline-block;
            margin-bottom: 0.5rem;
            padding: 0.5rem;
        }

    </style>

@stop

@section('js')

    <script>
        window.onload = function() {
            document.getElementById('verificar').onclick = function() {
                const reg = new RegExp('^[0-9]+$');
                orden = document.getElementById('orden').value;

                if (orden === '') {
                    toastr.error("El campo ORDEN DE LABORATORIO es requerido");
                    return false;
                }
                if (orden.length < 6 || orden.length > 10) {
                    toastr.error("El campo ORDEN DE LABORATORIO es incorrecto");
                    return false;
                }
                if (!reg.test(orden) && orden !== "") {
                    toastr.error("El campo ORDEN debe ser un número");
                    return false;
                }
                if (reg.test(orden) && orden.length > 6) {
                    toastr.success('CAMPOS CORRECTOS, !!VERIFICANDO ORDEN!!');
                    document.getElementById('form-orden').submit();
                }
                return false;
            }

        }
    </script>


    <script>
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

@stop
