<?php

class repositorio_balance {

    public static function insertar_balance_general($conexion, $balance) {
        $resultado = FALSE;
        if (isset($conexion)) {
            try {
                //$balance = new balance_general();
                $idPersona = $balance->getId_persona();
                $periodo = $balance->getPeriodo();
                $efectivo = $balance->getEfectivo();
                $valorNegociable = $balance->getValor_negociable();
                $cuentaXcobrar = $balance->getCuenta_por_cobrar();
                $inventario = $balance->getInventarios();
                $terresno = $balance->getTerrenos();
                $edificio = $balance->getEdificio_equipo();
                $depreciacion = $balance->getDepreciacion();
                $activo_corriente = $efectivo + $valorNegociable + $cuentaXcobrar + $inventario;
                $activo_no_corriente = $terresno + $edificio - $depreciacion;
                $total_activo = $activo_corriente + $activo_no_corriente;

                $cuentaXpagar = $balance->getCuenta_por_pagar();
                $documentoXpagar = $balance->getDocumento_por_pagar();
                $deuda = $balance->getDeuda_largop();
                $acciones = $balance->getAccioneC();
                $ganaciasR = $balance->getGanancias_retenidas();
                $pasivo_corriente = $cuentaXpagar + $documentoXpagar;
                $pasivo_no_corriente = $deuda + $acciones + $ganaciasR;
                $total_pasivo = $pasivo_corriente + $pasivo_no_corriente;


                $sql = "INSERT INTO balance_general (id_persona_juridica, periodo,  efectivo, valor_negociable, cuentas_por_cobrar, inventarios, terrenos, edificio_equipo, depreciacion_acumulada, total_activo_corriente, total_activo_pasivo, total_activo, cuentas_por_pagar, documentos_por_pagar, total_pasivo_corriente, deuda_largo_plazo, acciones_comunes, ganancias_retenidas, total_pasivo)"
                        . " VALUES (:id_persona_juridica, :periodo,  :efectivo, :valor_negociable, :cuentas_por_cobrar, :inventarios, :terrenos, :edificio_equipo, :depreciacion_acumulada, :total_activo_corriente, :total_activo_pasivo, :total_activo, :cuentas_por_pagar, :documentos_por_pagar, :total_pasivo_corriente, :deuda_largo_plazo, :acciones_comunes, :ganancias_retenidas, :total_pasivo)";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_persona_juridica', $idPersona, PDO::PARAM_STR);
                $sentencia->bindParam(':periodo', $periodo, PDO::PARAM_STR);
                $sentencia->bindParam(':efectivo', $efectivo, PDO::PARAM_STR);
                $sentencia->bindParam(':valor_negociable', $valorNegociable, PDO::PARAM_STR);
                $sentencia->bindParam(':cuentas_por_cobrar', $cuentaXcobrar, PDO::PARAM_STR);
                $sentencia->bindParam(':inventarios', $inventario, PDO::PARAM_STR);
                $sentencia->bindParam(':terrenos', $terresno, PDO::PARAM_STR);
                $sentencia->bindParam(':edificio_equipo', $edificio, PDO::PARAM_STR);
                $sentencia->bindParam(':depreciacion_acumulada', $depreciacion, PDO::PARAM_STR);
                $sentencia->bindParam(':total_activo_corriente', $activo_corriente, PDO::PARAM_STR);
                $sentencia->bindParam(':total_activo_pasivo', $activo_no_corriente, PDO::PARAM_STR);
                $sentencia->bindParam(':total_activo', $total_activo, PDO::PARAM_STR);
                $sentencia->bindParam(':cuentas_por_pagar', $cuentaXpagar, PDO::PARAM_STR);
                $sentencia->bindParam(':documentos_por_pagar', $documentoXpagar, PDO::PARAM_STR);
                $sentencia->bindParam(':total_pasivo_corriente', $pasivo_corriente, PDO::PARAM_STR);
                $sentencia->bindParam(':deuda_largo_plazo', $deuda, PDO::PARAM_STR);
                $sentencia->bindParam(':acciones_comunes', $acciones, PDO::PARAM_STR);
                $sentencia->bindParam(':ganancias_retenidas', $ganaciasR, PDO::PARAM_STR);
                $sentencia->bindParam(':total_pasivo', $total_pasivo, PDO::PARAM_STR);


                $resultado = $sentencia->execute();
                
            } catch (PDOException $ex) {
                echo 'balance no guardado';
                print 'ERROR: ' . $ex->getMessage();
            }
        } else {
            echo 'no hay conexion';
        }

        return $resultado;
    }

