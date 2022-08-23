<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../class/atividades_comp.php');

$atividades= new Atividades_comp;

if(isset($_POST['id_tipo_atividade'])){

    $id_atividade_comp = filter_input(INPUT_POST, 'id_atividade_comp', FILTER_SANITIZE_NUMBER_INT);

    $id_tipo_atividade = mysqli_real_escape_string($conexao, trim($_POST['id_tipo_atividade']));

    $carga_hor_comp2 = mysqli_real_escape_string($conexao, trim($_POST['cargaH']));

    $desc_atividade= mysqli_real_escape_string($conexao, trim($_POST['desc']));

    $mecanismo = mysqli_real_escape_string($conexao, trim($_POST['mecanismo']));

    $doc_compro2 = $_FILES['certif'];

    $doc_nome2 = $doc_compro['name'];

    $doc_novo_nome2 = uniqid();

    $pasta='certificados/';
    $extensao = strtolower(pathinfo($doc_nome2,PATHINFO_EXTENSION));
    $nome_arquivo2 = $doc_novo_nome2 . "-" . $_SESSION['id_usuario']. "." . $extensao;

    $dados_atividade=$atividades->bd_select_atividade_by_id($id_atividade_comp);

    if(!empty($extensao)){

        $caminho=$pasta.$dados_atividade['nome_arquivo'];
        if(file_exists( $caminho )){
            unlink($caminho);
        }

        $doc_compro=$doc_compro2;
        $nome_arquivo=$nome_arquivo2;

        move_uploaded_file($doc_compro2['tmp_name'], $pasta . $nome_arquivo2);

    }else{
        foreach($dados_atividade as $da){
            $doc_compro=$da['doc_compro'];
            $nome_arquivo=$da['nome_arquivo'];
        }
    }

    $hr_min_max=$atividades->bd_select_min_max_horas_complementares($id_tipo_atividade);
    $hr_min=$hr_min_max['min_horas'];
    $hr_max=$hr_min_max['max_horas'];

    if($carga_hor_comp2<=$hr_max && $carga_hor_comp2>=$hr_min ){
        $carga_hor_comp = $carga_hor_comp2;
    }else{
        $_SESSION['msgErro']='Carga horária requerida não compativel com curso';
        header('Location: ../php/atividades_form.php');
        exit();
    }

    $retorno=$atividades->bd_update_atividade_comp_atividades_comp_usuario($id_tipo_atividade,$carga_hor_comp, $desc_atividade, $mecanismo, $doc_compro, $nome_arquivo,$id_atividade_comp, $_SESSION['id_usuario']);


    if($retorno){
        $_SESSION['msgEnvioEdita']="Atividade editada com sucesso!";
    }else{
        $_SESSION['msgErroEdita']="Erro na edição da atividade!";
    }
}
header('Location: ../php/atividades_form_edita.php');
?>