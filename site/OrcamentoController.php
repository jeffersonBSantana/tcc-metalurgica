<?php

require_once("Orcamento.php");

class OrcamentoController
{
    private $model;

    public function __construct() {
        $this->model = new Orcamento();
    }

	public function buscarEsquadria( $params ) {
        return $this->model->buscarEsquadria( $params );
    }

    public function salvar( $params ) {
    	$tabela = $params['tabela'];
		parse_str( $params['formulario'], $formulario );

	    return $this->model->salvar( $formulario, $tabela );
    }
}

$controller = new OrcamentoController();

$method = $_POST['metodo'];
$params = $_POST;

echo json_encode( $controller->$method($params) );