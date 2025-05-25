<?php
    spl_autoload_register(function ($class) {
        require_once("classes/{$class}.class.php");
    });
if (filter_has_var(INPUT_POST, "Gravar")):
    $parceiro = new Parceiro;
    $parceiro->setNomeParceiro(filter_input(INPUT_POST, 'nomeParceiro'));
    $parceiro->setEnderecoParceiro(filter_input(INPUT_POST, 'enderecoParceiro'));
    $parceiro->setHorarioParceiro(filter_input(INPUT_POST, 'horarioParceiro'));
    $parceiro->setTelefoneParceiro(filter_input(INPUT_POST, 'telefoneParceiro'));
    $parceiro->setBairroParceiro(filter_input(INPUT_POST, 'bairroParceiro'));
    $parceiro->setCidadeParceiro(filter_input(INPUT_POST, 'cidadeParceiro'));
    $parceiro->setEstadoParceiro(filter_input(INPUT_POST, 'estadoParceiro'));
    $idParc = filter_input(INPUT_POST, 'idParceiro');
    if (empty($idParc)):
        if ($parceiro->add()):
            echo "<script>window.alert('Adicionado com sucesso.'); window.location.href='listParceiros.php';</script>";

        else:
            echo "<script>window.alert('Erro ao adicionar.'); window.open(document.referrer,'_self');</script>";
        endif;
    else:
        if ($parceiro->update("idParceiro", $idParc, )):
            echo "<script>window.alert('Atualizado com sucesso.'); window.location.href='listParceiros.php';</script>";

        else:
            echo "<script>window.alert('Erro ao atualizar.'); window.open(document.referrer,'_self');</script>";
        endif;
    endif;
elseif (filter_has_var(INPUT_POST, "btnExcluir")):
    $delParc = new Parceiro;
    $idParc = intval(filter_input(INPUT_POST, "idParceiro"));
    if($parceiro = $delParc->delete("idParceiro", $idParc)):
        header("location:listParceiros.php");
    else:
        echo "<script>window.alert('Erro ao deletar.'); window.open(document.referrer,'_self');</script>";
    endif;


endif;