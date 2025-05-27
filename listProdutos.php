<?php
require_once "validaUser.php"
    ?>
    
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/listas.css">
    <?php include "_parts/_shortIcon.php" ?>
    <title>Listsa de Produtos</title>
</head>

<body>
    <header>
        <?php include "_parts/_menu.php"; ?>    
    </header>
    <main class="container mt-3 mb-3">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Açoes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                spl_autoload_register(function ($class) {
                    require_once "classes/{$class}.class.php";
                });
                $prod = new Produto();
                $produtos = $prod->all();
                foreach ($produtos as $produto):
                    ?>
                    <tr>
                        <th scope="row"><?php echo $produto->idproduto ?></th>
                        <td><?php echo $produto->nomeproduto ?></td>
                        <td class="form-lista">
                            <!-- Botão Editar -->
                            <form action="<?php echo htmlspecialchars("gerProduto.php") ?>" method="post" class="d-flex">
                                <input type="hidden" name="idProduto" value="<?php echo $produto->idproduto ?>">
                                <button href="#" name="btnEditar" class="btn btn-info btn-sm" type="submit"
                                    onclick="return confirm('Tem certeza que deseja Editar o Produto?');">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </form>
                            <!-- Botão Exluir -->
                            <form action="<?php echo htmlspecialchars("dbProduto.php") ?>" method="post" class="d-flex">
                                <input type="hidden" name="idProduto" value="<?php echo $produto->idproduto ?>">
                                <button href="#" name="btnExcluir" class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('Tem certeza que deseja excluir o Produto?');">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            <a href="gerFotoProduto.php?idProduto=<?php echo $produto->idproduto; ?>" class="btn btn-secondary"><i class="bi bi-camera"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>
            <div class="mb-3">
                <a href="gerProduto.php" class="btn btn-success"><i class="bi bi-plus-square"></i> Novo Produto</a>
            </div>
    </main>
    <footer>
        <?php include "_parts/_footer.php" ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>