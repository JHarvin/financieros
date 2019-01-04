<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of repositorio_pago
 *
 * @author Miranda
 */
class repositorio_pago {
    
     public static function insertar_pago($conexion, $pago) {
        $pago_insertado = false;
       // $pago = new pago();
        if (isset($conexion)) {
            try {

                $id_prestamo = $pago->getId_prestamo();
                $monto = $pago->getMonto();
                $fecha = $pago->getFecha();
                $mora = $pago->getMora();
                $interes = $pago->getInteres();


                $sql = 'INSERT INTO pago (id_prestamo, monto, mora, interes, fecha) '
                        . ' values (:id_prestamo, :monto, :mora, :interes, :fecha )';
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);
                
                $sentencia->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_STR);
                $sentencia->bindParam(':monto', $monto, PDO::PARAM_STR);
                $sentencia->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                $sentencia->bindParam(':mora', $mora, PDO::PARAM_STR);
                $sentencia->bindParam(':interes', $interes, PDO::PARAM_STR);

                $pago_insertado = $sentencia->execute();
//             $accion = 'Se registro al siguiente pago de mantenimiento: ' . $nombre . ", con direccion ". $direccion . ", telefono ". $telefono.", y correo ".$correo ;
//              self::insertar_bitacora($conexion, $accion);
            } catch (PDOException $ex) {
                echo '<script>swal("No se puedo realizar el registro", "Revise los datos ingresados  ", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $pago_insertado;
    }
    
    
}
?>