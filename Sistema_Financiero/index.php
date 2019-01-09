<?php
	session_start();
	include_once "modulos/php_conexion.php";
	include_once "modulos/funciones.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>BATANECA</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	</head>

	<style type="text/css">

	.container-fluid .mark{
		
		    display: block;
			padding-top: 0px;
			margin: auto;
			text-align: center;
			transition: all 0.2s linear;
		}
/* Boton entrar*/
		.container-fluid .btn{
		text-decoration: none;
		background-color: #3DA3EF;
		display: block;
		width: 350px;
		padding: 10px;
		color: #fff;
		margin: auto;
		text-align: center;
		}

		.container-fluid .btn:hover{
		background-color: #F92659;
		}

/* Texto bataneca*/
		.container-fluid p.tonto{
		
		
		/*display: block;
		width: 300px;
		
		color: black;
		margin: auto;
		text-align: center;
		font-size:  50px;*/
		text-align: center;
		font-size: 50px;
		color: red;
		
		}

		/*.container-fluid p:hover{
		background-color: #F92659;
		}*/

		
		/* border de las cajas de texto */
		.container-fluid .form-control{
		border: 1px solid #0091ea ;
		}

		.container-fluid .form-control:hover{
		background-color: #e1f5fe;
		}
		/* FONDO */
		.container-fluid .modal{

	      background-image: url(img/3.jpg);

		}
         /* LOGIN MODAL */
		.container-fluid .modal-dialog .modal-content{
	      width: 400px;
	      height: 450px;
	      background-color: #80deea ;
	      box-shadow: 8px 8px 10px 0px #f48fb1;
	      -webkit-border-radius: 8px;
	      -moz-border-radius: 15px;
	      border-radius: 15px;
	      
	    
		}




	</style>
	<body>





		<div class="container-fluid"> 
           <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
			<div  class="tab-content">
				<p class="tonto">BATANECA</p>
				<div class="tab-pane fade active in" id="datos">
					<div class="col-md-6">

						<img class="mark" src="img/minerva.png">
					</div>

					<div class="col-md-6">
						            	<!--login modal-->



<form name="form1" method="post" action="" class="form col-md-11 center-block">

  <div class="modal-dialog">

  <div class="modal-content">

      <div class="modal-body">

      	<center><img class="maribel" src="img/login-icon.png"></center><br>
      	<?php
	  	if(!empty($_POST['usu']) and !empty($_POST['con'])){
			$usu=limpiar($_POST['usu']);
			$con=limpiar($_POST['con']);

			$pa=mysql_query("SELECT * FROM usuario WHERE usuario.doc='$usu' and usuario.con='$con' and usuario.estado='s'");
			if($row=mysql_fetch_array($pa)){
				if($row['estado']=='s'){
					$nombre=$row['nombre'];
					$nombre=explode(" ", $nombre);
					$nombre=$nombre[0];
					$_SESSION['user_name']=$nombre;
					$_SESSION['tipo_user']=$row['tipo'];
					$_SESSION['cod_user']=$usu;
					if($row['tipo']=='Admin'){
						echo mensajes('Accediendo al sistema <br>ESPERE UN MOMENTO'.' ','azul').'<br>';
						echo '<center><img src="img/ajax-loader.gif"></center><br>';
						echo '<meta http-equiv="refresh" content="2;url=principal.php">';
					}else{
						echo mensajes('Bienvenido/a '.$row['cargo'].'<br>'.$row['nombre'].' ','verde').'<br>';
						echo '<center><img src="img/ajax-loader.gif"></center><br>';
						echo '<meta http-equiv="refresh" content="2;url=principal.php">';
					}
				}else{
					echo mensajes('Usted no se encuentra Activo en la base de datos<br>Consulte con su Administrador de Sistema','rojo');
				}
			}else{
				echo mensajes('Usuario y Contraseña Incorrecto<br>','rojo');
				echo '<center><a href="index.php" class="btn btn-danger btn-lg"><strong>Intentar de Nuevo</strong></a></center>';
			}
		}else{
			echo '
			<div class="input-group input-group-lg">
			<span class="input-group-addon" style="border: 1px solid #0091ea ;"><img src="img/Admin-icon.png" style="width: 24px; height: 24px;"></span>
			<input type="text" name="usu" class="form-control input-lg" placeholder="Usuario" autocomplete="off" required autofocus>
			</div><br>

			<div class="input-group input-group-lg">
			<span class="input-group-addon" style="border: 1px solid #0091ea ;"><img src="img/secrecy-icon.png" style="width: 24px; height: 24px;"></span>
			<input type="password" name="con" class="form-control input-lg" placeholder="Contraseña" autocomplete="off" required>
			</div><br>

			<div class="form-group">
			<div align="right"><button class="btn btn-info btn-lg btn-block" type="submit"> <strong>Entrar</strong></button></div>
			</div>';
		}
	  ?>
	  </div>
	  </div>
  </div>
      </form>
		
</div>
						
					</div>
					
				</div>
				
			</div>


	
		</div> <!-- FIn container -->


      

	<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	</body>
</html>
