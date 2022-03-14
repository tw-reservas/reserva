@extends('adminlte::page')


@section('content_header')
    <h4>Crear Cupo</h4>

@stop

@section('content')
    <div class="container-fluit">
        <div class="row" style="justify-content: center;">
            <div class="col-md-8">
                <div class="card2 card-outline">
                    <div class="card-body2 pad table-responsive">
                        <div class="col-md-6">
                            <form action="{{ route('cupo.store') }}" method="POST" id="form-cupo">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Cupo Maximo</label>
                                    <input id="cupo" name="cupo" type="text"
                                        class="form-control @error('cupo') is-invalid @enderror" tabindex="2">
                                    @error('cupo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <a href="{{ route('cupo.index') }}" class="btn btn-cancelar btn-sm"
                                    tabindex="5">Cancelar</a>
                                <button type="submit" id="guardar" class="btn btn-guardar btn-sm"
                                    tabindex="4">Guardar</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p>
                            El cupo registrado se guardara y se activara.
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
            document.getElementById('guardar').onclick = function() {
                const reg = new RegExp('^[0-9]+$');
                //const regDate = new RegExp('^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$');
                cupo = document.getElementById('cupo').value;

                if (cupo === '') {
                    toastr.error("El campo CUPO es requerido");
                    return false;
                }
                if (!reg.test(cupo) && cupo !== "") {
                    toastr.error("El campo CUPO debe ser un número");
                    return false;
                }
                toastr.success('CAMPOS CORRECTOS, !!GUARDANDO CUPO!!');
                document.getElementById('form-cupo').submit();
                return false;
            }

        }
    </script>
@stop
