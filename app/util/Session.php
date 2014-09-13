<?php

class Session {

	public static function start() {
		if ( !isset($_SESSION) )
			session_start();
	}

	public static function finish() {
		session_unset( $_SESSION );
	}

	public static function create( $retorno ) {
		$_SESSION['ID_USUARIOS'] 	= $retorno['ID_USUARIOS'];
		$_SESSION['LOGIN'] 			= $retorno['LOGIN'];
		$_SESSION['SENHA'] 			= $retorno['SENHA'];
		$_SESSION['NIVEL_ACESSO'] 	= $retorno['NIVEL_ACESSO'];
		$_SESSION['ATIVO'] 			= $retorno['ATIVO'];
		$_SESSION['ID_FUNCIONARIO'] = $retorno['ID_FUNCIONARIO'];
	}
	public static function createFunc( $retorno ) {
		$_SESSION['ID_FUNCIONARIO'] = $retorno['ID_FUNCIONARIO'];
		$_SESSION['NOME'] 			= $retorno['NOME'];
		$_SESSION['CPF'] 			= $retorno['CPF'];
		$_SESSION['EMAIL'] 			= $retorno['EMAIL'];
		$_SESSION['CELULAR'] 		= $retorno['CELULAR'];
		$_SESSION['RUA'] 			= $retorno['RUA'];
		$_SESSION['NUMERO']   		= $retorno['NUMERO'];
		$_SESSION['BAIRRO']   		= $retorno['BAIRRO'];
		$_SESSION['CEP'] 	  		= $retorno['CEP'];
		$_SESSION['ID_LOCAL'] 		= $retorno['ID_LOCAL'];
	}

	public static function get( $param ) {
		return $_SESSION[ $param ];
	}

	public static function validate() {
		if ( empty($_SESSION) ) {
			echo "<div style='color:#FF0000; font-style:italic; margin:10px auto 0; text-align:center; width:300px;' >";
			echo utf8_decode("<p>Voce nao esta logado! Realize o login!</p>");
			echo "</div>";
			echo "<script>";
			echo "window.setTimeout(function() {";
			echo "	window.location.href = '?';";
			echo "}, 2000);";
			echo "</script>";

			return false;
		}

		return true;
	}
}
