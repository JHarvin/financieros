<?php
class tipo_credito {
  private $id_tipo_credito;
  private $nombre;
  private $termino_condiciones;
  function __construct() {
      
  }
  function getId_tipo_credito() {
      return $this->id_tipo_credito;
  }

  function getNombre() {
      return $this->nombre;
  }

  function getTermino_condiciones() {
      return $this->termino_condiciones;
  }

  function setId_tipo_credito($id_tipo_credito) {
      $this->id_tipo_credito = $id_tipo_credito;
  }

  function setNombre($nombre) {
      $this->nombre = $nombre;
  }

  function setTermino_condiciones($termino_condiciones) {
      $this->termino_condiciones = $termino_condiciones;
  }


 
}
?>