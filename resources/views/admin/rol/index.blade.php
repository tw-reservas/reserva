@extends('adminlte::page')


@section('title', 'Gestionar Rol')

@section('content_header')
    <h1>Gestionar Rol</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 col-sm-12">
            <div class="card card-default">
                <div class="card-header">
                    Listado de roles
                </div>
                <div class="card-body">
                    <div class="row text-align-center">
                        <h5>Crear rol </h5>
                        <a href="{{ route('rol.create') }}" class="btn btn-success btn-sm mb-4">CREAR</a>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-sm-10">
                            <table class="table table-bordered col-md-10 m-auto">
                                <thead>
                                    <tr class="bg-success">
                                        <th style="width: 10px">#</th>
                                        <th>Nombre</th>
                                        <th>Abreviatura</th>
                                        <th> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $rol)
                                        <tr>

                                            <td>{{ $rol->id }}</td>
                                            <td>{{ $rol->nombre }}</td>
                                            <td>{{ $rol->abreviado }}</td>
                                            <td>
                                                <form action="{{ route('rol.destroy', $rol->id) }}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('rol.show', $rol->id) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-pen"></i>Editar</a>
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Borrar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
@stop
