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
    $categoria = new Categoria;
    $produto = new Produto;
    $fotoProduto = new FotoProduto;
    ?>
    <main>
        <?php
        $categorias = $categoria->all();
        foreach ($categorias as $cat):
            $campo = 'categoriaproduto';
            $id = intval($cat->idcategoria);
            $produtos = $produto->produtoFiltro($campo, $id);
            if (count($produtos) > 0):
                ?>
                <section class="sec-branco">

                    <h2><?php echo $cat->nomecategoria ?></h2>
                    <hr class="border border-success border-1 opacity-75">
                    <div class="linha">
                        <?php
                        foreach ($produtos as $prod):
                            ?>
                            <div class="card item">
                                <?php
                                $idProd = intval($prod->idproduto);
                                $fotos = $fotoProduto->allPhoto($idProd);
                                if (count($fotos) > 0):
                                    ?>
                                    <div id="carouselProduto<?php echo $prod->idproduto; ?>" class="carousel slide"
                                        data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php

                                            $isFirst = true;
                                            foreach ($fotos as $foto):
                                                ?>
                                                <div class="carousel-item <?php echo ($isFirst ? 'active' : ''); ?>"
                                                    data-bs-interval="10000">
                                                    <img class="img-produto-cat" src="images/produtos/<?php echo $foto->nomefoto; ?>"
                                                        class="d-block w-100" alt="...">
                                                </div>
                                                <?php
                                                $isFirst = false;
                                            endforeach; ?>
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselProduto<?php echo $prod->idproduto; ?>" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselProduto<?php echo $prod->idproduto; ?>" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <img class="img-produto-cat" src="images/produtos/semProduto.png" alt="Produto sem foto">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $prod->nomeproduto ?></h5>
                                    <p class="card-text"><?php echo $prod->descricaoproduto; ?>

                                    </p>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal<?php echo $prod->idproduto; ?>">
                                        Saiba mais...
                                    </button>

                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modal<?php echo $prod->idproduto; ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal<?php echo $prod->idproduto; ?>Label"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modal<?php echo $prod->idproduto; ?>Label">
                                                <?php echo $prod->nomeproduto; ?>
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <p><b>Material </b> <?php echo $prod->nomematerial;?></p>
                                            <p><b>Descrição: </b></p>
                                            <p><?php echo $prod->descricaoproduto; ?></p>

                                            <ul class="list-group">
                                                <?php
                                                echo empty($prod->alturaproduto) ? null : "<li class='list-group-item'>Altura: $prod->alturaproduto cm.</li>";echo empty($prod->larguraproduto) ? null : "<li class='list-group-item'>Largura: $prod->larguraproduto cm.</li>";echo empty($prod->comprimentoproduto) ? null : "<li class='list-group-item'>Comprimento: $prod->comprimentoproduto cm.</li>";
                                                echo empty($prod->pesoproduto) ? null : "<li class='list-group-item'>Peso: $prod->pesoproduto cm.</li>";
                                                ?>
                                            </ul>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </section>
                <?php
            endif;
        endforeach;
        ?>
    </main>
    <footer>
    <?php include "_parts/_footer.php" ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</html>