<script language="javascript">
    $(document).ready(function () {



        $(document).ready(function ()
        {

            $('#abono').keypress(function (e) {
                if (e.which == 13) {
                    calcular_factura();
                    return false;
                }
            });

        });


    });
</script>
<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
include_once '../plantilla/barra_lateral_usuario.php';
?>


<section class="content">
    <!--    INICIO DE DATOS-->

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-center">SELECCIONE EL CLIENTE</h2>
                    </div>
                    <div class="body">
                        <form name="abono_form" id="abono_form" method="post" action="" onsubmit="impFact()" >
                            <input type="hidden" id="paso_abono" name="paso_abono"/>
                            <input type="hidden" id="saldo_act" name="saldo_act" />
                            <input type="hidden" id="pj" name="pj" />
                            <input type="hidden" id="interes" />
                            <input type="hidden" id="finalizar" name="finalizar" value="no" />
                            <input type="hidden" id="fecha_pago" />
                            <input type="hidden" id="fecha_hoy" name="fecha_hoy" />
                            <input type="hidden" id="cuota_hoy" />
                            <input type="hidden" id="id_prestamo_abono" name="id_prestamo_abono" />
                            <input type="hidden" id="saldo_act_hoy" name="saldo_act_hoy" />
                            <input type="hidden" id="mora_hoy" name="mora_hoy" />
                            <input type="hidden" id="int_hoy" name="int_hoy" />

                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <div class="col-md-6">
                                            <div class="input-field"><i class="fa fa-search prefix" aria-hidden="true">

                                                </i><label for="" style="font-size:16px">Buscar Cliente</label>
                                                <input type="text" id="buscar_cliente_abono"  name="buscar_cliente_abono" autofocus onkeypress="llenar_tabla_cliente_abono(this)" list="lista_personas_cliente_abono" class="form-control">
                                            </div>              
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <table class="table table-striped table-bordered" id="tabla_cliente_abono">
                                <caption>CLIENTE</caption>
                                <thead>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th><div id="tipoID">Dui</div></th>
                                <th>Nit</th>
                                <th>Monto</th>
                                <th>Saldo Actual</th>  
                                <th>Cuota</th>  
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <div class="select-dropdown">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label class="success">Abono</label>
                                            <input type="text"class="form-control text-center" required="" minlength="1"  id="abono" name="abono"  placeholder="$$$">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" onclick="calcular_factura()" class="btn btn-primary m-t-15 waves-effect">CALCULAR</button>
                                </div>
                            </div>
                           <div class="container-fluid" id="factura_N" >
                            <table class="table table-striped table-bordered" s id="factura_natural">
                                <caption>FACTURA</caption>

                                <tbody>
                                    <tr>
                                        <th colspan=4><p class="text-center">BanDejando   CREDITO FACIL </p></th>
                                    </tr>
                                    <tr>
                                        <td id="nprestamo_fat"> n facura</td>
                                        <td colspan="2" id="nombre_fat">nombre cliente</td>
                                        <td id="fecha_pres_fat">fecha aplicacion</td>
                                    </tr>
                                    <tr>
                                        <td id="nit_fat">nit</td>
                                        <td id="dui_fat">dui</td>
                                        <td > </td>
                                        <td id="fecha_pago_fat"> 12/12/1212</td>
                                    </tr>
                                    <tr>
                                        <td id="fecha_fin_fat">fecha vencimiento</td>
                                        <td id="fecha_ultimo_fat"></td>
                                        <td></td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td id="monto_fat">monto</td>
                                        <td id="cuota_fat">valor cuota</td>
                                        <td colspan="2"> </td>
                                    <tr>
                                        <td id="tasa_fat">tasa nominal</td>
                                        <td colspan="3"> </td>
                                    </tr>
                                    <tr>
                                        <td id="saldo_ant_fat">saldo acterior</td>
                                        <td id="saldo_act_fat">saldo actual</td>
                                        <td colspan="2"> </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td ></td>
                                        <td> </td>
                                    </tr>

                                    <tr>
                                        <td>CAPITAL</td>
                                        <td></td>
                                        <td ></td>
                                        <td id="cap_fat"> $</td>
                                    </tr>
                                    <tr>
                                        <td>INTERES</td>
                                        <td></td>
                                        <td></td>
                                        <td id="int_fat"> $</td>
                                    </tr>
                                    <tr>
                                        <td>Mora</td>
                                        <td></td>
                                        <td></td>
                                        <td id="mora_fat"> $</td>
                                    <tr>

                                        <td colspan="2"></td>
                                        <td></td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td id="nom_caj_fat">nobre user</td>
                                        <td></td>
                                        <td ></td>
                                        <td > </td>
                                    </tr>
                                <td id="id_cajero_fat">cajero n</td>
                                <td>TOTAL</td>
                                <td></td>
                                <td id="total_fat"> $</td>
                                </tr>

                                </tbody>

                            </table>
                            </div>

                            <div class="text-center">
                                <button type="submit" form="abono_form" class="btn  btn-primary m-t-15 waves-effect" >GUARDAR</button>
                                <button type="reset" class="btn btn-primary m-t-15 waves-effect">CANCELAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    FIN DE DATOS-->



