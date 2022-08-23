<?php
    require_once ('../class/conecta.php');
    require_once ('../class/sistema.php');
    require_once ('../include/config.php');
    require_once ('../include/funcoes.php');
    require_once ('../php/login_template.php');
    session_start();

    $template=carrega_template(TPL_LOGIN);
    $html = $template;
    $mensagem=html_mensagem_aside();
    $html=str_ireplace('<!-- mensagem -->',$mensagem,$html);
    $form = html_form_login();
    $html=str_ireplace('<!-- conteudo -->',$form,$html);
    if(isset($_SESSION['loginErro'])){
        $erro = html_login_error();
        $html=str_ireplace('<!-- mensagem erro -->',$erro,$html);
    }

    unset($_SESSION['loginErro']);
    echo $html;

?>

