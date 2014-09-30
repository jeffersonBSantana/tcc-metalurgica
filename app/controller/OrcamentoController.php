<?php

require_once("Orcamento.php");

class OrcamentoController
{
    private $model;

    public function __construct() {
        $this->model = new Orcamento();
    }

    public function buscar( $params ) {
        return $this->model->buscar( $params );
    }
	public function buscarItensOrcamento( $params ) {
        return $this->model->buscarItensOrcamento( $params );
    }
	public function buscarEsquadria( $params ) {
        return $this->model->buscarEsquadria( $params );
    }
	public function buscarFuncionario( $params ) {
        return $this->model->buscarFuncionario( $params );
    }

    public function buscarCliente( $params ) {
      	return $this->model->buscarCliente( $params );
    }
	
    public function editar( $params ) {
	    return $this->model->editar( $params );
    }

    public function salvar( $params ) {
        parse_str( $params['formulario'], $params );
	    return $this->model->salvar( $params );
    }

    public function remover( $params ) {
	    return $this->model->remover( $params );
    }
}

$controller = new OrcamentoController();

$method = $_POST['metodo'];
$params = $_POST;

echo json_encode( $controller->$method($params) );
