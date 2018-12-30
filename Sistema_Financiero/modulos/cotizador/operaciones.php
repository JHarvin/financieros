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
    
   $bus='';#inicializar la variable
        if(!empty($_GET['estado'])){
            $nit=limpiar($_GET['estado']);
            $cans=mysql_query("SELECT * FROM resumen WHERE id='$nit'");
            if($dat=mysql_fetch_array($cans)){
                if($dat['estado']=='s'){                    
                    $xSQL="Update resumen Set estado='n' WHERE id='$nit'";
                    mysql_query($xSQL);
                    header('location:operaciones.php');
                }else{
                    $xSQL="Update resumen Set estado='s' WHERE id='$nit'";
                    mysql_query($xSQL);
                    header('location:operaciones.php');
                }
            }
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
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuración</a>
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

			  <?php 
                if(!empty($_GET['fechai']) and !empty($_GET['fechaf'])){
                    $fechai=limpiar($_GET['fechai']);
                    $fechaf=limpiar($_GET['fechaf']);
                }else{
                    $fechai=date('Y-m-d');  
                    $fechaf=date('Y-m-d');  
                }
                $usu='';    $trans='';      $where='';
                $act_trans='active';$act_usu='';
                if(!empty($_GET['trans'])){
                    $trans=limpiar($_GET['trans']);
                    $act_trans='active';
                    $act_usu='';
                    if($trans<>'TODOS'){
                        $where="WHERE tipo='".$trans."' and fecha between '$fechai' AND '$fechaf'";
                    }else{
                        $where='';  
                    }
                }elseif(!empty($_GET['usu'])){
                    $usu=limpiar($_GET['usu']);
                    $act_usu='active';
                    $act_trans='';  
                    $where="WHERE usu='".$usu."' and fecha between '$fechai' AND '$fechaf'";
                }
                            $sobrante_total=0;$entrada=0;$cxp=0;$cxc=0;
                            $sqlx=mysql_query("SELECT * FROM detalle WHERE fecha between '$fechai' AND '$fechaf'");
                            while($row=mysql_fetch_array($sqlx)){
                                if($row['tipo']=='COMPRA'){
                                    $entrada=$entrada+$row['valor'];
                                }
                                elseif($row['tipo']=='VENTA'){
                                    $sobrante_total=$sobrante_total+$row['valor'];
                                    
                                }
                                elseif($row['tipo']=='CXP'){
                                    
                                }
                            }
            ?>
              <div class="col-md-12 col-sm-6">
                    <div class="panel panel-default">                      
                        <div class="panel-body">
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#transaccion" data-toggle="tab">Consultar por Tipo de Transaccion</a>
                                </li>
                                 <li class=""><a href="#usuario" data-toggle="tab">Consultar por Usuario</a>
                                </li>  
                            </ul>

                            <div class="tab-content">
                               <div class="tab-pane fade active in" id="transaccion">
                                <form name="form1" action="" method="get" class="form-inline">
                           <div class="panel-body">
                           <div class="row"> 
                                <div class="col-md-4">
                                    <strong>Fecha Inicial</strong><br>
                                    <input class="form-control" value="<?php echo $fechai; ?>" name="fechai" type="date" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">
                                    <strong>Fecha Finalizacion</strong><br>
                                    <input class="form-control" value="<?php echo $fechaf; ?>" name="fechaf" type="date" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">
                                    <strong>Tipo de Transaccion</strong><br>
                                    <select class="form-control" name="trans">
                                        <option value="TODOS" <?php if($trans=='TODOS'){ echo 'selected'; } ?>>TODOS</option>                                       
                                        <option value="OPERACION" <?php if($trans=='VENTA'){ echo 'selected'; } ?>>VENTAS</option>                                       
                                    </select>
                                    <button type="submit" class="btn btn-primary"><i class="icon-search"></i> <strong>Consultar</strong></button>
                                </div>
                            </div>
                           </div>
                        </form>
                                                                 
                                </div>
                                <div class="tab-pane fade fade" id="usuario">
                                <form name="form2" action="" method="get" class="form-inline">
                            <div class="panel-body">
                            <div class="row"> 
                                <div class="col-md-4">  
                                    <strong>Fecha Inicial</strong><br>
                                    <input class="form-control" value="<?php echo $fechai; ?>" name="fechai" type="date" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">  
                                    <strong>Fecha Finalizacion</strong><br>
                                    <input class="form-control" value="<?php echo $fechaf; ?>" name="fechaf" type="date" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">  
                                    <strong>Usuario</strong><br>
                                    <select class="form-control" name="usu">
                                        <?php 
                                            $sql=mysql_query("SELECT * FROM persona ORDER BY nom");
                                            while($row=mysql_fetch_array($sql)){
                                                if($row['doc']==$usu){
                                                    echo '<option value="'.$row['doc'].'" selected>'.$row['nom'].'</option>';
                                                }else{
                                                    echo '<option value="'.$row['doc'].'">'.$row['nom'].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    <button type="submit"  class="btn btn-primary"><i class="icon-search"></i> <strong>Consultar</strong></button>
                                </div>
                            </div>
                            </div>
                        </form>
                                                                                             
                                </div>         
                                                        
                            </div>
                        </div>
                    </div>
                </div><br>   
            <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="#min" data-toggle="tab"><i class="glyphicon glyphicon-list" ></i> FACTURAS</a></li>
            <li class="" ><a href="#inventario" data-toggle="tab"><i class="glyphicon glyphicon-shopping-cart" ></i> TICKET</a></li>                                
           </ul><br>
           <div class="tab-content">
             <div class="tab-pane fade active in" id="min">
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             DETALLES DE FACTURAS
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>FACTURA</th>
                                            <th>CLIENTE</th>                                                                                                                                                                                                            
                                            <th>FECHA REGISTRO</th>
                                            <th>VALOR</th>
                                            <th>STATUS</th>
                                            <th></th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                            $sql=mysql_query("SELECT * FROM resumen ".$where);
                                            while($row=mysql_fetch_array($sql)){
                                            
                                                if($row['tipo']=='COMPRA'){
                                                    $tipo='<span class="label label-success">COMPRA</span>';
                                                }
                                                elseif($row['tipo']=='VENTA'){
                                                    $tipo='<span class="label label-info">VENTA</span>';
                                                }
                                                $url=$row['factura'];
                                                ############# CONSULTAS ######################
                                                $oCliente=new Consultar_Clientes($row['cliente']);
                                                if ($row['cliente']==0) {
                                                    $consulta='CONSUMIDOR FINAL';
                                                }
                                                else{
                                                   
                                                   $consulta=$oCliente->consultar('nombre');
                                                }
                                                
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['factura']; ?></td>
                                            <td><?php echo $consulta; ?></td>
                                            <!--<td><?php echo $tipo; ?></td>-->
                                            <td><?php echo fecha($row['fecha']).' '.$row['hora']; ?></td>
                                            <td><?php echo $s.' '.formato($row['valor']); ?></td>
                                            <!--<td><?php echo $status; ?></td>-->
                                            <td><center>
                                                <a href="operaciones.php?estado=<?php echo $row['id']; ?>" title="Cambiar Satatus"><?php echo status($row['estado']); ?></a>
                                                </center>
                                            </td>
                                                                                                                               
                                            <td class="center">
                                            <a href="../detalle/venta.php?detalle=<?php echo $url; ?>"  class="btn btn-info" title="Detalle">
                                            <i class="fa fa-list-alt" ></i>
                                            </a>                                    
                                            </td>
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
            <div class="tab-pane fade" id="inventario">
             <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                             DETALLES DE TICKET
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>FACTURA</th>
                                            <th>CLIENTE</th>                                                                                                                                                                                                            
                                            <th>FECHA REGISTRO</th>
                                            <th>VALOR</th>
                                            <th>STATUS</th>
                                            <th></th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                            $sql=mysql_query("SELECT * FROM resumen_ticket ".$where);
                                            while($row=mysql_fetch_array($sql)){
                                            
                                                if($row['tipo']=='COMPRA'){
                                                    $tipo='<span class="label label-success">COMPRA</span>';
                                                }
                                                elseif($row['tipo']=='VENTA'){
                                                    $tipo='<span class="label label-info">VENTA</span>';
                                                }
                                                $url=$row['factura'];
                                                ############# CONSULTAS ######################
                                                $oCliente=new Consultar_Clientes($row['cliente']);
                                                
                                                
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo formato_factura($row['factura']); ?></td>
                                            <td><?php echo $oCliente->consultar('nombre'); ?></td>
                                            <!--<td><?php echo $tipo; ?></td>-->
                                            <td><?php echo fecha($row['fecha']).' '.$row['hora']; ?></td>
                                            <td><?php echo $s.' '.formato($row['valor']); ?></td>
                                            <!--<td><?php echo $status; ?></td>-->
                                            <td><center>
                                                <a href="operaciones.php?estado=<?php echo $row['id']; ?>" title="Cambiar Satatus"><?php echo status($row['estado']); ?></a>
                                                </center>
                                            </td>
                                                                                                                               
                                            <td class="center">
                                            <a href="../detalle/ticket.php?detalle=<?php echo $url; ?>"  class="btn btn-info" title="Detalle">
                                            <i class="fa fa-list-alt" ></i>
                                            </a>                                    
                                            </td>
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
