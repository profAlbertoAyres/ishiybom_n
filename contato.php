<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/contato.css">
    <?php include "_parts/_shortIcon.php" ?>
    <title>Localização | Agroindustrial</title>
    <style>


    </style>
</head>

<body>
    <header>
        <?php include '_parts/_cabecalho_site.php' ?>
    </header>
    <?php
    spl_autoload_register(function ($class) {
        require_once "classes/{$class}.class.php";
    });
    $emp = new Empresa();
    $contato = new Contato();
    $empresa = $emp->last("idEmpresa");
    $idEmpresa = $empresa->idempresa;
    ?>
    <main class="container">
        <section class="sec-branco">
            <h2>Nosso Endereço</h2>
            <p><strong>Local:</strong> <?php echo $empresa->enderecoempresa; ?>, <?php echo $empresa->bairroempresa ?>,
                <?php echo $empresa->cidadeempresa ?> - <?php echo $empresa->estadoempresa ?>
            </p>
            <div class="linha">
                <div class="item">
                    <?php

                    $celulares = $contato->allContato($idEmpresa, 'Celular');
                    $registros = count($celulares);
                    switch ($registros) {
                        case 0:
                            $valor = '';
                            break;
                        case 1:
                            $valor = '<p><strong>Celular: </strong> ';
                            foreach ($celulares as $cel):
                                $valor .= $cel->informacaocontato;
                            endforeach;
                            $valor .= '</p>';
                            break;
                        default:
                            $valor = '<p><strong>Celulares:</strong> ';
                            $last = end($celulares);
                            foreach ($celulares as $cel):
                                $valor .= $cel->informacaocontato;
                                if ($cel !== $last) {
                                    $valor .= ' - ';
                                }
                            endforeach;
                            $valor .= '</p>';
                            break;

                    }
                    echo $valor;

                    $Telefones = $contato->allContato($idEmpresa, 'Telefone');
                    $registros = count($Telefones);
                    switch ($registros) {
                        case 0:
                            $valor = '';
                            break;
                        case 1:
                            $valor = '<p><strong>Telefone:</strong> ';
                            foreach ($Telefones as $tel):
                                $valor .= $tel->informacaocontato;
                            endforeach;
                            $valor .= '</p>';
                            break;
                        default:
                            $valor = '<p><strong>Telefones:</strong> ';
                            $last = end($Telefones);
                            foreach ($Telefones as $tel):
                                $valor .= $tel->informacaocontato;
                                if ($tel !== $last) {
                                    $valor .= ' - ';
                                }
                            endforeach;
                            $valor .= '</p>';
                            break;

                    }
                    echo $valor;

                    $emails = $contato->allContato($idEmpresa, 'E-mail');
                    $registros = count($emails);
                    switch ($registros) {
                        case 0:
                            $valor = '';
                            break;
                        case 1:
                            $valor = '<p><strong>E-mail:</strong> ';
                            foreach ($emails as $email):
                                $valor .= "<a href='mailto:$email->informacaocontato'>$email->informacaocontato</a>";
                            endforeach;
                            $valor .= '</p>';
                            break;
                        default:
                            $valor = '<p><strong>E-mails:</strong> ';
                            $last = end($emails);
                            foreach ($emails as $email):
                                $valor .= "<a href='mailto:$email->informacaocontato'>$email->informacaocontato</a>";
                                if ($email !== $last) {
                                    $valor .= ' - ';
                                }
                            endforeach;
                            $valor .= '</p>';
                            break;

                    }
                    echo $valor;


                    $WhatsApp = $contato->allContato($idEmpresa, 'WhatsApp');
                    $registros = count($WhatsApp);
                    switch ($registros) {
                        case 0:
                            $valor = '';
                            break;
                        case 1:
                            $valor = '<p><strong>WhatsApp:</strong> ';
                            foreach ($WhatsApp as $Whats):
                                $soNumeros = preg_replace('/\D/', '', $Whats->informacaocontato);
                                $valor .= "<a href='https://wa.me/55$soNumeros' target='_blank'>$Whats->informacaocontato</a>";
                            endforeach;
                            $valor .= '</p>';
                            break;
                        default:
                            $valor = '<p><strong>WhatsApps: </strong> ';
                            $last = end($WhatsApp);
                            foreach ($WhatsApp as $Whats):
                                $soNumeros = preg_replace('/\D/', '', $Whats->informacaocontato);
                                $valor .= "<a href='https://wa.me/55$soNumeros' target='_blank'>$Whats->informacaocontato</a>";
                                if ($Whats !== $last) {
                                    $valor .= ' - ';
                                }
                            endforeach;
                            $valor .= '</p>';
                            break;

                    }
                    echo $valor;


                    $rede = $contato->allContato($idEmpresa, 'Rede Social');
                    $registros = count($rede);
                    switch ($registros) {
                        case 0:
                            $valor = '';
                            break;
                        default:
                            $valor = '<p><strong>Siga-nos: </strong> ';
                            $last = end($rede);
                            foreach ($rede as $rd):
                                $valor .= "<a href='$rd->informacaocontato' target='_blank'>";
                                if (strpos($rd->informacaocontato, 'facebook.com') !== false) {
                                    $valor .= 'Facebook';
                                } elseif (strpos($rd->informacaocontato, 'instagram.com') !== false) {
                                    $valor .= 'Instagram';
                                }
                                $valor .= "</a>";
                                if ($rd !== $last) {
                                    $valor .= ' | ';
                                }
                            endforeach;
                            $valor .= '</p>';
                            break;

                    }
                    echo $valor;

                    ?>
                    <p><strong>Horário:</strong> <?php echo $empresa->horarioempresa ?></p>

                </div>
                <div class="item">
                    <div class="img-centro">
                        <img src="images/ishiybom.png" alt="">
                    </div>
                </div>

            </div>
        </section>




        <?php
        if (!empty($empresa->localizacaoempresa)):
            ?>
            <section class="sec-branco">
                <h2>Como chegar</h2>
                <?php
                echo $empresa->localizacaoempresa;
                ?>


            </section>
        <?php endif;

        ?>

    </main>
    <footer>
        <?php include "_parts/_footer.php" ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>