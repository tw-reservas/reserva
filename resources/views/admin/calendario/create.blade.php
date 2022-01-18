@extends('adminlte::page')


@section('content_header')
    <h4>Crear calendario</h4>
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
                    <form action="{{route('calendario.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="">Rango de Dias:</label>
                            <input id="cantidad" name="cantidad" type="text" class="form-control @error('cantidad')
                                is-invalid
                                @enderror" tabindex="2">
                                @error('cantidad')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Inicio: </label>
                            <input id="fechaInicio" name="fechaInicio" value="{{$fecha}}" type="date" class="form-control @error('fechaInicio')
                            is-invalid
                            @enderror" tabindex="2">
                            @error('fechaInicio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <a href="{{route('calendario.index')}}" class="btn btn-secondary btn-sm" tabindex="5">Cancelar</a>
                        <button id="guardar" type="submit" class="btn btn-success btn-sm" tabindex="4">Guardar</button>
                      </form>
                   </div>
                </div>
                <div class="card-footer">
                    <p>
                        Rango de dias: es la cantidad de dias que se va habilitar para la reserva;
                    </p>
                </div>
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
