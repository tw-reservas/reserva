@extends('adminlte::page')

@section('content_header')
    <h1>Asignar Requisitos</h1>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-10 m-auto">
                <div class="card2">
                    <div class="card-body2">
                        <div class="row text-align-center">
                            <!--<h5>Crear grupo   </h5>-->
                            <a href="{{ route('laboratorios.create') }}" class="btn btn-newcolor btn-sm">
                                <i class="fas fa-plus align-items-center mr-1 p-1"></i>Crear Laboratorio</a>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered col-md-10 m-auto">
                                <thead class="table-newcolor">
                                    <tr>
                                        <th style="width: 10%">#</th>
                                        <th>Area</th>
                                        <th>Cod. Arancel</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">
                                    @foreach ($laboratorios as $labs)
                                        <tr>
                                            <td>{{ $labs->id }}</td>
                                            <td>{{ $labs->area->nombre }}</td>
                                            <td>{{ $labs->cod_arancel }}</td>
                                            <td>{{ $labs->nombre }}</td>
                                            @if ($labs->estado)
                                                <td>Activo</td>
                                            @else
                                                <td>Desactivado</td>
                                            @endif
                                            <td>

                                                <form action="{{ route('laboratorios.delete', $labs->id) }}"
                                                    method="POST">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('laboratorios.edit', $labs->id) }}"
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
@endsection
