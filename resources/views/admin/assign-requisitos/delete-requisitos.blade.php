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
                                        <th>Descripcion</th>

                                        <th> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody2">

                                    @forelse ($laboratorio->requisitos as $requisito)
                                        <tr>
                                            <td>{{ $requisito->id }}</td>
                                            <td>{{ $requisito->descripcion }}</td>

                                            <td class="col-md-2">

                                                <form action="{{ route('delete.requisitos', $laboratorio->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $requisito->id }}" id="requisito_id"
                                                        name="requisito_id">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center"> Laboratorio sin requisitos </td>
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
