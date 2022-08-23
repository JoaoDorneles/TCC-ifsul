<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../php/atividades_form_template.php');
require_once ('../class/atividades_comp.php');
require_once ('../class/usuario.php');
require_once ('../class/sistema.php');

$usuario = new Usuario;

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

    $templateForm=carrega_template(TPL_FORM);
    $htmlForm = $templateForm;
    $options=html_form_select_options();
    $htmlForm=str_ireplace('<!-- options -->',$options,$htmlForm);
    $html=str_ireplace('<!-- conteudo -->',$htmlForm,$html);

    if(isset($_SESSION['msgErro'])){
        $msg = html_form_msgErro();
        $html=str_ireplace('<!-- mensagem erro -->',$msg,$html);
    }
    if(isset($_SESSION['msgEnvio'])){
        $msgE = html_form_msgEnvio();
        $html=str_ireplace('<!-- mensagem erro -->',$msgE,$html);
    }

}else{
    $restrito=Sistema::html_msg_conteudo_aluno();
    $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
}

unset($_SESSION['msgErro']);
unset($_SESSION['msgEnvio']);

echo $html;


?>
