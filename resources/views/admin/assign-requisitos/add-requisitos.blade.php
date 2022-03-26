@extends('adminlte::page')

@section('content_header')
    <h1>Agregar Requisitos</h1>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-duallistbox.min.css') }}">
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-9 m-auto">
                <div class="card2">
                    <div class="card-header">
                        Agregar Requisitos
                    </div>
                    <div class="card-body2">
                        <div class="row justify-content-start">
                            <div class="col-md-5">
                                <dl>
                                    <dt>Detalle Laboratorio</dt>
                                    <dt>Codigo Arancel: {{ $laboratorio->cod_arancel }} </dt>
                                    <dt>Nombre: {{ $laboratorio->nombre }}</dt>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('add.requisitos', $laboratorio->id) }}" method="POST"
                                    id="formRequisitos">
                                    @csrf
                                    <div class="form-group">
                                        <select class="duallistbox" name="duallist_requisitos[]" multiple="multiple">
                                            @forelse ($requisitos as $requisito)
                                                <option value="{{ $requisito->id }}">{{ $requisito->id }} -
                                                    {{ $requisito->descripcion }}
                                                </option>
                                            @empty
                                                <option disabled>Alaska</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <br>
                                    <button type="submit" id="guardar" class="btn btn-default btn-block">Guardar</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <label for="">Requisitos </label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($labRequisitos as $labRequisito)
                                    <tr>
                                        <td>{{ $labRequisito->id }}</td>
                                        <td>{{ $labRequisito->descripcion }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td>#</td>
                                        <td>Este Laboratorio no tiene requisitos</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script>
        //Bootstrap Duallistbox
        var demo1 = $('select[name="duallist_requisitos[]"]').bootstrapDualListbox();
    </script>
    @include('global.script-toast')
@endsection
