<?php


class activo {
 private $id_activo;
 private $id_tipo;
 private $id_departamento;
 private $id_institucion;
 private $id_estado;
 private $id_usuario;
 private $id_encargado;
 private $correlativo;
 private $fecha;
 private $descripcion;
  private $precio;
  
  
 function __construct() {
     
 }
 function getId_activo() {
     return $this->id_activo;
 }

 function getId_tipo() {
     return $this->id_tipo;
 }

 function getId_departamento() {
     return $this->id_departamento;
 }

 function getId_institucion() {
     return $this->id_institucion;
 }

 function getId_estado() {
     return $this->id_estado;
 }

 function getId_usuario() {
     return $this->id_usuario;
 }

 function getId_encargado() {
     return $this->id_encargado;
 }

 function getCorrelativo() {
     return $this->correlativo;
 }

 function getFecha() {
     return $this->fecha;
 }

 function getDescripcion() {
     return $this->descripcion;
 }

 function getPrecio() {
     return $this->precio;
 }

 function setId_activo($id_activo) {
     $this->id_activo = $id_activo;
 }

 function setId_tipo($id_tipo) {
     $this->id_tipo = $id_tipo;
 }

 function setId_departamento($id_departamento) {
     $this->id_departamento = $id_departamento;
 }

 function setId_institucion($id_institucion) {
     $this->id_institucion = $id_institucion;
 }

 function setId_estado($id_estado) {
     $this->id_estado = $id_estado;
 }

 function setId_usuario($id_usuario) {
     $this->id_usuario = $id_usuario;
 }

 function setId_encargado($id_encargado) {
     $this->id_encargado = $id_encargado;
 }

 function setCorrelativo($correlativo) {
     $this->correlativo = $correlativo;
 }

 function setFecha($fecha) {
     $this->fecha = $fecha;
 }

 function setDescripcion($descripcion) {
     $this->descripcion = $descripcion;
 }

 function setPrecio($precio) {
     $this->precio = $precio;
 }


}
?>