<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../php/atividades_form_template.php');
require_once ('../class/atividades_comp.php');
require_once ('../class/sistema.php');


$template=carrega_template(TPL_PADRAO);
$html = $template;

$link=link_voltar_pagina();
$html=str_ireplace('<!-- link voltar -->',$link,$html);

$msg=html_mensagem_aside_edita();
$html=str_ireplace('<!-- mensagem -->',$msg,$html);

if($_SESSION['aluno']==1){

    $form=html_form_edita();
    $html=str_ireplace('<!-- conteudo -->',$form,$html);
    $options=html_form_select_options();
    $html=str_ireplace('<!-- options -->',$options,$html);

    if(isset($_SESSION['msgErroEdita'])){
        $msg = html_form_edita_msgErro();
        $html=str_ireplace('<!-- mensagem erro -->',$msg,$html);
    }
    if(isset($_SESSION['msgEnvioEdita'])){
        $msgE = html_form_edita_msgEnvio();
        $html=str_ireplace('<!-- mensagem erro -->',$msgE,$html);
    }

}else{
    $restrito=Sistema::html_msg_acesso_restrito();
    $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
}

unset($_SESSION['msgErroEdita']);
unset($_SESSION['msgEnvioEdita']);
echo $html;
?>
