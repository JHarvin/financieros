<?php
function consultar($campo,$tabla,$where){
		$sql=mysql_query("SELECT * FROM $tabla WHERE $where");
		if($row=mysql_fetch_array($sql)){
			return $row[$campo];
		}else{
			return '';	
		}
	}
	
	function abonos_saldo($cuenta){
		$sql=mysql_query("SELECT SUM(valor) as valores FROM abono WHERE cuenta='$cuenta'");
		if($row=mysql_fetch_array($sql)){
			return $row['valores'];
		}else{
			return 0;	
		}
	}

	function abonos_interes($cuenta){
		$sql=mysql_query("SELECT SUM(total_interes) as to_interes FROM abono WHERE cuenta='$cuenta'");
		if($row=mysql_fetch_array($sql)){
			return $row['to_interes'];
		}else{
			return 0;	
		}
	}
	function encrypt($string, $key) {
		$result = ''; $key=$key.'2013';
	   	for($i=0; $i<strlen($string); $i++) {
			  $char = substr($string, $i, 1);
			  $keychar = substr($key, ($i % strlen($key))-1, 1);
			  $char = chr(ord($char)+ord($keychar));
			  $result.=$char;
	   	}
	   	return base64_encode($result);
	}
	#####CONTRASEÑA DE-ENCRIPTAR
	function decrypt($string, $key) {
	   	$result = ''; $key=$key.'2013';
	   	$string = base64_decode($string);
	   	for($i=0; $i<strlen($string); $i++) {
			  $char = substr($string, $i, 1);
			  $keychar = substr($key, ($i % strlen($key))-1, 1);
			  $char = chr(ord($char)-ord($keychar));
			  $result.=$char;
	   	}
	   	return $result;
	}
	
	function cadenas(){
		return 'YABCDFGJAH';	
	}
	
	function diaSemana($ano,$mes,$dia){
		$dias = array("DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO");
		$dia= date("w",mktime(0, 0, 0, $mes, $dia, $ano));
		return $dias[$dia];
	}
	
	function fecha($fecha){
		$meses = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
		$a=substr($fecha, 0, 4); 	
		$m=substr($fecha, 5, 2); 
		$d=substr($fecha, 8);
		return $d." / ".$meses[$m-1]." / ".$a;
	}
	function sexo($estado){
		if($estado=='m'){
			return 'Masculino';
		}else{
			return 'Femenino';
		}
	}
	function estado($estado){
		if($estado=='s'){
			return '<span class="label label-success">Activo</span>';
		}else{
			return '<span class="label label-danger">No Activo</span>';
		}
	}
	function config($config){
		if($config=='df'){
			return '<span class="label label-danger">Tarifa por Defaul</span>';
		}else{
			return '<span class="label label-success">General</span>';
		}
	}
	function status($status){
		if($status=='n'){
			return '<span class="label label-danger">CANCELADO</span>';

		}else{
			return '<span class="label label-success">PROCESADO</span>';
		}
	}
	function usuario($tipo){
		if($tipo=='a'){
			return 'ADMINISTRADOR';
		}elseif($tipo=='c'){
			return 'CAJERO';
		}
	}
	
	function mensajes($mensaje,$tipo){
		if($tipo=='verde'){
			$tipo='alert alert-success';
		}elseif($tipo=='rojo'){
			$tipo='alert alert-danger';
		}elseif($tipo=='azul'){
			$tipo='alert alert-info';
		}elseif($tipo=='naranja'){
			$tipo='alert alert-warning';
		}
		return '<div class="'.$tipo.'" align="center">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>'.$mensaje.'</strong>
            </div>';
	}
	
	function tip_consulta($tipo){
		if($tipo== 'GEN'){
			return '<span class="label label-default">GENERAL</span>';
		}elseif($tipo=='EP'){
			return '<span class="label label-default">ECOGRAFIA PROSTATICA</span>';
		}elseif($tipo=='UM'){
			return '<span class="label label-default">ULTRASONIDO DE MAMAS</span>';
		}elseif($tipo=='UEM'){
			return '<span class="label label-default">ULTRASONOGRAFIA EMBARAZO</span>';
		}elseif($tipo=='UABD'){
			return '<span class="label label-default">ULTRASONOGRAFIA ABDOMINAL</span>';
		}elseif($tipo=='UG'){
			return '<span class="label label-default">ULTRASONOGRAFIA GINECOLOGICA</span>';
		}elseif($tipo=='CPREN'){
			return '<span class="label label-default">CONTROL PRENATAL</span>';
		}
	}
	
	function formato($valor){
		return number_format($valor,2,".",",");
	}
	
	function formatodos($valor){
		return number_format($valor,3,".",",");
	}
		
	function tiempo($codigo){
		if($codigo=='S1'){
			return 'Primer Semestre del Año';
		}elseif($codigo=='S2'){
			return 'Segundo Semestre del Año';
		}elseif($codigo=='I1'){
			return 'Primer Intersemestral';
		}elseif($codigo=='I2'){
			return 'Segundo Intersemestral';
		}elseif($codigo=='AE'){
			return 'Año Escolar';
		}
	}
	
	function permiso($usu,$id){
		$consulta=mysql_query("SELECT * FROM permisos WHERE usu='$usu' and permiso='$id' and estado='s'");
		if($v=mysql_fetch_array($consulta)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function colocar_permiso($usu,$tipo){
		if($tipo=='admin'){
			$sql=mysql_query("SELECT * FROM tipo_permisos WHERE tipo='$tipo'");
			while($row=mysql_fetch_array($sql)){
				$permiso=$row['permiso'];
				mysql_query("INSERT INTO permisos (permiso,usu,estado) VALUES ('$permiso','$usu','s')");
			}
		}else{
			$sql=mysql_query("SELECT * FROM tipo_permisos WHERE tipo='$tipo'");
			while($row=mysql_fetch_array($sql)){
				$permiso=$row['permiso'];
				$estado=$row['estado'];
				mysql_query("INSERT INTO permisos (permiso,usu,estado) VALUES ('$permiso','$usu','$estado')");
			}
		}
	}
	################################################################################################
function formato_factura($factura){
	if($factura>=1 and $factura<=9){
		return '0000000'.$factura;
	}elseif($factura>=10 and $factura<=99){
		return '000000'.$factura;
	}elseif($factura>=100 and $factura<999){
		return '00000'.$factura;
	}elseif($factura>=1000 and $factura<9999){
		return '0000'.$factura;
	}elseif($factura>=10000 and $factura<99999){
		return '000'.$factura;
	}elseif($factura>=100000 and $factura<999999){
		return '00'.$factura;
	}
}
	
	/*function calculaedad($fechanacimiento){
    list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
	}*/

	function CalculaEdad($fecha)
	{
	list($Y,$m,$d) = explode("-",$fecha);
	return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}
	// Evaluar los datos que ingresa el usuario.
	function evaluar($valor) {
	  $nopermitido = array("'",'\\','<','>',"\"");
	  $valor = str_replace($nopermitido, "", $valor);
	  return $valor;
	}
	
// Formatear una fecha a microtime para añadir al evento, tipo 1401517498985.
	function _formatear($fecha){
		return strtotime(substr($fecha, 6, 4)."-".substr($fecha, 3, 2)."-".substr($fecha, 0, 2)." " .substr($fecha, 10, 6)) * 1000;
	}
	
	function dameURL(){
	$url="http://".$_SERVER['HTTP_HOST'];
	return $url;
}
?>