<?php require_once("Session.php"); ?>
<div class="menu-logo" >
	<img src="img/logo2.png" class="img-responsive" alt="Responsive image" >
</div>
<div class="logout" >
	<span><?= Session::get('NAME'); ?></span>, <a href="?">Sair</a>
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
				<li class="active"><a id="menu-start" href="javascript:void(0)" >Inicio</a></li>
				<?php if ( Session::get('ACCESS_LEVEL') == '2' || Session::get('ACCESS_LEVEL') == '1' ) { ?>
				<li><hr/></li>
				<?php if ( Session::get('ACCESS_LEVEL') == '2' ) { ?>
				<li><a id="menu-users" href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-right"></span>Usuarios</a></li>
				<?php } ?>	
				<li><a id="menu-games" href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-right"></span>Games</a></li>
				<?php } ?>	
				<li><hr/></li>
				<li><a id="menu-bets" href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-right"></span>Apostas</a></li>
			</ul>
		</div>
	</div>
</div>