<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of repositorio_expediente_natural
 *
 * @author Miranda
 */
class repositorio_expediente_natural {

    //**************** PERSONAS NATURALES *******************
    public static function insertar_persona_natural($conexion, $persona) {
        $persona_insertado = false;

        if (isset($conexion)) {
            try {

                $dui = $persona->getDui();
                $nit = $persona->getNit();
                $nombre = $persona->getNombe();
                $apellido = $persona->getApellido();
                $direccion = $persona->getDireccion();
                $telefono = $persona->getTelefono();
//                $cod= $persona->getId_persona_natural();
                //$correo = $persona->getCorreo();


                $sql = 'INSERT INTO persona_natural (nombre, apellido, direccion, dui, nit,  telefono, monto)'
                        . ' values (:nombre,:apellido, :direccion, :dui, :nit, :telefono, "0")';
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(':apellido', $apellido, PDO::PARAM_STR);
                $sentencia->bindParam(':direccion', $direccion, PDO::PARAM_STR);
                $sentencia->bindParam(':dui', $dui, PDO::PARAM_STR);
                $sentencia->bindParam(':nit', $nit, PDO::PARAM_STR);
                $sentencia->bindParam(':telefono', $telefono, PDO::PARAM_STR);
//                $sentencia->bindParam(':cod', $cod, PDO::PARAM_STR);


                $persona_insertado = $sentencia->execute();
//             $accion = 'Se registro al siguiente persona de mantenimiento: ' . $nombre . ", con direccion ". $direccion . ", telefono ". $telefono.", y correo ".$correo ;
//              self::insertar_bitacora($conexion, $accion);
            } catch (PDOException $ex) {
                echo '<script>swal("No se puedo realizar el registro", "Revise los datos ingresados  ", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $persona_insertado;
    }
    
      public static function obtenerU_ultimo_persona($conexion) {
        $codigo = "";
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT( persona_natural.id_persona_natural)
 from persona_natural
order by persona_natural.id_persona_natural
 desc limit 1";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
            foreach ($resultado as $fila) {
                $codigo = $fila[0];
            }
        }
        return $codigo;
    }
    
      public static function insertar_bien($conexion, $bien) {
        $bien_insertado = false;
        //$bien = new bien_hipotecario();
        if (isset($conexion)) {
            try {

                $des = $bien->getDescripcion();
                $ubi = $bien->getUbicacion();
                $otro = $bien->getOtros_datos();
                $anexo = $bien->getAnexo();
                $idp = $bien->getId_persona_natural();
                //$correo = $bien->getCorreo();


                $sql = 'INSERT INTO bien_hipotecario (id_persona_natural, descripcion, ubicacion, otros_datos, anexo)'
                        . ' values (:idp,:des, :ubi, :otro, :anexo)';
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':idp', $idp, PDO::PARAM_STR);
                $sentencia->bindParam(':otro', $otro, PDO::PARAM_STR);
                $sentencia->bindParam(':ubi', $ubi, PDO::PARAM_STR);
                $sentencia->bindParam(':des', $des, PDO::PARAM_STR);
                $sentencia->bindParam(':anexo', $anexo, PDO::PARAM_STR);


                $bien_insertado = $sentencia->execute();
//             $accion = 'Se registro al siguiente bien de mantenimiento: ' . $nombre . ", con direccion ". $direccion . ", telefono ". $telefono.", y correo ".$correo ;
//              self::insertar_bitacora($conexion, $accion);
            } catch (PDOException $ex) {
                echo '<script>swal("No se puedo realizar el registro", "Revise los datos ingresados  ", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return  $bien_insertado;
    }

    public static function obtener_persona_natural($conexion, $codigo) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
persona_natural.id_persona_natural AS id,
(CONCAT(persona_natural.nombre,' ',persona_natural.apellido)) AS nombre,
persona_natural.direccion as direccion,
persona_natural.dui as dui,
persona_natural.nit as nit,
persona_natural.correo as correo,
persona_natural.categoria as categoria,
persona_natural.observaciones as obs,
persona_natural.telefono as tel,
persona_natural.monto as monto
FROM
persona_natural
WHERE
persona_natural.id_persona_natural = $codigo";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }

    public static function obtener_persona_natural_abono($conexion, $codigo) {
        $resultado = ""; //echo '<script language="javascript">alert("cod '.$codigo.'");</script>'; 
        if (isset($conexion)) {
            try {
                $sql = "SELECT
persona_natural.id_persona_natural AS idper,
(CONCAT(persona_natural.nombre,' ',persona_natural.apellido)) AS nombre,
persona_natural.dui AS dui,
persona_natural.nit AS nit,
prestamo.id_prestamo AS idp,
prestamo.prestamo_original AS monto,
prestamo.saldo_actual AS sact,
prestamo.mora_acumulada AS mora,
prestamo.intereses_acumulados AS intacu,
(CONCAT(usuario.nombre,' ',usuario.apellido)) AS nombreuser,
usuario.id_usuario AS idu,
prestamo.tiempo AS tiempo,
prestamo.proximo_pago AS pp,
prestamo.fecha AS fech,
DATE_ADD( prestamo.fecha, INTERVAL tiempo MONTH ) as vence,
prestamo.tasa_interes as tasa
FROM
persona_natural
INNER JOIN expediente_natural ON expediente_natural.persona_natural = persona_natural.id_persona_natural
INNER JOIN prestamo ON expediente_natural.id_prestamo = prestamo.id_prestamo
INNER JOIN usuario ON prestamo.id_asesor = usuario.id_usuario
WHERE
persona_natural.id_persona_natural = $codigo ";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }
    
    public static function obtener_persona_juridica_abono($conexion, $codigo) {
        $resultado = ""; //echo '<script language="javascript">alert("cod '.$codigo.'");</script>'; 
        if (isset($conexion)) {
            try {
                $sql = "SELECT
persona_juridica.id_persona_juridica AS idper,
persona_juridica.nombre AS nombre,
persona_juridica.dui AS dui,
persona_juridica.nit AS nit,
prestamo.id_prestamo AS idp,
prestamo.prestamo_original AS monto,
prestamo.saldo_actual AS sact,
prestamo.mora_acumulada AS mora,
prestamo.intereses_acumulados AS intacu,
(CONCAT(usuario.nombre,' ',usuario.apellido)) AS nombreuser,
usuario.id_usuario AS idu,
prestamo.tiempo AS tiempo,
prestamo.proximo_pago AS pp,
prestamo.fecha AS fech,
DATE_ADD( prestamo.fecha, INTERVAL tiempo MONTH ) as vence,
prestamo.tasa_interes as tasa
FROM
persona_juridica
INNER JOIN expediente_juridico ON expediente_juridico.id_persona_juridica = persona_juridica.id_persona_juridica
INNER JOIN prestamo ON expediente_juridico.id_prestamo = prestamo.id_prestamo
INNER JOIN usuario ON prestamo.id_asesor = usuario.id_usuario
WHERE
persona_juridica.id_persona_juridica= $codigo ";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }

    public static function lista_persona_natural($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
                persona_natural.id_persona_natural as id,
                (CONCAT(persona_natural.nombre,' ',persona_natural.apellido))  as nombre,
                persona_natural.apellido
                FROM
                persona_natural
                WHERE
persona_natural.monto = 0";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }

    public static function lista_clientes($conexion) {
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT
                persona_natural.id_persona_natural as id,
                (CONCAT(persona_natural.nombre,' ',persona_natural.apellido))  as nombre,
                persona_natural.apellido
                FROM
                persona_natural
                  WHERE
persona_natural.monto = 1";
                $resultado = $conexion->query($sql);
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $resultado;
    }

    //****************  EXPEDIENTE **************
    public static function insertar_expediente($conexion, $expediente) {
        $expediente_insertado = false;
        //$expediente=new expediente_natural();

        if (isset($conexion)) {
            try {

                $dui = $expediente->getId_prestamo();
                $nit = $expediente->getPersona_natural();

                 $sql = "UPDATE persona_natural SET monto='1' "
                         . "WHERE (id_persona_natural='$nit') LIMIT 1";
                 $sentencia = $conexion->prepare($sql);
                 $expediente_insertado = $sentencia->execute();

                $sql = 'INSERT INTO expediente_natural (id_prestamo,persona_natural)'
                        . ' values ( :dui, :nit)';
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':dui', $dui, PDO::PARAM_STR);
                $sentencia->bindParam(':nit', $nit, PDO::PARAM_STR);


                $expediente_insertado = $sentencia->execute();
//             $accion = 'Se registro al siguiente expediente de mantenimiento: ' . $nombre . ", con direccion ". $direccion . ", telefono ". $telefono.", y correo ".$correo ;
//              self::insertar_bitacora($conexion, $accion);
            } catch (PDOException $ex) {
                echo '<script>swal("No se puedo realizar el registro", "Revise los datos ingresados  ", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $expediente_insertado;
    }

}

?>