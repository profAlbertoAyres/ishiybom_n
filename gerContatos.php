<?php
require_once "validaUser.php";
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

if (filter_has_var(INPUT_POST, "btnEditar")) {

  $cont = new Contato();
  $idContato = intval(filter_input(INPUT_POST, "idContato"));
  $contato = $cont->search("idcontato", $idContato);
  $idEmp = $contato->idempresa ?? '';
}elseif(filter_has_var(INPUT_POST, "btnNovoContato")){
  $idEmp = intval(filter_input(INPUT_POST,'idEmpresa'));
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/cadastros.css">
  <?php include "_parts/_shortIcon.php" ?>
  <title>Contatos</title>
</head>

<body>
  <header>
    <?php include "_parts/_menu.php" ?>
  </header>
  <main class="container mb-3">
    <form action="<?php echo htmlspecialchars('dbContato.php') ?>" method="post" class="row g3 mt-3">
      <input type="hidden" name="idEmpresa" value="<?php echo  $idEmp; ?>">
      <input type="hidden" name="idContato" value="<?php echo $contato->idcontato ?? ''; ?>">
      <div class="col-md-6 mb-3">
        <label for="tipoContato" class="form-label">Tipo</label>
        <select class="form-select" id="tipoContato" name="tipoContato" required>
          <option value="">Selecione o tipo...</option>
          <?php
          $tipos = ['Celular', 'E-mail', 'Rede Social', 'Site', 'Telefone', 'WhatsApp'];

          $tipoSelecionado = $contato->tipocontato ?? '';

          foreach ($tipos as $tipo) { ?>
            <option value="<?= $tipo ?>" <?= ($tipoSelecionado == $tipo) ? 'selected' : '' ?>>
              <?= $tipo ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label for="informacaoContato" class="form-label">Informção</label>
        <input type="text" name="informacaoContato" id="informacaoContato" class="form-control" value="<?php echo $contato->informacaocontato ?? ''; ?>">
      </div>

      <div class="col-md-6 mb-3">
        <label for="tipoContato" class="form-label">Exibir no rodapé</label>
        <select class="form-select" id="rodapeRontato" name="rodapeRontato" required>
          <option value="">Selecione se deseja exibir...</option>
          <?php
          $exibir_radope = ['Sim', 'Não'];

          $radapeSelecionado = $contato->rodapecontato ?? '';

          foreach ($exibir_radope as $option) { ?>
            <option value="<?= $option ?>" <?= ($radapeSelecionado == $option) ? 'selected' : '' ?>>
              <?= $option ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <?php  ?>
      <div class="col-md-6 mb-3">
        <label for="odermRodapeRontato" class="form-label">Ordem no Rodapé</label>
        <input type="number" name="odermRodapeRontato" id="odermRodapeRontato" class="form-control"  value="<?php echo $contato->odermrodapecontato ?? ''; ?>">
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  
</body>

</html>