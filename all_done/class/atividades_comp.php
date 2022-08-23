<?php

class Atividades_comp{

    function bd_insert_atividades_comp($id_tipo_atividade, $carga_hor_comp, $desc_atividade, $mecanismo, $doc_nome, $nome_arquivo, $avaliacao,$id_usuario,$id_aluno){
        //insert de atividades complementares
        global $objConexao;
        if(is_null($avaliacao)){
            $avaliacao='Pendente';
        }
        if(is_null($id_aluno)){
            $id_aluno='Registro de admin';
        }
        $id=0;
        $sql = "INSERT INTO atividade_comp(id_tipo_atividade, carga_hor_comp, desc_atividade, mecanismo, doc_compro, nome_arquivo, avaliacao,id_usuario,id_aluno) VALUES(?,?,?,?,?,?,?,?,?)";

        $parametros = array('iisssssii',$id_tipo_atividade,$carga_hor_comp, $desc_atividade, $mecanismo, $doc_nome, $nome_arquivo, $avaliacao,$id_usuario,$id_aluno);

        $result=$objConexao->execSQL($sql,$parametros,true);

        if($result['insert_id']){
            $id=$result['insert_id'];
        }
        return $id;
    }

    function bd_insert_atividades_comp_usuario($id_atividade_comp, $id_usuario){
        //insert de usuarios que inseriram ou modificaram uma atividade
        global $objConexao;
        $id=0;
        $sql = "INSERT INTO atividade_comp_usuario(id_atividade_comp, id_usuario) VALUES(?,?)";

        $parametros = array('ii',$id_atividade_comp,$id_usuario);

        $result=$objConexao->execSQL($sql,$parametros,true);

        if($result['insert_id']){
            $id=$result['insert_id'];
        }
        return $id;
    }

    function bd_insert_atividades_comp_atividades_comp_usuario($id_tipo_atividade, $carga_hor_comp, $desc_atividade, $mecanismo, $doc_nome, $nome_arquivo, $avaliacao,$id_usuario, $id_aluno){
        //inserção de dados quando a atividade é cadastrada, insert na tabela atividades_comp e na atividades_comp_usuario

        $id_ac = $this->bd_insert_atividades_comp($id_tipo_atividade, $carga_hor_comp, $desc_atividade, $mecanismo, $doc_nome, $nome_arquivo, $avaliacao,$id_usuario, $id_aluno);
        $id_acu = $this->bd_insert_atividades_comp_usuario($id_ac, $id_usuario);

        if(!$id_ac || !$id_acu){
            return 0;
        }else{
            return 1;
        }
    }


    function bd_insert_tipo_atividade($id_curso_curriculo, $tipo_atividade, $hora_max, $hora_min){
        global $objConexao;
        $id=0;
        $sql = "INSERT INTO tipo_atividade(id_curso_curriculo, tipo_atividade, hora_max, hora_min) VALUES(?,?,?,?)";

        $parametros = array('isii',$id_curso_curriculo,$tipo_atividade, $hora_max, $hora_min);

        $result=$objConexao->execSQL($sql,$parametros,true);

        if($result['insert_id']){
            $id=$result['insert_id'];
        }
        return $id;
    }

    function bd_update_atividade_deferida($id_atividade_comp){
        //update na validação da atividade através do deferimento da atividade pelo coordenador

        global $objConexao;
        $id=0;

        $sql="UPDATE `atividade_comp` SET avaliacao='Concluída' WHERE id_atividade_comp = ? ";

        $parametros = array('i',$id_atividade_comp);

        $result=$objConexao->execSQL($sql,$parametros,true);

        return $result['affected_rows'];
    }

    function bd_update_atividade_deferida_atividades_comp_usuario($id_atividade_comp, $id_usuario){
        //update na tabela atividade através do deferimento do coordenador sobre a atividade, juntamente com inserção na tabela de modificação de atividades a atividade_comp_usuario

        $u_atv_def = $this->bd_update_atividade_deferida($id_atividade_comp);
        $id_acu = $this->bd_insert_atividades_comp_usuario($id_atividade_comp, $id_usuario);

        if(!$u_atv_def || !$id_acu){
            return 0;
        }else{
            return 1;
        }
    }

    function bd_update_atividade_indeferida($id_atividade_comp, $comentario){
        //update na validação da atividade através do indeferimento da atividade pelo coordenador

        global $objConexao;

        $sql="UPDATE `atividade_comp` SET `avaliacao`='Indeferida', `comentario` = ? WHERE `id_atividade_comp` = ? ";

        $parametros = array('si',$comentario,$id_atividade_comp);

        $result=$objConexao->execSQL($sql,$parametros,true);

        return $result['affected_rows'];
    }

