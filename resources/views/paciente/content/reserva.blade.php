@extends('paciente.utils.header')

@section('contenido')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <div class="tab-content">
        <div class="tab-empty" style="height: 100%;">
            <div class="row ">
                <div class="col-md-6 m-auto">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Programar Laboratorio</h3>
                        </div>
                        <br>
                        @if (count($detalles) <= 0)
                            <div class="admonition caution">
                                <p><strong class="title">Se comunica </strong> que por el momento no hay reservas
                                    activas</p>
                            </div>
                        @else
                            <div class="card-body p-0">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header col-md-6 m-auto" role="tablist">
                                        <!-- your steps here -->
                                        <div class="step" data-target="#calendarios-part">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="calendarios-part" id="calendarios-part-trigger">
                                                <span class="bs-stepper-circle">1</span>
                                                <!--<span class="bs-stepper-label">Logins</span>-->
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#grupos-part">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="grupos-part" id="grupos-part-trigger">
                                                <span class="bs-stepper-circle">2</span>
                                                <!--<span class="bs-stepper-label">Logins</span>-->
                                            </button>
                                        </div>
                                        <!--<div class="line"></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="step" data-target="#ticket-part">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <button type="button" class="step-trigger" role="tab"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                aria-controls="ticket-part" id="ticket-part-trigger">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <span class="bs-stepper-circle">3</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <span class="bs-stepper-label">Various information</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>-->
                                    </div>
                                    <div class="loadingMask" id="loadingMask" style="visibility: hidden;"></div>
                                    <div class="bs-stepper-content">
                                        <div id="calendarios-part" class="content" role="tabpanel"
                                            aria-labelledby="calendarios-part-trigger">
                                            <div class="form-group">
                                                <div id="calendar" style="width: 70%;" class="m-auto"></div>
                                            </div>
                                        </div>
                                        <!-- your steps content here -->
                                        <div id="grupos-part" class="content" role="tabpanel"
                                            aria-labelledby="grupos-part-trigger">
                                            <div id="date-select" class="m-auto text-center" style="width: 80%">
                                            </div>
                                            <table id="grupos"
                                                class="m-auto table table-striped table-bordered shadow-lg mt-4">
                                                <thead class="bg-primary text-white">
                                                    <tr>
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Grupo</th>
                                                        <th scope="col">Cupo</th>
                                                        <th scope="col">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <br>
                                            <button class="btn bg-olive color-palette btn-sm btnPrevius"
                                                onclick="">Anterior</button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endif
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    @include('global.estilo-reserva')
@endsection




@section('js')
    <script src="{{ asset('js/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('js/main.min.js') }}"></script>
    @if (count($detalles) > 0)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.stepper = new Stepper(document.querySelector('.bs-stepper'));
                $(".btnNext").click(function() {
                    stepper.next();
                });
                $(".btnPrevius").click(function() {
                    stepper.previous();
                    calendario.render();
                });
            });
        </script>

        <script>
            moment().locale("bo");
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    /*header: {
                        left: "prev,next",
                        center: "title",
                        right: "",
                    },*/
                    initialView: 'dayGridMonth',
                    selectable: true,
                    initialDate: new Date("{{ $detalles->first()->fecha }}"),
                    /*dayRender: function(date, cell) {
                        console.log(date);
                    },*/

                    timeZone: 'local',
                    locale: 'es',
                    weekends: false,
                    height: 400,
                    dateClick: function(info) {
                        dateFirst = moment("{{ $detalles->first()->fecha }}", "YYYY-MM-DD");
                        now = moment();
                        dateLast = moment("{{ $detalles->last()->fecha }}", "YYYY-MM-DD");
                        dateClick = moment(info.date);

                        if (now.isSameOrBefore(dateClick, 'day') &&
                            dateClick.isSameOrBefore(dateLast, 'day') &&
                            dateFirst.isSameOrBefore(dateClick, 'day')
                        ) {
                            $('#grupos tbody').html("");
                            var ruta = "paciente/reserva/" + {{ $orden->codigo }} + "/date/" + info
                                .dateStr;
                            title = "<h3><strong> Calendario : </strong>" + info.dateStr + "</h3>";
                            $('#date-select').html(title);
                            $.ajax({
                                url: ruta,
                                type: "GET",
                                success: function(respu) {
                                    console.log(respu);
                                    var response = respu["detalle"];
                                    var trHTML = '';
                                    var ordenLab = {{ $orden->codigo }};
                                    var fecha = info.dateStr;
                                    var urlreserva = "paciente/reserva/" +
                                        {{ $orden->codigo }} +
                                        "/detalle/";
                                    if (response.length == 0) {
                                        toastr.error(
                                            "esta fecha no tiene grupos. Elige otra fecha por favor",
                                            "Error");
                                        window.stepper.previous();
                                    }
                                    response.forEach(element => {
                                        if (element != null) {
                                            var cupoDisponible = element["cupoMaximo"] -
                                                element["cupoOcupado"];
                                            var url = urlreserva + element["id"];
                                            var grupo = element["grupo"];
                                            trHTML += "<tr>";
                                            trHTML += "<td>" + grupo["id"] + "</td>";
                                            trHTML += "<td>" + grupo["nombre"] +
                                                "</td>";
                                            trHTML += "<td>" + cupoDisponible + "</td>";
                                            trHTML += "<td>" + '<a href="' + url +
                                                '" > seleccionar ' + "</td>";
                                            trHTML += "</tr>\n";
                                        }
                                    });
                                    $('#grupos tbody').html(trHTML);
                                    console.log(trHTML);
                                },
                                error: function(error, response) {
                                    if (error.status === 403) {
                                        toastr.error("Fecha caducada intente con otra!.");
                                        window.stepper.previous();
                                    } else {
                                        toastr.error(
                                            "No se puede reservar en esta fecha");
                                        window.stepper.previous();
                                    }
                                }
                            });
                            window.stepper.next();
                        } else {

                            toastr.error(
                                "No se puede reservar en esta fecha");

                        }

                    },
                });
                window.calendario = calendar;
                calendar.render();
            });
        </script>
    @endif
@stop
