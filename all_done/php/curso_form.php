<?php
require_once('../class/conecta.php');
require_once('../include/sessao.php');
require_once('../include/funcoes.php');
require_once('../include/config.php');
require_once('../class/curso.php');
require_once('../class/sistema.php');
require_once('../php/cadastro_aluno_template.php');
$curso= new Curso;


if($_SESSION['admin']==1){

    $template=carrega_template(TPL_LOGIN);
    $html = $template;

    $msg = $curso->html_msg_aside_curso();
    $html=str_ireplace('<!-- mensagem -->',$msg,$html);

    $form = $curso->html_form_cadastro_curso();
    $html=str_ireplace('<!-- conteudo -->',$form,$html);

    if(isset($_SESSION['errCurso'])){
        $msgE = $curso->html_form_msgErro();
        $html=str_ireplace('<!-- mensagem erro -->',$msgE,$html);
    }
    if(isset($_SESSION['envCurso'])){
        $msg = $curso->html_form_msgEnvio();
        $html=str_ireplace('<!-- mensagem erro -->',$msg,$html);
    }
    unset($_SESSION['errCurso']);
    unset($_SESSION['envCurso']);

}else{
    $restrito=Sistema::html_msg_acesso_restrito();
    $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
}

echo $html;

?>