<?php

class referencias {
private $id_referencia;
private $id_persona_natural;
private $nombre;
private $apellido;
private $telefono;

function __construct() {
    
}
function getId_referencia() {
    return $this->id_referencia;
}

function getId_persona_natural() {
    return $this->id_persona_natural;
}

function getNombre() {
    return $this->nombre;
}

function getApellido() {
    return $this->apellido;
}

function getTelefono() {
    return $this->telefono;
}

function setId_referencia($id_referencia) {
    $this->id_referencia = $id_referencia;
}

function setId_persona_natural($id_persona_natural) {
    $this->id_persona_natural = $id_persona_natural;
}

function setNombre($nombre) {
    $this->nombre = $nombre;
}

function setApellido($apellido) {
    $this->apellido = $apellido;
}

function setTelefono($telefono) {
    $this->telefono = $telefono;
}


}
?>