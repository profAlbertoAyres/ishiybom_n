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
    <title>Lista de parceiros</title>
</head>

<body>
    <header>
        <?php include "_parts/_menu.php"; ?>
    </header>
    <main class="container mt-3 mb-3">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Açoes</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    spl_autoload_register(function ($class) {
                        require_once "classes/{$class}.class.php";
                    });
                    $parc = new Parceiro();
                    $parceiros = $parc->all();
                    foreach ($parceiros as $parceiro):
                        ?>
                        <tr>
                            <th scope="row"><?php echo $parceiro->idparceiro ?></th>
                            <td><?php echo $parceiro->nomeparceiro ?></td>
                            <td class="form-lista">
                                <!-- Botão Editar -->
                                <form action="<?php echo htmlspecialchars("gerParceiro.php") ?>" method="post"
                                    class="d-flex">
                                    <input type="hidden" name="idParceiro" value="<?php echo $parceiro->idparceiro ?>">
                                    <button href="#" name="btnEditar" class="btn btn-info btn-sm" type="submit"
                                        onclick="return confirm('Tem certeza que deseja editar o Parceiro?');">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </form>
                                <!-- Botão Exluir -->
                                <form action="<?php echo htmlspecialchars("dbParceiro.php") ?>" method="post"
                                    class="d-flex">
                                    <input type="hidden" name="idParceiro" value="<?php echo $parceiro->idparceiro ?>">
                                    <button href="#" name="btnExcluir" class="btn btn-danger btn-sm" type="submit"
                                        onclick="return confirm('Tem certeza que deseja excluir o Parceiro?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
        <div class="mb-3">
            <a href="gerParceiro.php" class="btn btn-success"><i class="bi bi-plus-square"></i> Novo Parceiro</a>
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