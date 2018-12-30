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
    
if(!empty($_GET['codigo'])){
        $id_codigo=limpiar($_GET['codigo']);
        $id_codigo=substr($id_codigo,10);
        $id_codigo=decrypt($id_codigo,'URLCODIGO');
        ###TRAEMOS LOS CAMPOS DEL FROMULARIO CREAR PRODUCTO DE LA TABLA PRODUCTO####
        $pa=mysql_query("SELECT * FROM articulos WHERE codigo='$id_codigo'");                
        if($row=mysql_fetch_array($pa)){
            $existe=TRUE;
            $nombre_producto=$row['nombre'];
            $tipo_producto=$row['cat'];           
            $valor_producto=$row['valor'];
        }else{
            $existe=FALSE;  
        }
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
              
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">28% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100" style="width: 28%">
                                            <span class="sr-only">28% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">85% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%">
                                            <span class="sr-only">85% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
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
            <?php include_once "../../menu/m_categoria.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">            			 
                  <!--  Modals-->
                     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="form1" method="post" action="">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        
                                            <h3 align="center" class="modal-title" id="myModalLabel">Nuevo Articulo</h3>
                                        </div>
                                        <div class="panel-body">
                                        <div class="row">                                       
                                            <div class="col-md-6">                                                                                   
                                                <input class="form-control" name="codigo" placeholder="Codigo" autocomplete="off" required><br>
                                                <input class="form-control" name="nombre" placeholder="Nombre" autocomplete="off" required><br>
                                                <div class="input-group">
                                                  <span class="input-group-addon">Categoria</span>
                                                  <select class="form-control" name="cat" autocomplete="off" required>
                                                  <option value="" selected disabled>---SELECCIONE---</option>
                                                   <?php
                                                        $sal=mysql_query("SELECT * FROM categorias WHERE estado='s'");             
                                                        while($col=mysql_fetch_array($sal)){
                                                            echo '<option value="'.$col['id'].'">'.$col['nombre'].'</option>';
                                                        }
                                                    ?>                                         
                                                </select>                                               
                                                </div><br>
                                               <div class="input-group">
                                                  <span class="input-group-addon">Unidad</span>
                                                  <select class="form-control" name="und" autocomplete="off" required>
                                                   <option value="" selected disabled>---SELECCIONE---</option>
                                                     <?php
                                                        $sal=mysql_query("SELECT * FROM unidades WHERE estado='s'");             
                                                        while($col=mysql_fetch_array($sal)){
                                                            echo '<option value="'.$col['id'].'">'.$col['nombre'].'</option>';
                                                        }
                                                    ?>                                                 
                                                </select>                                               
                                                </div><br>                                            
                                            </div>
                                            <div class="col-md-6">
                                            <input class="form-control" name="valor" placeholder="Valor" autocomplete="off" required><br>
                                            <textarea class="form-control" name="detalle" placeholder="Detalle" rows="4"></textarea><br>                                                                                                                                            
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
                     <?php 
                                    if(!empty($_POST['codigo'])){                                               
                                        $codigo=limpiar($_POST['codigo']);
                                        $nombre=limpiar($_POST['nombre']);
                                        $cat=limpiar($_POST['cat']);
                                        $und=limpiar($_POST['und']);
                                        $valor=limpiar($_POST['valor']);
                                        $detalle=limpiar($_POST['detalle']);                                                                                                          
                                        $estado=limpiar($_POST['estado']);
                                        
                                        if(empty($_POST['id'])){
                                            $oArticulos=new Proceso_Articulos('',$codigo,$nombre,$cat,$und,$valor,$detalle,$estado);
                                            $oArticulos->crear();
                                            echo mensajes('Articulo "'.$nombre.'" Creado con Exito','verde');
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oArticulos=new Proceso_Articulos($id,$codigo,$nombre,$cat,$und,$valor,$detalle,$estado);
                                            $oArticulos->actualizar();
                                            echo mensajes('Articulo "'.$nombre.'" Actualizado con Exito','verde');
                                        }
                                    }
                                ?>
                                <div class="alert alert-warning" align="center"><strong>Nombre:</strong>  <?php echo $nombre_producto; ?></div>
        <div class="row">
                    <div class="col-md-12">                        
                          <div class="panel-body" align="center">                                                                                 
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-download" title="AGREGAR A ALMACEN"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-circle"><i class="fa fa-question"></i>
                            </button>                                                                                 
                           </div>
                    </div>
        </div>        
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             ASIGNACION ALMACEN
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">                           
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>CODIGO</th>
                                            <th>ARTICULO</th>
                                            <th>VALOR</th>                                           
                                            <th>ALMACEN</th>
                                            <th>ACCIONES</th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php                                             
                                            $pame=mysql_query("SELECT * FROM inventario");                                                        
                                            while($row=mysql_fetch_array($pame)){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['articulo']; ?></td>
                                            <td><?php echo $row['articulo']; ?></td>
                                            <td><?php echo formato($row['valor']); ?></td>                                          
                                            <td></td>
                                            <td class="center"></td>
                                        </tr>                                     
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
