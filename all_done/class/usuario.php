<?php

class Usuario{

    function bd_insert_usuario($nome,$email,$senha){
        global $objConexao;
        $id=0;
        $sql = "INSERT INTO usuario(nome, usuario, senha) VALUES(?,?,?)";

        $parametros = array('sss',$nome,$email, $senha);

        $result=$objConexao->execSQL($sql,$parametros,true);

        if($result['insert_id']){
            $id=$result['insert_id'];
        }
        return $id;
    }

    function bd_insert_aluno($matricula, $id_curso_curriculo, $id_usuario){
        // inserção não está completa, duvida sobre id_atividades_comp
        global $objConexao;
        $id=0;
        $sql = "INSERT INTO aluno(id_usuario, id_curso_curriculo, matricula) VALUES(?,?,?)";

        $parametros = array('iis',$id_usuario,$id_curso_curriculo, $matricula);

        $result=$objConexao->execSQL($sql,$parametros,true);

        if($result['insert_id']){
            $id=$result['insert_id'];
        }
        return $id;
    }

    function bd_insert_usuario_perfil($id_usuario,$id_perfil){
        global $objConexao;
        $sucesso=0;
        $sql = "INSERT INTO usuario_perfil (id_usuario, id_perfil) VALUES(?,?)";

        $parametros = array('ii',$id_usuario,$id_perfil);

        $result=$objConexao->execSQL($sql,$parametros,true);

        if($result['affected_rows']){
            $sucesso=$result['affected_rows'];
        }
        return $sucesso;
    }

    function bd_insert_aluno_perfil_aluno($matricula, $id_curso_curriculo, $id_usuario,$id_perfil){

        $insert_aluno = $this->bd_insert_aluno($matricula, $id_curso_curriculo, $id_usuario);
        $insert_perfil_aluno = $this->bd_insert_usuario_perfil($id_usuario,$id_perfil);

        if(!($insert_aluno) || !($insert_perfil_aluno)){
            return 0;
        }else{
            return 1;
        }
    }


    function bd_delete_usuario_perfil($id_usuario,$id_perfil){
        global $objConexao;

        $sql="DELETE FROM `usuario_perfil` WHERE `id_usuario` = ? AND `id_perfil` = ?";

        $parametros = array('ii',$id_usuario,$id_perfil);

        $result=$objConexao->execSQL($sql,$parametros,true);

        return $result['affected_rows'];
    }

    function bd_delete_aluno($id_usuario){
        global $objConexao;

        $sql="DELETE FROM `aluno` WHERE `id_usuario` = ? ";

        $parametros = array('i',$id_usuario);

        $result=$objConexao->execSQL($sql,$parametros,true);


        return $result['affected_rows'];
    }

    function bd_delete_usuario($id_usuario){
        global $objConexao;

        $sql="DELETE FROM `usuario` WHERE `id_usuario` = ? ";

        $parametros = array('i',$id_usuario);

        $result=$objConexao->execSQL($sql,$parametros,true);


        return $result['affected_rows'];
    }

    function bd_delete_perfis_usuario($id_usuario){
        global $objConexao;

        $sql="DELETE FROM `usuario_perfil` WHERE `id_usuario` = ?";

        $parametros = array('i',$id_usuario);

        $result=$objConexao->execSQL($sql,$parametros,true);


        return $result['affected_rows'];
    }


    function bd_delete_atividade_comp_by_id_usuario($id_usuario){
        global $objConexao;

        $sql = "DELETE FROM atividade_comp WHERE id_usuario = ? ";

        $parametros = array('i',$id_usuario);

        $result=$objConexao->execSQL($sql,$parametros,true);


        return $result['affected_rows'];
    }


    function bd_delete_atividade_comp_usuario_by_id_usuario_da_atividade($id_usuario){
        global $objConexao;

        $sql = "DELETE FROM atividade_comp_usuario WHERE id_atividade_comp in(select id_atividade_comp from atividade_comp where id_usuario = ?) ";

        $parametros = array('i',$id_usuario);

        $result=$objConexao->execSQL($sql,$parametros,true);

        return $result['affected_rows'];
    }

