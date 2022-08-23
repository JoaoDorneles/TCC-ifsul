<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../class/atividades_comp.php');
require_once ('../class/usuario.php');
$atividades = new Atividades_comp;
$usuario = new Usuario;

    if(isset($_POST['id_tipo_atividade'])){

        $tipo_atividade = mysqli_real_escape_string($conexao, trim($_POST['id_tipo_atividade']));

        $carga_hor_comp2 = mysqli_real_escape_string($conexao, trim($_POST['cargaH']));

        $desc_atividade= mysqli_real_escape_string($conexao, trim($_POST['desc']));

        $mecanismo = mysqli_real_escape_string($conexao, trim($_POST['mecanismo']));

        $doc_compro=$_FILES['certif'];

        $doc_nome=$doc_compro['name'];

        $doc_novo_nome=uniqid();

        $pasta='certificados/';
        $extensao= strtolower(pathinfo($doc_nome,PATHINFO_EXTENSION));
        $nome_arquivo= $doc_novo_nome . "-" . $_SESSION['id_usuario']. "." . $extensao;
        move_uploaded_file($doc_compro['tmp_name'], $pasta . $nome_arquivo);

        $hr_min_max=$atividades->bd_select_min_max_horas_complementares($tipo_atividade);
        $hr_min=$hr_min_max['min_horas'];
        $hr_max=$hr_min_max['max_horas'];

        if($carga_hor_comp2<=$hr_max && $carga_hor_comp2>=$hr_min ){
            $carga_hor_comp = $carga_hor_comp2;
        }else{
            $_SESSION['msgErro']='Carga horária requerida não compativel com curso';
            header('Location: ../php/atividades_form.php');
            exit();
        }

        $dados_aluno=$usuario->bd_select_aluno($_SESSION['id_usuario']);
        $id_aluno = $dados_aluno[0]['id_aluno'];

        $novo_id = $atividades->bd_insert_atividades_comp_atividades_comp_usuario($tipo_atividade, $carga_hor_comp2, $desc_atividade, $mecanismo, $doc_nome, $nome_arquivo, "Pendente",$_SESSION['id_usuario'],$id_aluno);
        if($novo_id){
            $_SESSION['msgEnvio']='Atividade cadastrada!';
        }else{
            $_SESSION['msgErro']='Erro no cadastro da atividade!';
        }
    }
    header('Location: ../php/atividades_form.php');
?>