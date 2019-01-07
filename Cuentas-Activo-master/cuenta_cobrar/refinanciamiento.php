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
    $id_prestamo = $_REQUEST['id_prestamo'];

        echo "<script>
        location.href='credito_refinanciado.php?id_prestamo='".$id_prestamo." ;
        </script>";
   
}else{


$lista_prestamo = repositorio_prestamo::lista_refinanciamiento_juridico(Conexion::obtener_conexion());
$lista_prestamo_natural = repositorio_prestamo::lista_refinanciamiento_naturales(Conexion::obtener_conexion());
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
                    <th class="text-center">Refinanciar</th>
                    <th class="text-center">Asesor</th>
                    <th class="text-center">Solicitante</th>
                    <th class="text-center">Tipo Prestamo</th>
                    <th class="text-center">Monto solicitado($)</th>
                    <th class="text-center">Saldo Actual($)</th>
                    <th class="text-center">Tiempo(Meses)</th>
                    <th class="text-center">Ver Pagoss</th>

                    </thead>
                    <tbody>
                        <?php foreach ($lista_prestamo as $lista) { ?>
                            <tr>
                               <td class="text-center">
                                   <button class="btn btn-danger" onclick="refinanciar('<?php echo $lista['8'];?>', '<?php echo $lista['7'];?>')"> 
                                        <i class="Medium material-icons prefix">refresh</i> 
                                    </button>
                                </td>
                                <th class="text-center"><?php echo $lista['4'];?></th>
                                <th class="text-center"><?php echo $lista['2'];?></th>
                                <th class="text-center"><?php echo $lista['1'];?></th>
                    
                                <th class="text-center"><?php echo "$". $lista['3'];?></th>
                                <th class="text-center"><?php echo "$". $lista['9'];?></th>
                                
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
                                   <button class="btn btn-danger" onclick="refinanciar('<?php echo $lista2['6'];?>')"> 
                                        <i class="Medium material-icons prefix">refresh</i> 
                                    </button>
                                </td>
                                <th class="text-center"><?php echo $lista2['0'];?></th>
                                <th class="text-center"><?php echo $lista2['1'] . " " .$lista2['2'];?></th>
                                <th class="text-center"><?php echo $lista2['3'];?></th>
                    
                                <th class="text-center"><?php echo "$". $lista2['4'];?></th>
                                <th class="text-center"><?php echo "$". $lista2['9'];?></th>
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

function refinanciar(id_prestamo ,id_juridico ){
    location.href="credito_refinanciado_juridico.php?id_prestamo=" +id_prestamo+"&id_juridico="+id_juridico+ "_parent";
}

</script>

<?php
}
include_once '../plantilla/pie.php';
?>