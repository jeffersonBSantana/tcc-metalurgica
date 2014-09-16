<?php

require_once("DataBase.php");
require_once("Util.php");

class Localidade
{
    var $database;

    public function __construct() {
        Utils::setFullLimit();
        $this->database = new DataBase();
    }
	public function buscar( $params ) {
    	$sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM LOCALIDADE ";
	    return $this->database->select_sql( $sql );
    }


    public function buscarLocalidade( $params ) {
    	$sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM LOCALIDADE ";

	    return $this->database->select_sql( $sql );
    }

    /*public function buscarFuncionarios( $params ) {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM FUNCIONARIO ";

        return $this->database->select_sql( $sql );
    }*/

	public function editar( $params ) {
		$code = utf8_decode($params['codigo']);

        $sql  = "";
        $sql .= " SELECT * FROM LOCALIDADE ";
        $sql .= " WHERE ID_LOCALIDADE = " . $code;

		$retorno = $this->database->select_sql( $sql );
		return $retorno[0];
    }

    public function salvar( $params ) {
        $ID_LOCALIDADE     = utf8_decode( ($params['ID_LOCALIDADE'] == '') ? 0 : $params['ID_LOCALIDADE'] );
        $CIDADE 		   = strtoupper(utf8_decode( $params['CIDADE'] ));
        $ESTADO 		   = strtoupper(utf8_decode( $params['ESTADO'] ));
        $SIGLA 		       = strtoupper(utf8_decode( $params['SIGLA'] ));

		if (  $params['ID_LOCALIDADE'] > 0 ) {
			return (int) $this->database->execute_sql(" UPDATE LOCALIDADE SET CIDADE='$CIDADE', ESTADO='$ESTADO', SIGLA='$SIGLA', WHERE ID_LOCALIDADE='$ID_LOCALIDADE' ");
		}
        else {
			return (int) $this->database->execute_sql(" INSERT INTO LOCALIDADE(ID_LOCALIDADE, CIDADE, ESTADO, SIGLA) VALUES('$ID_LOCALIDADE', '$CIDADE', '$ESTADO', '$SIGLA') ");
		}
    }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM LOCALIDADE WHERE ID_LOCALIDADE = $codigo ");
	}
}
