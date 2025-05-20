<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$arquivo = basename($_SERVER['SCRIPT_NAME'], '.php');
?>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/ishiybom.png" alt="Logo" width="50" height="40" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item <?php echo ($arquivo == 'index') ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item <?php echo ($arquivo == 'catalogo') ? 'active' : ''; ?>">
                <a class="nav-link" href="catalogo.php">Produtos</a>
            </li>
            <li class="nav-item <?php echo ($arquivo == 'contato') ? 'active' : ''; ?>">
                <a class="nav-link" href="contato.php">Contato</a>
            </li>
            <li class="nav-item <?php echo ($arquivo == 'historia') ? 'active' : ''; ?>">
                <a class="nav-link" href="historia.php">História</a>
            </li>
            <li class="nav-item <?php echo ($arquivo == 'localizacao') ? 'active' : ''; ?>">
                <a class="nav-link" href="localizacao.php">Localização</a>
            </li>

            </li>
        </ul>
    </div>
</nav>
