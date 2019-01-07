<?php
include_once '../app/Conexion.php';
    include_once '../modelos/bien_hipotecario.php';
    include_once '../modelos/presamo.php';
    include_once '../modelos/expediente_natural.php';
    include_once '../repositorios/repositorio_prestamo.php';
    include_once '../repositorios/repositorio_expediente_natural.php';



    Conexion::abrir_conexion();
//echo '<script language="javascript">alert("juas");</script>'; 
    
    

    
    $ruta="../anexo/";
    $biografia =$ruta.$_POST["bio"];
    $biografia2=$_POST['bio'];
     //echo '<script language="javascript">alert("'.$nombre_archivo.'");</script>'; 
    
    $bien = new bien_hipotecario();    
    $bien->setDescripcion($_REQUEST["descr"]);
    $bien->setId_persona_natural($_REQUEST["codCliente_cpersonal"]);
    $bien->setOtros_datos("no");
    $bien->setUbicacion($_REQUEST["hubica"]);
    echo '<script language="javascript">alert("'.$biografia.' b '.$biografia2.'");</script>'; 
    if (move_uploaded_file($_FILES['bio1']['tmp_name'], $biografia)) {
        $bien->setAnexo($biografia2);
       
    }else{
         $bien->setAnexo("");
       // echo basename($FILES['bio1']['name']);
}
echo '<script language="javascript">alert("'.$bien->getAnexo().'");</script>'; 

    $prestamo = new presamo();
    $prestamo->setId_plan("1");
    $prestamo->setId_asesor("1");
    $prestamo->setPrestamo_original($_REQUEST["monto_per"]);
    $prestamo->setId_plan("1");
    $devolucion = date("d-m-Y");
    $devolucion = date_format(date_create($devolucion), 'Y-m-d');
    $prestamo->setFecha($devolucion);
    $prestamo->setTiempo($_REQUEST["mese_per"]);
    $prestamo->setTasa($_REQUEST["tasa_hp"]);


    if (repositorio_prestamo::insertar_prestamo(Conexion::obtener_conexion(), $prestamo)
    ) {
        $prestamo1 = repositorio_prestamo::obtenerU_ultimo_prestamo(Conexion::obtener_conexion());
        $expediente = new expediente_natural();
        $expediente->setId_prestamo($prestamo1);
        $expediente->setPersona_natural($_REQUEST["codCliente_cpersonal"]);
        repositorio_expediente_natural::insertar_expediente(Conexion::obtener_conexion(), $expediente);
        repositorio_expediente_natural::insertar_bien(Conexion::obtener_conexion(), $bien);

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

?>