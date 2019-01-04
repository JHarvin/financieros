<?php
include_once '../plantilla/cabecera.php';
include_once '../plantilla/barraSuperior.php';

include_once '../plantilla/barra_lateral_usuario.php';

?>    
<section>
    <?php echo $_SESSION['user']; ?>
</section>


<?php
include_once '../plantilla/pie.php';
?>