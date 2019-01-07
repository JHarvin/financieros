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

<form action="" method="post" name="credito_hipotecario" id="credito_personal" onsubmit="return validarTablas_hp()" enctype="multipart/form-data">
    <input type="hidden" id="pas_hp" name="pas_cp"/>
    <input type="radio" id="uno" checked="" style="visibility: hidden"/>
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
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <div class="input-field"><i class="fa fa-search prefix" aria-hidden="true">

                                                </i><label for="" style="font-size:16px">Buscar Cliente</label>
                                                <input type="text" id="buscar_cliente_hp"  name="" autofocus onkeypress="return llenar_tabla_cliente_hp(this)" list="lista_personas_naturales_hp">
                                            </div>              
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-bordered" id="tabla_cliente_hp">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    FIN DE DATOS-->       

        <!--INICIO BIEN-->
        <div class="container-fluid" id="containeBien">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header"><a data-toggle="collapse" data-parent="#accordion" href="#collapse-BIEN">
                                <h2 class="text-center">DATOS DEL BIEN </h2>
                            </a> </div>
                        <div id="collapse-BIEN" class="panel-collapse collapse">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">UBICACION</span>
                                                <input type="text"class="form-control text-center" required="" id="hubica" name="hubica" placeholder="UBICACION...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <span class="input-group-addon" id="basic-addon1">DESCRIPCION</span>
                                                    <input type="text" class="form-control text-center" required="" id="rdescr" name="descr" placeholder="DESCRIPCION...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    
                                                <div class="file-field">


                                                    <div class="btn ">
                                                        <span><i class="fa fa-address-book" aria-hidden="true"></i>ANEXO</span>
                                                        <input type="file" accept=".pdf" required name="anexo1" onchange="asignar(this.value)">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input type="text" id="anexo" name="anexo" class="file-path validate" >
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

        <!--INICIO DATO DE CREDITO-->
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header"><a data-toggle="collapse" data-parent="#accordion" href="#collapse-credito">
                                <h2 class="text-center">DATOS DEL CREDITO</h2>
                            </a></div>
                        <div id="collapse-credito" class="panel-collapse collapse in">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <span class="input-group-addon" id="basic-addon1">MONTO SOLICITADO($)</span>
                                                <input type="number" required="" min="1500" max="40000" class="form-control text-center" id="monto_per" name="monto_per" placeholder="MONTO SOLICITADO($)... MINIMO $1,500, MAXIMO $40,000">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control show-tick" required="" id="mese_p" name="mese_p" onchange="interes_hp2(this)">
                                                    <option value="">SELECCIONE EL NUMERO DE MESES</option>
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
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" required="" min="1" max="20" class="form-control text-center" readonly=""  id="tasa_hp" name="tasa_hp" placeholder="TASA">
                                            </div>

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
    <input type="hidden"  name="nombre" id="nombre"  />
    <input type="file" style="visibility: hidden"  name="archivo" id="archivo"/>
        
</form>


<datalist id="lista_personas_naturales_hp">
    <?php
    include_once '../app/Conexion.php';
    include_once '../modelos/Libros.php';
    include_once '../repositorios/repositorio_expediente_natural.php';
    Conexion::abrir_conexion();
    $listado = repositorio_expediente_natural::lista_persona_natural(Conexion::obtener_conexion());


    foreach ($listado as $fila) {
        echo '<option value="' . $fila[2] . '" label="' . $fila[0] . '" > ';
    }
    ?>
</datalist>

