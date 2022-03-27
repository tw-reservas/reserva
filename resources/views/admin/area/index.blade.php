@extends('adminlte::page')


@section('content_header')
    <h1>Listado de Areas</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-10 m-auto">
                <div class="card2">
                    <div class="card-body2">
                        <div class="row text-align-center">
                            <!--<h5>Crear Area  </h5>-->
                            <a href="{{ route('area.create') }}" class="btn btn-newcolor btn-sm">
                                <i class="fas fa-plus align-items-center mr-1 p-1 "></i>Crear Area</a>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered col-md-10 m-auto">
                                <thead class="table-newcolor">
                                    <tr>
                                        <th>CODIGO</th>
                                        <th>NOMBRE</th>
                                        <th> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">
                                    @foreach ($areasDatos as $ar)
                                        <tr>
                                            <td>{{ $ar->cod_serv }}</td>
                                            <td>{{ $ar->nombre }}</td>
                                            <td>
                                                <form action="{{ route('area.delete', $ar->cod_serv) }}" method="POST">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('area.edit', $ar->cod_serv) }}"
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
@section('js')
@include('global.script-toast')
@stop
