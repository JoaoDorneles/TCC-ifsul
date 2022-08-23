<?php

function html_form_msgErro(){
    $msg='  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>

            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                '.(isset($_SESSION['msgErro'])?$_SESSION['msgErro']:"").'
                </div>
            </div>';

    return $msg;
}

function html_form_msgEnvio(){
    $msgE=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>

            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                '.(isset($_SESSION['msgEnvio'])?$_SESSION['msgEnvio']:"").'
                </div>
            </div>';

    return $msgE;
}

function html_form_edita_msgErro(){

    $msg='  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>

            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                '.(isset($_SESSION['msgErroEdita'])?$_SESSION['msgErroEdita']:"").'
                </div>
            </div>';

    return $msg;
}

function html_form_edita_msgEnvio(){

    $msgE=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>

            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                '.(isset($_SESSION['msgEnvioEdita'])?$_SESSION['msgEnvioEdita']:"").'
                </div>
            </div>';

    return $msgE;
}

function link_voltar_pagina(){
    $link=' <a class="linkVoltar" href="../php/atividades_verifica.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
                </svg>
            </a>';
    return $link;
}

function html_mensagem_aside(){
    $mensagem="<h2>Cadastro de Atividades<br></h2><p class='text-white-50'>Cadastre atividades para concluir suas horas complementares.</p>";
    return $mensagem;
}

function html_mensagem_aside_edita(){
    $mensagem="<h2>Edição de atividade<br></h2><p class='text-white-50'>Edite sua atividade conforme o solicitado pelo coordenador para obter o deferimento.</p>";
    return $mensagem;
}

function html_form_select_options(){
    $atividades = new Atividades_comp;
    $registros=$atividades->bd_select_form_options($_SESSION['id_usuario']);
    $html = '';
    foreach($registros as $registro ){
        $option=substr($registro['tipo_atividade'],0,49);
        if(strlen($option)<strlen($registro['tipo_atividade'])){
            $option.='...';
        }
        $html.="<option title='". $registro['tipo_atividade'] ."' value='" . $registro['id_tipo_atividade'] ."' data-min='". $registro['hora_min'] ."' data-max='". $registro['hora_max'] ."' > ". $option ."</option>\n";
    }
    return $html;

}

function html_form_edita(){

    $atividades = new Atividades_comp;

    $id_atividade_comp = filter_input(INPUT_GET, 'id_atividade_comp', FILTER_SANITIZE_NUMBER_INT);
    $registros = $atividades->bd_select_atividade_by_id($id_atividade_comp);
    $html='';
    foreach($registros as $registro ){
        $html.="<form id='formAtividadesEdita' action='../php/atividades_edita.php' method='POST' enctype='multipart/form-data'>
        <input type='hidden' name='id_atividade_comp' value='".$id_atividade_comp."'>
        <div class='form-group'>
                        <label>Tipo de Atividade</label>
                        <select id='tipo_atividade' class='form-select border border-dark' name='id_tipo_atividade'>
                            <option value='". $registro['id_tipo_atividade'] ."' data-min='". $registro['hora_min'] ."' data-max='". $registro['hora_max'] ."'>". $registro['tipo_atividade']."</option>
                            <!-- options -->
                        </select>
                    </div>

                    <div class='form-group'>
                        <label>Descrição da Atividade</label>
                        <input id='desc' type='text' class='form-control border border-dark' placeholder='Descrição' name='desc' value='". $registro['desc_atividade']."'>
                    </div>

                    <div class='form-group'>
                        <label>Carga Horária Requerida</label>
                        <input id='cargaH' class='form-control border border-dark' placeholder='Carga Horária' name='cargaH' value='". $registro['carga_hor_comp']."'>
                    </div>

                    <div class='form-group'>
                        <label>Validade do Certificado</label>
                        <input id='mecanismo' type='text' class='form-control border border-dark' placeholder='Link' name='mecanismo' value='". $registro['mecanismo']."'>
                    </div>
                    <div class='form-group'>
                        <label>Documento Comprobatório - Arquivo atual<a target='_blank' class='linkIcon' href='certificados/".$registro['nome_arquivo']."'><i class='bi bi-file-earmark-fill'></i></a></label>
                        <input id='certif' type='file' class='form-control border border-dark' name='certif'>
                    </div>

                    <button type='submit' class='btn btn-primary' value='enviar' name='Enviar'>Editar</button>
                    <a class='btn btn-outline-dark ' href='../php/atividades_verifica.php'>Voltar</a>
                </form>
                <script src='../js/validacao.js'></script>";
        return $html;
    }
}

?>