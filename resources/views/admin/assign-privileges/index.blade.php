@extends('adminlte::page')
@section('content_header')
    <h1>Asignar Privilegios</h1>
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
                                                <a href="{{ route('rol.show', $rol->id) }}"
                                                    class="btn btn-editar btn-sm"><i class="fas fa-pen p-0"></i> asignar</a>
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
