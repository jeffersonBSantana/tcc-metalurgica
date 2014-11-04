<?php

require_once("OrcamentoDataBase.php");
require_once("OrcamentoUtil.php");

class Orcamento
{
    var $database;

    public function __construct() {
        $this->database = new DataBase();
    }

    public function buscarEsquadria( $params ) {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM ESQUADRIA ";
		$sql .= " INNER JOIN PRODUTO ";
        $sql .= " ON ESQUADRIA.ID_ESQUADRIA = PRODUTO.ID_ESQUADRIA ";
		$sql .= " ORDER BY 1";

	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'DESCRICAO' ] = utf8_encode( $value['DESCRICAO'] );
			$retorno[ $key ][ 'COLOCACAO' ] = utf8_encode( $value['COLOCACAO'] );
		}
		return $retorno;
    }

	public function salvar( $formulario, $tabela ) {
		$id_cliente = $this->salvarCliente( $formulario );
		$id_orcamento = $this->salvarOrcamento($formulario, $id_cliente);

		foreach( $tabela as $key => $valeus ) {
			$r = $this->salvarItensOrcamentos($valeus, $id_orcamento);
		}

		return $id_orcamento;
	}
	
    public function salvarCliente( $params ) {
        $ID_CLIENTE     	= utf8_decode( 0 );
        $NOME 		    	= utf8_decode( mb_strtoupper( $params['NOME'], 'UTF-8' ));
        $EMAIL 		    	= utf8_decode( mb_strtoupper( $params['EMAIL'], 'UTF-8' ));
        $TELEFONE	    	= utf8_decode( $params['TELEFONE'] );
        		
	    $sql  = "";
        $sql .= " SELECT ID_CLIENTE ";
        $sql .= " FROM CLIENTE ";
		$sql .= " WHERE EMAIL = '$EMAIL' ";
		
		$retorno = $this->database->select_sql( $sql );
		if ( $retorno == false ) {
			return (int) $this->database->execute_sql_last_id(" INSERT INTO CLIENTE(ID_CLIENTE, NOME, EMAIL, TELEFONE) 
				VALUES($ID_CLIENTE, '$NOME', '$EMAIL', '$TELEFONE') ");
		} 
		else {
			return (int) $retorno[0]['ID_CLIENTE'];
		}
    }	

    public function salvarOrcamento( $params, $ID_CLIENTE ) {
        $ID_ORCAMENTO     = utf8_decode(($params['ID_ORCAMENTO'] == '') ? 0 : $params['ID_ORCAMENTO']);
	    $DATA_ORCAMENTO   = utf8_decode( date('Y-m-d') );
        $CONFIRMADO 	  = utf8_decode( 0 );
	    $ID_FUNCIONARIO   = 0;

		return (int) $this->database->execute_sql_last_id(" INSERT INTO ORCAMENTO(DATA_ORCAMENTO, CONFIRMADO, ID_FUNCIONARIO, ID_CLIENTE)
			VALUES('$DATA_ORCAMENTO', $CONFIRMADO, $ID_FUNCIONARIO, $ID_CLIENTE) ");
    }

    public function salvarItensOrcamentos( $params, $id_orcamento) {
    	$id_esquadria     	= utf8_decode(($params['id_esquadria'] == '') ? 0 : $params['id_esquadria']);
		$qtde           	= utf8_decode($params['qtde']);
      	$altura 	        = utf8_decode(Utils::formatCurrency($params['altura']));
		$largura 	        = utf8_decode(Utils::formatCurrency($params['largura']));
		$valor_unitario   	= utf8_decode(Utils::formatCurrency($params['valor_unitario']));
      	$cor 	            = utf8_decode($params['cor']);

      	return (int) $this->database->execute_sql(" INSERT INTO ITEM_ORCAMENTO(ID_ESQUADRIA, QUANTIDADE, ALTURA, LARGURA, VALOR_UNITARIO, COR, ID_ORCAMENTO)
			VALUES($id_esquadria, $qtde, $altura, $largura, $valor_unitario, $cor, $id_orcamento) ");		
    }
}