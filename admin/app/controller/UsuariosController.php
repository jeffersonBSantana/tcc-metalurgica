<?php

require_once("Usuarios.php");

class UsuariosController
{
    private $model;

    public function __construct() {
        $this->model = new Usuarios();
    }

    public function buscar( $params ) {
        return $this->model->buscar( $params );
    }

    public function buscarFuncionarios( $params ) {
        return $this->model->buscarFuncionarios( $params );
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

$controller = new UsuariosController();

$method = $_POST['metodo'];
$params = $_POST;

echo json_encode( $controller->$method($params) );
