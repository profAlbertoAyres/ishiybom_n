<?php
spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});
$emp = new Empresa();
$empresa = $emp->last("idEmpresa");
$idEmp = $empresa->idempresa;
$cont = new Contato();
$contatos = $cont->exibirRodape($idEmp);

?>
<div class="container-xl f-linha">
    <?php
    foreach ($contatos as $con):
        $icone = "";
        $texto = "";
        $link = "";
        $op_target = "";
        switch ($con->tipocontato) {
            case 'Celular':
                $icone = '<i class="bi bi-telephone-outbound"></i>';
                $link = 'tel:+55' . $con->informacaocontato;
                $texto = $con->informacaocontato;
                break;
            case 'E-mail':
                $icone = '<i class="bi bi-envelope-at"></i>';
                $link = 'mailto:' . $con->informacaocontato;
                $texto = $con->informacaocontato;
                break;
            case 'Site':
                $icone = '<i class="bi bi-link-45deg"></i>';
                $link = $con->informacaocontato;
                $texto = $con->informacaocontato;
                $op_target = 'target="_blank"';
                break;
            case 'Telefone':
                $icone = '<i class="bi bi-telephone-outbound"></i>';
                $link = 'tel:+55' . $con->informacaocontato;
                $op_target = 'target="_blank"';
                $texto = $con->informacaocontato;
                break;
            case 'WhatsApp':
                $soNumeros = preg_replace('/\D/', '', $con->informacaocontato);
                $icone = '<i class="bi bi-whatsapp"></i>';
                $link = 'https://wa.me/55'.$soNumeros;
                $texto = 'Nosso WhatsApp!';
                $op_target = 'target="_blank"';
                break;
            case 'Rede Social':
                if (strpos($con->informacaocontato, 'facebook.com') !== false) {
                    $icone .= '<i class="bi bi-facebook"></i>';
                    $op_target = 'target="_blank"';
                    $link = $con->informacaocontato;
                    $texto = 'Ishiybom';
                } elseif (strpos($con->informacaocontato, 'instagram.com') !== false) {
                    $icone .= '<i class="bi bi-instagram"></i>';
                    $op_target = 'target="_blank"';
                    $link = $con->informacaocontato;
                    $texto = 'Ishiybom';
                } elseif (strpos($con->informacaocontato, 'linkedin.com') !== false) {
                    $icone .= '<i class="bi bi-linkedin"></i>';
                    $op_target = 'target="_blank"';
                    $link = $con->informacaocontato;
                    $texto = 'Ishiybom';
                }
                break;

            default:
                # code...
                break;
        }



        ?>

        <div class="f-linha-item">
            <a href="<?php echo $link ?>" <?php echo $op_target ?>>
                <div class="icon">
                    <?php echo $icone ?>
                </div>
                <div class="icon-texto">
                    <?php echo $texto ?>
                </div>
            </a>
        </div>
        <?php

    endforeach;
    ?>
</div>