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
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text"class="form-control text-center" required="" name="nameNombre" placeholder="NOMBRE...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text"class="form-control text-center" required="" name="nameApellido" placeholder="APELLIDO...">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text"class="form-control text-center" required="" id="Dui_fia_per" name="dui_natural" placeholder="DUI...">
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
