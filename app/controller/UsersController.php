<?php
  
require_once("Users.php");
  
class UsersController
{
    private $model; 
	
    public function __construct() {
        $this->model = new Users();
    }
      
    public function all( $params ) {
        return $this->model->all( $params );
    }
	
    public function editar( $params ) {
		return $this->model->editar( $params );
    }	
	
    public function salvar( $params ) {
    	parse_str( $params['formulario'], $params );
		return $this->model->salvar( $params );
    }

    public function remover( $params ) {
		return $this->model->remover( $params );
    }
}
  
$controller = new UsersController();

$method = $_POST['method'];
$params = $_POST;

echo json_encode( $controller->$method($params) );