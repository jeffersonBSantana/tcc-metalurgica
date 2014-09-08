<?php
  
require_once("Games.php");
  
class GamesController
{
    private $model; 
	
    public function __construct() {
        $this->model = new Games();
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

    public function finalized( $params ) {
   		parse_str( $params['form'], $params );
    	return $this->model->finalized( $params );
    }
    
    public function finalized_bets( $params ) {
		return $this->model->finalized_bets( $params );
    }
    
    public function remove( $params ) {
		return $this->model->remove( $params );
    }
}
  
$controller = new GamesController();

$method = $_POST['method'];
$params = $_POST;

echo json_encode( $controller->$method($params) );