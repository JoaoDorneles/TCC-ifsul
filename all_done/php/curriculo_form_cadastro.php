<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../class/curso.php');
$curso = new Curso;

if(isset($_POST['curso'])){

    $id_curso = mysqli_real_escape_string($conexao, trim($_POST['curso']));
    $curriculo = mysqli_real_escape_string($conexao, trim($_POST['curriculo']));
    $data_inicio = mysqli_real_escape_string($conexao, trim($_POST['dt_inicio']));
    $data_termino = mysqli_real_escape_string($conexao, trim($_POST['dt_termino']));

    $novo_id = $curso->bd_insert_curriculo($id_curso, $curriculo, $data_inicio, $data_termino);

    if($novo_id){
        $_SESSION['envCurri']="Currículo cadastrado!";
    }else{
        $_SESSION['errCurri']="Erro no cadastro do currículo!";
    }
}

header('Location: ../php/curriculo_form.php');

?>