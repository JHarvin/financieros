<?php

class fiador {

    private $id_fiador;
    private $nombre;
    private $apellido;
    private $direccion;
    private $dui;
    private $nit;
    private $correo;
    private $id_persona_natural;
    private $lugar_trabajo;
    private $id_telefono;

    function __construct() {
        
    }

    function getId_fiador() {
        return $this->id_fiador;
    }

    function getNombre() {
        return $this->nombre;
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

    function getId_persona_natural() {
        return $this->id_persona_natural;
    }

    function getLugar_trabajo() {
        return $this->lugar_trabajo;
    }

    function getId_telefono() {
        return $this->id_telefono;
    }

    function setId_fiador($id_fiador) {
        $this->id_fiador = $id_fiador;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
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

    function setId_persona_natural($id_persona_natural) {
        $this->id_persona_natural = $id_persona_natural;
    }

    function setLugar_trabajo($lugar_trabajo) {
        $this->lugar_trabajo = $lugar_trabajo;
    }

    function setId_telefono($id_telefono) {
        $this->id_telefono = $id_telefono;
    }

}
