<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: ../php/login_form.php');
    $_SESSION['id_usuario'] = "";
    $_SESSION['nome_usuario'] = "";
    $_SESSION['tipo_usuario'] = "";
    $_SESSION['admin']= "";
    $_SESSION['coordenador']= "";
    $_SESSION['secretaria']= "";
    $_SESSION['aluno']= "";
    exit();
}

?>