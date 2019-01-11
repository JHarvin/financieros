<?php


$conexion = new mysqli('localhost', 'root', '', 'financiero');
if ($conexion->connect_errno) {
    echo "Error de conexion";
}
?>