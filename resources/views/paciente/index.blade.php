@extends('paciente.utils.header')

@section('contenido')
<?php
    session_start();
    if(isset($_SESSION['reserva'])==0){
        $_SESSION['reserva']=0;
    }
?>
    <div class="row">
       <div class="col-md-6  m-auto p-3">
        <div class="card card-success card-outline">
            <div class="card-header">
                Ingrese el ORDEN del laboratorio
            </div>
            <div class="card-body">
                <form action="{{route('verificar.orden')}}" method="POST" id="form-orden">
                    @csrf
                    <div class="mb-3">
                      <label for="" class="form-label">Orden Laboratorio: </label>
                      <input id="orden" name="orden" type="text" autocomplete="off" class="form-control @error('cupo')
                        is-invalid
                      @enderror" tabindex="2">
                      @error('cupo')
                      @method('POST')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                      </span>
                  @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-sm" tabindex="4" id = "verificar">Verificar</button>
                  </form>
            </div>
        </div>
       </div>
    </div>

@stop

@section('footer')
<div class="footer">
    <div class="footer-copyright">
        <div class="container" style="margin-top:5px ">
            © 2021 INF513 GRUPO 17 SC
            <a class="black-text text-lighten-4 right" href="#!">Visitas a la página:
                <?php echo $_SESSION['reserva'] += 1 ; ?></a>
        </div>
    </div>
</div>
@stop

@section('js')

<script>
    window.onload= function(){
        document.getElementById('verificar').onclick = function(){
            const reg = new RegExp('^[0-9]+$');
            orden = document.getElementById('orden').value;

            if(orden === '' ){
                toastr.error("El campo ORDEN DE LABORATORIO es requerido");
                return false;
            }
            if(orden.length < 6 || orden.length > 10){
                toastr.error("El campo ORDEN DE LABORATORIO es incorrecto");
                return false;
            }
            if(!reg.test(orden) && orden !== ""){
                toastr.error("El campo ORDEN debe ser un número");
                return false;
            }
            if(reg.test(orden) && orden.length > 6){
                toastr.success('CAMPOS CORRECTOS, !!VERIFICANDO ORDEN!!');
                document.getElementById('form-orden').submit();
            }
            return false;
        }

    }


</script>


<script>
    @if (Session::has('error'))
        toastr.error("{{session('error')}}");
    @endif
</script>

@stop
