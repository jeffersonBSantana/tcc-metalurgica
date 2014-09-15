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
        // Existe ativo na tabela funcionario, não encontrei lá... Acho que nao precisa!
        // $sql .= " WHERE ATIVO = " . $params['ativo'];

	    return $this->database->select_sql( $sql );
    }

    public function buscarFuncionarios( $params ) {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM funcionario ";

        return $this->database->select_sql( $sql );
    }

	public function editar( $params ) {
		$code = utf8_decode($params['codigo']);

        $sql  = "";
        $sql .= " SELECT * FROM funcionario ";
        $sql .= " WHERE ID_FUNCIONARIO = " . $code;

		$retorno = $this->database->select_sql( $sql );
		return $retorno[0];
    }

    public function salvar( $params ) {
        $ID_FUNCIONARIO     = utf8_decode( ($params['ID_FUNCIONARIO'] == '') ? 0 : $params['ID_FUNCIONARIO'] );
        $NOME 		        = strtoupper(utf8_decode( $params['NOME'] ));
        $CPF 		        = strtoupper(utf8_decode( $params['CPF'] ));
        $EMAIL 		        = strtoupper(utf8_decode( $params['EMAIL'] ));
        $CELULAR 		    = strtoupper(utf8_decode( $params['CELULAR'] ));
		$RUA 		        = strtoupper(utf8_decode( $params['RUA'] ));
        $NUMERO 		    = strtoupper(utf8_decode( $params['NUMERO'] ));
		$BAIRRO 		    = strtoupper(utf8_decode( $params['BAIRRO'] ));
        $CEP 		        = strtoupper(utf8_decode( $params['CEP'] ));
        $ID_LOCAL		    = utf8_decode( $params['ID_LOCAL'] );

		if (  $params['ID_FUNCIONARIO'] > 0 ) {
			return (int) $this->database->execute_sql(" UPDATE FUNCIONARIO SET NOME='$NOME', CPF='$CPF', EMAIL='$EMAIL', CELULAR='$CELULAR',
			RUA='$RUA', NUMERO='$NUMERO', BAIRRO='$BAIRRO', CEP='$CEP', ID_LOCAL='$ID_LOCAL' WHERE ID_FUNCIONARIO='$ID_FUNCIONARIO' ");
		}
        else {
			return (int) $this->database->execute_sql(" INSERT INTO FUNCIONARIO(ID_FUNCIONARIO, NOME, CPF, EMAIL, CELULAR, RUA, NUMERO, BAIRRO, CEP, ID_LOCAL) VALUES($ID_FUNCIONARIO, '$NOME', '$CPF', $EMAIL, $CELULAR, $RUA,
			$NUMERO, $BAIRRO, $CEP, $ID_LOCAL) ");
		}
    }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM funcionario WHERE ID_FUNCIONARIO = $codigo ");
	}
}
