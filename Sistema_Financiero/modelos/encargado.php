<?php

class encargado {
private $id_encargado;
private $nombre;
private $apellido;
private $dui;

function __construct() {
    
}
function getId_encargado() {
    return $this->id_encargado;
}

function getNombre() {
    return $this->nombre;
}

function getApellido() {
    return $this->apellido;
}

function getDui() {
    return $this->dui;
}

function setId_encargado($id_encargado) {
    $this->id_encargado = $id_encargado;
}

function setNombre($nombre) {
    $this->nombre = $nombre;
}

function setApellido($apellido) {
    $this->apellido = $apellido;
}

function setDui($dui) {
    $this->dui = $dui;
}


}
?>