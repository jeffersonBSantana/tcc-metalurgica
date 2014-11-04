<?php

require_once("DataBase.php");
require_once("Util.php");

class Perfil
{
    var $database;

    public function __construct() {
        Utils::setFullLimit();
        $this->database = new DataBase();
    }

    public function buscar( $params ) {
    	$sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM PERFIL ";
	    $retorno = $this->database->select_sql( $sql );
		
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'DESCRICAO' ] = utf8_encode( $value['DESCRICAO'] );
			$retorno[ $key ][ 'PESO_POR_METRO' ] = Utils::formatCurrencyBr(utf8_encode($value['PESO_POR_METRO']));
		}
		return $retorno;	
    }

    
	public function editar( $params ) {
		$code = utf8_decode($params['codigo']);

        $sql  = "";
        $sql .= " SELECT * FROM PERFIL ";
        $sql .= " WHERE ID_PERFIL = " . $code;

		$retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'DESCRICAO' ] = utf8_encode( $value['DESCRICAO'] );
			$retorno[ $key ][ 'PESO_POR_METRO' ] = Utils::formatCurrencyBr(utf8_encode($value['PESO_POR_METRO']));
		}		
		return $retorno[0];
    }

    public function salvar( $params ) {
        $ID_PERFIL          = utf8_decode( ($params['ID_PERFIL'] == '') ? 0 : $params['ID_PERFIL'] );
        $DESCRICAO 		    = utf8_decode( mb_strtoupper( $params['DESCRICAO'], 'UTF-8' ));
        $PESO_POR_METRO 	= utf8_decode( Utils::formatCurrency($params['PESO_POR_METRO']) );

		if (  $params['ID_PERFIL'] > 0 ) {
			return (int) $this->database->execute_sql(" UPDATE PERFIL SET DESCRICAO='$DESCRICAO', PESO_POR_METRO=$PESO_POR_METRO WHERE ID_PERFIL=$ID_PERFIL ");
		}
        else {
			return (int) $this->database->execute_sql(" INSERT INTO PERFIL(ID_PERFIL, DESCRICAO, PESO_POR_METRO) 
				VALUES($ID_PERFIL, '$DESCRICAO', $PESO_POR_METRO) ");
		}
    }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM PERFIL WHERE ID_PERFIL = $codigo ");
	}
}
