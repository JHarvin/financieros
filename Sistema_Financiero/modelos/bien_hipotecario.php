<?php

class bien_hipotecario {
 private $id_bien;
 private $id_persona_natural;
 private $descripcion;
 private $ubicacion;
 private $otros_datos;
 private $anexo;
 
 function __construct() {
     
 }
 function getId_bien() {
     return $this->id_bien;
 }

 function getId_persona_natural() {
     return $this->id_persona_natural;
 }

 function getDescripcion() {
     return $this->descripcion;
 }

 function getUbicacion() {
     return $this->ubicacion;
 }

 function getOtros_datos() {
     return $this->otros_datos;
 }

 function getAnexo() {
     return $this->anexo;
 }

 function setId_bien($id_bien) {
     $this->id_bien = $id_bien;
 }

 function setId_persona_natural($id_persona_natural) {
     $this->id_persona_natural = $id_persona_natural;
 }

 function setDescripcion($descripcion) {
     $this->descripcion = $descripcion;
 }

 function setUbicacion($ubicacion) {
     $this->ubicacion = $ubicacion;
 }

 function setOtros_datos($otros_datos) {
     $this->otros_datos = $otros_datos;
 }

 function setAnexo($anexo) {
     $this->anexo = $anexo;
 }


}
?>