<?php

class repositorio_clasificacion {
    public  static function lista_clasificacion($conexion) {
        $lista  = array();

        if (isset($conexion)) {
            try {
                $sql = "select * from clasificacion";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $clasificacion = new clasificacion();
                        $clasificacion->setId_clasificacion($fila['id_clasificacion']);
                        $clasificacion->setNombre($fila['nombre']);
                        $clasificacion->setCorrelativo($fila['correlativo']);
                        $clasificacion->setTiempo_depreciacion($fila['tiempo_depreciacion']);

                        $lista[] = $clasificacion;
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