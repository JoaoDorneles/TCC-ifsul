<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../php/atividades_verifica_template.php');
require_once ('../class/atividades_comp.php');
require_once ('../class/usuario.php');
require_once ('../class/sistema.php');

$usuario= new Usuario;

$template=carrega_template(TPL_PADRAO);
$html = $template;

$link=Sistema::link_voltar_pagina_landingpage();
$html=str_ireplace('<!-- link voltar -->',$link,$html);

$msgAside=html_mensagem_aside();
$html=str_ireplace('<!-- mensagem -->',$msgAside,$html);

$id_usuario=$_SESSION['id_usuario'];

$retornos=$usuario->bd_select_aluno($id_usuario);

foreach($retornos as $retorno){
    $id_aluno=$retorno['id_aluno'];
}

if($_SESSION['aluno']==1 && !empty($id_aluno)){
    
    $titulo_conteudo=Sistema::html_titulo_conteudo_atividades();
    $html=str_ireplace('<!-- titulo conteudo -->',$titulo_conteudo,$html);

    $atividades=html_verifica_atividade();
    if($atividades!=null){
        $html=str_ireplace('<!-- conteudo -->',$atividades,$html);
    }else{
        $msg_vazio=Sistema::html_msg_conteudo__atividades_verifica_vazio();
        $html=str_ireplace('<!-- conteudo -->',$msg_vazio,$html);
    }

    if(isset($_SESSION['msgSucessoExclusao'])){
        $msg = html_form_msg_sucesso_exclusao();
        $html=str_ireplace('<!-- mensagem erro -->',$msg,$html);
    }
    if(isset($_SESSION['msgErroExclusao'])){
        $msgE = html_form_msg_erro_exclusao();
        $html=str_ireplace('<!-- mensagem erro -->',$msgE,$html);
    }

    unset($_SESSION['msgSucessoExclusao']);
    unset($_SESSION['msgErroExclusao']);

}else{
    $msgRestrito=Sistema::html_msg_conteudo_aluno();
    $html=str_ireplace('<!-- conteudo -->',$msgRestrito,$html);
}

echo $html;
?>