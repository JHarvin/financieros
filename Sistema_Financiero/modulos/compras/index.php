<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../proveedor/class/class.php";
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
        mysql_query("DELETE FROM cajacom_tmp WHERE articulo='$id'");
        header('location:index.php');
    }
    if(!empty($_GET['delx'])){
        $id=$_GET['delx'];
        mysql_query("DELETE FROM prov_tmp WHERE proveedor='$id'");
        header('location:index.php');
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
            <?php include_once "../../menu/m_compra.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <?php if(permiso($_SESSION['cod_user'],'8')==TRUE){ ?>
               <!--  Modals-->
                                 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <form name="form1" method="post" action="">                                       
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                        <div class="panel-body">
                                        <div class="row">
                                            <ul class="nav nav-tabs nav-justified">
                                            <li class="active"><a href="#proveedor" data-toggle="tab"><i class="glyphicon glyphicon-book" ></i> DATOS PROVEEDOR</a></li>
                                            <li class="" ><a href="#contac" data-toggle="tab"><i class="glyphicon glyphicon-user" ></i> CONTACTO</a></li>                                                                                                                                                                                                                               
                                            </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade active in" id="proveedor">
                                                        <br>
                                                         <div class="col-md-12">
                                                        <br>
                                                        <input class="form-control" title="Se necesita un nombre"  name="nombre" placeholder="Nombre Completo" autocomplete="off" required><br>
                                                        <input class="form-control" title="Se necesita una Direccion" name="dir" placeholder="Procedencia"  autocomplete="off" required><br>  
                                                        </div>                                          
                                                           <div class="col-md-6">
                                                             <input class="form-control" name="nit" title="Se necesita un NIT" data-mask="9999-999999-999-9" placeholder="NIT" autocomplete="off" required><br>
                                                            <input class="form-control" name="tel" title="Se necesita un Telefono" data-mask="9999-9999" placeholder="Telefono" autocomplete="off" required><br>                                                                                                                                                                             
                                                            </div>
                                                            <div class="col-md-6">                                                     
                                                              <input class="form-control" name="fax" title="Se necesita un Fax" data-mask="9999-9999" placeholder="Fax" autocomplete="off" required><br>
                                                               <div class="input-group">
                                                                  <span class="input-group-addon">Estado</span>
                                                                  <select class="form-control" name="estado" autocomplete="off" required>
                                                                    <option value="s">Activo</option>
                                                                    <option value="n">No Activo</option>                                            
                                                                </select>                                               
                                                                </div>
                                                            </div>                      
                                                    </div>
                                                     <div class="tab-pane fade" id="contac">
                                                        <br>
                                                         <div class="col-md-12">
                                                        <input class="form-control" title="Nombre de Contacto"  name="contacto" placeholder="Nombre de Contacto" autocomplete="off" required><br>                                                        
                                                        </div>                                        
                                                        <div class="col-md-6">                                                                                   
                                                           <input class="form-control" name="email" title="Se necesita un email"  placeholder="Email" autocomplete="off" required><br>
                                                           <input class="form-control" name="tel_fijo" title="Se necesita un Telefono" data-mask="9999-9999" placeholder="Telefono Fijo" autocomplete="off" required><br>                                                                                     
                                                        </div>
                                                        <div class="col-md-6">
                                                          <input class="form-control" name="cel" title="Se necesita un Telefono" data-mask="9999-9999" placeholder="Telefono Cel." autocomplete="off" required><br>  
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
                      <?php 
                                    if(!empty($_POST['nombre'])){                                               
                                        $nombre=limpiar($_POST['nombre']);
                                        $dir=limpiar($_POST['dir']); 
                                        $nit=limpiar($_POST['nit']); 
                                        $tel=limpiar($_POST['tel']); 
                                        $fax=limpiar($_POST['fax']); 
                                        $contacto=limpiar($_POST['contacto']); 
                                        $email=limpiar($_POST['email']); 
                                        $tel_fijo=limpiar($_POST['tel_fijo']);
                                        $cel=limpiar($_POST['cel']);                                                                                                           
                                        $estado=limpiar($_POST['estado']);
                                        
                                        if(empty($_POST['id'])){
                                            $oProveedor=new Proceso_Proveedor('',$nombre,$dir,$nit,$tel,$fax,$contacto,$email,$tel_fijo,$cel,$estado);
                                            $oProveedor->crear();
                                            echo mensajes('Proveedor "'.$nombre.'" Creado con Exito','verde');
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oProveedor=new Proceso_Proveedor($id,$nombre,$dir,$nit,$tel,$fax,$contacto,$email,$tel_fijo,$cel,$estado);
                                            $oProveedor->actualizar();
                                            echo mensajes('Proveedor "'.$nombre.'" Actualizado con Exito','verde');
                                        }
                                    }
                                ?>
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-success">
                        <div class="panel-heading">
                             NUEVA COMPRA
                        </div>
                        <div class="panel-body">
             <div class="col-md-8">
			 <div class="alert alert-default" align="center">                           
                            <form name="form2" action="" method="post">
                                     <div class="input-group">
                                    <span class="input-group-addon">PROVEEDOR:</span>
                                    <input type="text" list="browsers1" name="buscar_cliente" autocomplete="off" class="form-control" required>
                                    <datalist id="browsers1">
                                        <?php
                                            $pa=mysql_query("SELECT * FROM proveedor 
                                            WHERE proveedor.id");                
                                            while($row=mysql_fetch_array($pa)){
                                                echo '<option value="'.$row['nombre'].'">';                                          
                                            }
                                        ?> 
                                    </datalist>
                                    </div>
                                </form>
                    </div>
                 
                </div>
                <div class="col-md-4">
                         <div class="panel-body" align="center">                                                                                 
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-2x"></i>
                            </button>
                            </button>
                                                                                                            
                  </div>
                </div>
                 <div class="col-md-12">
                    <?php
                    if(!empty($_POST['fecha'])){
                        $fecha=limpiar($_POST['fecha']);
                        $ncodigof=limpiar($_POST['ncodigof']);
                        mysql_query("UPDATE prov_tmp SET fecha='$fecha' WHERE proveedor='$ncodigof' and usu='$usu'");
                    }
                    
                    if(!empty($_POST['status'])){
                        $status=limpiar($_POST['status']);
                        $ncodigos=limpiar($_POST['ncodigos']);
                        mysql_query("UPDATE prov_tmp SET status='$status' WHERE proveedor='$ncodigos' and usu='$usu'");
                    }
                    
                    if(!empty($_POST['status'])){
                        $statusx=limpiar($_POST['status']);
                        $ncodigos=limpiar($_POST['ncodigos']);
                        mysql_query("UPDATE prov_tmp SET status='$statusx' WHERE proveedor='$ncodigos' and usu='$usu'");
                    }
                
                    if(!empty($_POST['buscar_cliente'])){
                        $buscarc=limpiar($_POST['buscar_cliente']);
                        $poa=mysql_query("SELECT proveedor.id, proveedor.tel FROM proveedor 
                        WHERE (proveedor.id='$buscarc' or proveedor.nombre='$buscarc' or proveedor.tel='$buscarc' ) GROUP BY proveedor.nombre");  
                        if($roow=mysql_fetch_array($poa)){
                            $codigoo=$roow['id'];
                            #$oRuta=new Consultar_Ruta($roow['ruta']);
                            $pa=mysql_query("SELECT * FROM prov_tmp WHERE proveedor='$codigoo' and usu='$usu' and rut=''");    
                            if($row=mysql_fetch_array($pa)){
                                
                                mysql_query("UPDATE prov_tmp SET fecha='$fecha' WHERE proveedor='$codigoo' and usu='$usu'");
                            }else{
                                mysql_query("INSERT INTO prov_tmp (proveedor, fecha, usu) VALUES ('$codigoo','$fecha','$usu')");   
                            }
                        }else{
                            echo mensajes('El Proveedor que Busca no se encuentra Registrado en la Base de Datos','rojo');    
                        }
                    }                                                           
                ?>
                 <!-- /. ROW  -->
            </div>
               
            <div class="row">
                <div class="col-md-12">
                        <?php 
                                $neto=0;$item=0;
                                $pa=mysql_query("SELECT * FROM prov_tmp, proveedor WHERE prov_tmp.usu='$usu' and prov_tmp.proveedor=proveedor.id");                
                                while($row=mysql_fetch_array($pa)){
                                    ############# FECHA ######################
                                    if($row['fecha']==NULL){
                                        
                                        #$oRuta->consultar('nombre');
                                        $fecha=$fecha;
                                    }else{
                                        $fecha=$row['fecha'];
                                        
                                    }
                                    ############# DIR ######################
                                    if($row['dir']==NULL){
                                        
                                         $dir=$row['dir'];
                                    }else{
                                        $dir=$row['dir'];
                                        
                                    }
                                    ############# STATUS BASIC ######################
                                    if($row['status']==NULL){
                                        
                                         $statusx='CONTADO';
                                    }else{
                                        $statusx=$row['status'];
                                        
                                    }
                                    ############# STATUS FULL ######################
                                    if($row['status']==NULL){
                                        
                                         $status='<a href="#" role="button" class="btn btn-warning" data-toggle="modal" title="Cambiar Status">
                                                            <strong>CONTADO</strong>
                                                    </a> ';
                                    }else{
                                        $status=$row['status'];
                                        
                                    }
                                    
                                    $pame=strftime( "%Y-%m-%d-%H-%M-%S", time() );                                      
                                    if($row['fecha']==$pame){
                                                    $status='si';
                                                }                                                                                               
                                                elseif($row['fecha']>$pame){
                                                    $status='<a href="#" role="button" class="btn btn-danger" data-toggle="modal" title="Cambiar Status">
                                                                <strong>CREDITO</strong>
                                                        </a> ';
                                                }
                                    
                            ?>
                                <div class="col-md-6">
                                    <form class="form-horizontal" role="form">

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nombre:</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" readonly="" value="<?php echo $row['nombre']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Precedencia:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" disabled="" value="<?php echo $dir; ?>" name="dir">
                                            </div>
                                        </div>
                                    </form>
                            </div>
                             <div class="col-md-6">
                                    <form class="form-horizontal" role="form">

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Fecha:</label>
                                                <div class="input-group m-t-10">
                                                    <input type="email" id="example-input2-group2" value="<?php echo fecha($fecha); ?>" name="example-input2-group2" class="form-control" disabled="">
                                                    <span class="input-group-btn">
                                            
                                            <a href="#fecha<?php echo $row['id']; ?>" role="button" class="btn btn-primary" data-toggle="modal" title="Cambiar Fecha">
                                                                        <strong>Cambiar</strong>
                                            </a>    
                                            </span>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group" align="center">
                                            <div class="col-md-6">
                                                 <a href="index.php?delx=<?php echo $row['id']; ?>"  class="btn btn-danger" title="Eliminar">
                                            <i class="fa fa-times" ></i>
                                        </a>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                             <!--  Modals-->
                                 <div class="modal fade" id="fecha<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="form1" method="post" action="">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                    
                                                        <h3 align="center" class="modal-title" id="myModalLabel">Cambiar Fecha de Compra<br>[<?php echo $row['nombre']; ?>]</h3>
                                                    </div>
                                        <div class="panel-body">
                                        <div class="row" align="center">
                                            <div class="col-md-3" > 
                                            
                                            </div>
                                            <div class="col-md-6" >                                         
                                                <input type="hidden" name="ncodigof" value="<?php echo $row['id']; ?>">
                                                <strong>Nueva Fecha</strong><br>
                                                <input type="date" class="form-control" name="fecha" min="1" value="<?php echo $row['fecha'] ?>" autocomplete="off" required>
                                            </div>                                                                                                              
                                        </div> 
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>                                       
                                    </div>
                                </div>
                                </form>
                            </div>
                     <!-- End Modals-->
                     <!--  Modals-->
                                 <div class="modal fade" id="status<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="form1" method="post" action="">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                    
                                                        <h3 align="center" class="modal-title" id="myModalLabel">Cambiar Tipo<br>[<?php echo $row['nombre']; ?>]</h3>
                                                    </div>
                                        <div class="panel-body">
                                         <div class="alert alert-danger">
                                                <h4>¿Esta Seguro de Cambiar esta operación?<br> 
                                                </h4>
                                            </div>  
                                        <div class="row" align="center">
                                            <div class="col-md-3" > 
                                            
                                                </div>
                                            <div class="col-md-6" >                                             
                                                <select class="form-control" name="status" value="<?php echo $row['rut']; ?>">
                                                    <option value="CREDITO">CREDITO</option>
                                                    <option value="CONTADO">CONTADO</option>
                                                </select>                                               
                                                <input type="hidden" name="ncodigos" value="<?php echo $row['id']; ?>">                                                                                             
                                            </div>                                                                                                              
                                        </div> 
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>                                       
                                    </div>
                                </div>
                                </form>
                            </div>
                     <!-- End Modals-->                                                                                               
                            <?php } ?>
                       
<div class="col-md-12">
<!--######################################## ARTICULOS ############################################################################################## -->
                    <div class="alert alert-success" align="center">                
                            <form name="form2" action="" method="post">
                                     <div class="input-group">
                                    <span class="input-group-addon">ARTICULO:</span>
                                    <input type="text" autofocus list="browsers" name="buscar" autocomplete="off" class="form-control" required>
                                    <datalist id="browsers">
                                        <?php
                                            $pa=mysql_query("SELECT articulos.nombre FROM inventario, articulos 
                                            WHERE articulos.codigo=inventario.codigo and inventario.almacen='$id_almacen'");               
                                            while($row=mysql_fetch_array($pa)){
                                                echo '<option value="'.$row['nombre'].'">';
                                            }
                                        ?> 
                                    </datalist>
                                     </div>
                            </form>
                    </div>
                    <?php
                    if(!empty($_POST['new_cant'])){
                        $new_cant=limpiar($_POST['new_cant']);
                        $ncodigo=limpiar($_POST['ncodigo']);
                        mysql_query("UPDATE cajacom_tmp SET cant='$new_cant' WHERE articulo='$ncodigo' and usu='$usu'");
                    }
                     if(!empty($_POST['new_pv'])){
                        $new_pv=limpiar($_POST['new_pv']);
                        $pvcodigo=limpiar($_POST['pvcodigo']);
                        mysql_query("UPDATE cajacom_tmp SET p_compra='$new_pv' WHERE articulo='$pvcodigo' and usu='$usu'");
                    }
                    
                    if(!empty($_POST['ncodigo_ref'])){
                        $referencia=limpiar($_POST['referencia']);
                        $ref_ant=limpiar($_POST['ref_ant']);
                        $ncodigo=limpiar($_POST['ncodigo_ref']);
                        
                        if($referencia==''){
                            mysql_query("UPDATE cajacom_tmp SET ref='' WHERE articulo='$ncodigo' and usu='$usu' and ref='$ref_ant'");
                        }else{
                            $pa=mysql_query("SELECT * FROM cajacom_tmp WHERE cajacom_tmp.ref='$referencia'");             
                            if($row=mysql_fetch_array($pa)){
                                echo mensajes('El Numero de Referencia "'.$referencia.'" Esta siendo usada','rojo');
                            }else{
                                mysql_query("UPDATE cajacom_tmp SET ref='$referencia' WHERE articulo='$ncodigo' and usu='$usu' and ref='$ref_ant'");
                            }
                        }
                        
                    }   

                    if(!empty($_POST['buscar'])){
                        $buscar=limpiar($_POST['buscar']);
                        $poa=mysql_query("SELECT articulos.id FROM articulos 
                        WHERE (articulos.id LIKE '$buscar%' or articulos.nombre LIKE '$buscar%'  or articulos.codigo LIKE '$buscar%') GROUP BY articulos.nombre");   
                        if($roow=mysql_fetch_array($poa)){
                            $codigo=$roow['id'];
                            $pa=mysql_query("SELECT * FROM cajacom_tmp WHERE articulo='$codigo' and usu='$usu' and ref=''");   
                            if($row=mysql_fetch_array($pa)){
                                $cant=$row['cant']+1;
                                mysql_query("UPDATE cajacom_tmp SET cant='$cant' WHERE articulo='$codigo' and usu='$usu'");
                            }else{
                                mysql_query("INSERT INTO cajacom_tmp (articulo, cant, usu) VALUES ('$codigo','1','$usu')");    
                            }
                        }else{
                            echo mensajes('El Producto que Busca no se encuentra Registrado en la Base de Datos','rojo');   
                        }
                    }                                                           
                ?>
                <div class="table-responsive">                                
                        <table class="table table-striped">
                            <tr class="well-dos">
                                <td><strong>CODIGO</strong></td>
                                <!--<td><strong>Referencia</strong></td>-->
                                <td><strong>PRODUCTO</strong></td>
                                <td><strong><center>CANT.</center></strong></td>
                                <td><strong><div align="right">COSTO</div></strong></td>
                                <td><strong><div align="right">TOTAL</div></strong></td>
                                <td></td>
                            </tr>
                            <?php 
                                $neto=0;$item=0;
                                $pa=mysql_query("SELECT * FROM cajacom_tmp, articulos WHERE cajacom_tmp.usu='$usu' and cajacom_tmp.articulo=articulos.id");              
                                while($row=mysql_fetch_array($pa)){
                                    $item=$item+$row['cant'];                                   
                                    $defecto=strtolower($row['valor']);
                                    $valor=$row['valor'];                                    
                                    ########################################
                                    if($row['ref']==NULL){
                                        $referencia='Sin Referencia';
                                    }else{
                                        $referencia=$row['ref'];
                                    }

                                    if($row['p_compra']==NULL){
                                        $new=$row['valor'];
                                    }else{
                                        $new=$row['p_compra'];
                                    }
                                    ###############CALCULOS TOTALES#########################
                                    $importe=$row['cant']*$new;
                                    $neto=$neto+$importe;
                                    $oArticulo=new Consultar_Articulos($row['articulo']);
                            ?>
                            <tr>
                             <td align="center"><span class="label label-info"> <?php echo $row['codigo']; ?></span></td>                                                             
                                <td><?php echo $oArticulo->consultar('nombre');  ?></td>
                                <td>
                                    <center>
                                        <a href="#m<?php echo $row['articulo']; ?>" role="button" class="btn btn-success btn-mini" data-toggle="modal" title="Cambiar Cantidad">
                                            <strong><?php echo $row['cant']; ?></strong>
                                        </a>
                                    </center>
                                </td>
                                <td>
                                 <center>
                                        <a href="#p<?php echo $row['articulo']; ?>" role="button" class="btn btn-primary btn-mini" data-toggle="modal" title="Cambiar Costo">
                                            <strong><?php echo $s.' '.formato($new); ?></strong>
                                        </a>
                                </center>
                                </td>
                                <td><div align="right"><?php echo $s.' '.formato($importe); ?></div></td>                                
                                <td>
                                    <center>                           
                                        <a href="index.php?del=<?php echo $row['articulo']; ?>"  class="btn btn-danger" title="Eliminar">
                                            <i class="fa fa-times" ></i>
                                        </a>
                                    </center>
                                </td>
                            </tr>                                                       
                            </div>
                      <!--  Modals-->
                                 <div class="modal fade" id="m<?php echo $row['articulo']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="form1" method="post" action="">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                    
                                                        <h3 align="center" class="modal-title" id="myModalLabel">Actualizar Cantidad<br>[<?php echo $oArticulo->consultar('nombre');  ?>]</h3>
                                                    </div>
                                        <div class="panel-body">
                                        <div class="row" align="center">
                                            <div class="col-md-3" > 
                                            
                                            </div>
                                            <div class="col-md-6" >                                         
                                                <input type="hidden" name="ncodigo" value="<?php echo $row['articulo']; ?>">
                                                <strong>Nueva Cantidad</strong><br>
                                                <input type="number"  class="form-control" name="new_cant" min="1" value="<?php echo $row['cant'] ?>" autocomplete="off" required>
                                            </div>                                                                                                              
                                        </div> 
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Actualizar Cantidad</button>
                                        </div>                                       
                                    </div>
                                </div>
                                </form>
                            </div>
                     <!-- End Modals-->
                      <!--  Modals-->
                                 <div class="modal fade" id="p<?php echo $row['articulo']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="form1" method="post" action="">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                    
                                                        <h3 align="center" class="modal-title" id="myModalLabel">Cambiar Precio<br>[<?php echo $oArticulo->consultar('nombre');  ?>]</h3>
                                                    </div>
                                        <div class="panel-body">
                                        <div class="row" align="center">
                                            <div class="col-md-3" > 
                                            
                                            </div>
                                            <div class="col-md-6" >                                         
                                                <input type="hidden" name="pvcodigo" value="<?php echo $row['articulo']; ?>">
                                                <strong>Nuevo Precio</strong><br>
                                                <input type="number"  class="form-control" name="new_pv" min="0" step="any" value="<?php echo $row['p_compra'] ?>" autocomplete="off" required>
                                            </div>                                                                                                              
                                        </div> 
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Actualizar Precio</button>
                                        </div>                                       
                                    </div>
                                </div>
                                </form>
                            </div>
                     <!-- End Modals-->                                                                                                     
                            <?php } ?>
                        </table>                                
                    </div>
                    <!-- COBROS -->
                    <div class="span4">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <center><strong>TOTAL</strong>
                                    <pre><h2 class="text-success" align="center">$ <?php echo formato($neto); ?></h2></pre>
                                    
                                </td>
                            </tr>
                        </table>
                        <?php if($neto<>0){ ?>
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div align="center">
                                        <a href="#contado" role="button" class="btn btn-primary btn-lg" data-toggle="modal">
                                            <i class="icon-shopping-cart icon-white"></i> <strong>Realizar Operación</strong>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <?php } ?>
                    </div>
                    <!--  Modals-->
                                 <div class="modal fade" id="contado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="contado" action="pro_contado.php" method="get">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                    
                                                        <h3 align="center" class="modal-title" id="myModalLabel">Seguridad</h3>
                                                    </div>
                                        <div class="panel-body">
                                        <div class="row" align="center">                                       
                                                                                    
                                            <strong>Hola! <?php echo $cajero_nombre; ?></strong><br>
                                             <div class="alert alert-danger">
                                                <h4>¿Esta Seguro de Procesar esta operación?<br> 
                                                una vez completada no podra ser editada.</h4>
                                            </div>
                                               <div class="col-md-3">
                                               </div>
                                              <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">Forma de Pago</span>
                                               <select class="form-control" name="pago">
                                                    <option value="CONTADO">CONTADO</option>
                                                    <option value="CREDITO">CREDITO</option>
                                                </select>                                               
                                             </div><br>
                                             </div>                                           
                                            <input type="hidden" value="<?php echo $neto; ?>" name="valor_recibido">
                                            <input type="hidden" value="<?php echo $neto; ?>" name="neto">  
                                                                                                                                                        
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
                </div>
            </div>
            </div>
            </div>
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
