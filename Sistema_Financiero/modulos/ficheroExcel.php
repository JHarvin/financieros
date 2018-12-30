<?php
session_start();
require_once("../dompdf/dompdf_config.inc.php");
##################################DESCARGAR EN EXCEL#####################################
if($_POST['imp']=='excel'){
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: filename=".$_POST['nombre'].".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	echo $_POST['datos_a_enviar'];
##################################DESCARGAR EN PDF#####################################
}elseif($_POST['imp']=='pdf'){	
	//echo $reporte;
	$documento=$_POST['nombre'].'.pdf';
	//se crea una nueva instancia al DOMPDF
	$dompdf = new DOMPDF();
	//se carga el codigo html
	$dompdf->set_paper("letter", "portrait");
	//se carga el codigo html
	$dompdf->load_html($_POST['datos_a_enviar']);
	//aumentamos memoria del servidor si es necesario
	ini_set("memory_limit","62M"); 
	//lanzamos a render
	$dompdf->render();
	//guardamos a PDF
	$dompdf->stream($documento);
	file_put_contents("pdf/".$documento, $pdf);

	echo $_POST['datos_a_enviar'];

################################## ENVIAR POR CORREO #####################################
}elseif($_POST['imp']=='correo'){
	$email=$_POST['email'];
	$end=';';
	/*$documento=$_POST['archivo'].'_'.date('Ymd').'.pdf';
	$dompdf = new DOMPDF();
	$dompdf->set_paper("letter", "portrait");
	$dompdf->load_html(utf8_encode($_POST['datos_a_enviar']));
	ini_set("memory_limit","62M");
	$dompdf->render();
	$pdf = $dompdf->output();
	file_put_contents('pdf/'.$documento, $pdf);*/

	//echo $reporte;
	$documento=$_POST['nombre'].'.pdf';
	//se crea una nueva instancia al DOMPDF
	$dompdf = new DOMPDF();
	//se carga el codigo html
	$dompdf->set_paper("letter", "portrait");
	//se carga el codigo html
	$dompdf->load_html($_POST['datos_a_enviar']);
	//aumentamos memoria del servidor si es necesario
	ini_set("memory_limit","62M"); 
	//lanzamos a render
	$dompdf->render();
	//guardamos a PDF
	$pdf = $dompdf->output();
	$dompdf->stream($documento);
	file_put_contents("pdf/".$documento, $pdf);	
	
	##############################################################
	include_once('php_conexion.php');
	include_once('funciones.php');
		$correo=$email.''.$end;
		$titulo=limpiar($_POST['nombre']);
		$mensaje_guardar='Historial de archivo';	
		$mensaje='<h3 align="center">Buen dia!!!</h3><br>
			<h3 align="center">Acorde a sus Requerimientos puede descargar<br>
			en el enlace su cotizacion ... gracias</h3>';
		$dir='<h3 align="center">Cordialmente,</h3><br>
			<h3>Forma Fit Colombia<br>
			Implementos Deportivos<br>
			www.formafitcolombia.com<br>
			Cra. 70 Nro. 30-21 Belen, Medellín<br>
			Cel. Wp. 3017754601<br>
			Tel. 3224055</h3>';
		$donde='COTIZACION';
		$archivo='<br><a href="'.dameURL().''.encrypt().'/adminphp/modulos/pdf/'.$documento.'"><h3>DESCARGAR EN PDF</h3></a>';
		$mensaje='<center><h3>'.$donde.'</h3><br><br>'.$mensaje.'<br><br>'.$archivo.'</center><br>'.$dir.'';
		$fecha=date('Y-m-d');$hora=date('H:i:s');
		mysql_query("INSERT INTO enviado (correo,titulo,mensaje,fecha,hora,archivo,usu) 
		VALUES ('$correo','$titulo','$mensaje_guardar','$fecha','$hora','$archivo','".$_SESSION['cod_user']."')");
		##################### empezamos a envuar #############################################		
		$para  = $correo;
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		
		$tipocorreos=explode('@',$para);
		#############
		$para=trim($para);
		$nletra=strlen($para);
		$correo='';
		$n=1;
		
		for ($x=0; $x < $nletra; $x++){
			if($para[$x]==';'){
				$n++;
				$vcorreo[$n]=$correo;
				$correo='';
			}else{
				$correo=$correo.$para[$x];	
			}
		}
		
		foreach ($vcorreo as $mail) {
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			
			$tipocorreos=explode('@',$mail);
			
			if($tipocorreos['1']=='gmail.com'){
				// Cabeceras adicionales para gmail
				$cabeceras .= "From: Admin" . "\r\n";
			}else{
				// Cabeceras adicionales para hotmail y demas
				$cabeceras .= 'From: Admin' . "\r\n";
			}
			mail($mail, $titulo, $mensaje, $cabeceras);
			echo 'Correo enviado con exito '.$mail.'<br>';
			
		}
	##############################################################
}elseif($_POST['imp']=='ninguna'){
	if(!empty($_POST['nombre'])){
		echo '<h3 align="center">'.$_POST['nombre'].'</h3>';
	}else{
		echo '<h3 align="center">Sin Titulo</h3>';
	}
	echo '<center><strong>'.$_POST['fechas'].'</strong></center><br>';
	echo $_POST['datos_a_enviar'];
}else{
	header('Location: ../principal/index.php');	
}

?>