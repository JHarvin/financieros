<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barra_superior_admi.php';
include_once '../plantilla/barra_lateral_admi.php';
include_once '../modelos/expediente_juridico.php';
include_once '../modelos/persona_natural.php';
include_once '../repositorios/repositorio_natural.php';
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barra_superior_admi.php';
include_once '../plantilla/barra_lateral_admi.php';
include_once '../modelos/balance_general.php';
include_once '../modelos/estado_resultado.php';
include_once '../modelos/expediente_juridico.php';
include_once '../modelos/ratios.php';
include_once '../repositorios/repositorio_balance.php';
include_once '../repositorios/repositorio_estado_resultado.php';
include_once '../app/Conexion.php';
include_once '../repositorios/repositorio_expediente_juridico.php';
include_once '../modelos/persona_juridica.php';
include_once '../repositorios/repositorio_juridico.php';
Conexion::abrir_conexion();

$datos = repositorio_natural::obtener_persona_natural(Conexion::obtener_conexion(), $_REQUEST['id_natural']);

$lista_balance = repositorio_balance::lista_balance(Conexion::obtener_conexion(), $_REQUEST['id_natural']);
$lista_estado = repositorio_estado_resultado::lista_estado(Conexion::obtener_conexion(), $_REQUEST['id_natural']);
$prestamos_pendientes = repositorio_natural::lista_prestamo_previos_natural(Conexion::obtener_conexion(), $_REQUEST['id_natural']);
$lista_referencias = repositorio_natural::lista_referencias(Conexion::obtener_conexion(), $_REQUEST['id_natural']);
$lista_fiador = repositorio_natural::lista_fiador(Conexion::obtener_conexion(), $_REQUEST['id_natural']);
$lista_bienes = repositorio_natural::lista_bienes(Conexion::obtener_conexion(), $_REQUEST['id_natural']);
?>    
<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <a href="#">
                            <h3 class="text-center">DATOS DE CLIENTE</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <table class="table table-striped table-bordered" id="tabla_cliente_juridico">

                                <thead>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Direccion</th>
                                <th class="text-center">Dui</th>
                                <th class="text-center">Nit</th>

                                <th class="text-center">Telefono</th>


                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><?php echo $datos->getId_persona_natural(); ?></td>
                                        <td class="text-center"><?php echo $datos->getNombe() . " " . $datos->getApellido(); ?></td>
                                        <td class="text-center"><?php echo $datos->getDireccion(); ?></td>
                                        <td class="text-center"><?php echo $datos->getDui(); ?></td>
                                        <td class="text-center"><?php echo $datos->getNit(); ?></td>

                                        <td class="text-center"><?php echo $datos->getTelefono(); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
if (isset($_REQUEST['tipo'])) {

    if ($_REQUEST['tipo'] == 'PERSONAL' || $_REQUEST['tipo'] == 'AGROPECUARIO') {
        ?>

            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <a href="#">
                                    <h3 class="text-center">DATOS DE REFERENCIAS</h3>
                                </a>
                            </div>
                            <div id="" class="">
                                <div class="body">
                                    <table class="table table-striped table-bordered" id="tabla_cliente_juridico">

                                        <thead>

                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Apellido</th>
                                        <th class="text-center">Telefono</th>


                                        </thead>
                                        <tbody>
                                            <?php foreach ($lista_referencias as $lista) { ?>
                                                <tr>

                                                    <td class="text-center"><?php echo $lista['0']; ?></td>
                                                    <td class="text-center"><?php echo $lista['1']; ?></td>
                                                    <td class="text-center"><?php echo $lista['2']; ?></td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <a href="#">
                                    <h3 class="text-center">DATOS DE FIADOR</h3>
                                </a>
                            </div>
                            <div id="" class="">
                                <div class="body">
                                    <table class="table table-striped table-bordered" id="tabla_cliente_juridico">

                                        <thead>

                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Direccion</th>
                                        <th class="text-center">Dui</th>
                                        <th class="text-center">Nit</th>
                                        <th class="text-center">Correo</th>


                                        </thead>
                                        <tbody>
                                            <?php foreach ($lista_fiador as $lista) { ?>
                                                <tr>

                                                    <td class="text-center"><?php echo $lista['1'] . " " . $lista['2']; ?></td>
                                                    <td class="text-center"><?php echo $lista['3']; ?></td>
                                                    <td class="text-center"><?php echo $lista['4']; ?></td>
                                                    <td class="text-center"><?php echo $lista['5']; ?></td>
                                                    <td class="text-center"><?php echo $lista['6']; ?></td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } if ($_REQUEST['tipo'] == 'HIPOTECARIO') {?>
                <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <a href="#">
                                    <h3 class="text-center">DATOS DEl BIEN HIPOTECARIO</h3>
                                </a>
                            </div>
                            <div id="" class="">
                                <div class="body">
                                    <table class="table table-striped table-bordered" id="tabla_cliente_juridico">

                                        <thead>

                                        <th class="text-center">DESCRIPCION</th>
                                        <th class="text-center">UBICACION</th>
                                        <th class="text-center">OTROS DATOS</th>
                                        

                                        </thead>
                                        <tbody>
                                            <?php foreach ($lista_bienes as $lista) { ?>
                                                <tr>

                                                    <td class="text-center"><?php echo $lista['0']; ?></td>
                                                    <td class="text-center"><?php echo $lista['1']; ?></td>
                                                    <td class="text-center"><?php echo $lista['2']; ?></td>
                                                    

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }  } ?>
  


    <div class="container-fluid">
        <div class="panel" name="libros">
            <div class="panel-heading text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3>PRESTAMOS PREVIOS</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered" id="tabla_cliente_juridico">

                    <thead>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Asesor</th>
                    <th class="text-center">Monto de prestamo</th>
                    <th class="text-center">Estado de Prestamo</th>
                    <th class="text-center">Ver</th>

                    </thead>
                    <tbody>
                        <?php foreach ($prestamos_pendientes as $lista) { ?>
                            <tr>
                                <th class="text-center"><?php echo $lista['4']; ?></th>
                                <th class="text-center"><?php echo $lista['5']; ?></th>
                                <th class="text-center"><?php echo $lista['2']; ?></th>
                                <th class="text-center"><?php echo $lista['3']; ?></th>
                                <td class="text-center">
                                    <button class="btn btn-danger" onclick="abrir_expediente('<?php echo $lista['4']; ?>')"> 
                                        <i class="Medium material-icons prefix">visibility</i> 
                                    </button>
                                </td>
                            </tr>

<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
    function abrir_expediente(id_prestamo) {
        var url = "./ver_pagos_natural.php?id_prestamo=" + id_prestamo;

        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
    }
    function abrir_estados(id_persona, periodo) {
        var url = "./ver_Estados.php?id_persona=" + id_persona + "&periodo=" + periodo;

        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
    }


</script>

<?php
include_once '../plantilla/pie.php';
?>