<?php
spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});
$empresa = new Empresa();
if (filter_has_var(INPUT_POST, "Gravar")):
    $diretorio = 'images/empresa/';
    // Logo Pequena
    $fotoAntigaPequena = filter_input(INPUT_POST, 'fotoAntigaPequena');
    $empresa->setLogoPequenoEmpresa($fotoAntigaPequena);
    if (!is_dir($diretorio)) {
        die("O diretório '$diretorio' não existe.");
    }

    if (isset($_FILES['logoPequenoEmpresa']) && $_FILES['logoPequenoEmpresa']['error'] === UPLOAD_ERR_OK) {
        $arquivo = $_FILES['logoPequenoEmpresa'];

        $extensao = strtolower(pathinfo(basename($arquivo['name']), PATHINFO_EXTENSION));
        $nomeArquivo = uniqid() . '.' . $extensao;
        $caminhoArquivo = $diretorio . $nomeArquivo;
        if(file_exists($fotoAntigaPequena) && is_dir($diretorio)) {
            unlink($diretorio . $fotoAntigaPequena); // Apaga a foto antiga
        }

        if (!move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {
            die("Erro ao mover o arquivo.");
        }
        $empresa->setLogoPequenoEmpresa($nomeArquivo);
    }

    // Logo Grande
    $fotoAntigaGrande = filter_input(INPUT_POST, 'fotoAntigaGrande');
    $empresa->setLogoGrandeEmpresa($fotoAntigaGrande);
    if (!is_dir($diretorio)) {
        die("O diretório '$diretorio' não existe.");
    }

    if (isset($_FILES['logoGrandeEmpresa']) && $_FILES['logoGrandeEmpresa']['error'] === UPLOAD_ERR_OK) {
        $arquivo = $_FILES['logoGrandeEmpresa'];

        $extensao = strtolower(pathinfo(basename($arquivo['name']), PATHINFO_EXTENSION));
        $nomeArquivo = uniqid() . '.' . $extensao;
        $caminhoArquivo = $diretorio . $nomeArquivo;

        if (file_exists($fotoAntigaGrande) && is_dir($diretorio)) {
            unlink($diretorio . $fotoAntigaGrande); // Apaga a foto antiga
        }

        if (!move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {
            die("Erro ao mover o arquivo.");
        }
        $empresa->setLogoGrandeEmpresa( $nomeArquivo);
    }
    $empresa->setRazaoSocialEmpresa(filter_input(INPUT_POST, 'razaoSocialEmpresa'));
    $empresa->setNomeFantasiaEmpresa(filter_input(INPUT_POST, 'nomeFantasiaEmpresa'));
    $empresa->setEnderecoEmpresa(filter_input(INPUT_POST, 'enderecoEmpresa'));
    $empresa->setBairroEmpresa(filter_input(INPUT_POST, 'bairroEmpresa'));
    $empresa->setCidadeEmpresa(filter_input(INPUT_POST, 'cidadeEmpresa'));
    $empresa->setEstadoEmpresa(filter_input(INPUT_POST, 'estadoEmpresa'));
    $empresa->setHistoriaEmpresa(filter_input(INPUT_POST, 'historiaEmpresa'));
    $empresa->setMissaoEmpresa(filter_input(INPUT_POST, 'missaoEmpresa'));
    $empresa->setVisaoEmpresa(filter_input(INPUT_POST, 'visaoEmpresa'));
    $empresa->setValoresEmpresa(filter_input(INPUT_POST, 'valoresEmpresa'));
    $empresa->setlocalizacaoEmpresa(htmlspecialchars(filter_input(INPUT_POST, 'localizacaoEmpresa')));
    $empresa->setHorarioEmpresa(filter_input(INPUT_POST, 'horarioEmpresa'));
    $idEmp = filter_input(INPUT_POST, 'idEmpresa');
    if (empty($idEmp)):
        if ($empresa->add()):
            echo "<script>window.alert('Adicionado com sucesso.'); window.location.href='listEmpresa.php';</script>";

        else:
            echo "<script>window.alert('Erro ao adicionar.'); window.open(document.referrer,'_self');</script>";
        endif;
    else:
        if ($empresa->update("idEmpresa", $idEmp, )):
            echo "<script>window.alert('Atualizado com sucesso.'); window.location.href='listEmpresa.php';</script>";

        else:
            echo "<script>window.alert('Erro ao atualizar.'); window.open(document.referrer,'_self');</script>";
        endif;
    endif;
elseif (filter_has_var(INPUT_POST, "btnExcluir")):
    $idEmp = intval(filter_input(INPUT_POST, "idEmpresa"));
    if ($empresa->delete("idEmpresa", $idEmp)):
        header("location:listParceiros.php");
    else:
        echo "<script>window.alert('Erro ao deletar.'); window.open(document.referrer,'_self');</script>";
    endif;
endif;

function apagarFoto($foto, $diretorio)
{
    if (file_exists($diretorio . $foto))
        unlink($diretorio . $foto); // Apaga a foto
}