<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../php/atividades_avaliacao_template.php');
require_once ('../class/atividades_comp.php');
require_once ('../class/sistema.php');
require_once ('../class/usuario.php');

$template=carrega_template(TPL_PADRAO);
$html = $template;

$link_voltar=link_voltar_pagina();
$html=str_ireplace('<!-- link voltar -->',$link_voltar,$html);

$msg_aside=html_mensagem_aside_detalhado();
$html=str_ireplace('<!-- mensagem -->',$msg_aside,$html);

if($_SESSION['coordenador']==1){

    $titulo_conteudo=html_titulo_conteudo_avalia_atividades();
    $html=str_ireplace('<!-- titulo conteudo -->',$titulo_conteudo,$html);

    $atividades_aluno=html_avaliacao_atividade_detalhado();
    if(!empty($atividades_aluno)){
        $html=str_ireplace('<!-- conteudo -->',$atividades_aluno,$html);
    }else{
        $msg_vazio=Sistema::html_msg_conteudo__atividades_avalia_vazio();
        $html=str_ireplace('<!-- conteudo -->',$msg_vazio,$html);
    }

    if(isset($_SESSION['msgSucessoDeferimento'])){
        $msgd = html_form_msg_sucesso_deferimento();
        $html=str_ireplace('<!-- mensagem erro -->',$msgd,$html);
    }
    if(isset($_SESSION['msgErroDeferimento'])){
        $msgEd = html_form_msg_erro_deferimento();
        $html=str_ireplace('<!-- mensagem erro -->',$msgEd,$html);
    }

    if(isset($_SESSION['msgSucessoIndeferimento'])){
        $msgi = html_form_msg_sucesso_indeferimento();
        $html=str_ireplace('<!-- mensagem erro -->',$msgi,$html);
    }
    if(isset($_SESSION['msgErroIndeferimento'])){
        $msgEi = html_form_msg_erro_indeferimento();
        $html=str_ireplace('<!-- mensagem erro -->',$msgEi,$html);
    }

}else{
    $restrito=Sistema::html_msg_conteudo_coordenador();
    $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
}
    unset($_SESSION['msgErroDeferimento']);
    unset($_SESSION['msgSucessoDeferimento']);
    unset($_SESSION['msgSucessoIndeferimento']);
    unset($_SESSION['msgErroIndeferimento']);
echo $html;

?>