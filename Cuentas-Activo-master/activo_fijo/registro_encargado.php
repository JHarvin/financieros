<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
//include_once '../plantilla/barra_lateral_usuario.php';
include_once '../app/Conexion.php';
include_once '../repositorios/correlativos.php';
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

 
</style>
<form action="registro_encargado.php" method="GET" autocomplete="off">
        <section class="wrapper">
            <!--INICIO DE FIADOR-->
            <div class="container-fluid">
                <!-- Basic Validation -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2 class="text-center">REGISTRO DE ENCARGADO</h2>
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


<!-- TABA PARA MOSTRAR LOS REGISTROS DE DEPARTAMENTOS -->
<div class="x_content">
    <table id="datatable" class="table table-striped ">
                            <thead>
                          
                           
                            <th width="500"><font color="black">Nombre del encargado</font></th>
                                <th width="500"><font color="black">Apellido</font></th>
                                <th width="500"><font color="black">Dui</font></th>
                             
                            <th width="10"><font font font font font color="black">Accion</font></th>
                            
                        
                         </thead>
                          <tbody>
                        <?php

                        include_once '../conexion/conexion.php';
                        $pame = mysqli_query($conexion, "SELECT id_encargado,nombre,apellido,dui FROM encargado");

                        
                        while ($row = mysqli_fetch_array($pame)) {                            
                            $nombre = $row['nombre'];                           
                            $apellido = $row['apellido'];  
                            $dui = $row['dui'];  
                            $iddep=$row['id_encargado'];  
                        ?>



                     <tr>
                                
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['apellido']; ?></td>
                             <td><?php echo $row['dui']; ?></td>     
                            <!-- <td><?php  $asignar; ?></td> -->
                            <td>
                                    <a href="#" data-toggle="modal" data-target="#editardepartamento<?php echo $row['id_encargado']; ?>" onclick="Editar_visita('<?php echo $nombre; ?>','<?php echo $apellido;?>','<?php echo $dui;?>','<?php echo $iddep;?>')" ><button type="button" class="glyphicon glyphicon-edit"><i class="fa fa-pencil"></i></button></a>

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
                                    </INPUT>
                                </div>
                                 <div class="col-md-12">
                                    Apellido<INPUT class="form-control" autocomplete="off" type="text" name="apellido" onpaste="return false" id="apellido" value="<?php echo $apellido; ?>" >
                                    </INPUT>
                                </div>
                                <div class="col-md-12">
                                    Apellido<INPUT class="form-control" autocomplete="off" type="text" name="dui" onpaste="return false" id="dui" value="<?php echo $dui; ?>" >
                                    </INPUT>
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
     $apellido = $_REQUEST['apellido'];
    $dui = $_REQUEST['dui'];

    $idActualizacion = $_REQUEST['idDeActualizacion'];
    mysqli_query($conexion, "UPDATE encargado SET nombre ='$nombre', apellido ='$apellido', dui ='$dui' WHERE id_encargado='$idActualizacion'");

}
?>


        <?php } ?>
      
            
        </tbody>
    </table>
</div>







<script>
function Editar_visita(nombre,apellido,dui,pass){
    $("#nombre").val(nombre);
    $("#apellido").val(apellido);
    $("#dui").val(dui);
    $("#idDeActualizacion").val(pass);

}
</script>


