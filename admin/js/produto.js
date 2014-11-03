var Produto = {
	iniciar : function() {
		Produto.buscar();
		Produto.buscarEsquadria();

		Produto.salvar();
	},
	buscar : function() {
		var id = '#table-produto';
		bootTable.clear( id );

		var params = {
			'metodo' : 'buscar',
			'ativo'  : $(id + ' #ativo').val()
		};
		$.post('?m=controller&c=ProdutoController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = {
		            "CODE" : values.ID_PRODUTO
		        };
		        var values = {
		        	"CODE"  			: values.ID_PRODUTO,
		        	"ESQUADRIA"			: values.ESQUADRIA,
			        "VALOR" 			: 'R$ ' + values.VALOR,
			        "EDIT"  			: '<div onclick="Produto.editar('+values.ID_PRODUTO+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		          	"REMOVE"			: '<div onclick="Produto.remover('+values.ID_PRODUTO+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
		        };
		        bootTable.addItem(
		            id,
		            header,
		            values
		        );
		    });
		}, 'json');
	},
	
	buscarEsquadria : function( id ) {
		var parametros = {
			'metodo' : 'buscarEsquadria'
		};

		Select.remove_all_option('form-produto #ID_ESQUADRIA');
		$.post('?m=controller&c=ProdutoController', parametros, function( data ) {
			var options = '<option value="" ></option>';
			$.each(data, function (key, value) {
				options += '<option value="'+value.ID_ESQUADRIA+'" >'+value.DESCRICAO+'</option>';
		 	});

			$('#form-produto #ID_ESQUADRIA').html( options );
		}, 'json');
	},
	limpar : function() {
		$('#panel-produto').show('slow');

		jQuery('#form-produto input:hidden').val('');
		$('#form-produto').each(function() { this.reset(); });

		$('#form-produto').find('input:visible,select:visible').first().focus();
	},
	inserir : function() {
		/* abre o panel */
		$('#panel-produto').toggle('slow');
		/* limpa o ID hidden */
		jQuery('#form-produto input:hidden').val('');
		/* limpa o formulario */
		$('#form-produto').each(function() { this.reset(); });
		/* posiciona o cursor */
		$('#form-produto').find('input:visible,select:visible').first().focus();
	},
	editar : function( id ) {
		var parametros = {
			'metodo' : 'editar',
			'codigo' : id
		};
		$.post('?m=controller&c=ProdutoController', parametros, function( data ) {
			$('#panel-produto').show('slow');

			$('#form-produto #ID_PRODUTO').val( data.ID_PRODUTO );
			$('#form-produto #VALOR').val( data.VALOR );
			$('#form-produto #ID_ESQUADRIA').val(data.ID_ESQUADRIA);
		}, 'json');
	},
	salvar : function() {
		$('#form-produto').validate({
			submitHandler: function( form ) {
				var formulario = $( form ).serialize();
				var params = {
					'metodo' : 'salvar',
					'formulario' : formulario
				};
				$.post('?m=controller&c=ProdutoController', params, function( data ) {
					Produto.buscar();
					Produto.inserir();
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
						$.post('?m=controller&c=ProdutoController', params, function( data ) {
							if ( data == true ) {
								Produto.buscar();
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