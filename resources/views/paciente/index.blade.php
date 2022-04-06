@extends('paciente.utils.header')

@section('contenido')
<br>
    <div class="container-fluit">
        <div class="row">
            <div class="col-md-5 col-sm-12 m-auto">
                <div class="card">
                    <div class="card-header2">
                        Ingrese los datos
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body2">
                        <form class="form-horizontal" action="{{ route('verificar.orden') }}" method="POST"
                            id="form-orden">
                            @csrf

                            <div class="form-group row">
                                <label for="id_remedy" class="col-sm-4 col-form-label">Orden de Laboratorio: </label>
                                <div class="col-sm-8">
                                    <input id="orden" name="orden" type="text" autocomplete="off"
                                        class="form-control @error('cupo') is-invalid @enderror" tabindex="2">
                                    @error('cupo')
                                        @method('POST')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-guardar btn-sm float-right" id="verificar"> Verificar
                            </button>
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
