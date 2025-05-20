<?php
spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});
$fotoProduto = new FotoProduto;
// Diretório onde o arquivo será salvo
$diretorio = 'images/produtos/';
if (filter_has_var(INPUT_POST, "Gravar")):

    $idProduto = filter_input(INPUT_POST, 'idProduto');


    // Verifica se o diretório existe
    if (!is_dir($diretorio)) {
        die("O diretório '$diretorio' não existe.");
    }

    // Verifica se o arquivo foi enviado
    if (isset($_FILES['nomeFotoProduto'])) {
        $arquivo = $_FILES['nomeFotoProduto'];

        // Verifica se houve erro no upload
        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            die("Erro ao fazer upload da imagem. Código do erro: " . $arquivo['error']);
        }
        //Pegar a extensão do arquivo
        $extensao = strtolower(pathinfo(basename($arquivo['name']), PATHINFO_EXTENSION));
        // Gera um nome único para a imagem
        $nomeArquivo = uniqid() . '.' . $extensao;
        $caminhoArquivo = $diretorio . $nomeArquivo;

        // Move o arquivo para o diretório especificado
        if (!move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {
            die("Erro ao mover o arquivo.");
        }
    } else {
        die("Nenhum arquivo foi enviado.");
    }
    $fotoProduto->setNomeFoto($nomeArquivo);
    $fotoProduto->setProdutoFoto(filter_input(INPUT_POST, 'idProduto'));
    if (empty($idFoto)):
        if ($fotoProduto->add()):
            echo "<script>window.alert('Adicionado com sucesso.'); window.location.href='gerFotoProduto.php?idProduto=$idProduto';</script>";

        else:
            echo "<script>window.alert('Erro ao adicionar.'); window.open(document.referrer,'_self');</script>";
        endif;
    endif;
elseif (filter_has_var(INPUT_POST, "btnExcluir")):
    $idProduto = intval(filter_input(INPUT_POST, 'idProdFoto'));
    $foto = filter_input(INPUT_POST, 'nomeFoto');
    if (file_exists($diretorio . $foto)):
        unlink($diretorio . $foto); // Apaga a foto
    endif;
    $idFoto = intval(filter_input(INPUT_POST, "idFoto"));
    if ($fotoProduto = $fotoProduto->delete("idFotoProd", $idFoto)):
        header("location:gerFotoProduto.php?idProduto=$idProduto");
    else:
        echo "<script>window.alert('Erro ao deletar.'); window.open(document.referrer,'_self');</script>";
    endif;
endif;