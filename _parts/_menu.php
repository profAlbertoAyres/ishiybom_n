
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/ishiybom.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
            ISHIYBOM
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listInicial.php">Página Inicial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listCategorias.php">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listParceiros.php">Parceiros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listProdutos.php">Produtos</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <!-- Usuário Logado -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown"> 
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Sair</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- Usuário Não Logado -->
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="bi bi-person-circle"></i> Entrar</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>