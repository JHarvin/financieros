<?php

class repositorio_estado_resultado {

    public static function insertar_estado_resultado($conexion, $estado) {
        $resultado = FALSE;
        if (isset($conexion)) {
            try {
               // $estado = new estado_resultado();
                $idPersona = $estado->getId_persona_juridica();
                $periodo = $estado->getPeriodo();
                $ingresoXventa = $estado->getIngreso_venta();
                $costoVenta = $estado->getCosto_venta();
                $utlidad_bruta = $ingresoXventa - $costoVenta;
                $gasto_venta = $estado->getGasto_venta();
                $gasto_admi = $estado->getGasto_administrativo();
                $gasto_arrendamiento = $estado->getGasto_arrendamiento();
                $gasto_depreciacion = $estado->getGasto_depreciacion();
                $total_gasto = $gasto_venta + $gasto_admi + $gasto_arrendamiento + $gasto_depreciacion;

                $utilidad_operativa = $utlidad_bruta - $total_gasto;

                if ($utilidad_operativa <= 0) {
                    $gasto_intereses = '0';
                    $utilidad_antes_impuestos = '0';
                    $imputestos = '0';
                    $utilidad_neta = '0';
                } else {

                    $gasto_intereses = $estado->getGasto_interes();
                    $utilidad_antes_impuestos = $utilidad_operativa - $gasto_intereses;
                    $imputestos = $utilidad_antes_impuestos * 0.3;
                    $utilidad_neta = $utilidad_antes_impuestos - $imputestos;
                }
                $sql = "INSERT INTO estado_resultado (id_persona_juridica, periodo, ingreso_ventas, costo_venta, utilidad_bruta,  gasto_venta, gasto_administrativo, gasto_arrendamiento, gasto_depreciacion, total_gasto_operativo, utlidad_operativa, gasto_interes, utilidad_antes_impuestos, impuestos, utilidad_neta)"
                        . " VALUES (:id_persona_juridica, :periodo, :ingreso_ventas, :costo_venta, :utilidad_bruta, :gasto_venta, :gasto_administrativo, :gasto_arrendamiento, :gasto_depreciacion, :total_gasto_operativo, :utlidad_operativa, :gasto_interes, :utilidad_antes_impuestos, :impuestos, :utilidad_neta)";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_persona_juridica', $idPersona, PDO::PARAM_STR);
                $sentencia->bindParam(':periodo', $periodo, PDO::PARAM_STR);
                $sentencia->bindParam(':ingreso_ventas', $ingresoXventa, PDO::PARAM_STR);
                $sentencia->bindParam(':costo_venta', $costoVenta, PDO::PARAM_STR);
                $sentencia->bindParam(':utilidad_bruta', $utlidad_bruta, PDO::PARAM_STR);
                $sentencia->bindParam(':gasto_venta', $gasto_venta, PDO::PARAM_STR);
                $sentencia->bindParam(':gasto_administrativo', $gasto_admi, PDO::PARAM_STR);
                $sentencia->bindParam(':gasto_arrendamiento', $gasto_arrendamiento, PDO::PARAM_STR);
                $sentencia->bindParam(':gasto_depreciacion', $gasto_depreciacion, PDO::PARAM_STR);
                $sentencia->bindParam(':total_gasto_operativo', $total_gasto, PDO::PARAM_STR);
                $sentencia->bindParam(':utlidad_operativa', $utilidad_operativa, PDO::PARAM_STR);
                $sentencia->bindParam(':gasto_interes', $gasto_intereses, PDO::PARAM_STR);
                $sentencia->bindParam(':utilidad_antes_impuestos', $utilidad_antes_impuestos, PDO::PARAM_STR);
                $sentencia->bindParam(':impuestos', $imputestos, PDO::PARAM_STR);
                $sentencia->bindParam(':utilidad_neta', $utilidad_neta, PDO::PARAM_STR);

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
    
    public static function lista_estado($conexion, $codigo) {
$lista = array();        

        if (isset($conexion)) {
            try {
                $sql = "select * from estado_resultado where (id_persona_juridica = '$codigo' ) ORDER by periodo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $estado = new estado_resultado();
                        
                        $estado->setId_persona_juridica($fila['id_persona_juridica']);
                        
                        $estado->setIngreso_venta($fila['ingreso_ventas']);
                        $estado->setCosto_venta($fila['costo_venta']);
                        $estado->setUtilidad_bruta($fila['utilidad_bruta']);
                        $estado->setGasto_venta($fila['gasto_venta']);
                        $estado->setGasto_administrativo($fila['gasto_administrativo']);
                        $estado->setGasto_arrendamiento($fila['gasto_arrendamiento']);
                        $estado->setGasto_depreciacion($fila['gasto_depreciacion']);
                        $estado->setTotal_operativo($fila['total_gasto_operativo']);
                        $estado->setUtilidad_operativa($fila['utlidad_operativa']);
                        $estado->setGasto_interes($fila['gasto_interes']);
                        $estado->setUtilidad_antes_impuestos($fila['utilidad_antes_impuestos']);
                        $estado->setImpuestos($fila['impuestos']);
                        $estado->setUtilidad_neta($fila['utilidad_neta']);
                        
                        $lista[] = $estado;
                    }
                }
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $lista;
    }
    
    public static function lista_estado_filtrada($conexion, $codigo, $estado) {
$lista = array();        

        if (isset($conexion)) {
            try {
                $sql = "select * from estado_resultado where (id_persona_juridica = '$codigo' and periodo = '$estado' )";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $estado = new estado_resultado();
                        
                        $estado->setId_persona_juridica($fila['id_persona_juridica']);
                        
                        $estado->setIngreso_venta($fila['ingreso_ventas']);
                        $estado->setCosto_venta($fila['costo_venta']);
                        $estado->setUtilidad_bruta($fila['utilidad_bruta']);
                        $estado->setGasto_venta($fila['gasto_venta']);
                        $estado->setGasto_administrativo($fila['gasto_administrativo']);
                        $estado->setGasto_arrendamiento($fila['gasto_arrendamiento']);
                        $estado->setGasto_depreciacion($fila['gasto_depreciacion']);
                        $estado->setTotal_operativo($fila['total_gasto_operativo']);
                        $estado->setUtilidad_operativa($fila['utlidad_operativa']);
                        $estado->setGasto_interes($fila['gasto_interes']);
                        $estado->setUtilidad_antes_impuestos($fila['utilidad_antes_impuestos']);
                        $estado->setImpuestos($fila['impuestos']);
                        $estado->setUtilidad_neta($fila['utilidad_neta']);
                        
                        //echo 'en repositorio es '. $estado->
                        
                        $lista[] = $estado;
                    }
                }
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $lista;
    }

}

?>