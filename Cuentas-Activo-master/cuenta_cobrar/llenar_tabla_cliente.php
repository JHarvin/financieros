<?php
include_once '../app/Conexion.php';
include_once '../modelos/persona_natural.php';
include_once '../repositorios/repositorio_expediente_natural.php';
Conexion::abrir_conexion();

$listado = repositorio_expediente_natural::obtener_persona_natural(Conexion::obtener_conexion(), $_POST['libro']);
$id = $_POST['idtabla'];
//$numero=$_POST['numero'];

foreach ($listado as $fila) {
    ?>
<script type="text/javascript">
      var idta = "<?php echo $id; ?>"
     var codigo="<?php echo $fila['id']; ?>";  
     var n="<?php echo $_POST['n']; ?>";  
   var pass=doSearch(codigo);
   if(pass){
       
        var nombre="<?php echo  $fila['nombre']; ?>";
        var dui="<?php echo  $fila['dui']; ?>" ;
        var nit="<?php echo  $fila['nit']; ?>" ;
        var dir="<?php echo  $fila['direccion']; ?>" ;
        var tel="<?php echo  $fila['tel']; ?>" ;
        var linea="";
        linea=linea.concat(
            "<tr>",
            '<td><input type="hidden" id="codCliente_cpersonal" name="codCliente_cpersonal" value="'+codigo+'"> '+codigo+"</td>",
            "<td>"+nombre+"</td>",
            "<td>"+dui+"</td>",
            "<td>"+nit+"</td>",
            "<td>"+tel+"</td>",
            "<td>"+dir+"</td>",
            "</tr>"
            );
  if(n==1)
    $("#tabla_cliente_cpersonal tbody").empty()//elino el anterior

    $("table#"+idta+" tbody").append(linea);
   
    }else{
         swal("Importane!",  codigo+" ya fue ingresado", "warning")
     
    }
    
    
    //para no ingresar los mismos activo a la tabla
    function doSearch(codigo)
		{
                        var pso="true";
			var tableReg = document.getElementById(idta);
			var searchText = codigo;
			var cellsOfRow="";
			var found=false;
			var compareWith="";
 
 
			// Recorremos todas las filas con contenido de la tabla
			for (var i = 1; i < tableReg.rows.length; i++)
			{
				cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
				found = false;
				// Recorremos todas las celdas
				for (var j = 0; j < cellsOfRow.length && !found; j++)
				{
                                    
					compareWith = cellsOfRow[j].innerHTML;
                                        
					// Buscamos el texto en el contenido de la celda
					if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
					{
						found = true;
					}
				}
				if(found)
				{
					pso= false;//tableReg.rows[i].style.display = '';
				} else {
					// si no ha encontrado ninguna coincidencia, esconde la
					// fila de la tabla
					//tableReg.rows[i].style.display = 'none';
                                       pso=  true;
				}
			}
		return pso;}
     
    </script>


    <?php
}
?>
    