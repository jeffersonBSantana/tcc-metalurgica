<?php

require_once("DataBase.php");
require_once("Util.php");

class Users
{
    var $database;

    public function __construct() {
    	Utils::setFullLimit();

        $this->database = new DataBase();
    }

    public function all( $params ) {
    	$sql  = "";
      $sql .= " SELECT * ";
      $sql .= " FROM usuarios ";
      $sql .= " WHERE ATIVO = " . $params['active'];

		  $retorno = $this->database->select_sql( $sql );
		  //foreach ($retorno as $key => $value) {
		  //	$retorno[ $key ][ 'NAME' ] = utf8_encode( $value['NAME'] );
		  //}
		  return $retorno;
    }

	public function editar( $params ) {
		$code = utf8_decode($params['codigo']);

    $sql  = "";
    $sql .= " SELECT * FROM usuarios ";
    $sql .= " WHERE ID_USUARIOS = " . $code;

		$retorno = $this->database->select_sql( $sql );
		// foreach ($retorno as $key => $value) {
		//	$retorno[ $key ][ 'NAME' ] = utf8_encode( $value['NAME'] );
		//}
		return $retorno[0];
  }

  public function salvar( $params ) {
    $ID_USUARIOS = utf8_decode( ($params['ID_USUARIOS'] == '') ? 0 : $params['ID_USUARIOS'] );
    $LOGIN 			 = strtoupper(utf8_decode( $params['LOGIN'] ));
    $SENHA 			 = strtoupper(utf8_decode( $params['SENHA'] ));
    $ATIVO 			 = utf8_decode( $params['ATIVO'] );

		if (  $params['ID_USUARIOS'] > 0 ) {
			return (int) $this->database->execute_sql(" UPDATE usuarios set LOGIN='$LOGIN',SENHA='SENHA',ATIVO='$ATIVO' WHERE ID_usuarios='ID_USUARIOS' ");
		} else {
			return (int) $this->database->execute_sql(" INSERT INTO usuarios(ID_usuarios, LOGIN, SENHA, ATIVO) VALUES($ID_USUARIOS, '$LOGIN', '$SENHA', 1) ");
		}
  }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM usuarios WHERE ID_USUARIOS = $codigo ");
	}
}