    function bd_delete_usuario_perfis_usuario($id_usuario){

        $del_atv_usuario=$this->bd_delete_atividade_comp_usuario_by_id_usuario_da_atividade($id_usuario);
        $del_atv_comp=$this->bd_delete_atividade_comp_by_id_usuario($id_usuario);
        $del_aluno=$this->bd_delete_aluno($id_usuario);
        $del_perfis=$this->bd_delete_perfis_usuario($id_usuario);
        $del_usuario=$this->bd_delete_usuario($id_usuario);

        if($del_atv_usuario<0 || $del_atv_comp<0 || $del_aluno<0 || $del_usuario<0 || $del_perfis<0){
            return 0;
        }else{
            return 1;
        }
    }

    function bd_delete_aluno_usuario_perfil($id_usuario,$id_perfil){
        global $objConexao;

        $sql="DELETE FROM `aluno` WHERE `id_usuario` = ? ";

        $parametros = array('i',$id_usuario);

        $result=$objConexao->execSQL($sql,$parametros,true);


        return $result['affected_rows'];
    }

    function bd_select_usuario_login($email, $senha){
        global $objConexao;
        $sql = "SELECT
                    u.id_usuario,
                    u.nome,
                    u.senha,
                    IFNULL (up.aluno,0) as aluno,
                    IFNULL (up.cordenador,0) as coordenador,
                    IFNULL (up.secretaria,0) as secretaria,
                    IFNULL (up.adm,0) as adm
                FROM
                        `usuario` as u
                    LEFT JOIN
                        `view_usuario_perfis` as up
                    ON
                        u.id_usuario = up.id_usuario
                    WHERE
                        u.usuario = ?";

        $parametros = array('s', $email);

        if ($registros = $objConexao->executa_consulta_sql($sql,$parametros)) {
            if (password_verify($senha, $registros[0]['senha'])) {

                $retorno['id_usuario'] = $registros[0]['id_usuario'];
                $retorno['nome_usuario']= $registros[0]['nome'];
                $retorno['admin']= $registros[0]['adm'];
                $retorno['coordenador']= $registros[0]['coordenador'];
                $retorno['secretaria']= $registros[0]['secretaria'];
                $retorno['aluno']= $registros[0]['aluno'];

            }
        }
        return $retorno;
    }

    function bd_select_usuarios(){
        global $objConexao;
        $sql = "SELECT
                    id_usuario,
                    nome
                FROM
                        `usuario`";

        return $objConexao->executa_consulta_sql($sql,array());
    }

    function bd_select_perfis(){
        global $objConexao;
        $sql = "SELECT
                    id_perfil,
                    descricao
                FROM
                        `perfil`";

        return $objConexao->executa_consulta_sql($sql,array());
    }

    function bd_select_cursos(){
        // select de cursos incompleto, duvida sobre parâmetros
        global $objConexao;

        $sql = "SELECT c.id_curso, c.nome_curso FROM `curso` as c";

        return $objConexao->executa_consulta_sql($sql,array());
    }

    function bd_select_curriculos($id_curso){
        // select de curriculos do curso selecionado, duvida de como puxar o curso selecionado para referenciar no curriculo
        global $objConexao;

        $sql = "SELECT
                    cc.id_curso_curriculo, cc.curriculo
                FROM
                    curso_curriculo as cc
                LEFT JOIN
                    curso as c
                    ON
                    cc.id_curso=c.id_curso
                WHERE
                    cc.id_curso=?";

        $parametros = array('i', $id_curso);

        return $objConexao->executa_consulta_sql($sql,$parametros);
    }

    function bd_select_aluno($id_usuario){
        global $objConexao;

        $sql = "SELECT
                    a.id_aluno,
                    a.matricula,
                    a.id_curso_curriculo
                FROM
                    aluno as a
                LEFT JOIN
                    usuario as u
                    ON
                        a.id_usuario=u.id_usuario
                WHERE
                    a.id_usuario=?";

        $parametros = array('i', $id_usuario);

        return $objConexao->executa_consulta_sql($sql,$parametros);
    }

    function bd_select_id_usuario_by_id_atividade($id_atividade_comp){
        global $objConexao;

        $sql = "SELECT
                    u.id_usuario
                FROM
                    usuario as u
                LEFT JOIN
                    aluno as a
                ON
                    a.id_usuario=u.id_usuario
                LEFT JOIN
                    atividade_comp as ac
                    ON
                        a.id_usuario=ac.id_usuario
                WHERE
                    ac.id_atividade_comp=?";

        $parametros = array('i', $id_atividade_comp);

        return $objConexao->executa_consulta_sql($sql,$parametros);
    }

