<?php

class clasificacion {
private $id_clasificacion;
private $nombre;
private $correlativo;
private $tiempo_depreciacion;

function __construct() {
    
}
function getId_clasificacion() {
    return $this->id_clasificacion;
}

function getNombre() {
    return $this->nombre;
}

function getCorrelativo() {
    return $this->correlativo;
}

function getTiempo_depreciacion() {
    return $this->tiempo_depreciacion;
}

function setId_clasificacion($id_clasificacion) {
    $this->id_clasificacion = $id_clasificacion;
}

function setNombre($nombre) {
    $this->nombre = $nombre;
}

function setCorrelativo($correlativo) {
    $this->correlativo = $correlativo;
}

function setTiempo_depreciacion($tiempo_depreciacion) {
    $this->tiempo_depreciacion = $tiempo_depreciacion;
}


}
?>