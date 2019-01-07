<?php


class expediente_natural {
private $persona_natural;
private $id_prestamo;

function __construct() {
    
}
function getPersona_natural() {
    return $this->persona_natural;
}

function getId_prestamo() {
    return $this->id_prestamo;
}

function setPersona_natural($persona_natural) {
    $this->persona_natural = $persona_natural;
}

function setId_prestamo($id_prestamo) {
    $this->id_prestamo = $id_prestamo;
}


}
?>