<?php
$clienteInfo = $_REQUEST['clienteinfo'];

$con = new mysqli('localhost', 'root', '', 'financiero');
$datos = $con->query("SELECT
activo.fecha_adquisicion AS fecha,
activo.id_activo AS id,
usuario.nombre AS nombreUser,
departamento.nombre AS dep,
institucion.nombre AS nombreInst,
tipo_activo.id_clasificacion,
tipo_activo.nombre AS tipo,
CONCAT_WS(' ',encargado.nombre, encargado.apellido) AS encargado,
TRUNCATE((activo.precio),2) AS precio,
clasificacion.id_clasificacion as clasi,
CONCAT_WS('-',institucion.correlativo, departamento.correlativo, tipo_activo.correlativo, activo.correlativo) AS codiguito,

clasificacion.nombre as ncla
FROM
activo
INNER JOIN usuario ON activo.id_usuario = usuario.id_usuario
INNER JOIN departamento ON activo.id_departamento = departamento.id_departamento
INNER JOIN institucion ON activo.id_institucion = institucion.id_institucion
INNER JOIN tipo_activo ON activo.id_tipo = tipo_activo.id_tipo
INNER JOIN encargado ON activo.encargado_id_encargado = encargado.id_encargado
INNER JOIN clasificacion ON tipo_activo.id_clasificacion = clasificacion.id_clasificacion
WHERE
activo.id_activo = '$clienteInfo'
");
?>


<?php
include_once '../conexion/conexion.php';

$correlativoAct = mysqli_query($conexion, "SELECT
institucion.correlativo AS nombreInst,
departamento.correlativo AS dep,
tipo_activo.correlativo AS tipoacti,
activo.id_activo,
activo.correlativo AS activ
FROM
activo
INNER JOIN departamento ON activo.id_departamento = departamento.id_departamento
INNER JOIN institucion ON activo.id_institucion = institucion.id_institucion
INNER JOIN tipo_activo ON activo.id_tipo = tipo_activo.id_tipo
WHERE activo.id_activo=11")
?>
<style type="text/css">
    .row table caption.genesis{
        padding-top: 50px;
    }
    table.maribel{
        padding-top: 50px;
    }

    input.text-center{
        border: 1px solid #0091ea;
        border-radius: 6px;
        float: left;
    }

     div.cosita{
        padding-left: 40%;
    }


    
     
</style>
<div class="row" >
    <!--<form id="imprimir_depre" method="post" action="../reportesActivo/imp_depre.php" target="_blank">-->
        <?php while ($fila = mysqli_fetch_array($datos)) { ?>
            <div>
                
                <table id="no_imp" class="table table-striped table-bordered">
                    <tbody> 

                        <tr class="text-accent-1">
                            <td  style="height:15px;">
                                <div class="cosita" >
                                    <i class="fa fa-pencil-square-o"></i>
                                    <label for="codigo" style="font-size:15px;">C&oacutedigo</label><br>
                                    <input class="input-group text-center" id="ver_cod_depre" name="ver_cod_depre" value="<?php echo $fila['codiguito']; ?>"  minlength="8"  readonly=""   >

                                </div>
                            </td>

                            <td colspan="4" style="height:15px;" >
                                <div class="cosita">
                                    <i class="fa fa-pencil-square-o"></i>
                                    <label for="textarea1" style="font-size:15px;">Clasificacion</label><br>
                                    <input class="input-group text-center" type="text" id="ver_clasif" name="ver_clasif" value="<?php echo $fila['ncla']; ?>"  minlength="8"  readonly=""   >

                                </div>
                            </td>

                        </tr>

                        <tr class="text-accent-1" >
                            <td style="height:10px;"><div class="col m12">
                                    <div class="input-field col m12 cosita">
                                        <i class="fa fa-calendar prefix" aria-hidden="true"></i>
                                        <label for="fecha_pub"  class="active" style="font-size:16px;">Fecha Adquisición</label><br>
                                        <input class="input-group text-center" type="text" name="ver_fecha_depre" value="<?php echo $fila['fecha']; ?>"  id="ver_fecha_depre" readonly=""   >
                                    </div>
                                </div></td>

                            <td style="height:10px;">
                                <div class="input-field col m12 cosita">
                                    <i class="fa fa-usd prefix"></i> 
                                    <label for="precioUnitario" style="font-size:16px;">Valor del Activo<small></small> </label><br>
                                    <input type="input-group text" name="ver_valor" value="<?php echo $fila['precio']; ?>" min="0" step="any" id="ver_valor"  class="input-group text-center validate" readonly="">
                                </div>
                            </td>
                        </tr>

                        <tr class="text-accent-1" >



                            <td style="height:10px;">
                                <div class="input-field col m12 cosita">
                                    <i class="fa fa-usd prefix"></i> 
                                    <label for="precioUnitario" style="font-size:16px;">Tipo<small></small> </label><br>
                                    <input type="text" name="ver_valor" value="<?php echo $fila['tipo']; ?>" min="0" step="any" id="ver_valor"  class="input-group text-center validate" readonly="">
                                </div>
                            </td>



                            <td style="height:10px;">
                                <div class="input-field col m12 cosita">
                                    <i class="fa fa-usd prefix"></i> <label for="precioUnitario" style="font-size:16px;">Encargado<small></small> </label><br>
                                    <input type="text" name="ver_valor" value="<?php echo $fila['encargado']; ?>" min="0" step="any" id="ver_valor"  class="input-group text-center validate" readonly="">

                                </div>
                            </td>
                        </tr>
                        <tr class="text-accent-1" >
                            <td ><div class="col m12 cosita">
                                    <div class="input-field">
                                        <i class="fa fa-calendar prefix" aria-hidden="true"></i>
                                        <label for="fecha_pub"  class="active" style="font-size:16px;">Institucion</label><br>
                                        <input type="text" class="input-group text-center" name="ver_fecha_depre" value="<?php echo $fila['nombreInst']; ?>" id="ver_fecha_depre" readonly=""   >
                                    </div>
                                </div></td>
                            <td >
                                <div class="input-field col m12 cosita">
                                    <i class="fa fa-usd prefix"></i> <label for="precioUnitario" style="font-size:16px;">Departamento<small></small> </label><br>
                                    <input type="text" name="ver_valor" value="<?php echo $fila['dep']; ?>"min="0" step="any" id="ver_valor"  class="input-group text-center validate" readonly="">

                                </div>
                            </td>
                        </tr>


                    </tbody>
                </table>
                
            </div>


            <table id="ver_depre_tab" class="table table-striped table-bordered maribel">
                <caption class="genesis"><strong>Depreciación por año</strong></caption>
                <thead>
                <th class="text-center" >Año</th>
                <th class="text-center">Valor del Activo</th>
                <th class="text-center">Depreciación</th>
                <th class="text-center">Valor Neto</th>
                </thead>
                <tbody>
                    <?php
                    if ($fila['clasi'] == "1")
                        $veces = 2;
                    if ($fila['clasi'] == "2")
                        $veces = 4;
                    if ($fila['clasi'] == "3")
                        $veces = 5;
                    if ($fila['clasi'] == "4")
                        $veces = 20;
                    if ($fila['clasi'] == "5")
                        $veces = 0;
                    $ano = explode('-', $fila['fecha']);
                    $ano = $ano[0];
                    $valor = $fila['precio'];
                    $depre = $valor / $veces;
                    $vn = $valor - $depre;

                    for ($i = 0; $i < $veces; $i++) {
                        ?>
                        <tr>
                            <td class="text-center" > <?php echo ($ano + $i); ?></td>
                            <td class="text-center" > <?php echo "$";?> <?php echo $valor; ?> </td>
                            <td class="text-center" > <?php echo "$";?>  <?php echo $depre; ?></td>
                            <td class="text-center" > <?php echo "$";?> <?php echo $vn; ?> </td>
                        </tr> 
                        <?php
                        $vn = $vn - $depre;
                    }
                    ?>
                </tbody>
            </table>

    </div>
    <a href="javascript:history.back(1)">

        <a href="../activo_fijo/Lista.php">
            <button class="btn btn-info" type="button" > 
                <i class="fa fa-eye"></i>Volver</button>
        </a>
        <?php
    }
    ?>
<!--</form>-->
</div>



