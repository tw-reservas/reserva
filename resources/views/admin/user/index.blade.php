@extends('adminlte::page')

@section('title', 'Gestionar Usuario')

@section('content_header')
    <h1>Gestionar Usuarios</h1>
@stop
@section('css')
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">-->
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">-->
@stop
@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="table-responsive">
                <div class="col-md-12">
                    <div class="card2">
                        <!--<div class="card-header">
                                Lista de Usuarios
                            </div>-->
                        <div class="card-body2">
                            <div class="row text-align-center">
                                <!--<h5>Crear Usuario </h5>-->
                                <a href="{{ route('user.create') }}" class="btn btn-newcolor btn-sm">
                                    <i class="fas fa-user-plus p-1"></i></a>
                            </div>
                            <br>
                            <table id="datatable" class="table table-bordered">
                                <thead class="table-newcolor">
                                    <tr>
                                        <th>#</th>
                                        <th>Matricula</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Teléfono</th>

                                        <th>Rol</th>
                                        <th> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td> {{ $user->id }} </td>
                                            <td> {{ $user->matricula }} </td>
                                            <th> {{ $user->name }} </th>
                                            <td> {{ $user->apellidoPaterno }} {{ $user->apellidoMaterno }} </td>
                                            <td> {{ $user->telefono }} </td>

                                            <td> {{ $user->rolUser->nombre }} </td>
                                            <td>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                    <div class="btn-group btn-group-sm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('user.show', $user->id) }}"
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
    <script>
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (Session::has('activado'))
            toastr.success("{{ session('activado') }}");
        @endif
        @if (Session::has('desactivado'))
            toastr.success("{{ session('desactivado') }}");
        @endif
        @if (Session::has('success'))
            toastr.success("{{ session('desactivado') }}");
        @endif
    </script>
@stop
