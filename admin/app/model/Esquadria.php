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
        $sql .= " SELECT ESQUADRIA.*, PERFIL.DESCRICAO AS DESCRICAO_PERFIL, PERFIL.PESO_POR_METRO ";
        $sql .= " FROM ESQUADRIA ";
		$sql .= " INNER JOIN PERFIL ";
		$sql .= " ON PERFIL.ID_PERFIL = ESQUADRIA.ID_PERFIL ";
        
	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'DESCRICAO' ] = utf8_encode( $value['DESCRICAO'] );
			
		}
		return $retorno;	
    }

	public function buscarPerfil( $params ) {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM PERFIL ";

        return $this->database->select_sql( $sql );
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
		$ID_PERFIL 	  = utf8_decode( $params['ID_PERFIL'] );

		if (  $params['ID_ESQUADRIA'] > 0 ) {
			return (int) $this->database->execute_sql(" UPDATE ESQUADRIA SET ID_PERFIL=$ID_PERFIL, DESCRICAO='$DESCRICAO', COLOCACAO='$COLOCACAO' WHERE ID_ESQUADRIA=$ID_ESQUADRIA ");
		}
        else {
			return (int) $this->database->execute_sql(" INSERT INTO ESQUADRIA(ID_ESQUADRIA, ID_PERFIL, DESCRICAO, COLOCACAO) VALUES($ID_ESQUADRIA, $ID_PERFIL, '$DESCRICAO', '$COLOCACAO') ");
		}
    }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM ESQUADRIA WHERE ID_ESQUADRIA = $codigo ");
	}
}
