<?php
require_once "validaUser.php";
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

if (filter_has_var(INPUT_GET, "idEmpresa")) {
  $emp = new Empresa();
  $cont = new Contato();
  $idEmp = intval(filter_input(INPUT_GET, "idEmpresa"));
  $empresa = $emp->search("idEmpresa", $idEmp);
  $contatosEmpresa = $cont->allContato($idEmp);
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
  <main class="container">
    <form action="<?php echo htmlspecialchars('dbContato.php') ?>" method="post" class="row g3 mb-3">
      <input type="hidden" name="idEmpresa" value="<?php echo $empresa->idempresa ?? ''; ?>">
      <div class="col-md-4 mb-3">
        <label for="tipoContato" class="form-label">Tipo</label>
        <select class="form-select" id="tipoContato" name="tipoContato" required>
          <option value="">Selecione o tipo...</option>
          <?php
          $tipos = ['Celular', 'E-mail', 'Rede Social', 'Site', 'Telefone', 'WhatsApp'];

          $tipoSelecionado = $cont->tipo ?? '';

          foreach ($tipos as $tipo) { ?>
            <option value="<?= $tipo ?>" <?= ($tipoSelecionado == $tipo) ? 'selected' : '' ?>>
              <?= $tipo ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-4 mb-3">
        <label for="informacaoContato" class="form-label">Informção</label>
        <input type="text" name="informacaoContato" id="informacaoContato" class="form-control" value="1">
      </div>
      <div class="col-md-4 mb-3">
        <label for="informacaoContato" class="form-label">Exibir no Rodapé</label>
        <div class="form-conttrol">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rodape" id="Sim" value="Sim">
            <label class="form-check-label" for="Sim" >Sim</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rodape" id="Nao" value="Não">
            <label class="form-check-label" for="Nao">Não</label>
          </div>
        </div>
      </div>
      <div class="col-12 mb-3">
        <button type="submit" class="btn btn-primary" name="Gravar">
          <i class="bi bi-floppy"></i> Gravar
        </button>
      </div>
    </form>
    <div class="mt-3">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tipo</th>
            <th scope="col">Informção</th>
            <th scope="col">Rodapé</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($contatosEmpresa as $contato):
            ?>
            <tr>
              <td><?php echo $contato->idcontato ?></td>
              <td><?php echo $contato->tipocontato ?></td>
              <td><?php echo $contato->informacaocontato ?></td>
              <td><?php echo $contato->rodapecontato ?></td>
              <td>
                <form action="<?php echo htmlspecialchars("dbContato.php") ?>" method="post" class="d-flex">
                                <input type="hidden" name="idContato" value="<?php echo $contato->idcontato ?>">
                                <button href="#" name="btnExcluir" class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('Tem certeza que deseja excluir o Contato?');">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
              </td>
            </tr>

          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>
  <footer>
    <?php include "_parts/_footer.php" ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="JS/mascaras.js"></script>
  <script>
    aplicarMascaraTelefoneTodos();
  </script>
</body>

</html>