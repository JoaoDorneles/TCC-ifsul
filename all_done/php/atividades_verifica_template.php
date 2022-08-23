<?php




function html_form_msg_erro_exclusao(){

    $msgE='<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>

            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                '.(isset($_SESSION["msgErroExclusao"])?$_SESSION["msgErroExclusao"]:"").'
                </div>
            </div>';

    return $msgE;
}

function html_form_msg_sucesso_exclusao(){

    $msg='  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>

            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                '.(isset($_SESSION["msgSucessoExclusao"])?$_SESSION["msgSucessoExclusao"]:"").'
                </div>
            </div>';

    return $msg;
}

function html_mensagem_aside(){
    $mensagem="<h2>Suas Atividades<br></h2><p class='text-white-50'>Verifique a avaliação das atividades, modifique ou exclua.</p>";
    return $mensagem;
}


function html_verifica_atividade(){

    $atividades = new Atividades_comp;

    $registros = $atividades->bd_select_atividades_aluno($_SESSION['id_usuario']);

    $html='';
    foreach($registros as $registro ){

        $nome_certificado=substr($registro['doc_compro'],0,28);
        if(strlen($nome_certificado)<strlen($registro['doc_compro'])){
            $nome_certificado.='...';
        }

        $link=substr($registro['mecanismo'],0,23);
        if(strlen($link)<strlen($registro['mecanismo'])){
            $link.='...';
        }

        $html.="<div class='row'>
                    <div class='col-sm-12'>
                        <div class='card cardShadow'>
                        <div class='card-body'>
                            <h4 class='card-title'><strong class='strongPreto'>". $registro['desc_atividade'] ."</strong></h4>
                            <p class='card-text'><strong class='strongCinza'>Carga Horária Requerida:</strong> ".$registro['carga_hor_comp']."h</p>
                            <p title='". $registro['doc_compro'] ."' class='card-text'><strong class='strongCinza'>Certificado:</strong> ".$nome_certificado." <a class='linkIcon' target='_blank' href='certificados/".$registro['nome_arquivo']."'><i class='bi bi-file-earmark-fill'></i></a></p>
                            <p class='card-text'><strong class='strongCinza'>Veracidade do Certificado:</strong> ".$link."<a target='_blank' href='".$registro['mecanismo']."'><i class='bi bi-link-45deg'></i></a></p>";
                            if($registro['avaliacao']=='Pendente'){
                                $html.="<p class='card-text'><strong class='strongCinza'>Avaliação:</strong> <strong class='atividadePendente'>".$registro['avaliacao']."</strong></p>
                                        <a href='atividades_form_edita.php?id_atividade_comp=".$registro['id_atividade_comp']."' class='btn btn-secondary'>Editar</a>
                                        <a href='atividades_exclui.php?id_atividade_comp=".$registro['id_atividade_comp']."' class='btn btn-danger'>Excluir</a>";
                            }elseif($registro['avaliacao']=='Concluída'){
                                $html.=" <p class='card-text'><strong class='strongCinza'>Avaliação:</strong> <strong class='atividadeDeferida'>".$registro['avaliacao']."</strong></p>";
                            }else{
                                $html.="<p class='card-text'><strong class='strongCinza'>Avaliação:</strong> <strong class='atividadeIndeferida'>".$registro['avaliacao']."</strong></p>";
                                if(!(empty($registro['comentario']))){
                                    $html.=" <p class='card-text'><strong class='strongCinza'>Comentário:</strong> ".$registro['comentario']."</p>";
                                }
                                $html.="<a href='atividades_form_edita.php?id_atividade_comp=".$registro['id_atividade_comp']."' class='btn btn-secondary'>Editar</a>
                                        <a href='atividades_exclui.php?id_atividade_comp=".$registro['id_atividade_comp']."' class='btn btn-danger'>Excluir</a>";
                            }
        $html.="
                        </div>
                        </div>
                    </div>
                </div><br>";
    }
    return $html;
}
?>