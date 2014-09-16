var Localidade = {
	iniciar : function() {
		Localidade.buscar();
		Localidade.buscarLocalidade(); // nao seria buscar localidades?

		Localidade.salvar();
	},
	buscar : function() {
		var id = '#table-localidade';
		bootTable.clear( id );

		var params = {
			'metodo' : 'buscar',
			//'ativo'  : $(id + ' #ativo').val()
		};
		$.post('?m=controller&c=LocalidadeController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = {
		            "CODE" : values.ID_LOCALIDADE
		        };
		        var values = {
		        	"CODE"  	: values.ID_LOCALIDADE,
			        "CIDADE" 	: values.CIDADE,
		          	"ESTADO" 	: values.ESTADO,
					"SIGLA" 	: values.SIGLA,
		          	"EDIT"  	: '<div onclick="Localidade.editar('+values.ID_LOCALIDADE+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		          	"REMOVE"	: '<div onclick="Localidade.remover('+values.ID_LOCALIDADE+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
		        };
		        bootTable.addItem(
		            id,
		            header,
		            values
		        );
		    });
		}, 'json');
	},
	buscar : function( id ) {
		var parametros = {
			'metodo' : 'buscar'
		};

		Select.remove_all_option('form-localidade #ID_LOCALIDADE');
		$.post('?m=controller&c=LocalidadeController', parametros, function( data ) {
			var options = '<option value="" ></option>';
			$.each(data, function (key, value) {
		 		options += '<option value="'+value.ID_LOCALIDADE+'" >'+value.CIDADE+'</option>';
		 	});

			$('#form-localidade #ID_LOCALIDADE').html( options );
		}, 'json');
	},
	// Nao tem ativo na tabela funcionario, logo este item nao precisa...
	//ativo : function() {
		//$('#table-funcionario #ativo').val( ( $('#table-funcionario #ativo').is(':checked') ) ? 1 : 0 );
		//Funcionarios.buscar();
	//},
	limpar : function() {
		$('#panel-localidade').show('slow');

		jQuery('#form-localidade input:hidden').val('');
		$('#form-localidade').each(function() { this.reset(); });

		$('#form-localidade').find('input:visible,select:visible').first().focus();
	},
	inserir : function() {
		/* abre o panel */
		$('#panel-localidade').toggle('slow');
		/* limpa o ID hidden */
		jQuery('#form-localidade input:hidden').val('');
		/* limpa o formulario */
		$('#form-localidade').each(function() { this.reset(); });
		/* posiciona o cursor */
		$('#form-localidade').find('input:visible,select:visible').first().focus();
	},
	editar : function( id ) {
		var parametros = {
			'metodo' : 'editar',
			'codigo' : id
		};
		$.post('?m=controller&c=LocalidadeController', parametros, function( data ) {
			$('#panel-localidade').show('slow');

			$('#form-localidade #ID_LOCALIDADE').val( data.ID_LOCALIDADE );
			$('#form-localidade #CIDADE').val( data.CIDADE );
			$('#form-localidade #ESTADO').val( data.ESTADO );
			$('#form-localidade #SIGLA').val( data.SIGLA );
		}, 'json');
	},
	salvar : function() {
		$('#form-localidade').validate({
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
				$.post('?m=controller&c=LocalidadeController', params, function( data ) {
					Localidade.buscar();
					Localidade.inserir();
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
						$.post('?m=controller&c=LocalidadeController', params, function( data ) {
							if ( data == true ) {
								Localidade.buscar();
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