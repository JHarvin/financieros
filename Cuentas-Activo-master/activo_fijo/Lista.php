<script language="javascript">
    $(document).ready(function () {

        $('form').keypress(function (e) {
            if (e == 13) {
                return false;
            }
        });
        $('input').keypress(function (e) {
            if (e.which == 13) {
                return false;
            }
        });
    });
</script>
<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';
//include_once '../plantilla/barra_lateral_usuario.php';
?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<script src="jquery-3.1.1.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<?php
// AGRAGAR CONTRASENA SI TIENEN CONTRA EL XAMPP
$con =new mysqli('localhost','root','','financiero');
$datos=$con->query("SELECT
activo.fecha_adquisicion AS fecha,
activo.id_activo AS id,
usuario.nombre AS nombreUser,
departamento.nombre AS dep,
institucion.nombre AS nombreInst,
tipo_activo.id_clasificacion,
tipo_activo.nombre AS tipo,
CONCAT_WS(' ',encargado.nombre, encargado.apellido) AS encargado,
TRUNCATE((activo.precio),2) AS precio,
clasificacion.id_clasificacion AS clasi,
CONCAT_WS('-',institucion.correlativo, departamento.correlativo, tipo_activo.correlativo, activo.correlativo) AS codiguito,
clasificacion.nombre AS ncla

FROM
activo
INNER JOIN usuario ON activo.id_usuario = usuario.id_usuario
INNER JOIN departamento ON activo.id_departamento = departamento.id_departamento
INNER JOIN institucion ON activo.id_institucion = institucion.id_institucion
INNER JOIN tipo_activo ON activo.id_tipo = tipo_activo.id_tipo
INNER JOIN encargado ON activo.encargado_id_encargado = encargado.id_encargado
INNER JOIN clasificacion ON tipo_activo.id_clasificacion = clasificacion.id_clasificacion
WHERE tipo_activo.id_tipo=activo.id_tipo and activo.id_departamento=departamento.id_departamento
and institucion.id_institucion=activo.id_institucion and encargado.id_encargado=activo.encargado_id_encargado
 GROUP BY activo.id_activo
");
?>
<!--<form action="" method="post" class="formNatural" name="credito_personal" id="credito_personal" onsubmit="return validarTablas_cper()" enctype="multipart/form-data" >-->
    <input type="hidden" id="pas_cp" name="pas_cp"/>
    <input type="hidden" id="n" name="n" value="1"/>
    <input type="radio" id="uno" checked="" style="display: none"/>
    <section class="wrapper">
        <!--    INICIO DE DATOS-->
        <div class="container-fluid" id="contenido">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" style="background-color:gray;">
                        <div class="header">
                            <h2 class="text-center">Activos</h2>
                        </div>
                        <div id="heading" class="panel-heading" style="background-color:gray;">
<div id="expedientes" class="panel panel-info" style="background-color:gray;">
          <div class="panel-body" style="background-color:gray;">
            <div class="body" style="background-color:gray;">
                            <div class="row clearfix" style="background-color:gray;">



<div class="box-body" style="background-color:gray;">
                                <table style="background-color:gray;" id="example1" class="table table-bordered table-striped">
                                    <caption></caption>

                                    <thead >
                                    <th>Correlativos</th>
                                    <th>Clasificacion</th>
                                    <th>Precio</th>
                                    <th>Institucion</th>
                                    <th>Encargado</th>
                                    <th>Departamento</th>

                                    <th>Acciones </th>
                                    </thead>
                                    <tbody class="buscar">




     				<?php while($fila=mysqli_fetch_array($datos)){?>

                        <tr>


                           <td><?php echo $fila['codiguito']; ?></td>

                            <td><?php echo $fila['ncla']; ?></td>

                              <td><?php echo "$ ";?><?php echo $fila['precio']; ?></td>

                                    <td><?php echo $fila['nombreInst']; ?></td>

                                  <td><?php echo $fila['encargado']; ?></td>
                                  <td><?php echo $fila['dep']; ?></td>
                                  <td >
                                   <button class="btn btn-info"
                onclick="llamarPagina('<?php echo $fila['id']; ?>')">
                <i class="fa fa-eye"></i>Depreciacion
                                   </button></td>




                            </tr>
                            <?php
						}
							?>

                        </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--    FIN DE DATOS-->
        </div>



    </section>
<!--</form>-->




<script type="text/javascript" >
function llamarPagina(id){
    $("#contenido").load('ver_depreciacion.php?clienteinfo='+id);
//	window.open("../activo_fijo/ver_depreciacion.php?datos="+id, '_parent');
	}

</script>
<script>
$(document).ready(function() {

if ( $.fn.dataTable.isDataTable( '#example1' ) ) {
table = $('#example1').DataTable( );
 paging: true
 responsive: true
}
else {
table =  $('#example1').DataTable({
  "language":{
   "lengthMenu":"Mostrar _MENU_ registros por página.",
   "zeroRecords": "Lo sentimos. No se encontraron registros.",
         "info": "Mostrando página _PAGE_ de _PAGES_",
         "infoEmpty": "No hay registros aún.",
         "infoFiltered": "(filtrados de un total de _MAX_ registros)",
         "search" : "Búsqueda",
         "LoadingRecords": "Cargando ...",
         "Processing": "Procesando...",
         "SearchPlaceholder": "Comience a teclear...",
         "paginate": {
 "previous": "Anterior",
 "next": "Siguiente",
 }
  }


 });
}

});
</script>
