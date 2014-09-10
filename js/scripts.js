$(document).ready(function() {
	Login.init();

	Menu.init('start');

	$('#menu-start').click(function() {
		Menu.init('start');
	});

	$('#menu-users').click(function() {
		Menu.init('users');
		Usuarios.iniciar();
	});
});
