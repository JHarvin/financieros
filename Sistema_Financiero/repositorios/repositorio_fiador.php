<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of repositorio_fiador
 *
 * @author Miranda
 */
class repositorio_fiador {
     public static function insertar_fiador($conexion, $fiador) {
        $fiador_insertado = false;
        //$fiador = new fiador();
        if (isset($conexion)) {
            try {

                $dui = $fiador->getDui();
                $nit = $fiador->getNit();
                $nombre = $fiador->getNombre();
                $apellido = $fiador->getApellido();
                $direccion = $fiador->getDireccion();
                $telefono = $fiador->getId_telefono();
                $id_per_nat = $fiador->getId_persona_natural();
                $correo = $fiador->getCorreo();
                $lugar = $fiador->getLugar_trabajo();
                //$correo = $fiador->getCorreo();


                $sql = 'INSERT INTO fiador (id_persona_natural, nombre, apellido, direccion, dui, nit, correo, lugar_trabajo, telefono) '
                        . ' values (:id_per_nat,:nombre,:apellido, :direccion, :dui, :nit, :correo, :lugar, :telefono)';
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);
                
                $sentencia->bindParam(':id_per_nat', $id_per_nat, PDO::PARAM_STR);
                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(':apellido', $apellido, PDO::PARAM_STR);
                $sentencia->bindParam(':direccion', $direccion, PDO::PARAM_STR);
                $sentencia->bindParam(':dui', $dui, PDO::PARAM_STR);
                $sentencia->bindParam(':nit', $nit, PDO::PARAM_STR);
                $sentencia->bindParam(':correo', $correo, PDO::PARAM_STR);
                $sentencia->bindParam(':lugar', $lugar, PDO::PARAM_STR);
                $sentencia->bindParam(':telefono', $telefono, PDO::PARAM_STR);


                $fiador_insertado = $sentencia->execute();
//             $accion = 'Se registro al siguiente fiador de mantenimiento: ' . $nombre . ", con direccion ". $direccion . ", telefono ". $telefono.", y correo ".$correo ;
//              self::insertar_bitacora($conexion, $accion);
            } catch (PDOException $ex) {
                echo '<script>swal("No se puedo realizar el registro", "Revise los datos ingresados  ", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $fiador_insertado;
    }
}
?>