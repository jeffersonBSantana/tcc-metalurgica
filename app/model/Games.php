<?php
  
require_once("DataBase.php");
require_once("Util.php");
  
class Games
{
    var $database;
      
    public function __construct() {
    	Utils::setFullLimit();
        
    	$this->database = new DataBase();
    }
	      
    public function all( $params ) {
    	$sql  = "";
        $sql .= " SELECT * FROM GAMES ";
        $sql .= " WHERE ACTIVE = " . $params['active'];
        $sql .= " ORDER BY GAMES.ID_GAME ";

		$retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'VALUE' ] = Utils::formatCurrencyBr( $value['VALUE'] );
			$retorno[ $key ][ 'DATE'  ] = Utils::formatadata_br( $value['DATE'] );
			$retorno[ $key ][ 'HOUR'  ] = Utils::formatHours( $value['HOUR'] );
		}
		return $retorno;
    }  
	
	public function edit( $params ) {		
		$codigo = utf8_decode($params['code']);
		
    	$sql  = "";
        $sql .= " SELECT * FROM GAMES ";
        $sql .= " WHERE ID_GAME = " . $codigo;
        $sql .= " ORDER BY ID_GAME ";
			 
		$retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'VALUE' ] = Utils::formatCurrencyBr( $value['VALUE'] );
			$retorno[ $key ][ 'DATE'  ] = Utils::formatadata_br( $value['DATE'] );
			$retorno[ $key ][ 'HOUR'  ] = Utils::formatHours( $value['HOUR'] );
		}
		return $retorno[0];
	}						
       
    public function save( $params ) {					    	
    	$id_game 		= utf8_decode( $params['id_game'] );
    	$team1 			= utf8_decode( strtoupper(Utils::substituirCaracteresEspeciais($params['team1'])) );		
 		$team2 	 		= utf8_decode( strtoupper(Utils::substituirCaracteresEspeciais($params['team2'])) );		
		$value 			= utf8_decode( Utils::formatCurrency($params['value']) );
    	$date 			= utf8_decode( Utils::formatadata_sql($params['date']) );
    	$hour 			= utf8_decode( $params['hour'] . ':00' );
		$result1 		= utf8_decode( '0' );
    	$result2 		= utf8_decode( '0' );
		$status 		= utf8_decode( '0' );
		$active 		= utf8_decode( $params['active'] );
		
    	$params = array(
    		'ID_GAME' 			=> $id_game,
    		'TEAM1' 			=> "'$team1'",
    		'TEAM2' 			=> "'$team2'",
    		'VALUE' 			=> $value,
    		'DATE' 				=> "'$date'",
    	    'HOUR' 				=> "'$hour'",
    	    'RESULT1'			=> $result1,
    	    'RESULT2'			=> $result2,
    	    'STATUS'			=> $status,
    		'ACTIVE' 			=> $active,
    	);
				
		return (int) $this->database->execute_sp('SX_GAMES', $params);
    }

	public function finalized( $params ) {
		$id_game = utf8_decode($params['id_game']); 
		$result1 = utf8_decode($params['result1']);
		$result2 = utf8_decode($params['result2']);
		return $this->database->execute_sql("UPDATE GAMES SET STATUS = 2, RESULT1 = $result1, RESULT2 = $result2 WHERE ID_GAME = $id_game ");
	}	
	
	public function finalized_bets( $params ) {
		$code = utf8_decode($params['code']);
		return $this->database->execute_sql("UPDATE GAMES SET STATUS = 1 WHERE ID_GAME = $code ");
	}	
	
	public function remove( $params ) {
		$code = utf8_decode($params['code']);
		return $this->database->execute_sql("UPDATE GAMES SET ACTIVE = 0 WHERE ID_GAME = $code ");
	}	
}