<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "class/class.php";
    include_once "../funciones.php";
    include_once "../class_buscar.php";
    if($_SESSION['cod_user']){
    }else{
        header('Location: ../../php_cerrar.php');
    }
    
    $usu=$_SESSION['cod_user'];
    $pa=mysql_query("SELECT * FROM cajero WHERE usu='$usu'");               
    while($row=mysql_fetch_array($pa)){
        $id_almacen=$row['almacen'];
        $oAlamacen=new Consultar_Deposito($id_almacen);
        $nombre_Almacen=$oAlamacen->consultar('nombre');
    }
    
    $oPersona=new Consultar_Cajero($usu);
    $cajero_nombre=$oPersona->consultar('nom');
    $fecha=date('Y-m-d');
    $hora=date('H:i:s');
    
    ######### TRAEMOS LOS DATOS DE LA EMPRESA #############
        $pa=mysql_query("SELECT * FROM empresa WHERE id=1");                
        if($row=mysql_fetch_array($pa)){
            $nombre_empresa=$row['empresa'];
        }
    
    if(!empty($_GET['del'])){
        $id=$_GET['del'];
        mysql_query("DELETE FROM categorias WHERE id='$id'");
        header('index.php');
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $nombre_empresa; ?></title>
	<!-- Bootstrap Styles-->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="../../assets/css/font-awesome.css" rel="stylesheet" />
     <!-- Morris Chart Styles-->
   
        <!-- Custom Styles-->
    <link href="../../assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="../../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> My Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../php_cerrar.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">Almacen: <?php echo $nombre_Almacen; ?> :: Fecha de Acceso : <?php echo fecha(date('Y-m-d')); ?>
</div>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <?php include_once "../../menu/m_admin.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <?php if(permiso($_SESSION['cod_user'],'14')==TRUE){ ?>
			 <div class="row">
                    <div class="col-md-12">                        
                          <div class="panel-body" align="center">                                                                                 
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-refresh fa-2x"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-circle"><i class="fa fa-question fa-2x"></i>
                            </button>                                                                                 
                  </div>
                    </div>
                </div> 
                 <!-- /. ROW  -->
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             DATOS DE LA EMPRESA
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
                        <?php   
            
                                if(!empty($_POST['empresa']) and !empty($_POST['nit'])){
                                    $empresa=limpiar($_POST['empresa']);        
                                    $nit=limpiar($_POST['nit']);
                                    $pais=limpiar($_POST['pais']);              
                                    $tel=limpiar($_POST['tel']);
                                    $ciudad=limpiar($_POST['ciudad']);          
                                    $fax=limpiar($_POST['fax']);
                                    $direccion=limpiar($_POST['direccion']);    
                                    $web=limpiar($_POST['web']);
                                    $correo=limpiar($_POST['correo']);          
                                    $fecha=date('Y-m-d');
                                    $moneda=limpiar($_POST['moneda']);
                                    mysql_query("UPDATE empresa SET empresa='$empresa',
                                                                    pais='$pais',
                                                                    ciudad='$ciudad',
                                                                    direccion='$direccion',
                                                                    correo='$correo',
                                                                    moneda='$moneda',
                                                                    nit='$nit',
                                                                    tel='$tel',
                                                                    fax='$fax',
                                                                    web='$web',
                                                                    fecha='$fecha'                                                  
                                                                WHERE id=1");
                                    
                                    //subir la imagen del articulo
                                    $nameimagen = $_FILES['imagen']['name'];
                                    $tmpimagen = $_FILES['imagen']['tmp_name'];
                                    $extimagen = pathinfo($nameimagen);
                                    $ext = array("png","jpg");
                                    $urlnueva = "../../img/logo.jpg";           
                                    if(is_uploaded_file($tmpimagen)){
                                        if(array_search($extimagen['extension'],$ext)){
                                            copy($tmpimagen,$urlnueva); 
                                        }else{
                                            echo mensajes("ERROR AL SUBIR EL LOGO, jpg o png","rojo");      
                                        }
                                    }else{
                                        echo mensajes("ERROR AL SUBIR EL LOGO, jpg o png","rojo");  
                                    }
                                    
                                    echo mensajes('Dato de la Empresa Actualizado con Exito, Ctrl+F5 para Actualizar la imagen','verde');   
                                }
                                
                                
                                $pa=mysql_query("SELECT * FROM empresa WHERE id=1");                                    
                                $row=mysql_fetch_array($pa);
                            ?>
                    <form name="form2" method="post" enctype="multipart/form-data" action="">
                    <div class="row">                                       
                    <div class="col-md-6">                                          
                            <i class="fa fa-chevron-right"></i> <strong>Nombre: </strong><?php echo $row['empresa']; ?><br><br>
                            <i class="fa fa-chevron-right"></i> <strong>Pais: </strong><?php echo $row['pais']; ?><br><br>
                            <i class="fa fa-chevron-right"></i> <strong>Ciudad: </strong><?php echo $row['ciudad']; ?><br><br>
                            <i class="fa fa-chevron-right"></i> <strong>Direccion: </strong><?php echo $row['direccion']; ?><br><br>
                            <i class="fa fa-chevron-right"></i> <strong>Correo: </strong><?php echo $row['correo']; ?><br><br>
                            <i class="fa fa-chevron-right"></i> <strong>Moneda: </strong><?php echo $row['moneda']; ?>                                                                                                      
                    </div>
                    <div class="col-md-6">
                        <i class="fa fa-chevron-right"></i> <strong>Documento: </strong><?php echo $row['nit']; ?><br><br>
                            <i class="fa fa-chevron-right"></i> <strong>Telefono: </strong><?php echo $row['tel']; ?><br><br>
                            <i class="fa fa-chevron-right"></i> <strong>FAX: </strong><?php echo $row['fax']; ?><br><br>
                            <i class="fa fa-chevron-right"></i> <strong>Pagina Web: </strong><?php echo $row['web']; ?><br><br>
                            <i class="fa fa-chevron-right"></i> <strong>Ultima Actualizacion: </strong><?php echo fecha($row['fecha']); ?><br><br>
                                                                    
                    </div>                                                                        
                    </div>
                    </form>
                    <!--  Modals-->
                                         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <form name="form2" method="post" enctype="multipart/form-data" action="">                                           
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                            
                                                                <h3 align="center" class="modal-title" id="myModalLabel">Actualizar Informacion Empresa</h3>
                                                            </div>
                                                            <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Empresa</span>
                                                                          <input class="form-control" title="Se necesita un nombre"  name="empresa"  value="<?php echo $row['empresa']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>                                          
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Dirección</span>
                                                                          <input class="form-control" title="Se necesita un nombre"  name="direccion"  value="<?php echo $row['direccion']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>                                          
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Pais</span>
                                                                          <input class="form-control" title="Se necesita un Pais"  name="pais"  value="<?php echo $row['pais']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Ciudad</span>
                                                                          <input class="form-control" title="Se necesita una Ciudad"  name="ciudad"  value="<?php echo $row['ciudad']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Email</span>
                                                                          <input class="form-control" title="Se necesita un Email"  name="correo"  value="<?php echo $row['correo']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">WEB</span>
                                                                          <input class="form-control" title="Se necesita una Web"  name="web"  value="<?php echo $row['web']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>
                                                                    <strong>Subir Logo</strong><br>
                                                                    <input type="file" name="imagen" id="imagen">                                                           
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Doc.</span>
                                                                          <input class="form-control"  name="nit" value="<?php echo $row['nit']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Tel</span>
                                                                          <input class="form-control" title="Se necesita un Telefono"  name="tel" value="<?php echo $row['tel']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Fax</span>
                                                                          <input class="form-control" title="Se necesita un nombre"  name="fax" value="<?php echo $row['fax']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>                                                                     
                                                                     <div class="input-group">
                                                                          <span class="input-group-addon">Moneda</span>
                                                                          <input class="form-control" title="Se necesita una Moneda"  name="moneda"  value="<?php echo $row['moneda']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>                                                                    
                                                                </div>                                                                        
                                                            </div> 
                                                            </div> 
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                                    
                                                            </div>                                       
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                         <!-- End Modals-->
                            </div>  
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
                                
        </div>
              <?php }else{ echo mensajes("NO TIENES PERMISO PARA ENTRAR A ESTE MODULO","rojo"); }?>   
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="../../assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="../../assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="../../assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="../../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../../assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- Custom Js -->
    <script src="../../assets/js/custom-scripts.js"></script>
     <!-- VALIDACIONES -->
    <script src="../../assets/js/jasny-bootstrap.min.js"></script>
   
</body>
</html>
