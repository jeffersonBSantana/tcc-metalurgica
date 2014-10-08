<?php

require_once("DataBase.php");
require_once("Util.php");

class Orcamento
{
    var $database;

    public function __construct() {
        Utils::setFullLimit();
        $this->database = new DataBase();
    }

    public function buscar( $params ) {
    	$sql  = "";
        $sql .= " SELECT ORCAMENTO.*, FUNCIONARIO.NOME AS FUNCIONARIO, CLIENTE.* ";
        $sql .= " FROM ORCAMENTO ";
		$sql .= " INNER JOIN FUNCIONARIO ";
        $sql .= " ON ORCAMENTO.ID_FUNCIONARIO = FUNCIONARIO.ID_FUNCIONARIO ";
		$sql .= " INNER JOIN CLIENTE ";
        $sql .= " ON ORCAMENTO.ID_CLIENTE = CLIENTE.ID_CLIENTE ";
       	$sql .= " ORDER BY ORCAMENTO.ID_ORCAMENTO ";
	   
	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'DATA_ORCAMENTO' ] = utf8_encode(Utils::formatadata_sql($value['DATA_ORCAMENTO']));
		}
		return $retorno;
    }
	public function buscarItensOrcamento( $params ) {
		$code = utf8_decode($params['codigo']);
    	$sql  = "";
        $sql .= " SELECT ITEM_ORCAMENTO.*, ESQUADRIA.DESCRICAO";
        $sql .= " FROM ITEM_ORCAMENTO ";
		$sql .= " INNER JOIN ESQUADRIA ";
        $sql .= " ON ITEM_ORCAMENTO.ID_ESQUADRIA = ESQUADRIA.ID_ESQUADRIA ";
		$sql .= " WHERE ITEM_ORCAMENTO.ID_ORCAMENTO = " . $code;

	    $retorno = $this->database->select_sql( $sql );
		//foreach ($retorno as $key => $value) {
			//$retorno[ $key ][ 'DATA_ORCAMENTO' ] = utf8_encode(Utils::formatadata_sql($value['DATA_ORCAMENTO']));
		//}
		return $retorno;
    }

    public function buscarEsquadria( $params ) {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM ESQUADRIA ";
		$sql .= " INNER JOIN MEDIDA ";
        $sql .= " ON ESQUADRIA.ID_ESQUADRIA = MEDIDA.ID_ESQUADRIA ";
		$sql .= " ORDER BY 1";

	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'DESCRICAO' ] = utf8_encode( $value['DESCRICAO'] );
			$retorno[ $key ][ 'COLOCACAO' ] = utf8_encode( $value['COLOCACAO'] );
		}
		return $retorno;
    }
	public function buscarFuncionario( $params ) {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM FUNCIONARIO ";

	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'NOME' ]  = utf8_encode( $value['NOME'] );
			$retorno[ $key ][ 'EMAIL' ] = utf8_encode( $value['EMAIL'] );
			$retorno[ $key ][ 'RUA' ]   = utf8_encode( $value['RUA'] );
			$retorno[ $key ][ 'BAIRRO' ]= utf8_encode( $value['BAIRRO'] );
		}
		return $retorno;
    }

	public function buscarCliente( $params ) {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM CLIENTE ";

	    $retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'NOME' ]  = utf8_encode( $value['NOME'] );
			$retorno[ $key ][ 'EMAIL' ] = utf8_encode( $value['EMAIL'] );
			$retorno[ $key ][ 'RUA' ]   = utf8_encode( $value['RUA'] );
			$retorno[ $key ][ 'BAIRRO' ]= utf8_encode( $value['BAIRRO'] );
		}
		return $retorno;
    }

	public function editar( $params ) {
		$code = utf8_decode($params['codigo']);

        $sql  = "";
        $sql .= " SELECT * FROM ORCAMENTO ";
        $sql .= " WHERE ID_ORCAMENTO = " . $code;

		$retorno = $this->database->select_sql( $sql );
		$retorno[0][ 'DATA_ORCAMENTO' ] = Utils::formatadata_br($retorno[0][ 'DATA_ORCAMENTO' ]);
		return $retorno[0];
    }

  public function editarItens( $params ) {
    $code = utf8_decode($params['codigo']);

    $sql  = "";
    $sql .= " SELECT * FROM ITEM_ORCAMENTO ";
    $sql .= " WHERE ID_ORCAMENTO = " . $code;

    $retorno = $this->database->select_sql( $sql );
    foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'ALTURA' ]  = utf8_encode(Utils::formatCurrencyBr($value['ALTURA'] ));
			$retorno[ $key ][ 'LARGURA' ] = utf8_encode(Utils::formatCurrencyBr($value['LARGURA'] ));
			$retorno[ $key ][ 'VALOR_UNITARIO' ]   = utf8_encode(Utils::formatCurrencyBr($value['VALOR_UNITARIO'] ));
		}
		return $retorno;
  }

  public function salvar( $formulario, $tabela ) {
		$id_orcamento = $this->salvarOrcamento($formulario);

		foreach( $tabela as $key => $valeus ) {
			$r = $this->salvarItensOrcamentos($valeus, $id_orcamento);
		}

		return $r;
  }

    public function salvarOrcamento( $params ) {
        $ID_ORCAMENTO     = utf8_decode(($params['ID_ORCAMENTO'] == '') ? 0 : $params['ID_ORCAMENTO']);
		    $DATA_ORCAMENTO   = utf8_decode(Utils::formatadata_sql($params['DATA_ORCAMENTO']));
        $CONFIRMADO 	  = utf8_decode($params['CONFIRMADO']);
		    $ID_FUNCIONARIO   = utf8_decode($params['ID_FUNCIONARIO']);
        $ID_CLIENTE 	  = utf8_decode($params['ID_CLIENTE']);

  		if (  $params['ID_ORCAMENTO'] > 0 ) {
  			$r = $this->database->execute_sql(" UPDATE ORCAMENTO SET DATA_ORCAMENTO='$DATA_ORCAMENTO', CONFIRMADO='$CONFIRMADO',
  				ID_FUNCIONARIO='$ID_FUNCIONARIO', ID_CLIENTE='$ID_CLIENTE' WHERE ID_ORCAMENTO='$ID_ORCAMENTO' ");
        return $ID_ORCAMENTO;
  		}
      else {
  			return (int) $this->database->execute_sql_last_id(" INSERT INTO ORCAMENTO(DATA_ORCAMENTO, CONFIRMADO, ID_FUNCIONARIO, ID_CLIENTE)
  				VALUES('$DATA_ORCAMENTO', $CONFIRMADO, $ID_FUNCIONARIO, $ID_CLIENTE) ");
  		}
    }

    public function salvarItensOrcamentos( $params, $id_orcamento) {
    	$id_esquadria     	= utf8_decode(($params['id_esquadria'] == '') ? 0 : $params['id_esquadria']);
		$qtde           	= utf8_decode($params['qtde']);
      	$altura 	        = utf8_decode(Utils::formatCurrency($params['altura']));
		$largura 	        = utf8_decode(Utils::formatCurrency($params['largura']));
		$valor_unitario   	= utf8_decode(Utils::formatCurrency($params['valor_unitario']));
      	$cor 	            = utf8_decode($params['cor']);

      if ( $params['id_item_orcamento'] == 0 ) {
			  return (int) $this->database->execute_sql(" INSERT INTO ITEM_ORCAMENTO(ID_ESQUADRIA, QUANTIDADE, ALTURA, LARGURA, VALOR_UNITARIO, COR, ID_ORCAMENTO)
				  VALUES($id_esquadria, $qtde, $altura, $largura, $valor_unitario, $cor, $id_orcamento) ");
		  }
    }

  public function removerItemOrcamento( $params ) {
    $codigo = utf8_decode($params['codigo']);
    return $this->database->execute_sql("DELETE FROM ITEM_ORCAMENTO WHERE ID_ITEM_ORCAMENTO = $codigo ");
  }

	public function remover( $params ) {
    $codigo = utf8_decode($params['codigo']);
    $this->database->execute_sql("DELETE FROM ITEM_ORCAMENTO WHERE ID_ORCAMENTO = $codigo ");

		$codigo = utf8_decode($params['codigo']);
		return $this->database->execute_sql("DELETE FROM ORCAMENTO WHERE ID_ORCAMENTO = $codigo ");
	}
}
