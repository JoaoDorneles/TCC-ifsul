<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../class/atividades_comp.php');

$atividades= new Atividades_comp;

$id_atividade_comp = filter_input(INPUT_GET, 'id_atividade_comp', FILTER_SANITIZE_NUMBER_INT);

$retorno=$atividades->bd_delete_atividade_comp_atividade_comp_usuario($_SESSION['id_usuario'],$id_atividade_comp);

if($retorno){
    $_SESSION['msgSucessoExclusao']="Atividade excluida!";
}else{
    $_SESSION['msgErroExclusao']="Erro na exclusão da atividade!";
}

header('Location: ../php/atividades_verifica.php');
?>