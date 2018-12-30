<?php 
    session_start();
    include_once "modulos/php_conexion.php";
    include_once "modulos/class_buscar.php";
    include_once "modulos/funciones.php";
    
    if($_SESSION['cod_user']){
    }else{
        header('Location: php_cerrar.php');
    }
    
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
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?php echo $_SESSION['user_name']; ?></a>
            </div>
 
            <ul class="nav navbar-top-links navbar-right">                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="modulos/usuarios/perfil.php"><i class="fa fa-user fa-fw"></i> My Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="php_cerrar.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">Fecha de Acceso : <?php echo fecha(date('Y-m-d')); ?>
</div>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">       
           <?php include_once "menu/m_principal.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <!-- /. ROW  -->

                <div class="row">
                <?php if(permiso($_SESSION['cod_user'],'1')==TRUE){ ?>
                <?php }else{ echo mensajes("USTED HA INGRESADO COMO USUARIO INVITADO AL SISTEMA","rojo"); }?>  
                </div>                                 
                    <div class="row">
                      <DIV align="center">
                       <?php
                        if (file_exists("img/usuario/".$_SESSION['cod_user'].".gif")){
                        echo '<img src="img/usuario/'.$_SESSION['cod_user'].'.gif" class="user-image img-responsive"/>';
                        }else{
                        echo '<img src="img/usuario/default.png" class="user-image img-responsive"/>';
                        }
                    ?>
                        <div class="alert alert-info">
                            <h1 class="text-success">Bienvenido al Sistema<br> <?php echo $_SESSION['user_name']; ?></h1><br>
                        <strong class="text-info"><?php echo usuario($_SESSION['tipo_user']); ?></strong>
                        </div>
                        
                    </DIV>
                    </div>             
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
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