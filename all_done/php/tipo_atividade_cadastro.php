<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../class/atividades_comp.php');
$atividades = new Atividades_comp;

if(isset($_POST['curriculo'])){

    $id_curso_curriculo = mysqli_real_escape_string($conexao, trim($_POST['curriculo']));
    $tipo_atividade = mysqli_real_escape_string($conexao, trim($_POST['tipo_atividade']));
    $hora_max = mysqli_real_escape_string($conexao, trim($_POST['hora_max']));
    $hora_min = mysqli_real_escape_string($conexao, trim($_POST['hora_min']));

    $novo_id = $atividades->bd_insert_tipo_atividade($id_curso_curriculo, $tipo_atividade, $hora_max, $hora_min);

    if($novo_id){
        $_SESSION['envTipoAtv']="Tipo de atividade cadastrada!";
    }else{
        $_SESSION['errTipoAtv']="Erro no cadastro do tipo de atividade!";
    }
}

header('Location: ../php/tipo_atividade_cadastro_form.php');

?>