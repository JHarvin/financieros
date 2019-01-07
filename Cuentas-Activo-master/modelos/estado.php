<?php


class estado {
private $id_estado;
private $nombre;
private $tiempo_de_uso;

function __construct() {
    
}
function getId_estado() {
    return $this->id_estado;
}

function getNombre() {
    return $this->nombre;
}

function getTiempo_de_uso() {
    return $this->tiempo_de_uso;
}

function setId_estado($id_estado) {
    $this->id_estado = $id_estado;
}

function setNombre($nombre) {
    $this->nombre = $nombre;
}

function setTiempo_de_uso($tiempo_de_uso) {
    $this->tiempo_de_uso = $tiempo_de_uso;
}


}
?>