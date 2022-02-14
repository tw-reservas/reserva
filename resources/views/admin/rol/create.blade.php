@extends('adminlte::page')

@section('content_header')
    <h2>Crear Rol</h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-sm-12">
            <div class="card card-succes">
                <div class="card header">

                </div>
                <div class="card-body">
                    <form action="{{ route('rol.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="inputNombre" class="col-sm-2 col-form-label">Nombre: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('nombre') is-valid @enderror" id="nombre"
                                    name="nombre" placeholder="Ingrese un nombre">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputNombre" class="col-sm-2 col-form-label">Abreviatura: </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="abreviatura" name="abreviatura"
                                    placeholder="Abreviatura del rol">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@stop
