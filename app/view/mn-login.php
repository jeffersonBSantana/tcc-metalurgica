<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8" >
	<title>Sistema</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<?php include_once('include-css.php'); ?>
</head>
<body>
	<div class="container">
	    <div class="row">
	        <div class="col-sm-6 col-md-4 col-md-offset-4">
	            <h1 class="text-center login-title">Acesso</h1>
	            <div class="account-wall">
	                <img class="profile-img" src="img/logo.png" alt="" >
	                <form id="form-login" name="form-login" class="form-signin" >
        						<div class="input-group margin-bottom-sm">
        						  	<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
        			          <input id="username" name="username" type="text" class="form-control" placeholder="Usuário" required autofocus >
        						</div>
        						<div class="input-group margin-bottom-sm">
        						  	<span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
        			          <input id="password" name="password" type="password" class="form-control" placeholder="Senha" required >
        						</div>
        						<br />
		                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		                <label class="checkbox pull-left"></label>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>

	<?php include_once('include-js.php'); ?>
</body>
</html>
