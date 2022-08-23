<?php
require_once ('../class/conecta.php');
require_once ('../class/usuario.php');
$usuario = new Usuario;
session_start();
if(isset($_POST['nome'])){

    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $senha= mysqli_real_escape_string($conexao, trim($_POST['senha']));

    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    $novo_id = $usuario->bd_insert_usuario($nome,$email,$senha_criptografada);
    if($novo_id){
        $_SESSION['msgEnvio']="Usuário Cadastrado!";
    }else{
        $_SESSION['msgErro']="Erro no Cadastro do Usuário";
    }
}
header('Location: ../php/cadastro_usuario_form.php');

?>