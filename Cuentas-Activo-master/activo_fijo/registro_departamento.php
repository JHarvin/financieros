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

<!-- TABA PARA MOSTRAR LOS REGISTROS DE DEPARTAMENTOS -->
<div class="x_content">
    <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                          
                           
                            <th width="500"><font color="black">Nombre del edpartamento</font></th>
                             
                            <th width="10"><font font font font font color="black">Accion</font></th>
                            
                        
                         </thead>
                          <tbody>
                        <?php

                        include_once '../conexion/conexion.php';
                        $pame = mysqli_query($conexion, "SELECT id_departamento,nombre FROM departamento");

                        
                        while ($row = mysqli_fetch_array($pame)) {                            
                            $nombre = $row['nombre'];                           
                            
                            $iddep=$row['id_departamento'];  
                        ?>



                     <tr>
                                
                            <td><?php echo $row['nombre']; ?></td>
                                  
                            <!-- <td><?php  $asignar; ?></td> -->
                            <td>
                                    <a href="#" data-toggle="modal" data-target="#editardepartamento<?php echo $row['id_departamento']; ?>" onclick="Editar_visita('<?php echo $nombre; ?>','<?php echo $iddep;?>')" ><button type="button" class="btn btn-success"><i class="fa fa-pencil"></i></button></a>

                            </td>
                                
                                 
                                  
                                    
               

                </tr>

                      




<!--MODALES -->

<form name="form1" method="post" action="">

    <input type="hidden" name="idDeActualizacion" id="idDeActualizacion" value="00000">

    <div class="modal fade" id="editardepartamento<?php echo $iddep; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    Nombre<INPUT class="form-control" autocomplete="off" type="text" name="nombresito" onpaste="return false" id="nombre" value="<?php echo $nombre; ?>" >
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

if (!empty($_REQUEST['nombresito'])) {
  
    $nombre = $_REQUEST['nombresito'];

    $idActualizacion = $_REQUEST['idDeActualizacion'];
    mysqli_query($conexion, "UPDATE departamento SET nombre ='$nombre' WHERE id_departamento='$idActualizacion'");

}
?>


        <?php } ?>
      
            
        </tbody>
    </table>
</div>




<?php
}
include_once '../plantilla/pie.php';
?>


<script>
function Editar_visita(nombre,pass){
    $("#nombre").val(nombre);
    $("#idDeActualizacion").val(pass);

}
</script>