    function bd_update_atividade_indeferida_atividades_comp_usuario($id_atividade_comp, $comentario, $id_usuario){
        //update na tabela atividade através do deferimento do coordenador sobre a atividade, juntamente com inserção na tabela de modificação de atividades a atividade_comp_usuario

        $u_atv_indef = $this->bd_update_atividade_indeferida($id_atividade_comp, $comentario);
        $id_acu = $this->bd_insert_atividades_comp_usuario($id_atividade_comp, $id_usuario);

        if(!$u_atv_indef || !$id_acu){
            return 0;
        }else{
            return 1;
        }
    }


    function bd_update_atividade_comp($id_tipo_atividade,$carga_hor_comp, $desc_atividade, $mecanismo, $doc_compro, $nome_arquivo,$id_atividade_comp){
        //update de atividade complementar pelo aluno

        global $objConexao;

        $sql="UPDATE `atividade_comp` SET `id_tipo_atividade`= ? ,`doc_compro`= ? ,`nome_arquivo`= ?, `carga_hor_comp`= ? ,`desc_atividade`= ? ,`mecanismo`=  ?, avaliacao='Pendente', comentario=null WHERE id_atividade_comp = ?";

        $parametros=array('ississi', $id_tipo_atividade, $doc_compro, $nome_arquivo,$carga_hor_comp, $desc_atividade, $mecanismo, $id_atividade_comp);

        $result=$objConexao->execSQL($sql,$parametros,true);

        return $result['affected_rows'];
    }

    function bd_update_atividade_comp_atividades_comp_usuario($id_tipo_atividade,$carga_hor_comp, $desc_atividade, $mecanismo, $doc_compro, $nome_arquivo,$id_atividade_comp, $id_usuario){
        /* bd_verifica_permissao_usuario_atividade_comp($id_usuario, $id_atividade_comp); */
        $u_atv_comp = $this->bd_update_atividade_comp($id_tipo_atividade,$carga_hor_comp, $desc_atividade, $mecanismo, $doc_compro, $nome_arquivo,$id_atividade_comp);
        $id_acu = $this->bd_insert_atividades_comp_usuario($id_atividade_comp, $id_usuario);

        if(!($u_atv_comp) || !($id_acu)){
            return 0;
        }else{
            return 1;
        }
    }

    function bd_delete_atividade_comp_usuario($id_usuario,$id_atividade_comp){
        global $objConexao;

        $retorno=$this->bd_verifica_permissao_usuario_atividade_comp($id_usuario, $id_atividade_comp);

        if($retorno==0){
            session_destroy();
            session_start();
            $_SESSION['loginErro']='Suas ações visavam infringir a segurança do site';
            header('Location: ../php/login_form.php');
        }else{

            $sql = "DELETE FROM atividade_comp_usuario WHERE id_atividade_comp = ?";

            $parametros = array('i',$id_atividade_comp);

            $result=$objConexao->execSQL($sql,$parametros,true);

            return $result['affected_rows'];
        }
    }

    function bd_delete_atividade_comp($id_usuario,$id_atividade_comp){
        global $objConexao;

        $retorno=$this->bd_verifica_permissao_usuario_atividade_comp($id_usuario, $id_atividade_comp);

        if($retorno==0){
            session_destroy();
            session_start();
            $_SESSION['loginErro']='Suas ações visavam infringir a segurança do site';
            header('Location: ../php/login_form.php');
        }else{

            $registros=$this->bd_select_atividade_by_id($id_atividade_comp);
            $pasta='certificados/';
            $caminho=$pasta.$registros[0]['nome_arquivo'];
            if(file_exists( $caminho )){
                unlink($caminho);
            }

            $sql = "DELETE FROM atividade_comp WHERE id_atividade_comp = ? ";

            $parametros = array('i',$id_atividade_comp);

            $result=$objConexao->execSQL($sql,$parametros,true);


            return $result['affected_rows'];
        }

    }

    function bd_delete_atividade_comp_atividade_comp_usuario($id_usuario,$id_atividade_comp){

        $retorno=$this->bd_verifica_permissao_usuario_atividade_comp($id_usuario, $id_atividade_comp);
        if($retorno==0){
            session_destroy();
            session_start();
            $_SESSION['loginErro']='Suas ações visavam infringir a segurança do site';
            header('Location: ../php/login_form.php');
            die();
        }else{

            $del_atv_u=$this->bd_delete_atividade_comp_usuario($id_usuario,$id_atividade_comp);
            $del_atv=$this->bd_delete_atividade_comp($id_usuario,$id_atividade_comp);

            if(!$del_atv_u || !$del_atv){
                return 0;
            }else{
                return 1;
            }

        }
    }

