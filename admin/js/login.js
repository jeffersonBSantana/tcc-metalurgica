var Login = {
	inicio : function() {
		$('#form-login').validate({
			submitHandler: function( form ) {
				Login.logar();
				return false;
	        }
		});
	},
	logar : function() {
		var params = {
			'metodo' : 'logar',
			'formulario' : $("#form-login").serialize()
		};
		$.post('?m=controller&c=LoginController', params, function( data ) {
			if ( typeof data === "boolean" && data == true ) {
				window.setTimeout(function() { window.location.href = '?m=view'; }, 1000);
			}
			else {
				Alert.show('Usuário e/ou Senha Inválidos!');
			}
		}, 'json');
	}
};
