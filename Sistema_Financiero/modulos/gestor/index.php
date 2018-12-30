<?php 
    session_start();
    include_once "../php_conexion.php";
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
        mysql_query("DELETE FROM unidades WHERE id='$id'");
        header('Location:index.php');
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
                <!-- /.dropdown -->
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
            <?php include_once "../../menu/m_categoria.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <?php if(permiso($_SESSION['cod_user'],'4')==TRUE){ ?> 
                 <!-- /. ROW  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                           INGRESO MASIVO DE ARTICULOS
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <form action="" method="post" enctype="multipart/form-data" name="form1">
                                    <div class="col-md-6">
                                          <strong>Agregar Archivo de Excel [Pagos]</strong>
                                          <input type="file" name="archivo" id="archivo">
                                    </div>
                                    <div class="col-md-6">
                                              <strong>Desea Actualizar la BD</strong>
                                              <label><input type="radio" name="radio" value="s" checked />SI</label>
                                              <label><input type="radio" name="radio" value="n" />NO</label>
                                              <input type="submit" name="button" class="btn" id="button" value="Actualizar Base de Datos">
                                    </div>
                            </form>
                            <?php
                                            if(isset($_POST['radio'])){
                                                //subir la imagen del articulo
                                                $nameEXCEL = $_FILES['archivo']['name'];
                                                $tmpEXCEL = $_FILES['archivo']['tmp_name'];
                                                $extEXCEL = pathinfo($nameEXCEL);
                                                $urlnueva = "xls/carga.xls";            
                                                if(is_uploaded_file($tmpEXCEL)){
                                                    copy($tmpEXCEL,$urlnueva);  
                                                    echo '<div align="center"><strong>Datos Actualizados con Exito</strong></div>';
                                                }
                                                
                                            }
                            ?>      
                            <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th><center><strong>A</strong></center></th>
                                                    <th><center><strong>B</strong></center></th>
                                                    <th><center><strong>C</strong></center></th>
                                                    <th><center><strong>D</strong></center></th>
                                                    <th><center><strong>E</strong></center></th>
                                                    <th><center><strong>F</strong></center></th>
                                                    <th><center><strong>G</strong></center></th>
                                                </tr>
                                                <tr>
                                                    <th>COD</th>
                                                    <th>NOM</th>
                                                    <th>CAT</th>
                                                    <th>UND</th>
                                                    <th>MARCA</th>
                                                    <th>COSTO</th>
                                                    <th>IVA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                                if(isset($_POST['radio'])){
                                                    require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
                                                    
                                                    $objPHPExcel = PHPExcel_IOFactory::load('xls/carga.xls');
                                                    $objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true,true,true,true);
                                                    foreach ($objHoja as $iIndice=>$objCelda) {
                                            
                                                                echo '
                                                                    <tr>
                                                                        <td>'.$objCelda['A'].'</td>
                                                                        <td>'.$objCelda['B'].'</td>
                                                                        <td>'.$objCelda['C'].'</td>
                                                                        <td>'.$objCelda['D'].'</td>
                                                                        <td>'.$objCelda['E'].'</td>
                                                                        <td>'.formato($objCelda['F']).'</td>
                                                                        <td>'.$objCelda['G'].'</td>
                                                                    </tr>
                                                                ';
                                                        $cod=$objCelda['A'];
                                                        $nom=$objCelda['B'];            
                                                        $cat=$objCelda['C'];
                                                        $und=$objCelda['D'];   
                                                        $marca=$objCelda['E'];
                                                        $costo=$objCelda['F'];
                                                        $iva=$objCelda['G'];
                                                        
                                                                            
                                                        if($_POST['radio']=='s'){
                                                            $sql="INSERT INTO articulos (codigo,nombre,cat,und,valor,marca,iva) 
                                                                               VALUES ('$cod','$nom','$cat','$und','$costo','$marca','$iva')";
                                                                mysql_query($sql);
                                                        }
                                                            }
                                                    }
                                            ?>
                                            
                                            </tbody>
                                        </table>
                               
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
    
   
</body>
</html>
