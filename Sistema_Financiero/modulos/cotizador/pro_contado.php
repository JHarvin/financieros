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
        $id_clt=limpiar($_GET['id_cliente']);
        $neto=$netoO;
        $fecha=date('Y-m-d');
        $hora=date('H:i:s');
        
        $pa=mysql_query("SELECT * FROM cotizador_tmp WHERE usu='$usu'");             
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
        ######### TRAEMOS LOS DATOS DE Los Clientes #############
        $cl=mysql_query("SELECT * FROM clientes WHERE id='$id_clt'");                
        if($row=mysql_fetch_array($cl)){
            $nom_cliente=$row['nombre'];
            $dir_cliente=$row['dir'];
            $email_cliente=$row['email'];
            $tel_cliente=$row['tel'];
            $nrc_cliente=$row['nrc'];
        }
        
        
        ######### SACAMOS EL VALOR MAXIMO DE LA FACTURA Y LE SUMAMOS UNO ##########
        $pa=mysql_query("SELECT MAX(factura)as maximo FROM fact_cot");               
        if($row=mysql_fetch_array($pa)){
            if($row['maximo']==NULL){
                $factura='100001';
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
    <script type="text/javascript" src="../../js_tabla/table_excel.js"></script>
    <script language="javascript">
        $(document).ready(function() {
            $(".botonExcel").click(function(event) {
                $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
                $("#FormularioExportacion").submit();
            });
        });
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
             <?php include_once "../../menu/m_cotizador.php"; ?>              
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                 <!-- /. ROW  -->
              <table width="95%" rules="all" border="1">
                            <?php 
                                                $item=0;
                                                $pa=mysql_query("SELECT * FROM clcot_tmp, clientes 
                                                WHERE clcot_tmp.usu='$usu' and clcot_tmp.cliente=clientes.id");             
                                                while($row=mysql_fetch_array($pa)){                                                                                                                                                 
                                                    $c_nombre=$row['nombre'];
                                                    $id_cliente=$row['id'];
                                                    $direccion=$row['dir'];
                                                    $status=$row['status'];
                                                    $email=$row['email'];
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
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             INFORMACION DE LA COTIZACION
                        </div>
                        <div class="panel-body">
                        <center><button onclick="imprimir();" class="btn btn-default"><i class=" fa fa-print "></i> Imprimir</button>
                        <a href="#excel" role="button" class="btn btn btn-default" data-toggle="modal"><i class="fa fa-print"></i> <strong> PDF</strong></a></center><br>
                            
                            <div class="modal fade" id="excel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <form action="../ficheroExcel.php" target="_blank" method="post" id="FormularioExportacion">                                      
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                        <div class="panel-body">
                                        <div class="row">
                                                <div class="tab-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                
                                                    <h3 align="center" class="modal-title" id="myModalLabel">Nombre del Fichero</h3>
                                                </div><br>
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-6">                                           
                                                    <input type="text" class="form-control" name="nombre" autocomplete="off" placeholder="Nombre del Fichero" value="COTIZACION <?php echo $factura; ?>" required><br>
                                                    <strong>Correo Electronico: </strong><br>
                                                    <input type="mail" class="form-control" name="email" autocomplete="off" placeholder="Correo Electronico" value="<?php echo $email_cliente; ?>" required><br>
                                                    <strong>Imprimir en: </strong><br>
                                                    <select name="imp" class="form-control">
                                                        <option value="correo">Enviar a Correo</option>
                                                        <option value="excel">Hoja de Excel</option>
                                                        <option value="pdf">Archivo PDF</option>
                                                    </select>
                                                    </div>                                                                                                                                                                                                                                                                                 
                                                </div>                                            
                                        </div> 
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn botonExcel">Imprimir</button>
                                            <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                                        </div>                                       
                                    </div>
                                </div>
                                </form>
                            </div>
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
                            <div class="<?php echo $activar; ?>">     
                            <strong>Cliente: </strong><?php echo $nom_cliente; ?><br>
                            <strong>Dirección: </strong><?php echo $dir_cliente; ?><br>                                                                          
                            <strong>Email: </strong><?php echo $email_cliente; ?><br>                                                                          
                            <strong>Tipo: </strong>COTIZACION<br>
                            <strong>Fecha de Entrega: </strong><?php echo fecha($fecha); ?>
                            </div>
                             <hr/>
                            <br>
                            <table class="table table-striped table-bordered table-hover" width="100%" rules="all"  border="1">
                                            <tr>
                                                <td><strong>CODIGO</strong></td>
                                                <td><strong>PRODUCTO</strong></td>                                              
                                                <td><strong>CANTIDAD</strong></td>                                              
                                                <td><div align="right"><strong>PRECIO UNI.</strong></div></td>
                                                <td><div align="right"><strong>TOTAL</strong></div></td>
                                                <td><div align="right"><strong>DESCUENTO</strong></div></td>
                                                <td><div align="right"><strong>IMPORTE</strong></div></td>
                                            </tr>
                                            <?php 
                                                $item=0;
                                                $neto=0;
                                                $neto_full=0;$subtotal=0;
                                                $pa=mysql_query("SELECT * FROM cotizador_tmp, inventario 
                                                WHERE cotizador_tmp.usu='$usu' and cotizador_tmp.articulo=inventario.articulo");             
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
                                                    ########################################
                                                    $new_valor=$row['ref'];
                                                    $importe_dos=$row['cant']*$new;
                                                    $neto_full=$neto_full+$importe_dos;
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
                                                        if($row['descto']==NULL){
                                                            $descuento='0';
                                                        }else{
                                                            $descuento=$row['descto'];
                                                        }
                                                    
                                                    ###############CALCULOS TOTALES#########################
                                                    $importe=$row['cant']*$new;
                                                    $imp_desc=$importe*$descuento/100;
                                                    if ($descuento==0) {
                                                        $imp_t=$importe;
                                                    }
                                                    else{
                                                        $imp_t=$importe-$imp_desc;
                                                    }
                                                    $neto=$neto+$importe;
                                                    $subtotal=$subtotal+$imp_t;
                                                    $oArticulo=new Consultar_Articulos($row['articulo']);
                                                    $p_nombre=$oArticulo->consultar('nombre');
                                                    ########################################
                                            ?>
                                            <tr>
                                                
                                                <td><?php echo $row['codigo']; ?></td>
                                                <td><?php echo $oArticulo->consultar('nombre');  ?></td>
                                                <td align="center"><?php echo $cantidad; ?></td>                                                
                                                <td><div align="right"><?php echo $s.' '.formato($new); ?></div></td>
                                                <td><div align="right"><?php echo $s.' '.formato($importe_dos); ?></div></td>
                                                <td><div align="center"><?php echo $row['descto']; ?> %</div></td>
                                                <td><div align="right"><?php echo $s.' '.formato($imp_t); ?></div></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="4"><div align="right"><strong>Total</strong></div></td>
                                                <td><div align="right"><strong>$ <?php echo formato($neto); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><div align="right"><strong>Sub Total</strong></div></td>
                                                <td><div align="right"><strong><?php echo $s.' '.formato($subtotal); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="6"><div align="right"><strong>Total</strong></div></td>
                                              <td><div align="right"><strong><?php echo $s.' '.formato($netoO); ?></strong></div></td>
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
                                <!-- ############################ TABLA OCULTA QUE SE ENVIA POR CORREO EN PDF ###################### -->
                                    <div class="hidden">
                                        <div  id="Exportar_a_Excel">
                                        <table  width="100%" style="border: 1px solid #660000; -moz-border-radius: 13px;-webkit-border-radius: 12px;padding: 10px;">
                                     <tr>
                                        <td>
                                           <!-- <center>
                                            <img src="./../../img/empresa.png" width="75px" height="75px"><br>
                                            </center> -->                                                   
                                        </td>
                                        <td align="center">                     
                                            <div style="font-size: 25px;"><strong><em><?php echo $nombre_empresa; ?></em></strong></div>
                                                   Usuario: <?php echo $cajero_nombre; ?>
                                                        Fecha y Hora: <?php echo fecha($fecha); ?> <?php echo date($hora); ?><br>
                                            <!--<strong><?php echo $nombre_empresa; ?></strong><br>-->                                                 
                                        </td>
                                        <td>
                                            <!--<center>
                                                 <?php
                                                    if (file_exists("../../usuarios/".$_SESSION['cod_user'].".jpg")){
                                                      echo '<img src="../../usuarios/'.$_SESSION['cod_user'].'.jpg" width="50" height="50" class="img-polaroid img-polaroid">';
                                                    }else{
                                                      echo '<img src="../../img/usuario/default.png" width="80" height="80">';
                                                    }
                                                  ?>
                                            </center>--> 
                                        </td>
                                     </tr>                          
                                    </table><br>
                                      
                                          <div style="font-size: 14px;"align="center">
                                             <strong>COTIZACION DE PRODUCTOS</strong><br>                              
                                        </div> 
                                       
                                         <table width="100%" border="1" rules="all" style="12px; 12px;padding: 12px;">
                                            <tr>
                                                <td><strong>Codigo</strong></td>
                                                <td><strong>Producto</strong></td>                                              
                                                <td><strong>cant.</strong></td>                                              
                                                <td><div align="right"><strong>Precio.</strong></div></td>
                                                <td><div align="right"><strong>Total</strong></div></td>
                                                <td><div align="right"><strong>Descuento</strong></div></td>
                                                <td><div align="right"><strong>Importe</strong></div></td>
                                            </tr>
                                            <?php 
                                                $item=0;
                                                $neto=0;
                                                $neto_full=0;$subtotal=0;
                                                $pa=mysql_query("SELECT * FROM cotizador_tmp, inventario 
                                                WHERE cotizador_tmp.usu='$usu' and cotizador_tmp.articulo=inventario.articulo");             
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
                                                    ########################################
                                                    $new_valor=$row['ref'];
                                                    $importe_dos=$row['cant']*$new;
                                                    $neto_full=$neto_full+$importe_dos;
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
                                                        if($row['descto']==NULL){
                                                            $descuento='0';
                                                        }else{
                                                            $descuento=$row['descto'];
                                                        }
                                                    
                                                    ###############CALCULOS TOTALES#########################
                                                    $importe=$row['cant']*$new;
                                                    $imp_desc=$importe*$descuento/100;
                                                    if ($descuento==0) {
                                                        $imp_t=$importe;
                                                    }
                                                    else{
                                                        $imp_t=$importe-$imp_desc;
                                                    }
                                                    $neto=$neto+$importe;
                                                    $subtotal=$subtotal+$imp_t;
                                                    $oArticulo=new Consultar_Articulos($row['articulo']);
                                                    $p_nombre=$oArticulo->consultar('nombre');
                                                    ########################################
                                            ?>
                                            <tr>
                                                
                                                <td><?php echo $row['codigo']; ?></td>
                                                <td><?php echo $oArticulo->consultar('nombre');  ?></td>
                                                <td align="center"><?php echo $cantidad; ?></td>                                                
                                                <td><div align="right"><?php echo $s.' '.formato($new); ?></div></td>
                                                <td><div align="right"><?php echo $s.' '.formato($importe_dos); ?></div></td>
                                                <td><div align="center"><?php echo $row['descto']; ?> %</div></td>
                                                <td><div align="right"><?php echo $s.' '.formato($imp_t); ?></div></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="4"><div align="right"><strong>Total</strong></div></td>
                                                <td><div align="right"><strong>$ <?php echo formato($neto); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><div align="right"><strong>Sub Total</strong></div></td>
                                                <td><div align="right"><strong><?php echo $s.' '.formato($subtotal); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                              <td colspan="6"><div align="right"><strong>Total</strong></div></td>
                                              <td><div align="right"><strong><?php echo $s.' '.formato($netoO); ?></strong></div></td>
                                            </tr>
                                        </table><br><br>
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
        $mensaje='Venta al "'.$status.'"';
        mysql_query("INSERT INTO fact_cot (factura,valor,fecha,estado,almacen,usu) VALUE ('$factura','$netoO','$fecha','s','$id_almacen','$usu')");
        mysql_query("DELETE FROM cotizador_tmp WHERE usu='$usu'");
        mysql_query("DELETE FROM clcot_tmp WHERE usu='$usu'");
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
