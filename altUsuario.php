<?php
$nivelPermitidos = [1];
require_once 'validaUser.php';



// Verifica se o formulário foi enviado
$mensagem = '';
if (filter_has_var(INPUT_POST, "btnEditar")):
    $edtUser = new Usuario();
    $idUser = intval(filter_input(INPUT_POST, "idUsuario"));
    $userEdt = $edtUser->search("id", $idUser);
elseif (filter_has_var(INPUT_POST, "salvar")):
    spl_autoload_register(function ($class) {
        require_once "classes/{$class}.class.php";
    });
    $usuario = new Usuario;

    // Define os valores nos atributos da classe
    $usuario->setNome(filter_input(INPUT_POST, 'nome'));
    $usuario->setEmail(filter_input(INPUT_POST, 'email'));
    $usuario->setNivel_acesso(filter_input(INPUT_POST, 'nivel_acesso'));
    $idUser = filter_input(INPUT_POST, 'idUser');

    if ($usuario->update('id', $idUser)):
        $mensagem = '<div class="alert alert-success">Usuário alterado com sucesso!</div>';
    else:
        $mensagem = '<div class="alert alert-danger">Erro ao alterar o usuário. Tente novamente.</div>';
    endif;
endif;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cadastros.css">
    <?php include "_parts/_shortIcon.php" ?>
</head>

<body>
    <header>
        <?php include "_parts/_menu.php" ?>
    </header>
    <main class="container mt-5">
        <h2 class="mb-4">Cadastro de Usuário</h2>

        <!-- Exibição de mensagens -->
        <?php if (!empty($mensagem))
            echo $mensagem; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="row">
            <input type="hidden" name="idUser" value="<?php echo $userEdt->id ?? ''; ?>">
            <div class="mb-3 col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Username" required
                    value="<?php echo $userEdt->nomeusuario ?? ''; ?>">
            </div>
            <div class="mb-3 col-md-6">
                <label for="nivel_acesso" class="form-label">Nível de Acesso</label>
                <select class="form-select" id="nivel_acesso" name="nivel_acesso" required>

                    <option value="" selected disabled>Selecione um nível de acesso</option>
                    <?php
                    $tipos = [1 => 'Administrador', 2 => 'Gerente', 3 => 'Vendedor', 4 => 'Cliente'];
                    $tipoSelecionado = $userEdt->nivel_acessousuario ?? '';
                    foreach ($tipos as $codigo => $descricao) {
                        ?>

                        <option value="<?= $codigo ?>" <?= ($tipoSelecionado == $codigo) ? 'selected' : '' ?>><?= $descricao ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3 col-12">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required
                    value="<?php echo $userEdt->emailusuario ?? ''; ?>">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="salvar">Cadastrar</button>
            </div>
        </form>
    </main>
    <footer>
        <?php include "_parts/_footer.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>