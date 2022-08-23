<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../class/usuario.php');

$usuario= new Usuario;

$id_usuario = filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);

$retorno=$usuario->bd_delete_usuario_perfil($id_usuario,$id_perfil);

if($retorno){
    $_SESSION['msgSucessoExclusaoPer']="Perfil excluido!";
}else{
    $_SESSION['msgErroExclusaoPer']="Erro na exclusão do perfil!";
}

header('Location: ../php/admin_alterar_usuario_form.php');