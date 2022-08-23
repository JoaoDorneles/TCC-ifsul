<?php

function html_form_msg_erro_deferimento(){

    $msgE=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>

            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                '.(isset($_SESSION["msgErroDeferimento"])?$_SESSION["msgErroDeferimento"]:"").'
                </div>
            </div>';

    return $msgE;
}

function html_form_msg_sucesso_deferimento(){
    
    $msg='  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>

            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                '.(isset($_SESSION["msgSucessoDeferimento"])?$_SESSION["msgSucessoDeferimento"]:"").'
                </div>
            </div>';

    return $msg;
}

function html_form_msg_erro_indeferimento(){

    $msgE=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>

            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                '.(isset($_SESSION["msgErroIndeferimento"])?$_SESSION["msgErroIndeferimento"]:"").'
                </div>
            </div>';

    return $msgE;
}

function html_form_msg_sucesso_indeferimento(){

    $msg='  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>

            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                '.(isset($_SESSION["msgSucessoIndeferimento"])?$_SESSION["msgSucessoIndeferimento"]:"").'
                </div>
            </div>';

    return $msg;
}

function html_mensagem_aside(){
    $mensagem="<h2>Lista de Alunos<br></h2><p class='text-white-50'>Clique em detalhar para ver as atividades complementares cadastradas pelo aluno.</p>";
    return $mensagem;
}

function html_mensagem_aside_detalhado(){
    $mensagem="<h2>Atividades do Aluno<br></h2><p class='text-white-50'>Avalie-as de acordo com os requisitos.</p>";
    return $mensagem;
}

function link_voltar_pagina(){
    $link=' <a class="linkVoltar" href="../php/atividades_avaliacao.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
                </svg>
            </a>';
    return $link;
}

function html_titulo_conteudo_avalia_atividades(){

    $usuario = new Usuario;

    $id_usuario= filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);

    $nome_usuario=$usuario->bd_select_usuario_by_id($id_usuario);

    $titulo_conteudo = "<p>Atividades"." - ". $nome_usuario[0]['nome'] ." <svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-caret-down-fill' viewBox='0 0 16 16'>
    <path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg></i></p>";

    return $titulo_conteudo;
}

function html_avaliacao_atividade(){

    $usuario = new Usuario;

    $registros = $usuario->bd_select_todos_alunos();

    $html='';
    foreach($registros as $registro ){
        $html.="
        <div class='row'>
            <div class='col-sm-12'>
                <div class='card cardShadow'>
                <div class='card-body'>
                    <h5 class='card-title'><strong class='strongPreto'>". $registro['nome'] . " - " . $registro['matricula'] ."</strong></h5>
                    <p class='card-text'><strong class='strongCinza'>Curso:</strong> ". $registro['nome_curso'] ."</p>
                    <p class='card-text'><strong class='strongCinza'>Currículo:</strong> ". $registro['curriculo'] ."</p>
                    <a href='atividades_avaliacao_detalhado.php?id_usuario=".$registro['id_usuario']."' class='btn btn-dark'>Detalhar</a>
                </div>
                </div>
            </div>
        </div><br>";
    }
    return $html;
}


function html_avaliacao_atividade_detalhado(){

    $atividades= new Atividades_comp;

    $id_usuario= filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);

    $registros=$atividades->bd_select_atividades_aluno_pendente($id_usuario);

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
                    <p title='". $registro['doc_compro'] ."' class='card-text'><strong class='strongCinza'>Certificado:</strong> ".$nome_certificado." <a class='linkIcon' target='_blank' href='certificados/".$registro['nome_arquivo']."'><i class='bi bi-file-earmark-fill'></i></a></p>
                    <p title='". $registro['mecanismo'] ."' class='card-text'><strong class='strongCinza'>Veracidade do Certificado:</strong> ".$link."<a target='_blank' href='".$registro['mecanismo']."'><i class='bi bi-link-45deg'></i></a></p>
                    <a href='atividades_avaliacao_deferida.php?id_atividade_comp=".$registro['id_atividade_comp']."' class='btn btn-success'>Deferir</a>
                    <a onclick='comentarioIndeferimento(". $registro['id_atividade_comp'].")' href='#' class='btn btn-danger'>Indeferir</a>
                </div>
                </div>
            </div>
        </div><br>";
    }
    return $html;
}

function html_botao_voltar_avaliar(){

    $html="<a class='linkVoltar' href='../php/atividades_avaliacao.php'>
                <svg xmlns='http://www.w3.org/2000/svg' width='30' height='30' fill='currentColor' class='bi bi-arrow-bar-left' viewBox='0 0 16 16'>
                    <path fill-rule='evenodd' d='M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z'/>
                </svg>
            </a> ";
    return $html;
}
?>