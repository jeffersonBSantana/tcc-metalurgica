<?php
  
require_once("DataBase.php");
require_once("Session.php");

class Login
{
    var $database;
      
    public function __construct() {
        $this->database = new DataBase();
    }
      
    public function logar( $params=null ) {
    	$user = strtoupper(utf8_decode($params["username"]));
    	$password = strtoupper(utf8_decode($params["password"]));
		
		$sql  = "";
        $sql .= " SELECT * 
        	FROM usuarios
        	WHERE login = '$user'
        	AND senha = '$password' 
        	AND ativo = 1 ";
		
		$retorno = $this->database->select_sql( $sql );
        
		if ( $retorno != false ) {
			Session::create( $retorno[0] );
			return true;
		}
		
		return false;		
    }   
}