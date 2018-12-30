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
    
    if(!empty($_GET['id'])){
        $id=limpiar($_GET['id']);   
        $sql=mysql_query("SELECT * FROM contable WHERE id='$id' and tipo='CXP'");
        if($row=mysql_fetch_array($sql)){
            $concepto1=$row['concepto1'];   
            $fecha=$row['fecha'];
            $concepto2=$row['concepto2'];   
            $hora=$row['hora'];
            $deuda=$row['valor'];
            $oProveedor=new Consultar_Proveedor($row['concepto1']);
            
        }else{
            return header('Location: index.php');
        }
    }else{
        return header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo 'CXP No. '.$id; ?></title>
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
                 <?php
                if(!empty($_POST['valor'])){
                    $valor=limpiar($_POST['valor']);
                    if(!empty($_POST['nota'])){
                        $nota=limpiar($_POST['nota']);
                    }else{
                        $nota='Sin Observaciones';
                    }
                    
                    $fecha=date('Y-m-d');
                    $hora=date('H:i:s');

                    
                    mysql_query("INSERT INTO abono (cuenta,valor,fecha,hora,nota,usu) VALUES ('$id','$valor','$fecha','$hora','$nota','$usu')");
                    mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio,clase) 
                    VALUES ('Abono CXP No. $id','Sin Observaciones','SALIDA','$valor','$fecha','$hora','$usu','$id_almacen','CXP')");
                    echo mensajes("El Abono a la Cuenta por Pagar No. ".$id." por valor de ".$s." ".formato($valor)." ha sido registrado con exito","verde");
                }
                ?>
                <table class="table table-bordered">
                <tr class="info">
                    <td><strong>Cuenta por Pagar: </strong> <span class="badge"><?php echo $id; ?></span><br></td>
                    <td><strong>Proveedor: </strong> <?php echo $oProveedor->consultar('nombre'); ?><br></td>                    
                    <td><strong>Fecha: </strong> <?php echo fecha($fecha).' '.$hora; ?></td>
                </tr>
            </table>
            <div class="row-fluid">
                <div class="col-md-4 text-danger" align="center" style="font-size:16px">
                    <strong>Total Deuda</strong><br>
                    <strong> <?php echo $s.' '.formato($deuda); ?></strong>
                </div>
                <div class="col-md-4 text-info" align="center" style="font-size:16px">
                    <strong>Total Abonado</strong><br>
                    <strong><?php echo $s.' '.formato(abonos_saldo($id)); ?></strong>
                </div>
                <div class="col-md-4 text-success" align="center" style="font-size:16px">
                    <strong>Saldo Faltante</strong><br>
                    <strong><?php echo $s.' '.formato($deuda-abonos_saldo($id)); ?></strong>
                </div>
            </div><br><br><br>
             <?php 
                $por=abonos_saldo($id)*100/$deuda;
            ?>
            <strong><center><?php echo 'Total Abonado: '.formato($por).'% || Total Saldo '.formato(100-$por).'%'; ?></center></strong>
            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-success" role="progressbar" style="width: <?php echo $por; ?>%;"></div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                         <div class="panel-body" align="center">                                                                                 
                           <a href="index.php">
                            <button type="button" class="btn btn-primary btn-circle"><i class="fa fa-arrow-left fa-2x" title="Regresar"></i>
                            </button></a>
                         <?php 
                            if($deuda-abonos_saldo($id)<>0){ 
                                echo ' <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#abono"><i class="fa fa-plus fa-2x" title="Agregar Nuevo Abono"></i>
                                      </button>';
                            }
                        ?>                                                                                                              
                  </div>
                </div>
                <div class="col-md-4"></div>    
                 <!--  Modals-->
                     <div class="modal fade" id="abono" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="forms" method="post" action="">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        
                                            <h3 align="center" class="modal-title" id="myModalLabel">Registrar<br><?php echo 'Cuenta por Pagar No. '.$id; ?></h3>
                                        </div>
                                        <div class="panel-body">
                                        <div class="row">                                       
                                            <div class="col-md-6">                                          
                                                <label>Valor del Abono:</label>                                             
                                                <input type="number" name="valor" value="1" min="1" max="<?php echo $deuda-abonos_saldo($id); ?>" autocomplete="off" required class="form-control"><br><br>
                                            </div>
                                            <div class="col-md-6">                                                                                          
                                                 <label>Observaciones</label>
                                                <input type="text" name="nota" autocomplete="off" class="form-control">
                                            </div>                                                                        
                                        </div> 
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Registrar</button>
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
                             ABONOS REALIZADOS
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">                                   
                                    <thead>
                                        <tr>
                                            <th>FECHA</th>
                                            <th>OBSERVACION</th>
                                            <th>RESPONSABLE</th>                                                                                                                                 
                                            <th><div align="right"><strong>VALOR</strong></div></th>                                                                                        
                                            <th></th>                                                                                       
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql=mysql_query("SELECT * FROM abono WHERE cuenta='$id'");
                                            while($row=mysql_fetch_array($sql)){
                                        ?>
                                            <tr>
                                                <td><center><?php echo fecha($row['fecha']).' - '.$row['hora']; ?></center></td>
                                                <td><?php echo $row['nota']; ?></td>
                                                <td><?php echo consultar('nom','persona',' doc='.$row['usu']); ?></td>
                                                <td><div align="right"><?php echo $s.' '.formato($row['valor']) ?></div></td>
                                                <td></td>
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
