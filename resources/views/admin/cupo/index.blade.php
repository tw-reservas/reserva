@extends('adminlte::page')

@section('title', 'Administrar Cupos')

@section('content_header')
    <h1>GESTIONAR CUPOS</h1>

@stop

@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-10 m-auto">
                <div class="card2">
                    <!--<div class="card-header">
                                    CUPOS
                                </div>-->
                    <div class="card-body2">
                        <div class="row text-align-center">
                            <!--<h5>Crear Cupo   </h5>-->
                            <a href="{{ route('cupo.create') }}" class="btn btn-newcolor btn-sm">
                                <i class="fas fa-plus align-items-center mr-1 p-1"></i>Crear Cupo</a>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered col-md-10 m-auto">
                                <thead class="table-newcolor">
                                    <tr>
                                        <th>#</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">
                                    @foreach ($cupos as $cupo)
                                        <tr>
                                            <td>{{ $cupo->id }}</td>
                                            <td>{{ $cupo->total }}</td>
                                            @if ($cupo->estado)
                                                <td><span class="badge bg-success">Activo</span></td>
                                            @else
                                                <td><span class="badge bg-danger">Desactivado</span></td>
                                            @endif
                                            <td>
                                                @if (!$cupo->estado)
                                                    <form action="{{ route('cupo.destroy', $cupo->id) }}" method="POST">
                                                        <a href="cupo/activar/{{ $cupo->id }}"
                                                            class="btn btn-activar btn-sm">
                                                            Activar
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span>Active otro cupo para poder ver estas funciones</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br><br>
                    </div>
                    <div class="card-footer clearfix">
                        <h6><span class="badge bg-success">Activo</span> : El cupo sera utilizado para la reparticion de
                            cupos</h6>
                        <h6><span class="badge bg-danger">Desactivado</span>: No hace nada</h6>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
