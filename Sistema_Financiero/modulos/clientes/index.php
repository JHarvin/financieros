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
    ######### TRAEMOS LOS DATOS DEL ALMACEN #############
        $pa=mysql_query("SELECT * FROM almacenes WHERE id='$id_almacen'");                
        if($row=mysql_fetch_array($pa)){
            $docc=$row['docc'];
            $vdocc=$row['vdocc'];
            $ftel=$row['ftel'];
            if ($row['doco'] == NULL) {
                $doco='Otro Doc.';
                $vdoco='9999999999';
            }
            else{
                $doco=$row['doco'];
                $vdoco=$row['vdoco'];
            }
        }
    
    if(!empty($_GET['del'])){
        $id=$_GET['del'];
        mysql_query("DELETE FROM clientes WHERE id='$id'");
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
            <?php include_once "../../menu/m_clientes.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
<?php if(permiso($_SESSION['cod_user'],'9')==TRUE){ ?>
			 <div class="row">
                    <div class="col-md-12">                        
                          <div class="panel-body" align="center">                                                                                 
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModal" title="Agregar Nuevo Cliente"><i class="fa fa-plus fa-2x"></i>
                            </button>
                             <button type="button" class="btn btn-info btn-circle" onClick="window.location='PDFcliente.php'" title="Reporte PDF"><i class="fa fa-list-alt fa-2x"></i>
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
                                        <div class="panel-body">
                                        <div class="row">
                                                <div class="tab-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                
                                                    <h3 align="center" class="modal-title" id="myModalLabel">Nuevo Cliente</h3>
                                                </div>                                           
                                                        <br>
                                                         <div class="col-md-12">
                                                        <br>
        <input class="form-control" title="Se necesita un nombre"  name="nombre" placeholder="Nombre Completo" autocomplete="off" required><br>
        <input class="form-control" title="Se necesita una Direccion" name="dir" placeholder="Procedencia"  autocomplete="off"><br>  
                                                        </div>                                          
                            <div class="col-md-6">
         <input class="form-control" name="tel" title="Se necesita un Telefono" placeholder="Telefono" data-mask="<?php echo $ftel; ?>" autocomplete="off"><br>                                                            
                                                             </div>
                                                             <div class="col-md-6">
                                                        <div class="input-group">
                                                                <span class="input-group-addon"><?php echo $docc; ?></span>                                                     
        <input class="form-control" name="nrc"   placeholder="<?php echo $docc; ?>" data-mask="<?php echo $vdocc; ?>" autocomplete="off"><br>
                                                            </div><br>
                                                            </div>
                                                            <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><?php echo $doco; ?></span>
                                                              <input class="form-control" name="dui"   placeholder="<?php echo $vdoco; ?>" data-mask="<?php echo $vdoco; ?>" autocomplete="off"><br>                                                                                                                                                                          
                                                            </div><br>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                               <div class="input-group">
                                                                  <span class="input-group-addon">Sexo</span>
                                                                  <select class="form-control" name="sexo" autocomplete="off" required>
                                                                   <option value="" selected disabled>---SELECCIONE---</option>
                                                                    <option value="m">MASCULINO</option>
                                                                    <option value="f">FEMENINO</option>                                            
                                                                    <option value="i">INSTITUCION</option>                                            
                                                                </select>                                               
                                                                </div><br>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                            <div class="input-group">
                                                                  <span class="input-group-addon">Tipo</span>
                                                                  <select class="form-control" name="tipo" autocomplete="off" required>
                                                                    <option value="consumidor">CONSUMIDOR FINAL</option>
                                                                    <option value="contribuyente">CONTRIBUYENTE</option>                                            
                                                                </select>                                               
                                                                </div><br>
                                                                </div>
                                                                <div class="col-md-6">
                                                               <div class="input-group">
                                                                  <span class="input-group-addon">Estado</span>
                                                                  <select class="form-control" name="estado" autocomplete="off" required>
                                                                    <option value="s">ACTIVO</option>
                                                                    <option value="n">NO ACTIVO</option>                                            
                                                                </select>                                               
                                                                </div>
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
                             CLIENTES
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <?php 
                                    if(!empty($_POST['nombre'])){                                               
                                        $nombre=limpiar($_POST['nombre']);
                                        $dir=limpiar($_POST['dir']); 
                                        $dui=limpiar($_POST['dui']);
                                        $sexo=limpiar($_POST['sexo']);  
                                        $tel=limpiar($_POST['tel']); 
                                        $nrc=limpiar($_POST['nrc']);                                                                                                         
                                        $estado=limpiar($_POST['estado']);
                                        $tipo=limpiar($_POST['tipo']);
                                        
                                        if(empty($_POST['id'])){
                                            $oCliente=new Proceso_Cliente('',$nombre,$dir,$dui,$sexo,$tel,$nrc,$estado,$tipo);
                                            $oCliente->crear();
                                            echo mensajes('Cliente "'.$nombre.'" Creado con Exito','verde');
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oCliente=new Proceso_Cliente($id,$nombre,$dir,$dui,$sexo,$tel,$nrc,$estado,$tipo);
                                            $oCliente->actualizar();
                                            echo mensajes('Cliente "'.$nombre.'" Actualizado con Exito','verde');
                                        }
                                    }
                                ?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><?php echo $doco; ?></th>
                                            <th>NOMBRE</th>
                                            <th>TELEFONO</th>
                                            <th>DIRECCIÓN</th>                                           
                                            <th>ACCIONES</th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php                                             
                                            $pame=mysql_query("SELECT * FROM clientes ORDER BY nombre");                                                        
                                            while($row=mysql_fetch_array($pame)){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['dui']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo $row['tel']; ?></td>
                                            <td><?php echo $row['dir']; ?></td>                                             
                                            <td class="center">
                                            <div class="btn-group">
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
                                                            
    <h3 align="center" class="modal-title" id="myModalLabel">Editar Cliente</h3>
        </div>
     <div class="panel-body">
    <div class="row">                                       
     <div class="col-md-12">
     <div class="input-group">
    <span class="input-group-addon">Nombre</span>
<input class="form-control" title="Se necesita un nombre"  name="nombre"  value="<?php echo $row['nombre']; ?>" autocomplete="off" required><br>                                         
    </div><br>                                          
    </div>
    <div class="col-md-12">
    <div class="input-group">
     <span class="input-group-addon">Procedencia</span>
    <input class="form-control" title="Se necesita una Procedencia"  name="dir" value="<?php echo $row['dir']; ?>" autocomplete="off"><br>                                         
        </div><br>                                          
    </div>
    <div class="col-md-6">
     <div class="input-group">
      <span class="input-group-addon">Tel</span>
    <input class="form-control" title="Se necesita un nombre"  name="tel" data-mask="<?php echo $ftel; ?>" value="<?php echo $row['tel']; ?>" autocomplete="off"><br>                                         
     </div><br>                                          
     </div>
    <div class="col-md-6">
     <div class="input-group">
     <span class="input-group-addon"><?php echo $docc; ?></span>
    <input class="form-control"  name="nrc" data-mask="<?php echo $vdocc; ?>" value="<?php echo $row['nrc']; ?>" autocomplete="off"><br>                                         
    </div><br>                                          
    </div>
    <div class="col-md-6">
    <div class="input-group">
    <span class="input-group-addon"><?php echo $doco; ?></span>
    <input class="form-control" name="dui" data-mask="<?php echo $vdoco; ?>" value="<?php echo $row['dui']; ?>" autocomplete="off"><br>                                         
                                                                    </div><br>                                          
                                                                </div>
                                                                 <div class="col-md-6">                                                                                          
                                                                     <div class="input-group">
                                                                      <span class="input-group-addon">Sexo</span>
                                                                      <select class="form-control" name="sexo" autocomplete="off" required>
                                                                        <option value="m" <?php if($row['sexo']=='m'){ echo 'selected'; } ?>>MASCULINO</option>
                                                                        <option value="f" <?php if($row['sexo']=='f'){ echo 'selected'; } ?>>FEMENINO</option>                                                   
                                                                        <option value="i" <?php if($row['sexo']=='i'){ echo 'selected'; } ?>>INSTITUCION</option>                                                   
                                                                    </select>                                               
                                                                    </div><br>                                           
                                                                </div>      
                                                                <div class="col-md-6">
                                                                <div class="input-group">
                                                                      <span class="input-group-addon">Tipo</span>
                                                                      <select class="form-control" name="tipo" autocomplete="off" required>
                                                                        <option value="consumidor" <?php if($row['tipo']=='consumidor'){ echo 'selected'; } ?>>CONSUMIDOR FINAL</option>
                                                                        <option value="contribuyente" <?php if($row['tipo']=='consumidor'){ echo 'selected'; } ?>>CONTRIBUYENTE</option>                                                   
                                                                    </select>                                               
                                                                    </div><br>
                                                                    </div>
                                                                     <div class="col-md-6">                                                                                            
                                                                     <div class="input-group">
                                                                      <span class="input-group-addon">Estado</span>
                                                                      <select class="form-control" name="estado" autocomplete="off" required>
                                                                        <option value="s" <?php if($row['estado']=='s'){ echo 'selected'; } ?>>ACTIVO</option>
                                                                        <option value="n" <?php if($row['estado']=='n'){ echo 'selected'; } ?>>NO ACTIVO</option>                                                   
                                                                    </select>                                               
                                                                    </div><br>
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
                                                                    una vez Eliminado el Cliente <strong>[ <?php echo $row['nombre']; ?> ]</strong> sus datos no podran ser Recuperados. 
                                                                    Recomendamos husar la opcion de "No Activo"</h4>
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
                                         <!-- Modal -->                     
                                            <div class="modal fade" id="info<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">                                                   
                                                <form name="contado">                                                                               
                                                <div class="modal-dialog">                                             
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                    
                                                    <h3 align="center" class="modal-title" id="myModalLabel">INFORMACION</h3>
                                                    </div>
                                                    <div class="modal-body">                                     
                                                    
                                                               aqui...
                                                                                                     
                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                                                    </div>                      
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                                                                                                      
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
<?php }else{ echo mensajes("NO TIENES PERMISO PARA ENTRAR A ESTE FORMULARIO","rojo"); }?>                           
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
