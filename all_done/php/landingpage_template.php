<?php

function html_conteudo_nav(){

    $nav='';

    if(isset($_SESSION['aluno']) && $_SESSION['aluno']==1){
        $nav.="
        <li class='nav-item'><a class='nav-link' href='../php/atividades_form.php'> <i class='bi bi-file-earmark-plus-fill'></i> Cadastro de Atividades</a></li>
        <li class='nav-item'><a class='nav-link' href='../php/atividades_verifica.php'><i class='bi bi-file-earmark-medical-fill'></i> Certificados do Aluno</a></li>
        ";
    }

    if(isset($_SESSION['coordenador']) && $_SESSION['coordenador']==1){
        $nav.="
        <li class='nav-item'><a class='nav-link' href='../php/atividades_avaliacao.php'><i class='bi bi-file-earmark-diff-fill'></i> Avaliar Atividades</a></li>
        ";
    }

    if(isset($_SESSION['admin']) && $_SESSION['admin']==1){
        $nav.="
        <li class='nav-item'><a class='nav-link' href='../php/curso_form.php'><i class='bi bi-pencil-square'></i> Cadastro de Cursos</a></li>
        <li class='nav-item'><a class='nav-link' href='../php/curriculo_form.php'><i class='bi bi-pencil-square'></i> Cadastro de Currículos</a></li>
        <li class='nav-item'><a class='nav-link' href='../php/tipo_atividade_cadastro_form.php'><i class='bi bi-pencil-square'></i> Cadastro de Atividades Válidas</a></li>
        <li class='nav-item'><a class='nav-link' href='../php/lista_usuario.php'><i class='bi bi-people-fill'></i> Lista Usuários</a></li>
        <li class='nav-item'><a class='nav-link' href='../php/cadastro_usuario_form.php'><i class='bi bi-person-plus-fill'></i> Cadastro de Usuário</a></li>
        ";
    }

    if(isset($_SESSION['secretaria']) && $_SESSION['secretaria']==1){
        $nav.="
        <li class='nav-item'><a class='nav-link' href='../php/lista_alunos.php'><i class='bi bi-people-fill'></i> Lista de Alunos</a></li>
        ";
    }

    if(isset($_SESSION['id_usuario'])){
        $nav.="
        <li class='nav-item'><a class='nav-link' href='../php/logout.php'>Sair <i class='bi bi-box-arrow-right'></i></a></li>";
    }else{
        $nav="
        <li class='nav-item '><a class='nav-link' href='../php/cadastro_usuario_form.php'><i class='bi bi-pencil-square'></i> Cadastre-se</a></li>
        <li class='nav-item '><a class='nav-link' href='../php/login_form.php'><i class='bi bi-door-open-fill'></i> Login</a></li>";
    }
    return $nav;

}

function html_conteudo_central(){

    $conteudo_central='';

    if(isset($_SESSION['id_usuario'])){
        $conteudo_central.="    <div class='container px-5 my-5'>
                                    <div class='row gx-5'>
                                        <div class='col-lg-4 mb-5 mb-lg-0'>
                                            <div class='feature bg-primary bg-gradient text-white rounded-3 mb-3'><i class='bi bi-person-circle'></i></div>
                                            <h2 class='h4 fw-bolder'>Torne-se aluno</h2>
                                            <p>Para cadastrar suas atividades complementares você precisa se cadastrar como aluno.</p>
                                            <a class='text-decoration-none' href='../php/cadastro_aluno_form.php'>
                                                Cadastre-se aqui
                                                <i class='bi bi-arrow-right'></i>
                                            </a>
                                        </div>
                                        <div class='col-lg-4 mb-5 mb-lg-0'>
                                            <div class='feature bg-primary bg-gradient text-white rounded-3 mb-3'><i class='bi bi-folder-plus'></i></div>
                                            <h2 class='h4 fw-bolder'>Atividades Complementares</h2>
                                            <p>Apresente o certificado da atividade realizada, com as informações requeridas no formulário, e aguarde a avaliação.</p>
                                            <a class='text-decoration-none' href='../php/atividades_form.php'>
                                                Cadastre suas atividadades aqui
                                                <i class='bi bi-arrow-right'></i>
                                            </a>
                                        </div>
                                        <div class='col-lg-4'>
                                            <div class='feature bg-primary bg-gradient text-white rounded-3 mb-3'><i class='bi bi-folder2-open'></i></div>
                                            <h2 class='h4 fw-bolder'>Verificar status das atividades</h2>
                                            <p>Verifique o status de suas atividades complementares avaliadas pelo coordenador.</p>
                                            <a class='text-decoration-none' href='../php/atividades_verifica.php'>
                                                Verifique suas atividades aqui
                                                <i class='bi bi-arrow-right'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>";
    }else{
        $conteudo_central.="    <div class='container px-5 my-5'>
                                    <div class='row gx-5'>
                                        <div class='col-lg-4 mb-5 mb-lg-0'>
                                            <div class='feature bg-primary bg-gradient text-white rounded-3 mb-3'><i class='bi bi-person-circle'></i></div>
                                            <h2 class='h4 fw-bolder'>Torne-se aluno</h2>
                                            <p>Para cadastrar suas atividades complementares você precisa se cadastrar como aluno.</p>
                                        </div>
                                        <div class='col-lg-4 mb-5 mb-lg-0'>
                                            <div class='feature bg-primary bg-gradient text-white rounded-3 mb-3'><i class='bi bi-folder-plus'></i></div>
                                            <h2 class='h4 fw-bolder'>Atividades Complementares</h2>
                                            <p>Apresente o certificado da atividade realizada, com as informações requeridas no formulário, e aguarde a avaliação.</p>
                                        </div>
                                        <div class='col-lg-4'>
                                            <div class='feature bg-primary bg-gradient text-white rounded-3 mb-3'><i class='bi bi-folder2-open'></i></div>
                                            <h2 class='h4 fw-bolder'>Verificar status das atividades</h2>
                                            <p>Verifique o status de suas atividades complementares avaliadas pelo coordenador.</p>
                                        </div>
                                    </div>
                                </div>";

    }

    return $conteudo_central;

}



function html_frase_central(){

    $frase_central=" <h1 class='display-5 fw-bolder text-white mb-2'>Seja Bem-Vindo</h1>
    <p class='lead text-white-50 '>ao Sistema de Apresentação e Avaliação de Horas Complementares!</p>";

    return $frase_central;
}

function html_frase_central_deslogado(){

    $frase_central=" <h1 class='display-5 fw-bolder text-white mb-2'>All Done</h1>
    <p class='lead text-white-50 '>Sistema de Apresentação e Avaliação de Horas Complementares!</p>";

    return $frase_central;

}

?>