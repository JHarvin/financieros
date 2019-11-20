<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
//include_once '../plantilla/barra_lateral_usuario.php';
include_once '../app/Conexion.php';
include_once '../repositorios/correlativos.php';
include_once '../conexion/conexion.php';
Conexion::abrir_conexion();

if (isset($_REQUEST['nameEnviar'])) {
    $nombre = $_REQUEST['nameNombre'];
    $apellido = $_REQUEST['nameApellido'];
    $dui = $_REQUEST['dui_natural'];

    $conexion = Conexion::obtener_conexion();
    $correlativo = correlativos::obtener_correlativo($conexion, 'encargado');

    $sql = "INSERT INTO encargado (nombre,apellido,dui) VALUES ('$nombre','$apellido','$dui')";
    $sentencia = $conexion->prepare($sql);
    $resultado = $sentencia->execute();

    echo '<script>location.href ="registro_encargado.php";</script>';
} else {
    ?>


<style type="text/css">
    .wrapper .container-fluid{
        padding-top: 30px;
    }

     .wrapper .container-fluid h2.text-center{
        color: 0;
    }

    .wrapper .container-fluid input.maria{
        border: 1px solid #0091ea;
        border-radius: 6px;
        float: left;
    }

     table td a.editar{
        text-decoration: none;
        background-color: #3DA3EF;
        display: block;
        width: 60px;
        padding-right: 5px;
        color: #fff;
        margin: auto;
        text-align: center;
    }

    table td a.editar:hover{
       background-color: #F92659
    }


</style>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

</body>
</html>


<form action="registro_encargado.php" method="GET" autocomplete="off">
        <section class="wrapper" style="background-color:gray;">
            <!--INICIO DE FIADOR-->
            <div class="container-fluid" style="background-color:gray;">
                <!-- Basic Validation -->
                <div class="row clearfix" style="background-color:gray;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:gray;">
                        <div class="card" style="background-color:gray;">
                            <div class="header">
                                <h2 style="color:white;">REGISTRO DE ENCARGADO</h2>
                            </div>
                            <div class="body">
                                <div class="">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text"class="form-control text-center maria" required="" name="nameNombre" placeholder="Nombre del encargado">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text"class="form-control text-center maria" required="" name="nameApellido" placeholder="Apellido del encargado">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text"class="form-control text-center maria" required="" id="Dui_fia_per" name="dui_natural" placeholder="DUI">
                                            </div>
                                        </div>
                                    </div>


                                <div class="text-center">
                                    <button style="background-color:black; color:white;" type="submit" name="nameEnviar" class="btn m-t-15 waves-effect" value="ok">GUARDAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>





<!-- --MODAL -->
  <form name="form1" method="post" action="">

 <input type="hidden" name="idDeActualizacion" id="idDeActualizacion" value="00000">

    <div class="modal fade" id="editarEncargado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                 <div class="col-md-6">Nombre
                                    <INPUT class="form-control" type="text" autocomplete="off" name="duisito" id="nombreEnc" value="">
                                </div>

                            </div><br>

                            <div class="row">
                                 <div class="col-md-6">Apellido
                                    <INPUT class="form-control" type="text" autocomplete="off" name="apellido" id="apellidoEnc" value="">
                                </div>

                            </div><br>
                            <div class="row">
                                 <div class="col-md-6">Dui
                                    <INPUT class="form-control" type="text" autocomplete="off" name="du" id="duiEnc" value="">
                                </div>

                            </div><br>

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

    $nombre =  $_REQUEST['duisito'];
    $apellido =  $_REQUEST['apellido'];
    $dui =  $_REQUEST['du'];
    $idEncargado = $_REQUEST['idDeActualizacion'];

     mysqli_query($conexion, "UPDATE encargado SET nombre = '$nombre ', apellido = '$apellido', dui = '$dui ' WHERE id_encargado = '$idEncargado'");


    } catch (Exception $ex) {

    }
}

?>




<!-- --EDITAR -->
<div class="x_content">
    <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                          <tr>
                            <th class="nombre" width="500"><font color="black">Nombre</font></th>
                            <th class="apellido" width="500"><font color="black">Apellido</font></th>
                            <th class="dui" width="500"><font color="black">Dui</font></th>
                            <th class="acciones" width="10"><font>Acciones</font></th>
                          </tr>





                         </thead>
                          <tbody>


                        <?php

                        include_once '../conexion/conexion.php';
                        $pame = mysqli_query($conexion, "SELECT nombre, apellido,dui, id_encargado from encargado");
                        while ($row = mysqli_fetch_array($pame)) {
                             //sacamos estas variables para extraer informacion que se va a editar
                             $nombre = $row['nombre'];
                             $apellido = $row['apellido'];
                             $dui = $row['dui'];
                             $idEnc=$row['id_encargado'];


                        ?>



                     <tr>
                            <td class="name"><?php echo $row['nombre']; ?></td>
                            <td class="name"><?php echo $row['apellido']; ?></td>
                            <td class="name"><?php echo $row['dui']; ?></td>

                            <!-- <td><?php  $asignar; ?></td> -->
                            <td>
                                    <a class="editar" href="#" data-toggle="modal" data-target="#editarEncargado" onclick="Editar_encardado('<?php echo $nombre; ?>','<?php echo $apellido;?>','<?php echo $dui ;?>','<?php echo $idEnc;?>')" >Editar</a>

                            </td>






                </tr>



        <?php } ?>



        </tbody>
    </table>
</div>



    </body>



    <?php
}
include_once '../plantilla/pie.php';
?>




</html>

<script>
function Editar_encardado(nombre,apellido,dui,pass){
    $("#nombreEnc").val(nombre);
    $("#apellidoEnc").val(apellido);
    $("#duiEnc").val(dui);
    $("#idDeActualizacion").val(pass);

}
</script>
