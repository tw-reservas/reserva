@extends('adminlte::page')

@section('title', 'Gestionar Usuario')

@section('content_header')
    <h1>Feriados</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@stop
@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="table-responsive">
                <div class="col-md-10">
                    <div class="card2">
                        <!--<div class="card-header">
                                                                                                                                                                                        Lista de Usuarios
                                                                                                                                                                                    </div>-->

                        <div class="card-body2">
                            <div class="row text-align-center">
                                <!--<h5>Crear Usuario </h5>-->
                                <a href="{{ route('feriados.create') }}" class="btn btn-newcolor btn-sm">
                                    <i class="fas fa-user-plus p-1"></i></a>
                            </div>
                            <br>
                            <table id="example" class="table table-bordered  ">
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

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script>
        $('#example').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            responsive: true,
            autoWidth: false,
            columns: [{
                    data: "#",
                    orderable: false
                },

            ],
        });
    </script>
@stop
