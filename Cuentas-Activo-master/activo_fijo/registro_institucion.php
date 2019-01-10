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
    $correlativo = correlativos::obtener_correlativo($conexion, 'institucion');

    $sql = "INSERT INTO institucion (nombre, correlativo) VALUES ('$nombre', '$correlativo')";
     $sentencia = $conexion->prepare($sql);
     $resultado = $sentencia->execute();

     echo '<script>location.href ="registro_institucion.php";</script>';


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

<form action="registro_institucion.php" method="GET" autocomplete="off">
    <section class="wrapper">
        <!--INICIO DE FIADOR-->
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="text-center">REGISTRO INSTITUCION</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text"class="form-control text-center maria" required="" name="nameNombre" placeholder="Nombre de la Institucion">
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
