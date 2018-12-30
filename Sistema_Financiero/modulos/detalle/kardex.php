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
        $articulo=$_GET['detalle'];
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
        }
    
    if(!empty($_GET['del'])){
        $id=$_GET['del'];
        mysql_query("DELETE FROM inventario WHERE id='$id'");
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
            <?php if(permiso($_SESSION['cod_user'],'6')==TRUE){ ?>            			 
                          
 <div class="panel-body">
    <div class="row">
                    <div class="col-md-12">                        
                          <div class="panel-body" align="center">                                                                                 
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-2x" title="Agregar Articulo"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-circle"><i class="fa fa-print fa-2x" title="Imprimir"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-circle" onClick="window.location='PDFinventario.php'"><i class="fa fa-list-alt fa-2x" title="Reporte PDF"></i>
                            </button>                                                                                   
                           </div>
                    </div>
        </div> 
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             KARDEX <?php echo $articulo; ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                                    
                                <table class="table table-striped table-bordered table-hover"  width="100%" style="font-size: 12px;"  border="0">
                                    <thead>
                                    <tr>
                                            <th colspan="3">METODO: </th>
                                            <th colspan="3" class="success">ENTRADAS</th>
                                            <th colspan="3" class="danger">SALIDAS</th>                                           
                                            <th colspan="3" class="warning">EXISTENCIAS</th>                                           
                                        </tr>
                                        <tr>
                                            <th>No.</th>
                                            <th>FECHA</th>
                                            <th>CONCEPTO</th>                                           
                                            <th>CANT</th>
                                            <th>C.UNIT</th>                                          
                                            <th>COSTO TOTAL</th>
                                            <th>CANT</th>
                                            <th>C.UNIT</th>                                          
                                            <th>COSTO TOTAL</th>
                                            <th>CANT</th>
                                            <th>C.UNIT</th>                                          
                                            <th>COSTO TOTAL</th>                                            
                                                                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $neto=0;
                                            $num=1;
                                            $saldo=0;
                                            $pa=mysql_query("SELECT * FROM kardex INNER JOIN articulos ON kardex.id_articulo=articulos.id INNER JOIN inventario ON kardex.id_articulo=inventario.articulo  WHERE  kardex.id_articulo='$articulo'");              
                                            while($row=mysql_fetch_array($pa)){
                                                $importe=$row['importe'];
                                                $ref=$row['tipo'];
                                                $neto=$neto+$importe;
                                                
                                                #### VENTA ####
                                                $invv=$row['valor']*$row['stockk'];
                                                $cpv=$invv/$row['stockk'];

                                                $oArticulo=new Consultar_Articulos($row['articulo']);
                                                $p_nombre=$oArticulo->consultar('nombre');

                                                if ($row['tipo']=='VENTA') {
                                                    ##### VENTA ####
                                                   $totals=$cp*$row['cant'];
                                                   $saldo=$saldo-$totals;
                                                   $cp=$saldo/$row['stockk'];
                                                   $imprime= '
                                                    <td>'.$num++.'</td>
                                                    <td>'. $row['fecha'].'</td>
                                                    <td>'. $row['tipo'].'</td>                                          
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="danger">'.$row['cant'].'</td>
                                                    <td class="danger">'. $s.' '.formato($row['valor']).'</td>
                                                    <td class="danger">'.$s.' '.formato($totals).'</td>

                                                    <td class="warning">'.$row['stockk'].'</td>
                                                    <td class="warning">'.formato($cp).'</td>
                                                    <td class="warning">'.$s.' '.formato($saldo).'</td>
                                                   ';
                                                }
                                                else{
                                                    ###### COMPRA ####
                                                     $totals=$row['costok']*$row['cant'];
                                                     $saldo=$saldo+$row['importe'];
                                                     $cp=$saldo/$row['stockk'];
                                                     $imprime= '
                                                    <td>'.$num++.'</td>
                                                    <td>'. $row['fecha'].'</td>
                                                    <td>'. $row['tipo'].'</td> 
                                                    <td class="success">'.$row['cant'].'</td>
                                                    <td class="success">'. $s.' '.formato($row['costok']).'</td>
                                                    <td class="success">'.$s.' '.formato($totals).'</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="warning">'.$row['stockk'].'</td>
                                                    <td class="warning">'.formato($cp).'</td>
                                                    <td class="warning">'.$s.' '.formato($saldo).'</td>
                                                   ';
                                                }
                                                
                                                
                                          ?>
                                        <tr>
                                            <?php echo $imprime; ?>
                                        </tr>
                                         <?php } ?>
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
        </div>
    </div>
<?php }else{ echo mensajes("NO TIENES PERMISO PARA ENTRAR A ESTE MODULO","rojo"); }?>
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
