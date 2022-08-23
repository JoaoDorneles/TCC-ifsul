<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../php/cadastro_aluno_template.php');
require_once ('../class/usuario.php');

$id_curso=$_REQUEST['curso'];
$option_curriculo=json_form_select_options_curriculos($id_curso);
echo $option_curriculo;

?>