</section>


<datalist id="lista_personas_cliente_abono">
    <?php
    include_once '../app/Conexion.php';
    include_once '../modelos/persona_juridica.php';
    include_once '../repositorios/repositorio_expediente_natural.php';
    include_once '../repositorios/repositorio_juridico.php';
    Conexion::abrir_conexion();
    
    $listado1 = repositorio_juridico::lista_persona_juridca(Conexion::obtener_conexion());
    $l=count($listado1);
    for ($i=0 ; $i < $l ; $i++) {
        echo '<option value="' . $listado1[$i]->getId_nombre() . '" label="' . $listado1[$i]->getId_persona_juridica() . '-J" > ';
    }
    
    $listado = repositorio_expediente_natural::lista_clientes(Conexion::obtener_conexion());
    foreach ($listado as $fila) {
        echo '<option value="' . $fila[1] .' ' . $fila[2] . '" label="' . $fila[0] . '-N" > ';
    }
    
    
    
    ?>
</datalist>

<script>
    function impFact(){
        var ficha = document.getElementById("factura_N");
	  var ventimp = window.open(' ', 'popimpr');
	  ventimp.document.write( ficha.innerHTML );
	  ventimp.document.close();
	  ventimp.print( );
	  ventimp.close();
    }
    
    function llenar_tabla_cliente_abono(valor) {
        //var depto = valor.value;
        var depto = $("#lista_personas_cliente_abono option[value='" + $('#buscar_cliente_abono').val() + "']").attr('label');
        $("#lista_personas_cliente_abono").load(" #lista_personas_cliente_abono");//para actuaizar la datalist cuando registra 
//var numero=valor.id.substr(7)

        if (depto != "") {//alert("paso"+depto);
            $.post("../cuenta_cobrar/llenar_tabla_cliente_abono.php", {libro: depto}, function (mensaje) {
                $('#lista_personas_cliente_abono').html(mensaje).fadeIn();

            });
        }
        return false;//para qeu no se envie el form
    }


