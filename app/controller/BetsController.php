<?php
  
require_once("Bets.php");
  
class BetsController
{
    private $model; 
	
    public function __construct() {
        $this->model = new Bets();
    }
      
	public function allGames( $params ) {
		return $this->model->allGames();
	}
    
	public function all( $params ) {
        return $this->model->all( $params );
    }
    
	public function allUsers( $params ) {
        return $this->model->allUsers( $params );
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
  
$controller = new BetsController();

$method = $_POST['method'];
$params = $_POST;

echo json_encode( $controller->$method($params) );