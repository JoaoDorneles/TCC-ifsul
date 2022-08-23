<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../class/curso.php');
$curso = new Curso;

if(isset($_POST['nome_curso'])){

    $nome_curso = mysqli_real_escape_string($conexao, trim($_POST['nome_curso']));

    $novo_id = $curso->bd_insert_curso($nome_curso);

    if($novo_id){
        $_SESSION['envCurso']="Curso cadastrado!";
    }else{
        $_SESSION['errCurso']="Erro no cadastro do Curso!";
    }
}

header('Location: ../php/curso_form.php');

?>