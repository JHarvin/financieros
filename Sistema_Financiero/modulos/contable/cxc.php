<?php
    session_start();
    include_once "../php_conexion.php";
    include_once "class/class.php";
    include_once "../funciones.php";
    include_once "../class_buscar.php";
    $verdaderaMora;
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


    if(!empty($_GET['id'])){
        //soy el id el que te esta salvando la vida en esta pantalla
         $id=limpiar($_GET['id']);

        $fechaCon=date('Y-m-d');
        $x_mora=mysql_query("SELECT proximo_pago FROM abono WHERE cuenta='$id' ORDER BY proximo_pago DESC LIMIT 1");
            while ($ver=mysql_fetch_array($x_mora)) {
                # code...
                $b= explode("-",$ver['proximo_pago']);
                $xy=$b[1];
            }
            //*****************

            //-*****************

        $sql=mysql_query("SELECT * FROM contable WHERE id='$id' and tipo='CXC'");
        if($row=mysql_fetch_array($sql)){
            $concepto1=$row['concepto1'];
            $fecha=$row['fecha'];
            $intento=explode("-",$row['fecha']);
            $a=$intento[2];
            $concepto2=$row['concepto2'];
            $hora=$row['hora'];
            $deuda=$row['valor'];
            $inte=$row['interes'];
            $cuota=$row['cuota'];
            $interesT=$row['to_interes'];
            $prima=$row['prima'];
            $oCliente=new Consultar_Clientes($row['concepto1']);

        }else{
            return header('Location: index.php');
        }
        //*********************
        //**************mora**************
           //QUE COMIENCE EL JUEGO PRIMERA VALIDACION
// VALIDAR QUE NO AYAN ABONOS
 $val_abonos=mysql_query("SELECT*FROM abono WHERE cuenta='$id'");
 if (mysql_num_rows($val_abonos)>0) {

      $mora_ultima=mysql_query("SELECT*FROM abono WHERE cuenta='$id' ORDER BY id_abono DESC LIMIT 1");
     while ($m= mysql_fetch_array($mora_ultima)){
         $fechaProximoPago=$m['proximo_pago'];
         $Pago=$m['fecha'];
     }
  $fecha = date('Y-m-d');
    $x = explode("-", $fecha);
    $añox = $x[0];
    $mesx = $x[1];
    $diax = $x[2];

     $y = explode("-", $fechaProximoPago);
    $añoy = $y[0];
    $mesy = $y[1];
    $diay = $y[2];

    $fecha1 = mktime(0, 0, 0, "$mesy", "$diay", "$añoy");
    $fecha2 = mktime(0, 0, 0, "$mesx", "$diax", "$añox");

    $diferencia = $fecha2 - $fecha1;
    $diasSinMora = $diferencia / (60 * 60 * 24);
    if ($diasSinMora<0) {
        $PagoMora='SIN MORA';
    } else {
        $uno=$cuota*0.05;
        $valor= round($uno*$diasSinMora,2);
        if ($valor==0) {
            $PagoMora=0;
        }else{
           $PagoMora=$valor;
        }


    }
}else{

    $mora_ultima=mysql_query("SELECT*FROM contable WHERE id='$id'");
     while ($m= mysql_fetch_array($mora_ultima)){
         $fechaCompro=$m['fecha'];
     }

 $nuevafecha = strtotime('+1 month', strtotime($fechaCompro));
 $nuevafecha = date('Y-m-d', $nuevafecha);

  $fecha = date('Y-m-d');
    $x = explode("-", $fecha);
    $añox = $x[0];
    $mesx = $x[1];
    $diax = $x[2];

     $y = explode("-", $nuevafecha);
    $añoy = $y[0];
    $mesy = $y[1];
    $diay = $y[2];

    $fecha1 = mktime(0, 0, 0, "$mesy", "$diay", "$añoy");
    $fecha2 = mktime(0, 0, 0, "$mesx", "$diax", "$añox");

    $diferencia = $fecha2 - $fecha1;
    $diasSinMora = $diferencia / (60 * 60 * 24);
    if ($diasSinMora<0) {
        $PagoMora='SIN MORA';
    } else {
        $uno=$cuota*0.05;
        $valor= round($uno*$diasSinMora,2);
        if ($valor==0) {
            $PagoMora=0;
        }else{
           $PagoMora=$valor;
        }



}
}
                    //******************fin mora*********
        //****************
    }else{
        return header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo 'CxC No. '.$id; ?></title>
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
    <div id="wrapper" style="background-color:#4161CF;">

        <!--/. NAV TOP  -->

            <?php include_once "../../menu/m_venta.php"; ?>

        <!-- /. NAV SIDE  -->

            <div id="page-inner">
                 <?php
                if(!empty($_POST['valor'])){
                    $valor=limpiar($_POST['valor']);
                    $proxi=limpiar($_POST['proximo']);
                    $mora=limpiar($_POST['mora']);
                    if(!empty($_POST['nota'])){
                        $nota=limpiar($_POST['nota']);
                    }else{
                        $nota='Sin Observaciones';
                    }
                    //calculo de interes por mes y abono a capital
                    $ver= mysql_query("SELECT valor, interes FROM contable WHERE id='$id'");
                    while ($filita=mysql_fetch_array($ver)) {
                        # code...
                        $intCalculo=$filita['interes'];
                        $monto=$filita['valor'];
                    }
                    //calculo de intereses por mes y abono a capital
                    $validar=mysql_query("SELECT * FROM abono WHERE cuenta='$id'");
                    if (mysql_num_rows($validar)>0) {
                        # code...
                 $calculoValor=($valor-(($monto-abonos_saldo($id))*(($intCalculo/100)/12)));
                 $aboInteres=(($monto-abonos_saldo($id))*(($intCalculo/100)/12));
                    }else{
                        $calculoValor=$valor-(($monto)*(($intCalculo/100)/12));
                        $aboInteres=(($monto)*(($intCalculo/100)/12));
                    }
                    $fecha=date('Y-m-d');
                    $hora=date('H:i:s');





                    mysql_query("INSERT INTO abono (cuenta,valor,fecha,hora,nota,usu,total_interes,proximo_pago,mora) VALUES ('$id','$calculoValor','$fecha','$hora','$nota','$usu','$aboInteres','$proxi','$mora')");

                    mysql_query("INSERT INTO contable (concepto1,concepto2,tipo,valor,fecha,hora,usu,consultorio,clase)
                        VALUES ('Abono CXC No. $id','Sin Observaciones','ENTRADA','$calculoValor','$fecha','$hora','$usu','$id_almacen','CXC')");
                    echo mensajes("El Abono a la Cuenta por Cobrar No. ".$id." por valor de ".$s." ".formato($valor)." ha sido registrado con exito","verde");

                }
                ?>
                <table class="table table-bordered">
                <tr class="info">
                    <td><strong>Cuenta por Cobrar: </strong> <span class="badge"><?php echo $id; ?></span><br></td>
                    <td><strong>Cuota mensual: </strong> <span class="badge"><?php echo '$'.$cuota; ?></span><br></td>
                    <td><strong>Cliente: </strong> <?php echo $oCliente->consultar('nombre'); ?><br></td>
                    <td><strong>Fecha: </strong> <?php echo fecha($fecha).' '.$hora; ?></td>
                    <td><strong>Prima: <?php echo "$ ".$prima;?></strong></td>
                </tr>
            </table>
            <div class="row-fluid">
                <div class="col-md-4 text-danger" align="center" style="font-size:20px; color: red">
                    <strong>Total Deuda</strong><br>
                    <strong> <?php echo $s.' '.formato($deuda); ?></strong>
                </div>
                <div class="col-md-4 text-info" align="center" style="font-size:20px; color: black">
                    <strong>Total Abonado</strong><br>
                    <strong><?php echo $s.' '.formato(abonos_saldo($id)); ?></strong>
                </div>
                <div class="col-md-4 text-success" align="center" style="font-size:20px; color: white">
                    <strong>Saldo Faltante</strong><br>
                    <strong><?php echo $s.' '.formato($deuda-abonos_saldo($id)); ?></strong>
                </div>

            </div><br><br><br>
             <?php
                $por=abonos_saldo($id)*100/$deuda;
            ?>
            <strong><center><?php echo 'Total Abonado: '.formato($por).'% || Total Saldo '.formato(100-$por).'%'; ?></center></strong>
            <div class="progress progress-striped active">
                <div class="progress-bar" role="progressbar" style="width: <?php echo $por; ?>%;"></div>
            </div>
            <!-- intereses-->
                <div class="row-fluid">
                <div class="col-md-4 text-danger" align="center" style="font-size:20px; color: red">
                    <strong>Total de interes</strong><br>
                    <strong> <?php echo $s.' '.formato($interesT); ?></strong>
                </div>
                <div class="col-md-4 text-info" align="center" style="font-size:20px; color: black">
                    <strong>Total Abonado</strong><br>
                    <strong><?php echo $s.' '.formato(abonos_interes($id)); ?></strong>
                </div>
                <div class="col-md-4 text-success" align="center" style="font-size:20px; color: white">
                    <strong>Saldo Faltante</strong><br>
                    <strong><?php echo $s.' '.formato($interesT-abonos_interes($id)); ?></strong>
                </div>
            </div><br><br><br>
             <?php
                $por=abonos_interes($id)*100/$interesT;
            ?>
            <strong><center><?php echo 'Total Abonado: '.formato($por).'% || Total Saldo '.formato(100-$por).'%'; ?></center></strong>
            <div class="progress progress-striped active">
                <div class="progress-bar" role="progressbar" style="width: <?php echo $por; ?>%;"></div>
            </div>
            <!--fin de interese-->
            <div class="col-md-3">
                     <label>Mora</label>

                    <input type="text" name="moraVer" value="<?php echo $PagoMora;?>" autocomplete="off" class="form-control">

                    </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                         <div class="panel-body" align="center">
                           <a href="index.php">
                            <button type="button" class="btn btn-primary btn-circle"><i class="fa fa-arrow-left fa-2x" title="Regresar"></i>
                            </button></a>
                         <?php
                            if($deuda-abonos_saldo($id)<>0){
                                echo ' <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#abono"><i class="fa fa-plus fa-2x" title="Agregar Nuevo Abono"></i>
                                      </button>';
                        }
                        ?>
                  </div>
                </div>
                <div class="col-md-4"></div>
                 <!--  Modals-->
                     <div class="modal fade" id="abono" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="forms" method="post" action="">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                            <h3 align="center" class="modal-title" id="myModalLabel">Registrar<br><?php echo 'Cuenta por Cobrar No. '.$id; ?></h3>
                                        </div>
                                        <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Valor del Abono:</label>
                                                <input type="text" name="valor" value="1" min="1" max="<?php echo $deuda-abonos_saldo($id); ?>" autocomplete="off" required class="form-control"><br><br>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Proximo pago:</label>
                                                <input type="date" name="proximo" value="1" min="1" max="<?php echo $deuda-abonos_saldo($id); ?>" autocomplete="off" required class="form-control"><br><br>
                                            </div>
                                            <div class="col-md-6">
                                                 <label>Observaciones</label>
                                                <input type="text" name="nota" autocomplete="off" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                 <label>Mora</label>
                                                <input type="text" name="mora" autocomplete="off" class="form-control">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Registrar</button>
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
                             ABONOS REALIZADOS
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>FECHA</th>
                                            <th>OBSERVACION</th>
                                            <th>RESPONSABLE</th>
                                            <th><div align="right"><strong>VALOR</strong></div></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql=mysql_query("SELECT * FROM abono WHERE cuenta='$id'");
                                            while($row=mysql_fetch_array($sql)){
                                        ?>
                                            <tr>
                                                <td><center><?php echo fecha($row['fecha']).' - '.$row['hora']; ?></center></td>
                                                <td><?php echo $row['nota']; ?></td>
                                                <td><?php echo consultar('nom','persona',' doc='.$row['usu']); ?></td>
                                                <td><div align="right"><?php echo $s.' '.formato($row['valor']) ?></div></td>
                                                <td></td>
                                            </tr>
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
