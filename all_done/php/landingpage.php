<?php
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../php/landingpage_template.php');
require_once ('../class/sistema.php');
session_start();

$template=carrega_template(TPL_LANDING);
$html = $template;

$nav=html_conteudo_nav();
$html=str_ireplace('<!-- conteudo nav -->',$nav,$html);

if(isset($_SESSION['id_usuario'])){

    $boas_vindas=Sistema::html_sidenav();
    $html=str_ireplace('<!-- boas vindas -->',$boas_vindas,$html);

    $frase_central=html_frase_central();
    $html=str_ireplace('<!-- frase central -->',$frase_central,$html);

}else{
    $frase_central=html_frase_central_deslogado();
    $html=str_ireplace('<!-- frase central -->',$frase_central,$html);
}

$conteudo_central=html_conteudo_central();
$html=str_ireplace('<!-- conteudo central -->',$conteudo_central,$html);

echo $html;
?>
