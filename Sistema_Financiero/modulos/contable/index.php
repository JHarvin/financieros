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
                if($dat['status']=='PROCESADO'){                    
                    $xSQL="Update resumen Set status='PENDIENTE' WHERE id='$nit'";
                    mysql_query($xSQL);
                    header('location:index.php');
                }else{
                    $xSQL="Update resumen Set status='PROCESADO' WHERE id='$nit'";
                    mysql_query($xSQL);
                    header('location:index.php');
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
font-size: 16px;">Fecha de Acceso : <?php echo fecha(date('Y-m-d')); ?>
</div>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <?php include_once "../../menu/m_pagos.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <?php if(permiso($_SESSION['cod_user'],'11')==TRUE){ ?>
             <?php 
                if(!empty($_POST['trans']) and !empty($_POST['concepto1'])){
                    $tipo=limpiar($_POST['trans']);                 
                    $valor=limpiar($_POST['valor']);
                    $concepto1=limpiar($_POST['concepto1']);        
                    $fecha=date('Y-m-d');
                    $concepto2=limpiar($_POST['concepto2']);        
                    $hora=date('H:i:s');
                    
                    $sql=mysql_query("SELECT * FROM contable WHERE concepto1='$concepto1' and concepto2='$concepto2' and fecha='$fecha' and valor='$valor' and tipo='$tipo'");
                    if($row=mysql_fetch_array($sql)){
                        echo mensajes('No se permiten datos duplicados en la base de datos','rojo');
                    }else{
                        mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio) 
                        VALUES ('$concepto1','$concepto2','$tipo','$valor','$fecha','$hora','$usu','$id_almacen')");
                        echo mensajes('El Registro Contable ha sido Registrado con Exito','verde');
                    }
                }
            ?>
           
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
                            $venta_total=0;$entrada=0;$cxp=0;$cxc=0;
                            $sqlx=mysql_query("SELECT * FROM contable WHERE consultorio='$id_almacen' AND fecha between '$fechai' AND '$fechaf'");
                            while($row=mysql_fetch_array($sqlx)){
                                if($row['tipo']=='COMPRA'){
                                    $entrada=$entrada+$row['valor'];
                                }
                                elseif($row['tipo']=='ENTRADA'){
                                    $venta_total=$venta_total+$row['valor'];
                                    
                                }
                                elseif($row['tipo']=='CXP'){
                                    
                                }
                            }
            ?>
               <center>
                <button type="button" class="btn btn-info btn-circle" data-toggle="modal" data-target="#venta" title="Ver Caja"><i class="fa fa-search fa-2x"></i>
                </button>
                 <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#add" title="Agregar Gasto"><i class="fa fa-plus fa-2x"></i>
                </button>
                </center><br>
                
                <!-- Modal -->                      
             <div class="modal fade" id="venta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="contado" action="pro_contado.php" method="get">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="panel-body">
                                        <div class="row" align="center">                                       
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="panel panel-primary text-center no-boder bg-color-red">
                                                <div class="panel-footer back-footer-red">
                                                    Ventas
                                                </div>
                                                <div class="panel-body">
                                                    <div style=" bg-color: red;font-size:50px"><?php echo $s.' '.formato($venta_total); ?></div>
                                                </div>                           
                                            </div>
                                        </div>                                                                                                                                                                                                                                                                                                                                 
                                        </div> 
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <!--<button type="submit" class="btn btn-primary">Procesar</button>-->
                                        </div>                                       
                                    </div>
                                </div>
                                </form>
                            </div>
                     <!-- End Modals-->
                      <!-- Modal -->                      
                            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="form2" action="" method="post">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="panel-body">
                                        <div class="col-md-6" > 
                                            <strong>Concepto 1</strong><br>
                                            <input  class="form-control" name="concepto1" value="" autocomplete="off" required><br>
                                            <strong>Valor</strong><br>
                                            <input  class="form-control" name="valor" value="1" autocomplete="off" min="1" required><br>
                                            <strong>Tipo de Transaccion</strong><br>
                                             <select class="form-control" name="trans">
                                                <option value="ENTRADA">ENTRADA</option>
                                                <option value="SALIDA">SALIDA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6" > 
                                            <strong>Concepto 2</strong><br>
                                            <textarea class="form-control" name="concepto2" style="width:90%; height:140px">Sin Observaciones</textarea>
                                        </div>
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Procesar</button>
                                        </div>                                       
                                    </div>
                                </div>
                                </form>
                            </div>
                     <!-- End Modals-->                             
            
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             VENTAS, COMPRAS, CXC Y CXP
                        </div>
                        <div class="panel-body">
                         <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <?php 
                                            $salida=0;$entrada=0;$cxp=0;$cxc=0;
                                            $sql=mysql_query("SELECT * FROM contable");
                                            while($row=mysql_fetch_array($sql)){
                                                if($row['tipo']=='ENTRADA'){
                                                    $entrada=$entrada+$row['valor'];
                                                }elseif($row['tipo']=='SALIDA' or $row['tipo']=='CXC'){
                                                    $salida=$salida+$row['valor'];
                                                }elseif($row['tipo']=='CXP'){
                                                    
                                                }
                                            }
                                        ?>
                                        <div class="row-fluid">
                                            <div class="col-md-4 text-success"  align="center">
                                                <strong>Total Entrada</strong><br>
                                                <strong><?php echo $s.' '.formato($entrada); ?></strong>
                                            </div>
                                            <div class="col-md-4 text-danger" align="center">
                                                <strong>Total Salida</strong><br>
                                                <strong><?php echo $s.' '.formato($salida); ?></strong>
                                            </div>
                                            <div class="col-md-4" align="center">
                                                <strong>Total Ganancia</strong><br>
                                                <strong><?php echo $s.' '.formato($entrada-$salida); ?></strong>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
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
                                        <option value="ENTRADA" <?php if($trans=='VENTA'){ echo 'selected'; } ?>>ENTRADA</option>
                                        <option value="SALIDA" <?php if($trans=='SALIDA'){ echo 'selected'; } ?>>SALIDA</option>
                                        <option value="CXC" <?php if($trans=='CXC'){ echo 'selected'; } ?>>Cuentas por Cobrar</option>
                                        <option value="CXP" <?php if($trans=='CXP'){ echo 'selected'; } ?>>Cuentas por Pagar</option>                                       
                                    </select>
                                     <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i></button>
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
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>DESCRIPCION</th>                                                                                      
                                            <th>TIPO</th>                                                                                     
                                            <th>FECHA REGISTRO</th>
                                            <th>VALOR</th>
                                            <th>RESPONSABLE</th>
                                            <th></th>                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php 
                                                $sql=mysql_query("SELECT * FROM contable ".$where);
                                                while($row=mysql_fetch_array($sql)){
                                                    if($row['tipo']=='ENTRADA'){
                                                        $tipo='<span class="label label-success">Entrada</span>';
                                                    }elseif($row['tipo']=='SALIDA'){
                                                        $tipo='<span class="label label-danger">SALIDA</span>';
                                                    }elseif($row['tipo']=='CXC'){
                                                        $tipo='<span class="label label-info">Cuentas por Cobrar</span>';
                                                    }elseif($row['tipo']=='CXP'){
                                                        $tipo='<span class="label label-warning">Cuentas por Pagar</span>';
                                                    }
                                                    $oCliente=new Consultar_Clientes($row['concepto1']);
                                                    $oProveedor=new Consultar_Proveedor($row['concepto1']);
                                                    if($row['tipo']=='CXC'){
                                                       $c_nombre=$oCliente->consultar('nombre');
                                                    }
                                                    elseif($row['tipo']=='CXP'){
                                                        $c_nombre=$oProveedor->consultar('nombre');
                                                    }
                                                    else
                                                    {
                                                       $c_nombre=$row['concepto1'];     
                                                    }                                                  
                                            ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $c_nombre; ?></td>
                                            <td><center><?php echo $tipo; ?></center></td>
                                            <td><center><?php echo fecha($row['fecha']).' '.$row['hora']; ?></center></td>
                                            <td><div align="right"><?php echo $s.' '.formato($row['valor']); ?></div></td>
                                            <td><?php echo consultar('nom','persona',' doc='.$row['usu']); ?></td>
                                            <td>
                                                <center>
                                                <?php if($row['tipo']=='CXC'){ ?>
                                                    <a href="cxc.php?id=<?php echo $row[0]; ?>" class="btn btn btn-danger btn-xs"><strong>Abonar</strong></a>
                                                <?php }elseif($row['tipo']=='CXP'){ ?>
                                                    <a href="cxp.php?id=<?php echo $row[0]; ?>" class="btn btn btn-danger btn-xs"><strong>Abonar</strong></a>
                                                <?php } ?>
                                                </center>
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
