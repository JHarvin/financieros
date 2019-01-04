<?php
class persona_natural {
 private $id_persona_natural;
 private $nombe;
 private $apellido;
 private $direccion;
 private $dui;
 private $nit;
 private $correo;
 private $categoria;
 private $observaviones;
 private $telefono;
 private $monto;
 function __construct() {
     
 }
 function getId_persona_natural() {
     return $this->id_persona_natural;
 }

 function getNombe() {
     return $this->nombe;
 }

 function getApellido() {
     return $this->apellido;
 }

 function getDireccion() {
     return $this->direccion;
 }

 function getDui() {
     return $this->dui;
 }

 function getNit() {
     return $this->nit;
 }

 function getCorreo() {
     return $this->correo;
 }

 function getCategoria() {
     return $this->categoria;
 }

 function getObservaviones() {
     return $this->observaviones;
 }

 function getTelefono() {
     return $this->telefono;
 }

 function getMonto() {
     return $this->monto;
 }

 function setId_persona_natural($id_persona_natural) {
     $this->id_persona_natural = $id_persona_natural;
 }

 function setNombe($nombe) {
     $this->nombe = $nombe;
 }

 function setApellido($apellido) {
     $this->apellido = $apellido;
 }

 function setDireccion($direccion) {
     $this->direccion = $direccion;
 }

 function setDui($dui) {
     $this->dui = $dui;
 }

 function setNit($nit) {
     $this->nit = $nit;
 }

 function setCorreo($correo) {
     $this->correo = $correo;
 }

 function setCategoria($categoria) {
     $this->categoria = $categoria;
 }

 function setObservaviones($observaviones) {
     $this->observaviones = $observaviones;
 }

 function setTelefono($telefono) {
     $this->telefono = $telefono;
 }

 function setMonto($monto) {
     $this->monto = $monto;
 }


}
