var Perfil = {
	iniciar : function() {
		Perfil.buscar();
		//Perfil.buscarLocalidade();

		Perfil.salvar();
	},
	buscar : function() {
		var id = '#table-perfil';
		bootTable.clear( id );

		var params = {
			'metodo' : 'buscar',
			'ativo'  : $(id + ' #ativo').val()
		};
		$.post('?m=controller&c=PerfilController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = {
		            "CODE" : values.ID_PERFIL
		        };
		        var values = {
		        	"CODE"  	      : values.ID_PERFIL,
			        "DESCRICAO" 	  : values.DESCRICAO,
		          	"PESO_POR_METRO"  : values.PESO_POR_METRO,
			        "EDIT"  	      : '<div onclick="Perfil.editar('+values.ID_PERFIL+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		          	"REMOVE"	      : '<div onclick="Perfil.remover('+values.ID_PERFIL+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
		        };
		        bootTable.addItem(
		            id,
		            header,
		            values
		        );
		    });
		}, 'json');
	},
	
	// Nao tem ativo na tabela funcionario, logo este item nao precisa...
	ativo : function() {
		$('#table-perfil #ativo').val( ( $('#table-perfil #ativo').is(':checked') ) ? 1 : 0 );
		Perfil.buscar();
	},
	limpar : function() {
		$('#panel-perfil').show('slow');

		jQuery('#form-perfil input:hidden').val('');
		$('#form-perfil').each(function() { this.reset(); });

		$('#form-perfil').find('input:visible,select:visible').first().focus();
	},
	inserir : function() {
		/* abre o panel */
		$('#panel-perfil').toggle('slow');
		/* limpa o ID hidden */
		jQuery('#form-perfil input:hidden').val('');
		/* limpa o formulario */
		$('#form-perfil').each(function() { this.reset(); });
		/* posiciona o cursor */
		$('#form-perfil').find('input:visible,select:visible').first().focus();
	},
	editar : function( id ) {
		var parametros = {
			'metodo' : 'editar',
			'codigo' : id
		};
		$.post('?m=controller&c=PerfilController', parametros, function( data ) {
			$('#panel-perfil').show('slow');

			$('#form-perfil #ID_PERFIL').val( data.ID_PERFIL );
			$('#form-perfil #DESCRICAO').val( data.DESCRICAO );
			$('#form-perfil #PESO_POR_METRO').val( data.PESO_POR_METRO );

			//$('#form-funcionario input[name=NIVEL_ACESSO]').filter('[value='+data.NIVEL_ACESSO+']').prop('checked', true);

			$('#form-perfil #ID_PERFIL').val(data.ID_PERFIL);
		}, 'json');
	},
	salvar : function() {
		$('#form-perfil').validate({
			submitHandler: function( form ) {
				var formulario = $( form ).serialize();
				var params = {
					'metodo' : 'salvar',
					'formulario' : formulario
				};
				$.post('?m=controller&c=PerfilController', params, function( data ) {
					Perfil.buscar();
					Perfil.inserir();
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
						$.post('?m=controller&c=PerfilController', params, function( data ) {
							if ( data == true ) {
								Perfil.buscar();
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