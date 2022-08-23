<?php
$conexao = null;
class Conexao{

    function __construct(){
       $this->Conectar();
    }

    function Conectar(){

        global $conexao;
        $conexao = new mysqli("localhost","root","","atividadesbd");

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $conexao->set_charset('utf8');//deefine a conexao c/ conj de caracter

    }

    function executa_consulta_sql($sql,$parametros){
        global$conexao;
        $result = $this->execSQL($sql, $parametros, false);
        return $result;
    }


    function execSQL($sql, $params, $close){
        global$conexao;

        $stmt =$conexao->prepare($sql) or die ("Failed to prepared the statement! - ".$conexao->error);

        //somente chama bind_param se houver elementos no array '$params'
        if(count($params)>0){
            call_user_func_array(array($stmt,'bind_param'), $this->refValues($params));
        }
        $results=array();
        $stmt->execute();

        if($close){
            $result['affected_rows'] =$conexao->affected_rows;
            $result['insert_id'] =$conexao->insert_id;
        } else {
            $meta = $stmt->result_metadata();

            while ( $field = $meta->fetch_field() ) {
                $parameters[] = &$row[$field->name];
            }

            $stmt->store_result();
            call_user_func_array(array($stmt, 'bind_result'), $this->refValues($parameters));

            while ( $stmt->fetch() ) {
                $x = array();
                foreach( $row as $key => $val ) {
                    $x[$key] = $val;
                }
                $results[] = $x;
            }

        $result = $results; /* AVISO */  /* Warning: Undefined variable $results in C:\xampp\htdocs\all_done\banco\conectaBD.php on line 58 */
        }

        $stmt->close();

        return  $result;
    }

    function refValues($arr){
     if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
     {
         $refs = array();
         foreach($arr as $key => $value)
             $refs[$key] = &$arr[$key];
         return $refs;
     }
     return $arr;
    }
    
    function retorna_coluna_registros($registros,$coluna){
        $campos=array();
        foreach($registros as $key => $registro){
            $campos[$key] = $registro[$coluna];
        }
        return $campos;
    }

}
$objConexao = new Conexao;
?>