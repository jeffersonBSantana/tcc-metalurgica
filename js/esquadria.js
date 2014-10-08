var Esquadria = {
	iniciar : function() {
		Esquadria.buscarPerfil();
		Esquadria.buscar();
		Esquadria.salvar();
	},
	
	buscar : function() {
		var id = '#table-esquadria';
		bootTable.clear( id );

		var params = {
			'metodo' : 'buscar',
			'ativo'  : $(id + ' #ativo').val()
		};
		$.post('?m=controller&c=EsquadriaController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = {
		            "CODE" : values.ID_ESQUADRIA
		        };
		        var values = {
		        	"CODE"  	 : values.ID_ESQUADRIA,
			        "DESCRICAO"  : values.DESCRICAO,
		          	"COLOCACAO"  : values.COLOCACAO,
			        "PERFIL"	 : values.DESCRICAO_PERFIL,
		          	"EDIT"  	 : '<div onclick="Esquadria.editar('+values.ID_ESQUADRIA+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		          	"REMOVE"	 : '<div onclick="Esquadria.remover('+values.ID_ESQUADRIA+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
		        };
		        bootTable.addItem(
		            id,
		            header,
		            values
		        );
		    });
		}, 'json');
	},
	
	buscarPerfil : function() {
		var parametros = {
			'metodo' : 'buscarPerfil'
		};
		
		Select.remove_all_option('form-esquadria #ID_PERFIL');
		$.post('?m=controller&c=EsquadriaController', parametros, function( data ) {
			var options = '<option value="" ></option>';
			$.each(data, function (key, value) {
		 		options += '<option value="'+value.ID_PERFIL+'" >'+value.DESCRICAO+'</option>';
		 	});

			$('#form-esquadria #ID_PERFIL').html( options );
		}, 'json');
	},
	
	// Nao tem ativo na tabela funcionario, logo este item nao precisa...
	ativo : function() {
		$('#table-esquadria #ativo').val( ( $('#table-esquadria #ativo').is(':checked') ) ? 1 : 0 );
		Esquadria.buscar();
	},
	limpar : function() {
		$('#panel-esquadria').show('slow');

		jQuery('#form-esquadria input:hidden').val('');
		$('#form-esquadria').each(function() { this.reset(); });

		$('#form-esquadria').find('input:visible,select:visible').first().focus();
	},
	inserir : function() {
		/* abre o panel */
		$('#panel-esquadria').toggle('slow');
		/* limpa o ID hidden */
		jQuery('#form-esquadria input:hidden').val('');
		/* limpa o formulario */
		$('#form-esquadria').each(function() { this.reset(); });
		/* posiciona o cursor */
		$('#form-esquadria').find('input:visible,select:visible').first().focus();
	},
	editar : function( id ) {
		var parametros = {
			'metodo' : 'editar',
			'codigo' : id
		};
		$.post('?m=controller&c=EsquadriaController', parametros, function( data ) {
			$('#panel-esquadria').show('slow');

			$('#form-esquadria #ID_ESQUADRIA').val( data.ID_ESQUADRIA );
			$('#form-esquadria #DESCRICAO').val( data.DESCRICAO );
			$('#form-esquadria #COLOCACAO').val( data.COLOCACAO );
			$('#form-esquadria #ID_PERFIL').val( data.ID_PERFIL );

			//$('#form-funcionario input[name=NIVEL_ACESSO]').filter('[value='+data.NIVEL_ACESSO+']').prop('checked', true);

			$('#form-esquadria #ID_ESQUADRIA').val(data.ID_ESQUADRIA);
		}, 'json');
	},
	salvar : function() {
		$('#form-esquadria').validate({
			submitHandler: function( form ) {
				var formulario = $( form ).serialize();
				var params = {
					'metodo' : 'salvar',
					'formulario' : formulario
				};
				$.post('?m=controller&c=EsquadriaController', params, function( data ) {
					Esquadria.buscar();
					Esquadria.inserir();
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
						$.post('?m=controller&c=EsquadriaController', params, function( data ) {
							if ( data == true ) {
								Esquadria.buscar();
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