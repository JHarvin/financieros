<?php
	#error_reporting(E_ALL ^ E_DEPRECATED);
	$servidor='localhost';									    //
	$usuario='root';											//
	$pass='';											        // Nos conectamos a
	$bd='bdtiendita';
	
	$conexion = mysql_connect("$servidor","$usuario","$pass");
	mysql_select_db("$bd",$conexion);
	date_default_timezone_set("America/El_Salvador");
    mysql_query("SET NAMES utf8");
	mysql_query("SET CHARACTER_SET utf");
	$s='$';
	
	function limpiar($tags){
		$tags = strip_tags($tags);
		return $tags;
	}

	$conexion = new mysqli($servidor, $usuario, $pass, $bd);	//
	$conexion->set_charset('utf8'); // Los datos vendran en formato utf-8
	
	$base_url="http://127.1.1.0/EMANUEL/agenda/"; // Url donde estara el proyecto
?>