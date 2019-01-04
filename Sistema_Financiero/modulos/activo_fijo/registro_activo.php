<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
include_once '../plantilla/barra_lateral_usuario.php';
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


<form action="registro_activo.php" method="GET" autocomplete="off">
        <section class="content">
            <!--INICIO DE FIADOR-->
            <div class="container-fluid">
                <!-- Basic Validation -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2 class="text-center">REGISTRO DE ACTIVO</h2>
                            </div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">SELECCIONE LA INSTITUCION</span>
                                                    <select class="form-control show-tick" name="select_institucion" required="">
                                                 
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
                                                    <span class="input-group-addon" id="basic-addon1">SELECCIONE EL DEPARTAMENTO</span>
                                                    <select class="form-control show-tick" name="select_departamento" required="">
                                                        <?php foreach ($lista_depatamento as $lista) { ?>

                                                        <option value="<?php echo $lista->getId_departamento(); ?>"><?php echo $lista->getCorrelativo()."--". $lista->getNombre(); ?></option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">SELECCIONE EL TIPO DE ACTIVO</span>
                                                    <select class="form-control show-tick" name="select_tipo" required="">
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
                                                    <span class="input-group-addon" id="basic-addon1">SELECCIONE EL ENCARGADO</span>
                                                    <select class="form-control show-tick" name="select_encargado" required="">
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
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">FECHA ADQUISICION</span>
                                                <input type="date"  class="form-control text-center" required="" name="fecha" placeholder="FECHA ADQUISICION">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">TIEMPO DE USO (MESES)</span>
                                                <input type="number"  min="0" step="any"class="form-control text-center" name="meses" placeholder="TIEMPO DE USO (MESES)" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">OBSERVACIONES</span>
                                                <input type="text"  class="form-control text-center" required="" name="obsevaciones" placeholder="OBSERVACIONES">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">CANTIDAD</span>
                                                <input type="number"  min="0" step="any"class="form-control text-center" name="cantidad" placeholder="UNIDADES" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                   <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">DESCRIPCION</span>
                                                <input type=""  class="form-control text-center" required="" name="descripcion" placeholder="DESCRIPCION">
                                            </div>
                                        </div>
                                    </div>
                                       <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">Precio</span>
                                                <input type=""  class="form-control text-center" required="" name="precio" placeholder="Precio">
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