    function bd_select_usuario_by_id($id_usuario){
        global $objConexao;

        $sql = "SELECT
                    u.nome
                FROM
                    usuario as u
                WHERE
                    u.id_usuario=?";

        $parametros = array('i', $id_usuario);

        return $objConexao->executa_consulta_sql($sql,$parametros);
    }

    function bd_select_todos_alunos(){
        global $objConexao;

        $sql = "SELECT
                    u.nome,
                    u.id_usuario,
                    a.id_aluno,
                    a.matricula,
                    cc.curriculo,
                    c.nome_curso
                FROM
                    aluno as a
                LEFT JOIN
                    usuario as u
                        ON
                            u.id_usuario=a.id_usuario
                LEFT JOIN
                    curso_curriculo as cc
                        ON
                            a.id_curso_curriculo=cc.id_curso_curriculo
                LEFT JOIN
                	curso as c
                        ON
                    	    cc.id_curso=c.id_curso";

        return $objConexao->executa_consulta_sql($sql,array());
    }

/*     function bd_select_todos_alunos_deferidos(){
        global $objConexao;

        $sql = "SELECT
                    u.nome,
                    u.id_usuario,
                    a.id_aluno,
                    a.matricula,
                    cc.curriculo,
                    c.nome_curso
                FROM
                    aluno as a
                LEFT JOIN
                    usuario as u
                        ON
                            u.id_usuario=a.id_usuario
                LEFT JOIN
                    curso_curriculo as cc
                        ON
                            a.id_curso_curriculo=cc.id_curso_curriculo
                LEFT JOIN
                	curso as c
                        ON
                    	    cc.id_curso=c.id_curso";

        return $objConexao->executa_consulta_sql($sql,array());
    }
 */
    function html_msg_aside_tipo_atividade_form(){
        $html="<h2>Adicione um atividade válida<br></h2><p class='text-white-50'>Atribua uma atividade nova a algum currículo da instituição, para que seja válido no certificado.</p>";
        return $html;
    }

    function html_form_tipo_atividade(){

        $html="<form id='tipoAtividadeForm' action='../php/tipo_atividade_cadastro.php' method='POST'>

        <div class='form-group'>
            <label>Currículo</label>
            <select id='curriculo' class='form-select border border-dark' name='curriculo'>
                <option hidden>Selecione</option>
                <!-- option-curriculo -->
            </select>
        </div>

        <div class='form-group'>
            <label>Tipo de Atividade</label>
            <input id='tipo_atividade' type='text' class='form-control border border-dark' placeholder='Nome da Atividade' name='tipo_atividade'>
        </div>

        <div class='form-group'>
            <label>Hora Máxima</label>
            <input id='hora_max' type='text' class='form-control border border-dark' placeholder='Máx' name='hora_max'>
        </div>

        <div class='form-group'>
            <label>Hora Mínima</label>
            <input id='hora_min' type='text' class='form-control border border-dark' placeholder='Min' name='hora_min'>
        </div>

        <button type='submit' class='btn btn-primary' value='enviar' name='Enviar'>Cadastrar</button>
        <a class='btn btn-outline-dark ' href='../php/landingpage.php'>Voltar</a>

        </form>
        <script src='../js/validacao.js'></script>";

        return $html;

    }


