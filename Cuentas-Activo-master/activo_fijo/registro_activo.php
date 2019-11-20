<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
//include_once '../plantilla/barra_lateral_usuario.php';
include_once '../modelos/tipo_activo.php';
include_once '../modelos/clasificacion.php';
include_once '../modelos/departamento.php';
include_once '../modelos/encargado.php';
include_once '../repositorios/repositorio_clasificacion.php';
include_once '../repositorios/repositorio_tipoActivo.php';
include_once '../app/Conexion.php';
include_once '../repositorios/correlativos.php';
Conexion::abrir_conexion();

if (isset($_REQUEST['nameEnviar'])) {
    $institucion = $_REQUEST['select_institucion'];
    $departamento = $_REQUEST['select_departamento'];
    $tipo_activo = $_REQUEST['select_tipo'];
    $encargado = $_REQUEST['select_encargado'];
    $meses = $_REQUEST['meses'];
    $observaciones = $_REQUEST['obsevaciones'];
    $cantidad = $_REQUEST['cantidad'];
    $fecha = $_REQUEST['fecha'];
    $descripcion  = $_REQUEST['descripcion'];
    $cantidad  = $_REQUEST['cantidad'];
    $precio =$_REQUEST['precio'];


    $conexion = Conexion::obtener_conexion();

 for($i=0; $i<$cantidad;$i++){

    $correlativo = correlativos::obtener_correlativo($conexion, 'activo');
    $sql = "INSERT INTO activo (id_tipo, id_departamento, id_institucion, id_usuario, encargado_id_encargado, correlativo, fecha_adquisicion, descripcion, estado, observaciones,precio, tiempo_uso) "
                                   . "VALUES ( '$tipo_activo', '$departamento', '$institucion', '1', '$encargado', '$correlativo', '$fecha', '$descripcion', 'ACTIVO', '$observaciones','$precio',$meses);";
    $sentencia = $conexion->prepare($sql);
    $resultado = $sentencia->execute();
 }
    echo '<script>location.href ="registro_tipo_activo.php";</script>';
} else {
    $lista_clasificacion = repositorio_clasificacion::lista_clasificacion(Conexion::obtener_conexion());
    $lista_institucion = correlativos::lista_institucion(Conexion::obtener_conexion());
    $lista_depatamento = correlativos::lista_departamento(Conexion::obtener_conexion());
    $lista_tipo = correlativos::lista_tipo(Conexion::obtener_conexion());
    $lista_encargado = correlativos::lista_encargado(Conexion::obtener_conexion());
    ?>

<style type="text/css">
    .wrapper .container-fluid{
        padding-top: 30px;
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

    .wrapper .container-fluid div.mary{
       padding-bottom: 20px;
    }


    .wrapper .container-fluid span.coco{
       color: #2196f3;
    }


</style>
<form action="registro_activo.php" method="GET" autocomplete="off" style="background-color:gray;">
        <section class="wrapper" style="background-color:gray;">
            <!--INICIO DE FIADOR-->
            <div class="container-fluid">
                <!-- Basic Validation -->
                <div class="row clearfix" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header" style="background-color:gray">

                                <div class="row">
                                  <div class="col-md-6">
                                      <h2 style="color:white;">REGISTRO DE ACTIVO</h2>
                                  </div>
                                  <div class="col-md-6">
                                    <button style="background-color:black; color:white;" type="submit" name="nameEnviar" class="btn m-t-15 waves-effect" value="ok">GUARDAR</button>
                                  </div>


                                </div>
                            </div>
                            <div class="body" style="background-color:lightgray;">
                                <div class="row clearfix mary">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div class="form-line">
                                                    <span style="background-color:gray; color:white;" class="input-group-addon coco" id="basic-addon1"><strong>SELECCIONE LA INSTITUCION</strong></span>
                                                    <select class="form-control show-tick maria" name="select_institucion" required="">

                                                        <?php foreach ($lista_institucion as $lista) { ?>

                                                        <option value="<?php echo $lista->getId_departamento(); ?>">

                                                            <?php echo $lista->getCorrelativo() ."--". $lista->getNombre() ; ?>
                                                        </option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div class="form-line">
                                                    <span style="background-color:gray; color:white;" class="input-group-addon coco" id="basic-addon1"><strong>SELECCIONE EL DEPARTAMENTO</strong></span>
                                                    <select class="form-control show-tick maria" name="select_departamento" required="">
                                                        <?php foreach ($lista_depatamento as $lista) { ?>

                                                        <option value="<?php echo $lista->getId_departamento(); ?>"><?php echo $lista->getCorrelativo()."--". $lista->getNombre(); ?></option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix mary">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div class="form-line">
                                                    <span style="background-color:gray; color:white;" class="input-group-addon coco" id="basic-addon1"><strong>SELECCIONE EL TIPO DE ACTIVO</strong></span>
                                                    <select class="form-control show-tick maria" name="select_tipo" required="">
                                                        <option  value="" disabled="">SELECCIONE EL TIPO DE ACTIVO</option>
                                                        <?php foreach ($lista_tipo as $lista2) { ?>

                                                        <option value="<?php echo $lista2->getId_tipo(); ?>"><?php echo $lista2->getId_correlativo(). "--". $lista2->getId_nombre(); ?></option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div class="form-line">
                                                    <span style="background-color:gray; color:white;" class="input-group-addon coco" id="basic-addon1"><strong>SELECCIONE EL ENCARGADO</strong></span>
                                                    <select class="form-control show-tick maria" name="select_encargado" required="">
                                                        <option  value="" disabled="">SELECCIONE ENCARGADO</option>
                                                        <?php foreach ($lista_encargado as $lista3) { ?>

                                                        <option value="<?php echo $lista3->getId_encargado(); ?>"><?php echo $lista3->getNombre() ." ". $lista3->getApellido(); ?></option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row clearfix mary">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span style="background-color:gray; color:white;" class="input-group-addon coco" id="basic-addon1"><strong>FECHA ADQUISICION</strong></span>
                                                <input type="date"  class="form-control text-center maria" required="" name="fecha" placeholder="FECHA ADQUISICION">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span style="background-color:gray; color:white;" class="input-group-addon coco" id="basic-addon1"><strong>TIEMPO DE USO (MESES)</strong></span>
                                                <input type="number"  min="0" step="any"class="form-control text-center maria" name="meses" placeholder="TIEMPO DE USO (MESES)" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix mary">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span style="background-color:gray; color:white;" class="input-group-addon coco" id="basic-addon1"><strong>OBSERVACIONES</strong></span>
                                                <input type="text"  class="form-control text-center maria" required="" name="obsevaciones" placeholder="OBSERVACIONES">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span style="background-color:gray; color:white;" class="input-group-addon coco" id="basic-addon1"><strong>CANTIDAD</strong></span>
                                                <input type="number"  min="0" step="any"class="form-control text-center maria" name="cantidad" placeholder="UNIDADES" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                   <div class="row clearfix mary">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span style="background-color:gray; color:white;" class="input-group-addon coco" id="basic-addon1"><strong>DESCRIPCION</strong></span>
                                                <input type=""  class="form-control text-center maria" required="" name="descripcion" placeholder="DESCRIPCION">
                                            </div>
                                        </div>
                                    </div>
                                       <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span style="background-color:gray; color:white;" class="input-group-addon coco" id="basic-addon1"><strong>PRECIO</strong></span>
                                                <input type=""  class="form-control text-center maria" required="" name="precio" placeholder="Precio">
                                            </div>
                                        </div>
                                    </div>


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
