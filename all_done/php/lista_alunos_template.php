<?php

function link_voltar_pagina(){
    $link=' <a class="linkVoltar" href="../php/lista_alunos.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
                </svg>
            </a>';
    return $link;
}


function html_sidenav_lista_alunos(){
    $boas_vindas="<h2>Lista de Alunos<br></h2><p class='text-white-50'>Verifique os alunos que já completaram o total de horas necessárias.</p>";
    return $boas_vindas;
}


function html_sidenav_lista_alunos_detalhado(){
    $boas_vindas="<h2>Atividades Deferidas<br></h2><p class='text-white-50'>Estas são as atividades deferidas do aluno.</p>";
    return $boas_vindas;
}

function html_titulo_conteudo_avalia_atividades(){

    $usuario = new Usuario;

    $id_usuario= filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);

    $nome_usuario=$usuario->bd_select_usuario_by_id($id_usuario);

    $titulo_conteudo = "<p>Atividades"." - ". $nome_usuario[0]['nome'] ." <svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-caret-down-fill' viewBox='0 0 16 16'>
    <path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg></i></p>";

    return $titulo_conteudo;
}

function html_lista_alunos(){
    // arrumar select para puxar somente valores de atividades avaliadas
    $usuario = new Usuario;
    $registros=$usuario->bd_select_todos_alunos();
    $html = '';
    foreach($registros as $registro ){
        $html.="
        <div class='row'>
            <div class='col-sm-12'>
                <div class='card cardShadow'>
                <div class='card-body'>
                    <h5 class='card-title'>". $registro['nome'] . ' - ' . $registro['matricula'] ."</h5>
                    <p class='card-text'><strong class='strongCinza'>Curso:</strong>".$registro['nome_curso']."</p>
                    <p class='card-text'><strong class='strongCinza'>Currículo:</strong> ".$registro['curriculo']."</p>
                    <a href='lista_alunos_detalhado.php?id_usuario=".$registro['id_usuario']."' class='btn btn-dark'>Detalhar</a>
                </div>
                </div>
            </div>
        </div><br>";
    }
    return $html;

}

function html_detalhada_aluno(){
    $atividades= new Atividades_comp;
    $id_usuario= filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);
    $registros=$atividades->bd_select_atividades_deferidas_aluno($id_usuario);
    $html='';
    foreach($registros as $registro ){

        $nome_certificado=substr($registro['doc_compro'],0,28);
        if(strlen($nome_certificado)<strlen($registro['doc_compro'])){
            $nome_certificado.='...';
        }

        $link=substr($registro['mecanismo'],0,23);
        if(strlen($link)<strlen($registro['mecanismo'])){
            $link.='...';
        }

        $html.="
        <div class='row'>
            <div class='col-sm-12'>
                <div class='card cardShadow'>
                <div class='card-body'>
                    <h5 class='card-title'><strong class='strongPreto'>". $registro['desc_atividade'] ."</strong></h5>
                    <p class='card-text'><strong class='strongCinza'>Carga Horária Requerida:</strong> ".$registro['carga_hor_comp']."h</p>
                    <p title='". $registro['doc_compro'] ."' class='card-text'><strong class='strongCinza'>Certificado:</strong> ".$nome_certificado."<a target='_blank' class='linkIcon' href='certificados/".$registro['nome_arquivo']."'><i class='bi bi-file-earmark-fill'></i></a></p>
                    <p title='". $registro['mecanismo'] ."' class='card-text'><strong class='strongCinza'>Veracidade do Certificado:</strong> ".$link."<a target='_blank' href='".$registro['mecanismo']."'><i class='bi bi-link-45deg'></i></a></p>
                    <p class='card-text'><strong class='strongCinza'>Avaliação:</strong> <strong class='atividadeDeferida'>".$registro['avaliacao']."</strong></p>
                </div>
                </div>
            </div>
        </div><br>";
    }
    return $html;
}

?>