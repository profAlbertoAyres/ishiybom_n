<?php $arquivo = basename(__FILE__); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
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
    $inicial = new Inicial;
    ?>
    <main>
        <div style="background-color:#ccc; height:300px; display: flex; align-items: center; justify-content: center; margin-top:10px;">
            Imagem da empresa
        </div>
        <?php
        $conteudos = $inicial->all();
        foreach ($conteudos as $cont):
            $campo = 'categoriaproduto';
            ?>
            <section class="sec-branco">

                <h2><?php echo $cont->tituloinicial ?></h2>
                <hr class="border border-success border-1 opacity-75">
                <div class="linha">
                    <div class="item">
                        <div class="cetralizar-imagem">
                            <img src="images/inicial/<?php echo $cont->imageminicial ?>" alt="">
                        </div>
                    </div>

                    <div class="item">
                        <p>
                            <?php echo $cont->textoinicial ?>
                        </p>
                    </div>
                </div>

            </section>
        <?php endforeach; ?>
    </main>

    <footer>
        <?php include "_parts/_footer.php" ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</html>