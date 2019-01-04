<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of repositorio_referencias
 *
 * @author Miranda
 */
class repositorio_referencias {
      public static function insertar_referencia($conexion, $referencia) {
        $referencia_insertado = false;
       //$referencia = new referencias;
        if (isset($conexion)) {
            try {

                
                $nombre = $referencia->getNombre();
                $apellido = $referencia->getApellido();
                $telefono = $referencia->getTelefono();
                $id = $referencia->getId_persona_natural();
                //$correo = $referencia->getCorreo();


                $sql = 'INSERT INTO referencias ( nombre, apellido,   telefono, id_persona_natural) '
                        . ' values (:nombre,:apellido,  :telefono, :id)';
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);
                
                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(':apellido', $apellido, PDO::PARAM_STR);
                //$sentencia->bindParam(':correo', $correo, PDO::PARAM_STR);
                $sentencia->bindParam(':telefono', $telefono, PDO::PARAM_STR);
                $sentencia->bindParam(':id', $id, PDO::PARAM_STR);


                $referencia_insertado = $sentencia->execute();
//             $accion = 'Se registro al siguiente referencia de mantenimiento: ' . $nombre . ", con direccion ". $direccion . ", telefono ". $telefono.", y correo ".$correo ;
//              self::insertar_bitacora($conexion, $accion);
            } catch (PDOException $ex) {
                echo '<script>swal("No se puedo realizar el registro", "Revise los datos ingresados  ", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $referencia_insertado;
    }
}
?>