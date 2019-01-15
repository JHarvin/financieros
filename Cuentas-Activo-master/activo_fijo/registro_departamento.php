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

      table td.name{
       
        width: 60px;
        padding-right: 5px;
        text-align: center;
       
    }

    table th.acciones{
        text-decoration: none;
        width: 100px;
        padding: 8px;
        color: #fff;
        margin: auto;
        text-align: center;
    }

     table th.nombre{
         text-decoration: none;
       
        width: 100px;
        padding: 8px;
        margin: auto;
        text-align: center;
    }


    

 
</style>


<!DOCTYPE html>
<html>

<head>
    
</head>


<body>
    
    

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



<!-- --MODAL -->
  <form name="form1" method="post" action="">

 <input type="hidden" name="idDeActualizacion" id="idDeActualizacion" value="00000">

    <div class="modal fade" id="editardepartamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <INPUT class="form-control mask-dui" type="text" autocomplete="off" name="duisito" id="nombreDep" value="">
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
    $id = $_REQUEST['idDeActualizacion'];

     mysqli_query($conexion, "UPDATE departamento SET nombre = '$nombre' WHERE id_departamento = '$id'");

  
    } catch (Exception $ex) {
        
    }
}

?>

<!-- --EDITAR -->
<div class="x_content">
    <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                          <tr>
                            <th class="nombre" width="500"><font color="black">Nombre del edpartamento</font></th>
                             
                            <th class="acciones" width="10"><font font font font font color="black">Acciones</font></th>
                          </tr>

                           
                          
                            
                        
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
                                
                            <td class="name"><?php echo $row['nombre']; ?></td>
                                  
                            <!-- <td><?php  $asignar; ?></td> -->
                            <td>
                                    <a class="editar" href="#" data-toggle="modal" data-target="#editardepartamento" onclick="Editar_depar('<?php echo $nombre; ?>','<?php echo $iddep;?>')" >Editar</a>

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
function Editar_depar(nombre,pass){
    $("#nombreDep").val(nombre);
    $("#idDeActualizacion").val(pass);

}
</script>



