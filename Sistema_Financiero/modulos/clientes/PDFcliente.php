<?php
 		session_start();
		require_once("../../dompdf/dompdf_config.inc.php");
		include('../php_conexion.php'); 
		if($_SESSION['cod_user']){
	    }else{
	        header('Location: ../../php_cerrar.php');
	    }
		$can=mysql_query("SELECT * FROM empresa where id=1");
		if($dato=mysql_fetch_array($can)){
			$empresa=$dato['empresa'];
			$nit=$dato['nit'];
			$direccion=$dato['direccion'];
			$ciudad=$dato['ciudad'];
			$tel=$dato['tel'];			
			$web=$dato['web'];
			
		}
		
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 		$hoy=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
		$fecha=date('Ymd');
		
		//Salida: Viernes 24 de Febrero del 2012
$codigoHTML='
<html lang="es">
  <head>
		<meta charset="utf-8">
		<title>Listo de Producto</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

	</style>
	<!-- Le styles -->
		<link href="../../css/bootstrap.css" rel="stylesheet">
		<style type="text/css">
		  body {
			padding-top: 60px;
			padding-bottom: 40px;
			font-size: 12px;
		  }
	</style>
		<link href="../../css/bootstrap-responsive.css" rel="stylesheet">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="../../ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="../../ico/favicon.png">
</head>
</head>

<body>
<div align="center" class="text">

<table class="table table-hover" width="100%" border="0">	 
      <tr class="well">
		<td colspan="6"><strong><center>LISTADO DE CLIENTES</center></strong></td>
		</tr>		
</table>

<table width="100%" border="0">		
		  <tr>
			<td width="17"><center><img src="../../img/logo.jpg" width="130" height="110" alt="" /></center></td>
			<td width="83%" colspan="2">
			  <div align="center">
				<span class="text">'.$empresa.' Nit. '.$nit.'</span><br />
				<span class="text">Ciudad: '.$ciudad.' Direccion: '.$direccion.' </span><br />
				<span class="text">TEL: '.$tel.'</span><br />
				<span class="text">Reporte Impreso el '.$hoy.' por '.$_SESSION['user_name'].'</span>
			  </div>
			</td>
		  </tr>
		</table><br/>
    
    <table class="table table-hover" width="100%" border="0">
      <tr class="well">
        <td><strong>CODIGO</strong></td>
        <td><strong>NOMBRE</strong></td>
        <td><strong>DIRECCION</strong></td>
        <td><strong>TELEFONO</strong></td>                        
        <td><strong>NRC</strong></td>
        
      </tr>';

		$num=0;
        $can=mysql_query("SELECT * FROM clientes WHERE estado='s' ORDER BY id");	
        while($dato=mysql_fetch_array($can)){
           
			
			$num=$num+1;
			$resto = $num%2; 
			if (($resto==0)) { 
				$color="#EEEEEE"; 
			}else{ 
				$color="#FFFFFF";
			} 				
  	  $codigoHTML.='
      <tr>        
        <td align="center" bgcolor="'.$color.'">'.$dato['id'].'</td>
        <td bgcolor="'.$color.'">'.$dato['nombre'].'</td>                                   
        <td bgcolor="'.$color.'">'.$dato['dir'].'</td>                
		<td bgcolor="'.$color.'">'.$dato['tel'].'</td> 
        <td bgcolor="'.$color.'">'.$dato['nrc'].'</td>        
      </tr>';
         }
	$codigoHTML.='
	</table>
</div>

<!-- Le javascript ../../js/jquery.js
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap-transition.js"></script>
    <script src="../../js/bootstrap-alert.js"></script>
    <script src="../../js/bootstrap-modal.js"></script>
    <script src="../../js/bootstrap-dropdown.js"></script>
    <script src="../../js/bootstrap-scrollspy.js"></script>
    <script src="../../js/bootstrap-tab.js"></script>
    <script src="../../js/bootstrap-tooltip.js"></script>
    <script src="../../js/bootstrap-popover.js"></script>
    <script src="../../js/bootstrap-button.js"></script>
    <script src="../../js/bootstrap-collapse.js"></script>
    <script src="../../js/bootstrap-carousel.js"></script>
    <script src="../../js/bootstrap-typeahead.js"></script>

</body>
</html>';

    $codigoHTML=utf8_decode($codigoHTML);
    $dompdf=new DOMPDF();
    $dompdf->load_html($codigoHTML);
    ini_set("memory_limit","128M");
    $dompdf->render();
    $dompdf->stream("Listado_Clientes_".$fecha.".pdf");

?>