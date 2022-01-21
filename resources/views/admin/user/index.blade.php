@extends('adminlte::page')

@section('title', 'Gestionar Usuario')

@section('content_header')
    <h1>GESTIONAR USUARIOS</h1>
@stop




@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        Lista de Usuarios
                    </div>
                    <div class="card-body">
                        <div class="row text-align-center">
                            <h5>Crear Usuario   </h5>
                            <a href="{{route ('user.create')}}" class="btn btn-success btn-sm mb-4">CREAR</a>
                        </div>
                        <br>

                        <table class="table table-bordered col-md-11 m-auto">
                            <thead>
                                <tr class="bg-primary">
                                    <th style="width: 10px">#</th>
                                    <th>Matricula</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th > Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($users as $user)
                               <tr>
                                <td> {{$user->id}} </td>
                                <td> {{$user->matricula}} </td>
                                <th> {{$user->name }} </th>
                                <td> {{$user->apellidoPaterno}} {{$user->apellidoMaterno }} </td>
                                <td> {{$user->telefono}} </td>
                                <td> {{$user->email }} </td>
                                <td> {{$user->rolUser->nombre }} </td>
                                    <td>
                                        <form action="{{route ('user.destroy',$user->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('user.show', $user->id) }}" class="btn btn-info">editar</a>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Borrar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer clearfix">

                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    @if (Session::has('error'))
        toastr.error("{{session('error')}}");
    @endif
    @if (Session::has('activado'))
        toastr.success("{{session('activado')}}");
    @endif
    @if (Session::has('desactivado'))
        toastr.success("{{session('desactivado')}}");
    @endif
    @if (Session::has('success'))
        toastr.success("{{session('desactivado')}}");
    @endif
</script>

<script>

<script>
@stop
