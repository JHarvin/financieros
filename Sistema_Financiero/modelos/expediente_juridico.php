<?php

class expediente_juridico {
private $id_prestamo;
private $id_persona_juridica;


function __construct() {
    
}
function getId_prestamo() {
    return $this->id_prestamo;
}

function getId_persona_juridica() {
    return $this->id_persona_juridica;
}

function setId_prestamo($id_prestamo) {
    $this->id_prestamo = $id_prestamo;
}

function setId_persona_juridica($id_persona_juridica) {
    $this->id_persona_juridica = $id_persona_juridica;
}


}
?>