    function bd_delete_tipo_atividade($id_tipo_atividade){
        global $objConexao;

        $sql = "DELETE FROM `tipo_atividade` WHERE id_tipo_atividade = ?";

        $parametros = array('i',$id_tipo_atividade);

        $result=$objConexao->execSQL($sql,$parametros,true);

        return $result['affected_rows'];

    }

    function bd_verifica_permissao_usuario_atividade_comp($id_usuario, $id_atividade_comp){
        global $objConexao;

        $sql="  SELECT
                    u.id_usuario
                FROM
                    atividade_comp as ac
                    LEFt join
                    usuario as u
                    ON
                    u.id_usuario=ac.id_usuario
                WHERE
                    ac.id_atividade_comp = ? ";

        $parametros = array('i',$id_atividade_comp);

        if($retorno=$objConexao->executa_consulta_sql($sql,$parametros)){
            if(!($retorno[0]['id_usuario']==$id_usuario)){
                return 0;
            }else{
                return 1;
            }
        }else{
            return 0;
        }
    }

    function bd_select_total_tipo_atividade_usuario($id_usuario, $id_tipo_atividade){
        global $objConexao;

        $sql='SELECT IFNULL (SUM(`carga_hor_comp`), 0) as total FROM `atividade_comp` WHERE id_usuario = ? and id_tipo_atividade=?';

        $parametros = array('ii', $id_usuario ,$id_tipo_atividade);

        return $objConexao->executa_consulta_sql($sql,$parametros);
    }

    function bd_select_min_max_horas_complementares($id_tipo_atividade){
        //seleciona hora min e max de cada tipo de atividade para validação
        global $objConexao;
        $retorno=array('min_horas'=>null,'max_horas'=>null);
        $sql = "SELECT
                    ta.hora_max,
                    ta.hora_min
                FROM
                    `tipo_atividade` as ta
                WHERE
                    ta.id_tipo_atividade = ?";

        $parametros = array('i', $id_tipo_atividade);

        if($registros = $objConexao->executa_consulta_sql($sql,$parametros)){
            $retorno['min_horas'] = $registros[0]['hora_min'];
            $retorno['max_horas'] = $registros[0]['hora_max'];
        }
        return $retorno;
    }

    function bd_select_form_options($id_usuario){
        global $objConexao;
        //seleciona o curriculo do usuario
        $sql = "SELECT
                    cc.id_curso_curriculo,
                    a.id_usuario
                FROM

                    curso_curriculo as cc

                    LEFT JOIN
                        aluno as a
                    on
                        a.id_curso_curriculo = cc.id_curso_curriculo
                WHERE
                        a.id_usuario = ?";

        $parametros = array('i', $id_usuario);

        if($registros = $objConexao->executa_consulta_sql($sql,$parametros)){
            $id_curso_curriculo=$registros[0]['id_curso_curriculo'];
        }
        //seleciona o tipo de atividade dependendo do curriculo do usuario
        $sql = "SELECT
                    ta.id_tipo_atividade,
                    ta.tipo_atividade,
                    ta.hora_max,
                    ta.hora_min
                FROM

                    tipo_atividade as ta

                WHERE
                        ta.id_curso_curriculo=?";

        $parametros = array('i', $id_curso_curriculo);

        return $objConexao->executa_consulta_sql($sql,$parametros);

    }

    function bd_select_atividades_todos_alunos(){
        global $objConexao;
        /* COUNT(ac.id_tipo_atividade) as qtd_atividades,
        SUM(carga_hor_comp) as qtd_horas */
        $retorno=array('desc_atividade'=>null,'carga_hor_comp'=>null,'doc_compro'=>null,'mecanismo'=>null,'avaliacao'=>null,'qtd_atividades'=>null,'qtd_horas'=>null);
        //seleciona o aluno
        $sql="  SELECT
                    a.id_aluno,
                    u.nome,
                    ac.id_atividade_comp,
                    u.usuario,
                    a.matricula,
                    c.nome_curso,
                    cc.curriculo
                FROM
                    atividade_comp as ac
                LEFT JOIN
                    usuario as u
                    ON
                        u.id_usuario=ac.id_usuario
                LEFT JOIN
                    aluno as a
                    ON
                        ac.id_aluno=a.id_aluno
                LEFT JOIN
                    curso_curriculo as cc
                        ON
                            a.id_curso_curriculo=cc.id_curso_curriculo
                LEFT JOIN
                    curso as c
                    ON
                        cc.id_curso=c.id_curso
                GROUP BY
                	u.id_usuario";

        return  $objConexao->executa_consulta_sql($sql,array());
    }

