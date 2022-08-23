<?php
require_once('../class/conecta.php');
require_once('../include/sessao.php');
require_once('../include/funcoes.php');
require_once('../include/config.php');
require_once('../class/curso.php');
require_once('../class/usuario.php');
require_once('../class/sistema.php');
$curso= new Curso;
$usuario = new Usuario;

if($_SESSION['admin']==1){

    $template=carrega_template(TPL_LOGIN);
    $html = $template;

    $msg = $usuario->html_msg_aside_tipo_atividade_form();
    $html=str_ireplace('<!-- mensagem -->',$msg,$html);

    $form = $usuario->html_form_tipo_atividade();
    $html=str_ireplace('<!-- conteudo -->',$form,$html);

    $option_curso=$curso->html_form_select_options_curriculo();
    $html=str_ireplace('<!-- option-curriculo -->',$option_curso,$html);

    if(isset($_SESSION['errTipoAtv'])){
        $msgE = $usuario->html_form_msgErro_tipo_atividade_form();
        $html=str_ireplace('<!-- mensagem erro -->',$msgE,$html);
    }
    if(isset($_SESSION['envTipoAtv'])){
        $msg = $usuario->html_form_msgEnvio_tipo_atividade_form();
        $html=str_ireplace('<!-- mensagem erro -->',$msg,$html);
    }
    unset($_SESSION['errTipoAtv']);
    unset($_SESSION['envTipoAtv']);

}else{
    $restrito=Sistema::html_msg_acesso_restrito();
    $html=str_ireplace('<!-- conteudo -->',$restrito,$html);
}

echo $html;

?>