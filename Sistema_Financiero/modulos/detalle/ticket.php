<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    include_once "../class_buscar.php";
    if($_SESSION['cod_user']){
    }else{
        header('Location: ../../php_cerrar.php');
    }
    if(!empty($_GET['detalle'])){
        $factura=$_GET['detalle'];
    }else{
        header('Location:error.php');
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
            $nit_empresa=$row['nit'];
            $dir_empresa=$row['direccion'];
            $tel_empresa=$row['tel'].'-'.$row['fax'];
            $pais_empresa=$row['pais'].' - '.$row['ciudad'];
        }
        ######### TRAEMOS LOS DATOS DE LA TABLA RESUMEN #############
        $pax=mysql_query("SELECT * FROM resumen_ticket WHERE factura='$factura'");             
        if($row=mysql_fetch_array($pax)){
            $tipo=$row['tipo'];
            $cliente=$row['cliente'];
            $refererencia=$row['clase'];
            $fecha_guardada=$row['fecha'];
            $hora_guardada=$row['hora'];
            $usu_guardado=$row['usu'];                      
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
    <script>
        function imprimir(){
          var objeto=document.getElementById('imprimeme');  //obtenemos el objeto a imprimir
          var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
          ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
          ventana.document.close();  //cerramos el documento
          ventana.print();  //imprimimos la ventana
          ventana.close();  //cerramos la ventana
        }
    </script>
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
            <?php include_once "../../menu/m_venta.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
			     <div class="alert alert-info" align="center">
                    <h3>DETALLE DE VENTA<h3>
                    </div> 
                 <!-- /. ROW  -->
                                 
                 <center><button onclick="imprimir();" class="btn btn-default"><i class=" fa fa-print "></i> Imprimir</button></center>
                 <div id="imprimeme">
                <table>             
                 <tr>
                    <td>
                    <center>
                    <strong><?php echo $nombre_Almacen; ?></strong><br><br>
                    <img src="../../img/logo.jpg" width="130px" height="110px"><br><br>
                    <strong><?php echo $nombre_empresa; ?></strong><br>
                    </center>                                                    
                    </td>
                    <td><br>
                    <strong>DOCUMENTO: </strong><?php echo $factura; ?><br>
                    <strong>TIPO: </strong><?php echo $tipo; ?><br>
                    <strong>FECHA: </strong><?php echo fecha($fecha); ?> ||  
                    <strong>HORA: </strong><?php echo date($hora); ?><br>
                    <strong>USUARIO: </strong><?php echo $cajero_nombre; ?><br>                                                     
                    </td>
                 </tr>                          
                </table><br>
                    <!-- /. TABLA  -->
                <?php 
                $oPaciente=new Consultar_Clientes($row['cliente']);

                ?>
                <hr/>
                <strong>CLIENTE:</strong> <?php echo $oPaciente->consultar('nombre'); ?><br>
                <strong>FECHA ENTREGA:</strong> <?php echo fecha($row['fecha']); ?><br><br>
                
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->                    
                            <div class="table-responsive">
                                <div align="left"><strong>Fecha de Registro: </strong><?php echo fecha($fecha_guardada); ?> <?php echo date($hora_guardada); ?> | |  <strong>Cajero: </strong><?php echo consultar('nom','persona',' doc='.$row['usu']); ?></div>
                                <table class="table table-striped table-bordered table-hover"  width="100%" rules="all"  border="1">                                    
                                    <thead>
                                        <tr class="info">                                                                                                                                                                          
                                            <th>ARTICULO</th>                                                                                                                                                                           
                                            <th>CANTIDAD</th>                                                                                                                                  
                                            <th>VALOR</th>
                                            <th>IMPORTE</th>
                                                                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                            $neto=0;
                                            $pa=mysql_query("SELECT * FROM detalle WHERE factura='$factura'");              
                                            while($row=mysql_fetch_array($pa)){
                                                $cod_alumno=$row['codigo'];#5
                                                $importe=$row['importe'];
                                                $ref=$row['tipo'];
                                                $neto=$neto+$importe;
                                                $oArticulo=new Consultar_Articulos($row['articulo']);
                                                $p_nombre=$oArticulo->consultar('nombre');
                                                
                                                
                                          ?>
                                        <tr>
                                            <td> <?php echo $p_nombre; ?></td>
                                            <td><div align="center"><span class="badge badge-success"><?php echo $row['cantidad']; ?></span></div></td>
                                            <td><div align="right"><strong><?php echo $s.' '.formato($row['valor']); ?></strong></div></td>
                                            <td><div align="right"><strong><?php echo $s.' '.formato($row['importe']); ?></strong></div></td>                   
                                          </tr>                                                                                                                 
                                        <?php } ?>
                                        <tr>
                                             <td colspan="3"><div align="right"><strong><h4>Total</h4></strong></div></td>
                                             <td><div align="right"><strong><h4>$ <?php echo formato($neto); ?></h4></strong></div></td>
                                        </tr>
                                    </tbody>                                    
                                </table><br><br><br><br>
                                     <hr/>
                                     <center>
                                        <strong><?php echo $nombre_empresa; ?></strong><br>
                                        <strong><?php echo $tel_empresa; ?></strong><br>
                                        <strong><?php echo $pais_empresa; ?></strong><br>
                                        <strong><?php echo $dir_empresa; ?></strong><br>
                                    </center>
                            </div>                                                                     
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  --> 
            </div>
                                
        </div>
               <footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
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
