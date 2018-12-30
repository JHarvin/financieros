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
    
   $bus='';#inicializar la variable
        if(!empty($_GET['estado'])){
            $nit=limpiar($_GET['estado']);
            $cans=mysql_query("SELECT * FROM resumen WHERE id='$nit'");
            if($dat=mysql_fetch_array($cans)){
                if($dat['status']=='PROCESADO'){                    
                    $xSQL="Update resumen Set status='PENDIENTE' WHERE id='$nit'";
                    mysql_query($xSQL);
                    header('location:index.php');
                }else{
                    $xSQL="Update resumen Set status='PROCESADO' WHERE id='$nit'";
                    mysql_query($xSQL);
                    header('location:index.php');
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
            <?php include_once "../../menu/m_caja.php"; ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <?php if(permiso($_SESSION['cod_user'],'11')==TRUE){ ?>
             <?php 
                if(!empty($_POST['trans']) and !empty($_POST['concepto1'])){
                    $tipo=limpiar($_POST['trans']);                 
                    $valor=limpiar($_POST['valor']);
                    $concepto1=limpiar($_POST['concepto1']);        
                    $fecha=date('Y-m-d');
                    $concepto2=limpiar($_POST['concepto2']);        
                    $hora=date('H:i:s');
                    
                    $sql=mysql_query("SELECT * FROM contable WHERE concepto1='$concepto1' and concepto2='$concepto2' and fecha='$fecha' and valor='$valor' and tipo='$tipo'");
                    if($row=mysql_fetch_array($sql)){
                        echo mensajes('No se permiten datos duplicados en la base de datos','rojo');
                    }else{
                        mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio) 
                        VALUES ('$concepto1','$concepto2','$tipo','$valor','$fecha','$hora','$usu','$id_almacen')");
                        echo mensajes('El Registro Contable ha sido Registrado con Exito','verde');
                    }
                }
            ?>
          
			 
               <center>
                 <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#add" title="Agregar Gasto"><i class="fa fa-plus fa-2x"></i>
                </button>
                </center><br>
                      <!-- Modal -->                      
                            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <form name="form2" action="" method="post">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="panel-body">
                                        <div class="col-md-6" > 
                                            <strong>Concepto 1</strong><br>
                                            <input  class="form-control" name="concepto1" value="" autocomplete="off" required><br>
                                            <strong>Valor</strong><br>
                                            <input  class="form-control" name="valor" value="1" autocomplete="off" min="1" required><br>
                                            <strong>Tipo de Transaccion</strong><br>
                                             <select class="form-control" name="trans">
                                                <option value="INGRESO">INGRESO</option>
                                                <option value="EGRESO">EGRESO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6" > 
                                            <strong>Concepto 2</strong><br>
                                            <textarea class="form-control" name="concepto2" style="width:90%; height:140px">Sin Observaciones</textarea>
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
            
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            CAJA CHICA
                        </div>
                        <div class="panel-body">
                        <table class="table table-bordered">
			                <tr class="info">
			                    <td>
			                         <?php 
			                            $salida=0;$entrada=0;$cxp=0;$cxc=0;
			                            $sql=mysql_query("SELECT * FROM contable WHERE date_format(fecha,'%Y%m%d')=date_format(curdate(),'%Y%m%d') AND consultorio=$id_almacen");
			                            while($row=mysql_fetch_array($sql)){
			                                if($row['tipo']=='INGRESO'){
			                                    $entrada=$entrada+$row['valor'];
			                                }elseif($row['tipo']=='EGRESO'){
			                                    $salida=$salida+$row['valor'];
			                                }
			                            }
			                        ?>
			                        <div class="row-fluid">
			                            <div class="col-md-4 text-success"  align="center">
			                                <strong>TOTAL INGRESOS</strong><br>
			                                <strong><?php echo $s.' '.formato($entrada); ?></strong>
			                            </div>
			                            <div class="col-md-4 text-danger" align="center">
			                                <strong>TOTAL EGRESOS</strong><br>
			                                <strong><?php echo $s.' '.formato($salida); ?></strong>
			                            </div>
			                            <div class="col-md-4" align="center">
			                                <strong>SALDO CAJA CHICA</strong><br>
			                                <strong><?php echo $s.' '.formato($entrada-$salida); ?></strong>
			                            </div><br>
			                        </div><br>
		                             </td>
					                </tr>
					            </table>
                            		<?php 
                                if(!empty($_GET['fechaf']) and !empty($_GET['fechai']) and !empty($_GET['tip'])){
                                    $fechai=limpiar($_GET['fechai']);
                                    $fechaf=limpiar($_GET['fechaf']);
                                    $tip=limpiar($_GET['tip']);
                                }else{
                                    $fechai=date('Y-m-d');
                                    $fechaf=date('Y-m-d');
                                    $tip='';
                                }
                            ?>
                            <form name="gor" action="" method="get" class="form-inline">
                            <div class="row-fluid">
                                <div class="col-md-4" align="center">
                                    <strong>Fecha Inicial</strong><br>
                                    <input type="date" class="form-control" name="fechai" autocomplete="off" required value="<?php echo $fechai; ?>">
                                </div>
                                <div class="col-md-4" align="center">
                                    <strong>Fecha Finalizar</strong><br>
                                    <input type="date" class="form-control" name="fechaf" autocomplete="off" required value="<?php echo $fechaf; ?>">
                                </div>
                                <div class="col-md-4" align="center">
                                    <strong>Seleccionar</strong><br>
                                    <select class="form-control" name="tip">                                                                       
                                        <option value="INGRESO" <?php if($tip=='INGRESO'){ echo 'selected'; } ?>>INGRESO</option>                                                                            
                                        <option value="EGRESO" <?php if($tip=='EGRESO'){ echo 'selected'; } ?>>EGRESO</option>                                                                            
                                    </select>
                                    <button type="submit" class="btn btn-icon waves-effect waves-light btn-primary m-b-5"><strong>Consultar</strong></button>
                                </div>
                            </div><br>  
                            </form><br><br>
                             <center><button onclick="imprimir();" class="btn btn-success"><i class=" fa fa-print "></i> Imprimir</button></center><br>
						<div style="width:100%; height:700px; overflow: auto;">
						 <div id="imprimeme">
                                     <br>
                                     <div class="hidden">
                                     <table  width="100%" style="border: 1px solid #660000; -moz-border-radius: 13px;-webkit-border-radius: 12px;padding: 10px;">
                                     <tr>
                                        <td>
                                            <center>
                                            <img src="../../img/logo.jpg" width="75px" height="75px"><br>
                                            <!--<strong><?php echo $nombre_empresa; ?></strong><br>-->
                                            </center>                                                    
                                        </td>
                                        <td align="center">                     
                                            <div style="font-size: 25px;"><strong><em><?php echo $nombre_empresa; ?></em></strong></div>
                                                   Usuario: <?php echo $cajero_nombre; ?>
                                                        Fecha y Hora: <?php echo fecha($fecha); ?> <?php echo date($hora); ?><br>
                                            <!--<strong><?php echo $nombre_empresa; ?></strong><br>-->                                                 
                                        </td>
                                        <td>
                                            <center>
                                                 <?php
                                                    if (file_exists("../../usuarios/".$_SESSION['cod_user'].".jpg")){
                                                      echo '<img src="../../usuarios/'.$_SESSION['cod_user'].'.jpg" width="50" height="50" class="img-polaroid img-polaroid">';
                                                    }else{
                                                      echo '<img src="../../img/usuario/default.png" width="80" height="80">';
                                                    }
                                                  ?>
                                            </center> 
                                        </td>
                                     </tr>                          
                                    </table><br>
                                      <hr/>
                                          <div style="font-size: 14px;"align="center">
                                             <strong>REPORTES DE EGRESO</strong><br>                              
                                        </div> 
                                        <hr/>
                                    </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover"  width="100%" style="font-size: 12px;"  border="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>DESCRIPCION</th>                                                                                      
                                            <th>TIPO</th>                                                                                     
                                            <th>FECHA REGISTRO</th>
                                            <th>VALOR</th>
                                            <th>RESPONSABLE</th>
                                                                                     
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php 
                                   				$neto=0;
                                                $sql=mysql_query("SELECT * FROM  contable WHERE tipo='$tip' and fecha between '$fechai' AND '$fechaf'");
                                                while($row=mysql_fetch_array($sql)){
                                                    if($row['tipo']=='INGRESO'){
                                                        $tipo='<span class="label label-success">INGRESO</span>';
                                                    }elseif($row['tipo']=='EGRESO'){
                                                        $tipo='<span class="label label-danger">EGRESO</span>';
                                                    }
                                                    $oCliente=new Consultar_Clientes($row['concepto1']);
                                                    $oProveedor=new Consultar_Proveedor($row['concepto1']);
                                                    if($row['tipo']=='CXC'){
                                                       $c_nombre=$oCliente->consultar('nombre');
                                                    }
                                                    elseif($row['tipo']=='CXP'){
                                                        $c_nombre=$oProveedor->consultar('nombre');
                                                    }
                                                    else
                                                    {
                                                       $c_nombre=$row['concepto1'];     
                                                    }
                                                    $neto=$neto+$row['valor'];                                                   
                                            ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $c_nombre; ?></td>
                                            <td><center><?php echo $tipo; ?></center></td>
                                            <td><center><?php echo fecha($row['fecha']).' '.$row['hora']; ?></center></td>
                                            <td><div align="right"><?php echo $s.' '.formato($row['valor']); ?></div></td>
                                            <td><?php echo consultar('nom','persona',' doc='.$row['usu']); ?></td>
                                            
                                        </tr> 
                                        <?php } ?>
                                         <tr>
                                                             <td colspan="4"><div align="right"><strong><h4>Total General</h4></strong></div></td>
                                                             <td><div align="right"><strong><h4>$ <?php echo formato($neto); ?></h4></strong></div></td>
                                                        </tr>                                                                             
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
    
   
</body>
</html>
