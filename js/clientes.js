var Clientes = {
	iniciar : function() {
		Clientes.buscar();
		Clientes.buscarLocalidade();

		Clientes.salvar();
	},
	buscar : function() {
		var id = '#table-cliente';
		bootTable.clear( id );




		var params = {
			'metodo' : 'buscar',
			'ativo'  : $(id + ' #ativo').val()
		};
		$.post('?m=controller&c=ClientesController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = {
		            "CODE" : values.ID_CLIENTE
		        };
		        var values = {
		        	"CODE"  		: values.ID_CLIENTE,
			        "NOME" 			: values.NOME,
		          	"CPF_CNPJ" 		: values.CPF_CNPJ,
					"EMAIL" 		: values.EMAIL,
		          	"TELEFONE" 		: values.TELEFONE,
		          	"CELULAR" 		: values.CELULAR,
					"RUA" 			: values.RUA,
		          	"NUMERO" 		: values.NUMERO,
					"BAIRRO" 		: values.BAIRRO,
		          	"CEP" 			: values.CEP,
					"ID_LOCALIDADE" : values.CIDADE + ' - ' + values.SIGLA,
			        "EDIT"  		: '<div onclick="Clientes.editar('+values.ID_CLIENTE+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		          	"REMOVE"		: '<div onclick="Clientes.remover('+values.ID_CLIENTE+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
		        };
		        bootTable.addItem(
		            id,
		            header,
		            values
		        );
		    });
		}, 'json');
	},
	buscarLocalidade : function( id ) {
		var parametros = {
			'metodo' : 'buscarLocalidade'
		};

		Select.remove_all_option('form-cliente #ID_LOCALIDADE');
		$.post('?m=controller&c=ClientesController', parametros, function( data ) {
			var options = '<option value="" ></option>';
			$.each(data, function (key, value) {
		 		options += '<option value="'+value.ID_LOCALIDADE+'" >'+value.CIDADE+' - '+value.SIGLA+'</option>';
		 	});

			$('#form-cliente #ID_LOCALIDADE').html( options );
		}, 'json');
	},
	ativo : function() {
		$('#table-cliente #ativo').val( ( $('#table-cliente #ativo').is(':checked') ) ? 1 : 0 );
		Clientes.buscar();
	},
	limpar : function() {
		$('#panel-cliente').show('slow');

		jQuery('#form-cliente input:hidden').val('');
		$('#form-cliente').each(function() { this.reset(); });

		$('#form-cliente').find('input:visible,select:visible').first().focus();
	},
	inserir : function() {
		/* abre o panel */
		$('#panel-cliente').toggle('slow');
		/* limpa o ID hidden */
		jQuery('#form-cliente input:hidden').val('');
		/* limpa o formulario */
		$('#form-cliente').each(function() { this.reset(); });
		/* posiciona o cursor */
		$('#form-cliente').find('input:visible,select:visible').first().focus();
	},
	editar : function( id ) {
		var parametros = {
			'metodo' : 'editar',
			'codigo' : id
		};
		$.post('?m=controller&c=ClientesController', parametros, function( data ) {
			$('#panel-cliente').show('slow');

			$('#form-cliente #ID_CLIENTE').val( data.ID_CLIENTE );
			$('#form-cliente #NOME').val( data.NOME );
			$('#form-cliente #CPF_CNPJ').val( data.CPF_CNPJ );
			$('#form-cliente #EMAIL').val( data.EMAIL );
			$('#form-cliente #TELEFONE').val( data.TELEFONE );
			$('#form-cliente #CELULAR').val( data.CELULAR );
			$('#form-cliente #RUA').val( data.RUA );
			$('#form-cliente #NUMERO').val( data.NUMERO );
			$('#form-cliente #BAIRRO').val( data.BAIRRO );
			$('#form-cliente #CEP').val( data.CEP );

			var checked = ( data.ATIVO == 0 ) ? false : true;
			$('#form-cliente #ATIVO').attr('checked', checked);
			$('#form-cliente #ATIVO').val( data.ATIVO );
			$('#form-cliente #ID_LOCALIDADE').val(data.ID_LOCALIDADE);
		}, 'json');
	},
	salvar : function() {
		$('#form-cliente').validate({
			submitHandler: function( form ) {
				var formulario = $( form ).serialize();
				var params = {
					'metodo' : 'salvar',
					'formulario' : formulario
				};
				$.post('?m=controller&c=ClientesController', params, function( data ) {
					Clientes.buscar();
					Clientes.inserir();
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
						$.post('?m=controller&c=ClientesController', params, function( data ) {
							if ( data == true ) {
								Clientes.buscar();
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