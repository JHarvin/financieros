<?php

class telefono {
private $id_telefono;
private $numero;

function __construct() {
    
}
function getId_telefono() {
    return $this->id_telefono;
}

function getNumero() {
    return $this->numero;
}

function setId_telefono($id_telefono) {
    $this->id_telefono = $id_telefono;
}

function setNumero($numero) {
    $this->numero = $numero;
}


}
?>