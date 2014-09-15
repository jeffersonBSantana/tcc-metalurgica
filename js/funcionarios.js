var Funcionarios = {
	iniciar : function() {
		Funcionarios.buscar();
		Funcionarios.buscarFuncionarios(); // nao seria buscar localidades?

		Funcionarios.salvar();
	},
	buscar : function() {
		var id = '#table-funcionario';
		bootTable.clear( id );

		var params = {
			'metodo' : 'buscar',
			'ativo'  : $(id + ' #ativo').val()
		};
		$.post('?m=controller&c=FuncionariosController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = {
		            "CODE" : values.ID_FUNCIONARIO
		        };
		        var values = {
		        	"CODE"  	: values.ID_FUNCIONARIO,
			        "NOME" 		: values.NOME,
		          	"CPF" 		: values.CPF,
					"EMAIL" 	: values.EMAIL,
		          	"CELULAR" 	: values.CELULAR,
					"RUA" 		: values.RUA,
		          	"NUMERO" 	: values.NUMERO,
					"BAIRRO" 	: values.BAIRRO,
		          	"CEP" 		: values.CEP,
					"ID_LOCAL" 	: values.ID_LOCAL,
			        "ATIVO"	 	: ( values.ATIVO == '1' ) ? 'Sim' : 'Não',
		          	"EDIT"  	: '<div onclick="Funcionarios.editar('+values.ID_FUNCIONARIO+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		          	"REMOVE"	: '<div onclick="Funcionarios.remover('+values.ID_FUNCIONARIO+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
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

		Select.remove_all_option('form-funcionario #ID_FUNCIONARIO');
		$.post('?m=controller&c=FuncionariosController', parametros, function( data ) {
			var options = '<option value="" ></option>';
			$.each(data, function (key, value) {
		 		options += '<option value="'+value.ID_FUNCIONARIO+'" >'+value.NOME+'</option>';
		 	});

			$('#form-funcionario #ID_FUNCIONARIO').html( options );
		}, 'json');
	},
	// Nao tem ativo na tabela funcionario, logo este item nao precisa...
	ativo : function() {
		$('#table-funcionario #ativo').val( ( $('#table-funcionario #ativo').is(':checked') ) ? 1 : 0 );
		Funcionarios.buscar();
	},
	limpar : function() {
		$('#panel-funcionario').show('slow');

		jQuery('#form-funcionario input:hidden').val('');
		$('#form-funcionario').each(function() { this.reset(); });

		$('#form-funcionario').find('input:visible,select:visible').first().focus();
	},
	inserir : function() {
		/* abre o panel */
		$('#panel-funcionario').toggle('slow');
		/* limpa o ID hidden */
		jQuery('#form-funcionario input:hidden').val('');
		/* limpa o formulario */
		$('#form-funcionario').each(function() { this.reset(); });
		/* posiciona o cursor */
		$('#form-funcionario').find('input:visible,select:visible').first().focus();
	},
	editar : function( id ) {
		var parametros = {
			'metodo' : 'editar',
			'codigo' : id
		};
		$.post('?m=controller&c=FuncionariosController', parametros, function( data ) {
			$('#panel-funcionario').show('slow');

			$('#form-funcionario #ID_FUNCIONARIO').val( data.ID_FUNCIONARIO );
			$('#form-funcionario #NOME').val( data.NOME );
			$('#form-funcionario #CPF').val( data.CPF );
			$('#form-funcionario #EMAIL').val( data.EMAIL );
			$('#form-funcionario #CELULAR').val( data.CELULAR );
			$('#form-funcionario #RUA').val( data.RUA );
			$('#form-funcionario #NUMERO').val( data.NUMERO );
			$('#form-funcionario #BAIRRO').val( data.BAIRRO );
			$('#form-funcionario #CEP').val( data.CEP );

			var checked = ( data.ATIVO == 0 ) ? false : true;
			$('#form-funcionario #ATIVO').attr('checked', checked);
			$('#form-funcionario #ATIVO').val( data.ATIVO );

			//$('#form-funcionario input[name=NIVEL_ACESSO]').filter('[value='+data.NIVEL_ACESSO+']').prop('checked', true);

			$('#form-funcionario #ID_LOCAL').val(data.ID_LOCAL);
		}, 'json');
	},
	salvar : function() {
		$('#form-funcionario').validate({
			submitHandler: function( form ) {
				//*** so usamos isso para checkbox, nao temos o ativo na tabela funcionarios
				// var uc = [];
				// $(':checkbox:not(:checked)', form).each(function() {
				//	uc.push(encodeURIComponent(this.name) + '=0');
				// });
				var formulario = $( form ).serialize(); // + (uc.length ? '&'+uc.join('&').replace(/%20/g, "+") : '');

				var params = {
					'metodo' : 'salvar',
					'formulario' : formulario
				};
				$.post('?m=controller&c=FuncionariosController', params, function( data ) {
					Funcionarios.buscar();
					Funcionarios.inserir();
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
						$.post('?m=controller&c=FuncionariosController', params, function( data ) {
							if ( data == true ) {
								Funcionarios.buscar();
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
