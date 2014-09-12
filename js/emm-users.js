var Usuarios = {
	iniciar : function() {
		Usuarios.todos();
		Usuarios.salvar();
	},
	todos : function() {
		var id = '#table-usuarios';
		bootTable.clear( id );

		var params = {
			'method' : 'all',
			'active' : $(id + ' #active').val()
		};
		$.post('?m=controller&c=UsersController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = {
		            "CODE" : values.ID_usuarios
		        };
		        var values = {
		        	"CODE"  		: values.ID_USUARIOS,
			        "LOGIN" 		: values.LOGIN,
		          "SENHA" 		: values.SENHA,
			        "ATIVO"	  	: ( values.ATIVO == '1' ) ? 'Sim' : 'Não',
		          "EDIT"  		: '<div onclick="Usuarios.editar('+values.ID_USUARIOS+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		          "REMOVE" 		: '<div onclick="Usuarios.remover('+values.ID_USUARIOS+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
		        };
		        bootTable.addItem(
		            id,
		            header,
		            values
		        );
		    });
		}, 'json');
	},
	ativo : function() {
		// $('#table-usuarios #active').val( ( $('#table-usuarios #active').is(':checked') ) ? 1 : 0 );
		// Users.all();
	},
	limpar : function() {
		// bootForm.resetar('Users');
	},
	inserir : function() {
		$('#panel-usuarios').toggle('slow'); // abre o panel

		jQuery('#form-usuarios input:hidden').val(''); // limpa o ID
		$('#form-usuarios').each(function() { this.reset(); });	 // limpa tudo

		$('#form-usuarios').find('input:visible,select:visible').first().focus(); // posiciona o cursor
	},
	editar : function( id ) {
		var parametros = {
			'method' : 'editar',
			'codigo' : id
		};
		$.post('?m=controller&c=UsersController', parametros, function( data ) {
			$('#panel-usuarios').show('slow');

			$('#form-usuarios #ID_USUARIOS').val( data.ID_usuarios );
			$('#form-usuarios #LOGIN').val( data.Login );
			$('#form-usuarios #SENHA').val( data.Senha );
		}, 'json');
	},
	salvar : function() {
		// bootForm.salvar('Users');

		$('#form-usuarios').validate({
			submitHandler: function( form ) {
				/*alterar*/
				// var uc = [];
				// $(':checkbox:not(:checked)', form).each(function() {
				//	uc.push(encodeURIComponent(this.name) + '=0');
				// });
				var f = $( form ).serialize(); // + (uc.length ? '&'+uc.join('&').replace(/%20/g, "+") : '');

				var params = {
					'method' : 'salvar',
					'formulario' : f
				};
				$.post('?m=controller&c=UsersController', params, function( data ) {
					//if ( typeof data == 'string' ) {
						//Alert.show( data );
					//}
					// else {
						Usuarios.todos();
						Usuarios.inserir();
					//}
				}, 'json');

				return false;
				/*alterar*/
	    }
		});

	},
	remover : function( id ) {
		bootbox.dialog({
	    	message : "Deseja deletar o registro?",
	    	title : "Atenção",
	    	buttons : {
				success: {
					label: "Sim",
					className: "btn-success",
					callback: function() {
						var params = {
							'method' : 'remover',
							'codigo' : id
						};
						$.post('?m=controller&c=UsersController', params, function( data ) {
							if ( data == true ) {
								Usuarios.todos();
							}
						}, 'json');
					}
				},
				main: {
					label: "Não",
					className: "btn-primary"
				}
	    	}
		});
	}
};
