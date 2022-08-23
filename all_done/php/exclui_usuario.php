<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../class/usuario.php');

$usuario= new Usuario;

$id_usuario = filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);

$retorno=$usuario->bd_delete_usuario_perfis_usuario($id_usuario);

if($retorno){
    $_SESSION['msgSucessoExclusaoUsu']="Usuário excluido!";
}else{
    $_SESSION['msgErroExclusaoUsu']="Erro na exclusão do usuário!";
}

header('Location: ../php/lista_usuario.php');