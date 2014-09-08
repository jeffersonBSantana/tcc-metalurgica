<?php
  
require_once("DataBase.php");
require_once("Util.php");
  
class Start
{
    var $database;
      
    public function __construct() {
    	Utils::setFullLimit();
        
    	$this->database = new DataBase();
    }
	      
	public function winners( $params ) {
    	$sql  = "";
		$sql .= " SELECT BETS.RESULT1, BETS.RESULT2, USERS.NAME, GAMES.TEAM1, GAMES.TEAM2, DATE_FORMAT( GAMES.DATE , '%d/%m/%Y' ) AS DATE, ";
    	$sql .= " GAMES.HOUR, GAMES.STATUS, GAMES.RESULT1 AS R1, GAMES.RESULT2 AS R2,  ";
    	$sql .= " ( SELECT SUM(VALUE) FROM GAMES G INNER JOIN BETS B ON B.ID_GAME = G.ID_GAME WHERE G.ID_GAME = GAMES.ID_GAME AND B.ACTIVE = BETS.ACTIVE AND G.ACTIVE = GAMES.ACTIVE AND B.PAY = BETS.PAY ) AS VLR ";
    	$sql .= " FROM BETS LEFT JOIN GAMES ON BETS.ID_GAME = GAMES.ID_GAME INNER JOIN USERS ON BETS.ID_USER = USERS.ID_USER ";
        $sql .= " WHERE BETS.ACTIVE = 1 AND GAMES.ACTIVE = 1 AND GAMES.STATUS = 2 ";
        $sql .= " AND BETS.RESULT1 = GAMES.RESULT1 AND BETS.RESULT2 = GAMES.RESULT2 AND BETS.PAY = 1 ";
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
			$vlr     = $retorno[ $key ][ 'VLR'	   ];
			
			$arr[ $id_game . "|" . $team1 . "|" . $team2 . "|" . $date . "|" . $hour . "|" . $status . "|" . $r1 . "|" . $r2 . "|" . $vlr ][] = $value;
		}
		
		return $arr;
	}
    
	public function all( $params ) {
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
	
	public function pay_change( $params ) {
		$id_bet = utf8_decode( $params['id_bet'] ); 
		$pay = utf8_decode( $params['pay'] );
		return $this->database->execute_sql("UPDATE BETS SET PAY = $pay WHERE ID_BET = $id_bet ");
	}
}