//eliminar de la tabla  saldo_act


    function calcular_factura() {
        if (document.getElementById("abono").value > 0) {
            var pago = document.getElementById("abono").value;
            var pagoTotal = parseInt( document.getElementById("saldo_act").value);
            var fecha_pago = document.getElementById("fecha_pago").value;
            var fecha_hoy = document.getElementById("fecha_hoy").value;
            var fecha_aux = fecha_hoy.split('-');
            var mes = (fecha_aux[1]);
            var ano = (fecha_aux[0]);
            var diasMes = 30 //getUltimoDiaDelMes(mes, ano);


            //calcualo los dias que se paso o faltan para el pago
            var mora = 0;
            var aFecha2 = fecha_hoy.split('-');
            var aFecha1 = fecha_pago.split('-');
            var fFecha1 = Date.UTC(aFecha1[0], aFecha1[1], aFecha1[2]);
            var fFecha2 = Date.UTC(aFecha2[0], aFecha2[1], aFecha2[2] - 1);
            var dif = fFecha2 - fFecha1;
            var dias = Math.floor(dif / (1000 * 60 * 60 * 24));


            if (dias == 0) {
                var int_calculado = (document.getElementById("interes").value * document.getElementById("saldo_act").value * diasMes) / 360;
              
            } else {
                if (dias < 0) {
                    var int_calculado = (document.getElementById("interes").value * document.getElementById("saldo_act").value * (diasMes + dias)) / 360;
                    
                } else {
                    if (dias > 0) {
                        var int_calculado = (document.getElementById("interes").value * document.getElementById("saldo_act").value * diasMes) / 360;
                       
                        var mora = (((document.getElementById("interes").value) * (document.getElementById("cuota_hoy").value - int_calculado)) / 360) * (dias);
                    }
                }

            }
            var deudaTotal=(parseFloat(int_calculado) + parseFloat(pagoTotal));
            
            
            if ((deudaTotal) < pago) {
                swal({
                    title: "¿Desea Continuar?",
                    text: "La cantidad ingresada es mayor al saldo actual mas los intereses, se finalizara el prestamo " ,
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, continuar!",
                    closeOnConfirm: false
                },
                        function () {
                            ok = true;
                            swal(
                                    'Registrado',
                                    'Datos Registrados con Exito',
                                    'success'
                                    );
                            document.getElementById("finalizar").value = "si";
                            document.getElementById("abono").value=(int_calculado + pagoTotal);
                            document.getElementById("mora_hoy").value = mora;
                            document.getElementById("int_hoy").value = int_calculado;
                           document.abono_form.submit();//lo envio aqui porque retorna la vaiable antes y despues ejecuta el swal
                           
                        });
            }else{
            if (pago > int_calculado) {
                document.getElementById('cap_fat').innerHTML = "$ " + (pago - int_calculado - mora).toFixed(2);
                document.getElementById('int_fat').innerHTML = "$ " + int_calculado.toFixed(2);
                document.getElementById('mora_fat').innerHTML = "$ " + mora.toFixed(2);
                document.getElementById('total_fat').innerHTML = "$ " + pago;
                document.getElementById('saldo_act_fat').innerHTML = "SALDO ACTUAL: $ " + ((document.getElementById("saldo_act").value - (pago - int_calculado - mora)).toFixed(2));
                document.getElementById("saldo_act_hoy").value = ((document.getElementById("saldo_act").value - (pago - int_calculado - mora)).toFixed(2));
                document.getElementById("int_hoy").value = int_calculado;
                document.getElementById("mora_hoy").value = mora;


            } else {
                swal('Oops', 'Parece que el pago no alcanza a cubrir  el interes del mes', 'warning');
            }
        }
            
        } else {
            swal('Oops', 'Formato de abono no valido ', 'warning');
        }
    }

    function getUltimoDiaDelMes(mes, ano)
    {
        alert(mes + " " + ano);
        /*
         Los meses 1,3,5,7,8,10,12 siempre tienen 31 días
         Los meses 4,6,9,11 siempre tienen 30 días
         El único problema es el mes de febrero dependiendo del año puede tener 28 o 29 días
         */
        if ((mes == 1) || (mes == 3) || (mes == 5) || (mes == 7) || (mes == 8) || (mes == 10) || (mes == 12)) {
            return 31;
        } else {
            if ((mes == 4) || (mes == 6) || (mes == 9) || (mes == 11)) {
                return 30;
            } else if (mes == 2)
            {

                if ((ano % 4 == 0) && (ano % 100 != 0) || (ano % 400 == 0))
                    return 29;
                else
                    return 28;
            }
        }
    }


</script>
<?php
include_once '../plantilla/pie.php';
if (isset($_REQUEST["paso_abono"])) {


    include_once '../app/Conexion.php';
    include_once '../modelos/pago.php';
    include_once '../modelos/presamo.php';
    include_once '../modelos/expediente_natural.php';
    include_once '../repositorios/repositorio_pago.php';
    include_once '../repositorios/repositorio_referencias.php';
    include_once '../repositorios/repositorio_prestamo.php';
    include_once '../repositorios/repositorio_expediente_natural.php';



    Conexion::abrir_conexion();
//echo '<script language="javascript">alert("juas");</script>'; 
    $fin=$_REQUEST["finalizar"];
    $pago = new pago();

    $pago->setFecha($_REQUEST["fecha_hoy"]);
    $pago->setId_prestamo($_REQUEST["id_prestamo_abono"]);
    $pago->setInteres($_REQUEST["int_hoy"]);
    $pago->setMonto($_REQUEST["abono"]);
    $pago->setMora($_REQUEST["mora_hoy"]);

    $prestamo = new presamo();
    $prestamo->setSaldo_actual($_REQUEST["saldo_act_hoy"]);
    $prestamo->setEstado($fin);
    $prestamo->setId_asesor($_REQUEST["codCliente_abono"]);
    $prestamo->setId_plan($_REQUEST["pj"]);

    if (repositorio_pago::insertar_pago(Conexion::obtener_conexion(), $pago) && repositorio_prestamo::actualizar_prestamo(Conexion::obtener_conexion(), $prestamo, $_REQUEST["id_prestamo_abono"])) {
        echo "<script type='text/javascript'>";
        echo 'swal({
                    title: "Exito",
                    text: "Pago registrado",
                    type: "success"},
                    function(){                    
                    }
                    ); ';
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo 'swal({
                    title: "Ooops",
                    text: "Prestamo no Registrado",
                    type: "error"},
                    function(){
                    }
                    );';
        echo "</script>";
    }
}
?>
