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

function html_mensagem_aside(){
    $mensagem="<h2>Cadastro do Aluno<br></h2><p class='text-white-50'>Cadastre-se como aluno para enviar suas atividades complementares.</p>";
    return $mensagem;
}

function html_form_select_options_curso(){
    $usuario = new Usuario;
    $registros=$usuario->bd_select_cursos();
    $html = '';
    foreach($registros as $registro ){
        $option=substr($registro['nome_curso'],0,49);
        if(strlen($option)<strlen($registro['nome_curso'])){
            $option.='...';
        }
        $html.="<option title='". $registro['nome_curso'] ."' value='" . $registro['id_curso'] ."'> ". $option ."</option>\n";
    }
    return $html;

}

function html_form_select_options_curriculos($id_curso){
    $usuario = new Usuario;
    $registros=$usuario->bd_select_curriculos($id_curso);
    $html = '';
    foreach($registros as $registro ){
        $html.="<option title='". $registro['curriculo'] ."' value='" . $registro['id_curso_curriculo'] ."'> ". $registro['curriculo'] ."</option>\n";
    }
    return $html;

}

function json_form_select_options_curriculos($id_curso){
    $usuario = new Usuario;
    $registros=$usuario->bd_select_curriculos($id_curso); // variavel do curso

    return json_encode($registros, JSON_FORCE_OBJECT|JSON_UNESCAPED_UNICODE);

}

?>