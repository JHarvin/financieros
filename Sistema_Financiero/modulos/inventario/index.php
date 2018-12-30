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
        mysql_query("DELETE FROM inventario WHERE id='$id'");
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
            <?php include_once "../../menu/m_categoria.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <?php if(permiso($_SESSION['cod_user'],'6')==TRUE){ ?>            			 
                     <!--  Modals-->
                       <?php 

                                    if(!empty($_POST['codigo'])){
                                        $codigo=limpiar($_POST['codigo']);
                                        $nombre=limpiar($_POST['nombre']);
                                        $cat=limpiar($_POST['cat']);
                                        $und=limpiar($_POST['und']);
                                        $valor=limpiar($_POST['valor']);
                                        $detalle=limpiar($_POST['detalle']);                                                                                                          
                                        $estado=limpiar($_POST['estado']);
                                        $iva=limpiar($_POST['iva']);
                                        #tipo y marca
                                        $modelo=limpiar($_POST['modelo']);
                                        $estante=limpiar($_POST['estante']);
                                        $marca=limpiar($_POST['marca']);
                                        #stock y precios
                                        $almacen=limpiar($_POST['almacen']);
                                        $stock=limpiar($_POST['stock']);
                                        $stock_min=limpiar($_POST['stock_min']);                                        
                                        $pv=limpiar($_POST['pv']);
                                        $pmy=limpiar($_POST['pmy']);  

                                        /*$costo=limpiar($_POST['costo']);*/                               
                                        $oND=new Consultar_Deposito($almacen);
                                        $nom_depo=$oND->consultar('nombre');
                                        
                                        
                                        $oNDP=new Consultar_Articulos($codigo);
                                        $nom_Pdto=$oNDP->consultar('nombre');
                                        
                                        if(empty($_POST['id'])){
                                            $pa=mysql_query("SELECT * FROM articulos WHERE codigo='$codigo'");              
                                            if($row=mysql_fetch_array($pa)){
                                                echo mensajes('El Articulo "'.$nombre.'" Ya se Encuentra Registrado con el codigo "'.$codigo.'"','rojo');
                                            }else{
                                                $oArticulos=new Proceso_Articulos('',$codigo,$nombre,$cat,$und,$valor,$detalle,$estado,$iva,
                                                                                                   $modelo,$estante,$marca,
                                                                                                   $almacen,$stock,$stock_min,$pv,$pmy);
                                                $oArticulos->crear();                                               
                                                echo mensajes('El Articulo "'.$nombre.'" Ha sido Ingresado con Exito en el Almacen "'.$nom_depo.'"','verde');                                            
                                            }
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oArticulos=new Proceso_Articulos($id,$almacen,$stock,$stock_min,$pv,$pmy);
                                            $oArticulos->actualizar();                                           
                                            echo mensajes('El Articulo "'.$nombre.'" en el Deposito "'.$nom_depo.'" Actualizado con Exito','verde');
                                        }
                                        
                                    }
                                    if(!empty($_POST['stock']) and !empty($_POST['almacen']) and !empty($_POST['idx'])){
                                        $id=limpiar($_POST['idx']);
                                        $almacen=limpiar($_POST['almacen']);
                                        $stock=limpiar($_POST['stock']);
                                        $stock_min=limpiar($_POST['stock_min']);                                        
                                        $pv=limpiar($_POST['pv']);
                                        $pmy=limpiar($_POST['pmy']);                       
                                       mysql_query("UPDATE inventario SET almacen='$almacen',
                                                                             stock='$stock',
                                                                             stock_min='$stock_min',
                                                                             pv='$pv',
                                                                             pmy='$pmy' 
                                                                             WHERE id='$id'");
                                        echo mensajes('El Stock se ha  Actualizado con Exito','verde');
                                      }
                                ?>
                                 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <form name="form1" method="post" action="">
                                        <input type="hidden" name="id_prenatal" value="<?php echo $id_prenatal; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                        <div class="panel-body">
                                        <div class="row">
                                            <ul class="nav nav-tabs nav-justified">
                                            <li class="active"><a href="#datos" data-toggle="tab"><i class="glyphicon glyphicon-book" ></i> DATOS</a></li>
                                            <li class="" ><a href="#tipo" data-toggle="tab"><i class="glyphicon glyphicon-book" ></i> UBICACION</a></li>
                                            <li class="" ><a href="#stock" data-toggle="tab"><i class="glyphicon glyphicon-fullscreen" ></i> STOCK Y PRECIOS</a></li>                                                                                                                                                                                     
                                            </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade active in" id="datos">
                                                        <br>                                       
                                                        <div class="col-md-6">                                                                                   
                                                            <input class="form-control" name="codigo" placeholder="Codigo" autocomplete="off" required onKeyUp="this.value=this.value.toUpperCase();"><br>
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
                                                           <div class="input-group">
                                                          <span class="input-group-addon">IVA</span>
                                                          <select class="form-control" name="iva" autocomplete="off" required>
                                                            <option value="" selected disabled>---SELECCIONE---</option>
                                                            <option value="s">ACTIVO</option>
                                                            <option value="n">NO ACTIVO</option>                                            
                                                        </select>                                               
                                                        </div><br>  
                                                        </div>
                                                        <div class="col-md-6">
                                                        <div class="input-group">
                                                                <span class="input-group-addon">Marca:</span>
                                                                 <input class="form-control" name="marca" placeholder="Marca" autocomplete="off" required><br>                                         
                                                          </div><br>   
                                                        <input type="number" min="0" step="any" class="form-control" name="valor" placeholder="Precio de Compra" autocomplete="off" required><br>
                                                        <textarea class="form-control" name="detalle" placeholder="Detalle" rows="4" onKeyUp="this.value=this.value.toUpperCase();"></textarea><br>                                                                                                                                            
                                                        </div>                        
                                                    </div>
                                                     <div class="tab-pane fade" id="tipo">
                                                        <br>                                       
                                                        <div class="col-md-6">                                                                                   
                                                          <div class="input-group">
                                                                <span class="input-group-addon">Modelo:</span>
                                                                <input class="form-control" name="modelo"  autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();"><br>                                         
                                                          </div><br>                                  
                                                        </div>
                                                        <div class="col-md-6">
                                                                                                                                                                                                   
                                                           <div class="input-group">
                                                                <span class="input-group-addon">Estante:</span>
                                                                <input class="form-control" name="estante"  autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();"><br>                                         
                                                          </div><br>   
                                                        </div>                        
                                                    </div>
                                                    <div class="tab-pane fade" id="stock">                                                             
                                                        <br>
                                                        <div class="col-md-6">                                                                                                                              
                                                                    <div class="input-group">
                                                                      <span class="input-group-addon">Almacen</span>
                                                                      <select class="form-control" name="almacen" autocomplete="off" required>
                                                                      <option value="" selected disabled>---SELECCIONE---</option>
                                                                       <?php
                                                                            $sal=mysql_query("SELECT * FROM almacenes WHERE estado='s'");             
                                                                            while($col=mysql_fetch_array($sal)){
                                                                                echo '<option value="'.$col['id'].'">'.$col['nombre'].'</option>';
                                                                            }
                                                                        ?>                                         
                                                                    </select>                                               
                                                                    </div><br>
                                                                       <div class="input-group">
                                                                          <span class="input-group-addon">Stock</span>
                                                                          <input class="form-control" name="stock"  autocomplete="off" required><br>                                         
                                                                    </div><br>
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Stock Minimo</span>
                                                                          <input class="form-control" name="stock_min"  autocomplete="off" required><br>                                         
                                                                    </div><br>                                                                                                                                                                                                                                   
                                                                    </div>                                                                                    
                                                                <div class="col-md-6">                                                                                                                                        
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Precio venta</span>
                                                                          <input type="number" class="form-control" name="pv" min="0" step="any" autocomplete="off" required><br>                                         
                                                                    </div><br> 
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Precio Mayoreo</span>
                                                                          <input type="number" class="form-control" name="pmy" min="0" step="any" autocomplete="off" required><br>                                         
                                                                    </div><br>
                                                                    <div class="input-group">
                                                                      <span class="input-group-addon">Estado</span>
                                                                      <select class="form-control" name="estado" autocomplete="off" required>
                                                                        <option value="s">Activo</option>
                                                                        <option value="n">No Activo</option>                                            
                                                                    </select>                                               
                                                                    </div><br>                                                                                                                                                                                              
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
                          
 <div class="panel-body">
    <div class="row">
                    <div class="col-md-12">                        
                          <div class="panel-body" align="center">                                                                                 
                            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-2x" title="Agregar Articulo"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-circle" onClick="window.location='PDFinventario.php'"><i class="fa fa-list-alt fa-2x" title="Reporte PDF"></i>
                            </button>                                                                                   
                           </div>
                    </div>
        </div> 
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             INVENTARIO
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                              <table width="100%" border="0">
                                  <tr>
                                    <td width="50%">
                                        <div align="right">
                                        <form method="post" action="" enctype="multipart/form-data" name="form1" id="form1">
                                          <div class="input-group">
                                                 <input class="form-control" name="bus" type="text" class="span2" size="60" list="browsers1" autocomplete="off" placeholder="Buscar" autofocus>
                                                  <datalist id="browsers1">
                                                  <?php
                                                    $buscar=$_POST['bus'];
                                                    $can=mysql_query("SELECT * FROM articulos"); 
                                                    while($dato=mysql_fetch_array($can)){
                                                        echo '<option value="'.$dato['nombre'].'">';
                                                    }
                                                  ?>
                                              </datalist>
                                            </td>
                                            <td width="20%">
                                                <button class="btn" type="submit">Buscar</button>
                                          </div>
                                        </form>
                                        </div>
                                    </td>
                                  </tr>
                                </table><br>                           
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>CODIGO</th>
                                            <th>ARTICULO</th>
                                            <th>P.V</th>                                           
                                            <th>STOCK</th>
                                            <th></th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php                                             
                                                 #$pame=mysql_query("SELECT * FROM inventario INNER JOIN articulos ON articulos.id=inventario.articulo WHERE inventario.almacen='$id_almacen' ORDER BY articulos.id DESC LIMIT 10");
                                             if(empty($_POST['bus'])){
                                                $pame=mysql_query("SELECT * FROM inventario INNER JOIN articulos ON articulos.id=inventario.articulo WHERE inventario.almacen='$id_almacen' ORDER BY articulos.id DESC LIMIT 10");
                                            }else{
                                                $buscar=$_POST['bus'];
                                                $pame=mysql_query("SELECT * FROM inventario INNER JOIN articulos ON articulos.id=inventario.articulo WHERE articulos.nombre LIKE '$buscar%' or articulos.codigo LIKE '$buscar%'");
                                            }                                                         
                                            while($row=mysql_fetch_array($pame)){
                                                $oAlma=new Consultar_Deposito($row['almacen']);
                                                $oArticulos=new Consultar_Articulos($row['articulo']);
                                                $stock=$row['stock'];
                                                $stock_min=$row['stock_min'];
                                                $mensaje2='si';
                                                if($stock<=$stock_min){
                                                    $stockx='<span class="badge badge-important">'.$stock.'</span>';
                                                }else{
                                                    $stockx='<span class="badge badge-success">'.$stock.'</span>';
                                                }
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['codigo']; ?></td>
                                            <td><?php echo $oArticulos->consultar('nombre'); ?></td>
                                            <td><?php echo $s.' '.formato($row['pv']); ?></td>                                          
                                            <td><?php echo $stockx; ?></td>
                                            <td class="center">
                                                <a href="#edit<?php echo $row['id']; ?>" role="button" class="btn btn-warning btn-sm" data-toggle="modal">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="../detalle/kardex.php?detalle=<?php echo $row['id']; ?>" role="button" class="btn btn-info btn-sm" title="TARJETA KARDEX" data-toggle="modal">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                           <!--  Modals Editar-->
                                         <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <form name="form1" method="post" action="">
                                                <input type="hidden" name="idx" value="<?php echo $row['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h3 align="center" class="modal-title" id="myModalLabel">Editar</h3>
                                                            </div>
                                                            <div class="panel-body">
                                                            <?php if(permiso($_SESSION['cod_user'],'13')==TRUE){ ?>
                                                             <div class="row">
                                                             <div class="col-md-12"> 
                                                              <div class="alert alert-info" align="center"><strong> <?php echo $oArticulos->consultar('nombre'); ?></strong></div>
                                                              </div>                                                                                
                                                                <div class="col-md-6">                                                                                                                              
                                                                    <div class="input-group">
                                                                      <span class="input-group-addon">Categoria</span>
                                                                      <select class="form-control" name="cat" autocomplete="off" required>
                                                                      <option value="" selected disabled>---SELECCIONE---</option>
                                                                      <?php
                                                                                $p=mysql_query("SELECT * FROM categorias WHERE estado='s'");             
                                                                                while($r=mysql_fetch_array($p)){
                                                                                    if($r['id']==$row['cat']){
                                                                                        echo '<option value="'.$r['id'].'" selected>'.$r['nombre'].'</option>';
                                                                                    }else{
                                                                                        echo '<option value="'.$r['id'].'">'.$r['nombre'].'</option>';
                                                                                    }
                                                                                }
                                                                            ?>                                     
                                                                    </select>                                               
                                                                    </div><br>
                                                                    <div class="input-group">
                                                                      <span class="input-group-addon">Almacen</span>
                                                                      <select class="form-control" name="almacen" autocomplete="off" required>
                                                                      <option value="" selected disabled>---SELECCIONE---</option>
                                                                       <?php
                                                                            $sal=mysql_query("SELECT * FROM almacenes WHERE estado='s'");             
                                                                            while($col=mysql_fetch_array($sal)){
                                                                                if($col['id']==$row['almacen']){
                                                                                        echo '<option value="'.$col['id'].'" selected>'.$col['nombre'].'</option>';
                                                                                    }else{
                                                                                        echo '<option value="'.$col['id'].'">'.$col['nombre'].'</option>';
                                                                                    }
                                                                            }
                                                                        ?>                                         
                                                                    </select>                                               
                                                                    </div><br>
                                                                       <div class="input-group">
                                                                          <span class="input-group-addon">Stock</span>
                                                                          <input class="form-control" name="stock" value="<?php echo $row['stock']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>                                                                                                                                                                                                                                   
                                                                    </div>                                                                                    
                                                                <div class="col-md-6">                                                                    
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Stock Minimo</span>
                                                                          <input class="form-control" name="stock_min" value="<?php echo $row['stock_min']; ?>"  autocomplete="off" required><br>                                         
                                                                    </div><br>
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Precio venta</span>
                                                                          <input type="number" min="0" step="any" class="form-control" name="pv" value="<?php echo $row['pv']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br> 
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Precio Mayoreo</span>
                                                                          <input type="number" min="0" step="any" class="form-control" name="pmy" value="<?php echo $row['pmy']; ?>" autocomplete="off" required><br>                                         
                                                                    </div><br>                                                                                                                                                                                              
                                                                </div>                                                                        
                                                            </div>
                                                            <?php }else{ echo mensajes("NO TIENES PERMISO PARA REALIZAR ESTA ACCIÓN","rojo"); }?>  
                                                            </div> 
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">Actualizar</button>
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
                                                                    una vez Eliminado de Inventario <strong>[ <?php echo $row['nombre']; ?> ]</strong> no podra ser Recuperada la el dato.</h4>
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
        </div>
    </div>
<?php }else{ echo mensajes("NO TIENES PERMISO PARA ENTRAR A ESTE MODULO","rojo"); }?>
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
