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
  <?php include "_parts/_shortIcon.php" ?>
  <title>Gerenciar Conteúdos</title>
</head>
<?php
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

if (filter_has_var(INPUT_POST, var_name: "idInicial")) {
  $edtIni = new Inicial;
  $idIni = intval(filter_input(INPUT_POST, "idInicial"));
  $inicial = $edtIni->search("idInicial", $idIni);
}
?>

<body>
  <header>
    <?php include "_parts/_menu.php" ?>
  </header>
  <main class="container">
  <form action="<?php echo htmlspecialchars('dbInicial.php') ?>" method="post" enctype="multipart/form-data">
    
    <div class="row g-3 mt-3">
      
      <div class="row <?php echo (isset($inicial) && !empty($inicial->imageminicial)) ? 'col-md-9' : 'col-12'; ?>">
        <input type="hidden" name="idInicial" value="<?php echo $inicial->idinicial ?? ''; ?>">

        <div class="mb-3 col-12">
          <label for="nome" class="form-label">Título</label>
          <input type="text" name="tituloInicial" id="tituloInicial" class="form-control"
            placeholder="Digite o Título do conteúdo" value="<?php echo $inicial->tituloinicial ?? ''; ?>" required>
        </div>

        <div class="mb-3 col-12">
          <label class="form-label" for="textoInicial">Descrição</label>
          <textarea name="textoInicial" id="textoInicial" class="form-control"
            required><?php echo $inicial->textoinicial ?? ''; ?></textarea>
        </div>

        <div class="mb-3 col-md-9">
          <label for="imagemInicial" class="form-label">Imagem</label>
          <input type="file" name="imagemInicial" id="imagemInicial" accept="image/*" class="form-control"
            <?php echo (empty($inicial->idinicial)) ? 'required' : ''; ?>>
        </div>

        <div class="col-md-3 mb-3">
        <label for="ordemInicial" class="form-label">Ordem de exibição</label>
        <input type="number" name="ordemInicial" id="ordemInicial" class="form-control"  value="<?php echo $inicial->ordeminicial ?? null; ?>">
      </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-primary" name="Gravar">
            <i class="bi bi-floppy"></i> Gravar
          </button>
        </div>
      </div>

      <?php if (isset($inicial) && !empty($inicial->imageminicial)): ?>
        <div class="col-md-3 d-flex align-items-start">
          <div>
            <label class="form-label">Imagem Atual</label><br>
            <img src="images/inicial/<?php echo $inicial->imageminicial; ?>" alt="Foto Atual" 
                class="img-thumbnail mb-2" style="max-width: 100%;">
            <input type="hidden" name="fotoAntiga" value="<?php echo $inicial->imageminicial; ?>">
          </div>
        </div>
      <?php endif; ?>

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