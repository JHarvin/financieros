<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
//include_once '../plantilla/barra_lateral_usuario.php';
include_once '../app/Conexion.php';
include_once '../repositorios/correlativos.php';
Conexion::abrir_conexion();

if (isset($_REQUEST['nameEnviar'])) {
    $nombre = $_REQUEST['nameNombre'];
    $conexion = Conexion::obtener_conexion();
    $correlativo = correlativos::obtener_correlativo($conexion, 'departamento');

    $sql = "INSERT INTO departamento (nombre, correlativo) VALUES ('$nombre', '$correlativo')";
     $sentencia = $conexion->prepare($sql);
     $resultado = $sentencia->execute();

     echo '<script>location.href ="registro_departamento.php";</script>';


}else{

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

 
</style>

<form action="registro_departamento.php" method="GET" autocomplete="off">
    <section class="wrapper">
        <!--INICIO DE FIADOR-->
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="text-center">REGISTRO DE DEPARTAMENTOS</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text"class="form-control text-center maria" required="" name="nameNombre" placeholder="Nombre del Departamento">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="text-center">
                                <button type="submit" name="nameEnviar" class="btn btn-primary m-t-15 waves-effect" value="ok">GUARDAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<?php
}
include_once '../plantilla/pie.php';
?>
<?php




$conexion = new mysqli('localhost','root','','financiero');

if($conexion->connect_errno)
{
    echo "Error de conexion de la base datos".$conexion->connect_error;
    exit();
}
$sql = "select * from departamento";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1 align="center">LISTADO DE DEPARTAMENTOS</h1>
    <table class="table table-striped" width="70%" border="1px" align="center">

    <tr align="center">
       
        <td>N</td>
        <td>Nombre DEL DEPARTAMENTO</td>
        
        
    </tr>
    <?php 
        while($datos=$resultado->fetch_array()){
        ?>
            <tr>  <td><?php echo $datos["id_departamento"]?></td>
                <td><?php echo $datos["nombre"]?></td>
              
               
                
               
                 <td><!--boton de modificar-->
                                  <div class="row">
                                    <div class="col-md-6">
                                        <a href="#" data-toggle="modal" data-target="#actualizarVisitante" onclick="Editar_visita('<?php echo $duiVisita; ?>','<?php echo $NombreVisita; ?>','<?php echo $generoVisita;?>','<?php echo $tipoVisita;?>','<?php echo $celularVisita;?>','<?php echo $pas;?>')" ><button type="button" class="btn btn-success"><i class="fa fa-pencil"></i></button></a>
                                
                                    </div>

                                    
                                  </div>
                                  </td> 
            </tr>
            <?php   
        }

     ?>
    </table>

</body>
</html>
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
                                    Nombre<INPUT class="form-control" autocomplete="off" type="text" name="nombre" onkeypress="return soloLetras(event)" onpaste="return false" id="nombre" value="">
                                </div>
                            </div><br>

                            <div class="row">
                               
                                
                                <div class="col-md-6"> Apellido
                                    <input class="form-control mask-celular" autocomplete="off" type="text" name="apellido" id="apellido" value="">
                                </div>
                                 <div class="col-md-6">Dui
                                    <INPUT class="form-control mask-dui" type="text" autocomplete="off" name="dui" id="dui" value="">
                                </div>
                                
                            </div><br>

                           

                        
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

if (!empty($_REQUEST['id_encargado'])) {
    try {        
    
    $dui =  $_REQUEST['nombre'];
    $nombre = $_REQUEST['apellido'];
    $dui = $_REQUEST['dui'];
    

    $idActualizacion = $_REQUEST['idDeActualizacion'];

    mysqli_query($conexion, "UPDATE encargado SET nombre='$nombre',apellido='$apellido',dui='$dui' WHERE id_encargado ='$idActualizacion'");
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
<script>
function Editar_visita(nombre,apellido,dui){
    
    $("#nombre").val(nombre);
    $("#apellido").val(apellido);
    $("#dui").val(dui);
    

}
</script>
