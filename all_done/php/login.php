<?php
require_once ('../class/conecta.php');
require_once ('../class/usuario.php');
$usuario = new Usuario;
session_start();

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));

    $dados_login_usuario=$usuario->bd_select_usuario_login($email,$senha);

    if (!$dados_login_usuario['id_usuario']==null) {
        $_SESSION['id_usuario'] = $dados_login_usuario['id_usuario'];
        $_SESSION['nome_usuario']= $dados_login_usuario['nome_usuario'];
        $_SESSION['admin']= $dados_login_usuario['admin'];
        $_SESSION['coordenador']= $dados_login_usuario['coordenador'];
        $_SESSION['secretaria']= $dados_login_usuario['secretaria'];
        $_SESSION['aluno']= $dados_login_usuario['aluno'];
        header("Location: ../php/landingpage.php");
        exit();
    } else {
        $_SESSION['loginErro']="E-mail ou senha incorretos!";
    }
    header("Location: ../php/login_form.php");
}

?>