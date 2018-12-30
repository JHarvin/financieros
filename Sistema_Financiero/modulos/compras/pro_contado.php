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
    
  if(!empty($_GET['valor_recibido']) and !empty($_GET['neto'])){
        $valor_recibido=limpiar($_GET['valor_recibido']);
        $netoO=limpiar($_GET['neto']);
        $pago=limpiar($_GET['pago']);
        $neto=$netoO;
        $fecha=date('Y-m-d');
        $hora=date('H:i:s');
        
        $pa=mysql_query("SELECT * FROM cajacom_tmp WHERE usu='$usu'");             
        if(!$row=mysql_fetch_array($pa)){   
            header('Location: index.php');
        }
        ######### TRAEMOS LOS DATOS DE LA EMPRESA #############
        $pa=mysql_query("SELECT * FROM empresa WHERE id=1");                
        if($row=mysql_fetch_array($pa)){
            $nombre_empresa=$row['empresa'];
            $nit_empresa=$row['nit'];
            $dir_empresa=$row['direccion'];
            $tel_empresa=$row['tel'].'-'.$row['fax'];
            $pais_empresa=$row['pais'].' - '.$row['ciudad'];
        }
        
        
        ######### SACAMOS EL VALOR MAXIMO DE LA FACTURA Y LE SUMAMOS UNO ##########
        $pa=mysql_query("SELECT MAX(factura)as maximo FROM fact_comp");               
        if($row=mysql_fetch_array($pa)){
            if($row['maximo']==NULL){
                $factura='100000001';
            }else{
                $factura=$row['maximo']+1;
            }
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
    <script>
        function imprimir(){
          var objeto=document.getElementById('imprimeme');  //obtenemos el objeto a imprimir
          var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
          ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
          ventana.document.close();  //cerramos el documento
          ventana.print();  //imprimimos la ventana
          ventana.close();  //cerramos la ventana
        }
    </script>
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
            <?php include_once "../../menu/m_compra.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
           
                 <!-- /. ROW  -->
                 <hr />
              <table width="95%" rules="all" border="1">
                                            
                            <?php 
                                                $item=0;
                                                $pa=mysql_query("SELECT * FROM prov_tmp, proveedor 
                                                WHERE prov_tmp.usu='$usu' and prov_tmp.proveedor=proveedor.id");             
                                                while($row=mysql_fetch_array($pa)){                                                                                                                                                 
                                                    $c_nombre=$row['nombre'];
                                                    $id_proveedor=$row['id'];
                                                    $direccion=$row['dir'];
                                                    $status=$row['status'];
                                                     $fecha_hoy=date("Y-m-d");
                                                    
                                                    ############# FECHA ######################
                                                    if($row['fecha']==NULL){
                                                        
                                                        #$oRuta->consultar('nombre');
                                                        $fechax=$fecha;
                                                    }else{
                                                        $fechax=$row['fecha'];
                                                        
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
                                                        
                                                         $status='CONTADO';
                                                    }else{
                                                        $status=$row['status'];
                                                        
                                                    }
                                                    $pame=strftime( "%Y-%m-%d-%H-%M-%S", time() );      
                                
                                    if($row['fecha']==$pame){
                                                    $status='si';
                                                }                                                                                               
                                                elseif($row['fecha']>$pame){
                                                    $status='CREDITO';
                                                }
                            ?>
                                                                                                                                                                                
                                            <?php } ?>
                                           
                     </table>
            
                <!-- /. ROW  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             DETALLES DE COMPRA
                        </div>
                        <div class="table-responsive">
                        <div class="panel-body">
                        <center><button onclick="imprimir();" class="btn btn-default"><i class=" fa fa-print "></i> Imprimir</button></center>
                        <div id="imprimeme">
                        <table width="100%">
                            <tr>
                                <td>
                                    <center>
                                    <strong><?php echo $nombre_Almacen; ?></strong><br>
                                    <img src="../../img/logo.jpg" width="130" height="110"><br>
                                    <strong><?php echo $nombre_empresa; ?></strong><br>
                                    </center>
                                </td>
                                <td><br>
                                    <strong>DOCUMENTO: </strong><?php echo $factura; ?><br>
                                    <strong>FECHA: </strong><?php echo fecha($fecha); ?> 
                                    <strong>HORA: </strong><?php echo date($hora); ?><br>
                                    <strong>USUARIO/A: </strong><?php echo $cajero_nombre; ?>
                                </td>
                            </tr>
                            <?php 
                                    $n=mysql_query("SELECT * FROM prov_tmp");               
                                        if(!$rowx=mysql_fetch_array($n)){
                                            $activar='hidden';
                                            $c_nombre='PROVEEDORES VARIOS';
                                            $id_cliente='0';
                                            $dir='';
                                            $pago='CONTADO';
                                            $fechax=date("Y-m-d");
                            ?>
                            <?php } ?>
                        </table><br>        
                            <strong>Proveedor: </strong><?php echo $c_nombre; ?><br>
                            <strong>Dirección: </strong><?php echo $dir; ?><br>                                                                          
                            <strong>Tipo: </strong><?php echo $pago; ?><br>
                            <strong>Fecha de Compra: </strong><?php echo $fechax; ?><br><br>                                                                                                                                                                   
                          <table class="table table-striped table-bordered table-hover" width="100%" rules="all"  border="1">
                                            <tr>
                                                <td><strong>CANTIDAD</strong></td>                                              
                                                <td><strong>PRODUCTO</strong></td>
                                                <td><div align="right"><strong>COSTO UNITARIO</strong></div></td>
                                                <td><div align="right"><strong>TOTAL</strong></div></td>
                                            </tr>
                                            <?php 
                                                $item=0;
                                                $neto=0;
                                                $neto_full=0;
                                                $pa=mysql_query("SELECT * FROM cajacom_tmp, articulos 
                                                WHERE cajacom_tmp.usu='$usu' and cajacom_tmp.articulo=articulos.id");             
                                                while($row=mysql_fetch_array($pa)){
                                                    $cat=$row['cat'];                                              
                                                    $item=$item+$row['cant'];   
                                                    $cantidad=$row['cant'];
                                                    $codigo=$row['articulo'];        
                                                    $cod=$row['codigo'];        
                                                    $precio_venta=strtolower($row['valor']);
                                                    $valor=$row['p_compra'];
                                                                                                                                    
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
                                                     ########################################
                                                    $new_valor=$row['ref'];
                                                    $importe=$row['cant']*$new;
                                                    $neto=$neto+$importe;                                                                                                       
                                                                         
                                                    ###############CALCULOS TOTALES#########################
                                                    $importe_dos=$row['cant']*$new;
                                                    $neto_full=$neto_full+$importe_dos;
                                                    ########################################
                                                    $oArticulo=new Consultar_Articulos($row['articulo']);
                                                    $p_nombre=$oArticulo->consultar('nombre');
                                                    ########################################
                                                    $detalle_sql="INSERT INTO detalle_comp (factura, codigo, nombre, cantidad, valor, importe, tipo, fecha, categoria, almacen)
                                                                                  VALUES ('$factura','$codigo','$cod','$cantidad','$new','$importe_dos','COMPRA', '$fecha','$cat','$id_almacen')";
                                                    mysql_query($detalle_sql);
                                                    #########DESCONTAR INVENTARIO################################################################
                                                    $pwa=mysql_query("SELECT stock FROM inventario WHERE articulo='$codigo' and almacen='$id_almacen'");             
                                                    if($roww=mysql_fetch_array($pwa)){
                                                        $stock=$roww['stock'];   
                                                        $new_cant=$roww['stock']+$cantidad;
                                                        mysql_query("UPDATE inventario SET stock='$new_cant' WHERE articulo='$codigo' and almacen='$id_almacen'");
                                                    }
                                                    ############### GUARDAMOS EN LA TABLA KARDEX#########################
                                                    $detalle_sql="INSERT INTO kardex (factura, tipo, id_articulo, cant, costok, importe, stockk, fecha, sucursal, usu)
                                                                          VALUES ('$factura','COMPRA','$codigo','$cantidad','$new','$importe_dos','$new_cant','$fecha','$id_almacen','$usu')";
                                                    mysql_query($detalle_sql);                                                                                                                                                                                                               
                                            ?>
                                            <tr>
                                                
                                                <!--<td><?php echo $codigo; ?></td>-->
                                                <td align="center"><?php echo $cantidad; ?></td>                                                
                                                <td><?php echo $oArticulo->consultar('nombre');  ?></td>
                                                <!--<td><?php echo $referencia; ?></td>-->
                                                <!--<td><?php echo $row['tipo']; ?></td>-->
                                                <td><div align="right">$<?php echo formato($new); ?></div></td>
                                                <td><div align="right">$<?php echo formato($importe_dos); ?></div></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                              <td colspan="3"><div align="right"><strong>Total</strong></div></td>
                                              <td><div align="right"><strong>$ <?php echo formato($neto_full); ?></strong></div></td>
                                            </tr>
                                        </table>
                                        <div class="col-md-12">
                                        <!-- Advanced Tables -->
                                         <br>
                                        <center>
                                            <?php echo $nombre_empresa; ?><br>
                                            <?php echo $tel_empresa; ?><br>
                                            <?php echo $pais_empresa; ?><br>
                                            <?php echo $dir_empresa; ?><br>
                                        </center>
                 </div>                                                                                                                                
                        </div>
                    </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>            
             <!-- /. ROW  -->  
            <div class="row">
                         
            </div>
             <!-- /. PAGE INNER  -->                              
        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>

            <?php 
        ######## GUARDAMOS LA INFORMACION DE LA FACTURA EN LA TABLA COMPRA
        $fecha=date('Y-m-d');                   
        $hora=date('H:i:s');
        $mensaje='Compra al "'.$pago.'"';

        mysql_query("INSERT INTO fact_comp (factura,valor,fecha,estado,almacen,usu) VALUE ('$factura','$neto_full','$fecha','s','$id_almacen','$usu')");        
        mysql_query("INSERT INTO resumen_comp (proveedor,concepto,factura,clase,valor,tipo,fecha,hora,status,usu,almacen,estado) 
            VALUES ('$id_proveedor','$mensaje','$factura','COMPRA','$neto_full','COMPRA','$fecha','$hora','$pago','$usu','$id_almacen','s')");

        if ($pago == 'CREDITO')
        {           
            mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio) 
                                       VALUES ('$id_proveedor','$factura','CXP','$neto_full','$fecha','$hora','$usu','$id_almacen')");          
        }
            else
            {
               mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio) 
                                          VALUES ('$mensaje','$factura','SALIDA','$neto_full','$fecha','$hora','$usu','$id_almacen')");
            } 
               
                                        
        mysql_query("DELETE FROM cajacom_tmp WHERE usu='$usu'");
        mysql_query("DELETE FROM prov_tmp WHERE usu='$usu'");
    ?>
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
