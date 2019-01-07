<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barra_superior_admi.php';
include_once '../plantilla/barra_lateral_admi.php';
include_once '../modelos/balance_general.php';
include_once '../modelos/estado_resultado.php';
include_once '../modelos/expediente_juridico.php';
include_once '../modelos/ratios.php';
include_once '../repositorios/repositorio_balance.php';
include_once '../repositorios/repositorio_estado_resultado.php';
include_once '../app/Conexion.php';
include_once '../repositorios/repositorio_expediente_juridico.php';
include_once '../modelos/presamo.php';
include_once '../repositorios/repositorio_prestamo.php';
Conexion::abrir_conexion();
if (isset($_REQUEST['id_prestamo'])) {

    if (repositorio_prestamo::aprobar_prestamo(Conexion::obtener_conexion(), $_REQUEST['id_prestamo'])) {
        echo "<script>
        alert('prestamo actualizado');
        location.href='solicitud_natural.php';
        </script>";
    }
    
}else{


$lista_prestamo = repositorio_prestamo::lista_prestamo_pendiente_natural(Conexion::obtener_conexion());
?>    

<section class="content">
    <div class="container-fluid">
        <div class="panel" name="libros">
            <div class="panel-heading text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Solicitudes de Creditos Personales</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table padding="20px" class="table table-striped" id="data-table-simple">
                    <thead class="">
                    <th class="text-center">Aprobar</th>
                    <th class="text-center">Asesor</th>
                    <th class="text-center">Solicitante</th>
                    <th class="text-center">Tipo Prestamo</th>
                    <th class="text-center">Sector de Empresa</th>
                    <th class="text-center">Monto solicitado($)</th>
                    <th class="text-center">Tiempo(Meses)</th>
                    <th class="text-center">Expediente</th>

                    </thead>
                    <tbody>
                        <?php foreach ($lista_prestamo as $lista) { ?>
                            <tr>
                                <td class="text-center">
                                    <button class="btn btn-success" onclick="aprobar_credito('<?php echo $lista['6'];?>')"> 
                                        <i class="Medium material-icons prefix ">check_circle</i> 
                                    </button>
                                </td>
                                <th class="text-center"><?php echo $lista['0'];?></th>
                                <th class="text-center"><?php echo $lista['1'] ." ". $lista['2'] ;?></th>
                                <th class="text-center"><?php echo $lista['3'];?></th>
                                <th class="text-center">COMERSIAL</th>
                                <th class="text-center"><?php echo "$". $lista['4'];?></th>
                                <th class="text-center"><?php echo $lista['5'];?></th>
                                 <td class="text-center">
                                     <button class="btn btn-danger" onclick="abrir_expediente('<?php echo $lista['6'];?>', '<?php echo $lista['3'];?>')"> 
                                        <i class="Medium material-icons prefix">visibility</i> 
                                    </button>
                                </td>
                            </tr>
                            
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
function abrir_expediente(id_natural,tipo){
    var url="./expediente_natural.php?id_natural=" +id_natural+"&tipo="+tipo;
    
    var a = document.createElement("a");
		a.target = "_blank";
		a.href = url;
		a.click();
}

function aprobar_credito(id_prestamo){
    location.href="solicitud_natural.php?id_prestamo=" +id_prestamo, "_parent";
}

function aprobar_credito(id_prestamo){
    location.href="solicitud_pendiente.php?id_prestamo=" +id_prestamo, "_parent";
}

</script>

<?php
}
include_once '../plantilla/pie.php';
?>