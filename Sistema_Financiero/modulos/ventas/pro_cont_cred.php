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


        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
             <div class="sidebar-collapse">
                 <div align="center"><br>
                           <a href="credito.php">
                             <button type="button" class="btn btn-success"><i class="fa fa-undo fa-2x" title="Nueva Venta"></i>
                            </button>
                            </a><br><br>

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
                                                    $nit=$row['dui'];
                                                    $nrc=$row['nrc'];
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
                            <?php
                                    $n=mysql_query("SELECT * FROM clientcred_tmp");
                                        if(!$rowx=mysql_fetch_array($n)){
                                            $activar='hidden';
                                            $c_nombre='CONSUMIDOR FINAL';
                                            $id_cliente='0';
                                            $direccion='';
                                            $nit='';
                                            $nrc='';
                                            $pago='CONTADO';
                                            $fecha_hoy=date("Y-m-d");
                            ?>
                            <?php } ?>
                            <br><br><br><br><br><br>
                            <div class="table-responsive">
                            <div style="width:100%; height:120px; overflow: auto;">
                            <table class="table" width="475px" style="border: 1px dotted #FFFFFF; -moz-border-radius: 12px;-webkit-border-radius: 12px;padding: 10px;">
                                         <tr>
                                            <td align="center">
                                            </td>
                                            <td colspan="2" class="text-default" style="font-size: 12px;">
                                                <div class="<?php echo $activar; ?>">
                                                <br>
                                                <strong> &nbsp;&nbsp;<?php echo $c_nombre; ?></strong><br><br><br>
                                                <strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $direccion; ?></strong><br>
                                                <strong> &nbsp;&nbsp;<?php echo $nit; ?></strong><br>
                                                <strong></strong><br>
                                                </div>
                                            </td>
                                            <td colspan="2" class="text-default" style="font-size: 12px;">
                                                <div class="<?php echo $activar; ?>">
                                                <strong><?php echo fecha($fecha_hoy); ?></strong><br><br>
                                                <strong></strong><br>
                                                <strong>&nbsp;&nbsp;<?php echo $nrc; ?></strong><br>
                                                <strong></strong><br>
                                                </div>
                                            </td>
                                         </tr>

                            </table>
                            </div>
                            </div>
                            <br>
                            <br><br>
                            <div style="width:100%; height:175px; overflow: auto;">
                            <div class="table-responsive">
                            <table class="table" width="475px" style="border: 1px dotted #FFFFFF; -moz-border-radius: 12px;-webkit-border-radius: 12px;padding: 10px;">
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
                                            <tr style="font-size: 15px;">
                                                <td width="5%" align="left"><?php echo $cantidad; ?></td>
                                                <td width="75%"><?php echo $oArticulo->consultar('nombre');  ?></td>
                                                <td><div align="right">$<?php echo formato($new); ?></div></td>
                                                <td width="20%"></td>
                                                <td width="2%"> <div align="right">$<?php echo formato($importe_dos); ?></div></td>
                                            </tr>
                                            <?php } ?>
                                        </table>
                                        </div>
                                        </div>
                                        <br>
                                        <div class="table-responsive">
                                        <table class="table" width="500px" style="border: 0px dotted #FFFFFF; -moz-border-radius: 12px;-webkit-border-radius: 12px;padding: 12px; font-size: 17px;">
                                          <tr>
                                              <td colspan="4"><div align="right"><strong></strong></div></td>
                                              <td><div align="right"><strong><?php echo formato($netoO); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong></strong></div></td>
                                              <td><div align="right"><strong><?php echo formato($iva); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong></strong></div></td>
                                              <td><div align="right"><strong><?php echo formato($netoO+$iva); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong></strong></div></td>
                                              <td><div align="right"><strong><?php echo formato(0); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong></strong></div></td>
                                              <td><div align="right"><strong><?php echo formato(0); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong></strong></div></td>
                                              <td><div align="right"><strong><?php echo formato(0); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="4"><div align="right"><strong></strong></div></td>
                                              <td><div align="right"><strong><?php echo formato($neto_total); ?></strong></div></td>
                                            </tr>
                                        </table>
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
