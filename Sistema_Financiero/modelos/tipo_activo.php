<?php


class tipo_activo {
private $id_tipo;
private $id_clasificacion;
private $id_nombre;
private $id_correlativo;

function __construct() {
    
}
function getId_tipo() {
    return $this->id_tipo;
}

function getId_clasificacion() {
    return $this->id_clasificacion;
}

function getId_nombre() {
    return $this->id_nombre;
}

function getId_correlativo() {
    return $this->id_correlativo;
}

function setId_tipo($id_tipo) {
    $this->id_tipo = $id_tipo;
}

function setId_clasificacion($id_clasificacion) {
    $this->id_clasificacion = $id_clasificacion;
}

function setId_nombre($id_nombre) {
    $this->id_nombre = $id_nombre;
}

function setId_correlativo($id_correlativo) {
    $this->id_correlativo = $id_correlativo;
}



}
?>