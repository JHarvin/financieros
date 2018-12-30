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
    if(!empty($_GET['id'])){
        $id_usu=limpiar($_GET['id']);
        $sql=mysql_query("SELECT nombre,estado FROM usuario WHERE doc='$id_usu'");
        if($row=mysql_fetch_array($sql)){
            $nombre=$row[0];
            #$salario=$row[1];
            $estado_u=$row[1];
        }
        
        if(!empty($_GET['cambio'])){
            $cambio=limpiar($_GET['cambio']);
            if($estado_u=='s'){
                mysql_query("UPDATE usuario SET estado='n' WHERE doc='$cambio'");
            }else{
                mysql_query("UPDATE usuario SET estado='s' WHERE doc='$cambio'");
            }
            header('Location: permisos.php?id='.$id_usu);
        }
        
        if(!empty($_GET['pe'])){
            $id_pe=limpiar($_GET['pe']);
                    
            $pa=mysql_query("SELECT * FROM permisos WHERE id='$id_pe' and estado='s'");             
            if($row=mysql_fetch_array($pa)){
                mysql_query("UPDATE permisos SET estado='n' WHERE id='$id_pe'");
            }else{
                mysql_query("UPDATE permisos SET estado='s' WHERE id='$id_pe'");
            }
            header('Location: permisos.php?id='.$id_usu);
        }
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
                        <li><a href="perfil.php"><i class="fa fa-user fa-fw"></i> My Perfil</a>
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
			 <div class="row">
                    <div class="col-md-12">                        
                          <div class="panel-body" align="center">                                                                                 
                             <a href="index.php" class="btn btn-default" title="Regresar">
                              <i class="fa fa-arrow-left" ></i><strong> </strong>
                           </a>                                                                                  
                  </div>
                    </div>
                </div> 
                 <!-- /. ROW  -->                                                   
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             PERMISOS a: <?php echo $nombre; ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                          <th>NOMBRE</th>                                                                                                                                 
                                          <th>ACCIONES</th>                                   
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                            $consulta=mysql_query("SELECT permisos.id,permisos.estado,permisos_tmp.nombre
                                            FROM permisos_tmp, permisos WHERE permisos.usu='$id_usu' and permisos_tmp.id=permisos.permiso");
                                            while($row=mysql_fetch_array($consulta)){
                                                $url='?id='.$id_usu.'&pe='.$row['id'];
                                                
                                                if($row['estado']=='s'){
                                                    $estado='<span class="label label-success">PERMITIDO</span>';
                                                }elseif($row['estado']=='n'){
                                                    $estado=' <span class="label label-danger">NO PERMITIDO</span> ';
                                                }
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['nombre']; ?></td>
                                                                                                                               
                                            <td class="center"><center><a href="permisos.php<?php echo $url; ?>"><?php echo $estado; ?></a></center></td>
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
    <!-- VALIDACIONES -->
    <script src="../../assets/js/jasny-bootstrap.min.js"></script>   
</body>
</html>
