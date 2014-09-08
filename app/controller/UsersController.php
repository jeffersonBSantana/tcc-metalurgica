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
	
    public function edit( $params ) {
		return $this->model->edit( $params );
    }	
	
    public function save( $params ) {
    	parse_str( $params['form'], $params );
		return $this->model->save( $params );
    }

    public function remove( $params ) {
		return $this->model->remove( $params );
    }
}
  
$controller = new UsersController();

$method = $_POST['method'];
$params = $_POST;

echo json_encode( $controller->$method($params) );