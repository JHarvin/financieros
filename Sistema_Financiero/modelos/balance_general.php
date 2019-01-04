<?php

class balance_general {
 private $id_balance;
 private $id_persona;
 private $periodo;
 private $prestable;
 private $efectivo;
 private $valor_negociable;
 private $cuenta_por_cobrar;
 private $inventarios;
  private $terrenos;
 private $edificio_equipo;
 private $depreciacion;
 private $total_activo_corriente;
 private $total_activo_noCorriente;
 private $total_activo;
 private $cuenta_por_pagar;
 private $documento_por_pagar ;
 private $total_pasivo_corriente;
 private $deuda_largop;
 private $accioneC;
 private $ganancias_retenidas;
 private $total_pasivo_patrimonio;
 private $total_pasivo;
         
         
 function __construct() {
     
 }
 function getTotal_pasivo_corriente() {
     return $this->total_pasivo_corriente;
 }

 function getTotal_pasivo_patrimonio() {
     return $this->total_pasivo_patrimonio;
 }

 function setTotal_pasivo_corriente($total_pasivo_corriente) {
     $this->total_pasivo_corriente = $total_pasivo_corriente;
 }

 function setTotal_pasivo_patrimonio($total_pasivo_patrimonio) {
     $this->total_pasivo_patrimonio = $total_pasivo_patrimonio;
 }

  
 
 function getTotal_activo_corriente() {
     return $this->total_activo_corriente;
 }

 function getTotal_activo_noCorriente() {
     return $this->total_activo_noCorriente;
 }

 function getTotal_activo() {
     return $this->total_activo;
 }

 function getTotal_pasivo() {
     return $this->total_pasivo;
 }

 function setTotal_activo_corriente($total_activo_corriente) {
     $this->total_activo_corriente = $total_activo_corriente;
 }

 function setTotal_activo_noCorriente($total_activo_noCorriente) {
     $this->total_activo_noCorriente = $total_activo_noCorriente;
 }

 function setTotal_activo($total_activo) {
     $this->total_activo = $total_activo;
 }

 function setTotal_pasivo($total_pasivo) {
     $this->total_pasivo = $total_pasivo;
 }

  
 
 function getId_balance() {
     return $this->id_balance;
 }

 function getDepreciacion() {
     return $this->depreciacion;
 }

 function setDepreciacion($depreciacion) {
     $this->depreciacion = $depreciacion;
 }

  
 function getId_persona() {
     return $this->id_persona;
 }

 function getPeriodo() {
     return $this->periodo;
 }

 function getPrestable() {
     return $this->prestable;
 }

 function getEfectivo() {
     return $this->efectivo;
 }

 function getValor_negociable() {
     return $this->valor_negociable;
 }

 function getCuenta_por_cobrar() {
     return $this->cuenta_por_cobrar;
 }

 function getInventarios() {
     return $this->inventarios;
 }

 function getTerrenos() {
     return $this->terrenos;
 }

 function getEdificio_equipo() {
     return $this->edificio_equipo;
 }

 function setId_balance($id_balance) {
     $this->id_balance = $id_balance;
 }

 function setId_persona($id_persona) {
     $this->id_persona = $id_persona;
 }

 function setPeriodo($periodo) {
     $this->periodo = $periodo;
 }

 function setPrestable($prestable) {
     $this->prestable = $prestable;
 }

 function setEfectivo($efectivo) {
     $this->efectivo = $efectivo;
 }

 function setValor_negociable($valor_negociable) {
     $this->valor_negociable = $valor_negociable;
 }

 function setCuenta_por_cobrar($cuenta_por_cobrar) {
     $this->cuenta_por_cobrar = $cuenta_por_cobrar;
 }

 function setInventarios($inventarios) {
     $this->inventarios = $inventarios;
 }

 function setTerrenos($terrenos) {
     $this->terrenos = $terrenos;
 }

 function setEdificio_equipo($edificio_equipo) {
     $this->edificio_equipo = $edificio_equipo;
 }
 function getCuenta_por_pagar() {
     return $this->cuenta_por_pagar;
 }

 function getDocumento_por_pagar() {
     return $this->documento_por_pagar;
 }

 function getDeuda_largop() {
     return $this->deuda_largop;
 }

 function getAccioneC() {
     return $this->accioneC;
 }

 function getGanancias_retenidas() {
     return $this->ganancias_retenidas;
 }

 function setCuenta_por_pagar($cuenta_por_pagar) {
     $this->cuenta_por_pagar = $cuenta_por_pagar;
 }

 function setDocumento_por_pagar($documento_por_pagar) {
     $this->documento_por_pagar = $documento_por_pagar;
 }

 function setDeuda_largop($deuda_largop) {
     $this->deuda_largop = $deuda_largop;
 }

 function setAccioneC($accioneC) {
     $this->accioneC = $accioneC;
 }

 function setGanancias_retenidas($ganancias_retenidas) {
     $this->ganancias_retenidas = $ganancias_retenidas;
 }



}
?>