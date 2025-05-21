
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/cadastros.css">
  <?php include "_parts/_shortIcon.html" ?>
  <title>Gerenciar Conteúdos</title>
</head>
<?php
  spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
  });

  if (filter_has_var(INPUT_POST,"idInicial")) {
    $edtIni = new Inicial;
    $idIni = intval(filter_input(INPUT_POST, "idInicial"));
    $inicial = $edtIni->search("idInicial",$idIni);
  }
  ?>
<body>
  <header>
    <?php include"_parts/_menu.php" ?>
  </header>
  <main class="container">
    <form action="<?php echo htmlspecialchars('dbInicial.php') ?>" method="post" class="row g3 mt-3" enctype="multipart/form-data">
      <input type="hidden" name="idInicial" value="<?php echo $inicial->idinicial ?? ''; ?>">
      <div class="col-12 mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="tituloInicial" id="tituloInicial" class="form-control" placeholder="Digite o Conteúdo" value="<?php echo $inicial->tituloInicial ?? ''; ?>" required>
      </div>

      <div class="col-12 mb-3">
        <label class="form-label" for="textoInicial">Descrição</label>
        <textarea name="textoInicial" id="textoInicial" class="form-control" required><?php echo $inicial->textoinicial ?? ''; ?></textarea>
      </div>

      <div class="col-12 mb-3">
        <label for="imagemInicial" class="form-label">Imagem</label>
        <input type="file" name="imagemInicial" id="imagemInicial" required accept="image/*" class="form-control">
      </div>
      <div class="col-12 mb-3">
        <button type="submit" class="btn btn-primary" name="Gravar">
        <i class="bi bi-floppy"></i> Gravar
        </button>
      </div>
    </form>
  </main>
  </main>
  <footer>
    <?php include "_parts/_footer.php" ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>