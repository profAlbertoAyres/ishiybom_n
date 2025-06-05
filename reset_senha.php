<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    spl_autoload_register(function ($class) {
        require_once "classes/{$class}.class.php";
    });

    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    $nova_senha = filter_input(INPUT_POST, 'nova_senha', FILTER_SANITIZE_STRING);
    $confirmar_senha = filter_input(INPUT_POST, 'confirmar_senha', FILTER_SANITIZE_STRING);

    if ($nova_senha !== $confirmar_senha) {
        $mensagem = "<script>window.alert('As senhas não conferem!');</script>";
        
    } else {
        $usuario = new Usuario;
        $usuario->redefinirSenha($token, $nova_senha);
        $mensagem = "<script>window.alert('Senha alterada com sucesso.'); window.location.href='login.php';</script>";
    }

    echo $mensagem;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <?php include "_parts/_shortIcon.php" ?>
    <title>Redefinir Senha</title>
</head>

<body>
    <header class="cabecalho">
        <div class="linha-h">
            <div class="item-h">
                <a href="index.php">Home</a>
            </div>
            <div class="item-h">
                <img src="images/empresa/<?php echo $logopequena;?>" alt="">
            </div>
            <div class="item-h icon-user"><i class="bi bi-person-fill-x"></i></div>
        </div>
    </header>

    <main class="a-login">
        <div class="form-login">
            <p>Redefinir Senha</p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">

                <div class="mb-3 col-12">
                    <label for="nova_senha" class="form-label">Nova Senha</label>
                    <input type="password" class="form-control" id="nova_senha" placeholder="Nova Senha" name="nova_senha" required>
                </div>

                <div class="mb-3 col-12">
                    <label for="confirmar_senha" class="form-label">Confirmar Nova Senha</label>
                    <input type="password" class="form-control" id="confirmar_senha" placeholder="Confirmar Senha" name="confirmar_senha" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn">Redefinir Senha</button>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
</body>

</html>
