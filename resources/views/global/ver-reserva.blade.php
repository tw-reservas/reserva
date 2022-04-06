@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card2">
                    <div class="card-header2">
                        <strong>Tu Ticket Reservado =)</strong>
                    </div>

                    <div class="card-body2">
                        <div class="container">
                            <div class="row justify-content-center">

                                <img src="{{ asset('images/cps-logo.png') }}" alt="" width="40%" height="40%">


                                @if ($detalleReserva != null)
                                    <div class="text-center ">
                                        <h5>Orden Lab:
                                            <strong>{{ $detalleReserva->ordenLab->codigo }}</strong>
                                        </h5>
                                        <h6>Codigo ticket: {{ $detalleReserva->id }}</h6>
                                        <h5> <strong>{{ $detalleReserva->nombre }}</strong>
                                        </h5>
                                        <h4>Fecha: <br>
                                            <strong>{{ $detalleReserva->detalleCalendario->fecha }}</strong>
                                        </h4>
                                        <h4>Hora Reservada: <br>
                                            <strong>{{ $detalleReserva->detalleCalendario->grupo->horaInicio }}
                                                am -
                                                {{ $detalleReserva->detalleCalendario->grupo->horaFin }}
                                                am</strong>
                                        </h4>
                                    </div>
                                @else
                                    <div class="m-auto">
                                        <h3>El orden de laboratorio
                                            {{ $detalleReserva->ordenLab->codigo }} no tiene
                                            una reserva.</h3>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="card-footer2 text-right">

                        @isset($admin)
                            <a href="{{ route('reserva.cancelar-admin', $detalleReserva->id) }}"
                                class="btn btn-danger btn-sm">Cancelar</a>
                        @else
                            <a href="{{ route('download-pdf') }}" class="btn btn-info btn-sm">imprimir</a>
                            <a href="{{ route('reserva.cancelar') }}" class="btn btn-danger btn-sm">Cancelar</a>
                        @endisset
                    </div>

                </div>
            </div>


            <div class="col-md-6">
                <div class="card2">
                    <div class="card-header">
                        <strong>Requisitos</strong>
                    </div>
                    <div class="card-body2">

                        @forelse ($detalleReserva->ordenlab->laboratorios as $laboratorio )
                            <h6>{{ $laboratorio->nombre }}</h6>
                            @forelse ($laboratorio->requisitos as $requisito)
                                <p>{{ $requisito->id }} - {{ $requisito->descripcion }}</p>
                            @empty
                                <p>No tiene requisitos</p>
                            @endforelse
                        @empty
                            <h5>Sin laboratorio</h5>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
