@extends('adminlte::page')


@section('content_header')
    <h4>Crear Grupo</h4>
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
                    <form action="{{route ('grupo.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="">Nombre:</label>
                            <input id="nombre" placeholder="Example: SA" name="nombre" autocomplete="off" type="text" class="form-control @error('nombre')
                                is-invalid
                            @enderror" tabindex="2">
                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Hora Inicio:</label>
                                    <input id="horaInicio" name="horaInicio" type="time" value="05:00" class="form-control @error('horaInicio')
                                        is-invalid
                                    @enderror" tabindex="2">
                                    @error('horaInicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label for="" class="form-label">Hora Fin:</label>
                                    <input id="horaFin" name="horaFin" type="time" value="06:00" class="form-control @error('horaFin')
                                        is-invalid
                                    @enderror" tabindex="2">
                                    @error('horaFin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <a href="{{route('grupo.index')}}" class="btn btn-secondary btn-sm" tabindex="5">Cancelar</a>
                        <button type="submit" class="btn btn-success btn-sm" tabindex="4">Guardar</button>
                      </form>
                   </div>
                </div>
                <div class="card-footer">
                    <p>
                        El grupo registrado tendra cupo 0, dar click en Config. %, para repartir los porcentajes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
