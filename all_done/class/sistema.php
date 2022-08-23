<?php
class Sistema{

    static function html_sidenav(){
        $boas_vindas="<p class='boasVindas'> Olá, " .$_SESSION['nome_usuario']. "</p>";
        return $boas_vindas;
    }

    static function html_sidenav_lista_usuario(){
        $boas_vindas="<h2>Lista de Usuários<br></h2><p class='text-white-50'>Veja todos usuários que estão cadastrados no sistema.</p>";
        return $boas_vindas;
    }

    static function html_msg_sem_cadastro(){
        $msg_restrito="
                <div class='row'>
                    <div class='col-sm-12'>
                        <div class='card cardShadow'>
                        <div class='card-body'>
                            <h3 class='card-title'><strong class='strongPreto'>Sem Cadastro</strong></h3>
                            <p class='card-text'><strong class='strongCinza'>Você não está cadastrado no sistema</strong></p>
                        </div>
                        </div>
                    </div>
                </div>
        ";
        return $msg_restrito;
    }

    static function html_msg_acesso_restrito(){
        $msg_restrito="
                <div class='row'>
                    <div class='col-sm-12'>
                        <div class='card cardShadow'>
                        <div class='card-body'>
                            <h3 class='card-title'><strong class='strongPreto'>Acesso Restrito</strong></h3>
                            <p class='card-text'><strong class='strongCinza'>Este conteúdo é restrito ao administrador</strong></p>
                        </div>
                        </div>
                    </div>
                </div>
        ";
        return $msg_restrito;
    }


    static function html_msg_conteudo_aluno(){
        $msg_restrito="
                <div class='row'>
                    <div class='col-sm-12'>
                        <div class='card cardShadow'>
                        <div class='card-body'>
                            <h3 class='card-title'><strong class='strongPreto'>Conteúdo Indisponível</strong></h3>
                            <p class='card-text'><strong class='strongCinza'>Você não esta cadastrado como aluno. Cadastre-se <a href='../php/cadastro_aluno_form.php'>Aqui.</a></strong></p>
                        </div>
                        </div>
                    </div>
                </div>
        ";

        return $msg_restrito;
    }

    static function html_msg_conteudo_aluno_ja_cadastrado(){
        $msg_restrito="
                <div class='row'>
                    <div class='col-sm-12'>
                        <div class='card cardShadow'>
                        <div class='card-body'>
                            <h3 class='card-title'><strong class='strongPreto'>Atenção</strong></h3>
                            <p class='card-text'><strong class='strongCinza'>Você está cadastrado como aluno.</strong></p>
                        </div>
                        </div>
                    </div>
                </div>
        ";

        return $msg_restrito;
    }

    static function html_msg_conteudo_secretaria(){
        $msg_restrito="
                <div class='row'>
                    <div class='col-sm-12'>
                        <div class='card cardShadow'>
                        <div class='card-body'>
                            <h3 class='card-title'><strong class='strongPreto'>Conteúdo Restrito</strong></h3>
                            <p class='card-text'><strong class='strongCinza'>Este conteúdo é restrito a secretaria</strong></p>
                        </div>
                        </div>
                    </div>
                </div>
        ";

        return $msg_restrito;
    }

    static function html_msg_conteudo_coordenador(){
        $msg_restrito="
                <div class='row'>
                    <div class='col-sm-12'>
                        <div class='card cardShadow'>
                        <div class='card-body'>
                            <h3 class='card-title'><strong class='strongPreto'>Conteúdo Restrito</strong></h3>
                            <p class='card-text'><strong class='strongCinza'>Este conteúdo é restrito ao coordenador</strong></p>
                        </div>
                        </div>
                    </div>
                </div>
        ";

        return $msg_restrito;
    }

    static function html_msg_conteudo__atividades_verifica_vazio(){
        $msg_vazio="
                <div class='row'>
                    <div class='col-sm-12'>
                        <div class='card cardShadow'>
                        <div class='card-body'>
                            <h3 class='card-title'><strong class='strongPreto'>Você não possui atividades</strong></h3>
                            <p class='card-text'><strong class='strongCinza'>Para cadastrar <a href='../php/atividades_form.php'>Clique Aqui</a></strong></p>
                        </div>
                        </div>
                    </div>
                </div>
        ";

        return $msg_vazio;
    }

    static function html_msg_conteudo__atividades_avalia_vazio(){
        $msg_vazio="
                <div class='row'>
                    <div class='col-sm-12'>
                        <div class='card cardShadow'>
                        <div class='card-body'>
                            <h3 class='card-title'><strong class='strongPreto'>Sem Registros</strong></h3>
                            <p class='card-text'><strong class='strongCinza'>Este aluno não possui atividades complementares para avaliação</strong></p>
                        </div>
                        </div>
                    </div>
                </div>
        ";

        return $msg_vazio;
    }

    static function html_msg_conteudo_verifica_atividades_deferidas_vazio(){
        $msg_vazio="
                <div class='row'>
                    <div class='col-sm-12'>
                        <div class='card cardShadow'>
                        <div class='card-body'>
                            <h3 class='card-title'><strong class='strongPreto'>Sem Registros</strong></h3>
                            <p class='card-text'><strong class='strongCinza'>Este aluno não possui nenhum deferimento</strong></p>
                        </div>
                        </div>
                    </div>
                </div>
        ";

        return $msg_vazio;
    }

    static function html_titulo_conteudo_atividades(){
        $titulo_conteudo = "Atividades - ". $_SESSION['nome_usuario'] ." <svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-caret-down-fill' viewBox='0 0 16 16'>
        <path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg></i>";
        return $titulo_conteudo;
    }

    static function html_titulo_conteudo_alunos(){
        $titulo_conteudo = "Alunos <svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='currentColor' class='bi bi-caret-down-fill' viewBox='0 0 16 16'>
        <path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg></i>";
        return $titulo_conteudo;
    }

    static function link_voltar_pagina_landingpage(){
        $link=' <a class="linkVoltar" href="../php/landingpage.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
                    </svg>
                </a>';
        return $link;
    }

}
?>


