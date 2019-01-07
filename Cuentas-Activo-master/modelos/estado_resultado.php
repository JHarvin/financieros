<?php


class estado_resultado {
private $id_estado;
private $id_persona_juridica;
private $periodo;
private $prestable;
private $ingreso_venta;
private $costo_venta;
private $utilidad_bruta;

private $gasto_venta;
private $gasto_administrativo;
private $gasto_arrendamiento;
private $gasto_depreciacion;
private $total_operativo;
private $utilidad_operativa;
private $gasto_interes;
private $utilidad_antes_impuestos;
private $impuestos;
private $valor_negociable;
private $utilidad_neta;

function __construct() {
    
}
function getTotal_operativo() {
    return $this->total_operativo;
}

function getUtilidad_antes_impuestos() {
    return $this->utilidad_antes_impuestos;
}

function getImpuestos() {
    return $this->impuestos;
}

function getUtilidad_neta() {
    return $this->utilidad_neta;
}

function setTotal_operativo($total_operativo) {
    $this->total_operativo = $total_operativo;
}

function setUtilidad_antes_impuestos($utilidad_antes_impuestos) {
    $this->utilidad_antes_impuestos = $utilidad_antes_impuestos;
}

function setImpuestos($impuestos) {
    $this->impuestos = $impuestos;
}

function setUtilidad_neta($utilidad_neta) {
    $this->utilidad_neta = $utilidad_neta;
}



function getUtilidad_operativa() {
    return $this->utilidad_operativa;
}

function setUtilidad_operativa($utilidad_operativa) {
    $this->utilidad_operativa = $utilidad_operativa;
}


function getGasto_interes() {
    return $this->gasto_interes;
}

function setGasto_interes($gasto_interes) {
    $this->gasto_interes = $gasto_interes;
}


function getGasto_depreciacion() {
    return $this->gasto_depreciacion;
}

function setGasto_depreciacion($gasto_depreciacion) {
    $this->gasto_depreciacion = $gasto_depreciacion;
}


function getValor_negociable() {
    return $this->valor_negociable;
}
function getGasto_arrendamiento() {
    return $this->gasto_arrendamiento;
}

function setGasto_arrendamiento($gasto_arrendamiento) {
    $this->gasto_arrendamiento = $gasto_arrendamiento;
}



function setValor_negociable($valor_negociable) {
    $this->valor_negociable = $valor_negociable;
}

function getId_estado() {
    return $this->id_estado;
}

function getId_persona_juridica() {
    return $this->id_persona_juridica;
}

function getPeriodo() {
    return $this->periodo;
}

function getPrestable() {
    return $this->prestable;
}

function getIngreso_venta() {
    return $this->ingreso_venta;
}

function getCosto_venta() {
    return $this->costo_venta;
}

function getUtilidad_bruta() {
    return $this->utilidad_bruta;
}

function getGasto_operativo() {
    return $this->gasto_operativo;
}

function getGasto_venta() {
    return $this->gasto_venta;
}

function getGasto_administrativo() {
    return $this->gasto_administrativo;
}

function setId_estado($id_estado) {
    $this->id_estado = $id_estado;
}

function setId_persona_juridica($id_persona_juridica) {
    $this->id_persona_juridica = $id_persona_juridica;
}

function setPeriodo($periodo) {
    $this->periodo = $periodo;
}

function setPrestable($prestable) {
    $this->prestable = $prestable;
}

function setIngreso_venta($ingreso_venta) {
    $this->ingreso_venta = $ingreso_venta;
}

function setCosto_venta($costo_venta) {
    $this->costo_venta = $costo_venta;
}

function setUtilidad_bruta($utilidad_bruta) {
    $this->utilidad_bruta = $utilidad_bruta;
}

function setGasto_operativo($gasto_operativo) {
    $this->gasto_operativo = $gasto_operativo;
}

function setGasto_venta($gasto_venta) {
    $this->gasto_venta = $gasto_venta;
}

function setGasto_administrativo($gasto_administrativo) {
    $this->gasto_administrativo = $gasto_administrativo;
}



}
?>