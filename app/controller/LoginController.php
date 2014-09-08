<?php

require_once("Login.php");

class LoginController
{
    private $model; 
    
    public function __construct() {
		$this->model = new Login();
    }
    
	public function logar($params) {
    	parse_str( $params['form'], $params );
		return $this->model->logar($params);
    }
}

$controller = new LoginController();

$method     = $_POST['method'];
$params 	= $_POST;

echo json_encode( $controller->$method($params) );