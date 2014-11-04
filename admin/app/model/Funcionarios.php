<?php

require_once("DataBase.php");
require_once("Util.php");

class Funcionarios
{
    var $database;

    public function __construct() {
        Utils::setFullLimit();
        $this->database = new DataBase();
    }

    public function buscar( $params ) {
    	$sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM FUNCIONARIO ";
        $sql .= " INNER JOIN LOCALIDADE ";
        $sql .= " ON FUNCIONARIO.ID_LOCAL = LOCALIDADE.ID_LOCALIDADE ";		

	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'CIDADE' ] = utf8_encode( $value['CIDADE'] );
			$retorno[ $key ][ 'ESTADO' ] = utf8_encode( $value['ESTADO'] );
		}
		return $retorno;	
    }

    public function buscarLocalidade( $params ) {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM LOCALIDADE ";

	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'CIDADE' ] = utf8_encode( $value['CIDADE'] );
			$retorno[ $key ][ 'ESTADO' ] = utf8_encode( $value['ESTADO'] );
		}
		return $retorno;		
    }

	public function editar( $params ) {
		$code = utf8_decode($params['codigo']);

        $sql  = "";
        $sql .= " SELECT * FROM FUNCIONARIO ";
        $sql .= " WHERE ID_FUNCIONARIO = " . $code;

		$retorno = $this->database->select_sql( $sql );
		return $retorno[0];
    }

    public function salvar( $params ) {
        $ID_FUNCIONARIO     = utf8_decode( ($params['ID_FUNCIONARIO'] == '') ? 0 : $params['ID_FUNCIONARIO'] );
        $NOME 		        = utf8_decode( mb_strtoupper( $params['NOME'], 'UTF-8' ));
        $CPF 		        = utf8_decode( mb_strtoupper( $params['CPF'], 'UTF-8' ));
        $EMAIL 		        = utf8_decode( mb_strtoupper( $params['EMAIL'], 'UTF-8' ));
        $CELULAR 		    = utf8_decode( mb_strtoupper( $params['CELULAR'], 'UTF-8' ));
		$RUA 		        = utf8_decode( mb_strtoupper( $params['RUA'], 'UTF-8' ));
        $NUMERO 		    = utf8_decode( mb_strtoupper( $params['NUMERO'], 'UTF-8' ));
		$BAIRRO 		    = utf8_decode( mb_strtoupper( $params['BAIRRO'], 'UTF-8' ));
        $CEP 		        = utf8_decode( mb_strtoupper( $params['CEP'], 'UTF-8' ));
        $ID_LOCAL		    = utf8_decode( $params['ID_LOCAL'] );

		if (  $params['ID_FUNCIONARIO'] > 0 ) {
			return (int) $this->database->execute_sql(" UPDATE FUNCIONARIO SET NOME='$NOME', CPF='$CPF', EMAIL='$EMAIL', CELULAR='$CELULAR',
			RUA='$RUA', NUMERO='$NUMERO', BAIRRO='$BAIRRO', CEP='$CEP', ID_LOCAL='$ID_LOCAL' WHERE ID_FUNCIONARIO='$ID_FUNCIONARIO' ");
		}
        else {
			return (int) $this->database->execute_sql(" INSERT INTO FUNCIONARIO(ID_FUNCIONARIO, NOME, CPF, EMAIL, CELULAR, RUA, NUMERO, BAIRRO, CEP, ID_LOCAL) 
				VALUES($ID_FUNCIONARIO, '$NOME', '$CPF', '$EMAIL', '$CELULAR', '$RUA', $NUMERO, '$BAIRRO', '$CEP', $ID_LOCAL) ");
		}
    }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM FUNCIONARIO WHERE ID_FUNCIONARIO = $codigo ");
	}
}
