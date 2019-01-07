<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
include_once '../plantilla/barra_lateral_usuario.php';
include_once '../app/Conexion.php';

if (isset($_REQUEST['nameEnviar'])) {
    
    include_once '../modelos/persona_juridica.php';
    include_once '../modelos/balance_general.php';
    include_once '../modelos/estado_resultado.php';

    include_once '../repositorios/repositorio_juridico.php';
    include_once '../repositorios/repositorio_balance.php';
    include_once '../repositorios/repositorio_estado_resultado.php';
    
    Conexion::abrir_conexion();
    
    ////////esto es para guardar persona juridica
    $juridica = new persona_juridica();
    $juridica->setId_nombre($_REQUEST['nameNombre']);
    $juridica->setNumero($_REQUEST['nameNumero']);
    $juridica->setDui($_REQUEST['nameDuiJuridico']);
    $juridica->setNit($_REQUEST['nameNitJuridico']);
    
    if (repositorio_juridico::insertar_persona_juridica(Conexion::obtener_conexion(), $juridica)) {
        $numero = repositorio_juridico::ultima_persona_insertada(Conexion::obtener_conexion());
        
        foreach ($numero as $lista){
            $id_juridico = $lista->getId_persona_juridica();
    }
    ///////////esto es para guardar rel balance general            
        $balance = new balance_general();
        $balance->setId_persona($id_juridico);
        $balance->setPeriodo('2017');
        $balance->setEfectivo($_REQUEST['nameEfectivo']);
        $balance->setValor_negociable($_REQUEST['nameNegociable']);
        $balance->setCuenta_por_cobrar($_REQUEST['NameCuentaXcobrar']);
        $balance->setInventarios($_REQUEST['NameInventario']);
        $balance->setTerrenos($_REQUEST['NameTerreno']);
        $balance->setEdificio_equipo($_REQUEST['NameEdificio']);
        $balance->setDepreciacion($_REQUEST['NameDepreciacion']);
        $balance->setCuenta_por_pagar($_REQUEST['NameCuentaXpagar']);
        $balance->setDocumento_por_pagar($_REQUEST['NameDocumentoXpagar']);
        $balance->setDeuda_largop($_REQUEST['NameDeuda']);
        $balance->setAccioneC($_REQUEST['NameAcciones']);
        $balance->setGanancias_retenidas($_REQUEST['NameRetenidas']);
               
        repositorio_balance::insertar_balance_general(Conexion::obtener_conexion(), $balance);
        
        ///////////////////////esto es para el registro de estado de resultado 
        $estado = new estado_resultado();
        $estado->setId_persona_juridica($id_juridico);
        $estado->setPeriodo('2017');
        $estado->setIngreso_venta($_REQUEST['nameIngresoVenta']);
        $estado->setCosto_venta($_REQUEST['nameCostoVenta']);
        $estado->setGasto_venta($_REQUEST['nameGastoVenta']);
        $estado->setGasto_administrativo($_REQUEST['nameGastoAdmi']);
        $estado->setGasto_arrendamiento($_REQUEST['nameGastoArrendamiento']);
        $estado->setGasto_depreciacion($_REQUEST['nameGastoDepreciacion']);
        $estado->setGasto_interes($_REQUEST['nameGastoInteres']);
                
        repositorio_estado_resultado::insertar_estado_resultado(Conexion::obtener_conexion(), $estado);
         
        echo '<script>
    location.href="./registro_juridico.php";

</script>';
    }
    
} else {
    ?>

<form action="registro_juridico.php" method="GET" autocomplete="off">
        <!--    INICIO DE DATOS-->
        <section class="content">
            <div class="container-fluid">

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse-empresa">
                                    <h2 class="text-center">DATOS BASICOS</h2>
                                </a>
                            </div>
                            <div id="collapse-empresa" class="panel-collapse collapse">
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">NOMBRE DE LA EMPRESA</span>
                                                    <input type="text" class="form-control text-center" name="nameNombre" placeholder="NOMBRE DE LA EMPRESA" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">N EMPRESA</span>
                                                    <input type="text" class="form-control text-center" name="nameNumero" placeholder="NUMERO DE LA EMPRESA" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">DUI REPRESENTANTE JURIDICO</span>
                                                    <input type="text" class="form-control text-center" name="nameDuiJuridico" id="Dui_fia_per" placeholder="DUI DEL REPRESENTANTE JURIDICO" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">NIT REPRESENTANTE JURIDICO</span>
                                                    <input type="text" class="form-control text-center" name="nameNitJuridico" id="Nit_fia_per" placeholder="NIT DEL REPRESENTANTE JURIDICO" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--    FIN DE DATOS-->

            <!--INICIO DE BALANCE-->

            <div class="container-fluid">
                <!-- Basic Validation -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse-balance">
                                    <h2 class="text-center">BALANCE GENERAL (AL 31 DE DICIEMBRE DE 2017)</h2>
                                </a>
                            </div>
                            <div id="collapse-balance" class="panel-collapse collapse">
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">EFECTIVO($)</span>
                                                    <input type="number"   min="0" step="any" class="form-control text-center" required="" name="nameEfectivo" placeholder="EFECTIVO($)">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">VALORES NEGOCIABLES($)</span>
                                                    <input type="number"  min="0" step="any"class="form-control text-center" name="nameNegociable" placeholder="VALORES NEGOCIABLES($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">CUENTAS POR COBRAR($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="NameCuentaXcobrar" placeholder="CUENTAS POR COBRAR($)" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">INVENTARIOS($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="NameInventario" placeholder="INVENTARIOS($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">TERRENOS($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="NameTerreno" placeholder="TERRENOS($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">EDIFICIO Y EQUIPO($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="NameEdificio" placeholder="EDIFICIO Y EQUIPO($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">DEPRECIACION ACUMULADA($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="NameDepreciacion" placeholder="DEPRECIACION ACUMULADA($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">CUENTAS POR PAGAR($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="NameCuentaXpagar" placeholder="CUENTAS POR PAGAR($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">DOCUMENTOS POR PAGAR($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="NameDocumentoXpagar" placeholder="DOCUMENTOS POR PAGAR($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">DEUDA A LARGO PLAZO</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="NameDeuda" placeholder="DEUDA A LARGO PLAZO($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">ACCIONES COMUNES($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="NameAcciones" placeholder="ACCIONES COMUNES($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">GANANCIAS RETENIDAS($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="NameRetenidas" placeholder="GANANCIAS RETENIDAS($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--FIN DE BALANCE-->

            <!--INICIO DE ESTADO DE RESULTADO-->

            <div class="container-fluid">
                <!-- Basic Validation -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <a  data-toggle="collapse" data-parent="#accordion" href="#collapse-estado">
                                    <h2 class="text-center">ESTADO DE RESULTADOS (AL 31 DE DICIEMBRE DE 2017)</h2>
                                </a>
                            </div>
                            <div id="collapse-estado" class="panel-collapse collapse">
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">INGRESOS POR VENTA($)</span>
                                                    <input type="number" min="0" step="any" class="form-control text-center" name="nameIngresoVenta" placeholder="INGRESO DE VENTAS($)" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">COSTOS DE LOS BIENES VENDIDOS($)</span>
                                                    <input type="number"  min="0" step="any"class="form-control text-center" name="nameCostoVenta" placeholder="COSTOS DE LOS BIENES VENDIDOS($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">GASTO DE VENTA($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="nameGastoVenta" placeholder="GASTOS DE VENTAS($)" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">GASTOS GENERALES Y ADMINISTRACION($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="nameGastoAdmi" placeholder="GASTOS GENERALES Y ADMINISTRACION" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">GASTOS DE ARRENDAMIENTO($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="nameGastoArrendamiento" placeholder="GASTOS DE ARRENDAMIENTO($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">GASTOS POR DEPRECIACION($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="nameGastoDepreciacion" placeholder="GASTOS POR DEPRECIACION($)" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">GASTOS POR INTERES($)</span>
                                                    <input type="number"  min="0" step="any" class="form-control text-center" name="nameGastoInteres" placeholder="GASTOS POR INTERESES" required="">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="text-center">
                                <button type="submit" name="nameEnviar" class="btn btn-primary m-t-15 waves-effect" value="ok">GUARDAR</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </section>
        <!--FIN DE ESTADO DE RESULTADOS-->

    </form>
    <?php
}
include_once '../plantilla/pie.php';
?>