<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../php/cadastro_aluno_template.php');
require_once ('../class/usuario.php');
require_once ('../class/sistema.php');


if(isset($_SESSION['id_usuario'])){

    $template=carrega_template(TPL_LOGIN);
    $html = $template;

    $link=Sistema::link_voltar_pagina_landingpage();
    $html=str_ireplace('<!-- link voltar -->',$link,$html);

    $mensagem=html_mensagem_aside();
    $html=str_ireplace('<!-- mensagem -->',$mensagem,$html);

   /*  if(!($_SESSION['aluno']==1)){ */
        $templateForm=carrega_template(TPL_FORM_ALUNO);
        $htmlForm = $templateForm;

        $option_curso=html_form_select_options_curso();
        $htmlForm=str_ireplace('<!-- option-curso -->',$option_curso,$htmlForm);

        $option_curriculo=html_form_select_options_curriculos(0);
        $htmlForm=str_ireplace('<!-- option-curriculo -->',$option_curriculo,$htmlForm);

        $html=str_ireplace('<!-- conteudo -->',$htmlForm,$html);
   /*  }else{
        $restrito=Sistema::html_msg_conteudo_aluno_ja_cadastrado();
        $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
    } */

    if(isset($_SESSION['msgErro'])){
        $msg = html_form_msgErro();
        $html=str_ireplace('<!-- mensagem erro -->',$msg,$html);
    }
    if(isset($_SESSION['msgEnvio'])){
        $msgE = html_form_msgEnvio();
        $html=str_ireplace('<!-- mensagem erro -->',$msgE,$html);
    }
    unset($_SESSION['msgErro']);
    unset($_SESSION['msgEnvio']);
}else{
    $restrito=Sistema::html_msg_sem_cadastro();
    $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
}

echo $html;
?>