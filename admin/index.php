<?php

// ** TODAS AS REQUISICOES DO SISTEMA PASSAM POR ESSE INDEX.PHP
// ** TUDO QUE FOR REQUISITADO DO HTML/JS PARA O PHP VAI PASSAR POR AQUI.

// ************************************************

// ** DEFINO O CAMINHO DAS PASTAS DO PROJETO EM VARIAVEIS
defined("DS") || define("DS", DIRECTORY_SEPARATOR);
defined("PS") || define("PS", PATH_SEPARATOR);
defined("R" ) || define("R" , dirname(__FILE__));
defined("A" ) || define("A" , R . DS . "app");
defined("C" ) || define("C" , A . DS . "controller");
defined("M" ) || define("M" , A . DS . "model");
defined("S" ) || define("S" , A . DS . "service");
defined("U" ) || define("U" , A . DS . "util");
defined("V" ) || define("V" , A . DS . "view");
defined("VI") || define("VI", V . DS . "includes");

// ** INSIRO TODAS AS PASTAS DO PROJETO NO PATH DO PHP
// ** EXEMPLO: EVITANDO O REQUIRE_ONCE('APP/VIEW/MAIN.PHP')
set_include_path(get_include_path() . PS . C);
set_include_path(get_include_path() . PS . M);
set_include_path(get_include_path() . PS . S);
set_include_path(get_include_path() . PS . U);
set_include_path(get_include_path() . PS . V);
set_include_path(get_include_path() . PS . VI);

// ******************** //
// **  TRACE ROUTER	 ** //
// ******************** //

// cria a sessao
require_once("Session.php");
Session::start();

if ( isset($_GET) ) {
	$m = isset($_GET['m']) ? $_GET['m'] : null;  // - pasta
	$c = isset($_GET['c']) ? $_GET['c'] : null;  // - arquivo .php
}

if (isset($m) && !empty($m)) {
	if (!isset($c) && empty($c)) {
		$c = 'main';
	}

	// chama o main - todas as requisicoes fora a logout caem aqui.
	include_once(A . DS . $m . DS . $c . ".php");
	exit;
}

// finaliza a sessao
Session::finish();
// chama o login
include_once(V . DS . "mn-login.php");
