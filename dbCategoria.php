<?php
    spl_autoload_register(function ($class) {
        require_once("classes/{$class}.class.php");
    });
if (filter_has_var(INPUT_POST, "Gravar")):
    $categoria = new Categoria;
    $categoria->setNomeCategoria(filter_input(INPUT_POST, 'nomeCategoria'));
    $idCat = filter_input(INPUT_POST, 'idCategoria');
    if (empty($idCat)):
        if ($categoria->add()):
            echo "<script>window.alert('Adicionado com sucesso.'); window.location.href='listCategorias.php';</script>";

        else:
            echo "<script>window.alert('Erro ao adicionar.'); window.open(document.referrer,'_self');</script>";
        endif;
    else:
        if ($categoria->update("idCategoria", $idCat, )):
            echo "<script>window.alert('Atualizado com sucesso.'); window.location.href='listCategorias.php';</script>";

        else:
            echo "<script>window.alert('Erro ao atualizar.'); window.open(document.referrer,'_self');</script>";
        endif;
    endif;
elseif (filter_has_var(INPUT_POST, "btnExcluir")):
    $delCat = new Categoria;
    $idCat = intval(filter_input(INPUT_POST, "idCategoria"));
    if($categoria = $delCat->delete("idCategoria", $idCat)):
        header("location:listCategorias.php");
    else:
        echo "<script>window.alert('Erro ao deletar.'); window.open(document.referrer,'_self');</script>";
    endif;


endif;