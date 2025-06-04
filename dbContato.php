<?php
    spl_autoload_register(function ($class) {
        require_once("classes/{$class}.class.php");
    });
    $contato = new Contato();
if (filter_has_var(INPUT_POST, "Gravar")):
    $contato->setTipoContato(filter_input(INPUT_POST, 'tipoContato'));
    $contato->setInformacaoContato(filter_input(INPUT_POST, 'informacaoContato'));
    $contato->setRodapeContato(filter_input(INPUT_POST, 'rodape'));
    $idEmpresa = filter_input(INPUT_POST, 'idEmpresa');
    $contato->setIdEmpresa($idEmpresa);
    $idCont = filter_input(INPUT_POST, 'idContato');
    if (empty($idCont)):
        if ($contato->add()):
            echo "<script>window.alert('Adicionado com sucesso.'); window.location.href='gerContatos.php?idEmpresa=$idEmpresa';</script>";

        else:
            echo "<script>window.alert('Erro ao adicionar.'); window.open(document.referrer,'_self');</script>";
        endif;
    else:
        if ($contato->update("idContato", $idCont, )):
            echo "<script>window.alert('Atualizado com sucesso.'); window.location.href='gerContatos.php?idEmpresa=$idEmpresa';';</script>";

        else:
            echo "<script>window.alert('Erro ao atualizar.'); window.open(document.referrer,'_self');</script>";
        endif;
    endif;
elseif (filter_has_var(INPUT_POST, "btnExcluir")):
    $idCont = intval(filter_input(INPUT_POST, "idContato"));
    if($contato->delete("idContato", $idCont)):
        header("location:listempresa.php");
    else:
        echo "<script>window.alert('Erro ao deletar.'); window.open(document.referrer,'_self');</script>";
    endif;


endif;