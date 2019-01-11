<!--******************************Dialog**************************-->  
 <script>
    function soloNumero(e) {
        key = e.keyCode || e.which;
        teclado = String.fromCharCode(key);
        numerito = "0123456789";
        especiales = "8-37-38-46";
        teclado_especial = false;
        for (var i in especiales) {
            if (key == especiales[i]) {
                teclado_especial = true;
            }
        }
        if (numerito.indexOf(teclado) == -1 && !teclado_especial) {
            return false;
        }
    }


    function soloLetras(e) {
        key = e.keyCode || e.which;
        teclado = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = "8-37-38-46-164";
        teclado_especial = false;
        for (var i in especiales) {
            if (key == especiales[i]) {
                teclado_especial = true;
                break;
            }
        }
        if (letras.indexOf(teclado) == -1 && !teclado_especial) {
            return false;
        }
    }

</script>
   <link rel="stylesheet" href="../libreriasJS/alertifyjs/alertify.min.css">
   <script src="../libreriasJS/alertifyjs/alertify.css"></script>
   <script src="../libreriasJS/alertifyjs/alertify.min.js"></script>
<form name="form1" method="post" action="">

    <input type="hidden" name="idDeActualizacion" id="idDeActualizacion" value="00000">

    <div class="modal fade" id="actualizarVisitante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel"><font font font font font font color="black">Registro general</font></h3> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="panel-body">
                    <br>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    Nombre<INPUT class="form-control" autocomplete="off" type="text" name="nombresito" onkeypress="return soloLetras(event)" onpaste="return false" id="NombreVi" value="">
                                </div>
                            </div><br>

                            <div class="row">
                               
                                
                                <div class="col-md-6"> Celular
                                    <input class="form-control mask-celular" autocomplete="off" type="text" name="celul" id="celularVi" value="">
                                </div>
                                 <div class="col-md-6">Dui
                                    <INPUT class="form-control mask-dui" type="text" autocomplete="off" name="duisito" id="duiVi" value="">
                                </div>
                                
                            </div><br>

                            <div class="row">
                               
                                <div class="col-md-6">Genero
                               
                                 <select class="form-control" name="generito" id="generoVi" value="">
                                      <option value="">Genero</option>
                                      <option value="Femenino">Femenino</option>
                                      <option value="Masculino">Masculino</option>

                                  </select>
                                </div>
                                <div class="col-md-6">Tipo
                                   
                                     <select class="form-control" name="tipito" id="tipoVi" value="">
                            <option value="">Tipo</option>
                            <option value="estudiante">Estudiante.</option>
                            <option value="docente">Docente</option>
                            <option value="investigador">Investigador</option>
                             <option value="Otros">Otro</option>
                          </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" >Actualizar</button>
                </div> 
            </div>
        </div> 
    </div> 
</form>


<?php

if (!empty($_REQUEST['duisito'])) {
    try {        
    
    $duVi =  $_REQUEST['duisito'];
    $nomVi = $_REQUEST['nombresito'];
    $genVi = $_REQUEST['generito'];
    $tipVi = $_REQUEST['tipito'];
    $celVi = $_REQUEST['celul'];

    $idActualizacion = $_REQUEST['idDeActualizacion'];

    mysqli_query($conexion, "UPDATE visitantes SET dui='$duVi',nombre='$nomVi',genero='$genVi',tipo='$tipVi',celular='$celVi' WHERE id_visitante ='$idActualizacion'");
 echo' 
             
            <script type="text/javascript">
              

          alertify.success("Datos Actualizados   ✔");
    alertify.set("notifier","position", "top");
            </script>
            ';
  
    } catch (Exception $ex) {
        
    }
}
?>


<script src="../LibreriasJS/jquery.mask.min.js"></script>

<script type="text/javascript">
    $('.mask-dui').mask('00000000-0');
    $('.mask-celular').mask('0000-0000');

</script>