<script>
    function llenar_tabla_cliente_hp(valor) {
        var depto1 = valor.value;
        var depto1 = $("#lista_personas_naturales_hp option[value='" + $('#buscar_cliente_hp').val() + "']").attr('label');//alert(depto);
        $("#lista_personas_naturales_hp").load(" #lista_personas_naturales_hp");//para actuaizar la datalist cuando registra 
//var numero=valor.id.substr(7)
//alert(valor.id);
        if (depto1 != "") {
            $.post("../cuenta_cobrar/llenar_tabla_cliente.php", {libro: depto1, idtabla: "tabla_cliente_hp"}, function (mensaje) {
                $('#lista_personas_naturales_hp').html(mensaje).fadeIn();

            });
        }
        return false;//para qeu no se envie el form
    }



    function cuota_per() {
        var tasa_persona = document.getElementById("tasa_hp").value / 100 / 12;
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
        document.getElementById('pils-tasa-txt').innerHTML = document.getElementById("tasa_hp").value + "%";
        // $( '#pils-cuota-txt' ).text( '$' + numberWithCommas( cuota ) );
        addfilas("plan_pago_personal",document.getElementById("tasa_hp").value);
    }

    function validarTablas_hp() {
        var okk = true;
        if ($('#tabla_cliente_hp >tbody >tr').length == 0) {
            okk = false;

            swal("Ooops", "Tabla de cliente vacia", "warning");
        }

        return okk;
    }
    function interes_hp2(valor) {
        valor=valor.value; //alert("aso "+valor);
        switch (valor) {
            case '12':
                 document.getElementById('tasa_hp').value = 17;
                break;
            case '24':
                document.getElementById('tasa_hp').value = 15;
                break;
            case '36':
                document.getElementById('tasa_hp').value = 14;
                break;
            case '48':
                document.getElementById('tasa_hp').value = 13;
                break;
            case '60':
                document.getElementById('tasa_hp').value = 11;
                break;
            case '72':
                document.getElementById('tasa_hp').value = 9;
                break;
            case '84':
                document.getElementById('tasa_hp').value = 8;
            case '96':
                document.getElementById('tasa_hp').value = 5;
                break;
        }
    }
function asignar(valor){
        var n = valor.toString();
        n=n.split("h");
        n=n[1].substring(1, n[1].length);
        alert(n);
     document.getElementById('archivo').value = valor;
     document.getElementById('nombre').value = n;
     
}

</script>
<?php
include_once '../plantilla/pie.php';
if (isset($_REQUEST["pas_cp"])) {

    include_once '../app/Conexion.php';
    include_once '../modelos/bien_hipotecario.php';
    include_once '../modelos/presamo.php';
    include_once '../modelos/expediente_natural.php';
    include_once '../repositorios/repositorio_prestamo.php';
    include_once '../repositorios/repositorio_expediente_natural.php';



    Conexion::abrir_conexion();
//echo '<script language="javascript">alert("juas");</script>'; 
    $ruta="../anexo/";
    $biografia =$ruta.$_REQUEST["nombre"];
    $biografia2=$_POST['nombre'];
    
    
    $bien = new bien_hipotecario();    
    $bien->setDescripcion($_REQUEST["descr"]);
    $bien->setId_persona_natural($_REQUEST["codCliente_cpersonal"]);
    $bien->setOtros_datos("no");
    $bien->setUbicacion($_REQUEST["hubica"]);
    
    echo '<script language="javascript">alert("'.$_FILES['anexo1']['tmp_name'].'");</script>'; 
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $biografia)) {
        $bien->setAnexo($biografia2);
       
    }else{
         $bien->setAnexo("");
       // echo basename($FILES['bio1']['name']);
}

    $prestamo = new presamo();
    $prestamo->setId_plan("1");
    $prestamo->setId_asesor("1");
    $prestamo->setPrestamo_original($_REQUEST["monto_per"]);
    $prestamo->setId_plan("1");
    $devolucion = date("d-m-Y");
    $devolucion = date_format(date_create($devolucion), 'Y-m-d');
    $prestamo->setFecha($devolucion);
    $prestamo->setTiempo($_REQUEST["mese_per"]);




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
//echo "alert('datos no atualizados')";
//echo "location.href='inicio_b.php'";
                echo "</script>";
            }
        }

        //
        //Conexion::cerrar_conexion();
    } else {
        echo "<script type='text/javascript'>";
        echo 'swal({
                    title: "Ooops",
                    text: "Credito  no Registrado",
                    type: "error"},
                    function(){
                       
                       
                     
                        
                    }

                    );';
//echo "alert('datos no atualizados')";
//echo "location.href='inicio_b.php'";
        echo "</script>";
    }
}
?>
