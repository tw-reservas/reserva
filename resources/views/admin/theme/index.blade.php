

@extends('adminlte::page')

@section('title', 'Administrar Temas')

@section('content_header')
    <h1>Administrar Temas</h1>
@stop


@section('content')
<div class="container-fluit">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success card-outline">
                <div class="card-header">

                </div>
                <div class="card-body pad table-responsive">
                    <div class="col-md-6">
                        <form action="{{route('theme.themes')}}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <select name="turno" id="" required>
                                            <option value="1" data-icon="{{asset('images/ico_blanco.png')}}" {{auth()->user()->light ? 'selected':''}}> dia</option>
                                            <option value="2" data-icon="{{asset('images/ico_blanco.png')}}" {{!auth()->user()->light ? 'selected':''}} > noche</option>
                                        </select>
                                        <label for="" class="">Seleccione un turno:</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <select name="tema" id="" required>
                                            <option value="1" data-icon="{{asset('images/ico_children.png')}}" {{auth()->user()->theme == 1 ? 'selected':''}} >niño</option>
                                            <option value="2" data-icon="{{asset('images/ico_young.png')}}" {{auth()->user()->theme == 2 ? 'selected':''}} >joven</option>
                                            <option value="3" data-icon="{{asset('images/ico_adult.png')}}" {{auth()->user()->theme == 3 ? 'selected':''}}>adulto</option>
                                        </select>
                                        <label for="" class="">Seleccione un tema:</label>
                                    </div>
                                </div>
                            </div>
                            @method('post')
                            <button class="btn btn-success btn-sm" type="submit" name="action">Guardar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
