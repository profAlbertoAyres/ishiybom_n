<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/catalogo.css">
    <?php include "_parts/_shortIcon.html" ?>
    <title>ISHIYBOM</title>
</head>

<body>
    <header>
        <?php include '_parts/_cabecalho_site.php' ?>
    </header>
    <?php
    spl_autoload_register(function ($class) {
        require_once "classes/{$class}.class.php";
    });
    $parceiro = new Parceiro;
    $parceiros = $parceiro->all();

    ?>
    <main>
        <section class="sec-branco">
            <div class="linha">
                <?php


                foreach ($parceiros as $parc):
                    ?>
                    
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $parc->nomeparceiro ?></h5>
                            <hr>
                            <p><?php echo $parc->enderecoparceiro; ?> - <?php echo $parc->bairroparceiro; ?> - <?php echo $parc->cidadeparceiro; ?> - <?php echo $parc->estadoparceiro; ?></p>
                            <p>Telefone: <?php echo $parc->telefoneparceiro; ?> </p>
                            <p>Horário: <?php echo $parc->horarioparceiro; ?> </p>


                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <footer>
        <?php include "_parts/_footer.php" ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</html>