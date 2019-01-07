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
?>

<form action="" method="post" class="formNatural" name="credito_personal" id="credito_personal" onsubmit="return validarTablas_cper()" enctype="multipart/form-data" autocomplete="off" >
    <input type="hidden" id="pas_cp" name="pas_cp"/>
    <input type="hidden" id="n" name="n" value="1"/>
    <input type="radio" id="uno" checked="" style="display: none"/>
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
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <div class="col-md-6">
                                            <div class="input-field"><i class="fa fa-search prefix" aria-hidden="true">

                                                </i><label for="" style="font-size:16px">Buscar Cliente</label>
                                                <input type="text" id="buscar_cliente"  name="" autofocus onkeypress="return llenar_tabla_cliente(this)" class="form-control" list="lista_personas_naturales">
                                            </div>              
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tipo Credito</label>
                                                <select class="form-control accion_select" onchange="cambiar(this.value)" id="cual" name="cual" >
                                                    <option value="1" >PERSONAL</option>
                                                    <option value="2" >HIPOTECARIO</option>
                                                    <option value="3" >AGROPECUARIO</option>
                                                    <option value="4" >SOLIDARIO</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <table class="table table-striped table-bordered" id="tabla_cliente_cpersonal">
                                    <caption>CLIENTE</caption>
                                    <thead>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Dui</th>
                                    <th>Nit</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>  
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered" id="tabla_referencias">
                                    <caption>REFERENCIAS</caption>
                                    <thead>
                                    <th>&nbsp;</th>    
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>                                   
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    FIN DE DATOS-->

        <!--INICIO BIEN-->
        <div class="container-fluid" id="containeBien" style="display: none ">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header"><a data-toggle="collapse" data-parent="#accordion" href="#collapse-BIEN">
                                <h2 class="text-center">DATOS DEL BIEN </h2>
                            </a> </div>
                        <div id="collapse-BIEN" class="panel-collapse collapse in">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">

                                                <span class="input-group-addon" id="basic-addon1">UBICACION</span>
                                                <input type="text"class="form-control text-center"  id="hubica" name="hubica" placeholder="UBICACION...">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">DESCRIPCION</span>
                                                <input type="text" class="form-control text-center"  id="rdescr" name="descr" placeholder="DESCRIPCION...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">ANEXO</span>
                                                <input type="file" class="form-control text-center"  id="bio" name="bio" placeholder="ANEXO...">
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
        <!--FIN DE BIEN-->

        <!--INICIO DE FIADOR-->
        <div class="container-fluid" id="containerFiedor">


            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-fiador">
                                <h2 class="text-center">DATOS DE FIADOR</h2>
                            </a></div>
                        <div id="collapse-fiador" class="panel-collapse collapse">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">NOMBRE</span>
                                                <input type="text"class="form-control text-center" required="" minlength="3" id="Nombre_fia_per" name="Nombre_fia_per" placeholder="NOMBRE...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">APELLIDO</span>
                                                <input type="text" class="form-control text-center" required="" minlength="3" id="Apellido_fia_per" name="Apellido_fia_per" placeholder="APELLIDO...">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">DIRECCION</span>
                                                <input type="text" class="form-control text-center" required="" minlength="3" id="Direccion_fia_per" name="Direccion_fia_per" placeholder="DIRECCION...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">TELEFONO</span>
                                                <input type="tel" class="form-control text-center" required="" minlength="3" id="Telefono_fia_per" name="Telefono_fia_per" placeholder="TELEFONO...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">DUI</span>
                                                <input type="text" class="form-control text-center" required="" minlength="3" id="Dui_fia_per" name="Dui_fia_per" placeholder="DUI...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">NIT</span>
                                                <input type="text" class="form-control text-center" required="" minlength="3" id="Nit_fia_per" name="Nit_fia_per" placeholder="NIT...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">CORREO</span>
                                                <input type="email" class="form-control text-center" required="" minlength="3" id="Email_fia_per" name="Email_fia_per" placeholder="CORREO...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">LUGAR DE TRABAJO</span>
                                                <input type="text" class="form-control text-center" required="" minlength="3" id="Trabajo_fia_per" name="Trabajo_fia_per" placeholder="LUGAR DE TRABAJO...">
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
        <!--FIN DE FIADOR-->

        <!--INICIO REFERENCIA-->
        <div class="container-fluid" id="containerReferencia">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header"><a data-toggle="collapse" data-parent="#accordion" href="#collapse-referencias">
                                <h2 class="text-center">DATOS DE REFERENCIA</h2>
                            </a> </div>
                        <div id="collapse-referencias" class="panel-collapse collapse">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">NOMBRE</span>
                                                <input type="text"class="form-control text-center" id="ref_Nombre" name="ref_Nombre" placeholder="NOMBRE...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">APELLIDO</span>
                                                <input type="text" class="form-control text-center" id="ref_Apellido" name="ref_Apellido" placeholder="APELLIDO...">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">DIREECION</span>
                                                <input type="text" class="form-control text-center" id="ref_Direccion" name="ref_Direccion" placeholder="DIRECCION...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">TELEFONO</span>
                                                <input type="tel" class="form-control text-center" id="ref_Telefono" name="ref_Telefono" placeholder="TELEFONO...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="text-center">
                                        <button type="button" onclick="agr_refe()" class="btn btn-primary m-t-15 waves-effect">Agregar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--FIN DE REFERENCIA-->

        <!--INICIO DATO DE CREDITO-->
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header"><a data-toggle="collapse" data-parent="#accordion" href="#collapse-credito">
                                <h2 class="text-center">DATOS DE CREDITO</h2>
                            </a></div>
                        <div id="collapse-credito" class="panel-collapse collapse in">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">MONTO SOLICITADO($)</span>
                                                <input type="number" required="" min="1000" max="20000" class="form-control text-center" id="monto_per" name="monto_per" placeholder="MONTO SOLICITADO($)... MINIMO $1,500, MAXIMO $40,000">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">PLAZO</span>
                                                <select class="form-control show-tick" required="" id="mese_per" name="mese_per" onchange="interes_hp(this)">
                                                    <option value="" disabled="" selected="">SELECCIONE EL NUMERO DE MESES</option>
                                                    <?php
                                                    $n = 12;
                                                    for ($i = 0; $i <= 7; $i++) {//echo '<script language="javascript">alert("'.$n.'");</script>'; 
                                                        echo '<option value="' . $n . '">' . $n . ' meses</option>';
                                                        $n = $n + 12;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="row">
                                            <span class="input-group-addon" id="basic-addon1">TASA DE INTERES</span>
                                            <div class="col-md-6">
                                                <div class="form-line">

                                                    <input type="number" required="" min="1" max="20" class="form-control text-center" readonly="" id="tasa_per" name="tasa_per" placeholder="TASA">
                                                </div>

                                            </div>
                                            <div class="col-md-6"><label style="font-size: 18">%</label></div>   
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">

                                            <button type="button" onclick="cuota_per()" class="btn btn-primary m-t-15 waves-effect">CALCULAR</button>
                                        </div></div>
                                </div>
                                <div class="text-center">

                                </div>
                                <div class="row"><div class="text-center">
                                        <button type="button" style="visibility: hidden" onclick="cuota_per()" class="btn btn-primary m-t-15 waves-effect">CALCULAR</button>
                                    </div></div>
                                <div class="row clearfix">


                                    <div class="row text-center">
                                        <div class="col-sm-3 resultado">
                                            <div class="big-bullet">
                                                <div class="bullet"></div>
                                                <div class="contenido text-120">Cuota Mensual</div>
                                            </div>
                                            <p class="text-center" id="pils-cuota-txt">$00.00</p>
                                        </div>
                                        <div class="col-sm-3 resultado">
                                            <div class="big-bullet">
                                                <div class="bullet"></div>
                                                <div class="contenido text-120">Monto de Préstamo</div>
                                            </div>
                                            <p class="text-center" id="pils-monto-txt">$00.00</p>
                                        </div>
                                        <div class="col-sm-3 resultado">
                                            <div class="big-bullet">
                                                <div class="bullet"></div>
                                                <div class="contenido text-120">Plazo</div>
                                            </div>
                                            <p class="text-center" id="pils-tiempo-txt">0 meses</p>
                                        </div>
                                        <div class="col-sm-3 resultado">
                                            <div class="big-bullet">
                                                <div class="bullet"></div>
                                                <div class="contenido text-120">Tasa</div>
                                            </div>
                                            <p class="text-center" id="pils-tasa-txt">00.00%</p>
                                        </div>
                                    </div>
                                    <div class="text-center ">
                                        <table class="table table-striped table-bordered" id="plan_pago_personal">
                                            <caption>PLAN DE PAGO</caption>
                                            <tbody>
                                                <tr>
                                                    <td>N </td>
                                                    <td>Capital</td>
                                                    <td>Interes</td>
                                                    <td>Cuota</td>
<!--                                                    <td>CARGOS</td>
                                                    <td>TORAL</td>-->
                                                    <td>Saldo</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="text-center">
                                    <button type="submit" form="credito_personal" class="btn btn-primary m-t-15 waves-effect">GUARDAR</button>
                                    <button type="reset" form="credito_personal" class="btn btn-primary m-t-15 waves-effect">CANCELAR</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--FIN DE DATO DE CREDITO-->

    </section>
</form>


<datalist id="lista_personas_naturales">
    <?php
    include_once '../app/Conexion.php';
    include_once '../repositorios/repositorio_expediente_natural.php';
    Conexion::abrir_conexion();
    $listado = repositorio_expediente_natural::lista_persona_natural(Conexion::obtener_conexion());
    foreach ($listado as $fila) {
        echo '<option value="' . $fila[1] .' '. $fila[2] . '" label="' . $fila[0] . '" > ';
    }
    ?>
</datalist>

<script language="javascript">
    function llenar_tabla_cliente(valor) {
        var depto = valor.value;
        var n = document.getElementById("n").value;
        var depto = $("#lista_personas_naturales option[value='" + $('#buscar_cliente').val() + "']").attr('label');//alert(depto);
        $("#lista_personas_naturales").load(" #lista_personas_naturales");//para actuaizar la datalist cuando registra 
//var numero=valor.id.substr(7)
//alert(valor.id);
        if (depto != "") {//alert("paso"+depto);
            $.post("../cuenta_cobrar/llenar_tabla_cliente.php", {libro: depto, idtabla: "tabla_cliente_cpersonal", n: n}, function (mensaje) {
                $('#lista_personas_naturales').html(mensaje).fadeIn();
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
        var tipo = document.getElementById("cual").value;

        if (tipo == 2) {
            if ($('#tabla_cliente_cpersonal >tbody >tr').length == 0) {
                okk = false;
                swal("Ooops", "Tabla de cliente vacia", "warning");
            }
        } else {
            if ($('#tabla_cliente_cpersonal >tbody >tr').length == 0) {
                okk = false;
                swal("Ooops", "Tabla de cliente vacia", "warning");
            } else {
                if ($('#tabla_referencias >tbody >tr').length == 0) {
                    okk = false;
                    swal("Ooops", "Tabla de Referencias vacia", "warning");
                }
            }
        }

        return okk;
    }
    function cambiar(valor) {
        if (valor == 1) {
            $("#Nombre_fia_per").prop("required", true);
            $("#Apellido_fia_per").prop("required", true);
            $("#Direccion_fia_per").prop("required", true);
            $("#Telefono_fia_per").prop("required", true);
            $("#Dui_fia_per").prop("required", true);
            $("#Nit_fia_per").prop("required", true);
            $("#Email_fia_per").prop("required", true);
            $("#Trabajo_fia_per").prop("required", true);
            $("#monto_per").prop("min", 1000);
            $("#monto_per").prop("max", 2000);
            document.getElementById('containeBien').style.display = 'none';
            document.getElementById('containerFiedor').style.display = 'block';
            document.getElementById('containerReferencia').style.display = 'block';
            document.getElementById('tabla_referencias').style.visibility = 'visible';
            $("#hubica").removeAttr("required");
            $("#rdescr").removeAttr("required");
            $("#anexo1").removeAttr("required");
        }
        if (valor == 2) {
            $("#hubica").prop("required", true);
            $("#rdescr").prop("required", true);
            $("#anexo1").prop("required", true);
            document.getElementById('containeBien').style.display = 'block';
            document.getElementById('containerFiedor').style.display = 'none';
            document.getElementById('containerReferencia').style.display = 'none';
            document.getElementById('tabla_referencias').style.visibility = ' hidden';
            $("#Nombre_fia_per").removeAttr("required");
            $("#Apellido_fia_per").removeAttr("required");
            $("#Direccion_fia_per").removeAttr("required");
            $("#Telefono_fia_per").removeAttr("required");
            $("#Dui_fia_per").removeAttr("required");
            $("#Nit_fia_per").removeAttr("required");
            $("#Email_fia_per").removeAttr("required");
            $("#Trabajo_fia_per").removeAttr("required");
        }
        if (valor == 3) {
            $("#Nombre_fia_per").prop("required", true);
            $("#Apellido_fia_per").prop("required", true);
            $("#Direccion_fia_per").prop("required", true);
            $("#Telefono_fia_per").prop("required", true);
            $("#Dui_fia_per").prop("required", true);
            $("#Nit_fia_per").prop("required", true);
            $("#Email_fia_per").prop("required", true);
            $("#Trabajo_fia_per").prop("required", true);
            $("#monto_per").prop("min", 50);
            $("#monto_per").prop("max", 5000);
            document.getElementById('containeBien').style.display = 'none';
            document.getElementById('containerFiedor').style.display = 'block';
            document.getElementById('containerReferencia').style.display = 'block';
            document.getElementById('tabla_referencias').style.visibility = 'visible';
            $("#hubica").removeAttr("required");
            $("#rdescr").removeAttr("required");
            $("#anexo1").removeAttr("required");
        }

        if (valor == 4) {
            $("#hubica").prop("required", true);
            $("#rdescr").prop("required", true);
            $("#anexo1").prop("required", true);
            document.getElementById('containeBien').style.display = 'block';
            document.getElementById('containerFiedor').style.display = 'none';
            document.getElementById('containerReferencia').style.display = 'none';
            document.getElementById('tabla_referencias').style.visibility = ' hidden';
            $("#Nombre_fia_per").removeAttr("required");
            $("#Apellido_fia_per").removeAttr("required");
            $("#Direccion_fia_per").removeAttr("required");
            $("#Telefono_fia_per").removeAttr("required");
            $("#Dui_fia_per").removeAttr("required");
            $("#Nit_fia_per").removeAttr("required");
            $("#Email_fia_per").removeAttr("required");
            $("#Trabajo_fia_per").removeAttr("required");
        }
    }
    function interes_hp(valor) {
        valor = valor.value; //alert("aso "+valor);
        var tipo = document.getElementById("cual").value;
        if (tipo == 1) {
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
        if (tipo == 2) {
            switch (valor) {
                case '12':
                    document.getElementById('tasa_per').value = 27;
                    break;
                case '24':
                    document.getElementById('tasa_per').value = 25;
                    break;
                case '36':
                    document.getElementById('tasa_per').value = 23;
                    break;
                case '48':
                    document.getElementById('tasa_per').value = 20;
                    break;
                case '60':
                    document.getElementById('tasa_per').value = 16;
                    break;
                case '72':
                    document.getElementById('tasa_per').value = 13;
                    break;
                case '84':
                    document.getElementById('tasa_per').value = 10;
                case '96':
                    document.getElementById('tasa_per').value = 10;
                    break;
            }
        }
        if (tipo == 3) {
            switch (valor) {
                case '12':
                    document.getElementById('tasa_per').value = 6;
                    break;
                case '24':
                    document.getElementById('tasa_per').value = 6;
                    break;
                case '36':
                    document.getElementById('tasa_per').value = 5.8;
                    break;
                case '48':
                    document.getElementById('tasa_per').value = 5.8;
                    break;
                case '60':
                    document.getElementById('tasa_per').value = 5.8;
                    break;
                case '72':
                    document.getElementById('tasa_per').value = 5.5;
                    break;
                case '84':
                    document.getElementById('tasa_per').value = 5.5;
                case '96':
                    document.getElementById('tasa_per').value = 5.5;
                    break;
            }
        }
        
        if (tipo == 3) {
            switch (valor) {
                case '12':
                    document.getElementById('tasa_per').value = 6.8;
                    break;
                case '24':
                    document.getElementById('tasa_per').value = 6.5;
                    break;
                case '36':
                    document.getElementById('tasa_per').value = 6;
                    break;
                case '48':
                    document.getElementById('tasa_per').value = 5.5;
                    break;
                case '60':
                    document.getElementById('tasa_per').value = 5.3;
                    break;
                case '72':
                    document.getElementById('tasa_per').value = 5;
                    break;
                case '84':
                    document.getElementById('tasa_per').value = 5;
                case '96':
                    document.getElementById('tasa_per').value = 4.5;
                    break;
            }
        }
    }
</script>
<?php
include_once '../plantilla/pie.php';
if (isset($_REQUEST["pas_cp"])) {
    include_once '../app/Conexion.php';
    include_once '../modelos/fiador.php';
    include_once '../modelos/referencias.php';
    include_once '../modelos/presamo.php';
    include_once '../modelos/expediente_natural.php';
    include_once '../modelos/bien_hipotecario.php';
    include_once '../repositorios/repositorio_fiador.php';
    include_once '../repositorios/repositorio_referencias.php';
    include_once '../repositorios/repositorio_prestamo.php';
    include_once '../repositorios/repositorio_expediente_natural.php';
    $op = $_REQUEST["cual"];
    Conexion::abrir_conexion();
//echo '<script language="javascript">alert("juas");</script>'; 
    if ($op == 1) {
        $fiador = new fiador();
        $fiador->setNombre($_REQUEST["Nombre_fia_per"]);
        $fiador->setApellido($_REQUEST["Apellido_fia_per"]);
        $fiador->setCorreo($_REQUEST["Email_fia_per"]);
        $fiador->setDireccion($_REQUEST["Direccion_fia_per"]);
        $fiador->setDui($_REQUEST["Dui_fia_per"]);
        $fiador->setNit($_REQUEST["Nit_fia_per"]);
        $fiador->setId_persona_natural($_REQUEST["codCliente_cpersonal"]);
        $fiador->setId_telefono($_REQUEST["Telefono_fia_per"]);
        $fiador->setLugar_trabajo($_REQUEST["Trabajo_fia_per"]);
        $prestamo = new presamo();
        // $prestamo->setId_plan("1");
        $prestamo->setId_asesor('1');
        $prestamo->setPrestamo_original($_REQUEST["monto_per"]);
        // $prestamo->setId_plan("1");
        $devolucion = date("d-m-Y");
        $devolucion = date_format(date_create($devolucion), 'Y-m-d');
        $prestamo->setFecha($devolucion);
        $prestamo->setTiempo($_REQUEST["mese_per"]);
        $prestamo->setTasa($_REQUEST["tasa_per"]);
        $prestamo->setTipo_credito("PERSONAL");
        $referencias = new referencias();
        $nombres = $_REQUEST["Nombre_fia_per"];
        $apellidos = $_REQUEST["ape_ref"];
        $tels = $_REQUEST["tel_ref"];
        $l = count($_REQUEST["nombre_ref"]);
        if (
                repositorio_fiador::insertar_fiador(Conexion::obtener_conexion(), $fiador) &&
                repositorio_prestamo::insertar_prestamo(Conexion::obtener_conexion(), $prestamo)
        ) {
            $prestamo1 = repositorio_prestamo::obtenerU_ultimo_prestamo(Conexion::obtener_conexion());
            $expediente = new expediente_natural();
            $expediente->setId_prestamo($prestamo1);
            $expediente->setPersona_natural($_REQUEST["codCliente_cpersonal"]);
            repositorio_expediente_natural::insertar_expediente(Conexion::obtener_conexion(), $expediente);
            for ($i = 0; $i < $l; $i++) {
                $referencias->setNombre($nombres[$i]);
                $referencias->setApellido($apellidos[$i]);
                $referencias->setTelefono($tels[$i]);
                $referencias->setId_persona_natural($_REQUEST["codCliente_cpersonal"]);
                if (repositorio_referencias::insertar_referencia(Conexion::obtener_conexion(), $referencias)) {
                    echo "<script type='text/javascript'>";
                    echo 'swal({
                    title: "Exito",
                    text: "Credito registrado",
                    type: "success"},
                    function(){
                    }
                    );';
                    echo "</script>";
                } else {
                    echo "<script type='text/javascript'>";
                    echo 'swal({
                    title: "Ooops",
                    text: "Credito no Registrado",
                    type: "error"},
                    function(){
                    }
                    );';
                    echo "</script>";
                }
            }
        } else {
            echo "<script type='text/javascript'>";
            echo 'swal({
                    title: "Ooops",
                    text: "Credito  no Registrado",
                    type: "error"},
                    function(){                       
                    }
                    );';
            echo "</script>";
        }
    }
    if ($op == 2) {
        $ruta = "../anexo/";
//        $biografia = $ruta . $_POST["bio"];
//        $biografia2 = $_POST['bio'];
        //echo '<script language="javascript">alert("'.$nombre_archivo.'");</script>'; 
        $bien = new bien_hipotecario();
        $bien->setDescripcion($_REQUEST["descr"]);
        $bien->setId_persona_natural($_REQUEST["codCliente_cpersonal"]);
        $bien->setOtros_datos("no");
        $bien->setUbicacion($_REQUEST["hubica"]);

//        if (move_uploaded_file($_FILES['bio1']['tmp_name'], $biografia)) {
//            $bien->setAnexo($biografia2);
//        } else {
//            $bien->setAnexo("");
//            // echo basename($FILES['bio1']['name']);
//        }

        $prestamo = new presamo();
        $prestamo->setId_plan("1");
        $prestamo->setId_asesor("1");
        $prestamo->setPrestamo_original($_REQUEST["monto_per"]);
        //$prestamo->setId_plan("1");
        $devolucion = date("d-m-Y");
        $devolucion = date_format(date_create($devolucion), 'Y-m-d');
        $prestamo->setFecha($devolucion);
        $prestamo->setTiempo($_REQUEST["mese_per"]);
        $prestamo->setTasa($_REQUEST["tasa_per"]);
        $prestamo->setTipo_credito("HIPOTECARIO");
        if (repositorio_prestamo::insertar_prestamo(Conexion::obtener_conexion(), $prestamo)
        ) {
            $prestamo1 = repositorio_prestamo::obtenerU_ultimo_prestamo(Conexion::obtener_conexion());
            $expediente = new expediente_natural();
            $expediente->setId_prestamo($prestamo1);
            $expediente->setPersona_natural($_REQUEST["codCliente_cpersonal"]);
            repositorio_expediente_natural::insertar_expediente(Conexion::obtener_conexion(), $expediente);
            repositorio_expediente_natural::insertar_bien(Conexion::obtener_conexion(), $bien);
            echo "<script type='text/javascript'>";
            echo 'swal({
                    title: "Exito",
                    text: "Credito registrado",
                    type: "success"},
                    function(){
                    }
                    );';
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo 'swal({
                    title: "Ooops",
                    text: "Credito  no Registrado",
                    type: "error"},
                    function(){ }
                    );';
            echo "</script>";
        }
    }

    if ($op == 3) {
        $fiador = new fiador();
        $fiador->setNombre($_REQUEST["Nombre_fia_per"]);
        $fiador->setApellido($_REQUEST["Apellido_fia_per"]);
        $fiador->setCorreo($_REQUEST["Email_fia_per"]);
        $fiador->setDireccion($_REQUEST["Direccion_fia_per"]);
        $fiador->setDui($_REQUEST["Dui_fia_per"]);
        $fiador->setNit($_REQUEST["Nit_fia_per"]);
        $fiador->setId_persona_natural($_REQUEST["codCliente_cpersonal"]);
        $fiador->setId_telefono($_REQUEST["Telefono_fia_per"]);
        $fiador->setLugar_trabajo($_REQUEST["Trabajo_fia_per"]);
        $prestamo = new presamo();
        // $prestamo->setId_plan("1");
        $prestamo->setId_asesor("1");
        $prestamo->setPrestamo_original($_REQUEST["monto_per"]);
        // $prestamo->setId_plan("1");
        $devolucion = date("d-m-Y");
        $devolucion = date_format(date_create($devolucion), 'Y-m-d');
        $prestamo->setFecha($devolucion);
        $prestamo->setTiempo($_REQUEST["mese_per"]);
        $prestamo->setTasa($_REQUEST["tasa_per"]);
        $prestamo->setTipo_credito("AGROPECUARIO");
        $referencias = new referencias();
        $nombres = $_REQUEST["Nombre_fia_per"];
        $apellidos = $_REQUEST["ape_ref"];
        $tels = $_REQUEST["tel_ref"];
        $l = count($_REQUEST["nombre_ref"]);
        if (
                repositorio_fiador::insertar_fiador(Conexion::obtener_conexion(), $fiador) &&
                repositorio_prestamo::insertar_prestamo(Conexion::obtener_conexion(), $prestamo)
        ) {
            $prestamo1 = repositorio_prestamo::obtenerU_ultimo_prestamo(Conexion::obtener_conexion());
            $expediente = new expediente_natural();
            $expediente->setId_prestamo($prestamo1);
            $expediente->setPersona_natural($_REQUEST["codCliente_cpersonal"]);
            repositorio_expediente_natural::insertar_expediente(Conexion::obtener_conexion(), $expediente);
            for ($i = 0; $i < $l; $i++) {
                $referencias->setNombre($nombres[$i]);
                $referencias->setApellido($apellidos[$i]);
                $referencias->setTelefono($tels[$i]);
                $referencias->setId_persona_natural($_REQUEST["codCliente_cpersonal"]);
                if (repositorio_referencias::insertar_referencia(Conexion::obtener_conexion(), $referencias)) {
                    echo "<script type='text/javascript'>";
                    echo 'swal({
                    title: "Exito",
                    text: "Credito registrado",
                    type: "success"},
                    function(){
                    }
                    );';
                    echo "</script>";
                } else {
                    echo "<script type='text/javascript'>";
                    echo 'swal({
                    title: "Ooops",
                    text: "Credito no Registrado",
                    type: "error"},
                    function(){
                    }
                    );';
                    echo "</script>";
                }
            }
        } else {
            echo "<script type='text/javascript'>";
            echo 'swal({
                    title: "Ooops",
                    text: "Credito  no Registrado",
                    type: "error"},
                    function(){                       
                    }
                    );';
            echo "</script>";
        }
    }
    if ($op == 4) {
        $fiador = new fiador();
        $fiador->setNombre($_REQUEST["Nombre_fia_per"]);
        $fiador->setApellido($_REQUEST["Apellido_fia_per"]);
        $fiador->setCorreo($_REQUEST["Email_fia_per"]);
        $fiador->setDireccion($_REQUEST["Direccion_fia_per"]);
        $fiador->setDui($_REQUEST["Dui_fia_per"]);
        $fiador->setNit($_REQUEST["Nit_fia_per"]);
        $fiador->setId_persona_natural($_REQUEST["codCliente_cpersonal"]);
        $fiador->setId_telefono($_REQUEST["Telefono_fia_per"]);
        $fiador->setLugar_trabajo($_REQUEST["Trabajo_fia_per"]);
        $prestamo = new presamo();
        // $prestamo->setId_plan("1");
        $prestamo->setId_asesor("1");
        $prestamo->setPrestamo_original($_REQUEST["monto_per"]);
        // $prestamo->setId_plan("1");
        $devolucion = date("d-m-Y");
        $devolucion = date_format(date_create($devolucion), 'Y-m-d');
        $prestamo->setFecha($devolucion);
        $prestamo->setTiempo($_REQUEST["mese_per"]);
        $prestamo->setTasa($_REQUEST["tasa_per"]);
        $prestamo->setTipo_credito("SOLIDARIO");
        $referencias = new referencias();
        $nombres = $_REQUEST["Nombre_fia_per"];
        $apellidos = $_REQUEST["ape_ref"];
        $tels = $_REQUEST["tel_ref"];
        $l = count($_REQUEST["nombre_ref"]);
        if (
                repositorio_fiador::insertar_fiador(Conexion::obtener_conexion(), $fiador) &&
                repositorio_prestamo::insertar_prestamo(Conexion::obtener_conexion(), $prestamo)
        ) {
            $prestamo1 = repositorio_prestamo::obtenerU_ultimo_prestamo(Conexion::obtener_conexion());
            $expediente = new expediente_natural();
            $expediente->setId_prestamo($prestamo1);
            $expediente->setPersona_natural($_REQUEST["codCliente_cpersonal"]);
            repositorio_expediente_natural::insertar_expediente(Conexion::obtener_conexion(), $expediente);
            for ($i = 0; $i < $l; $i++) {
                $referencias->setNombre($nombres[$i]);
                $referencias->setApellido($apellidos[$i]);
                $referencias->setTelefono($tels[$i]);
                $referencias->setId_persona_natural($_REQUEST["codCliente_cpersonal"]);
                if (repositorio_referencias::insertar_referencia(Conexion::obtener_conexion(), $referencias)) {
                    echo "<script type='text/javascript'>";
                    echo 'swal({
                    title: "Exito",
                    text: "Credito registrado",
                    type: "success"},
                    function(){
                    }
                    );';
                    echo "</script>";
                } else {
                    echo "<script type='text/javascript'>";
                    echo 'swal({
                    title: "Ooops",
                    text: "Credito no Registrado",
                    type: "error"},
                    function(){
                    }
                    );';
                    echo "</script>";
                }
            }
        } else {
            echo "<script type='text/javascript'>";
            echo 'swal({
                    title: "Ooops",
                    text: "Credito  no Registrado",
                    type: "error"},
                    function(){                       
                    }
                    );';
            echo "</script>";
        }
    }
}
?>