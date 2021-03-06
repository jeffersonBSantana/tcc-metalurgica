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
    public function editarItens( $params ) {
      return $this->model->editarItens( $params );
    }

    public function salvar( $params ) {
    	$tabela = $params['tabela'];
		parse_str( $params['formulario'], $formulario );

	    return $this->model->salvar( $formulario, $tabela );
    }

    public function remover( $params ) {
	    return $this->model->remover( $params );
    }

  public function removerItemOrcamento( $params ) {
    return $this->model->removerItemOrcamento( $params );
  }
}

$controller = new OrcamentoController();

$method = $_POST['metodo'];
$params = $_POST;

echo json_encode( $controller->$method($params) );
