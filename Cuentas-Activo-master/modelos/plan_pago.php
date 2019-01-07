<?php


class plan_pago {
private $id_plan;
private $id_tipo_credito;
private $tasa;
private $periodo;
private $monto_minimo;
private $monto_maximo;

function __construct() {
    
}
function getId_plan() {
    return $this->id_plan;
}

function getId_tipo_credito() {
    return $this->id_tipo_credito;
}

function getTasa() {
    return $this->tasa;
}

function getPeriodo() {
    return $this->periodo;
}

function getMonto_minimo() {
    return $this->monto_minimo;
}

function getMonto_maximo() {
    return $this->monto_maximo;
}

function setId_plan($id_plan) {
    $this->id_plan = $id_plan;
}

function setId_tipo_credito($id_tipo_credito) {
    $this->id_tipo_credito = $id_tipo_credito;
}

function setTasa($tasa) {
    $this->tasa = $tasa;
}

function setPeriodo($periodo) {
    $this->periodo = $periodo;
}

function setMonto_minimo($monto_minimo) {
    $this->monto_minimo = $monto_minimo;
}

function setMonto_maximo($monto_maximo) {
    $this->monto_maximo = $monto_maximo;
}


}
