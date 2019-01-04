<?php

class repositorio_usuario {
    
    public static function obtener_administrador_actual($conexion, $codigo) {
        $usuario = new usuario();
        
        if (isset($conexion)) {
            //echo 'hay conexion<br>';
            try {
                $sql = "select * from usuario where (nombre = '$codigo')";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $usuario = new usuario();
                        $usuario->setPass($fila['pass']);
                        $usuario->setId_usuario($fila['id_usuario']);
                        $usuario->setNivel($fila['nivel']);
                    }
                }
            } catch (PDOException $exc) {
                print('ERROR' . $exc->getMessage());
            }
        } else {
            //echo 'no hay conexion<br>';
        }
        return $usuario;
    }
    
    public static function verificar_pass($conexion, $verificacion, $user) {
        $respuesta = false;
        $administrador_actual = self:: obtener_administrador_actual($conexion, $user);

        if (isset($conexion)) {
            try {
             
                if ($verificacion == $administrador_actual->getPass()) {///esto es para saber si las contrase;a para modificar es correcta
                  $respuesta = $administrador_actual->getNivel() ;  
                } else {
                    $respuesta = false;
                    
                }
            } catch (PDOException $ex) {
                //echo "<script>swal('Ooops!', 'Hubo no se pudo realizar la accion', 'error');</script>";
                 echo '<script>swal({
                    title: "Error!",
                    text: "Por Favor intente más tarde",
                    type: "warning",
                    confirmButtonText: "ok",
                    closeOnConfirm: false
                },
                function () {
                    location.href="index.php";
                    
                });</script>';

                print 'ERROR: ' . $ex->getMessage();
            }
        } else {
            echo "no hay conexion";
        }
        return $respuesta;
    }

}
?>