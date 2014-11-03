<?php

// banco de dados
require_once("DataBase.php");
// funcoes uteis
require_once("Util.php");

class Clientes
{
    var $database;

    public function __construct() {
        $this->database = new DataBase();
    }

    public function buscar( $params ) {
    	$sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM CLIENTE ";
        $sql .= " INNER JOIN LOCALIDADE ";
        $sql .= " ON CLIENTE.ID_LOCALIDADE = LOCALIDADE.ID_LOCALIDADE ";		

	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'NOME' ]   = utf8_encode( $value['NOME'] );
			$retorno[ $key ][ 'RUA' ]    = utf8_encode( $value['RUA'] );
			$retorno[ $key ][ 'BAIRRO' ] = utf8_encode( $value['BAIRRO'] );
			$retorno[ $key ][ 'ESTADO' ] = utf8_encode( $value['ESTADO'] );
			$retorno[ $key ][ 'CIDADE' ] = utf8_encode( $value['CIDADE'] );
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
        $sql .= " SELECT * FROM CLIENTE ";
        $sql .= " WHERE ID_CLIENTE = " . $code;

		$retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'NOME' ]   = utf8_encode( $value['NOME'] );
			$retorno[ $key ][ 'RUA' ]    = utf8_encode( $value['RUA'] );
			$retorno[ $key ][ 'BAIRRO' ] = utf8_encode( $value['BAIRRO'] );
			$retorno[ $key ][ 'ESTADO' ] = utf8_encode( $value['ESTADO'] );
			$retorno[ $key ][ 'CIDADE' ] = utf8_encode( $value['CIDADE'] );
		}
		return $retorno[0]; // so pega 1 registro
    }

    public function salvar( $params ) {
        $ID_CLIENTE     	= utf8_decode( ($params['ID_CLIENTE'] == '') ? 0 : $params['ID_CLIENTE'] );
        $NOME 		    	= utf8_decode( strtoupper( $params['NOME'] ));
        $CPF_CNPJ 		    = utf8_decode( strtoupper( $params['CPF_CNPJ'] ));
        $EMAIL 		    	= utf8_decode( strtoupper( $params['EMAIL'] ));
		$TELEFONE 			= utf8_decode( strtoupper( $params['TELEFONE'] ));
        $CELULAR 			= utf8_decode( strtoupper( $params['CELULAR'] ));
		$RUA 		    	= utf8_decode( strtoupper( $params['RUA'] ));
        $NUMERO 			= utf8_decode( strtoupper( $params['NUMERO'] ));
		$BAIRRO 			= utf8_decode( strtoupper( $params['BAIRRO'] ));
        $CEP 		    	= utf8_decode( strtoupper( $params['CEP'] ));
        $ID_LOCALIDADE		= utf8_decode( $params['ID_LOCALIDADE'] );
		
		if (  $params['ID_CLIENTE'] > 0 ) {
			return (int) $this->database->execute_sql(" UPDATE CLIENTE SET NOME='$NOME', CPF_CNPJ='$CPF_CNPJ', EMAIL='$EMAIL', TELEFONE='$TELEFONE', CELULAR='$CELULAR',
			RUA='$RUA', NUMERO='$NUMERO', BAIRRO='$BAIRRO', CEP='$CEP', ID_LOCALIDADE='$ID_LOCALIDADE' WHERE ID_CLIENTE='$ID_CLIENTE' ");
		}
        else {
			return (int) $this->database->execute_sql(" INSERT INTO CLIENTE(ID_CLIENTE, NOME, CPF_CNPJ, EMAIL, TELEFONE, CELULAR, RUA, NUMERO, BAIRRO, CEP, ID_LOCALIDADE) 
				VALUES($ID_CLIENTE, '$NOME', '$CPF_CNPJ', '$EMAIL', $TELEFONE, '$CELULAR', '$RUA', $NUMERO, '$BAIRRO', '$CEP', $ID_LOCALIDADE) ");
		}
    }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM CLIENTE WHERE ID_CLIENTE = $codigo ");
	}
}
