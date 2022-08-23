<?php
require_once('../class/conecta.php');
require_once('../include/sessao.php');
require_once('../include/funcoes.php');
require_once('../include/config.php');
require_once('../class/curso.php');
require_once('../class/usuario.php');
require_once('../class/sistema.php');
require_once('../php/cadastro_aluno_template.php');
$curso= new Curso;



if($_SESSION['admin']==1){

    $template=carrega_template(TPL_LOGIN);
    $html = $template;

    $msg = $curso->html_msg_aside_curriculo();
    $html=str_ireplace('<!-- mensagem -->',$msg,$html);

    $form = $curso->html_form_cadastro_curriculo();
    $html=str_ireplace('<!-- conteudo -->',$form,$html);

    $option_curso=html_form_select_options_curso();
    $html=str_ireplace('<!-- option-curso -->',$option_curso,$html);

    if(isset($_SESSION['errCurri'])){
        $msgE = $curso->html_form_msgErro_curriculo();
        $html=str_ireplace('<!-- mensagem erro -->',$msgE,$html);
    }
    if(isset($_SESSION['envCurri'])){
        $msg = $curso->html_form_msgEnvio_curriculo();
        $html=str_ireplace('<!-- mensagem erro -->',$msg,$html);
    }
    unset($_SESSION['errCurri']);
    unset($_SESSION['envCurri']);

}else{
    $restrito=Sistema::html_msg_acesso_restrito();
    $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
}

echo $html;

?>