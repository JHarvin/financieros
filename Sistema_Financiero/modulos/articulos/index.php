<?php
    session_start();
    include_once "../php_conexion.php";
    include_once "class/class.php";
    include_once "class/class_asig.php";
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
        mysql_query("DELETE FROM articulos WHERE id='$id'");
        header('Location: index.php');
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
        <!-- Custom Styles-->
    <link href="../../assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="../../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>


        <!--/. NAV TOP  -->

            <?php include_once "../../menu/m_categoria.php"; ?>

        <!-- /. NAV SIDE  -->
        <div id="wrapper" style="background-color:#4161CF;">
            <div id="page-inner">
<?php if(permiso($_SESSION['cod_user'],'5')==TRUE){ ?>
			 <div class="row">

                </div>
                 <!-- /. ROW  -->
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
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="active"><a href="#datos" data-toggle="tab"><i class="glyphicon glyphicon-book" ></i> DATOS</a></li>
                                            
                                            </ul><br>
                                            <div class="tab-content">
                                            <div class="tab-pane fade active in" id="datos">
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
                                             <div class="input-group">
                                                    <span class="input-group-addon">Marca:</span>
                                                    
                                                    <select class="form-control" name="marca" placeholder="Marca" autocomplete="off" required>
                                                   <option value="" selected disabled>---SELECCIONE---</option>
                                                     <?php
                                                        $sal=mysql_query("SELECT * FROM marcas WHERE estado='s'");
                                                        while($col=mysql_fetch_array($sal)){
                                                            echo '<option value="'.$col['id'].'">'.$col['nombre'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div><br>
                                            <input type="number" min="0" step="any" class="form-control" name="valor" placeholder="Costo Compra" autocomplete="off" required><br>
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
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>ARTICULOS</h3>

                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <?php
                                    if(!empty($_POST['codigo'])){
                                        $codigo=limpiar($_POST['codigo']);
                                        $nombre=limpiar($_POST['nombre']);
                                        $cat=limpiar($_POST['cat']);
                                        $und=limpiar($_POST['und']);
                                        $valor=limpiar($_POST['valor']);
                                        $detalle=limpiar($_POST['detalle']);
                                        $estado=limpiar($_POST['estado']);
                                        //$modelo=limpiar($_POST['modelo']);
                                        //$estante=limpiar($_POST['estante']);
                                        $marca=limpiar($_POST['marca']);
                                       // $iva=limpiar($_POST['iva']);

                                        $oNDP=new Consultar_Articulos($codigo);
                                        $nom_Pdto=$oNDP->consultar('nombre');

                                        if(empty($_POST['id'])){
                                            $pa=mysql_query("SELECT * FROM articulos WHERE codigo='$codigo'");
                                            if($row=mysql_fetch_array($pa)){
                                                echo mensajes('El Articulo "'.$nombre.'" Ya se Encuentra Registrado con el codigo "'.$codigo.'"','rojo');
                                            }else{
$oArticulos=new Proceso_Articulos('',$codigo,$nombre,$cat,$und,$valor,$detalle,$estado,$marca);
                                                 $oArticulos->crear();
                                                 echo mensajes('Articulo "'.$nombre.'" Creado con Exito','verde');
                                            }
                                        }else{
                                            $id=limpiar($_POST['id']);
$oArticulos=new Proceso_Articulos($id,$codigo,$nombre,$cat,$und,$valor,$detalle,$estado,$marca);
                                            $oArticulos->actualizar();
                                            echo mensajes('Articulo "'.$nombre.'" Actualizado con Exito','verde');
                                        }
                                    }
                                     ?>
                                    <?php
                                    if(!empty($_POST['id_art']) and !empty($_POST['almacen'])){
                                        $id_art=limpiar($_POST['id_art']);
                                        $almacen=limpiar($_POST['almacen']);
                                        $codigo=limpiar($_POST['codigox']);
                                        $stock=limpiar($_POST['stock']);
                                        $stock_min=limpiar($_POST['stock_min']);
                                        $pv=limpiar($_POST['pv']);
                                        //$pmy=limpiar($_POST['pmy']);
                                        $cat=limpiar($_POST['cat']);
                                        $nombrex=limpiar($_POST['nombrex']);

                                        $oND=new Consultar_Deposito($almacen);
                                        $nom_depo=$oND->consultar('nombre');
                                        $oArt=new Consultar_Articulos($nombrex);
                                        $nom_art=$oArt->consultar('nombre');

                                         $pa=mysql_query("SELECT * FROM inventario WHERE articulo='$id_art' and almacen='$almacen'");
                                        if($row=mysql_fetch_array($pa)){
                                            echo mensajes('El Articulo "'.$nom_art.'" ya se Encuentra asignado al Almacen "'.$nom_depo.'"','rojo');
                                        }else{
                                            $oInventario=new Proceso_Inventario('',$almacen,$id_art,$codigo,$stock,$stock_min,$pv,$cat);
                                            $oInventario->crear();
                                            echo mensajes('El Articulo "'.$nombrex.'" Ha sido Ingresado con Exito en el Almacen "'.$nom_depo.'"','verde');
                                        }

                                    }
                                ?>
                                <?php
                                    if(!empty($_POST['proveedor_e'])){
                                        $proveedor_e=limpiar($_POST['proveedor_e']);
                                        $id_artx=limpiar($_POST['id_artx']);
                                        $nombrey=limpiar($_POST['nombrey']);
                                        $oPro=new Consultar_Proveedor($proveedor_e);
                                        $nombre_prov=$oPro->consultar('nombre');

                                        $pa=mysql_query("SELECT * FROM pro_prov WHERE articulo='$id_artx' and proveedor='$proveedor_e'");
                                        if($row=mysql_fetch_array($pa)){
                                            echo mensajes('Este Proveedor "'.$nombre_prov.'" ya se Encuentra Relacionado con el Articulo "'.$nombrey.'"','rojo');
                                        }else{
                                            mysql_query("INSERT INTO pro_prov (articulo, proveedor) VALUES ('$id_artx','$proveedor_e')");
                                            mysql_query("Update articulos Set prov='ok' Where id='$id_artx'");
                                            echo mensajes('El Articulo "'.$nombrey.'" se le ha Asignado el Proveedor "'.$nombre_prov.'" con Exito','verde');
                                        }
                                    }
                                ?>
                                <table width="100%" border="0">
                                  <tr>
                                    <td width="50%">
                                        <div align="right">
                                        <form method="post" action="" enctype="multipart/form-data" name="form1" id="form1">
                                          <div class="col-12 form-group" style="padding-right: 20px;">
                                                 <input class="form-control" name="bus" type="text" class="span2" size="60" list="browsers1" autocomplete="off" placeholder="Buscar" autofocus style="border: 1px solid #2D52CC;">
                                                  <datalist id="browsers1">
                                                  <?php
                                                    $buscar=$_POST['bus'];
                                                    $can=mysql_query("SELECT * FROM articulos");
                                                    while($dato=mysql_fetch_array($can)){
                                                        echo '<option value="'.$dato['nombre'].'">';
                                                    }
                                                  ?>
                                              </datalist>
                                            
                                            <td>
                                                <div class="panel-body" align="right">
                                                <button class="btn btn-primary" type="submit" style="padding-right: 20px;">
                                                
                                                Listar articulos</button>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-2x" title="Agrear Articulo"></i>
                                              Agregar articulos
                                                </button>
                                                <button type="button" class="btn btn-info" onClick="window.location='PDFarticulos.php'"><i class="fa fa-file fa-2x"                     title="Reporte PDF"></i>
                                                Ver reporte de articulos
                                                </button style="padding-right: 20px;">
                                            </div>
                                                </td>

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
                                            <th>NOMBRE</th>
                                            <th>COSTO</th>
                                            <th>INV.</th>
                                            <th>PROV.</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            #$pame=mysql_query("SELECT * FROM articulos");
                                            if(empty($_POST['bus'])){
                                                $pame=mysql_query("SELECT * FROM articulos ORDER BY id DESC LIMIT 10");
                                            }else{
                                                $buscar=$_POST['bus'];
                                                $pame=mysql_query("SELECT * FROM articulos where nombre LIKE '$buscar%' or codigo LIKE '$buscar%' or id LIKE '$buscar%'");
                                            }
                                            while($row=mysql_fetch_array($pame)){
                                                $url=cadenas().encrypt($row['codigo'],'URLCODIGO');
                                                $id_art=$row['id'];
                                                if($row['inv']== NULL){
                                                        #$asignar='<a href="asignaciones.php?codigo='.$url.'" class="btn btn-success btn-sm"><i class=" fa fa-arrow-right"></i></a>';
                                                        $asignar='<a href="#" data-toggle="modal" data-target="#asignar'.$id_art.'" class="btn btn-default btn-sm" title="Asignar Almacen"><i class=" fa fa-plus"></i></a>';
                                                    }else{
                                                        $asignar='<a href="#" data-toggle="modal" data-target="#asignar'.$id_art.'" class="btn btn-default btn-sm"><i class=" fa fa-check "></i></a>';
                                                    }
                                                 if($row['prov']== NULL){
                                                        #$asignar='<a href="asignaciones.php?codigo='.$url.'" class="btn btn-success btn-sm"><i class=" fa fa-arrow-right"></i></a>';
                                                        $prov='<a href="#" data-toggle="modal" data-target="#prov'.$id_art.'" class="btn btn-default btn-sm" title="Asignar Proveedor"><i class=" fa fa-user"></i></a>';
                                                    }else{
                                                        $prov='<a href="#" data-toggle="modal" data-target="#prov'.$id_art.'" class="btn btn-default btn-sm"><i class=" fa fa-check "></i></a>';
                                                    }
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['codigo']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo $s.' '.formato($row['valor']); ?></td>
                                            <td><?php echo $asignar; ?></td>
                                             <td><?php echo $prov; ?></td>
                                            <td class="center"><div class="btn-group">
                                              <button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle"><i class="fa fa-cog"></i> <span class="caret"></span></button>
                                              <ul class="dropdown-menu pull-right">
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

                                                                <h3 align="center" class="modal-title" id="myModalLabel">Editar Articulo</h3>
                                                            </div>
                                                            <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Nombre</span>
                                                                          <input class="form-control" name="nombre"  value="<?php echo $row['nombre']; ?>" autocomplete="off" required><br>
                                                                    </div><br>
                                                                </div>
                                                                 <div class="col-md-12">
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Detalle</span>
                                                                          <input class="form-control" name="detalle"  value="<?php echo $row['detalle']; ?>" placeholder="Sin Detalle" autocomplete="off"><br>
                                                                    </div><br>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Codigo</span>
                                                                          <input class="form-control" name="codigo"  value="<?php echo $row['codigo']; ?>" autocomplete="off" required><br>
                                                                    </div><br>
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
                                                                          <span class="input-group-addon">Unidad</span>
                                                                           <select class="form-control" name="und" autocomplete="off" required>
                                                                      <option value="" selected disabled>---SELECCIONE---</option>
                                                                      <?php
                                                                                $p=mysql_query("SELECT * FROM unidades WHERE estado='s'");
                                                                                while($r=mysql_fetch_array($p)){
                                                                                    if($r['id']==$row['und']){
                                                                                        echo '<option value="'.$r['id'].'" selected>'.$r['nombre'].'</option>';
                                                                                    }else{
                                                                                        echo '<option value="'.$r['id'].'">'.$r['nombre'].'</option>';
                                                                                    }
                                                                                }
                                                                            ?>
                                                                    </select>
                                                                    </div><br>
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Valor</span>
                                                                          <input type="number" min="0" step="any" class="form-control" name="valor"  value="<?php echo formato($row['valor']); ?>" autocomplete="off" required><br>
                                                                    </div><br>
                                                                    
                                                                    </div>
                                                                <div class="col-md-6">
                                                                     <div class="input-group">
                                                                            <span class="input-group-addon">Modelo</span>
                                                                            <input class="form-control" name="modelo"  autocomplete="off" value="<?php echo $row['modelo']; ?>" onKeyUp="this.value=this.value.toUpperCase();"><br>
                                                                      </div><br>
                                                                      <div class="input-group">
                                                                            <span class="input-group-addon">Marca</span>
                                                                            <input class="form-control" name="marca" placeholder="Marca" autocomplete="off" value="<?php echo $row['marca']; ?>" onKeyUp="this.value=this.value.toUpperCase();" required>


                                                                            
                                                                      </div><br>
                                                                      
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
                                         <!--  Modals-->
                                         <div class="modal fade" id="asignar<?php echo $id_art; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <form name="form1" method="post" action="">
                                                <input type="hidden" name="id_art" value="<?php echo $id_art; ?>">
                                                <input type="hidden" name="codigox" value="<?php echo $row['codigo']; ?>">
                                                <input type="hidden" name="nombrex" value="<?php echo $row['nombre']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                                                <h3 align="center" class="modal-title" id="myModalLabel">Asignar Almacen</h3>
                                                            </div>
                                                             <div class="alert alert-info" align="center"><strong> <?php echo $row['nombre']; ?></strong></div>
                                                            <div class="panel-body">
                                                            <div class="row">
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
                                                                                echo '<option value="'.$col['id'].'">'.$col['nombre'].'</option>';
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                    </div><br>
                                                                       <div class="input-group">
                                                                          <span class="input-group-addon">Cantidad</span>
                                                                          <input class="form-control" name="stock"  autocomplete="off" required><br>
                                                                    </div><br>
                                                                    </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Stock Minimo</span>
                                                                          <input class="form-control"  name="stock_min"  autocomplete="off" required><br>
                                                                    </div><br>
                                                                    <div class="input-group">
                                                                          <span class="input-group-addon">Precio venta</span>
                                                                          <input type="number" class="form-control"  min="0" step="any" name="pv"  autocomplete="off" required><br>
                                                                    </div><br>
                                                                   <!-- - <div class="input-group">
                                                                          <span class="input-group-addon">Precio Mayoreo</span>
                                                                          <input type="number" class="form-control"  min="0" step="any" name="pmy"  autocomplete="off" required><br>
                                                                    </div><br>-->
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">Asignar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                         <!-- End Modals-->
                                          <!--  Modals-->
                                         <div class="modal fade" id="prov<?php echo $id_art; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <form name="form1" method="post" action="">
                                                <input type="hidden" name="id_artx" value="<?php echo $id_art; ?>">
                                                <input type="hidden" name="codigoy" value="<?php echo $row['codigo']; ?>">
                                                <input type="hidden" name="nombrey" value="<?php echo $row['nombre']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                                                <h3 align="center" class="modal-title" id="myModalLabel">Asignar Proveedor</h3>
                                                            </div>
                                                             <div class="alert alert-info" align="center"><strong> <?php echo $row['nombre']; ?></strong></div>
                                                            <div class="panel-body">
                                                            <div class="row">
                                                            <div class="col-md-2">
                                                            </div>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                      <span class="input-group-addon">Proveedor</span>
                                                                      <select class="form-control" name="proveedor_e" autocomplete="off" required>
                                                                      <option value="" selected disabled>---SELECCIONE---</option>
                                                                      <?php
                                                                                $p=mysql_query("SELECT * FROM proveedor");
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
                                                                    </div>
                                                            </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">Asignar</button>
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
<?php }else{ echo mensajes("NO TIENES PERMISO PARA ENTRAR A ESTE MODULO","rojo"); }?>
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
