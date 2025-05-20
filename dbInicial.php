<?php
    spl_autoload_register(function ($class) {
        require_once("classes/{$class}.class.php");
    });
    $inicial = new Inicial;
    $diretorio = 'images/inicial/';
if (filter_has_var(INPUT_POST, "Gravar")):

    $nomeArquivo = filter_input(INPUT_POST, 'fotoApagar');
    $fotoApagr = $nomeArquivo;
    // Verifica se o diretório existe
    if (!is_dir($diretorio)) {
        die("O diretório '$diretorio' não existe.");
    }
    // Verifica se o arquivo foi enviado
    if (isset($_FILES['imagemInicial'])) {
        $arquivo = $_FILES['imagemInicial'];

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
    }
    $inicial->settItuloInicial(filter_input(INPUT_POST, 'tituloInicial'));
    $inicial->setTextoInicial(filter_input(INPUT_POST, 'textoInicial'));
    $inicial->setImagemInicial($nomeArquivo);
    $idIni = filter_input(INPUT_POST, 'idinicial');
    if (empty($idIni)):
        if ($inicial->add()):
            echo "<script>window.alert('Adicionado com sucesso.'); window.location.href='listInicial.php';</script>";

        else:
            echo "<script>window.alert('Erro ao adicionar.'); window.open(document.referrer,'_self');</script>";
        endif;
    else:

        if ($inicial->update("idinicial", $idIni, )):
            if (isset($_FILES['imagemInicial'] )&& $_FILES['imagemInicial']['error'] === UPLOAD_ERR_OK) {
                apagarFoto($fotoApagr,$diretorio);
            }
            echo "<script>window.alert('Atualizado com sucesso.'); window.location.href='listInicial.php';</script>";

        else:
            echo "<script>window.alert('Erro ao atualizar.'); window.open(document.referrer,'_self');</script>";
        endif;
    endif;
elseif (filter_has_var(INPUT_POST, "btnExcluir")):
    $idIni = intval(filter_input(INPUT_POST, "idInicial"));
    $foto = filter_input(INPUT_POST, 'imagemApagar');
    if($material = $delMat->delete("idInicial", $idIni)):
        header("location:listInicial.php");
    else:
        echo "<script>window.alert('Erro ao deletar.'); window.open(document.referrer,'_self');</script>";
    endif;


endif;


function apagarFoto($foto, $diretorio){
    if (file_exists($diretorio . $foto)):
        unlink($diretorio . $foto); // Apaga a foto
    endif;
}