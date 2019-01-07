<script language="javascript">
    $(document).ready(function () {

        $('form').keypress(function (e) {
            if (e == 13) {
                return false;
            }
        });

        $('input').keypress(function (e) {
            if (e.which == 13) {
                return false;
            }
        });

    });
</script>
<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
include_once '../plantilla/barra_lateral_usuario.php';

if (isset($_REQUEST['nameEnviar'])) {

    include_once '../modelos/persona_juridica.php';
    include_once '../modelos/balance_general.php';
    include_once '../modelos/estado_resultado.php';

    include_once '../repositorios/repositorio_juridico.php';
    include_once '../repositorios/repositorio_balance.php';
    include_once '../repositorios/repositorio_estado_resultado.php';

    include_once '../app/Conexion.php';
    Conexion::abrir_conexion();
    
    $id_juridico = $_REQUEST['codCliente_cpersonal'];
    $periodo = $_REQUEST['NamePeriodo'];

    ///////////esto es para guardar rel balance general            
    $balance = new balance_general();
    $balance->setId_persona($id_juridico);
    $balance->setPeriodo($periodo);
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
    $estado->setPeriodo($periodo);
    $estado->setIngreso_venta($_REQUEST['nameIngresoVenta']);
    $estado->setCosto_venta($_REQUEST['nameCostoVenta']);
    $estado->setGasto_venta($_REQUEST['nameGastoVenta']);
    $estado->setGasto_administrativo($_REQUEST['nameGastoAdmi']);
    $estado->setGasto_arrendamiento($_REQUEST['nameGastoArrendamiento']);
    $estado->setGasto_depreciacion($_REQUEST['nameGastoDepreciacion']);
    $estado->setGasto_interes($_REQUEST['nameGastoInteres']);

    repositorio_estado_resultado::insertar_estado_resultado(Conexion::obtener_conexion(), $estado);

    echo '<script>
          location.href="estados_financieros.php";
         </script>';
} else {
    ?>

<form action="estados_financieros.php" method="get" name="credito_personal" id="credito_personal" autocomplete="off">
        <input type="hidden" id="pas_cp" name="pas_cp"/>
        <input type="radio" id="uno" checked="" style="visibility: hidden"/>
        <section class="content">
            <!--    INICIO DE DATOS-->
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2 class="text-center">SELECCIONE LA EMPRESA</h2>
                            </div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-5">
                                                <div class="input-field"><i class="fa fa-search prefix" aria-hidden="true">

                                                    </i><label for="" style="font-size:16px">Buscar Empresa</label>
                                                    <input type="text" id="buscar_cliente" class="form-control"  name="" autofocus onkeypress="return llenar_tabla_cliente(this)"  list="lista_personas_naturales2">
                                                </div>              
                                            </div>
                                            <div class="col-md-5">
                                                <div class="input-field"><i class="fa fa-search prefix" aria-hidden="true">

                                                    </i><label for="" style="font-size:16px">Periodo</label>
                                                    
                                                    <input type="number" class="form-control" name="NamePeriodo" autofocus min="2000" max="2016">
                                                </div>              
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-striped table-bordered" id="tabla_cliente_juridico">
                                    <caption>CLIENTE</caption>
                                    <thead>
                                    <th>Codigo</th>
                                    <th>Nombre de la empresa</th>
                                    <th>Numero de empresa</th>
                                    <th>Dui de Representante</th>
                                    <th>Nit de Representante</th>

                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!-- Basic Validation -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse-balance">
                                    <h2 class="text-center">BALANCE GENERAL</h2>
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
                                    <h2 class="text-center">ESTADO DE RESULTADOS</h2>
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
    </form>


    <datalist id="lista_personas_naturales2">
    <?php
    include_once '../app/Conexion.php';
    include_once '../modelos/persona_juridica.php';
    include_once '../repositorios/repositorio_juridico.php';
    Conexion::abrir_conexion();
    $listado = repositorio_juridico::lista_persona_juridca(Conexion::obtener_conexion());




    foreach ($listado as $fila) {
        echo '<option value="' . $fila->getId_nombre() . '" label="' . $fila->getId_persona_juridica() . '" > ';
    }
    ?>
    </datalist>

    <script>
        function llenar_tabla_cliente(valor) {
            var depto = valor.value;
            var depto = $("#lista_personas_naturales2 option[value='" + $('#buscar_cliente').val() + "']").attr('label');//alert(depto);
            $("#lista_personas_naturales2").load(" #lista_personas_naturales");//para actuaizar la datalist cuando registra 
    //var numero=valor.id.substr(7)
    //alert(valor.id);
            if (depto != "") {//alert("paso "+depto);
                $.post("../cuenta_cobrar/llenar_tabla_juridica.php", {libro: depto}, function (mensaje) {
                    $('#lista_personas_naturales2').html(mensaje).fadeIn();

                });
            }
            return false;//para qeu no se envie el form
        }

        function agr_refe() {//para agreagar a la tabla
            var n = document.getElementById("ref_Nombre").value;
            var a = document.getElementById("ref_Apellido").value;
            var nombre_ref = document.getElementById("ref_Nombre").value + " " + document.getElementById("ref_Apellido").value;
            var tel_ref = document.getElementById("ref_Telefono").value;
            var dir_ref = document.getElementById("ref_Direccion").value;
            linea0 = "";
            linea0 = linea0.concat(
                    "<tr>",
                    '<td><input type="button" class="borrar_personatabla_ref_cpersonal btn-sm btn-danger" value="-"/>&nbsp;</td>',
                    '<td><input type="hidden"  name="nombre_ref[]" value="' + n + '"/> <input type="hidden"  name="ape_ref[]" value="' + a + '"/>' + nombre_ref + "</td>",
                    '<td><input type="hidden"  name="tel_ref[]" value="' + tel_ref + '"/> ' + tel_ref + "</td>",
                    '<td><input type="hidden"  name="dir_ref[]" value="' + dir_ref + '"/> ' + dir_ref + "</td>",
                    "</tr>"
                    );
            //alert("paso " + linea0);
            $("table#tabla_referencias tbody").append(linea0);
            document.getElementById("ref_Nombre").value = "";
            document.getElementById("ref_Apellido").value = "";
            document.getElementById("ref_Direccion").value = "";
            document.getElementById("ref_Telefono").value = "";

        }
    //eliminar de la tabla
        $(document).on('click', '.borrar_personatabla_cliente_cpersonal', function (event) {
            event.preventDefault();
            $(this).closest('tr').remove();
        });
        $(document).on('click', '.borrar_personatabla_ref_cpersonal', function (event) {
            event.preventDefault();
            $(this).closest('tr').remove();
        });

        function cuota_per() {
            var tasa_persona = document.getElementById("tasa_per").value / 100 / 12;
            var monto_persona = document.getElementById("monto_per").value;
            var meses_persona = document.getElementById("mese_per").value;
            var cuota_persona = 0;

            cuota_persona = monto_persona * ((Math.pow(1 + tasa_persona, meses_persona) * tasa_persona) / (Math.pow(1 + tasa_persona, meses_persona) - 1));
            cuota_persona = cuota_persona.toFixed(2);
            //alert("$"+cuota);
            // cuota = monto_persona * Math.pow( 1 + tasa_persona, meses_persona ) / meses_persona; pils-monto_persona-txt pils-tiempo-txt pils-tasa_persona-txt

            document.getElementById('pils-cuota-txt').innerHTML = "$" + cuota_persona;
            document.getElementById('pils-monto-txt').innerHTML = "$" + monto_persona;
            document.getElementById('pils-tiempo-txt').innerHTML = meses_persona + " meses";
            document.getElementById('pils-tasa-txt').innerHTML = document.getElementById("tasa_per").value + "%";
            // $( '#pils-cuota-txt' ).text( '$' + numberWithCommas( cuota ) );
            addfilas("plan_pago_personal", document.getElementById("tasa_per").value);
        }

        function validarTablas_cper() {
            var okk = true;
            if ($('#tabla_cliente_cpersonal >tbody >tr').length == 0) {
                okk = false;

                swal("Ooops", "Tabla de cliente vacia", "warning");
            } else {
                if ($('#tabla_referencias >tbody >tr').length == 0) {
                    okk = false;
                    swal("Ooops", "Tabla de Referencias vacia", "warning");

                }

            }
            return okk;
        }

        function interes_hp(valor) {
            valor = valor.value; //alert("aso "+valor);
            switch (valor) {
                case '12':
                    document.getElementById('tasa_per').value = 14;
                    break;
                case '24':
                    document.getElementById('tasa_per').value = 13;
                    break;
                case '36':
                    document.getElementById('tasa_per').value = 12;
                    break;
                case '48':
                    document.getElementById('tasa_per').value = 8;
                    break;
                case '60':
                    document.getElementById('tasa_per').value = 8;
                    break;
                case '72':
                    document.getElementById('tasa_per').value = 7;
                    break;
                case '84':
                    document.getElementById('tasa_per').value = 6;
                case '96':
                    document.getElementById('tasa_per').value = 5;
                    break;
            }

        }
    </script>
    <?php
}
include_once '../plantilla/pie.php';
?>