    function bd_select_atividades_aluno($id_usuario){
        global $objConexao;
        $retorno=array('desc_atividade'=>null,'carga_hor_comp'=>null,'doc_compro'=>null,'mecanismo'=>null,'avaliacao'=>null,'qtd_atividades'=>null,'qtd_horas'=>null);
        $sql="  SELECT
                    u.nome,
                    u.usuario,
                    ac.id_aluno,
                    ac.id_atividade_comp,
                    ac.desc_atividade,
                    ac.carga_hor_comp,
                    ac.doc_compro,
                    ac.nome_arquivo,
                    ac.mecanismo,
                    ac.avaliacao,
                    ac.comentario
                FROM
                    atividade_comp as ac
                LEFT JOIN
                    usuario as u
                    ON
                        u.id_usuario=ac.id_usuario
                WHERE
                    ac.id_usuario=?";

        $parametros = array('i', $id_usuario);

        return $objConexao->executa_consulta_sql($sql,$parametros);
    }


    function bd_select_atividades_aluno_pendente($id_usuario){
        global $objConexao;
        $retorno=array('desc_atividade'=>null,'carga_hor_comp'=>null,'doc_compro'=>null,'mecanismo'=>null,'avaliacao'=>null,'qtd_atividades'=>null,'qtd_horas'=>null);
        $sql="  SELECT
                    u.nome,
                    u.usuario,
                    a.id_aluno,
                    ac.id_atividade_comp,
                    ac.desc_atividade,
                    ac.carga_hor_comp,
                    ac.doc_compro,
                    ac.nome_arquivo,
                    ac.mecanismo,
                    ac.avaliacao
                FROM
                    atividade_comp as ac
                LEFT JOIN
                    usuario as u
                    ON
                        u.id_usuario=ac.id_usuario
                LEFT JOIN
                    aluno as a
                    ON
                        u.id_usuario=a.id_usuario
                WHERE
                    ac.id_usuario=? and ac.avaliacao='Pendente'";

        $parametros = array('i', $id_usuario);

        return $objConexao->executa_consulta_sql($sql,$parametros);
    }

    function bd_select_atividades_deferidas_aluno($id_usuario){
        global $objConexao;
        $retorno=array('desc_atividade'=>null,'carga_hor_comp'=>null,'doc_compro'=>null,'mecanismo'=>null,'avaliacao'=>null,'qtd_atividades'=>null,'qtd_horas'=>null);
        $sql="  SELECT
                    u.nome,
                    u.usuario,
                    a.id_aluno,
                    ac.id_atividade_comp,
                    ac.desc_atividade,
                    ac.carga_hor_comp,
                    ac.doc_compro,
                    ac.nome_arquivo,
                    ac.mecanismo,
                    ac.avaliacao
                FROM
                    atividade_comp as ac
                LEFT JOIN
                    usuario as u
                    ON
                        u.id_usuario=ac.id_usuario
                LEFT JOIN
                    aluno as a
                    ON
                        u.id_usuario=a.id_usuario
                WHERE
                    ac.id_usuario=? and ac.avaliacao='Concluída'";

        $parametros = array('i', $id_usuario);

        return $objConexao->executa_consulta_sql($sql,$parametros);
    }

    function bd_select_atividade_by_id($id_atividade_comp){
        global $objConexao;
        $retorno=array('mecanismo'=>null);
        $sql="  SELECT
                    ac.id_tipo_atividade,
                    ta.tipo_atividade,
                    ta.hora_max,
                    ta.hora_min,
                    ac.desc_atividade,
                    ac.carga_hor_comp,
                    ac.doc_compro,
                    ac.nome_arquivo,
                    ac.mecanismo
                FROM
                    atividade_comp as ac
                LEFT JOIN
                    tipo_atividade as ta
                    ON
                    ac.id_tipo_atividade=ta.id_tipo_atividade
                WHERE
                    ac.id_atividade_comp = ? ";

        $parametros = array('i', $id_atividade_comp);

        return $objConexao->executa_consulta_sql($sql,$parametros);
    }

}

?>