<?php

class repositorio_expediente_juridico {

    public static function insertar_expediente_juridico($conexion, $expediente) {
        $expediente_insertado = false;
        //$expediente = new expediente_juridico();

        if (isset($conexion)) {
            try {
                $id_prestamo = $expediente->getId_prestamo();
                $id_persona = $expediente->getId_persona_juridica();
                
                $sql = "UPDATE persona_juridica SET categoria='1'  "
                         . "WHERE (id_persona_juridica='$id_persona') LIMIT 1";
                 $sentencia = $conexion->prepare($sql);
                 $expediente_insertado = $sentencia->execute();
                
                $sql = 'INSERT INTO expediente_juridico (id_prestamo,id_persona_juridica)'
                        . ' values ( :id_prestamo, :persona_juridica)';
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_STR);
                $sentencia->bindParam(':persona_juridica', $id_persona, PDO::PARAM_STR);

                $expediente_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                echo '<script>swal("No se puedo realizar el registro", "Revise los datos ingresados  ", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $expediente_insertado;
    }
    
    public static function  calculo_ratios ($balance, $estado){
    //$estado = new estado_resultado();
        $ratio = new ratios();
                
        $ratio->setPeriodo($balance->getPeriodo());
        $ratio->setId($estado->getId_persona_juridica());
        
        $ratio->setLiquidez_corriente(  round  ($balance->getTotal_activo_corriente() / $balance->getTotal_pasivo_corriente(),2) );
        $ratio->setRazon_rapida(   round(  ($balance->getTotal_activo_corriente() -$balance->getInventarios()) / $balance->getTotal_pasivo_corriente(),2 ));
        $ratio->setRotacion_inventarios(  round ( $estado->getCosto_venta()/$balance->getInventarios(),2 ));
        $ratio->setPeriodo_cobro(  round( 365 / ($estado->getIngreso_venta()/ $balance->getCuenta_por_cobrar())));
        $ratio->setIndice_endeudamiento(  round (100 *($balance->getTotal_pasivo_corriente()+$balance->getDeuda_largop())/ $balance->getTotal_pasivo_patrimonio(),2 )  ) ;
        $ratio->setCargo_interes_fijo( round($estado->getUtilidad_operativa() / $estado->getGasto_interes(),2) );
        $ratio->setMargen_utilidad_bruta(round(100 * ($estado->getUtilidad_bruta() / $estado->getIngreso_venta()),2) );
        $ratio->setMargen_utilidad_neta(round( 100 * ($estado->getUtilidad_neta() / $estado->getIngreso_venta()),2) );
        $ratio->setRendimiento_activo(round( 100*( $estado->getUtilidad_neta() / $balance->getTotal_activo()),2) );
        $ratio->setRendimiento_patrimonio( round( 100 * ($estado->getUtilidad_neta() / ($balance->getAccioneC() + $balance->getGanancias_retenidas())),2));
     
        return $ratio;
    }

    public static function lista_pagos_previos_jurdico($conexion,$codigo) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        pago.id_pago,
                        pago.monto,
                        pago.fecha,
                        pago.mora,
                        pago.interes,
                        persona_juridica.nombre
                        FROM
                        prestamo    
                        INNER JOIN pago ON pago.id_prestamo = prestamo.id_prestamo
                        INNER JOIN expediente_juridico ON expediente_juridico.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_juridica ON expediente_juridico.id_persona_juridica = persona_juridica.id_persona_juridica
                        WHERE
                        prestamo.id_prestamo = '".$codigo."'";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $resultado;
    }
    
    public static function lista_pagos_previos_natural($conexion,$codigo) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        pago.monto,
                        pago.fecha,
                        pago.mora,
                        pago.interes
                        FROM
                        prestamo
                        INNER JOIN pago ON pago.id_prestamo = prestamo.id_prestamo
                        WHERE prestamo.id_prestamo = '$codigo'";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }

        return $resultado;
    }
    
    public static function lista_prestamo_previos($conexion, $codigo) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "SELECT
                        persona_juridica.nombre,
                        prestamo.prestamo_original,
                        prestamo.estado,
                        prestamo.id_prestamo,
                        usuario.apellido
                        FROM
                        prestamo
                        INNER JOIN expediente_juridico ON expediente_juridico.id_prestamo = prestamo.id_prestamo
                        INNER JOIN persona_juridica ON expediente_juridico.id_persona_juridica = persona_juridica.id_persona_juridica
                        INNER JOIN usuario ON prestamo.id_asesor = usuario.id_usuario
                        WHERE
                        persona_juridica.id_persona_juridica = '".$codigo."' AND
                        prestamo.estado != 'PENDIENTE'";
                
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