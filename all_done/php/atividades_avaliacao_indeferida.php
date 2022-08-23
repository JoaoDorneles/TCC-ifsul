<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../class/atividades_comp.php');
require_once ('../class/usuario.php');


$usuario= new Usuario;
$atividades= new Atividades_comp;

$id_atividade_comp = filter_input(INPUT_GET, 'id_atividade_comp', FILTER_SANITIZE_NUMBER_INT);
$comentario = filter_input(INPUT_GET,'comentario', FILTER_SANITIZE_STRING);

$id_usuario=$usuario->bd_select_id_usuario_by_id_atividade($id_atividade_comp);
$novo_id=$atividades->bd_update_atividade_indeferida_atividades_comp_usuario($id_atividade_comp, $comentario, $_SESSION['id_usuario']);

if($novo_id){
    $_SESSION['msgSucessoIndeferimento']="Atividade indeferida!";
}else{
    $_SESSION['msgErroIndeferimento']="Erro no indeferimento da atividade!";
}

header('Location: ../php/atividades_avaliacao_detalhado.php?id_usuario='.$id_usuario[0]['id_usuario'].'');
?>