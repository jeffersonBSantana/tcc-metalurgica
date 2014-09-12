$(document).ready(function() {
	Login.inicio();

	Menu.init('inicio');
	$('#menu-inicio').click(function() {
		Menu.init('inicio');
	});

	$('#menu-usuarios').click(function() {
		Menu.init('usuarios');
		Usuarios.iniciar();
	});
});
