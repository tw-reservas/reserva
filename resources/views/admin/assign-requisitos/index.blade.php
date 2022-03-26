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

                                    @forelse ($laboratorios as $labs)
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
                                            <td class="col-md-2">

                                                <div class="form-group">
                                                    <select class="form-control form-control-sm"
                                                        onchange="location=this.value">
                                                        <option>Opciones</option>
                                                        <option
                                                            value="{{ route('show.page.add.requisitos', $labs->id) }}">
                                                            Agregar
                                                            requisitos</option>
                                                        <option
                                                            value="{{ route('show.page.delete.requisitos', $labs->id) }}">
                                                            eliminar requisitos</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6"> No existen Laboratorios</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('global.script-toast')
@endsection
