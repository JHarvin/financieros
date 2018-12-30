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
        $ivax=limpiar($_GET['iva']);
        $pago=limpiar($_GET['pago']);
        $neto=$netoO;
        $tf=$neto+$ivax;
        $fecha=date('Y-m-d');
        $hora=date('H:i:s');
        
        $pa=mysql_query("SELECT * FROM cajac_tmp WHERE usu='$usu'");             
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
        $pa=mysql_query("SELECT MAX(factura)as maximo FROM factura");               
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
             <div class="sidebar-collapse">
                 <div align="center"><br>
                           <a href="credito.php">
                             <button type="button" class="btn btn-success btn-circle"><i class="fa fa-plus fa-2x" title="Nueva Venta"></i>
                            </button>
                            </a><br><br>
                         
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-footer back-footer-blue">
                                Valor Recibido
                            </div>
                            <div class="panel-body">
                                <div style=" bg-color: blue;font-size:35px"><?php echo $s.' '.formato($valor_recibido); ?> </div>
                            </div>                           
                        </div>
            </div>
             <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-footer back-footer-red">
                                Total Factura
                            </div>
                            <div class="panel-body">
                                <div style=" bg-color: red;font-size:35px"><?php echo $s.' '.formato($neto+$ivax); ?> </div>
                            </div>                           
                        </div>
            </div>
             <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-footer back-footer-green">
                                Vuelto
                            </div>
                            <div class="panel-body">
                                <div style=" bg-color: green;font-size:35px"><?php echo $s.' '.formatodos($valor_recibido-$tf); ?> </div>
                            </div>                           
                        </div>
            </div>
            </div>                        
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                 <!-- /. ROW  -->
              <table width="95%" rules="all" border="1">
                            <?php 
                                                $item=0;
                                                $pa=mysql_query("SELECT * FROM clientcred_tmp, clientes 
                                                WHERE clientcred_tmp.usu='$usu' and clientcred_tmp.cliente=clientes.id");             
                                                while($row=mysql_fetch_array($pa)){                                                                                                                                                 
                                                    $c_nombre=$row['nombre'];
                                                    $id_cliente=$row['id'];
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
            <div class="row">
                <div class="col-md-10">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             INFORMACION DE FACTURA
                        </div>
                        <div class="panel-body">
                        <center><button onclick="imprimir();" class="btn btn-default"><i class=" fa fa-print "></i> Imprimir</button></center><br>
                        <div id="imprimeme">
                            <div class="table-responsive">  
                                    <table  width="100%" style="border: 1px solid #660000; -moz-border-radius: 12px;-webkit-border-radius: 12px;padding: 10px;">
                                     <tr>
                                        <td>
                                            <center>
                                            <img src="../../img/logo.jpg" width="75px" height="75px"><br>
                                            <!--<strong><?php echo $nombre_empresa; ?></strong><br>-->
                                            </center>                                                    
                                        </td>
                                        <td>
                                        <td align="center">                     
                                            <div style="font-size: 25px;"><strong><em><?php echo $nombre_empresa; ?></em></strong></div>
                                            <div style="font-size: 14px;"><strong>Almacen: <?php echo $nombre_Almacen; ?></strong></div>
                                            <!--<strong><?php echo $nombre_empresa; ?></strong><br>-->                                                 
                                        </td>                                                  
                                        </td>
                                        <td>
                                             <div style="font-size: 12px;" align="right">
                                                    <strong>DOCUMENTO: </strong><?php echo $factura; ?><br>
                                                    <strong>FECHA: </strong><?php echo fecha($fecha); ?> | 
                                                    <strong>HORA: </strong><?php echo date($hora); ?><br>
                                                    <strong>USUARIO/A: </strong><?php echo $cajero_nombre; ?>
                                            </div>
                                        </td>
                                     </tr>                          
                                    </table>
                            </div>
                           
                           
                            <hr/>
                            <?php 
                                    $n=mysql_query("SELECT * FROM clientcred_tmp");               
                                        if(!$rowx=mysql_fetch_array($n)){
                                            $activar='hidden';
                                            $c_nombre='CONSUMIDOR FINAL';
                                            $id_cliente='0';
                                            $direccion='';
                                            $pago='CONTADO';
                                            $fecha_hoy=date("Y-m-d");
                            ?>
                            <?php } ?>
                            <div class="<?php echo $activar; ?>">     
                            <strong>Cliente: </strong><?php echo $c_nombre; ?><br>
                            <strong>Dirección: </strong><?php echo $dir; ?> | <?php echo $row['dir']; ?><br>                                                                          
                            <strong>Tipo: </strong><?php echo $pago; ?><br>
                            <strong>Fecha de Entrega: </strong><?php echo fecha($fechax); ?>
                            </div>
                             <hr/>
                            <br>
                            <table class="table table-striped table-bordered table-hover" width="100%" rules="all"  border="1">
                                            <tr>
                                                <td><strong>CANTIDAD</strong></td>                                              
                                                <td><strong>DESCRIPCIÓN</strong></td>
                                                <td><div align="right"><strong>PRECIO UNI.</strong></div></td>
                                                <td><div align="right"><strong>EXENTAS.</strong></div></td>
                                                <td><div align="right"><strong>VENTAS AFECTAS</strong></div></td>
                                            </tr>
                                            <?php 
                                                $item=0;
                                                $neto=0;
                                                $neto_total=0;
                                                $neto_full=0;$i=0;
                                                $pa=mysql_query("SELECT * FROM cajac_tmp, inventario 
                                                WHERE cajac_tmp.usu='$usu' and cajac_tmp.articulo=inventario.articulo");             
                                                while($row=mysql_fetch_array($pa)){                                             
                                                    $cat=$row['cat'];   
                                                    $item=$item+$row['cant'];   
                                                    $cantidad=$row['cant'];
                                                    $id_art=$row['articulo'];        
                                                    $codigo=$row['articulo'];        
                                                    $precio_venta=$row['pv'];
                                                    $valor=$row['p_mayor'];
                                                                                                                                                           
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
                                                    ############### IVA #########################
                                                    $i=0.13;
                                                    ########################################
                                                    $new_valor=$row['ref'];
                                                    $importe_dos=$row['cant']*$new;
                                                    $neto_full=$neto_full+$importe_dos;
                                                    
                                                    ###############CALCULOS TOTALES#########################
                                                    $importe=$row['cant']*$new;
                                                    $neto=$neto+$importe;
                                                    $iva=$neto*$i;
                                                    $neto_total=$netoO+$iva;

                                                    $oArticulo=new Consultar_Articulos($row['articulo']);
                                                    $p_nombre=$oArticulo->consultar('nombre');
                                                    ########################################
                                                    $detalle_sql="INSERT INTO detalle (factura, articulo, codigo, cantidad, valor, importe, tipo, fecha, categoria, almacen)
                                                    VALUES ('$factura','$id_art','$codigo','$cantidad','$new','$importe_dos','VENTA','$fecha','$cat','$id_almacen')";
                                                    mysql_query($detalle_sql);
                                                    #########DESCONTAR INVENTARIO################################################################
                                                     $pwa=mysql_query("SELECT * FROM inventario WHERE articulo='$codigo' and almacen='$id_almacen'");             
                                                    if($roww=mysql_fetch_array($pwa)){  
                                                        $new_cant=$roww['stock']-$cantidad;
                                                        mysql_query("UPDATE inventario SET stock='$new_cant' WHERE articulo='$codigo' and almacen='$id_almacen'");
                                                    }                                                                                                                                                                                                               
                                            ?>
                                            <tr>
                                                
                                                <!--<td><?php echo $codigo; ?></td>-->
                                                <td align="center"><?php echo $cantidad; ?></td>                                                
                                                <td><?php echo $oArticulo->consultar('nombre');  ?></td>
                                                <!--<td><?php echo $row['tipo']; ?></td>-->
                                                <td><div align="right">$<?php echo formato($new); ?></div></td>
                                                <td></td>
                                                <td><div align="right">$<?php echo formato($importe_dos); ?></div></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong>Suma</strong></div></td>
                                              <td><div align="right"><strong>$ <?php echo formato($netoO); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong>IVA</strong></div></td>
                                              <td><div align="right"><strong>$ <?php echo formato($iva); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong>Sub-Total</strong></div></td>
                                              <td><div align="right"><strong>$ <?php echo formato($netoO+$iva); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong>(-) IVA Retenido</strong></div></td>
                                              <td><div align="right"><strong>$ <?php echo formato(0); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong>Ventas Excentas</strong></div></td>
                                              <td><div align="right"><strong>$ <?php echo formato(0); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong>Ventas Total</strong></div></td>
                                              <td><div align="right"><strong>$ <?php echo formato($neto_total); ?></strong></div></td>
                                            </tr>
                                        </table>
                                        <hr/>
                                         <div class="row">
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
                
            
               
           
             <!-- /. PAGE INNER  -->
                                       
        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>

            <?php 
        ######## GUARDAMOS LA INFORMACION DE LA FACTURA EN LAS TABLAS
        $fecha=date('Y-m-d');                   
        $hora=date('H:i:s');
        $mensaje='Venta al "'.$pago.'"';
       mysql_query("INSERT INTO factura (factura,valor,fecha,estado,almacen,usu) VALUE ('$factura','$neto_total','$fecha','s','$id_almacen','$usu')");
             mysql_query("INSERT INTO resumen (cliente,concepto,factura,clase,valor,tipo,fecha,hora,status,usu,almacen,estado) 
                                  VALUES ('$id_cliente','$mensaje','$factura','CREDITOFISCAL','$neto_total','VENTA','$fecha','$hora','$pago','$usu','$id_almacen','s')");
        if ($pago == 'CREDITO')
        {           
            mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio) 
                                       VALUES ('$id_cliente','$factura','CXC','$neto_total','$fecha','$hora','$usu','$id_almacen')");          
        }
            else
            {
                mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio) 
                                           VALUES ('$mensaje','$factura','ENTRADA','$neto_total','$fecha','$hora','$usu','$id_almacen')");
            } 

        mysql_query("DELETE FROM cajac_tmp WHERE usu='$usu'");
        mysql_query("DELETE FROM clientcred_tmp WHERE usu='$usu'");
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
