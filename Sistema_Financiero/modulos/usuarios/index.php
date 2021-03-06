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
        mysql_query("DELETE FROM usuario WHERE id='$id'");
        header('Location:index.php');
    }
    $titulo='Crear Usuario';
    $boton='Ingresar Usuario';
    $existe=false;
    
    $doc='';        
    $salario='0';
    $nombre='';     
    $estado='';
    $cargo='';      
    $nota='';
    
    if(!empty($_GET['id'])){
        $codigo=limpiar($_GET['id']);
        $sql=mysql_query("SELECT * FROM usuario WHERE codigo='$codigo'");
        if($row=mysql_fetch_array($sql)){
            $nombre=$row['nombre'];         
            $salario=$row['salario'];
            $estado=$row['estado'];         
            $nota=$row['nota'];
            $cargo=$row['tipo'];        
            $existe=true;                   
            $boton='Actualizar Usuario';
            $titulo='Modificar Usuario';
        }else{
            header('Location: usuario.php');
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
            <?php if(permiso($_SESSION['cod_user'],'18')==TRUE){ ?>
			 <div class="row">
                    <div class="col-md-12">                        
                          <div class="panel-body" align="center">                                                                                 
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModal" title="Agrear Usuario"><i class="fa fa-plus fa-2x"></i>
                            </button>                                                                               
                  </div>
                    </div>
                </div> 
                   <!--  Modals-->
                                         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <form name="form2" method="post" enctype="multipart/form-data" action="">                                           
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                            
                                                                <h3 align="center" class="modal-title" id="myModalLabel">Nuevo Usuario</h3>
                                                            </div>
                                                            <div class="panel-body">
                                                            <div class="row">
                                                                 <div class="col-md-12">
                                                                 <input class="form-control" name="nombre" placeholder="Nombre Completo" autocomplete="off" required onKeyUp="this.value=this.value.toUpperCase();"><br>
                                                                 </div>                                       
                                                                <div class="col-md-6">                                                                                                              
                                                                    <input class="form-control" name="doc" placeholder="Documento" autocomplete="off" required onKeyUp="this.value=this.value.toUpperCase();"><br>                                                                 
                                                                    <select name="cargo" class="form-control" autocomplete="off" required>
                                                                    <option value="" selected disabled>--CARGO--</option>                                                                    
                                                                        <option value="admin" <?php if($cargo=='admin'){ echo 'selected'; } ?>>Administrador Principal</option>
                                                                        <?php 
                                                                            $sql=mysql_query("SELECT id,nombre FROM tipo_usuario ORDER BY nombre");
                                                                            while($row=mysql_fetch_array($sql)){
                                                                                if($row[0]==$cargo){
                                                                                    echo '<option value="'.$row[0].'" selected>'.$row[1].'</option>';
                                                                                }else{
                                                                                    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </select><br>                            
                                                                    <strong>Fotografia</strong><br>
                                                                    <input type="file" name="imagen" id="imagen">                                                                   
                                                                </div>
                                                                <div class="col-md-6">                                                                                                                                      
                                                                                                                                                            
                                                                    <select class="form-control" name="consultorio" autocomplete="off" required>
                                                                    <option value="" selected disabled>--ALMACEN--</option>
                                                                        <?php
                                                                            $sal=mysql_query("SELECT * FROM almacenes WHERE estado='s'");                
                                                                            while($col=mysql_fetch_array($sal)){
                                                                                echo '<option value="'.$col['id'].'">'.$col['nombre'].'</option>';
                                                                            }
                                                                        ?>                                                  
                                                                    </select><br>               
                                                                    
                                                                    <select class="form-control" name="estado" autocomplete="off" required>
                                                                        <option value="s">ACTIVO</option>
                                                                        <option value="n">NO ACTIVO</option>                                                    
                                                                    </select><br><br><br>
                                                                    <br>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary"><?php echo $boton; ?></button>
                                                                    
                                                                </div>                                                                        
                                                            </div> 
                                                            </div> 
                                                            <div class="modal-footer">
                                                                
                                                            </div>                                       
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                         <!-- End Modals-->
                 <!-- /. ROW  -->                                                   
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             USUARIOS
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                    <?php 
                                        if(!empty($_POST['doc']) and !empty($_POST['nombre'])){
                                            $nombre=limpiar($_POST['nombre']);          
                                            $salario='0';
                                            $doc=limpiar($_POST['doc']);            
                                            $cargo=limpiar($_POST['cargo']);
                                            $consultorio=limpiar($_POST['consultorio']);
                                            $nota='Ninguna';                
                                            $estado=limpiar($_POST['estado']);
                                            
                                            if($cargo=='admin'){
                                                $tipo='Admin';
                                                $ncargo='Administrador';
                                            }else{
                                                $tipo=$cargo;
                                                $ncargo=consultar('nombre','tipo_usuario'," id='".$tipo."'");
                                            }
                                            
                                            if($existe==false){
                                                $sqll=mysql_query("SELECT id FROM usuario WHERE doc='$doc' or nombre='$nombre'");
                                                if($roww=mysql_fetch_array($sqll)){
                                                    echo mensajes("El Documento o Nombre del Usuario ya se encuentra registrado en la base de datos","rojo");
                                                }else{
                                                
                                                    mysql_query("INSERT INTO usuario (doc,nombre,cargo,nota,salario,estado,tipo,consultorio,con) 
                                                    VALUES ('$doc','$nombre','$ncargo','$nota','$salario','$estado','$tipo','$consultorio','$doc')");
                                                    
                                                    
                                                    if($tipo=='Admin'){
                                                        $sql=mysql_query("SELECT * FROM permisos_tmp");
                                                        while($row=mysql_fetch_array($sql)){
                                                            $id=$row['id'];
                                                            mysql_query("INSERT INTO permisos (permiso,usu,estado) VALUES ('$id','$doc','s')");
                                                        }
                                                    }else{
                                                        $sql=mysql_query("SELECT * FROM tipo_permisos WHERE tipo='$tipo'");
                                                        while($row=mysql_fetch_array($sql)){
                                                            $id=$row['permiso'];
                                                            $es=$row['estado'];
                                                            mysql_query("INSERT INTO permisos (permiso,usu,estado) VALUES ('$id','$doc','$es')");
                                                        }
                                                    }
                                                    mysql_query("INSERT INTO persona (doc, nom, cargo, estado) VALUES 
                                                                ('$doc','$nombre','$cargo','$estado')");

                                                    mysql_query("INSERT INTO cajero (usu, almacen) VALUES ('$doc','$consultorio')");
                                                    echo mensajes("Se ha Registrado el Usuario con Exito","verde");
                                                    //subir la imagen del articulo
                                                                    $nameimagen = $_FILES['imagen']['name'];
                                                                    $tmpimagen = $_FILES['imagen']['tmp_name'];
                                                                    $extimagen = pathinfo($nameimagen);
                                                                    $ext = array("png","jpg");
                                                                    $urlnueva = "../../img/usuario/".$doc.".jpg";           
                                                                    if(is_uploaded_file($tmpimagen)){
                                                                        if(array_search($extimagen['extension'],$ext)){
                                                                            copy($tmpimagen,$urlnueva); 
                                                                        }else{
                                                                            echo mensajes("Error al Cargar la Imagen","rojo");  
                                                                        }
                                                                    }else{
                                                                        echo mensajes("Error al Cargar la Imagen","rojo");  
                                                                    }
                                                }
                                            }elseif($existe==true){
                                                mysql_query("UPDATE usuario SET nombre='$nombre', cargo='$ncargo', nota='$nota', salario='$salario', estado='$estado', tipo='$tipo'
                                                WHERE codigo='$codigo'");   
                                                echo mensajes("Se ha Actualizado el Usuario con Exito","verde");
                                            }
                                        }
                                    ?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                           <th>DOCUMENTO</th>
                                            <th>NOMBRE</th>
                                            <th>CARGO</th>
                                            <th>ALMACEN</th>
                                            <th>ESTADO</th>                                                                                      
                                            <th></th>                                       
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $pame=mysql_query("SELECT * FROM usuario  ORDER BY nombre");        
                                            while($row=mysql_fetch_array($pame)){
                                                $url=cadenas().encrypt($row['doc'],'URLCODIGO');
                                                $id=$row['id'];
                                                $doc=$row['doc'];
                                                $nombre=$row['nombre'];
                                                $oConsul=new Consultar_Deposito($row['consultorio']); 
                                          ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['doc']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo $row['cargo']; ?></td>
                                            <td><?php echo $oConsul->consultar('nombre'); ?></td>
                                            <td><?php echo estado($row['estado']); ?></td>                                                                                   
                                            <td class="center">
                                            <div class="btn-group">
                                              <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle"><i class="fa fa-cog"></i> <span class="caret"></span></button>
                                              <ul class="dropdown-menu">
                                                <li><a href="agregar.php?id=<?php echo $row['doc']; ?>"><i class="fa fa-edit"></i> Editar</a></li>                                              
                                                <li class="divider"></li>
                                                <?php 
                                                    $sql=mysql_query("SELECT usu FROM resumen WHERE usu='".$row[1]."'");
                                                    if($row=mysql_fetch_array($sql)){}else{
                                                    echo '<li><a href="#" data-toggle="modal" data-target="#eliminar'.$id.'" ><i class="fa fa-pencil"></i>Eliminar</a>
                                                </li> ';
                                                    }
                                                ?>   
                                                                                                                                                                                             
                                              </ul>
                                            </div>
                                            <a href="permisos.php?id=<?php echo $doc; ?>"  class="btn btn-danger" title="Permisos">
                                            <i class="fa fa-unlock" ></i>
                                            </a>    
                                            </td>
                                        </tr>
                                        <!-- Modal -->                      
                                                <div class="modal fade" id="eliminar<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <form name="contado" action="index.php?del=<?php echo $id; ?>" method="get">
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                                                                    <h4>¿Esta Seguro de Realizar esta Acción?<br><br> 
                                                                    una vez Eliminado el Usuario [ <?php echo $nombre; ?> ]<br> 
                                                                    no podran ser Recuperados sus datos.<br>
                                                                    No recomendamos esta accion, sino la de "Activo" o No Activo, porque de este
                                                                    depende mucha informcion en el Almacen de datos.
                                                                    </h4>
                                                            </div> 
                                                            </div> 
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                <a href="index.php?del=<?php echo $id; ?>"  class="btn btn-danger" title="Eliminar">
                                                                    <i class="fa fa-times" ></i> <strong>Eliminar</strong>
                                                                </a>                                                                
                                                            </div>                                       
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                         <!-- End Modals-->
                                      
                                         <!--  Modals-->
                                         <div class="modal fade" id="actualizar<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <form name="form1" method="post" action="">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                            
                                                                <h3 align="center" class="modal-title" id="myModalLabel">Actualizar Usuario</h3>
                                                            </div>
                                                            <div class="panel-body">
                                                            <div class="row">                                       
                                                                <div class="col-md-6">                                                                                                              
                                                                    <label>Documento:</label>
                                                                    <input class="form-control" name="doc" value="<?php echo $row['doc']; ?>" data-mask="99999999-9" autocomplete="off" required onKeyUp="this.value=this.value.toUpperCase();"><br>
                                                                    <label>Nombre:</label>
                                                                    <input class="form-control" name="nom" value="<?php echo $row['nom']; ?>" autocomplete="off" required onKeyUp="this.value=this.value.toUpperCase();"><br>  
                                                                    <label>Telefono:</label>
                                                                    <input class="form-control" name="tel" value="<?php echo $row['tel']; ?>" data-mask="9999-9999" autocomplete="off" required onKeyUp="this.value=this.value.toUpperCase();"><br>
                                                                    <label>Dirección:</label>
                                                                    <input class="form-control" name="dir" value="<?php echo $row['dir']; ?>" autocomplete="off" required onKeyUp="this.value=this.value.toUpperCase();"><br><br><br>
                                                                    <strong>Fotografia</strong><br>
                                                                    <input type="file" name="imagen" id="imagen">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Sexo</label>
                                                                    <select class="form-control" name="sexo" autocomplete="off" required>                                                                       
                                                                        <option value="m" <?php if($row['sexo']=='m'){ echo 'selected'; } ?>>MASCULINO</option>
                                                                        <option value="f" <?php if($row['sexo']=='f'){ echo 'selected'; } ?>>FEMENINO</option>
                                                                    </select><br>
                                                                    <label>Tipo de Usuario</label>
                                                                    <select class="form-control" name="tipo" autocomplete="off" required>                                                                       
                                                                        <option value="a">ADMINISTRADOR</option>
                                                                        <option value="c">ASISTENTE</option>
                                                                    </select><br>
                                                                    <label>Consultorio;</label>
                                                                    <select class="form-control" name="consultorio" autocomplete="off" required>
                                                                        <?php
                                                                            $pa=mysql_query("SELECT * FROM consultorios");              
                                                                            while($row=mysql_fetch_array($pa)){
                                                                                if($row['id']){
                                                                                    echo '<option value="'.$row['id'].'" selected>'.$row['nombre'].'</option>'; 
                                                                                }else{
                                                                                    echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';  
                                                                                }
                                                                            }
                                                                        ?>                                              
                                                                    </select><br>
                                                                    <label>Email:</label>
                                                                    <input class="form-control" name="correo" value="<?php echo $row['correo']; ?>" autocomplete="off" required><br>
                                                                     <label>Estado</label>
                                                                     <select class="form-control" name="estado">
                                                                            <option value="s" <?php if($row['estado']=='s'){ echo 'selected'; } ?>>ACTIVO</option>
                                                                            <option value="n" <?php if($row['estado']=='n'){ echo 'selected'; } ?>>NO ACTIVO</option>
                                                                    </select><br><br>
                                                                    <div align="right">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                                </div>                                                                        
                                                                </div>                                                                        
                                                            </div> 
                                                            </div> 
                                                            <div class="modal-footer">
                                                                
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
    <!-- VALIDACIONES -->
    <script src="../../assets/js/jasny-bootstrap.min.js"></script>   
</body>
</html>
