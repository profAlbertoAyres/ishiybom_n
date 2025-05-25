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
  <title>Gerenciar Parceiros</title>
</head>
<?php
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

if (filter_has_var(INPUT_POST, "idParceiro")) {
  $edtPar = new Parceiro;
  $idPar = intval(filter_input(INPUT_POST, "idParceiro"));
  $parceiro = $edtPar->search("idParceiro", $idPar);
}
?>

<body>
  <header>
    <?php include "_parts/_menu.php" ?>
  </header>
  <main class="container">
    <form action="<?php echo htmlspecialchars('dbParceiro.php') ?>" method="post" class="row g3 mt-5">
      <input type="hidden" name="idParceiro" value="<?php echo $parceiro->idparceiro ?? ''; ?>">
      <div class="col-12 mb-3">
        <label for="nomeParceiro" class="form-label">Nome</label>
        <input type="text" name="nomeParceiro" id="nomeParceiro" class="form-control" placeholder="Digite o Parceiro"
          value="<?php echo $parceiro->nomeparceiro ?? ''; ?>" required>
      </div>

      <div class="col-md-6 mb-3">
        <label for="enderecoParceiro" class="form-label">Endereço</label>
        <input type="text" name="enderecoParceiro" id="enderecoParceiro" class="form-control"
          placeholder="Digite o endereço do Parceiro" value="<?php echo $parceiro->enderecoparceiro ?? ''; ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label for="bairroParceiro" class="form-label">Bairro</label>
        <input type="text" name="bairroParceiro" id="bairroParceiro" class="form-control"
          placeholder="Digite o Bairro do Parceiro" value="<?php echo $parceiro->bairroparceiro ?? ''; ?>">
      </div>
      <div class="col-md-5 mb-3">
        <label for="cidadeParceiro" class="form-label">Cidade</label>
        <input type="text" name="cidadeParceiro" id="cidadeParceiro" class="form-control"
          placeholder="Digite o cidade do Parceiro" value="<?php echo $parceiro->cidadeparceiro ?? ''; ?>">
      </div>

      <div class="col-md-2 mb-3">
        <label for="estadoParceiro" class="form-label">Endereço</label>


        <select name="estadoParceiro" class="form-select" id="estadoParceiro" aria-label="Default select example">
          <option selected>Selecione o estado</option>
          <?php
          $ufs = [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
          ];

          $ufSelecionada = $parceiro->estadoparceiro ?? '';

          foreach ($ufs as $sigla => $nome) {
            $selected = ($ufSelecionada == $sigla) ? 'selected' : '';
            echo "<option value=\"$sigla\" $selected>$nome</option>";
          }
          ?>
        </select>
      </div>

      <div class="col-md-5 mb-3">
        <label for="telefoneParceiro" class="form-label">Telefone</label>
        <input type="text" name="telefoneParceiro" id="telefoneParceiro" class="form-control telefone"
          placeholder="(00)00000-0000" value="<?php echo $parceiro->telefoneparceiro ?? ''; ?>">
      </div>

      <div class="col-12 mb-3">
        <label for="horarioParceiro" class="form-label">Horário de Funcionamento</label>
        <input type="text" name="horarioParceiro" id="horarioParceiro" class="form-control"
          placeholder="Digite o horário de funcionamento do Parceiro" value="<?php echo $parceiro->horarioparceiro ?? ''; ?>">
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
    <?php include "_parts/_footer.php"; ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="JS/mascaras.js"></script>
<script>
    aplicarMascaraTelefoneTodos();
</script>

</body>

</html>