<?php
include_once '../app/Conexion.php';
include_once '../modelos/Activo.php';
include_once '../repositorios/repositorio_activo.php';
Conexion::abrir_conexion();
$listado = Repositorio_activo::lista_activo_inventario(Conexion::obtener_conexion(), "");
?>
<table padding="20px" class="responsive-table display" id="tabla-paginadaA3">
    <thead>
    <th>C&oacute;digo</th>
    <th>Tipo</th>
    <th>Administrador</th>                        
    <th>Fecha Adquisición</th>
    <th>Precio</th>
    <th></th>
</thead>
<tbody>
    <?php
    foreach ($listado as $fila) {

        ?>
        <tr >
            <td><?php echo $fila['cod'] ?></td>

            <td ><?php echo $fila['tipo'] ?></td>
            <td><?php echo $fila['admin'] ?></td>
            <td><?php echo date_format(date_create($fila['f']), 'd-m-Y') ?></td>
            <td><?php echo $fila['p'].' $' ?></td>
            <td >
                <button class="btn btn-info" 
                onclick="ver_depreciacion('<?php echo $fila['cod'] ?>','<?php echo date_format(date_create($fila['f']), 'd-m-Y') ?>','<?php echo $fila['p'] ?>')"> 
                <i class="fa fa-eye"></i>
                </button>
            </td>
        </tr>
    <?php } ?>

</tbody>
</table>

