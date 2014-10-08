<?php

require_once("DataBase.php");
require_once("Util.php");

class Medidas
{
    var $database;

    public function __construct() {
        Utils::setFullLimit();
        $this->database = new DataBase();
    }

    public function buscar( $params ) {
    	$sql  = "";
        $sql .= " SELECT MEDIDA.*, ESQUADRIA.DESCRICAO AS ESQUADRIA ";
        $sql .= " FROM MEDIDA ";
		$sql .= " INNER JOIN ESQUADRIA ";
        $sql .= " ON MEDIDA.ID_ESQUADRIA = ESQUADRIA.ID_ESQUADRIA ";	
		$sql .= " ORDER BY 1 ";
        
	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'VALOR' ] = utf8_encode(Utils::formatCurrencyBr($value['VALOR']));
		}		
		return $retorno;	
    }
	
	public function buscarEsquadria( $params ) {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM ESQUADRIA ";

	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'DESCRICAO' ] = utf8_encode( $value['DESCRICAO'] );
			$retorno[ $key ][ 'COLOCACAO' ] = utf8_encode( $value['COLOCACAO'] );
		}
		return $retorno;		
    }
	
	public function editar( $params ) {
		$code = utf8_decode($params['codigo']);

        $sql  = "";
        $sql .= " SELECT * FROM MEDIDA ";
        $sql .= " WHERE ID_MEDIDA = " . $code;

		$retorno = $this->database->select_sql( $sql );
		$retorno[0][ 'VALOR' ] = Utils::formatCurrencyBr($retorno[0][ 'VALOR' ]);
		return $retorno[0];
    }

    public function salvar( $params ) {
        $ID_MEDIDA     	= utf8_decode(($params['ID_MEDIDA'] == '') ? 0 : $params['ID_MEDIDA']);
        $VALOR 			= utf8_decode(Utils::formatCurrency($params[ 'VALOR' ]));
		$ID_ESQUADRIA 	= utf8_decode($params['ID_ESQUADRIA']);
		
		if (  $params['ID_MEDIDA'] > 0 ) {
			return (int) $this->database->execute_sql(" UPDATE MEDIDA SET VALOR='$VALOR', ID_ESQUADRIA='$ID_ESQUADRIA' WHERE ID_MEDIDA='$ID_MEDIDA' ");
		}
        else {
			return (int) $this->database->execute_sql(" INSERT INTO MEDIDA(ID_MEDIDA, VALOR, ID_ESQUADRIA) 
				VALUES($ID_MEDIDA, $VALOR, $ID_ESQUADRIA) ");
		}
    }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM MEDIDA WHERE ID_MEDIDA = $codigo ");
	}
}
