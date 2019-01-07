<?php
class usuario {
private $id_usuario;
private $nombre;
private $apellido;
private $zona;
private $dui;
private $pass;
private $nivel;
function __construct() {
    
}
function getId_usuario() {
    return $this->id_usuario;
}

function getNombre() {
    return $this->nombre;
}

function getApellido() {
    return $this->apellido;
}

function getZona() {
    return $this->zona;
}

function getDui() {
    return $this->dui;
}

function getPass() {
    return $this->pass;
}

function getNivel() {
    return $this->nivel;
}

function setId_usuario($id_usuario) {
    $this->id_usuario = $id_usuario;
}

function setNombre($nombre) {
    $this->nombre = $nombre;
}

function setApellido($apellido) {
    $this->apellido = $apellido;
}

function setZona($zona) {
    $this->zona = $zona;
}

function setDui($dui) {
    $this->dui = $dui;
}

function setPass($pass) {
    $this->pass = $pass;
}

function setNivel($nivel) {
    $this->nivel = $nivel;
}



}
?>