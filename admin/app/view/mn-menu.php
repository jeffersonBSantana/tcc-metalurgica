<?php require_once("Session.php"); ?>
<div class="menu-logo" >
	<img src="img/logo-white.png" class="img-responsive" alt="Responsive image" >
</div>
<div class="logout" >
	<span><?= Session::get('LOGIN'); ?></span>, <a href="?">Sair</a>
</div>
<div class="sidebar-nav" >
	<div class="navbar navbar-default" role="navigation">
		<div class="navbar-header" >
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
				<span class="sr-only">Menu</span>
				<span class="icon-bar" ></span>
				<span class="icon-bar" ></span>
				<span class="icon-bar" ></span>
			</button>
			<span class="visible-xs navbar-brand"></span>
		</div>
		<div id="menu" class="navbar-collapse collapse sidebar-navbar-collapse">
			<ul class="nav navbar-nav">
				<li><hr/></li>
				<li class="active"><a id="menu-inicio" href="javascript:void(0)" >Inicio</a></li>
				<li><hr/></li>
				<?php if ( (Session::get('NIVEL_ACESSO') == 0) || (Session::get('NIVEL_ACESSO') == 1) ) { // ouro & prata ?>
				<li><a id="menu-localidade" href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-right"></span>Localidade</a></li>
				<?php if ( Session::get('NIVEL_ACESSO') == 0 ) { // ouro ?>
				<li><a id="menu-funcionario" href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-right"></span>Funcionários</a></li>
				<li><a id="menu-usuarios" href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-right"></span>Usuários</a></li>
				<?php } ?>	
				<li><a id="menu-cliente" href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-right"></span>Clientes</a></li>
				<li><hr/></li>
				<li><a id="menu-perfil" href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-right"></span>Perfil</a></li>
				<li><a id="menu-esquadria" href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-right"></span>Esquadria</a></li>
				<li><a id="menu-produto" href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-right"></span>Produtos</a></li>
				<li><hr/></li>
				<?php } ?>	
				<li><a id="menu-orcamento" href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-right"></span>Orçamento</a></li>
			</ul>
		</div>
	</div>
</div>
