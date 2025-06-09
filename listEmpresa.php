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
    <title>Empresa</title>
</head>

<body>
    <header>
        <?php include "_parts/_menu.php"; ?>
    </header>
 <main class="container mt-3 mb-3">

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Razão Social</th>
                    <th scope="col">Nome Fantasia</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                spl_autoload_register(function ($class) {
                    require_once "classes/{$class}.class.php";
                });
                $emp = new Empresa();
                $empresas = $emp->all();
                foreach ($empresas as $empresa):
                    ?>
                    <tr>
                        <th scope="row"><?php echo $empresa->idempresa ?></th>
                        <td><?php echo $empresa->razaosocialempresa ?></td>
                        <td><?php echo $empresa->nomefantasiaempresa ?></td>
                        <td class="form-lista text-center">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <form action="gerEmpresa.php" method="post" class="d-inline">
                                    <input type="hidden" name="idEmpresa" value="<?php echo $empresa->idempresa ?>">
                                    <button name="btnEditar" class="btn btn-info btn-sm" type="submit"
                                        onclick="return confirm('Tem certeza que deseja editar a Empresa?');">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </form>

                                <form action="dbEmpresa.php" method="post" class="d-inline">
                                    <input type="hidden" name="idEmpresa" value="<?php echo $empresa->idempresa ?>">
                                    <button name="btnExcluir" class="btn btn-danger btn-sm" type="submit"
                                        onclick="return confirm('Tem certeza que deseja excluir a Empresa?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                                <a href="listContatos.php?idEmpresa=<?php echo $empresa->idempresa ?>" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-journal-medical"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <?php if (count($empresas) == 0): ?>
        <div class="mb-3">
            <a href="gerEmpresa.php" class="btn btn-success"><i class="bi bi-plus-square"></i> Nova Empresa</a>
        </div>
    <?php endif; ?>

</main>

    <footer>
        <?php include "_parts/_footer.php" ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>