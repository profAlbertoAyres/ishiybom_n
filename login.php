<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <?php include "_parts/_shortIcon.php" ?>
    <title>Login</title>
</head>
<?php
if (filter_has_var(INPUT_POST, "logar")) {
    spl_autoload_register(function ($class) {
        require_once "classes/{$class}.class.php";
    });
    $usuario = new Usuario;
    $usuario->setNome(filter_input(INPUT_POST, 'nome'));
    $usuario->setSenha(filter_input(INPUT_POST, 'senha'));
    $mensagem = $usuario->login();
    echo "<script>alert('$mensagem');</script>";
}
?>

<body>
    <header class="cabecalho">
        <div class="linha-h">
            <div class="item-h">
                <a href="">Sobre nós</a>
            </div>
            <div class="item-h">
                <img src="images/ishiybom.png" alt="">
            </div>
            <div class="item-h icon-user"><i class="bi bi-person-fill-x"></i></div>
        </div>
    </header>
    <main class="a-login">
        <div class="form-login">
            <p>Login</p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row">
                <input type="hidden" name="redirect"
                    value="<?php echo isset($_GET['redirect']) ? htmlspecialchars($_GET['redirect']) : 'dashboard.php'; ?>">
                <div class="mb-3 col-12">
                    <label for="nome" class="form-label">Usuário</label>
                    <input type="nome" class="form-control" id="nome" placeholder="Usuário" name="nome">
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn " name="logar">Entrar</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
</body>

</html>