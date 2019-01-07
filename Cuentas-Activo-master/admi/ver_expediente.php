<?php
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

$lista_balance = repositorio_balance::lista_balance(Conexion::obtener_conexion(), $_REQUEST['id_juridico']);
$lista_estado = repositorio_estado_resultado::lista_estado(Conexion::obtener_conexion(), $_REQUEST['id_juridico']);
$datos = repositorio_juridico::obtener_persona_juridca(Conexion::obtener_conexion(), $_REQUEST['id_juridico']);
$prestamos_previos = repositorio_expediente_juridico::lista_prestamo_previos(Conexion::obtener_conexion(), $_REQUEST['id_juridico']);

$ratio = array();

for ($i = 0; $i < count($lista_balance); $i++) {

    $balance = $lista_balance[$i];
    $estado = $lista_estado[$i];

    $ratio[] = repositorio_expediente_juridico::calculo_ratios($balance, $estado);
}
?>    
<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <a href="#">
                            <h3 class="text-center">DATOS DE LA EMPRESA</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <table class="table table-striped table-bordered" id="tabla_cliente_juridico">

                                <thead>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">Nombre de la empresa</th>
                                <th class="text-center">Numero de empresa</th>
                                <th class="text-center">Dui de Representante</th>
                                <th class="text-center">Nit de Representante</th>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><?php echo $datos->getId_persona_juridica(); ?></td>
                                        <td class="text-center"><?php echo $datos->getId_nombre(); ?></td>
                                        <td class="text-center"><?php echo $datos->getNumero(); ?></td>
                                        <td class="text-center"><?php echo $datos->getDui(); ?></td>
                                        <td class="text-center"><?php echo $datos->getNit(); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="panel" name="libros">
            <div class="panel-heading text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3>RATIOS</h3>
                    </div>
                    <div class="col-md-1">
                        <h5>graficos</h5>
                        <button class="btn btn-warning" onclick="abrir_grafica('<?php echo $_REQUEST['id_juridico'] ?>')"> 
                            <i class="Medium material-icons prefix">visibility</i> 
                        </button>
                    </div>


                </div>
            </div>
            <div class="panel-body">

                <table padding="20px" class="table table-striped" id="data-table-simple">
                    <thead class="">
                    <th class="">Razon</th>
                    <?php foreach ($ratio as $lista) { ?><th class="text-center"> <?php echo $lista->getPeriodo(); ?></th><?php } ?>

                    </thead>
                    <tbody>
                        <tr>
                            <td>Liquidez Corriente</td>
                            <?php foreach ($ratio as $lista) { ?><td class="text-center"><?php echo $lista->getLiquidez_corriente(); ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td>Razon Rapida</td>
                            <?php foreach ($ratio as $lista) { ?><td class="text-center"><?php echo $lista->getRazon_rapida(); ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td>Rotacion de Inventarios</td>
                            <?php foreach ($ratio as $lista) { ?><td class="text-center"><?php echo $lista->getRotacion_inventarios() . " veces"; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td>Periodo Promedio de Cobro</td>
                            <?php foreach ($ratio as $lista) { ?><td class="text-center"><?php echo $lista->getPeriodo_cobro() . " dias"; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td>Indice de Endeudamiento</td>
                            <?php foreach ($ratio as $lista) { ?><td class="text-center"><?php echo $lista->getIndice_endeudamiento() . "%"; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td>Razon de cargo de interes fijo</td>
                            <?php foreach ($ratio as $lista) { ?><td class="text-center"><?php echo $lista->getCargo_interes_fijo(); ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td>Margen de Utilidad Bruta</td>
                            <?php foreach ($ratio as $lista) { ?><td class="text-center"><?php echo $lista->getMargen_utilidad_bruta() . "%"; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td>Margen de Utilidad Neta</td>
                            <?php foreach ($ratio as $lista) { ?><td class="text-center"><?php echo $lista->getMargen_utilidad_neta() . "%"; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td>Rendimiento sobre activos totales</td>
                            <?php foreach ($ratio as $lista) { ?><td class="text-center"><?php echo $lista->getRendimiento_activo() . "%"; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td>Rendimiento sobre patrimonio</td>
                            <?php foreach ($ratio as $lista) { ?><td class="text-center"><?php echo $lista->getRendimiento_patrimonio() . "%"; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td class="">Ver Estados</td>
                            <?php foreach ($ratio as $lista) { ?>

                                <td class="text-center">
                                    <button class="btn btn-primary " onclick="abrir_estados('<?php echo $lista->getId(); ?>', '<?php echo $lista->getPeriodo(); ?>')"> 
                                        <i class="Medium material-icons prefix">visibility</i> 
                                    </button>
                                </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
                        <?php foreach ($prestamos_previos as $lista) { ?>
                            <tr>
                                <th class="text-center"><?php echo $lista['3']; ?></th>
                                <th class="text-center"><?php echo $lista['4']; ?></th>
                                <th class="text-center"><?php echo $lista['1']; ?></th>
                                <th class="text-center"><?php echo $lista['2']; ?></th>
                                <td class="text-center">
                                    <button class="btn btn-danger" onclick="abrir_expediente('<?php echo $lista['3']; ?>')"> 
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
        var url = "./ver_pagos_juridico.php?id_prestamo=" + id_prestamo;

        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
    }
    function abrir_pagos_natural(id_prestamo) {
        var url = "./ver_pagos_juridico.php?id_prestamo=" + id_prestamo;

        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
    }
    
    
    function abrir_estados(id_persona, periodo) {
        var url = "./verEstado.php?id_persona=" + id_persona + "&periodo=" + periodo;

        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
    }
    function abrir_grafica(id_juridico) {
        var url = "./grafica.php?id_juridico=" + id_juridico ;

        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
    }


</script>

<?php
include_once '../plantilla/pie.php';
?>