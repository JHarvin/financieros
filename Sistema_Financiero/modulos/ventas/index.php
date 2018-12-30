<?php 
    session_start();
    include_once "../php_conexion.php";
    include_once "../clientes/class/class.php";
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
            $iva=$row['iva'];
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
        mysql_query("DELETE FROM caja_tmp WHERE articulo='$id'");
        header('location:index.php');
    }
    if(!empty($_GET['delx'])){
        $id=$_GET['delx'];
        mysql_query("DELETE FROM cliente_tmp WHERE cliente='$id'");
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
            <?php include_once "../../menu/m_venta.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
<?php if(permiso($_SESSION['cod_user'],'7')==TRUE){ ?>
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
                                                             <input class="form-control" name="tel" title="Se necesita un Telefono"  data-mask="<?php echo $ftel; ?>" placeholder="Telefono" autocomplete="off"><br>                                                            
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
                                                                    <option value="m">Masculino</option>
                                                                    <option value="f">Femenino</option>
                                                                    <option value="i">INSTITUCION</option>                                            
                                                                </select>                                               
                                                                </div><br>
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
                           <!-- End Modals-->
                        <div class="modal fade" id="consultas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">                                                   
                            <form name="contado">                                                                               
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-body">
                                 <?php if(permiso($_SESSION['cod_user'],'7')==TRUE){ ?>
                                <br>                                
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                          <tr class="info">
                                            <td><strong>ARTICULOS</strong></td>
                                            <td><strong>STOCK</strong></td>
                                            <td><strong>P.VENTA</strong></td>
                                            <td><strong>P.MAYOREO</strong></td>
                                             <td><strong>UBICACION</strong></td>
                                            <td><strong>MARCA</strong></td>
                                          </tr>
                                <thead>
                                <tbody>
                                          <?php 
                                           $pa=mysql_query("SELECT articulos.nombre,articulos.estante,articulos.marca,articulos.modelo,articulos.estante,articulos.marca, inventario.stock,inventario.pv,inventario.pmy FROM inventario, articulos 
                                            WHERE articulos.codigo=inventario.codigo and inventario.almacen='$id_almacen'");               
                                            while($dato=mysql_fetch_array($pa)){
                                            
                                             $oTipo=new Consultar_Tipo($dato['estante']);
                                            $oMarca=new Consultar_Marca($dato['marca']);
                                                
                                          ?>
                                          <tr>
                                            <td><?php echo $dato['nombre']; ?></td>
                                            <td><center><?php echo $dato['stock']; ?></center></td>
                                            <td><center><?php echo $s.' '.formato($dato['pv']); ?></center></td>
                                            <td><center><?php echo $s.' '.formato($dato['pmy']); ?></center></td>
                                            <td><?php echo $dato['estante']; ?></td>
                                            <td><?php echo $oMarca->consultar('nombre');  ?></td> 
                                          </tr>
                                          <?php } ?>
                                </tbody>
                                </table>                                                                                                                                                                                                                                                                                                                                                                                                                        
                                <?php }else{ echo mensajes("NO TIENES PERMISO PARA REALIZAR ESTA ACCION","rojo"); }?>
                                </div>                      
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                                                                                                      
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
                                        $dui=limpiar($_POST['dui']);
                                        $sexo=limpiar($_POST['sexo']);  
                                        $tel=limpiar($_POST['tel']); 
                                        $nrc=limpiar($_POST['nrc']);                                                                                                         
                                        $estado=limpiar($_POST['estado']);
                                        $tipo='consumidor';
                                        
                                        if(empty($_POST['id'])){
                                            $oCliente=new Proceso_Cliente('',$nombre,$dir,$dui,$sexo,$tel,$nrc,$estado,$tipo);
                                            $oCliente->crear();
                                            echo mensajes('Cliente "'.$nombre.'" Creado con Exito','verde');
                                            #mysql_query("INSERT INTO  cliente_tmp (cliente, fecha, usu) VALUES ('$id','$fecha','$usu')");
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oCliente=new Proceso_Cliente($id,$nombre,$dir,$dui,$sexo,$tel,$nrc,$estado,$tipo);
                                            $oCliente->actualizar();
                                            echo mensajes('Cliente "'.$nombre.'" Actualizado con Exito','verde');
                                        }
                                    }
                                ?>
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             CONSUMIDOR FINAL
                        </div>
                        <div class="panel-body">
             <div class="col-md-8">
			 <div class="alert alert-default" align="center">                           
                            <form name="form2" action="" method="post">
                                     <div class="input-group">
                                    <span class="input-group-addon">CLIENTE:</span>
                                    <input type="text" list="browsers1" name="buscar_cliente" autocomplete="off" class="form-control" required>
                                    <datalist id="browsers1">
                                        <?php
                                            $pa=mysql_query("SELECT * FROM clientes 
                                            WHERE clientes.id");                
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
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-2x" title="Agregar Nuevo Cliente"></i>
                            </button>

                                                                                                        
                  </div>
                </div>
                 <div class="col-md-12">
                    <?php
                    if(!empty($_POST['fecha'])){
                        $fecha=limpiar($_POST['fecha']);
                        $ncodigof=limpiar($_POST['ncodigof']);
                        mysql_query("UPDATE cliente_tmp SET fecha='$fecha' WHERE cliente='$ncodigof' and usu='$usu'");
                    }
                    
                    if(!empty($_POST['status'])){
                        $status=limpiar($_POST['status']);
                        $ncodigos=limpiar($_POST['ncodigos']);
                        mysql_query("UPDATE cliente_tmp SET status='$status' WHERE cliente='$ncodigos' and usu='$usu'");
                    }
                    
                    if(!empty($_POST['status'])){
                        $statusx=limpiar($_POST['status']);
                        $ncodigos=limpiar($_POST['ncodigos']);
                        mysql_query("UPDATE cliente_tmp SET status='$statusx' WHERE cliente='$ncodigos' and usu='$usu'");
                    }
                
                    if(!empty($_POST['buscar_cliente'])){
                        $buscarc=limpiar($_POST['buscar_cliente']);
                        $poa=mysql_query("SELECT clientes.id, clientes.tel FROM clientes 
                        WHERE (clientes.id='$buscarc' or clientes.nombre='$buscarc' or clientes.tel='$buscarc' or clientes.dui='$buscarc' ) GROUP BY clientes.nombre");  
                        if($roow=mysql_fetch_array($poa)){
                            $codigoo=$roow['id'];
                            #$oRuta=new Consultar_Ruta($roow['ruta']);
                            $pa=mysql_query("SELECT * FROM cliente_tmp WHERE cliente='$codigoo' and usu='$usu' and rut=''");    
                            if($row=mysql_fetch_array($pa)){
                                
                                mysql_query("UPDATE cliente_tmp SET fecha='$fecha' WHERE cliente='$codigoo' and usu='$usu'");
                            }else{
                                mysql_query("INSERT INTO cliente_tmp (cliente, fecha, usu) VALUES ('$codigoo','$fecha','$usu')");   
                            }
                        }else{
                            echo mensajes('El Cliente que Busca no se encuentra Registrado en la Base de Datos','rojo');    
                        }
                    }                                                           
                ?>
                 <!-- /. ROW  -->
            </div>
               
            <div class="row">
                <div class="col-md-12">
               
                        <?php 
                                $neto=0;$item=0;
                                $pa=mysql_query("SELECT * FROM cliente_tmp, clientes WHERE cliente_tmp.usu='$usu' and cliente_tmp.cliente=clientes.id");                
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
                                        
                                         $dir=$row['direcciona'];
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
                                                    <i class="fa fa-times" ></i> <strong>Eliminar Cliente</strong>
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
                                                        <h3 align="center" class="modal-title" id="myModalLabel">Cambiar Fecha de Entrega<br>[<?php echo $row['nombre']; ?>]</h3>
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
                                         <div class="alert alert-danger" align="center">
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
                                            $buscar=$_POST['buscar'];
                                            $in=mysql_query("SELECT * FROM inventario, articulos 
                                            WHERE articulos.id=inventario.articulo and inventario.almacen='$id_almacen'");               
                                            while($row=mysql_fetch_array($in)){
                                                echo '<option value="'.$row['nombre'].'">';
                                            }
                                        ?> 
                                    </datalist>
                                     </div>
                            </form>
                    </div>
                    <?php
                    ######### ACTUALIZACION DE LA CANTIDAD #############
                    if(!empty($_POST['new_cant'])){
                        $new_cant=limpiar($_POST['new_cant']);
                        $ncodigo=limpiar($_POST['ncodigo']);
                        $iv=mysql_query("SELECT * FROM inventario WHERE articulo='$ncodigo'");                
                        if($row=mysql_fetch_array($iv)){
                            $stock=$row['stock'];
                            if ($stock == 0 and $new_cant > $stock){
                                 $cantf='0';

                            }
                            else if ($stock == $row['stock_min'] and $new_cant > $row['stock_min']){
                                      $cantf=$stock;
                                      $oArticulo=new Consultar_Articulos($ncodigo);
                                      echo mensajes('El Articulo '.$oArticulo->consultar('nombre').' se encuentra en Existencia '.$stock.'','rojo');

                            }
                            else if ($stock >= $row['stock_min'] and $new_cant >= $row['stock']){
                                      $cantf=$stock;
                                      $oArticulo=new Consultar_Articulos($ncodigo);
                                      echo mensajes('El Articulo '.$oArticulo->consultar('nombre').' se encuentra con Existencia '.$stock.'','rojo');

                            }  
                            else {
                                $cantf=$new_cant;

                            }
                        } 

                        if ($stock==0) {
                            $cantfx='1';
                        }
                        else{
                             $cantfx=$new_cant;
                        }

                        mysql_query("UPDATE caja_tmp SET cant='$cantf' WHERE articulo='$ncodigo' and usu='$usu'");
                    }
                    ##########################################################
                    if(!empty($_POST['new_pv'])){
                        $new_pv=limpiar($_POST['new_pv']);
                        $especial=limpiar($_POST['especial']);
                        $pvcodigo=limpiar($_POST['pvcodigo']);
                        if ($new_pv=='n') {
                            $newp=$especial;
                        }
                        else{
                            $newp=$new_pv;
                        }

                        mysql_query("UPDATE caja_tmp SET p_mayor='$newp' WHERE articulo='$pvcodigo' and usu='$usu'");
                    }
                    
                    if(!empty($_POST['ncodigo_ref'])){
                        $referencia=limpiar($_POST['referencia']);
                        $ref_ant=limpiar($_POST['ref_ant']);
                        $ncodigo=limpiar($_POST['ncodigo_ref']);
                        
                        if($referencia==''){
                            mysql_query("UPDATE caja_tmp SET ref='' WHERE articulo='$ncodigo' and usu='$usu' and ref='$ref_ant'");
                        }else{
                            $pa=mysql_query("SELECT * FROM caja_tmp WHERE caja_tmp.ref='$referencia'");             
                            if($row=mysql_fetch_array($pa)){
                                echo mensajes('El Numero de Referencia "'.$referencia.'" Esta siendo usada','rojo');
                            }else{
                                mysql_query("UPDATE caja_tmp SET ref='$referencia' WHERE articulo='$ncodigo' and usu='$usu' and ref='$ref_ant'");
                            }
                        }
                        
                    } 
                    if(!empty($_POST['desc'])){
                        $desc=limpiar($_POST['desc']);
                        $ncodigod=limpiar($_POST['ncodigod']);
                         mysql_query("INSERT INTO desc_tmp (descuento, almacen, usu) VALUES ('$desc','$id_almacen','$usu')");
                    } 

                    if(!empty($_POST['buscar'])){
                        $buscar=limpiar($_POST['buscar']);
                        $pro=mysql_query("SELECT * FROM articulos 
                        WHERE (articulos.id LIKE '$buscar%' or articulos.nombre LIKE '$buscar%'  or articulos.codigo LIKE '$buscar%') GROUP BY articulos.nombre");   
                        if($roow=mysql_fetch_array($pro)){
                            $codigo=$roow['id'];

                        $i=mysql_query("SELECT * FROM inventario WHERE articulo='$codigo'");
                        if ($row=mysql_fetch_array($i)) {
                            if ($row['stock'] == 0) {
                                 $oArticulo=new Consultar_Articulos($codigo);
                                echo mensajes('El Articulo '.$oArticulo->consultar('nombre').' se encuentra con Existencia "0"','rojo');
                            }
                            else if ($row['stock'] <= $row['stock_min'] ) {
                                $oArticulo=new Consultar_Articulos($codigo);
                                 echo mensajes('El Articulo '.$oArticulo->consultar('nombre').' se encuentra con Existencia '.$row['stock'].'','rojo');
                                $pa=mysql_query("SELECT * FROM caja_tmp WHERE articulo='$codigo' and usu='$usu' and ref=''");   
                                    if($row=mysql_fetch_array($pa)){
                                        $cant=$row['cant'];
                                        mysql_query("UPDATE caja_tmp SET cant='$cant' WHERE articulo='$codigo' and usu='$usu'");
                                    }else{
                                        mysql_query("INSERT INTO caja_tmp (articulo, cant, usu) VALUES ('$codigo','1','$usu')");    
                                    }
                            }
                            else{
                                  $pa=mysql_query("SELECT * FROM caja_tmp WHERE articulo='$codigo' and usu='$usu' and ref=''");   
                                    if($row=mysql_fetch_array($pa)){
                                        $cant=$row['cant']+1;
                                        mysql_query("UPDATE caja_tmp SET cant='$cant' WHERE articulo='$codigo' and usu='$usu'");
                                    }else{
                                        mysql_query("INSERT INTO caja_tmp (articulo, cant, usu) VALUES ('$codigo','1','$usu')");    
                                    }

                            }
                           
                        }

                        }else
                        {
                            echo mensajes('El Producto que Busca no se encuentra Registrado en la Base de Datos','rojo');   
                        }
                    }                                                           
                ?>
                 <!--<?php
                    $descuento=''; 
                    $obs=mysql_query("SELECT * FROM desc_tmp WHERE almacen='$id_almacen'");               
                         if(!$rows=mysql_fetch_array($obs)){ 
                                    $obs='0';
                                }else{
                                    $obs=$rows['descuento'];
                                }
                                                                                                    
                ?>-->
                <div class="table-responsive">                                
                        <table class="table table-striped">
                            <tr class="well-dos">
                                <td><strong>CODIGO</strong></td>
                                <!--<td><strong>Referencia</strong></td>-->
                                <td><strong>PRODUCTO</strong></td>
                                <td><strong><center>CANT.</center></strong></td>
                                <td><strong><div align="right">P.VENTA</div></strong></td>
                                <td><strong><div align="right">TOTAL</div></strong></td>
                                <td></td>
                            </tr>
                            <?php 
                                $neto=0;$item=0;$total=0;
                                $pa=mysql_query("SELECT * FROM caja_tmp, inventario WHERE caja_tmp.usu='$usu' and caja_tmp.articulo=inventario.articulo");              
                                while($row=mysql_fetch_array($pa)){
                                    $item=$item+$row['cant'];                                   
                                    $defecto=strtolower($row['pv']);
                                    $valor=$row['pv'];

                                     ############### manejo de STOCK#########################
                                    if ($row['stock'] == 0) {
                                        $aviso=' <a href="#m'.$row['articulo'].'" role="button" class="btn btn-danger btn-mini" data-toggle="modal" title="Cambiar Cantidad" accesskey="c">
                                            <strong>Sin stock</strong>
                                        </a>';
                                    }
                                    else{
                                        $aviso=' <a href="#m'.$row['articulo'].'" role="button" class="btn btn-success btn-mini" data-toggle="modal" title="Cambiar Cantidad" accesskey="c">
                                            <strong>'.$row['cant'].'</strong>
                                        </a>';
                                    }
                                    ########################################
                                    if($row['ref']==NULL){
                                        $referencia='Sin Referencia';
                                    }else{
                                        $referencia=$row['ref'];
                                    }
                                     if($row['p_mayor']==NULL){
                                        $new=$row['pv'];
                                    }else{
                                        $new=$row['p_mayor'];
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
                                      <?php echo $aviso; ?>
                                    </center>
                                </td>
                                <td>
                                <div align="right">
                                        <a  href="#p<?php echo $row['articulo']; ?>" role="button" class="btn btn-primary btn-mini" data-toggle="modal" title="Cambiar Precio" accesskey="p">
                                            <strong><?php echo $s.' '.formato($new); ?></strong>
                                        </a>
                                </div>
                                </td>
                                <td><div align="right"><strong><?php echo $s.' '.formato($importe); ?></div></strong></td>                                
                                <td>
                                    <center>                           
                                        <a href="index.php?del=<?php echo $row['articulo']; ?>"  class="btn btn-danger" title="Eliminar">
                                            <i class="fa fa-times" ></i>
                                        </a>
                                    </center>
                                </td>
                            </tr>
                           
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
                                            <div class="col-md-4" > 
                                            
                                            </div>
                                            <div class="col-md-4" >                                         
                                                <input type="hidden" name="ncodigo" value="<?php echo $row['articulo']; ?>">
                                                <strong>Nueva Cantidad</strong><br>
                                                <input type="number" class="form-control" name="new_cant" min="1" value="<?php echo $row['cant'] ?>" autocomplete="off" required>
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
                                            <div class="col-md-6" >                                         
                                                <input type="hidden" name="pvcodigo" value="<?php echo $row['articulo']; ?>">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Precios</span>
                                                        <select class="form-control" name="new_pv" autocomplete="off" required>
                                                            <option value="n">---SELECCIONE---</option>
                                                            <option value="<?php echo $row['pmy'] ?>"><?php echo $s.' '.formato($row['pmy']) ?> [P.MAYOR]</option>
                                                            <option value="<?php echo $row['pv'] ?>"><?php echo $s.' '.formato($row['pv']) ?> [P.VENTA]</option>                                            
                                                        </select>                                               
                                                </div>
                                            </div>
                                             <div class="col-md-6" >                                         
                                                <div class="input-group">
                                                    <span class="input-group-addon">Precio Especial</span>
                                                        <input type="number" min="0" step="any" class="form-control" name="especial" autocomplete="off"><br>                                             
                                                </div>
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
                     <div class="table-responsive">
                        <table border="0" class="table">
                             <tr>
                                <td colspan="4"><div align="right"><strong>Sub Total</strong></div></td>
                                <td><div align="right"><strong>$ <?php echo formato($neto); ?></strong></div></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3"><div align="right">
                                     <?php
                                     $d=0;
                                     if(!empty($_GET['ddes'])){
                                        $ddes=limpiar($_GET['ddes']);
                                            if($ddes>=0){
                                                $d=$_GET['ddes'];    
                                            }
                                        }

                                            $descuento=$neto*$d/100;
                                            $total=$neto-$descuento;
                                        ?>
                                     <form name="form3" method="get" action="index.php">
                                                <button type="submit" class="btn btn-default">Aplicar Descuento</button></div>
                                </td>
                                 <td colspan="2" width="15%"><div align="right">
                                                <div class="input-group">
                                                    <span class="input-group-addon">%</span>
                                                    <input type="number" class="form-control" min="0" max="99" name="ddes" id="ddes" value="<?php echo $_SESSION['ddes']; ?>">
                                                </div></div>
                                    </form>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                    <td colspan="3"><div align="right">
                                     <?php
                                     $iv=0;
                                     if(!empty($_GET['iva'])){
                                        $iva=limpiar($_GET['iva']);
                                            if($iva>=0){
                                                $iv=$_GET['iva'];    
                                            }
                                        }

                                            $impuesto=$neto*$iv/100;
                                            
                                        ?>
                                     <form name="form3" method="get" action="index.php">
                                                <button type="submit" class="btn btn-default">Aplicar IVA</button></div>
                                </td>
                                 <td colspan="2" width="15%"><div align="right">
                                                <div class="input-group">
                                                    <span class="input-group-addon">%</span>
                                                    <input type="number" class="form-control" min="0" max="99" name="iva" id="iva" value="<?php echo $_SESSION['iva']; ?>">
                                                </div></div>
                                    </form>
                                </td>
                                <td></td>
                            </tr>                                                               
                            </div>
                        </table>
                    </div>
                    </div>
                    <div class="span4">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <center><strong>TOTAL</strong>
                                    <pre><h2 class="text-success" align="center">$ <?php echo formato($total+$impuesto); ?></h2></pre>
                                    
                                </td>
                            </tr>
                        </table>
                        <?php if($neto<>0){ ?>
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div align="center">
                                    <div class="row">
                                    <div class="col-md-6">
                                     <i class="fa fa-plus icon-white"></i> <strong>FORMA DE PAGO FACTURA</strong><br>
                                        <a href="#factura1" role="button" class="btn btn-primary btn-lg" data-toggle="modal">
                                            <i class="fa fa-list icon-white"></i> <strong>CONTADO</strong>
                                        </a>
                                        <a href="#factura2" role="button" class="btn btn-primary btn-lg" data-toggle="modal">
                                            <i class="fa fa-list icon-white"></i> <strong>CREDITO</strong>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                      <i class="fa fa-plus icon-white"></i> <strong>FORMA DE PAGO TIKET</strong><br>
                                       <a href="#ticket" role="button" class="btn btn-warning btn-lg" data-toggle="modal">
                                            <i class="fa fa-shopping-cart icon-white"></i> <strong>CONTADO</strong>
                                        </a> 
                                        <a href="#ticket2" role="button" class="btn btn-warning btn-lg" data-toggle="modal">
                                            <i class="fa fa-shopping-cart icon-white"></i> <strong>CREDITO</strong>
                                        </a> 
                                    </div>
                                        
                                    </div>
                                        
                                         
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <?php } ?>
                    </div>
                    <!--  Modals-->
                    <!--factura 1 para el contado-->
                                <div class="modal fade" id="factura1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="contado" action="pro_contado.php" method="get">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                        <div class="panel-body">
                                        <div class="row" align="center">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="panel panel-primary text-center no-boder bg-color-red">
                                                <div class="panel-footer back-footer-red">
                                                    TOTAL FACTURA
                                                </div>
                                                <div class="panel-body">
                                                    <div style=" bg-color: red;font-size:50px"><?php echo $s.' '.formato($total+$impuesto); ?></div>
                                                </div>                           
                                            </div>
                                        </div>                                       
                                            <br>
                                             <strong>Dinero Recibido</strong><br>
                                              <div class="col-md-3">
                                               </div>
                                              <div class="col-md-6">
                                             <div class="input-group">
                                                <span class="input-group-addon"><?php echo $s; ?></span>
                                                <input type="number" class="form-control input-lg" name="valor_recibido" required min="0" step="any" min="<?php echo $neto_full; ?>"  autocomplete="off" required><br>                                         
                                                <span class="input-group-addon">.00</span>
                                             </div><br>

                                              <div class="input-group">
                                                <span class="input-group-addon">Forma de Pago</span>
                                               <select class="form-control" name="pago">
                                                    <option value="CONTADO">CONTADO</option>
                                                </select>                                               
                                             </div><br>

                                            <!--<input type="hidden" value="<?php echo $neto; ?>" name="valor_recibido">-->
                                            <input type="hidden" value="<?php echo $total+$impuesto; ?>" name="neto">  
                                            <input type="hidden" value="<?php echo $impuesto; ?>" name="impuesto">  
                                           </div>                                                                                                              
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
                     <!-- End Modals para contado-->
                     <!--  Modals-->
                    <!--factura 1 para el credito-->
                                <div class="modal fade" id="factura2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="contado" action="pro_contado.php" method="get">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                        <div class="panel-body">
                                        <div class="row" align="center">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="panel panel-primary text-center no-boder bg-color-red">
                                                <div class="panel-footer back-footer-red">
                                                    TOTAL FACTURA
                                                </div>
                                                <div class="panel-body">
                                                    <div style=" bg-color: red;font-size:50px"><?php echo $s.' '.formato($total+$impuesto); ?></div>
                                                </div>                           
                                            </div>
                                        </div>                                       
                                            <br>
                                             <strong>PRIMA</strong><br>
                                              <div class="col-md-3">
                                               </div>
                                              <div class="col-md-6">
                                             <div class="input-group">
                                                <span class="input-group-addon"><?php echo $s; ?></span>
                                                <input type="number" class="form-control input-lg" name="valor_recibido" required min="0" step="any" min="<?php echo $neto_full; ?>"  autocomplete="off" required><br>                                         
                                                <span class="input-group-addon">.00</span>
                                             </div><br>

                                              <div class="input-group">
                                                <span class="input-group-addon">Forma de Pago</span>
                                               <select class="form-control" name="pago">
                                                    <option value="CREDITO">CREDITO</option>
                                                </select>                                               
                                             </div>
                                             <br>
                                              <div class="input-group">
                                                <span class="input-group-addon">MESES</span>
                                               <select class="form-control" name="mes">
                                                    <option value="6">6 MESES</option>
                                                     <option value="12">12 MESES</option>
                                                      <option value="18">18 MESES</option>
                                                       <option value="24">24 MESES</option>
                                                        <option value="30">30 MESES</option>
                                                         <option value="42">42 MESES</option>
                                                </select>                                              
                                             </div>
                                             <br>
                                              <div class="input-group">
                                              <span class="input-group-addon">INTERES</span>
                                                 <input type="number" class="form-control input-lg" name="interes" required min="0" step="any" min="<?php echo $neto_full; ?>"  autocomplete="off" required>                                         
                                                <span class="input-group-addon">.00</span>
                                              </div>
                                             

                                            <!--<input type="hidden" value="<?php echo $neto; ?>" name="valor_recibido">-->
                                            <input type="hidden" value="<?php echo $total+$impuesto; ?>" name="neto">  
                                            <input type="hidden" value="<?php echo $impuesto; ?>" name="impuesto">  
                                           </div>                                                                                                              
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
                     <!-- End Modals para contado-->
                      <!--  Modals-->
                                 <div class="modal fade" id="ticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="contado" action="pro_ticket.php" method="get">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                        <div class="panel-body">
                                        <div class="row" align="center">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="panel panel-primary text-center no-boder bg-color-red">
                                                <div class="panel-footer back-footer-red">
                                                    TOTAL TICKET
                                                </div>
                                                <div class="panel-body">
                                                    <div style=" bg-color: red;font-size:50px"><?php echo $s.' '.formato($total+$impuesto); ?></div>
                                                </div>                           
                                            </div>
                                        </div>                                       
                                            <br>
                                             <strong>Dinero Recibido</strong><br>
                                              <div class="col-md-3">
                                               </div>
                                              <div class="col-md-6">
                                             <div class="input-group">
                                                <span class="input-group-addon"><?php echo $s; ?></span>
                                                <input type="number" class="form-control input-lg" name="valor_recibido" required min="0" step="any" min="<?php echo $neto_full; ?>"  autocomplete="off" required><br>                                         
                                                <span class="input-group-addon">.00</span>
                                             </div><br>
                                              <div class="input-group">
                                                <span class="input-group-addon">Forma de Pago</span>
                                               <select class="form-control" name="pago">
                                                    <option value="CONTADO">CONTADO</option>
                                                </select>                                               
                                             </div><br>                                               
                                            <!--<input type="hidden" value="<?php echo $neto; ?>" name="valor_recibido">-->
                                            <input type="hidden" value="<?php echo $total+$impuesto; ?>" name="neto">  
                                           </div>                                                                                                              
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
                     <!--  Modals-->
                                 <div class="modal fade" id="ticket2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="contado" action="pro_ticket.php" method="get">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                        <div class="panel-body">
                                        <div class="row" align="center">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="panel panel-primary text-center no-boder bg-color-red">
                                                <div class="panel-footer back-footer-red">
                                                    TOTAL TICKET
                                                </div>
                                                <div class="panel-body">
                                                    <div style=" bg-color: red;font-size:50px"><?php echo $s.' '.formato($total+$impuesto); ?></div>
                                                </div>                           
                                            </div>
                                        </div>                                       
                                            <br>
                                             <strong>Dinero Recibido</strong><br>
                                              <div class="col-md-3">
                                               </div>
                                              <div class="col-md-6">
                                             <div class="input-group">
                                                <span class="input-group-addon"><?php echo $s; ?></span>
                                                <input type="number" class="form-control input-lg" name="valor_recibido" required min="0" step="any" min="<?php echo $neto_full; ?>"  autocomplete="off" required><br>                                         
                                                <span class="input-group-addon">.00</span>
                                             </div><br>
                                              
                                              <div class="input-group">
                                                <span class="input-group-addon">Forma de Pago</span>
                                               <select class="form-control" name="pago">
                                                    <option value="CREDITO">CREDITO</option>
                                                </select>                                               
                                             </div>
                                             <br>
                                              <div class="input-group">
                                                <span class="input-group-addon">MESES</span>
                                               <select class="form-control" name="mes">
                                                    <option value="6">6 MESES</option>
                                                     <option value="12">12 MESES</option>
                                                      <option value="18">18 MESES</option>
                                                       <option value="24">24 MESES</option>
                                                        <option value="30">30 MESES</option>
                                                         <option value="42">42 MESES</option>
                                                </select>                                              
                                             </div>
                                             <br>
                                              <div class="input-group">
                                              <span class="input-group-addon">INTERES</span>
                                                 <input type="number" class="form-control input-lg" name="interes" required min="0" step="any" min="<?php echo $neto_full; ?>"  autocomplete="off" required>                                         
                                                <span class="input-group-addon">.00</span>
                                              </div>
                                                                                            
                                            <!--<input type="hidden" value="<?php echo $neto; ?>" name="valor_recibido">-->
                                            <input type="hidden" value="<?php echo $total+$impuesto; ?>" name="neto">  
                                           </div>                                                                                                              
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
                <!-- /. ROW  -->

                </div>
                 </div>
                  </div>
                   </div>                 
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
    <script>
            $(document).ready(function () {
                $('#dataTables-examplex').dataTable();
            });
    </script>
         <!-- Custom Js -->
    <script src="../../assets/js/custom-scripts.js"></script>
    <!-- VALIDACIONES -->
    <script src="../../assets/js/jasny-bootstrap.min.js"></script>     
</body>
</html>
