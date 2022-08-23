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

$link_voltar=link_voltar_pagina();
$html=str_ireplace('<!-- link voltar -->',$link_voltar,$html);

$msg=html_sidenav_lista_alunos_detalhado();
$html=str_ireplace('<!-- mensagem -->',$msg,$html);

if($_SESSION['secretaria']==1){

    $titulo_conteudo=html_titulo_conteudo_avalia_atividades();
    $html=str_ireplace('<!-- titulo conteudo -->',$titulo_conteudo,$html);

    $atividades_deferidas=html_detalhada_aluno();
    if($atividades_deferidas!=null){
        $html=str_ireplace('<!-- conteudo -->',$atividades_deferidas,$html);
    }else{
        $vazio=Sistema::html_msg_conteudo_verifica_atividades_deferidas_vazio();
        $html=str_ireplace('<!-- conteudo -->',$vazio,$html);
    }

}else{
    $restrito=Sistema::html_msg_acesso_restrito();
    $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
}

echo $html;

?>