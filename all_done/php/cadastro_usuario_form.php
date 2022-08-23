<?php
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../php/cadastro_usuario_template.php');
session_start();

$template=carrega_template(TPL_LOGIN);
$html = $template;

$mensagem=html_mensagem_aside();
$html=str_ireplace('<!-- mensagem -->',$mensagem,$html);
$form = html_form_cadastro_usuario();
$html=str_ireplace('<!-- conteudo -->',$form,$html);

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
echo $html;


?>