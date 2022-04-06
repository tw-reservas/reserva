@extends('adminlte::page')

@section('title', 'Gestionar Usuario')

@section('content_header')
    <h1>Feriados</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="table-responsive">
                <div class="col-md-10 m-auto">
                    <div class="card2">

                        <div class="card-body2">
                            <div class="row text-align-center">
                                <!--<h5>Crear Usuario </h5>-->
                                <a href="{{ route('feriados.create') }}" class="btn btn-newcolor btn-sm">
                                    <i class="fas fa-plus align-items-center mr-1 p-1 "></i>Agregar feriado</a>
                            </div>
                            <br>
                            <table id="datatable" class="table table-bordered  ">
                                <thead class="table-newcolor">
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Titulo</th>
                                        <th>Fecha</th>
                                        <th> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">
                                    @foreach ($feriados as $feriado)
                                        <tr>
                                            <td> {{ $feriado->id }} </td>
                                            <td> {{ $feriado->titulo }} </td>
                                            <td> {{ $feriado->fecha }} </td>
                                            <td>
                                                <form action="{{ route('feriados.destroy', $feriado->id) }}"
                                                    method="POST">
                                                    <div class="btn-group btn-group-sm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('feriados.show', $feriado->id) }}"
                                                            class="btn btn-editar btn-sm">
                                                            <i class="fas fa-pen p-0"></i></a>
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
