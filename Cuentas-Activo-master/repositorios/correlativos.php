<?php

class correlativos {

    public static function obtener_correlativo($conexion, $tabla) {
        $total_usuario = NULL;
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*)as total FROM $tabla ";
                ///estos son alias para que PDO pueda trabajar 
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                // echo 'esta buscanso<br>';
                $total_usuario = $resultado['total'] + 1;
                $longitud = strlen($total_usuario);
                for ($i = $longitud; $i < 4; $i++) {
                    $total_usuario = '0' . $total_usuario;
                }
            } catch (PDOException $ex) {
                echo '<script>swal({
                    title: "Error!",
                    text: "por favor revise los datos e intente nuevamente",
                    type: "error",
                    confirmButtonText: "ok",
                    closeOnConfirm: false
                },
                function () {
                    location.href="inicio_usuario.php";
                    
                });</script>';
                //echo '<script>swal("No se puedo realizar el registro", "Favor revisar los datos e intentar nuevamente", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
            }
        }

        return $total_usuario;
    }

    public static function lista_tipo($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "select * from tipo_activo ";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $tipo = new tipo_activo;
                        $tipo->setId_tipo($fila['id_tipo']);
                        $tipo->setId_nombre($fila['nombre']);
                        $tipo->setId_correlativo($fila['correlativo']);
                        $tipo->setId_clasificacion($fila['id_clasificacion']);
                        $lista[] = $tipo;
                    }
                }
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }
        return $lista;
    }
    
    public static function lista_departamento($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "select * from departamento ";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $departamento = new departamento();
                        $departamento->setId_departamento($fila['id_departamento']);
                        $departamento->setNombre($fila['nombre']);
                        $departamento->setCorrelativo($fila['correlativo']);
                        
                        $lista[] = $departamento;
                    }
                }
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }
        return $lista;
    }
    
    public static function lista_institucion($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "select * from institucion ";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                       
                        $institucion = new departamento();
                        $institucion->setId_departamento($fila['id_institucion']);
                        $institucion->setNombre($fila['nombre']);
                        $institucion->setCorrelativo($fila['correlativo']);
                        
                        $lista[] = $institucion;
                    }
                }
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }
        return $lista;
    }
    
    public static function lista_encargado($conexion) {
        $lista = array();

        if (isset($conexion)) {
            try {
                $sql = "select * from encargado ";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                       
                        $encargado = new encargado();
                        $encargado->setId_encargado($fila['id_encargado']);
                        $encargado->setNombre($fila['nombre']);
                        $encargado->setApellido($fila['apellido']);
                        $encargado->setDui($fila['dui']);
                        
                        
                        $lista[] = $encargado;
                    }
                }
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        }
        return $lista;
    }
    
    public static function insertar_activo($conexion, $activo) {

        $usuario_insertado = false;
         $activo = new $activo;
        if (isset($conexion)) {

            try {
                $sql = "INSERT INTO usuarios(codigo_usuario,codigo_institucion,nombre,apellido,telefono,correo,direccion,estado,sexo,observaciones,foto)
                    values (:codigo_usuario,:codigo_institucion,:nombre,:apellido,:telefono,:correo,:direccion,:estado,:sexo,:observaciones,'$foto') ";

                $sentencia = $conexion->prepare($sql);
                $usuario_insertado = $sentencia->execute();
                
            } catch (PDOException $ex) {
                //echo '<script>swal("No se puedo realizar el registro", "Favor '.$ex->getMessage().' revisar los  datos e intentar nuevamente", "warning");</script>';
                
                print 'ERROR: ' . $ex->getMessage();
            }
        } else {
            echo 'no hay conexion';
        }
    }

}
