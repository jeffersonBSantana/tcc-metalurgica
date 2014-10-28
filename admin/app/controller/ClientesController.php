<?php

require_once("Clientes.php");

class ClientesController
{
    private $model;

    public function __construct() {
        $this->model = new Clientes();
    }

    public function buscar( $params ) {
        return $this->model->buscar( $params );
    }

    public function buscarLocalidade( $params ) {
        return $this->model->buscarLocalidade( $params );
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

$controller = new ClientesController();

$method = $_POST['metodo'];
$params = $_POST;

echo json_encode( $controller->$method($params) );
