<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../class/usuario.php');
require_once ('../class/sistema.php');
$usuario = new Usuario;

$template=carrega_template(TPL_PADRAO);
$html = $template;

$link=Sistema::link_voltar_pagina_landingpage();
$html=str_ireplace('<!-- link voltar -->',$link,$html);

$boas_vindas=Sistema::html_sidenav_lista_usuario();
$html=str_ireplace('<!-- boas vindas -->',$boas_vindas,$html);


if($_SESSION['admin']===1){

    $lista=$usuario->html_lista_usuario();
    $html=str_ireplace('<!-- conteudo -->',$lista,$html);

    if(isset($_SESSION['msgErroExclusaoUsu'])){
        $msg = $usuario->html_form_msgErro_exclusao_usuario();
        $html=str_ireplace('<!-- mensagem erro -->',$msg,$html);
    }

    if(isset($_SESSION['msgSucessoExclusaoUsu'])){
        $msgE = $usuario->html_form_msgSucesso_exclusao_usuario();
        $html=str_ireplace('<!-- mensagem erro -->',$msgE,$html);
    }

}else{
    $msg_restrito=Sistema::html_msg_acesso_restrito();
    $html=str_ireplace('<!-- conteudo -->',$msg_restrito,$html);
}

unset($_SESSION['msgErroExclusaoUsu']);
unset($_SESSION['msgSucessoExclusaoUsu']);

echo $html;

?>

