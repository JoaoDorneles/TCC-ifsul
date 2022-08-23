<?php

require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../php/lista_alunos_template.php');
require_once ('../class/usuario.php');
require_once ('../class/atividades_comp.php');
require_once ('../class/sistema.php');


$template=carrega_template(TPL_PADRAO);
$html = $template;

$link=Sistema::link_voltar_pagina_landingpage();
$html=str_ireplace('<!-- link voltar -->',$link,$html);

$msgNav=html_sidenav_lista_alunos();
$html=str_ireplace('<!-- mensagem -->',$msgNav,$html);

if($_SESSION['secretaria']==1){

    $titulo_conteudo=Sistema::html_titulo_conteudo_alunos();
    $html=str_ireplace('<!-- titulo conteudo -->',$titulo_conteudo,$html);

    $lista=html_lista_alunos();
    $html=str_ireplace('<!-- conteudo -->',$lista,$html);

}else{
    $restrito=Sistema::html_msg_acesso_restrito();
    $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
}

echo $html;

?>