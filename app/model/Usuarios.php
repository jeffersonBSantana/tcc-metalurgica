<?php

require_once("DataBase.php");
require_once("Util.php");

class Usuarios
{
    var $database;

    public function __construct() {
        Utils::setFullLimit();
        $this->database = new DataBase();
    }

    public function buscar( $params ) {
    	$sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM USUARIOS ";
        $sql .= " WHERE ATIVO = " . $params['ativo'];

	    return $this->database->select_sql( $sql );
    }

    public function buscarFuncionarios( $params ) {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM FUNCIONARIO ";

        return $this->database->select_sql( $sql );
    }

	public function editar( $params ) {
		$code = utf8_decode($params['codigo']);

        $sql  = "";
        $sql .= " SELECT * FROM USUARIOS ";
        $sql .= " WHERE ID_USUARIOS = " . $code;

		$retorno = $this->database->select_sql( $sql );
		return $retorno[0];
    }

    public function salvar( $params ) {
        $ID_USUARIOS        = utf8_decode( ($params['ID_USUARIOS'] == '') ? 0 : $params['ID_USUARIOS'] );
        $LOGIN 		        = strtoupper(utf8_decode( $params['LOGIN'] ));
        $SENHA 		        = strtoupper(utf8_decode( $params['SENHA'] ));
        $NIVEL_ACESSO       = utf8_decode( $params['NIVEL_ACESSO'] );
        $ATIVO 		        = utf8_decode( $params['ATIVO'] );
        $ID_FUNCIONARIO     = utf8_decode( $params['ID_FUNCIONARIO'] );

		if (  $params['ID_USUARIOS'] > 0 ) {
			return (int) $this->database->execute_sql(" UPDATE USUARIOS SET LOGIN='$LOGIN', SENHA='$SENHA', NIVEL_ACESSO='$NIVEL_ACESSO', ATIVO='$ATIVO', ID_FUNCIONARIO='$ID_FUNCIONARIO' WHERE ID_USUARIOS='$ID_USUARIOS' ");
		}
        else {
			return (int) $this->database->execute_sql(" INSERT INTO USUARIOS(ID_USUARIOS, LOGIN, SENHA, NIVEL_ACESSO, ATIVO, ID_FUNCIONARIO) VALUES($ID_USUARIOS, '$LOGIN', '$SENHA', '$NIVEL_ACESSO', '$ATIVO', '$ID_FUNCIONARIO') ");
		}
    }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM USUARIOS WHERE ID_USUARIOS = $codigo ");
	}
}
