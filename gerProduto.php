<?php
require_once "validaUser.php"
    ?>
<!DOCTYPE html>
<html lang="pt-br">  

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/cadastros.css">
  <?php include "_parts/_shortIcon.html" ?>
  <title>Gerenciar Produto</title>
</head>
<?php
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

$catProd = new Categoria;

if (filter_has_var(INPUT_POST, "idProduto")):
  $edtProd = new Produto;
  $idProd = intval(filter_input(INPUT_POST, "idProduto"));
  $produto = $edtProd->search("idProduto", $idProd);
endif;
?>

<body>
  <header>
    <?php include "_parts/_menu.php" ?>
  </header>
  <main class="container mt-3">
    <form action="<?php echo htmlspecialchars('dbProduto.php') ?>" method="post" class="row g3">
      <input type="hidden" name="idProduto" value="<?php echo $produto->idproduto ?? ''; ?>">
      <div class="col-12 mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nomeProduto" id="nomeProduto" class="form-control" placeholder="Digite o Produto"
          value="<?php echo $produto->nomeproduto ?? ''; ?>" required>
      </div>

      <div class="col-12 mb-3">
        <label class="form-label" for="descricaoProduto">Descrição</label>
        <textarea name="descricaoProduto" id="descricaoProduto" class="form-control"
          required><?php echo $produto->descricaoproduto ?? ''; ?></textarea>
      </div>
      <div class="col-md-6 mb-3">
        <label for="categoriaProduto">Categoria</label>
        <select class="form-select" aria-label="Default select example" id="categoriaProduto" name="categoriaProduto"
          required>
          <option selected>Selecione uma Categoria</option>
          <?php
          $categorias = $catProd->all();
          foreach ($categorias as $categoria):
            ?>
            <option value="<?php echo $categoria->idcategoria ?>" <?php
               if (isset($produto)):
                 echo ($produto->categoriaproduto == $categoria->idcategoria) ? 'selected' : '';
               endif;
               ?>><?php echo $categoria->nomecategoria ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-12 mb-3">
        <button type="submit" class="btn btn-primary" name="Gravar">
          <i class="bi bi-floppy"></i> Gravar
        </button>
      </div>
    </form>
  </main>

  <footer>
    <?php include "_parts/_footer.php" ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>