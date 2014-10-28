<?php

// ************************************************
// ** INIT ROUTER
defined("DS") || define("DS", DIRECTORY_SEPARATOR);
defined("PS") || define("PS", PATH_SEPARATOR);

// ** ROOT
defined("R") || define("R", dirname(__FILE__));

// ** APP
defined("A") || define("A", R . DS . "app");

// ** MODEL, VIEW, CONTROLLER, SERVICE, UTIL
defined("C" ) || define("C" , A . DS . "controller");
defined("M" ) || define("M" , A . DS . "model");
defined("S" ) || define("S" , A . DS . "service");
defined("U" ) || define("U" , A . DS . "util");
defined("V" ) || define("V" , A . DS . "view");
defined("VI") || define("VI", V . DS . "includes");

// ** INCLUDE PATH
set_include_path(get_include_path() . PS . C);
set_include_path(get_include_path() . PS . M);
set_include_path(get_include_path() . PS . S);
set_include_path(get_include_path() . PS . U);
set_include_path(get_include_path() . PS . V);
set_include_path(get_include_path() . PS . VI);

// ******************** //
// **  TRACE ROUTER	 ** //
// ******************** //
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

	include_once(A . DS . $m . DS . $c . ".php");
	exit;
}

Session::finish();
include_once(V . DS . "mn-login.php");
