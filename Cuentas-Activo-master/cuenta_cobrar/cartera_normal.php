<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
include_once '../plantilla/barra_lateral_usuario.php';
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

    if (repositorio_prestamo::hacer_incobrable(Conexion::obtener_conexion(), $_REQUEST['id_prestamo'])) {
        echo "<script>
        alert('Credito Marcado como incobrable');
        location.href='cartera_normal.php';
        </script>";
    }
    
}else{


$lista_prestamo = repositorio_prestamo::lista_prestamo_normales_juridico(Conexion::obtener_conexion());
$lista_prestamo_natural = repositorio_prestamo::lista_prestamo_normales_naturales(Conexion::obtener_conexion());
?>    


<section class="content">
    <div class="container-fluid">
        <div class="panel" name="libros">
            <div class="panel-heading text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Creditos en Proceso</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table padding="20px" class="table table-striped" id="data-table-simple">
                    <thead class="">
                    <th class="text-center">Incobrable</th>
                    <th class="text-center">Asesor</th>
                    <th class="text-center">Solicitante</th>
                    <th class="text-center">Tipo Prestamo</th>
                    <th class="text-center">Monto solicitado($)</th>
                    <th class="text-center">Tiempo(Meses)</th>
                    <th class="text-center">Ver Pagoss</th>

                    </thead>
                    <tbody>
                        <?php foreach ($lista_prestamo as $lista) { ?>
                            <tr>
                               <td class="text-center">
                                   <button class="btn btn-danger" onclick="hacer_incobrable('<?php echo $lista['8'];?>')"> 
                                        <i class="Medium material-icons prefix">delete</i> 
                                    </button>
                                </td>
                                <th class="text-center"><?php echo $lista['4'];?></th>
                                <th class="text-center"><?php echo $lista['2'];?></th>
                                <th class="text-center"><?php echo $lista['1'];?></th>
                    
                                <th class="text-center"><?php echo "$". $lista['3'];?></th>
                                <th class="text-center"><?php echo $lista['6'];?></th>
                                 <td class="text-center">
                                     <button class="btn btn-success" onclick="abrir_pagos_juridicos('<?php echo $lista['8'];?>')"> 
                                        <i class="Medium material-icons prefix">visibility</i> 
                                    </button>
                                </td>
                            </tr>
                            
                        <?php } ?>
                         <?php foreach ($lista_prestamo_natural as $lista2) { ?>
                            <tr>
                               <td class="text-center">
                                   <button class="btn btn-danger" onclick="hacer_incobrable('<?php echo $lista2['6'];?>')"> 
                                        <i class="Medium material-icons prefix">delete</i> 
                                    </button>
                                </td>
                                <th class="text-center"><?php echo $lista2['0'];?></th>
                                <th class="text-center"><?php echo $lista2['1'] . " " .$lista2['2'];?></th>
                                <th class="text-center"><?php echo $lista2['3'];?></th>
                    
                                <th class="text-center"><?php echo "$". $lista2['4'];?></th>
                                <th class="text-center"><?php echo $lista2['5'];?></th>
                                 <td class="text-center">
                                     <button class="btn btn-success" onclick="abrir_pagos_natural('<?php echo $lista2['6'];?>')"> 
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
function abrir_pagos_juridicos(id_prestamo) {
        var url = "./ver_pagos_juridico.php?id_prestamo=" + id_prestamo;

        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
    }
function abrir_pagos_natural(id_prestamo) {
        var url = "./ver_pagos_natural.php?id_prestamo=" + id_prestamo;

        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
    }

function hacer_incobrable(id_prestamo){
    location.href="cartera_normal.php?id_prestamo=" +id_prestamo, "_parent";
}

</script>

<?php
}
include_once '../plantilla/pie.php';
?>