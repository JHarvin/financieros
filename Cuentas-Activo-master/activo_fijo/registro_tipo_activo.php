<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
//include_once '../plantilla/barra_lateral_usuario.php';
include_once '../modelos/tipo_activo.php';
include_once '../modelos/clasificacion.php';
include_once '../repositorios/repositorio_clasificacion.php';
include_once '../repositorios/repositorio_tipoActivo.php';
include_once '../app/Conexion.php';
include_once '../repositorios/correlativos.php';
Conexion::abrir_conexion();

if (isset($_REQUEST['nameEnviar'])) {
    $nombre = $_REQUEST['nameNombre'];
    $select =$_REQUEST['NameSelect'];
    $conexion = Conexion::obtener_conexion();
    $correlativo = correlativos::obtener_correlativo($conexion, 'tipo_activo');

    $sql = "INSERT INTO tipo_activo (id_clasificacion, nombre, correlativo) VALUES ('$select', '$nombre', '$correlativo')";
     $sentencia = $conexion->prepare($sql);
     $resultado = $sentencia->execute();

     echo '<script>location.href ="registro_tipo_activo.php";</script>';


}else{
$lista_clasificacion = repositorio_clasificacion::lista_clasificacion(Conexion::obtener_conexion());
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

    .wrapper .container-fluid select.maria{
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
<html lang="en">
<head>
</head>
<body>
    

<form action="registro_tipo_activo.php" method="GET" autocomplete="off">
    <section class="wrapper">
        <!--INICIO DE FIADOR-->
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="text-center">REGISTRO DE TIPO DE ACTIVO</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text"class="form-control text-center maria" required="" name="nameNombre" placeholder="Nombre del tipo de Activo">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <div class="form-line">
                                                <select class="form-control show-tick maria" name="NameSelect" required="">
                                                    <option value="" disabled="">SELECCIONE LA CLASIFICACION</option>
                                                    <?php foreach ($lista_clasificacion as $lista) { ?>

                                                        <option value="<?php echo $lista->getId_clasificacion(); ?>"><?php echo $lista->getNombre(); ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
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
     <div class="modal fade" id="editarTipoActivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <INPUT class="form-control mask-dui" type="text" autocomplete="off" name="duisito" id="nombreAct" value="">
                                </div>
                                
                            </div><br>
                             <div class="row">
                                 <div class="col-md-6">Clasificacion
                                   <select class="form-control show-tick maria" name="NameSelect" required="" id="clasiAct">
                                                    <option value="" disabled="">SELECCIONE LA CLASIFICACION</option>
                                                    <?php foreach ($lista_clasificacion as $lista) { ?>

                                                        <option value="<?php echo $lista->getId_clasificacion(); ?>"><?php echo $lista->getNombre(); ?></option>

                                                    <?php } ?>
                                 </select>
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
    $nombre =  $_REQUEST['NameSelect'];
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
                            <th class="nombre" width="500"><font color="black">Correlativo</font></th>
                            <th class="nombre" width="500"><font color="black">Nombre del tipo de Activo</font></th>
                             <th class="nombre" width="500"><font color="black">Clasificacion</font></th>
                            <th class="acciones" width="10"><font font font font font color="black">Acciones</font></th>
                          </tr>

                           
                          
                            
                        
                         </thead>
                          <tbody>
                        <?php
                        
                        include_once '../conexion/conexion.php';
                        $pame = mysqli_query($conexion, "SELECT
                             id_tipo,
                             tipo_activo.correlativo AS correlat,
                             tipo_activo.id_clasificacion as idclasi,
                             tipo_activo.nombre AS tipoActi,
                             clasificacion.id_clasificacion as idclasi,
                             clasificacion.nombre as clasif
                             FROM
                             tipo_activo
                             INNER JOIN clasificacion
                             ON tipo_activo.id_clasificacion = clasificacion.id_clasificacion");
                        while ($row = mysqli_fetch_array($pame)) {                            
                             
                             $nombre = $row['tipoActi'];
                             $clasificacion =$row['clasif'];                  
                             $idActivo=$row['id_tipo'];  
                        

                        ?>



                     <tr>
                             <td class="name"><?php echo $row['correlat']; ?></td>   
                            <td class="name"><?php echo $row['tipoActi']; ?></td>                                  
                            <td class="clasifica"><?php echo $row['clasif']; ;?></td>
                            <td>
                                    <a class="editar" href="#" data-toggle="modal" data-target="#editarTipoActivo" onclick="Editar_visita('<?php echo $nombre; ?>','<?php echo $clasificacion ;?>','<?php echo $idActivo;?>')" >Editar</a>

                            </td>
                                
                                 
                                  
                                    
               

                </tr>

                      

        <?php } ?>



        </tbody>
    </table>
</div>



<?php
}
include_once '../plantilla/pie.php';
?>
</body>
</html>


<script>
function Editar_visita(nombre,clasif,pass){
    $("#nombreAct").val(nombre);
    $("#clasiAct").val(clasif);
    $("#idDeActualizacion").val(pass);

}
</script>
