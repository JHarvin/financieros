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
        mysql_query("DELETE FROM marcas WHERE id='$id'");
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
            <?php if(permiso($_SESSION['cod_user'],'3')==TRUE){ ?> 
			 <div class="row">
                    <div class="col-md-12">                        
                          <div class="panel-body" align="center">                                                                                 
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModal" title="Agregar Marca"><i class="fa fa-plus fa-2x"></i>
                            </button>                                                                                
                  </div>
                    </div>
                </div> 
                 <!-- /. ROW  -->
                  <!--  Modals-->
                     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="form1" method="post" action="">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        
                                            <h3 align="center" class="modal-title" id="myModalLabel">Nueva Marca</h3>
                                        </div>
                                        <div class="panel-body">
                                        <div class="row">                                       
                                            <div class="col-md-6">                                                                                   
                                                <input class="form-control" name="nombre" placeholder="Nombre" autocomplete="off" required onKeyUp="this.value=this.value.toUpperCase();"><br>                                          
                                            </div>
                                            <div class="col-md-6">                                                                                                                                         
                                               <div class="input-group">
                                                  <span class="input-group-addon">Estado</span>
                                                  <select class="form-control" name="estado" autocomplete="off" required>
                                                    <option value="s">Activo</option>
                                                    <option value="n">No Activo</option>                                            
                                                </select>                                               
                                                </div>
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
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             MARCAS
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <?php 
                                    if(!empty($_POST['nombre'])){                                               
                                        $nombre=limpiar($_POST['nombre']);                                                                                                          
                                        $estado=limpiar($_POST['estado']);
                                        
                                        if(empty($_POST['id'])){
                                            $oCategoria=new Proceso_Marcas('',$nombre,$estado);
                                            $oCategoria->crear();
                                            echo mensajes('Marca "'.$nombre.'" Creada con Exito','verde');
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oCategoria=new Proceso_Marcas($id,$nombre,$estado);
                                            $oCategoria->actualizar();
                                            echo mensajes('Marca "'.$nombre.'" Actualizada con Exito','verde');
                                        }
                                    }
                                ?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>ESTADO</th>
                                            <th>ACCIONES</th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php                                             
                                            $pame=mysql_query("SELECT * FROM marcas ORDER BY nombre");                                                        
                                            while($row=mysql_fetch_array($pame)){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td class="center"><?php echo estado($row['estado']); ?></td>
                                            <td class="center"><div class="btn-group">
                                              <button data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle"><i class="fa fa-cog"></i> <span class="caret"></span></button>
                                              <ul class="dropdown-menu">
                                                <li><a href="#" data-toggle="modal" data-target="#actualizar<?php echo $row['id']; ?>"><i class="fa fa-edit"></i> Editar</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" data-toggle="modal" data-target="#eliminar<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i> Eliminar</a></li>                                                                                                                                             
                                              </ul>
                                            </div>
                                            </td>
                                        </tr>
                                        <!--  Modals-->
                                         <div class="modal fade" id="actualizar<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <form name="form1" method="post" action="">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            
                                                                <h3 align="center" class="modal-title" id="myModalLabel">Editar Marca</h3>
                                                            </div>
                                                            <div class="panel-body">
                                                            <div class="row">                                       
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Nombre</span>
                                                                          <input class="form-control"  name="nombre" value="<?php echo $row['nombre']; ?>" autocomplete="off" required onKeyUp="this.value=this.value.toUpperCase();"><br>                                         
                                                                    </div>                                          
                                                                </div>
                                                                <div class="col-md-6">                                                                                          
                                                                     <div class="input-group">
                                                                      <span class="input-group-addon">Estado</span>
                                                                      <select class="form-control" name="estado" autocomplete="off" required>
                                                                        <option value="s" <?php if($row['estado']=='s'){ echo 'selected'; } ?>>Activo</option>
                                                                        <option value="n" <?php if($row['estado']=='n'){ echo 'selected'; } ?>>No Activo</option>                                                   
                                                                    </select>                                               
                                                                    </div>                                          
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
                                         <!-- Modal -->                     
                                                <div class="modal fade" id="eliminar<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <form name="contado" action="index.php?del=<?php echo $row['id']; ?>" method="get">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                    
                                                                            <h3 align="center" class="modal-title" id="myModalLabel">Seguridad</h3>
                                                                        </div>
                                                            <div class="panel-body">
                                                            <div class="row" align="center">                                       
                                                                                                        
                                                                <strong>Hola! <?php echo $cajero_nombre; ?></strong><br><br>
                                                                <div class="alert alert-danger">
                                                                    <h4>¿Esta Seguro de Realizar esta Acción?<br> 
                                                                    una vez Eliminada la categoria <strong>[ <?php echo $row['nombre']; ?> ]</strong> no podra ser Recuperada.</h4>
                                                                </div>                                                                                                                                                                                                                                                                                                                                                                                                                              
                                                            </div> 
                                                            </div> 
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                <a href="index.php?del=<?php echo $row['id']; ?>"  class="btn btn-danger" title="Eliminar">
                                                                    <i class="fa fa-times" ></i> <strong>Eliminar</strong>
                                                                </a>                                                                
                                                            </div>                                       
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                         <!-- End Modals-->      
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
