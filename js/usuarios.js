var Usuarios = {
	iniciar : function() {
		Usuarios.buscar();
		Usuarios.buscarFuncionarios();

		Usuarios.salvar();
	},
	buscar : function() {
		var id = '#table-usuarios';
		bootTable.clear( id );

		var params = {
			'metodo' : 'buscar',
			'ativo'  : $(id + ' #ativo').val()
		};
		$.post('?m=controller&c=UsuariosController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = {
		            "CODE" : values.ID_USUARIOS
		        };
		        var values = {
		        	"CODE"  	: values.ID_USUARIOS,
			        "LOGIN" 	: values.LOGIN,
		          	"SENHA" 	: values.SENHA,
			        "NOME"	 	: values.NOME,
			        "ATIVO"	 	: ( values.ATIVO == '1' ) ? 'Sim' : 'Não',
		          	"EDIT"  	: '<div onclick="Usuarios.editar('+values.ID_USUARIOS+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		          	"REMOVE"	: '<div onclick="Usuarios.remover('+values.ID_USUARIOS+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
		        };
		        bootTable.addItem(
		            id,
		            header,
		            values
		        );
		    });
		}, 'json');
	},
	buscarFuncionarios : function( id ) {
		var parametros = {
			'metodo' : 'buscarFuncionarios'
		};
		
		Select.remove_all_option('form-usuarios #ID_FUNCIONARIO');
		$.post('?m=controller&c=UsuariosController', parametros, function( data ) {
			var options = '<option value="" ></option>';
			$.each(data, function (key, value) {
		 		options += '<option value="'+value.ID_FUNCIONARIO+'" >'+value.NOME+'</option>';
		 	});

			$('#form-usuarios #ID_FUNCIONARIO').html( options );
		}, 'json');
	},
	ativo : function() {
		$('#table-usuarios #ativo').val( ( $('#table-usuarios #ativo').is(':checked') ) ? 1 : 0 );
		Usuarios.buscar();
	},
	limpar : function() {
		$('#panel-usuarios').show('slow');

		jQuery('#form-usuarios input:hidden').val('');
		$('#form-usuarios').each(function() { this.reset(); });

		$('#form-usuarios').find('input:visible,select:visible').first().focus();
	},
	inserir : function() {
		/* abre o panel */
		$('#panel-usuarios').toggle('slow');
		/* limpa o ID hidden */
		jQuery('#form-usuarios input:hidden').val('');
		/* limpa o formulario */
		$('#form-usuarios').each(function() { this.reset(); });
		/* posiciona o cursor */
		$('#form-usuarios').find('input:visible,select:visible').first().focus();
	},
	editar : function( id ) {
		var parametros = {
			'metodo' : 'editar',
			'codigo' : id
		};
		$.post('?m=controller&c=UsuariosController', parametros, function( data ) {
			$('#panel-usuarios').show('slow');

			$('#form-usuarios #ID_USUARIOS').val( data.ID_USUARIOS );
			$('#form-usuarios #LOGIN').val( data.LOGIN );
			$('#form-usuarios #SENHA').val( data.SENHA );

			var checked = ( data.ATIVO == 0 ) ? false : true;
			$('#form-usuarios #ATIVO').attr('checked', checked);
			$('#form-usuarios #ATIVO').val( data.ATIVO );

			$('#form-usuarios input[name=NIVEL_ACESSO]').filter('[value='+data.NIVEL_ACESSO+']').prop('checked', true);

			$('#form-usuarios #ID_FUNCIONARIO').val(data.ID_FUNCIONARIO);
		}, 'json');
	},
	salvar : function() {
		$('#form-usuarios').validate({
			submitHandler: function( form ) {
				var uc = [];
				$(':checkbox:not(:checked)', form).each(function() {
					uc.push(encodeURIComponent(this.name) + '=0');
				});
				var formulario = $( form ).serialize() + (uc.length ? '&'+uc.join('&').replace(/%20/g, "+") : '');

				var params = {
					'metodo' : 'salvar',
					'formulario' : formulario
				};
				$.post('?m=controller&c=UsuariosController', params, function( data ) {
					Usuarios.buscar();
					Usuarios.inserir();
				}, 'json');

				return false;
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
							'metodo' : 'remover',
							'codigo' : id
						};
						$.post('?m=controller&c=UsuariosController', params, function( data ) {
							if ( data == true ) {
								Usuarios.buscar();
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
