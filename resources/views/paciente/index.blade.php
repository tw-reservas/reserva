@extends('paciente.utils.header')

@section('contenido')
    <div class="row">
       <div class="col-ms-6  m-auto p-3">
        <div class="card card-success card-outline">
            <div class="card-header">
                Ingrese el ORDEN del laboratorio
            </div>
            <div class="card-body">
                <form action="{{route('verificar.orden')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="" class="form-label">Orden Laboratorio: </label>
                      <input id="orden" name="orden" type="text" class="form-control @error('cupo')
                        is-invalid
                      @enderror" tabindex="2">
                      @error('cupo')
                      @method('POST')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                      </span>
                  @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-sm" tabindex="4">Guardar</button>
                  </form>
            </div>
        </div>
       </div>
    </div>

@stop

@section('js')
<script>
    @if (Session::has('error'))
        toastr.error("{{session('error')}}");
    @endif
</script>

@stop
