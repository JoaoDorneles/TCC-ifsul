<?php
require_once ('../class/conecta.php');
require_once ('../class/usuario.php');
$usuario = new Usuario;
session_start();

if(isset($_POST['matricula'])){

    $matricula = mysqli_real_escape_string($conexao, trim($_POST['matricula']));
    /* $id_curso = mysqli_real_escape_string($conexao, trim($_POST['curso'])); */
    $id_curso_curriculo= mysqli_real_escape_string($conexao, trim($_POST['curriculo']));

    $novo_id = $usuario->bd_insert_aluno_perfil_aluno($matricula, $id_curso_curriculo, $_SESSION['id_usuario'], 4);

    if($novo_id){
        $_SESSION['aluno']=1;
        $_SESSION['msgEnvio']="Aluno matriculado!";
    }else{
        $_SESSION['msgErro']="Erro na matricula do aluno";
    }
}

header('Location: ../php/cadastro_aluno_form.php');

?>