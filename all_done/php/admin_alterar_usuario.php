<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../class/usuario.php');
$usuario = new Usuario;

if(isset($_POST['id_usuario'])){

    $id_usuario = mysqli_real_escape_string($conexao, trim($_POST['id_usuario']));
    $id_perfil = mysqli_real_escape_string($conexao, trim($_POST['id_perfil']));

     $novo_id = $usuario-> bd_insert_usuario_perfil($id_usuario,$id_perfil);

    if($novo_id){
        $_SESSION['envUsuPer']="Perfil cadastrado!";
    }else{
        $_SESSION['errUsuPer']="Erro no cadastro do perfil!";
    }
}

header('Location: ../php/admin_alterar_usuario_form.php?id_usuario='. $id_usuario .'');

?>