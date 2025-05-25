<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$arquivo = basename($_SERVER['SCRIPT_NAME'], '.php');
?>
<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/ishiybom.png" alt="Logo" width="50" height="40" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item <?php echo ($arquivo == 'index') ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item <?php echo ($arquivo == 'catalogo') ? 'active' : ''; ?>">
                <a class="nav-link" href="catalogo.php">Produtos</a>
            </li>
            <li class="nav-item <?php echo ($arquivo == 'catalogo') ? 'active' : ''; ?>">
                <a class="nav-link" href="onde-encontrar.php">Onde Encontrar</a>
            </li>
            
            <li class="nav-item">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <!-- Usuário Logado -->
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </a>
                </li>
            <?php else: ?>
                <!-- Usuário Não Logado -->
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="bi bi-person-circle"></i> Entrar</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
