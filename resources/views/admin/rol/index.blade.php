@extends('adminlte::page')


@section('title', 'Gestionar Rol')

@section('content_header')
    <h1>Gestionar Rol</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card2">
                    <!--<div class="card-header">
                                    Listado de roles
                                </div>-->
                    <div class="card-body2">
                        <div class="row text-align-center">
                            <a href="{{ route('rol.create') }}" class="btn btn-newcolor btn-sm">
                                <i class="fas fa-plus align-items-center mr-1 p-1"></i>Crear Rol</a>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered col-md-10 m-auto">
                                <thead class="table-newcolor">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Abreviatura</th>
                                        <th> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">
                                    @foreach ($roles as $rol)
                                        <tr>
                                            <td>{{ $rol->id }}</td>
                                            <td>{{ $rol->nombre }}</td>
                                            <td>{{ $rol->abreviado }}</td>
                                            <td>
                                                <form action="{{ route('rol.destroy', $rol->id) }}" method="POST">
                                                    <div class="btn-group btn-group-sm">
                                                        @csrf
                                                        <a href="{{ route('rol.show', $rol->id) }}"
                                                            class="btn btn-editar btn-sm"><i class="fas fa-pen p-0"></i></a>
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-eliminar btn-sm">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--<div class="card-footer"></div>-->
            </div>
        </div>
    </div>
@stop
