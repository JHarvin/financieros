<?php

class pago {
private $id_pago;
private $monto;
private $fecha;
private $mora;
private $interes;
private $id_prestamo;

function __construct() {
    
}
function getMora() {
    return $this->mora;
}
function getId_prestamo() {
    return $this->id_prestamo;
}

function setId_prestamo($id_prestamo) {
    $this->id_prestamo = $id_prestamo;
}

function getInteres() {
    return $this->interes;
}

function setMora($mora) {
    $this->mora = $mora;
}

function setInteres($interes) {
    $this->interes = $interes;
}

function getId_pago() {
    return $this->id_pago;
}

function getMonto() {
    return $this->monto;
}

function getFecha() {
    return $this->fecha;
}

function setId_pago($id_pago) {
    $this->id_pago = $id_pago;
}

function setMonto($monto) {
    $this->monto = $monto;
}

function setFecha($fecha) {
    $this->fecha = $fecha;
}


}
?>