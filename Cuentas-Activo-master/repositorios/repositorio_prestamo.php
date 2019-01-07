<?php

class repositorio_prestamo {

    public static function insertar_prestamo($conexion, $prestamo) {
        $prestamo_insertado = false;
        //$prestamo = new presamo();
        if (isset($conexion)) {
            try {

                $user = $prestamo->getId_asesor();
                $nombre = $prestamo->getPrestamo_original();
                $fecha = $prestamo->getFecha();
                $t = $prestamo->getTiempo();
                $tasa = $prestamo->getTasa();
                $tipo = $prestamo->getTipo_credito();


                $sql = 'INSERT INTO prestamo (  id_asesor, prestamo_original, estado, proximo_pago, saldo_actual, fecha, tiempo,tasa_interes, mora_acumulada, intereses_acumulados, tasa_moratoria, tipo_credito ) '
                        . " values ( :user, :nombre, 'PENDIENTE', DATE_ADD( CURDATE( ), INTERVAL 1 MONTH ), :nombre, :fecha, :t, :tasa, '0', '0', '0', :tipo)";
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(':user', $user, PDO::PARAM_STR);
                $sentencia->bindParam(':plan', $plan, PDO::PARAM_STR);
                $sentencia->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                $sentencia->bindParam(':t', $t, PDO::PARAM_STR);
                $sentencia->bindParam(':tasa', $tasa, PDO::PARAM_STR);
                $sentencia->bindParam(':tipo', $tipo, PDO::PARAM_STR);
                // $sentencia->bindParam(':nit1', $nit1, PDO::PARAM_STR);


                $prestamo_insertado = $sentencia->execute();
//             $accion = 'Se registro al siguiente prestamo de mantenimiento: ' . $nombre . ", con direccion ". $direccion . ", telefono ". $telefono.", y correo ".$correo ;
//              self::insertar_bitacora($conexion, $accion);
            } catch (PDOException $ex) {
                echo '<script>swal("No se puedo realizar el registro", "Revise los datos ingresados  ", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $prestamo_insertado;
    }

    public static function actualizar_prestamo($conexion, $prestamo, $id) {
        $prestamo_insertado = false;
        //$prestamo = new presamo();
        if (isset($conexion)) {
            try {

                $sa = $prestamo->getSaldo_actual();
                $estado = $prestamo->getEstado();
                $ppesona = $prestamo->getId_asesor();
                $cual = $prestamo->getId_plan();

                $sql = "SELECT
                        (DATE_ADD( prestamo.proximo_pago, INTERVAL 1 MONTH )) as pp
                        FROM
                        prestamo
                        WHERE
                        prestamo.id_prestamo = '$id'";


                $resultado = $conexion->query($sql);
                foreach ($resultado as $fila) {
                    $pp = $fila[0];
                }



                if ($estado == "no") {
                    $sql = "UPDATE prestamo SET saldo_actual='$sa', proximo_pago='$pp' WHERE (`id_prestamo`=$id) LIMIT 1 ";
                } else {
                    if($cual=="N"){
                    $sql2 = "UPDATE `persona_natural` SET `monto`='0' WHERE (`id_persona_natural`='$ppesona') LIMIT 1 ";
                    }else{
                        $sql2 = "UPDATE persona_juridica  SET `monto`='0' WHERE (`id_persona_juridica`='$ppesona') LIMIT 1 "; 
                    }
                    
                    $sql = "UPDATE prestamo SET saldo_actual='$sa', estado='FINALIZADO' WHERE (`id_prestamo`=$id) LIMIT 1 ";
                    $sentencia2 = $conexion->prepare($sql2);
                    $prestamo_insertado = $sentencia2->execute();
                }
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);


                $prestamo_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                echo '<script>swal("No se puedo realizar el registro", "Revise los datos ingresados  ", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $prestamo_insertado;
    }

    public static function obtenerU_ultimo_prestamo($conexion) {
        $codigo = "";
        $resultado = "";
        if (isset($conexion)) {
            try {
                $sql = "SELECT id_prestamo from prestamo order by id_prestamo desc limit 1";
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

    public static function insertar_prestamo_juridico($conexion, $prestamo) {
        $prestamo_insertado = false;

        if (isset($conexion)) {
            try {

                $asesor = '1';
                $monto_original = $prestamo->getPrestamo_original();
                $tiempo = $prestamo->getTiempo();
                $tasa_interes = $prestamo->getTasa();
                $mora = '';
                $estado = 'PENDIENTE';
                $interes_acumulado = '';
                $tasa_moratora = '';

                $sql = "INSERT INTO prestamo (id_asesor, prestamo_original, saldo_actual, mora_acumulada, intereses_acumulados, estado,   tiempo, tasa_interes, tasa_moratoria)"
                        . " VALUES(:id_asesor, :prestamo_original, :saldo_actual, :mora_acumulada, :intereses_acumulados, :estado,  :tiempo, :tasa_interes, :tasa_moratoria) ";
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':id_asesor', $asesor, PDO::PARAM_STR);
                $sentencia->bindParam(':prestamo_original', $monto_original, PDO::PARAM_STR);
                $sentencia->bindParam(':saldo_actual', $monto_original, PDO::PARAM_STR);
                $sentencia->bindParam(':mora_acumulada', $mora, PDO::PARAM_STR);
                $sentencia->bindParam(':intereses_acumulados', $interes_acumulado, PDO::PARAM_STR);
                $sentencia->bindParam(':estado', $estado, PDO::PARAM_STR);
                $sentencia->bindParam(':tiempo', $tiempo, PDO::PARAM_STR);
                $sentencia->bindParam(':tasa_interes', $tasa_interes, PDO::PARAM_STR);
                $sentencia->bindParam(':tasa_moratoria', $tasa_moratora, PDO::PARAM_STR);

                $prestamo_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                echo '<script>swal("No se puedo realizar el registro", "Revise los datos ingresados  ", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $prestamo_insertado;
    }

    public static function lista_prestamo_pendiente_juridica($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        usuario.nombre,
                        prestamo.tipo_credito,
                        persona_juridica.nombre,
                        prestamo.prestamo_original,
                        usuario.apellido,
                        persona_juridica.categoria,
                        prestamo.tiempo,
                        persona_juridica.id_persona_juridica,
                        prestamo.id_prestamo
                        FROM
                        prestamo
                        INNER JOIN usuario ON prestamo.id_asesor = usuario.id_usuario
                        INNER JOIN expediente_juridico ON expediente_juridico.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_juridica ON expediente_juridico.id_persona_juridica = persona_juridica.id_persona_juridica
                        WHERE prestamo.estado = 'PENDIENTE'";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $resultado;
    }

    public static function lista_prestamo_normales_juridico($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        usuario.nombre,
                        prestamo.tipo_credito,
                        persona_juridica.nombre,
                        prestamo.prestamo_original,
                        usuario.apellido,
                        persona_juridica.categoria,
                        prestamo.tiempo,
                        persona_juridica.id_persona_juridica,
                        prestamo.id_prestamo
                        FROM
                        prestamo
                        INNER JOIN usuario ON prestamo.id_asesor = usuario.id_usuario
                        INNER JOIN expediente_juridico ON expediente_juridico.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_juridica ON expediente_juridico.id_persona_juridica = persona_juridica.id_persona_juridica
                            WHERE prestamo.estado = 'NORMAL'";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $resultado;
    }

    public static function lista_prestamo_normales_naturales($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        usuario.apellido,
                        persona_natural.nombre,
                        persona_natural.apellido,
                        prestamo.tipo_credito,
                        prestamo.prestamo_original,
                        prestamo.tiempo,
                        prestamo.id_prestamo,
                        usuario.id_usuario,
                        expediente_natural.persona_natural
                        FROM
                        usuario
                        INNER JOIN prestamo ON prestamo.id_asesor = usuario.id_usuario
                        INNER JOIN expediente_natural ON expediente_natural.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_natural ON expediente_natural.persona_natural = persona_natural.id_persona_natural
                        where prestamo.estado = 'NORMAL'";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $resultado;
    }

    public static function lista_prestamo_incobrable_juridico($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        usuario.nombre,
                        prestamo.tipo_credito,
                        persona_juridica.nombre,
                        prestamo.saldo_actual,
                        usuario.apellido,
                        persona_juridica.categoria,
                        prestamo.tiempo,
                        persona_juridica.id_persona_juridica,
                        prestamo.id_prestamo
                        FROM
                        prestamo
                        INNER JOIN usuario ON prestamo.id_asesor = usuario.id_usuario
                        INNER JOIN expediente_juridico ON expediente_juridico.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_juridica ON expediente_juridico.id_persona_juridica = persona_juridica.id_persona_juridica
                            WHERE prestamo.estado = 'INCOBRABLE'";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $resultado;
    }

    public static function lista_prestamo_incobrable_naturales($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        usuario.apellido,
                        persona_natural.nombre,
                        persona_natural.apellido,
                        prestamo.tipo_credito,
                        prestamo.saldo_actual,
                        prestamo.tiempo,
                        prestamo.id_prestamo,
                        usuario.id_usuario,
                        expediente_natural.persona_natural
                        FROM
                        usuario
                        INNER JOIN prestamo ON prestamo.id_asesor = usuario.id_usuario
                        INNER JOIN expediente_natural ON expediente_natural.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_natural ON expediente_natural.persona_natural = persona_natural.id_persona_natural
                        where prestamo.estado = 'INCOBRABLE'";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $resultado;
    }

    public static function lista_prestamo_pendiente_natural($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        usuario.apellido,
                        persona_natural.nombre,
                        persona_natural.apellido,
                        prestamo.tipo_credito,
                        prestamo.prestamo_original,
                        prestamo.tiempo,
                        persona_natural.id_persona_natural,
                        prestamo.estado,
                        prestamo.id_prestamo
                        FROM
                        usuario
                        INNER JOIN prestamo ON prestamo.id_asesor = usuario.id_usuario
                        INNER JOIN expediente_natural ON expediente_natural.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_natural ON expediente_natural.persona_natural = persona_natural.id_persona_natural
                        WHERE prestamo.estado = 'PENDIENTE'";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $resultado;
    }

    public static function lista_prestamo_mora_juridica($conexion, $codigo) {
        $mora = "0";

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                       pago.mora
                        FROM
                        prestamo
                        INNER JOIN expediente_juridico ON expediente_juridico.id_prestamo = prestamo.id_prestamo
                        INNER JOIN pago ON pago.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_juridica ON expediente_juridico.id_persona_juridica = persona_juridica.id_persona_juridica
                        WHERE prestamo.id_prestamo = '$codigo' 
                        ORDER BY pago.id_pago DESC
                        LIMIT 1";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if ($resultado != "") {
                    foreach ($resultado as $fila) {
                        $mora = $fila[0];
                    }
                }
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $mora;
    }
    
    public static function lista_prestamo_mora_natural($conexion, $codigo) {
        $mora = "0";

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        pago.mora
                        FROM
                        prestamo
                        INNER JOIN pago ON pago.id_prestamo = prestamo.id_prestamo
                        INNER JOIN expediente_natural ON expediente_natural.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_natural ON expediente_natural.persona_natural = persona_natural.id_persona_natural
                        WHERE prestamo.id_prestamo = '$codigo'
                        ORDER BY pago.id_pago DESC
                        LIMIT 1";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if ($resultado != "") {
                    foreach ($resultado as $fila) {
                        $mora = $fila[0];
                    }
                }
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $mora;
    }

    public static function aprobar_prestamo($conexion, $id) {
        $respuesta = false;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE prestamo SET estado = 'NORMAL' where id_prestamo = '$id'";
                $sentencia = $conexion->prepare($sql);
                $respuesta = $sentencia->execute();
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
            }
        }
        return $respuesta;
    }

    public static function hacer_incobrable($conexion, $id) {
        $respuesta = false;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE prestamo SET estado = 'INCOBRABLE' where id_prestamo = '$id'";
                $sentencia = $conexion->prepare($sql);
                $respuesta = $sentencia->execute();
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
            }
        }
        return $respuesta;
    }
    
    public static function lista_refinanciamiento_juridico($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        usuario.nombre,
                        prestamo.tipo_credito,
                        persona_juridica.nombre,
                        prestamo.prestamo_original,
                        usuario.apellido,
                        persona_juridica.categoria,
                        prestamo.tiempo,
                        persona_juridica.id_persona_juridica,
                        prestamo.id_prestamo,
                        prestamo.saldo_actual
                        FROM
                        prestamo
                        INNER JOIN usuario ON prestamo.id_asesor = usuario.id_usuario
                        INNER JOIN expediente_juridico ON expediente_juridico.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_juridica ON expediente_juridico.id_persona_juridica = persona_juridica.id_persona_juridica
                        WHERE prestamo.estado = 'NORMAL' and prestamo.saldo_actual < (prestamo.prestamo_original/2)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $resultado;
    }
    
    public static function lista_refinanciamiento_naturales($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        usuario.apellido,
                        persona_natural.nombre,
                        persona_natural.apellido,
                        prestamo.tipo_credito,
                        prestamo.prestamo_original,
			prestamo.tiempo,
                        prestamo.id_prestamo,
                        usuario.id_usuario,
                        expediente_natural.persona_natural,
			prestamo.saldo_actual
                        FROM
                        usuario
                        INNER JOIN prestamo ON prestamo.id_asesor = usuario.id_usuario
                        INNER JOIN expediente_natural ON expediente_natural.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_natural ON expediente_natural.persona_natural = persona_natural.id_persona_natural
                        WHERE prestamo.estado = 'NORMAL' and prestamo.saldo_actual < (prestamo.prestamo_original/2)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $resultado;
    }
    
    public static function refinanciar($conexion, $id) {
        $respuesta = false;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE prestamo SET estado = 'INCOBRABLE' where id_prestamo = '$id'";
                $sentencia = $conexion->prepare($sql);
                $respuesta = $sentencia->execute();
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
            }
        }
        return $respuesta;
    }
    public static function llenar_refinanciamiento_juridico($conexion, $codigo) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        usuario.nombre,
                        prestamo.tipo_credito,
                        persona_juridica.nombre,
                        prestamo.prestamo_original,
                        usuario.apellido,
                        persona_juridica.categoria,
                        prestamo.tiempo,
                        persona_juridica.id_persona_juridica,
                        prestamo.id_prestamo,
                        prestamo.saldo_actual,
                        persona_juridica.numero,
                        persona_juridica.dui,
                        persona_juridica.nit,
                        prestamo.tasa_interes
                        FROM
                        prestamo
                        INNER JOIN usuario ON prestamo.id_asesor = usuario.id_usuario
                        INNER JOIN expediente_juridico ON expediente_juridico.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_juridica ON expediente_juridico.id_persona_juridica = persona_juridica.id_persona_juridica
                        WHERE prestamo.estado = 'NORMAL' and prestamo.saldo_actual < (prestamo.prestamo_original/2)
												AND persona_juridica.id_persona_juridica  = '$codigo'
";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $resultado;
    }

}


?>