 <?php
    spl_autoload_register(function ($class) {
        require_once "classes/{$class}.class.php";
    });
    $emp = new Empresa();
    $empresa = $emp->last("idEmpresa");
    $logopequena = $empresa->logopequenoempresa;
    ?>
<link rel="shortcut icon" href="images/empresa/<?php echo $logopequena;?>" type="image/x-icon">