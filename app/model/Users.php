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
        $sql .= " FROM USERS ";
        $sql .= " WHERE ACTIVE = " . $params['active'];
        $sql .= " ORDER BY USERS.NAME ";
        
		$retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'NAME' ] = utf8_encode( $value['NAME'] );
		}
		return $retorno;
    }  
	
	public function edit( $params ) {
		$code = utf8_decode($params['code']);
		
    	$sql  = "";
        $sql .= " SELECT * FROM USERS ";
        $sql .= " WHERE ID_USER = " . $code;
			 
		$retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'NAME' ] = utf8_encode( $value['NAME'] );
		}
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
       
    public function save( $params ) {
    	if ( is_string($r = $this->validate( $params )) ) {
    		return $r;
    	}
     	
    	$id_user 		= utf8_decode( $params['id_user'] );
    	$name  			= utf8_decode( $params['name'] );		
 		$email 	 		= utf8_decode( $params['email'] );		
		$username 		= strtoupper(utf8_decode( $params['username'] ));
    	$password 		= strtoupper(utf8_decode( $params['password'] ));
    	$active 		= utf8_decode( $params['active'] );
    	$access_level	= utf8_decode( $params['access_level'] );
    	
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
    }

	public function remove( $params ) {
		$code = utf8_decode($params['code']);
		return $this->database->execute_sql("UPDATE USERS SET ACTIVE = 0 WHERE ID_USER = $code ");
	}	
}