<?php
require_once ('../include/sessao.php');
require_once ('../class/conecta.php');
require_once ('../include/config.php');
require_once ('../include/funcoes.php');
require_once ('../class/usuario.php');
require_once ('../class/sistema.php');
require_once ('../class/atividades_comp.php');
$atividades = new Atividades_comp;

if(isset($_POST['id_tipo_atividade'])){

    $id_usuario=$_SESSION['id_usuario'];
    $id_tipo_atividade=filter_input(INPUT_POST, 'id_tipo_atividade', FILTER_SANITIZE_NUMBER_INT);
    $cargaHorariaAdicional=filter_input(INPUT_POST, 'cargaH', FILTER_SANITIZE_NUMBER_INT);
    $limite=filter_input(INPUT_POST, 'limite', FILTER_SANITIZE_NUMBER_INT);

    $somaDasCargasRegistradas=$atividades->bd_select_total_tipo_atividade_usuario($id_usuario, $id_tipo_atividade);

    $somaCargaRegistradaInt=$somaDasCargasRegistradas[0]['total'];

    $somaTodasCargasHorarias=$cargaHorariaAdicional+$somaCargaRegistradaInt;

    if($somaTodasCargasHorarias<=$limite){
        echo 'true';
    }else{
        echo 'false';
    }

}else{
    echo 'false';
}
?>