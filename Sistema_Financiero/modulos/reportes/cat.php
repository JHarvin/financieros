<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../clientes/class/class.php";
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
            $nit_empresa=$row['nit'];
            $dir_empresa=$row['direccion'];
            $tel_empresa=$row['tel'].'-'.$row['fax'];
            $pais_empresa=$row['pais'].' - '.$row['ciudad'];
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
             <?php include_once "../../menu/m_reporte.php"; ?>                        
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <?php if(permiso($_SESSION['cod_user'],'12')==TRUE){ ?>
             <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-black">
            <div class="panel-footer back-footer-blue">
             EXISTENCIAS Y COSTOS DE PRODUCTOS POR CATEGORIA
            </div>
            <div class="panel-body">
           <br>
                
           <center><button onclick="imprimir();" class="btn btn-success"><i class=" fa fa-print "></i> Imprimir</button>
           
                                <br>               
                                    <div style="width:100%; height:700px; overflow: auto;">
                                     <div id="imprimeme">
                                     <br>
                                     <div class="hidden">
                                     <table  width="100%" style="border: 1px solid #660000; -moz-border-radius: 13px;-webkit-border-radius: 12px;padding: 10px;">
                                     <tr>
                                        <td>
                                            <center>
                                            <img src="../../img/logo.jpg" width="75px" height="75px"><br>
                                            <!--<strong><?php echo $nombre_empresa; ?></strong><br>-->
                                            </center>                                                    
                                        </td>
                                        <td align="center">                     
                                            <div style="font-size: 25px;"><strong><em><?php echo $nombre_empresa; ?></em></strong></div>
                                                   Usuario: <?php echo $cajero_nombre; ?>
                                                        Fecha y Hora: <?php echo fecha($fecha); ?> <?php echo date($hora); ?><br>
                                            <!--<strong><?php echo $nombre_empresa; ?></strong><br>-->                                                 
                                        </td>
                                        <td>
                                            <center>
                                                 <?php
                                                    if (file_exists("../../usuarios/".$_SESSION['cod_user'].".jpg")){
                                                      echo '<img src="../../usuarios/'.$_SESSION['cod_user'].'.jpg" width="50" height="50" class="img-polaroid img-polaroid">';
                                                    }else{
                                                      echo '<img src="../../img/usuario/default.png" width="80" height="80">';
                                                    }
                                                  ?>
                                            </center> 
                                        </td>
                                     </tr>                          
                                    </table><br>
                                      <hr/>
                                          <div style="font-size: 14px;"align="center">
                                             <strong>EXISTENCIAS Y COSTOS DE PRODUCTOS POR CATEGORIA</strong><br>                              
                                        </div> 
                                        <hr/>
                                    </div>
                                        <div class="table-responsive">               
                                         <?php                     
                                                $pa=mysql_query("SELECT * FROM categorias");       
                                                  while($row=mysql_fetch_array($pa)){                                         
                                                    $id_cat=$row['id'];
                                                    $nombre=$row['nombre'];

                                              ?>                  
                                        <table class="table table-bordered" width="100%"  style="border: 1px solid #660000; -moz-border-radius: 10px;-webkit-border-radius: 12px;padding: 10px;">
                                            <tr><td>
                                                    <table class="table table-striped table-bordered table-hover"  width="100%" style="font-size: 12px;"  border="0">                                    
                                                    <thead>
                                                        <tr>
                                                            <td colspan="5"><strong>CLASIFICACIÓN: [<?php echo $row['id']; ?>] <?php echo $row['nombre']; ?> </strong></td>
                                                        </tr> 
                                                        <tr>
                                                            <th>CODIGO</th>                                                                                                                                                                           
                                                            <th>NOMBRE DE PRODUCTO</th>                                                                                                                                                                                                                                                                                                                                                       
                                                            <th>EXISTENCIAS</th>                                                                                                                                                                                                                                                                                                                                                       
                                                            <th>COSTO</th>
                                                            <th>IMPORTE</th>
                                                                                                    
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                         <?php
                                                            $neto=0;
                                                            $total=0;
                                                            $pax=mysql_query("SELECT * FROM inventario WHERE cat='$id_cat'");              
                                                            while($row=mysql_fetch_array($pax)){
                                                              $oProducto=new Consultar_Articulos($row['articulo']);
                                                                $cod_alumno=$row['codigo'];#5
                                                                $cant=$row['stock'];
                                                                $importe=$row['pv'];
                                                                $ref=$row['stock'];
                                                                $total=$cant*$importe;
                                                                $neto=$neto+$total;                                                                                               
                                                          ?>
                                                        <tr>                                                   
                                                            <td><span class="label label-info"><?php echo $row['codigo']; ?></span></td>                                                    
                                                            <td> <?php echo $oProducto->consultar('nombre'); ?></td>                                                                                                                                                                                                                                                                                   
                                                            <td> <?php echo $row['stock']; ?></td>                                                                                                                                                                                                                                                                                   
                                                            <td><div align="right"><strong><?php echo $s.' '.formato($row['pv']); ?></strong></div></td>
                                                            <td><div align="right"><strong><?php echo $s.' '.formato($total); ?></strong></div></td>                   
                                                          </tr>                                                                                                                 
                                                        <?php } ?>
                                                        <tr>
                                                             <td colspan="4"><div align="right"><strong><h4>Total Clasificación</h4></strong></div></td>
                                                             <td><div align="right"><strong><h4>$ <?php echo formato($neto); ?></h4></strong></div></td>
                                                        </tr>
                                                    </tbody>                                 
                                                </table>
                                            </td></tr>
                                        </table><br>
                                        <?php } ?>
                            </div>
                             </div>    
                            </div>    
            
             <!-- /. PAGE INNER  -->
               <?php }else{ echo mensajes("NO TIENES PERMISO PARA ENTRAR A ESTE MODULO","rojo"); }?>                         
       
               
    </div>
     </div>                           
                                            </div>
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
