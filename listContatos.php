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
    <title>Lista de Categorias</title>
</head>

<body>
    <header>
        <?php include "_parts/_menu.php"; ?>
    </header>
    <?php
    if (filter_has_var(INPUT_GET, "idEmpresa")) {
        $cont = new Contato();
        $emp = new Empresa();
        $idEmp = intval(filter_input(INPUT_GET, "idEmpresa"));
        $empresa = $emp->search("idEmpresa", $idEmp);
        $contatosEmpresa = $cont->allContato($idEmp);
    }
    ?>
    <main class="container mt-3 mb-3">
        <!-- TABELA - aparece só em DESKTOP (md pra cima) -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-hover table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Informação</th>
                        <th scope="col" class="text-center">Ordem rodapé</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($contatosEmpresa as $contato): ?>
                        <tr>
                            <td class="text-center"><?php echo $contato->idcontato ?></td>
                            <td><?php echo $contato->tipocontato ?></td>
                            <td>
                                <?php if ($contato->tipocontato == 'Telefone'): ?>
                                    <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $contato->informacaocontato) ?>">
                                        <?php echo $contato->informacaocontato ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo $contato->informacaocontato ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $contato->odermrodapecontato != 0 ? $contato->odermrodapecontato : null ?>
                            </td>
                            <td class="d-flex justify-content-center align-items-center gap-2">
                                <form action="<?php echo htmlspecialchars("gerContatos.php") ?>" method="post"
                                    class="d-flex g-1">
                                    <input type="hidden" name="idContato" value="<?php echo $contato->idcontato ?>">
                                    <button name="btnEditar" class="btn btn-primary btn-sm" type="submit"
                                        onclick="return confirm('Tem certeza que deseja editar o Contato?');">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </form>
                                <form action="<?php echo htmlspecialchars("dbContato.php") ?>" method="post"
                                    class="d-inline">
                                    <input type="hidden" name="idContato" value="<?php echo $contato->idcontato ?>">
                                    <input type="hidden" name="idEmpresa" value="<?php echo $contato->idempresa ?>">
                                    <button name="btnExcluir" class="btn btn-danger btn-sm" type="submit"
                                        onclick="return confirm('Tem certeza que deseja excluir o Contato?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- CARDS - aparecem em celular + tablet -->
        <div class="d-block d-md-none">
            <?php foreach ($contatosEmpresa as $contato): ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">#<?php echo $contato->idcontato ?> - <?php echo $contato->tipocontato ?></h5>
                        <p class="card-text">
                            <?php if ($contato->tipocontato == 'Telefone'): ?>
                                <strong>Telefone:</strong>
                                <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $contato->informacaocontato) ?>">
                                    <?php echo $contato->informacaocontato ?>
                                </a>
                            <?php else: ?>
                                <strong>Informação:</strong> <?php echo $contato->informacaocontato ?>
                            <?php endif; ?>
                        </p>
                        <?php if ($contato->odermrodapecontato != 0): ?>
                            <p class="card-text"><small class="text-muted">Ordem rodapé:
                                    <?php echo $contato->odermrodapecontato ?></small></p>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between">
                            <form action="<?php echo htmlspecialchars("gerContatos.php") ?>" method="post" class="d-inline">
                                <input type="hidden" name="idContato" value="<?php echo $contato->idcontato ?>">
                                <button name="btnEditar" class="btn btn-primary btn-sm" type="submit"
                                    onclick="return confirm('Tem certeza que deseja editar o Contato?');">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </button>
                            </form>
                            <form action="<?php echo htmlspecialchars("dbContato.php") ?>" method="post" class="d-inline">
                                <input type="hidden" name="idContato" value="<?php echo $contato->idcontato ?>">
                                <input type="hidden" name="idEmpresa" value="<?php echo $contato->idempresa ?>">
                                <button name="btnExcluir" class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('Tem certeza que deseja excluir o Contato?');">
                                    <i class="bi bi-trash"></i> Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mb-3">
            <form action="<?php echo htmlspecialchars("gerContatos.php") ?>" method="post" class="d-flex">
                <input type="hidden" name="idEmpresa" value="<?php echo $contato->idempresa ?>">
                <button name="btnNovoContato" class="btn btn-success" type="submit">
                    <i class="bi bi-plus-square"> </i> Novo Contato
                </button>
            </form>
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