<?php

class departamento {
  private $id_departamento;
  private $nombre;
  private $correlativo;
  
  function __construct() {

  }
  function getId_departamento() {
      return $this->id_departamento;
  }

  function getNombre() {
      return $this->nombre;
  }

  function getCorrelativo() {
      return $this->correlativo;
  }

  function setId_departamento($id_departamento) {
      $this->id_departamento = $id_departamento;
  }

  function setNombre($nombre) {
      $this->nombre = $nombre;
  }

  function setCorrelativo($correlativo) {
      $this->correlativo = $correlativo;
  }


}
?>