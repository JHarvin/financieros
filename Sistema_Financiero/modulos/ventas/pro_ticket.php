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
        if ($_GET['pago']=='CONTADO') {
            # code...
        }else{
        $intereR=limpiar($_GET['interes']);
        $mesR=limpiar($_GET['mes']);
         }
        $fecha=date('Y-m-d');
        $hora=date('H:i:s');

        $pa=mysql_query("SELECT * FROM caja_tmp WHERE usu='$usu'");
        if(!$row=mysql_fetch_array($pa)){
            header('Location: index.php');
        }
        ######### TRAEMOS LOS DATOS DE LA EMPRESA #############
        $pa=mysql_query("SELECT * FROM empresa WHERE id=1");
        if($row=mysql_fetch_array($pa)){
            $nombre_empresa=$row['empresa'];
            $nit_empresa=$row['nit'];
            $tama=$row['tama'];
            $web=$row['web'];
            $dir_empresa=$row['direccion'];
            $tel_empresa=$row['tel'].'-'.$row['fax'];
            $pais_empresa=$row['pais'].' - '.$row['ciudad'];
        }

        ######### SACAMOS EL VALOR MAXIMO DE LA FACTURA Y LE SUMAMOS UNO ##########
        $pa=mysql_query("SELECT MAX(id)as maximo FROM ticket");
        if($row=mysql_fetch_array($pa)){
            if($row['maximo']==NULL){
                $factura='1';
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
    <style type="text/css" media="print">
#Imprime {
    height: auto;
    width: 377px;
    margin: 0px;
    padding: 0px;
    float: left;
    font-family: "Comic Sans MS", cursive;
    font-size: 7px;
    font-style: normal;
    line-height: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    color: #000;
}
@page{
   margin: 0;
}
</style>
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
    <div id="wrapper" style="background-color:#1A7B85;">




</div>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation" style="background-color:blue;">
             <div class="sidebar-collapse">

                 <div align="center"><br><br><br>
                           <a href="index.php">
                             <button type="button" class="btn btn-info"><i class="fa fa-undo fa-2x" title="Nueva Venta"></i>
                            </button>
                            </a><br><br>

            </div>

            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" style="background-color:#4161CF;">
            <div id="page-inner" >
             <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary text-center no-boder bg-color-blue">
            <div class="panel-footer back-footer-red">
             DETALLE DE TICKET
            </div>
            <div class="panel-body center">
                <?php
                                                $item=0;
                                                $pa=mysql_query("SELECT * FROM cliente_tmp, clientes
                                                WHERE cliente_tmp.usu='$usu' and cliente_tmp.cliente=clientes.id");
                                                while($row=mysql_fetch_array($pa)){
                                                    $c_nombre=$row['nombre'];
                                                    $id_cliente=$row['id'];
                                                    $direccion=$row['dir'];
                                                    $tel=$row['tel'];
                                                    $nit=$row['dui'];
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
           <center><button onclick="imprimir();" class="btn btn-default"><i class=" fa fa-print "></i> Imprimir</button></center>
                 <div id="imprimeme">
                <table width="175px" style="font-size:12px; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif" border="0" >
                    <tr>
                    <td colspan="4">
                    <div align="center" style="font-size:20px"><strong><?php echo $nombre_empresa; ?></strong><br></div>

                    <div align="left"><strong>Tel: </strong><?php echo $tel_empresa; ?><br></div>
                    <div align="left"><strong>NIT: </strong><?php echo $nit_empresa; ?><br></div>
                    <div align="left"></strong><?php echo $dir_empresa; ?><br></strong></div>
                    <div align="left"><strong>Ticket: </strong><?php echo formato_factura($factura); ?></div>
                    <div align="left"><strong>Cajero Tigre: </strong><?php echo $cajero_nombre; ?><br></div>
                    <div align="left"><strong>Fecha: </strong><?php echo $fecha; ?> <?php echo $hora; ?><br></div>
                    </td>
                    </tr>
                    <tr>
                    </tr>
                      <tr>
                        <td colspan="4"><center>=============================</center></td>
                        </tr>
                        <tr>
                        <td>Cod. </td>
                        <td>Descrip.</td>
                        <td>Cant.</td>
                        <td>P/T</td>
                        </tr>
                        <tr>
                        <td colspan="4"><center>==============================</center></td>
                        </tr>
                         <?php
                                                $item=0;
                                                $neto=0;
                                                $neto_full=0;
                                                $pa=mysql_query("SELECT * FROM caja_tmp, inventario
                                                WHERE caja_tmp.usu='$usu' and caja_tmp.articulo=inventario.articulo");
                                                while($row=mysql_fetch_array($pa)){
                                                    $cat=$row['cat'];
                                                    $item=$item+$row['cant'];
                                                    $cantidad=$row['cant'];
                                                     $id_art=$row['articulo'];
                                                    $codigo=$row['articulo'];
                                                    $precio_venta=$row['pv'];
                                                    $valor=$row['p_mayor'];
                                                    $fact= formato_factura($factura);

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
                                                    ########################################
                                                    $new_valor=$row['ref'];
                                                    $importe_dos=$row['cant']*$new;
                                                    $neto_full=$neto_full+$importe_dos;

                                                    ###############CALCULOS TOTALES#########################
                                                    $importe=$row['cant']*$new;
                                                    $neto=$neto+$importe;

                                                    $oArticulo=new Consultar_Articulos($row['articulo']);
                                                    $p_nombre=$oArticulo->consultar('nombre');
                                                    ########################################
                                                    $detalle_sql="INSERT INTO detalle (factura, articulo, codigo, cantidad, valor, importe, tipo, fecha, categoria, almacen)
                                                    VALUES ('$fact','$id_art','$codigo','$cantidad','$new','$importe_dos','VENTA','$fecha','$cat','$id_almacen')";
                                                    mysql_query($detalle_sql);
                                                    #########DESCONTAR INVENTARIO################################################################
                                                     $pwa=mysql_query("SELECT * FROM inventario WHERE articulo='$codigo' and almacen='$id_almacen'");
                                                    if($roww=mysql_fetch_array($pwa)){
                                                        $new_cant=$roww['stock']-$cantidad;
                                                        mysql_query("UPDATE inventario SET stock='$new_cant' WHERE articulo='$codigo' and almacen='$id_almacen'");
                                                    }
                                            ?>

                        <tr>
                                                <td><div align="center"><?php echo $row['codigo']; ?><div></td>
                                                <td><?php echo $p_nombre; ?></td>
                                                <td ><div align="left"><?php echo $cantidad; ?></div></td>
                                                <td><div align="center">$ <?php echo formato($importe_dos); ?></div></td>
                                            </tr>
                                            <?php } ?>
                                              <tr>
                                                <td colspan="4">&nbsp;</td>
                                              </tr>
                                                 <tr>
                                                    <td colspan="4"><center>NO. DE ARTICULOS: <?php echo $item; ?></center></td>
                                                  </tr>
                                                <tr>
                                                   <td colspan="4"><center>----------------------------------------</center></td>
                                                </tr>
                                              <tr>
                                                <td colspan="4"><center>
                                                  <strong>TOTAL: $ <?php echo formato($netoO); ?></strong>
                                                </center></td>
                                              </tr><br>
                                              <tr>
                                                <td colspan="4"><center><strong></strong></center></td>
                                              </tr>
                                               <tr>
                                                   <td colspan="4"><center>----------------------------------------</center></td>
                                                </tr>
                                            <tr>
                                                <td colspan="4"><center><strong> PAGO: $ <?php echo formato($valor_recibido); ?></strong></center></td>
                                              </tr>
                                                <tr>
                                                <td colspan="4"><center><strong> Saldo: $ <?php echo formato($valor_recibido-$netoO); ?></strong></center></td>
                                              </tr>
                                              <tr>
                                                <td colspan="4">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td colspan="4"><center>*GRACIAS POR PREFERIRNOS*</center></td>
                                              </tr>
                                              <tr>
                                                <td colspan="4"><center></center></td>
                                              </tr><br>
              </table>

             <!-- /. PAGE INNER  -->

        </div>

    </div>
     </div>
                                            </div>
                                        </div>
             <!-- /. PAGE INNER  -->
            </div>

            <?php
        ######## GUARDAMOS LA INFORMACION DE LA FACTURA EN LAS TABLAS
        $fecha=date('Y-m-d');
        $hora=date('H:i:s');
        $mensaje='Venta al "'.$pago.'"';
        mysql_query("INSERT INTO ticket (ticket,valor,fecha,estado,almacen,usu) VALUE ('$fact','$neto_full','$fecha','s','$id_almacen','$usu')");
             mysql_query("INSERT INTO resumen_ticket (cliente,concepto,factura,clase,valor,tipo,fecha,hora,status,usu,almacen,estado)
                                  VALUES ('$id_cliente','$mensaje','$fact','VENTA','$netoO','VENTA','$fecha','$hora','$pago','$usu','$id_almacen','s')");
        if ($pago == 'CREDITO')
        {
            $guardax=$netoO-$valor_recibido;
             $interesG=($intereR/100)/12;
        $mx=round(($guardax*$interesG*(pow((1+$interesG),($mesR))))/((pow((1+$interesG),($mesR)))-1),2);
             $totalint=0;
        for($i=1;$i<=$mesR;$i++)
        {
                $totalint=round($totalint+($guardax*$interesG),2);
                number_format($guardax*$interesG,2,",",".");
                number_format($mx-($guardax*$interesG),2,",",".");

                $guardax=$guardax-($mx-($guardax*$interesG));
        }


        $guarda=$netoO-$valor_recibido;
        $interesG=($intereR/100)/12;
        $interesAg=round($guarda*$interesG,2);
        $m=round(($guarda*$interesG*(pow((1+$interesG),($mesR))))/((pow((1+$interesG),($mesR)))-1),2);



            mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio,interes,cuota,to_interes,prima)
                                       VALUES ('$id_cliente','$fact','CXC','$guarda','$fecha','$hora','$usu','$id_almacen','$intereR','$m','$totalint','$valor_recibido')");
        }
            else
            {
                mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio)
                                           VALUES ('$mensaje','$fact','ENTRADA','$neto_full','$fecha','$hora','$usu','$id_almacen')");
            }

        mysql_query("DELETE FROM caja_tmp WHERE usu='$usu'");
        mysql_query("DELETE FROM cliente_tmp WHERE usu='$usu'");
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
