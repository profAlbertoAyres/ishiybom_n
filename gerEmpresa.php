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
  <title>Gerenciar Empresa</title>
</head>
<?php
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

if (filter_has_var(INPUT_POST, "idEmpresa")) {
  $edtEmp = new Empresa;
  $idEmp = intval(filter_input(INPUT_POST, "idEmpresa"));
  $empresa = $edtEmp->search("idEmpresa", $idEmp);
}
?>

<body>
  <header>
    <?php include "_parts/_menu.php" ?>
  </header>
  <main class="container">
    <form action="<?php echo htmlspecialchars('dbEmpresa.php') ?>" method="post" class="row g3 mt-5" enctype="multipart/form-data">
      <input type="hidden" name="idEmpresa" value="<?php echo $empresa->idempresa ?? ''; ?>">
      <div class="col-md-6 mb-3">
        <label for="razaoSocialEmpresa" class="form-label">Razão Social</label>
        <input type="text" name="razaoSocialEmpresa" id="razaoSocialEmpresa" class="form-control"
          placeholder="Digite o Empresa" value="<?php echo $empresa->razaosoacialempresa ?? ''; ?>" required>
      </div>

      <div class="col-md-6 mb-3">
        <label for="nomeFantasiaEmpresa" class="form-label">Nome Fantasia</label>
        <input type="text" name="nomeFantasiaEmpresa" id="nomeFantasiaEmpresa" class="form-control"
          placeholder="Digite o Empresa" value="<?php echo $empresa->nomefantasiaempresa ?? ''; ?>" required>
      </div>

      <div class="col-md-6 mb-3">
        <label for="enderecoEmpresa" class="form-label">Endereço</label>
        <input type="text" name="enderecoEmpresa" id="enderecoEmpresa" class="form-control"
          placeholder="Digite o endereço da Empresa" value="<?php echo $empresa->enderecoempresa ?? ''; ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label for="bairroEmpresa" class="form-label">Bairro</label>
        <input type="text" name="bairroEmpresa" id="bairroEmpresa" class="form-control"
          placeholder="Digite o Bairro da Empresa" value="<?php echo $empresa->bairroempresa ?? ''; ?>">
      </div>
      <div class="col-md-8 mb-3">
        <label for="cidadeEmpresa" class="form-label">Cidade</label>
        <input type="text" name="cidadeEmpresa" id="cidadeEmpresa" class="form-control"
          placeholder="Digite o cidade da Empresa" value="<?php echo $empresa->cidadeempresa ?? ''; ?>">
      </div>

      <div class="col-md-4 mb-3">
        <label for="estadoEmpresa" class="form-label">Endereço</label>
        <select name="estadoEmpresa" class="form-select" id="estadoEmpresa" aria-label="Default select example">
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

          $ufSelecionada = $empresa->estadoempresa ?? '';

          foreach ($ufs as $sigla => $nome) {
            $selected = ($ufSelecionada == $sigla) ? 'selected' : '';
            echo "<option value=\"$sigla\" $selected>$nome</option>";
          }
          ?>
        </select>
      </div>

      <div class="col-12 mb-3">
        <label for="historiaEmpresa" class="form-label">História</label>
        <textarea type="text" name="historiaEmpresa" id="historiaEmpresa" class="form-control"
          placeholder="Digite a história da empresa"
          rows="3"><?php echo $empresa->historiaempresa ?? null; ?></textarea>
      </div>

      <div class="col-12 mb-3">
        <label for="missaoEmpresa" class="form-label">Missão</label>
        <textarea type="text" name="missaoEmpresa" id="missaoEmpresa" class="form-control" rows="3"
          placeholder="Digite a missão da empresa"><?php echo $empresa->missaoempresa ?? ''; ?></textarea>
      </div>

      <div class="col-12 mb-3">
        <label for="visaoEmpresa" class="form-label">Visão</label>
        <textarea type="text" name="visaoEmpresa" id="visaoEmpresa" class="form-control" rows="3"
          placeholder="Digite a vosão da empresa"><?php echo $empresa->visaoempresa ?? ''; ?></textarea>
      </div>

      <div class="col-12 mb-3">
        <label for="valoresEmpresa" class="form-label">Valores</label>
        <textarea type="text" name="valoresEmpresa" id="valoresEmpresa" class="form-control" rows="3"
          placeholder="Digite os valores da empresa"><?php echo $empresa->valoresempresa ?? ''; ?></textarea>
      </div>

      <div class="col-12 mb-3">
        <label for="localizacaoEmpresa" class="form-label">Localização</label>
        <input type="text" name="localizacaoEmpresa" id="localizacaoEmpresa" class="form-control"
          placeholder="Cole a Localização do Google Maps" value="<?php echo $empresa->localizacaoempresa ?? ''; ?>">
      </div>

      <div class="col-12 mb-3">
        <label for="horarioEmpresa" class="form-label">Horário de Funcionamento</label>
        <input type="text" name="horarioEmpresa" id="horarioEmpresa" class="form-control"
          placeholder="Digite o horário de funcionamento da empresa"
          value="<?php echo $empresa->horarioempresa ?? ''; ?>">
      </div>

      <!-- Logos -->
      <div class="col-12 m-b3">
        <div>
          
          <label for="logoPequenoEmpresa" class="form-label">Logo grande</label>
          <input type="file" name="logoPequenoEmpresa" id="logoPequenoEmpresa" accept="image/*" class="form-control"
          <?php echo (empty($empresa->logpequenooempresa)) ? 'required' : ''; ?>>
          <?php if (isset($empresa) && !empty($empresa->logopequenoempresa)): ?>
            <input type="hidden" name="fotoAntigaPequena" value="<?php echo $empresa->logopequenoempresa; ?>">
            <?php endif; ?>
          </div>
        </div>

        <div class="col-12 mb-3">
          <label for="logoGrandeEmpresa" class="form-label">Logo grande</label>
          <input type="file" name="logoGrandeEmpresa" id="logoGrandeEmpresa" accept="image/*" class="form-control"
          <?php echo (empty($empresa->logograndeempresa)) ? 'required' : ''; ?>>
          <?php if (isset($empresa) && !empty($empresa->logograndeempresa)): ?>
            <input type="hidden" name="fotoAntigaGrande" value="<?php echo $empresa->logograndeempresa; ?>">
            <?php endif; ?>

        </div>

      <div class="col-12 mb-3">
        <button type="submit" class="btn btn-primary" name="Gravar">
          <i class="bi bi-floppy"></i> Gravar
        </button>
      </div>
    </form>
  </main>
  <footer>
    <?php include "_parts/_footer.php"; ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>