    public static function lista_balance($conexion, $codigo) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "select * from balance_general where (id_persona_juridica = '$codigo' ) ORDER by periodo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $balance = new balance_general();

                        $balance->setEfectivo($fila['efectivo']);
                        $balance->setValor_negociable($fila['valor_negociable']);
                        $balance->setCuenta_por_cobrar($fila['cuentas_por_cobrar']);
                        $balance->setInventarios($fila['inventarios']);
                        $balance->setTotal_activo_corriente($fila['total_activo_corriente']);
                        $balance->setTerrenos($fila['terrenos']);
                        $balance->setEdificio_equipo($fila['edificio_equipo']);
                        $balance->setDepreciacion($fila['depreciacion_acumulada']);
                        $balance->setTotal_activo_noCorriente($fila['total_activo_pasivo']);
                        $balance->setTotal_activo($fila['total_activo']);
                        $balance->setCuenta_por_pagar($fila['cuentas_por_pagar']);
                        $balance->setDocumento_por_pagar($fila['total_pasivo_corriente']);
                        $balance->setTotal_pasivo_corriente($fila['total_pasivo_corriente']);
                        $balance->setDeuda_largop($fila['deuda_largo_plazo']);
                        $balance->setAccioneC($fila['acciones_comunes']);
                        $balance->setGanancias_retenidas($fila['ganancias_retenidas']);
                        $balance->setTotal_pasivo_patrimonio($fila['total_pasivo']);
                        $balance->setPeriodo($fila['periodo']);

                        $lista[] = $balance;
                    }
                }
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $lista;
    }
    
    public static function lista_balance_filtrada($conexion, $codigo, $periodo) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "select * from balance_general where (id_persona_juridica = '$codigo' and  periodo = '$periodo' )";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $balance = new balance_general();

                        $balance->setEfectivo($fila['efectivo']);
                        $balance->setValor_negociable($fila['valor_negociable']);
                        $balance->setCuenta_por_cobrar($fila['cuentas_por_cobrar']);
                        $balance->setInventarios($fila['inventarios']);
                        $balance->setTotal_activo_corriente($fila['total_activo_corriente']);
                        $balance->setTerrenos($fila['terrenos']);
                        $balance->setEdificio_equipo($fila['edificio_equipo']);
                        $balance->setDepreciacion($fila['depreciacion_acumulada']);
                        $balance->setTotal_activo_noCorriente($fila['total_activo_pasivo']);
                        $balance->setTotal_activo($fila['total_activo']);
                        $balance->setCuenta_por_pagar($fila['cuentas_por_pagar']);
                        $balance->setDocumento_por_pagar($fila['total_pasivo_corriente']);
                        $balance->setTotal_pasivo_corriente($fila['total_pasivo_corriente']);
                        $balance->setDeuda_largop($fila['deuda_largo_plazo']);
                        $balance->setAccioneC($fila['acciones_comunes']);
                        $balance->setGanancias_retenidas($fila['ganancias_retenidas']);
                        $balance->setTotal_pasivo_patrimonio($fila['total_pasivo']);
                        $balance->setPeriodo($fila['periodo']);

                        $lista[] = $balance;
                    }
                }
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $lista;
    }

}
