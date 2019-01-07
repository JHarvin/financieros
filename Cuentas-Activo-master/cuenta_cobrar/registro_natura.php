<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
include_once '../plantilla/barra_lateral_usuario.php';
?>
<form action="" name="form_persona_natural" method="post" onsubmit="return confirmar_envio_perNatural()">
    <input type="hidden" name="pas" id="pass"  >
    <section class="content">
        <div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="header">
                            <h2 class="text-center">REGISTRO DE CLIENTE</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <span class="input-group-addon" id="basic-addon1">Nombre</span>
                                            <input type="text"  class="form-control text-center" name="nombre_natural" placeholder="NOMBRE..." required="">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <span class="input-group-addon" id="basic-addon1">Apellido</span>
                                            <input type="text" class="form-control text-center" name="apellido_natural" placeholder="APELLIDO..." required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <span class="input-group-addon" id="basic-addon1">Dui</span>
                                            <input type="text" class="form-control text-center" name="dui_natural"  id="Dui_fia_per" placeholder="DUI..." required="">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <span class="input-group-addon" id="basic-addon1">Nit</span>
                                            <input type="text" class="form-control text-center" name="nit_natural" id="Nit_fia_per" placeholder="NIT..." required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <span class="input-group-addon" id="basic-addon1">Telefono</span>
                                            <input type="text" class="form-control text-center" name="telefono_natural" id="ref_Telefono" placeholder="TELEFONO..." required="">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6 prefix">
                                    <div class="form-group prefix">
                                        <div class="form-line prefix">
                                            <span class="input-group-addon prefix" id="basic-addon1">Dirección</span>
                                            <input type="text" class="form-control text-center" name="direccion_natural" placeholder="DIRECCION..." required="">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="text-center">
                                <button type="submit"  class="btn btn-primary m-t-15 waves-effect">GUARDAR</button>
                                <button type="reset" class="btn btn-primary m-t-15 waves-effect">CANCELAR</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->


        </div>
        <!-- #END# Inline Layout -->

        </div>
    </section>
</form>
<script>
    function confirmar_envio_perNatural() {
        var ok = false;
        var datos = "";
        datos = datos.concat("Nombre: " + document.getElementsByName('nombre_natural')[0].value + "\n ",
                "Apellido: " + document.getElementsByName('apellido_natural')[0].value + "\n ",
                "Dui:    " + document.getElementsByName('dui_natural')[0].value + "\n ",
                "Nit:    " + document.getElementsByName('nit_natural')[0].value + " \n",
                "Telefono: " + document.getElementsByName('telefono_natural')[0].value + " \n",
                "Direccion: " + document.getElementsByName('direccion_natural')[0].value + "\n ");
        //alert(datos);
        if (true) {
            swal({
                title: "¿Desea Registrar los siguentes datos?",
                text: "" + datos,
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
                    document.form_persona_natural.submit();//lo envio aqui porque retorna la vaiable antes y despues ejecuta el swal

                    });
        }
        return ok;
    }


</script>
<?php
include_once '../plantilla/pie.php';
if (isset($_REQUEST["pas"])) {

    include_once '../app/Conexion.php';
    include_once '../modelos/persona_natural.php';
    include_once '../repositorios/repositorio_expediente_natural.php'; //el expediente natural gestiona a la persona natural



    Conexion::abrir_conexion();
//echo '<script language="javascript">alert("juas");</script>'; 
    $persona = new persona_natural();
    $persona->setNombe($_REQUEST["nombre_natural"]);
    $persona->setApellido($_REQUEST["apellido_natural"]);
    $persona->setDui($_REQUEST["dui_natural"]);
    $persona->setNit($_REQUEST["nit_natural"]);
    $persona->setDireccion($_REQUEST["direccion_natural"]);
    $persona->setTelefono($_REQUEST["telefono_natural"]);
    // $persona->setCorreo($_REQUEST["nameEmail"]);
//    $cod= '250595'.repositorio_expediente_natural::obtenerU_ultimo_persona(Conexion::obtener_conexion());
//    $persona->setId_persona_natural($cod);
    repositorio_expediente_natural::insertar_persona_natural(Conexion::obtener_conexion(), $persona);

    //
    //Conexion::cerrar_conexion();
}
?>
