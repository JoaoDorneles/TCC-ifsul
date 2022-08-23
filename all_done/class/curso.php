<?php

class Curso{

    function bd_insert_curso($nome_curso){
        global $objConexao;
        $id=0;
        $sql = "INSERT INTO curso(nome_curso) VALUES(?)";

        $parametros = array('s',$nome_curso);

        $result=$objConexao->execSQL($sql,$parametros,true);

        if($result['insert_id']){
            $id=$result['insert_id'];
        }
        return $id;

    }

    function bd_insert_curriculo($id_curso, $curriculo, $data_inicio, $data_termino){
        global $objConexao;
        $id=0;
        $sql = "INSERT INTO curso_curriculo(id_curso,curriculo,data_ingresso,data_termino) VALUES(?,?,?,?)";

        $parametros = array('isss',$id_curso,$curriculo,$data_inicio,$data_termino);

        $result=$objConexao->execSQL($sql,$parametros,true);

        if($result['insert_id']){
            $id=$result['insert_id'];
        }
        return $id;

    }

    function bd_delete_curriculo($id_curso_curriculo){
        global $objConexao;

        $sql = "DELETE FROM curso_curriculo WHERE id_curso_curriculo = ? ";

        $parametros = array('i',$id_atividade_comp);

        $result=$objConexao->execSQL($sql,$parametros,true);


        return $result['affected_rows'];

    }

    function bd_delete_curso($id_curso){
        global $objConexao;

        $sql = "DELETE FROM curso WHERE id_curso = ? ";

        $parametros = array('i',$id_atividade_comp);

        $result=$objConexao->execSQL($sql,$parametros,true);


        return $result['affected_rows'];

    }

    function bd_select_curriculos(){
        global $objConexao;

        $sql = "SELECT cc.id_curso_curriculo, cc.curriculo FROM curso_curriculo as cc ";

        $parametros = array();

        return $objConexao->executa_consulta_sql($sql,$parametros);

    }

    function html_form_select_options_curriculo(){

        $registros=$this->bd_select_curriculos();
        $html = '';
        foreach($registros as $registro ){
            $html.="<option title='". $registro['curriculo'] ."' value='" . $registro['id_curso_curriculo'] ."'> ". $registro['id_curso_curriculo'] ." - " . $registro['curriculo'] ."</option>\n";
        }
        return $html;

    }

    function html_form_select_options_curso(){
        $usuario = new Usuario;
        $registros=$usuario->bd_select_cursos();
        $html = '';
        foreach($registros as $registro ){
            $option=substr($registro['nome_curso'],0,49);
            if(strlen($option)<strlen($registro['nome_curso'])){
                $option.='...';
            }
            $html.="<option title='". $registro['nome_curso'] ."' value='" . $registro['id_curso'] ."'> ". $option ."</option>\n";
        }
        return $html;

    }


    function html_form_msgErro(){
        
        $msg='<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION["errCurso"])?$_SESSION["errCurso"]:"").'
                    </div>
                </div>';

        return $msg;
    }

    function html_form_msgEnvio(){

        $msgE='<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>

                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION["envCurso"])?$_SESSION["envCurso"]:"").'
                    </div>
                </div>';

        return $msgE;
    }

    function html_form_msgErro_curriculo(){

        $msg='<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION["errCurri"])?$_SESSION["errCurri"]:"").'
                    </div>
                </div>';

        return $msg;
    }

    function html_form_msgEnvio_curriculo(){

        $msgE='<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>

                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                    '.(isset($_SESSION["envCurri"])?$_SESSION["envCurri"]:"").'
                    </div>
                </div>';

        return $msgE;
    }


    function html_msg_aside_curso(){
        $html="<h2>Cadastro de Cursos<br></h2><p class='text-white-50'>Cadastre um novo curso para instituição.</p>";
        return $html;
    }

    function html_msg_aside_curriculo(){
        $html="<h2>Cadastro de Currículo<br></h2><p class='text-white-50'>Adicione um novo currículo ao curso.</p>";
        return $html;
    }

    function html_form_cadastro_curso(){
        $html="<form id='formCurso' action='../php/curso_form_cadastro.php' method='POST'>

        <div class='form-group'>
            <label>Nome do Curso</label>
            <input id='nome_curso'  class='form-control border border-dark' placeholder='Curso' name='nome_curso' required>
        </div>

        <button type='submit' class='btn btn-primary' value='enviar' name='Enviar'>Cadastrar</button>
        <a class='btn btn-outline-dark ' href='../php/landingpage.php'>Voltar</a>

        </form>";

        return $html;

    }

    function html_form_cadastro_curriculo(){

        $html="<form id='formCurriculo' action='../php/curriculo_form_cadastro.php' method='POST'>

        <div class='form-group'>
            <label>Curso</label>
            <select id='curso' class='form-select border border-dark' name='curso' required>
                <option hidden>Selecione</option>
                <!-- option-curso -->
            </select>
        </div>

        <div class='form-group'>
            <label>Currículo</label>
            <input id='curriculo'  class='form-control border border-dark' placeholder='Currículo' name='curriculo'>
        </div>

        <div class='form-group'>
            <label>Data de Início</label>
            <input type='date' id='dt_inicio'  class='form-control border border-dark' placeholder='Data' name='dt_inicio' >
        </div>

        <div class='form-group'>
            <label>Data de Termino</label>
            <input type='date' id='dt_termino'  class='form-control border border-dark' placeholder='Data' name='dt_termino' >
        </div>

        <button type='submit' class='btn btn-primary' value='enviar' name='Enviar'>Cadastrar</button>
        <a class='btn btn-outline-dark ' href='../php/landingpage.php'>Voltar</a>

        </form>
        <script src='../js/validacao.js'></script>";

        return $html;

    }
}
?>