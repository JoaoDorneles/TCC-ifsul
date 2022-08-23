<?php
require_once('../class/conecta.php');
require_once('../include/sessao.php');
require_once('../include/funcoes.php');
require_once('../include/config.php');
require_once('../class/usuario.php');
require_once('../class/sistema.php');
$usuario = new Usuario;



/* if($_SESSION['admin']==1){ */

    $template=carrega_template(TPL_LOGIN);
    $html = $template;

    $msg = $usuario->html_msg_aside_alterna_perfil();
    $html=str_ireplace('<!-- mensagem -->',$msg,$html);

    $form = $usuario->html_form_alterar_usuario();
    $html=str_ireplace('<!-- conteudo -->',$form,$html);

    $opt_usu = $usuario->html_option_usuarios();
    $html=str_ireplace('<!-- option-usuario -->',$opt_usu,$html);

    $opt_per = $usuario->html_option_perfis();
    $html=str_ireplace('<!-- option-perfil -->',$opt_per,$html);

    if(isset($_SESSION['errUsuPer'])){
        $msgE = $usuario->html_form_msgErro();
        $html=str_ireplace('<!-- mensagem erro -->',$msgE,$html);
    }
    if(isset($_SESSION['envUsuPer'])){
        $msg = $usuario->html_form_msgEnvio();
        $html=str_ireplace('<!-- mensagem erro -->',$msg,$html);
    }
    unset($_SESSION['errUsuPer']);
    unset($_SESSION['envUsuPer']);

/* }else{
    $restrito=Sistema::html_msg_acesso_restrito();
    $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
} */

echo $html;

?>