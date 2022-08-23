<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../php/atividades_avaliacao_template.php');
require_once ('../class/usuario.php');
require_once ('../class/sistema.php');

$template=carrega_template(TPL_PADRAO);
$html = $template;

$link=Sistema::link_voltar_pagina_landingpage();
$html=str_ireplace('<!-- link voltar -->',$link,$html);

$msg_aside=html_mensagem_aside();
$html=str_ireplace('<!-- mensagem -->',$msg_aside,$html);

if($_SESSION['coordenador']==1){

    $titulo_conteudo=Sistema::html_titulo_conteudo_alunos();
    $html=str_ireplace('<!-- titulo conteudo -->',$titulo_conteudo,$html);

    $atividades=html_avaliacao_Atividade();
    $html=str_ireplace('<!-- conteudo -->',$atividades,$html);

}else{
    $restrito=Sistema::html_msg_acesso_restrito();
    $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
}

echo $html;

?>