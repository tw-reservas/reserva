@extends('adminlte::page')


@section('content_header')
    <h1>Requisitos para Lab</h1>

@stop


@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-10 m-auto">
                <div class="card2">
                    <div class="card-body2">
                        <div class="row text-align-center">
                            <!--<h5>Crear grupo   </h5>-->
                            <a href="{{ route('requisitos.create') }}" class="btn btn-newcolor btn-sm">
                                <i class="fas fa-plus align-items-center mr-1 p-1 "></i>Crear Requisito</a>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered col-md-10 m-auto">
                                <thead class="table-newcolor">
                                    <tr>
                                        <th>ID</th>
                                        <th>DESCRIPCION</th>
                                        <th> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">
                                    @foreach ($requisitosDatos as $req)
                                        <tr>
                                            <td>{{ $req->id }}</td>
                                            <td>{{ $req->descripcion }}</td>
                                            <td>
                                                <form action="{{ route('requisitos.delete', $req->id) }}" method="POST">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('requisitos.edit', $req->id) }}"
                                                            class="btn btn-editar btn-sm">
                                                            <i class="fas fa-pen p-0"></i>
                                                        </a>
                                                        @csrf
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
            </div>
        </div>
    </div>
@stop
