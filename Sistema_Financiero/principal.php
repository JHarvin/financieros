<?php
    session_start();
    include_once "modulos/php_conexion.php";
    include_once "modulos/class_buscar.php";
    include_once "modulos/funciones.php";

    if($_SESSION['cod_user']){
    }else{
        header('Location: php_cerrar.php');
    }
    //
    #$oUsuario=new Consultar_Usuario($_SESSION['cod_user']);
    #$Nombre=$oUsuario->consultar('nom');

    $usu=$_SESSION['cod_user'];
    $pa=mysql_query("SELECT * FROM cajero WHERE usu='$usu'");
    while($row=mysql_fetch_array($pa)){
        $id_almacen=$row['almacen'];
        $oAlamacen=new Consultar_Deposito($id_almacen);
        $nombre_Almacen=$oAlamacen->consultar('nombre');
    }
    ######### TRAEMOS LOS DATOS DE LA EMPRESA #############
        $pa=mysql_query("SELECT * FROM empresa WHERE id=1");
        if($row=mysql_fetch_array($pa)){
            $nombre_empresa=$row['empresa'];
        }

 $im=$conexion->query("SELECT MAX(id) AS id FROM eventos"); // Aqui buscamos el id con el mayor valor
    $row = $im->fetch_row();                                   // lo traemos
    $id = trim($row[0]);                                       // y guardamos en la variable $id
    $id_evento = $id+1;                                        // luego creamos la variable $id_evento que guardara la variable $id sumandole 1, esta variable se usa para guardar el link en la base de datos y tenga su id

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $nombre_empresa; ?></title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>


        <!--/. NAV TOP  -->

           <?php include_once "menu/menu.php"; ?>

        <!-- /. NAV SIDE  -->
        <div id="wrapper" style="background-color:#4161CF;">
            <div id="page-inner">
                <!-- /. ROW  -->

                <div class="row">
                <?php if(permiso($_SESSION['cod_user'],'1')==TRUE){ ?>
                <?php }else{ echo mensajes("USTED HA INGRESADO COMO USUARIO INVITADO AL SISTEMA","rojo"); }?>
                </div>
                    <div class="row">
                      <DIV align="center">
                       <?php
                        if (file_exists("img/fina.png")){
                        echo '<img src="img/fina.png" with="500%" class="user-image img-responsive"/>';
                        }else{
                        echo '<img src="img/fina.png" class="user-image img-responsive"/>';
                        }
                    ?>


                    </DIV>
                    </div>
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->

    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>
