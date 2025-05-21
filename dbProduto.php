<?php
    spl_autoload_register(function ($class) {
        require_once("classes/{$class}.class.php");
    });
    $produto = new Produto;
if (filter_has_var(INPUT_POST, "Gravar")):
    $produto->setNomeProduto(filter_input(INPUT_POST, 'nomeProduto'));
    $produto->setDescricaoProduto(filter_input(INPUT_POST, 'descricaoProduto'));
    $produto->setCategoriaProduto(filter_input(INPUT_POST, 'categoriaProduto'));
    $idProd = filter_input(INPUT_POST, 'idProduto');
    if (empty($idProd)):
        if ($produto->add()):
            echo "<script>window.alert('Adicionado com sucesso.'); window.location.href='listProdutos.php';</script>";

        else:
            echo "<script>window.alert('Erro ao adicionar.'); window.open(document.referrer,'_self');</script>";
        endif;
    else:
        if ($produto->update("idProduto", $idProd, )):
            echo "<script>window.alert('Atualizado com sucesso.'); window.location.href='listProdutos.php';</script>";

        else:
            echo "<script>window.alert('Erro ao atualizar.'); window.open(document.referrer,'_self');</script>";
        endif;
    endif;
elseif (filter_has_var(INPUT_POST, "btnExcluir")):
    $idProd = intval(filter_input(INPUT_POST, "idProduto"));
    if($produto = $produto->delete("idproduto", $idProd)):
        header("location:listProdutos.php");
    else:
        echo "<script>window.alert('Erro ao deletar.'); window.open(document.referrer,'_self');</script>";
    endif;

endif;