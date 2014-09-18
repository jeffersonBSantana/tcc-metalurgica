<?php

require_once("DataBase.php");
require_once("Util.php");

class Esquadria
{
    var $database;

    public function __construct() {
        Utils::setFullLimit();
        $this->database = new DataBase();
    }

    public function buscar( $params ) {
    	$sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM ESQUADRIA ";
	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'DESCRICAO' ] = utf8_encode( $value['DESCRICAO'] );
			
		}
		return $retorno;	
    }

    
	public function editar( $params ) {
		$code = utf8_decode($params['codigo']);

        $sql  = "";
        $sql .= " SELECT * FROM ESQUADRIA ";
        $sql .= " WHERE ID_ESQUADRIA = " . $code;

		$retorno = $this->database->select_sql( $sql );
		return $retorno[0];
    }

    public function salvar( $params ) {
        $ID_ESQUADRIA = utf8_decode( ($params['ID_ESQUADRIA'] == '') ? 0 : $params['ID_ESQUADRIA'] );
        $DESCRICAO 	  = utf8_decode( strtoupper( $params['DESCRICAO'] ));
        $COLOCACAO 	  = utf8_decode( $params['COLOCACAO'] );

		if (  $params['ID_ESQUADRIA'] > 0 ) {
			return (int) $this->database->execute_sql(" UPDATE ESQUADRIA SET DESCRICAO='$DESCRICAO', COLOCACAO='$COLOCACAO' WHERE ID_ESQUADRIA=$ID_ESQUADRIA ");
		}
        else {
			return (int) $this->database->execute_sql(" INSERT INTO ESQUADRIA(ID_ESQUADRIA, DESCRICAO, COLOCACAO) 
				VALUES($ID_ESQUADRIA, '$DESCRICAO', '$COLOCACAO') ");
		}
    }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM ESQUADRIA WHERE ID_ESQUADRIA = $codigo ");
	}
}