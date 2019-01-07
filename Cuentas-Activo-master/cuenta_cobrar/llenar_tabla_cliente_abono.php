<?php
include_once '../app/Conexion.php';
include_once '../modelos/persona_natural.php';
include_once '../repositorios/repositorio_expediente_natural.php';
Conexion::abrir_conexion();

$id = explode("-", $_POST['libro']);
$cual = $id[1];
$id = $id[0];
if ($cual == "N") {
    $listado = repositorio_expediente_natural::obtener_persona_natural_abono(Conexion::obtener_conexion(), $id);
} else {
    $listado = repositorio_expediente_natural::obtener_persona_juridica_abono(Conexion::obtener_conexion(), $id);
}
foreach ($listado as $fila) {
    ?>
    <script type="text/javascript">
        //alert("codigo");
    
        document.getElementById('nprestamo_fat').innerHTML = "NO. PRESTAMO: <?php echo $fila['idp'] ?>";
        document.getElementById('id_prestamo_abono').value = "<?php echo $fila['idp'] ?>";
        document.getElementById('nombre_fat').innerHTML = "NOMBRE: <?php echo $fila['nombre'] ?>";
        document.getElementById('fecha_pres_fat').innerHTML = "FECHA DE APLICACION: <?php echo date_format(date_create($fila['fech']), 'd-m-Y'); ?>";
        document.getElementById('nit_fat').innerHTML = "NIT: <?php echo $fila['nit'] ?>";

    <?php
    if ($cual == "N") { ?>
        // document.getElementById('tipoID').innerHTML = "NCR " ;
            document.getElementById('dui_fat').innerHTML = "DUI: <?php echo $fila['dui'] ?>";
        <?php
    } else { ?>
         //document.getElementById('tipoID').innerHTML = "NCR " ;
         document.getElementById('dui_fat').innerHTML = "DUI: <?php echo $fila['dui'] ?>";
    <?php } ?>

        document.getElementById('fecha_pago_fat').innerHTML = "FECHA: <?php echo date("d-m-Y"); ?>";
        document.getElementById('fecha_fin_fat').innerHTML = "FECHA VENCIMIENTO: <?php echo date_format(date_create($fila['vence']), 'd-m-Y'); ?>";
        //document.getElementById('fecha_ultimo_fat').innerHTML = "FECHA ULTIMO PAGO: <?php echo date("d-m-Y"); ?>";
        document.getElementById('monto_fat').innerHTML = "MONTO: $ <?php echo $fila['monto'] ?>";

        document.getElementById('tasa_fat').innerHTML = "TASA NOMINAL:  <?php echo $fila['tasa'] ?>%";
        document.getElementById('cap_fat').innerHTML = "$ 0";
        document.getElementById('saldo_ant_fat').innerHTML = "SALDO ANTERIOR: $ <?php echo $fila['sact'] ?>";
        document.getElementById('saldo_act_fat').innerHTML = "SALDO ACTUAL: $ 0";
        document.getElementById('mora_fat').innerHTML = "$ <?php echo $fila['mora'] ?>";
        document.getElementById('nom_caj_fat').innerHTML = "<?php echo $fila['nombreuser'] ?>";
        document.getElementById('total_fat').innerHTML = "$ <?php echo "cal toal" ?>";
        document.getElementById('int_fat').innerHTML = "$ <?php echo $fila['intacu'] ?>";
        document.getElementById('id_cajero_fat').innerHTML = "CAJERO NO:  <?php echo $fila['idu'] ?>";

        var tasa_personaa = <?php echo $fila['tasa'] ?> / 100 / 12;
        var tasa_personaa2 = <?php echo $fila['tasa'] ?> / 100;
        var monto_personaa = "<?php echo $fila['monto'] ?>";
        var meses_personaa = "<?php echo $fila['tiempo'] ?>";
        document.getElementById('saldo_act').value = "<?php echo $fila['sact'] ?>";
        document.getElementById('interes').value = tasa_personaa2;
        document.getElementById('fecha_pago').value = "<?php echo $fila['pp'] ?>";
        document.getElementById('fecha_hoy').value = "<?php echo date("Y-m-d"); ?>";
        document.getElementById('pj').value = "<?php echo $cual; ?>";
        var cuota_personaa = 0;

        cuota_personaa = monto_personaa * ((Math.pow(1 + tasa_personaa, meses_personaa) * tasa_personaa) / (Math.pow(1 + tasa_personaa, meses_personaa) - 1));
        cuota_personaa = cuota_personaa.toFixed(2);
        document.getElementById('cuota_hoy').value = cuota_personaa;
        document.getElementById('cuota_fat').innerHTML = "CUOTA: $ " + cuota_personaa;
       
        var codigo = "<?php echo $fila['idper']; ?>";

        if (true) {

            var nombre = "<?php echo $fila['nombre']; ?>";
            var dui = "<?php echo $fila['dui']; ?>";
            var nit = "<?php echo $fila['nit']; ?>";
            var dir = "<?php echo $fila['monto']; ?>";
            var tel = "<?php echo $fila['sact']; ?>";
            var linea = "";
            linea = linea.concat(
                    "<tr>",
                    '<td><input type="hidden" id="codCliente_abono" name="codCliente_abono" value="' + codigo + '"> ' + codigo + "</td>",
                    "<td>" + nombre + "</td>",
                    "<td>" + dui + "</td>",
                    "<td>" + nit + "</td>",
                    "<td>" + dir + "</td>",
                    "<td>" + tel + "</td>",
                    "<td>" + cuota_personaa + "</td>",
                    "</tr>"
                    );
            $("#tabla_cliente_abono tbody").empty()//elimino el anterior
            $("table#tabla_cliente_abono tbody").append(linea);

        }





    </script>


    <?php
}
?>
    