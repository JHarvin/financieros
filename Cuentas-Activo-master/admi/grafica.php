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
$prestamos_pendientes = repositorio_expediente_juridico::lista_prestamo_previos(Conexion::obtener_conexion(), $_REQUEST['id_juridico']);

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
                            <h3 class="text-center">LIQUIDEZ CORRIENTE</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <script type="text/javascript">
                                $(function () {
                                    $('#liquidez_corriente').highcharts({
                                        chart: {
                                            type: 'line'
                                        },
                                        title: {
                                            text: ''
                                        },
                                        subtitle: {
                                            text: ''
                                        },
                                        xAxis: {
                                            categories: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    '<?php echo $lista->getPeriodo(); ?>', <?php } ?>
                                            ]
                                        },
                                        yAxis: {
                                            title: {
                                                text: ''
                                            }
                                        },
                                        plotOptions: {
                                            line: {
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                enableMouseTracking: false
                                            }
                                        },
                                        series: [{
                                                name: 'Tokyo',
                                                data: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    <?php echo $lista->getLiquidez_corriente(); ?>, <?php } ?>
                                                ]
                                            }]
                                    });
                                });
                            </script>
                            <div id="liquidez_corriente" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                            <h3 class="text-center">RAZON RAPIDA</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <script type="text/javascript">
                                $(function () {
                                    $('#razon_rapida').highcharts({
                                        chart: {
                                            type: 'line'
                                        },
                                        title: {
                                            text: ''
                                        },
                                        subtitle: {
                                            text: ''
                                        },
                                        xAxis: {
                                            categories: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    '<?php echo $lista->getRazon_rapida(); ?>', <?php } ?>
                                            ]
                                        },
                                        yAxis: {
                                            title: {
                                                text: ''
                                            }
                                        },
                                        plotOptions: {
                                            line: {
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                enableMouseTracking: false
                                            }
                                        },
                                        series: [{
                                                name: 'Tokyo',
                                                data: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    <?php echo $lista->getRazon_rapida(); ?>, <?php } ?>
                                                ]
                                            }]
                                    });
                                });
                            </script>
                            <div id="razon_rapida" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                            <h3 class="text-center">ROTACIÓN DE INVENTARIOS</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <script type="text/javascript">
                                $(function () {
                                    $('#rotacion').highcharts({
                                        chart: {
                                            type: 'line'
                                        },
                                        title: {
                                            text: ''
                                        },
                                        subtitle: {
                                            text: ''
                                        },
                                        xAxis: {
                                            categories: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    '<?php echo $lista->getPeriodo(); ?>', <?php } ?>
                                            ]
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'ROTACIONES POR AÑO'
                                            }
                                        },
                                        plotOptions: {
                                            line: {
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                enableMouseTracking: false
                                            }
                                        },
                                        series: [{
                                                name: 'Tokyo',
                                                data: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    <?php echo $lista->getRotacion_inventarios(); ?>, <?php } ?>
                                                ]
                                            }]
                                    });
                                });
                            </script>
                            <div id="rotacion" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                            <h3 class="text-center">PERIODO PROMEDIO DE COBRO</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <script type="text/javascript">
                                $(function () {
                                    $('#ppcobro').highcharts({
                                        chart: {
                                            type: 'line'
                                        },
                                        title: {
                                            text: ''
                                        },
                                        subtitle: {
                                            text: ''
                                        },
                                        xAxis: {
                                            categories: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    '<?php echo $lista->getPeriodo(); ?>', <?php } ?>
                                            ]
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'DIAS'
                                            }
                                        },
                                        plotOptions: {
                                            line: {
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                enableMouseTracking: false
                                            }
                                        },
                                        series: [{
                                                name: 'Tokyo',
                                                data: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    <?php echo $lista->getPeriodo_cobro(); ?>, <?php } ?>
                                                ]
                                            }]
                                    });
                                });
                            </script>
                            <div id="ppcobro" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                            <h3 class="text-center">INDICE DE ENDEUDAMIENTO</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <script type="text/javascript">
                                $(function () {
                                    $('#endeudamiento').highcharts({
                                        chart: {
                                            type: 'line'
                                        },
                                        title: {
                                            text: ''
                                        },
                                        subtitle: {
                                            text: ''
                                        },
                                        xAxis: {
                                            categories: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    '<?php echo $lista->getPeriodo(); ?>', <?php } ?>
                                            ]
                                        },
                                        yAxis: {
                                            title: {
                                                text: '% DE ENDEUDAMIENTO'
                                            }
                                        },
                                        plotOptions: {
                                            line: {
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                enableMouseTracking: false
                                            }
                                        },
                                        series: [{
                                                name: 'Tokyo',
                                                data: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    <?php echo $lista->getIndice_endeudamiento(); ?>, <?php } ?>
                                                ]
                                            }]
                                    });
                                });
                            </script>
                            <div id="endeudamiento" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                            <h3 class="text-center">RAZON DE CARGO DE INTERES FIJO</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <script type="text/javascript">
                                $(function () {
                                    $('#interes').highcharts({
                                        chart: {
                                            type: 'line'
                                        },
                                        title: {
                                            text: ''
                                        },
                                        subtitle: {
                                            text: ''
                                        },
                                        xAxis: {
                                            categories: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    '<?php echo $lista->getPeriodo(); ?>', <?php } ?>
                                            ]
                                        },
                                        yAxis: {
                                            title: {
                                                text: '% DE ENDEUDAMIENTO'
                                            }
                                        },
                                        plotOptions: {
                                            line: {
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                enableMouseTracking: false
                                            }
                                        },
                                        series: [{
                                                name: 'Tokyo',
                                                data: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    <?php echo $lista->getCargo_interes_fijo(); ?>, <?php } ?>
                                                ]
                                            }]
                                    });
                                });
                            </script>
                            <div id="interes" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                            <h3 class="text-center">MARGEN DE UTILIDAD BRUTA</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <script type="text/javascript">
                                $(function () {
                                    $('#utilidad_bruta').highcharts({
                                        chart: {
                                            type: 'line'
                                        },
                                        title: {
                                            text: ''
                                        },
                                        subtitle: {
                                            text: ''
                                        },
                                        xAxis: {
                                            categories: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    '<?php echo $lista->getPeriodo(); ?>', <?php } ?>
                                            ]
                                        },
                                        yAxis: {
                                            title: {
                                                text: '% DE UTILIDAD BRUTA'
                                            }
                                        },
                                        plotOptions: {
                                            line: {
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                enableMouseTracking: false
                                            }
                                        },
                                        series: [{
                                                name: 'Tokyo',
                                                data: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    <?php echo $lista->getMargen_utilidad_bruta(); ?>, <?php } ?>
                                                ]
                                            }]
                                    });
                                });
                            </script>
                            <div id="utilidad_bruta" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                            <h3 class="text-center">MARGEN DE UTILIDAD NETA</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <script type="text/javascript">
                                $(function () {
                                    $('#utilidad_neta').highcharts({
                                        chart: {
                                            type: 'line'
                                        },
                                        title: {
                                            text: ''
                                        },
                                        subtitle: {
                                            text: ''
                                        },
                                        xAxis: {
                                            categories: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    '<?php echo $lista->getPeriodo(); ?>', <?php } ?>
                                            ]
                                        },
                                        yAxis: {
                                            title: {
                                                text: '% DE UTILIDAD NETA'
                                            }
                                        },
                                        plotOptions: {
                                            line: {
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                enableMouseTracking: false
                                            }
                                        },
                                        series: [{
                                                name: 'Tokyo',
                                                data: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    <?php echo $lista->getMargen_utilidad_neta(); ?>, <?php } ?>
                                                ]
                                            }]
                                    });
                                });
                            </script>
                            <div id="utilidad_neta" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                            <h3 class="text-center">RENDIMIENTO DE ACTIVOS TOTALES</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <script type="text/javascript">
                                $(function () {
                                    $('#rendimiento').highcharts({
                                        chart: {
                                            type: 'line'
                                        },
                                        title: {
                                            text: ''
                                        },
                                        subtitle: {
                                            text: ''
                                        },
                                        xAxis: {
                                            categories: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    '<?php echo $lista->getPeriodo(); ?>', <?php } ?>
                                            ]
                                        },
                                        yAxis: {
                                            title: {
                                                text: '% DE RENDIMIENTO SOBRE ACTIVOS TOTALES'
                                            }
                                        },
                                        plotOptions: {
                                            line: {
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                enableMouseTracking: false
                                            }
                                        },
                                        series: [{
                                                name: 'Tokyo',
                                                data: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    <?php echo $lista->getRendimiento_activo(); ?>, <?php } ?>
                                                ]
                                            }]
                                    });
                                });
                            </script>
                            <div id="rendimiento" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                            <h3 class="text-center">RENDIMIENTO SOBRE EL PATRIMONIO</h3>
                        </a>
                    </div>
                    <div id="" class="">
                        <div class="body">
                            <script type="text/javascript">
                                $(function () {
                                    $('#patrimonio').highcharts({
                                        chart: {
                                            type: 'line'
                                        },
                                        title: {
                                            text: ''
                                        },
                                        subtitle: {
                                            text: ''
                                        },
                                        xAxis: {
                                            categories: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    '<?php echo $lista->getPeriodo(); ?>', <?php } ?>
                                            ]
                                        },
                                        yAxis: {
                                            title: {
                                                text: '% DE RENDIMIENTO SOBRE EL PATRIMONIO'
                                            }
                                        },
                                        plotOptions: {
                                            line: {
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                enableMouseTracking: false
                                            }
                                        },
                                        series: [{
                                                name: 'Tokyo',
                                                data: [
                                                    <?php foreach ($ratio as $lista) { ?>
                                                    <?php echo $lista->getRendimiento_patrimonio(); ?>, <?php } ?>
                                                ]
                                            }]
                                    });
                                });
                            </script>
                            <div id="patrimonio" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</section>


<?php
include_once '../plantilla/pie.php';
?>