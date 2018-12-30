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
                               
                          
 <div class="panel-body">
        
    
        
        <div class="row">
                    <div class="col-md-12">                        
                          <div class="panel-body" align="center">                                                                                 
                            <button type="button" class="btn btn-primary btn-circle"><i class="fa fa-print fa-2x" title="Imprimir"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-circle"  onClick="window.location='PDFarticulos_existencia.php'" title="Reporte PDF"><i class="fa fa-list-alt fa-2x"></i>
                            </button>                                                                                 
                           </div>
                    </div>
        </div> 
                 <!-- /. ROW  -->       
              <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                             EXISTENCIA MINIMA
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <div style="width:100%; height:700px; overflow: auto;">                           
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>CODIGO</th>
                                            <th>ARTICULO</th>
                                            <th>CATEGORIA</th>                                                              
                                            <th>EXISTENCIA</th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php   
                                            $mensaje='no';                                        
                                            $pame=mysql_query("SELECT * FROM inventario WHERE almacen='$id_almacen'");                                                        
                                            while($row=mysql_fetch_array($pame)){
                                                $cant=$row['stock'];
                                                $minima=$row['stock_min'];
                                                if($cant<=$minima){
                                                    $mensaje='si';
                                                
                                                $oArticulo=new Consultar_Articulos($row['articulo']);
                                                $oCat=new Consultar_Categoria($row['cat']);
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['codigo']; ?></td>
                                            <td><?php echo $oArticulo->consultar('nombre');  ?></td>
                                            <td><?php echo $oCat->consultar('nombre');  ?></td>
                                            <td><span class="badge badge-important"><?php echo $row['stock']; ?></span></td>
                                        </tr>                                                 
                                        <?php }} ?>                                                                             
                                    </tbody>
                                </table>
                            </div>
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
