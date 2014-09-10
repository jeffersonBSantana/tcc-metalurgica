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
        $sql .= " WHERE ativo = " . $params['active'];
        
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
        $sql .= " WHERE ID_usuarios = " . $code;
			 
		$retorno = $this->database->select_sql( $sql );
		// foreach ($retorno as $key => $value) {
		//	$retorno[ $key ][ 'NAME' ] = utf8_encode( $value['NAME'] );
		//}
		return $retorno[0];
    }		

	private function userExist( $params ) {
		$params = utf8_decode($params);
		
    	$sql  = "";
        $sql .= " SELECT * FROM USERS ";
        $sql .= " WHERE USERS.USERNAME = '" . $params . "'";
        $sql .= " ORDER BY USERS.ID_USER ";
			 
       	return $this->database->select_sql( $sql );
	}
	
	private function emailExist( $params ) {
		$params = utf8_decode($params);
		 		
		$sql  = "";
		$sql .= " SELECT * FROM USERS ";
		$sql .= " WHERE USERS.EMAIL = '" . $params . "'";
		$sql .= " ORDER BY USERS.ID_USER ";
		 			 
		return $this->database->select_sql( $sql );
	}
	
	private function validate( $params ) {
		if ( $params['id_user'] == 0 ) 
		{
			$r = $this->userExist( $params['username'] );
			if ( is_array($r) ) 
				return 'Este usuário já está sendo usado.';
		
			$r = $this->emailExist( $params['email'] );
			if ( is_array($r) ) 
				return 'Este endereço de e-mail já está sendo usado.';
		}
		
		return true;
	}				
       
    public function salvar( $params ) {
    	
    	$ID_USUARIOS 	= utf8_decode( ($params['ID_USUARIOS'] == '') ? 0 : $params['ID_USUARIOS'] );
    	$LOGIN 			= strtoupper(utf8_decode( $params['LOGIN'] ));
    	$SENHA 			= strtoupper(utf8_decode( $params['SENHA'] ));
    	$ATIVO 			= utf8_decode( $params['ATIVO'] );
    	
		if (  $params['ID_USUARIOS'] > 0 ) {
			// fazer o update aqui
			return (int) $this->database->execute_sql(" INSERT INTO usuarios(ID_usuarios, Login, Senha, Ativo) VALUES($ID_USUARIOS, '$LOGIN', '$SENHA', 1) ");
		} else {
			return (int) $this->database->execute_sql(" INSERT INTO usuarios(ID_usuarios, Login, Senha, Ativo) VALUES($ID_USUARIOS, '$LOGIN', '$SENHA', 1) ");
		}
		
		
		
    	/*
		$params = array(
    		'ID_USER' 		=> $id_user,
    		'NAME' 			=> "'$name'",
    		'EMAIL' 		=> "'$email'",
    		'USERNAME' 		=> "'$username'",
    		'PASSWORD' 		=> "'$password'",
    	    'ACTIVE' 		=> $active,
    	    'ACCESS_LEVEL' 	=> $access_level
    	);
    	
    	return (int) $this->database->execute_sp('SX_USERS', $params);
		*/
    }

	public function remover( $params ) {
		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM usuarios WHERE ID_usuarios = $codigo ");
	}	
}