@extends('adminlte::page')


@section('content_header')
    <h4>Crear Cupo</h4>
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
                    <form action="{{route ('cupo.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="" class="form-label">Cupo Maximo</label>
                          <input id="cupo" name="cupo" type="text" class="form-control @error('cupo')
                            is-invalid
                          @enderror" tabindex="2">
                          @error('cupo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{$message}}</strong>
                          </span>
                      @enderror
                        </div>
                        <a href="{{route('cupo.index')}}" class="btn btn-secondary btn-sm" tabindex="5">Cancelar</a>
                        <button type="submit" class="btn btn-success btn-sm" tabindex="4">Guardar</button>
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
