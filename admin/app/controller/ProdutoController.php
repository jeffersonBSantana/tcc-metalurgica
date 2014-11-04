<?php

require_once("Produto.php");

class ProdutoController
{
    private $model;

    public function __construct() {
        $this->model = new Produto();
    }

    public function buscar( $params ) {
        return $this->model->buscar( $params );
    }
	
	public function buscarEsquadria( $params ) {
        return $this->model->buscarEsquadria( $params );
    }

    public function buscarPerfil( $params ) {
      	return $this->model->buscarPerfil( $params );
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

$controller = new ProdutoController();

$method = $_POST['metodo'];
$params = $_POST;

echo json_encode( $controller->$method($params) );
