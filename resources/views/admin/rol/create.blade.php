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
                                <input type="text" class="form-control @error('nombre') is-valid @enderror" id="nombre"
                                    name="nombre" placeholder="Ingrese un nombre">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputNombre" class="">Abreviatura: </label>
                                <input type="text" class="form-control" id="abreviatura" name="abreviatura"
                                    placeholder="Abreviatura del rol">
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
