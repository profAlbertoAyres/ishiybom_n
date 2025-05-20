<?php
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

if (filter_has_var(INPUT_GET, "idProduto")) {
  $selProd = new Produto;
  $foto = new FotoProduto;
  $idProd = intval(filter_input(INPUT_GET, "idProduto"));
  $produto = $selProd->search("idProduto", $idProd);
  $fotosProduto = $foto->allPhoto($idProd);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/cadastros.css">
  <?php include "_parts/_shortIcon.html" ?>
  <title>Fotos de <?php echo $produto->nomeproduto; ?></title>
</head>

<body>
  <header>
    <?php include "_parts/_menu.php" ?>
  </header>
  <main class="container">
    <form action="<?php echo htmlspecialchars('dbFotoProduto.php') ?>" method="post" class="row g3 mb-3"
      enctype="multipart/form-data">
      <input type="hidden" name="idFotoProduto" value="<?php echo $produto->idfotoprod ?? ''; ?>">
      <input type="hidden" name="fotoApagar" value="<?php echo $produto->nomefoto ?? ''; ?>">
      <input type="hidden" name="idProduto" value="<?php echo $produto->idproduto ?? ''; ?>">
      <div class="col-12 mb-3">
        <label for="nome" class="form-label">Foto</label>
        <input type="file" name="nomeFotoProduto" id="nomeFotoProduto" class="form-control" required accept="image/*">
      </div>

      <div class="col-12 mb-3">
        <button type="submit" class="btn btn-primary" name="Gravar">
          <i class="bi bi-floppy"></i> Gravar
        </button>
      </div>
    </form>
    <div class="linha">
      <?php
      foreach ($fotosProduto as $ft):
        ?>
        <div class="item-linha">
          <img src="images/produtos/<?php echo $ft->nomefoto ?>" alt="ss">
          <div class="botoes-linha">
            <!-- Botão Exluir -->
            <form action="<?php echo htmlspecialchars("dbFotoProduto.php") ?>" method="post" class="d-flex">
              <input type="hidden" name="idFoto" value="<?php echo $ft->idfotoprod ?>">
              <input type="hidden" name="nomeFoto" value="<?php echo $ft->nomefoto ?>">
              <input type="hidden" name="idProdFoto" value="<?php echo $ft->produtofoto ?>">
              <button href="#" name="btnExcluir" class="btn btn-danger btn-sm" type="submit"
                onclick="return confirm('Tem certeza que deseja excluir a Foto?');">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
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