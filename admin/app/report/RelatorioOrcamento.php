<?php

require_once("DataBase.php");

class RelatorioOrcamento
{
	var $database;
	var $id;
	
  	public function __construct( $id ) {
		$this->database = new DataBase();
		$this->id = $id;
	}

	public function cabecalho() {
		$sql = " SELECT O.ID_ORCAMENTO AS CODIGO, O.DATA_ORCAMENTO AS DATA, 
				O.CONFIRMADO, F.ID_FUNCIONARIO, F.NOME,F.CELULAR,F.EMAIL,
				E.NOME AS CLIENTE, E.TELEFONE AS CLIENTE_TELEFONE,E.RUA,E.NUMERO,E.BAIRRO,E.CPF_CNPJ,
				E.CELULAR AS CLIENTE_CELULAR, E.EMAIL AS CLIENTE_EMAIL, L.CIDADE
			FROM ORCAMENTO O
			LEFT JOIN FUNCIONARIO F
			ON O.ID_FUNCIONARIO = F.ID_FUNCIONARIO
			LEFT JOIN CLIENTE E
			ON O.ID_CLIENTE = E.ID_CLIENTE
			LEFT JOIN LOCALIDADE L
			ON E.ID_LOCALIDADE = L.ID_LOCALIDADE
			WHERE O.ID_ORCAMENTO = " . $this->id;

		$r = $this->database->select_sql( $sql );
		return $r[0];
	}
	
	public function itensOrcamentos() {
		$sql = " SELECT ID_ITEM_ORCAMENTO AS CODIGO, QUANTIDADE, ALTURA, LARGURA, VALOR_UNITARIO, COR, E.DESCRICAO
			FROM ITEM_ORCAMENTO I 
			INNER JOIN ESQUADRIA E 
			ON I.ID_ESQUADRIA = E.ID_ESQUADRIA 
			WHERE I.ID_ORCAMENTO = " . $this->id;

		return $this->database->select_sql( $sql );
	}	
}