    function html_form_msgErro_tipo_atividade_form(){
        $msg=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION['errTipoAtv'])?$_SESSION['errTipoAtv']:"").'
                    </div>
                </div>';

        return $msg;
    }

    function html_form_msgEnvio_tipo_atividade_form(){
        $msgE=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>

                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION['envTipoAtv'])?$_SESSION['envTipoAtv']:"").'
                    </div>
                </div>';

        return $msgE;
    }

    function html_msg_aside_alterna_perfil(){
        $html="<h2>Adiciona Perfil<br></h2><p class='text-white-50'>Atribua um perfil ao usuário.</p>";
        return $html;
    }

    function html_form_alterar_usuario(){

        $id_usuario = filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);
        $dados_usuario=$this->bd_select_usuario_by_id($id_usuario);

        $html="<form id='formAlterna_usuario' action='../php/admin_alterar_usuario.php' method='POST'>

        <div class='form-group'>
            <label>Usuário</label>
            <select id='id_usuario' class='form-select border border-dark' name='id_usuario'>";
        foreach($dados_usuario as $du){
            $html.="<option value='". $id_usuario ."'>". $id_usuario ." - ". $du['nome'] ."</option>";
        }
        $html.="<!-- option-usuario -->
            </select>
        </div>

        <div class='form-group'>
            <label>Perfil</label>
            <select id='id_perfil' class='form-select border border-dark' name='id_perfil'>
                <option hidden>Selecione</option>
                <!-- option-perfil -->
            </select>
        </div>

        <button type='submit' class='btn btn-primary' value='enviar' name='Enviar'>Cadastrar</button>
        <a class='btn btn-outline-dark ' href='../php/lista_usuario.php'>Voltar</a>

        </form>";

        return $html;

    }

    /* <button class='btn btn-danger' href='exclui_perfil.php?id_usuario=".$id_usuario."&id_perfil='>Excluir</button> */

    function html_form_msgErro(){

        $msg=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION['errUsuPer'])?$_SESSION['errUsuPer']:"").'
                    </div>
                </div>';

        return $msg;
    }

    function html_form_msgEnvio(){

        $msgE=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>

                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION['envUsuPer'])?$_SESSION['envUsuPer']:"").'
                    </div>
                </div>';

        return $msgE;
    }

    function html_option_usuarios(){
        $registros=$this->bd_select_usuarios();
        $html = '';
        foreach($registros as $registro ){
            $html.="<option title='". $registro['nome'] ."' value='" . $registro['id_usuario'] ."'> ". $registro['id_usuario'] . " - " . $registro['nome'] ."</option>\n";
        }
        return $html;
    }

    function html_option_perfis(){
        $registros=$this->bd_select_perfis();
        $html = '';
        foreach($registros as $registro ){
            $html.="<option title='". $registro['descricao'] ."' value='" . $registro['id_perfil'] ."'> ". $registro['id_perfil'] . " - " . $registro['descricao'] ."</option>\n";
        }
        return $html;
    }




    function html_lista_usuario(){
        global $objConexao;
        $lista="
        <table class='table table-striped table-dark'>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Usuário</th>
                <th>Excluir</th>
                <th>Perfil</th>
            </tr>";

        $sql = "SELECT * FROM usuario";
        $parametros = array();
        $registros = $objConexao->executa_consulta_sql($sql,$parametros);

        foreach($registros as $registro ){
            $id=$registro['id_usuario'];
            $nome=$registro['nome'];
            $usuario=$registro['usuario'];
            $lista.= "<tr>";
            $lista.=  "<td> $id </td>";
            $lista.=  "<td> $nome </td>";
            $lista.=  "<td> $usuario </td>";
            $lista.=  "<td> <a class='linkVoltar' href='exclui_usuario.php?id_usuario=".$registro['id_usuario']."'><i class='bi bi-trash'></i></a></td>";
            $lista.=  "<td> <a class='linkVoltar' href='admin_alterar_usuario_form.php?id_usuario=".$registro['id_usuario']."'><i class='bi bi-pencil-square'></i></a></td>";
            $lista.=  "</tr>";
        }

        $lista.= "</table>";

        return $lista;
    }

    function html_form_msgErro_exclusao_usuario(){
        $msg=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION['msgErroExclusaoUsu'])?$_SESSION['msgErroExclusaoUsu']:"").'
                    </div>
                </div>';

        return $msg;
    }

    function html_form_msgSucesso_exclusao_usuario(){
        $msgE=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>

                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION['msgSucessoExclusaoUsu'])?$_SESSION['msgSucessoExclusaoUsu']:"").'
                    </div>
                </div>';

        return $msgE;
    }


    function html_form_msgErro_exclusao_perfil(){
        $msg=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION['msgErroExclusaoPer'])?$_SESSION['msgErroExclusaoPer']:"").'
                    </div>
                </div>';

        return $msg;
    }

    function html_form_msgSucesso_exclusao_perfil(){
        $msgE=' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>

                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION['msgSucessoExclusaoPer'])?$_SESSION['msgSucessoExclusaoPer']:"").'
                    </div>
                </div>';

        return $msgE;
    }
}

?>