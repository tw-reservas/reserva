@extends('paciente.utils.header')

@section('contenido')
<?php
    session_start();
    if(isset($_SESSION['reserva'])==0){
        $_SESSION['reserva']=0;
    }
?>
        <div class="row ">
            <div class="col-md-8 m-auto">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">Programar Laboratorio</h3>
                </div>
                <div class="card-body p-0">
                  <div class="bs-stepper">
                    <div class="bs-stepper-header col-md-6 m-auto" role="tablist">
                      <!-- your steps here -->
                      <div class="step" data-target="#calendarios-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="calendarios-part" id="calendarios-part-trigger">
                            <span class="bs-stepper-circle">1</span>
                            <!--<span class="bs-stepper-label">Logins</span>-->
                          </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#grupos-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="grupos-part" id="grupos-part-trigger">
                          <span class="bs-stepper-circle">2</span>
                          <!--<span class="bs-stepper-label">Logins</span>-->
                        </button>
                      </div>




                      <!--<div class="line"></div>
                      <div class="step" data-target="#information-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                          <span class="bs-stepper-circle">3</span>
                          <span class="bs-stepper-label">Various information</span>
                        </button>
                      </div>-->
                    </div>
                    <div class="loadingMask" id="loadingMask" style="visibility: hidden;"></div>
                    <div class="bs-stepper-content">
                        <div id="calendarios-part" class="content" role="tabpanel" aria-labelledby="calendarios-part-trigger">
                            <div class="form-group">
                                <div id="calendar" style="width: 70%;" class="m-auto"></div>
                            </div>
                        </div>
                      <!-- your steps content here -->
                      <div id="grupos-part" class="content" role="tabpanel" aria-labelledby="grupos-part-trigger">
                        <div id="date-select" class="m-auto text-center" style = "width: 80%"></div>
                            <table id="grupos" class="m-auto table table-striped table-bordered shadow-lg mt-4" style="width:80%">
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
                            <button class="btn btn-primary btnPrevius" onclick="">Anterior</button>
                        </div>
                        <div class="footer">
                            <div class="footer-copyright">
                                <div class="container" style="margin-top:5px ">
                                    © 2021 INF513 GRUPO 17 SC
                                    <a class="black-text text-lighten-4 right" href="#!">Visitas a la página:
                                        <?php echo $_SESSION['reserva'] += 1 ; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

          <div class="footer">
            <div class="footer-copyright">
                <div class="container" style="margin-top:5px ">
                    © 2021 INF513 GRUPO 17 SC
                    <a class="black-text text-lighten-4 right" href="#!">Visitas a la página:
                        <?php echo $_SESSION['reserva'] += 1 ; ?></a>
                </div>
            </div>
        </div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'));

    $(".btnNext").click(function(){
        stepper.next();
    });

    $(".btnPrevius").click(function(){
        stepper.previous();
        calendario.render();
    });
});
</script>

<script>
    {{$contador = 0;}}
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        header:{
            left: "prev,next",
            center: "title",
            right: "",
        },
        initialView: 'dayGridMonth',
        selectable: true,
        initialDate: new Date('{{$detalles->first()->fecha}}'),
        dayRender:function(date,cell){
            console.log(date);
        },
        timeZone: 'local',
        locale: 'es',
        weekends:false,
        height: 450,
        dateClick: function(info){
            var ruta = "paciente/reserva/"+{{$orden->codigo}}+"/date/"+info.dateStr;

            title = "<h3><strong> Calendario : </strong>" + info.dateStr + "</h3>";
            $('#date-select').html(title);
            $.ajax({
                url: ruta,
                type: "GET",
                success: function(respu){
                    console.log(respu);
                    var response = respu["detalle"];
                    var trHTML = '';
                    var ordenLab = {{$orden->codigo}};
                    var fecha = info.dateStr;
                    var urlreserva = "paciente/reserva/"+{{$orden->codigo}}+"/detalle/";
                    if(response.length == 0){
                        toastr.success("esta fecha no tiene grupos. Elige otra fecha por favor", "Error");
                        window.stepper.previous();
                    }
                    response.forEach(element => {
                        if(element != null){
                            var cupoDisponible = element["cupoMaximo"] - element["cupoOcupado"];
                            var url = urlreserva+element["id"];
                            var grupo = element["grupo"];

                            trHTML+= "<tr>";
                            trHTML+= "<td>"+  grupo["id"]+"</td>";
                            trHTML+= "<td>"+  grupo["nombre"]+"</td>";
                            trHTML+= "<td>"+ cupoDisponible   +"</td>";
                            trHTML+= "<td>"+  '<a href="'+ url + '" > seleccionar '+"</td>";
                            trHTML+="</tr>\n";
                        }
                    });
                    $('#grupos tbody').html(trHTML);
                    console.log(trHTML);
                },
            });
            window.stepper.next();
        },
      });
      window.calendario = calendar;
      calendar.render();
    });
</script>
