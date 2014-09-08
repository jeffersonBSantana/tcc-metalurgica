<?php
  
require_once("DataBase.php");
require_once("Session.php");
require_once("Util.php");
  
class Bets
{
    var $database;
      
    public function __construct() {
    	Utils::setFullLimit();
        
    	$this->database = new DataBase();
    }
	      
	public function allGames() {
		$sql = "";
		$sql .= " SELECT CONCAT( TEAM1, ' X ', TEAM2, ' - ', DATE_FORMAT( `DATE` , '%d/%m/%Y' ) , ' ás ', HOUR ) AS TEAMS, ";
		$sql .= " ID_GAME, TEAM1, TEAM2 ";
		$sql .= " FROM GAMES ";
		$sql .= " WHERE ACTIVE = 1 AND STATUS = 0 ";
		
		return $this->database->select_sql( $sql );
	}
    
	public function all( $params ) {
    	$sql  = "";
		$sql .= " SELECT BETS.*, GAMES.TEAM1, GAMES.TEAM2, GAMES.VALUE, DATE_FORMAT( GAMES.DATE , '%d/%m/%Y' ) AS DATE, " ;
   		$sql .= " GAMES.HOUR, GAMES.STATUS, GAMES.RESULT1 AS R1, GAMES.RESULT2 AS R2 ";
		$sql .= " FROM BETS LEFT JOIN GAMES ON BETS.ID_GAME = GAMES.ID_GAME ";
        $sql .= " WHERE BETS.ACTIVE = 1 AND GAMES.ACTIVE = 1 AND BETS.ID_USER = " . Session::get( 'ID_USER' );
        $sql .= " ORDER BY GAMES.DATE DESC, GAMES.HOUR DESC ";

		$retorno = $this->database->select_sql( $sql );
        
		$arr = array();
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'VALUE' ] = Utils::formatCurrencyBr( $value['VALUE'] );
			
			$id_game = $retorno[ $key ][ 'ID_GAME' ];
			$team1   = $retorno[ $key ][ 'TEAM1'   ];
			$team2   = $retorno[ $key ][ 'TEAM2'   ];
			$date    = $retorno[ $key ][ 'DATE'    ];
			$hour    = $retorno[ $key ][ 'HOUR'    ];
			$status  = $retorno[ $key ][ 'STATUS'  ];
			$r1		 = $retorno[ $key ][ 'R1'  	   ];
			$r2	     = $retorno[ $key ][ 'R2'  	   ];
			
			$arr[ $id_game . "|" . $team1 . "|" . $team2 . "|" . $date . "|" . $hour . "|" . $status . "|" . $r1 . "|" . $r2 ][] = $value;
		}
		
		return $arr;
    }  
    
	public function allUsers( $params ) {
    	$sql  = "";
		$sql .= " SELECT BETS.*, USERS.NAME, GAMES.TEAM1, GAMES.TEAM2, GAMES.VALUE, DATE_FORMAT( GAMES.DATE , '%d/%m/%Y' ) AS DATE, ";
    	$sql .= " GAMES.HOUR, GAMES.STATUS, GAMES.RESULT1 AS R1, GAMES.RESULT2 AS R2 ";
		$sql .= " FROM BETS LEFT JOIN GAMES ON BETS.ID_GAME = GAMES.ID_GAME INNER JOIN USERS ON BETS.ID_USER = USERS.ID_USER ";
        $sql .= " WHERE BETS.ACTIVE = 1 AND GAMES.ACTIVE = 1 ";
        $sql .= " ORDER BY GAMES.DATE DESC, GAMES.HOUR DESC, USERS.NAME ";

		$retorno = $this->database->select_sql( $sql );
        
		$arr = array();
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'VALUE' ] = Utils::formatCurrencyBr( $value['VALUE'] );
			
			$id_game = $retorno[ $key ][ 'ID_GAME' ];
			$team1   = $retorno[ $key ][ 'TEAM1'   ];
			$team2   = $retorno[ $key ][ 'TEAM2'   ];
			$date    = $retorno[ $key ][ 'DATE'    ];
			$hour    = $retorno[ $key ][ 'HOUR'    ];
			$status  = $retorno[ $key ][ 'STATUS'  ];
			$r1		 = $retorno[ $key ][ 'R1'  	   ];
			$r2	     = $retorno[ $key ][ 'R2'  	   ];
			
			$arr[ $id_game . "|" . $team1 . "|" . $team2 . "|" . $date . "|" . $hour . "|" . $status . "|" . $r1 . "|" . $r2 ][] = $value;
		}
		
		return $arr;
    }
	
	public function edit( $params ) {		
		$codigo = utf8_decode($params['code']);
		
		$sql  = "";
        $sql .= " SELECT BETS.ID_BET, GAMES.ID_GAME, GAMES.TEAM1, BETS.RESULT1, GAMES.TEAM2, BETS.RESULT2 ";
		$sql .= " FROM BETS LEFT JOIN GAMES ON BETS.ID_GAME = GAMES.ID_GAME ";
        $sql .= " WHERE ID_USER = " . Session::get( 'ID_USER' );
		$sql .= " AND BETS.ID_BET = $codigo ";
        $sql .= " ORDER BY ID_BET ";
        
		$retorno = $this->database->select_sql( $sql );
		return $retorno[0];
	}						
       
    public function save( $params ) {		
    	$id_bet 	= utf8_decode( $params['id_bet'] );									    	
    	$id_game 	= utf8_decode( $params['id_game'] );
		$id_user	= Session::get( 'ID_USER' );
    	$result1	= utf8_decode( $params['result1'] );		
 		$result2 	= utf8_decode( $params['result2'] );		
		$pay	 	= utf8_decode( '0' );
		$active 	= utf8_decode( '1' );
 		
    	$params = array(
    		'ID_BET' 	=> $id_bet,
    		'ID_USER'	=> $id_user,
    		'ID_GAME' 	=> $id_game,
    		'RESULT1' 	=> $result1,
    		'RESULT2' 	=> $result2,
    		'PAY' 		=> $pay,
    		'ACTIVE' 	=> $active
    	);
				
		return (int) $this->database->execute_sp('SX_BETS', $params);
    }

	public function remove( $params ) {
		$code = utf8_decode($params['code']);
		return $this->database->execute_sql("UPDATE BETS SET ACTIVE = 0 WHERE ID_BET = $code ");
	}	
}