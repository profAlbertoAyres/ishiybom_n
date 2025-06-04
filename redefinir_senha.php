<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/login.css">
    <?php include "_parts/_shortIcon.php" ?>
    <title>Recuperar Senha</title>
</head>

<body>
    <header class="cabecalho">
        <div class="linha-h">
            <div class="item-h">
                <a href="index.php">Home</a>
            </div>
            <div class="item-h">
                <img src="images/ishiybom.png" alt="">
            </div>
            <div class="item-h icon-user"><i class="bi bi-person-fill-x"></i></div>
        </div>
    </header>
    <main class="a-login">
        <div class="form-login">
            <p>Recuperar Senha</p>
            <form action="solicitar_recuperacao.php" method="post" class="mt-4">
                <div class="mb-3">
                    <label for="email" class="form-label">Informe seu e-mail cadastrado</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="seuemail@exemplo.com"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Link</button>
            </form>
        </div>
    </main>
    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
</body>

</html>