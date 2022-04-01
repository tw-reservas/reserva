@extends('adminlte::page')


@section('content_header')
    <h1>Listado de Laboratorios</h1>
@stop


@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="table-responsive">
                <div class="col-md-10 m-auto">
                    <div class="card2">
                        <div class="card-body2">
                            <div class="row text-align-center">
                                <!--<h5>Crear grupo   </h5>-->
                                <a href="{{ route('laboratorios.create') }}" class="btn btn-newcolor btn-sm">
                                    <i class="fas fa-plus align-items-center mr-1 p-1"></i>Crear Laboratorio</a>
                            </div>
                            <br>
                            <table id="datatable" class="table table-bordered">
                                <thead class="table-newcolor">
                                    <tr>
                                        <th>Id</th>
                                        <th>Area</th>
                                        <th>Cod_arancel</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>

                                        <th> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">
                                    @foreach ($laboratorios as $lab)
                                        <tr>
                                            <td>{{ $lab->id }}</td>
                                            <td>{{ $lab->area->nombre }}</td>
                                            <td>{{ $lab->cod_arancel }}</td>
                                            <td>{{ $lab->nombre }}</td>
                                            @if ($lab->estado)
                                                <td>Activo</td>
                                            @else
                                                <td>Desactivado</td>
                                            @endif
                                            <td>
                                                <form action="{{ route('laboratorios.delete', $lab->id) }}" method="POST">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('laboratorios.edit', $lab->id) }}"
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
@endsection
