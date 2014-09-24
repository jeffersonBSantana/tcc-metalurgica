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
        $sql .= " SELECT MEDIDA.*, ESQUADRIA.DESCRICAO AS ESQUADRIA, PERFIL.* ";
        $sql .= " FROM MEDIDA ";
		$sql .= " INNER JOIN ESQUADRIA ";
        $sql .= " ON MEDIDA.ID_ESQUADRIA = ESQUADRIA.ID_ESQUADRIA ";	
		$sql .= " INNER JOIN PERFIL ";
        $sql .= " ON MEDIDA.ID_PERFIL = PERFIL.ID_PERFIL ";	

	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'DIVIDIR' ] = utf8_encode(Utils::formatCurrencyBr($value['DIVIDIR']));
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
	
	public function buscarPerfil( $params ) {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM PERFIL ";

	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'DESCRICAO' ] = utf8_encode( $value['DESCRICAO'] );
		}
		return $retorno;		
    }
	
	public function editar( $params ) {
		$code = utf8_decode($params['codigo']);

        $sql  = "";
        $sql .= " SELECT * FROM MEDIDA ";
        $sql .= " WHERE ID_MEDIDA = " . $code;

		$retorno = $this->database->select_sql( $sql );
		$retorno[0][ 'DIVIDIR' ] = Utils::formatCurrencyBr($retorno[0][ 'DIVIDIR' ]);
		return $retorno[0];
    }

    public function salvar( $params ) {
        $ID_MEDIDA     		= utf8_decode(($params['ID_MEDIDA'] == '') ? 0 : $params['ID_MEDIDA']);
        $QUANTIDADE 		= utf8_decode($params['QUANTIDADE']);
        $DIMINUIR 			= utf8_decode($params['DIMINUIR']);
		$AUMENTAR 			= utf8_decode($params['AUMENTAR']);
        $DIVIDIR 			= utf8_decode(Utils::formatCurrency($params['DIVIDIR']));
        $MEDIDA_REFERENCIA	= utf8_decode($params['MEDIDA_REFERENCIA']);
		$ID_ESQUADRIA 		= utf8_decode($params['ID_ESQUADRIA']);
        $ID_PERFIL 			= utf8_decode($params['ID_PERFIL']);
		
		if (  $params['ID_MEDIDA'] > 0 ) {
			return (int) $this->database->execute_sql(" UPDATE MEDIDA SET QUANTIDADE='$QUANTIDADE', DIMINUIR='$DIMINUIR', AUMENTAR='$AUMENTAR', DIVIDIR='$DIVIDIR', MEDIDA_REFERENCIA='$MEDIDA_REFERENCIA',
				ID_ESQUADRIA='$ID_ESQUADRIA', ID_PERFIL='$ID_PERFIL' WHERE ID_MEDIDA='$ID_MEDIDA' ");
		}
        else {
			return (int) $this->database->execute_sql(" INSERT INTO MEDIDA(ID_MEDIDA, QUANTIDADE, DIMINUIR, AUMENTAR, DIVIDIR, MEDIDA_REFERENCIA, ID_ESQUADRIA, ID_PERFIL) 
				VALUES($ID_MEDIDA, $QUANTIDADE, $DIMINUIR, $AUMENTAR, $DIVIDIR, '$MEDIDA_REFERENCIA', $ID_ESQUADRIA, $ID_PERFIL) ");
		}
    }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM MEDIDA WHERE ID_MEDIDA = $codigo ");
	}
}
