<?php

defined('DS')
	|| define('DS', DIRECTORY_SEPARATOR);

defined('ROOT')
	|| define('ROOT', realpath(dirname(__FILE__)));

defined('FPDF')
	|| define('FPDF', realpath(ROOT . DS . "fpdf"));

require_once( FPDF . DS . 'fpdf.php' );
require_once( FPDF . DS . 'fpdftable.php' );

require_once("Session.php");

if ( !Session::validate() )
	exit;

$t = $_REQUEST['t'];
$id = $_REQUEST['id'];

if ( $t == 'orcamento' ) {
	require_once("RelatorioOrcamentoPDF.php");

	$pdf = new RelatorioOrcamentoPDF( $id );
	$pdf->Output();
}
