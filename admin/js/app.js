// depois que carregar o html ele cai aqui dentro.
// tudo que é js tem que ter alguma chamada aqui.
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

	$('#menu-funcionario').click(function() {
		Menu.init('funcionario');
		Funcionarios.iniciar();
	});
	
	$('#menu-cliente').click(function() {
		Menu.init('cliente');
		Clientes.iniciar();
	});	

	$('#menu-localidade').click(function() {
		Menu.init('localidade');
		Localidade.iniciar();
	});
	
	$('#menu-perfil').click(function() {
		Menu.init('perfil');
		Perfil.iniciar();
	});	
	$('#menu-esquadria').click(function() {
		Menu.init('esquadria');
		Esquadria.iniciar();
	});
	$('#menu-produto').click(function() {
		Menu.init('produto');
		Produto.iniciar();
	});	
	$('#menu-orcamento').click(function() {
		Menu.init('orcamento');
		Orcamento.iniciar();
	});	
});
