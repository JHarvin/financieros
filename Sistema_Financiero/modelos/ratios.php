<?php

class ratios {
private $liquidez_corriente ;
private $razon_rapida ;
private $rotacion_inventarios ;
private $periodo_cobro ;
private $indice_endeudamiento ;
private $cargo_interes_fijo ;
private $margen_utilidad_bruta ;
private $margen_utilidad_neta ;
private $rendimiento_activo ;
private $rendimiento_patrimonio ;
private $periodo ;
private $id;



function __construct() {
    
}
function getId() {
    return $this->id;
}

function setId($id) {
    $this->id = $id;
}



function getPeriodo() {
    return $this->periodo;
}

function setPeriodo($periodo) {
    $this->periodo = $periodo;
}


function getLiquidez_corriente() {
    return $this->liquidez_corriente;
}

function getRazon_rapida() {
    return $this->razon_rapida;
}

function getRotacion_inventarios() {
    return $this->rotacion_inventarios;
}

function getPeriodo_cobro() {
    return $this->periodo_cobro;
}

function getIndice_endeudamiento() {
    return $this->indice_endeudamiento;
}

function getCargo_interes_fijo() {
    return $this->cargo_interes_fijo;
}

function getMargen_utilidad_bruta() {
    return $this->margen_utilidad_bruta;
}

function getMargen_utilidad_neta() {
    return $this->margen_utilidad_neta;
}

function getRendimiento_activo() {
    return $this->rendimiento_activo;
}

function getRendimiento_patrimonio() {
    return $this->rendimiento_patrimonio;
}

function setLiquidez_corriente($liquidez_corriente) {
    $this->liquidez_corriente = $liquidez_corriente;
}

function setRazon_rapida($razon_rapida) {
    $this->razon_rapida = $razon_rapida;
}

function setRotacion_inventarios($rotacion_inventarios) {
    $this->rotacion_inventarios = $rotacion_inventarios;
}

function setPeriodo_cobro($periodo_cobro) {
    $this->periodo_cobro = $periodo_cobro;
}

function setIndice_endeudamiento($indice_endeudamiento) {
    $this->indice_endeudamiento = $indice_endeudamiento;
}

function setCargo_interes_fijo($cargo_interes_fijo) {
    $this->cargo_interes_fijo = $cargo_interes_fijo;
}

function setMargen_utilidad_neta($margen_utilidad_neta) {
    $this->margen_utilidad_neta = $margen_utilidad_neta;
}

function setRendimiento_activo($rendimiento_activo) {
    $this->rendimiento_activo = $rendimiento_activo;
}

function setRendimiento_patrimonio($rendimiento_patrimonio) {
    $this->rendimiento_patrimonio = $rendimiento_patrimonio;
}

function setMargen_utilidad_bruta($margen_utilidad_bruta) {
    $this->margen_utilidad_bruta = $margen_utilidad_bruta;
}



}
