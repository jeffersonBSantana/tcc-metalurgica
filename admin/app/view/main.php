<?php
require_once("Session.php");

if ( !Session::validate() )
	exit;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Main</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<?php include_once('include-css.php'); ?>
	<?php include_once('include-js.php'); ?>
</head>
<body>
	<div class="container-fluid" >
		<div class="row">
			<div class="col-sm-2 ef-head">
				<?php include_once('mn-menu.php'); ?>
			</div>

			<div class="col-sm-10 ef-container">
				<?php
				include_once('mn-inicio.php');
				include_once('main-usuarios.php');
				include_once('main-funcionario.php');
				include_once('main-cliente.php');
				include_once('main-localidade.php');
				include_once('main-perfil.php');
				include_once('main-esquadria.php');
				include_once('main-medida.php');
				include_once('main-orcamento.php');
				?>
			</div>
		</div>
	</div>
</body>
</html>
