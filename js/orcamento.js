var Orcamento = {
	iniciar : function() {
		Orcamento.buscar();
		Orcamento.buscarFuncionario();
		Orcamento.buscarCliente();
		Orcamento.buscarEsquadria();

		Orcamento.salvar();
	},
	buscar : function() {
		var id = '#table-orcamento';
		bootTable.clear( id );

		var params = {
			'metodo' : 'buscar',
			'ativo'  : $(id + ' #ativo').val()
		};
		$.post('?m=controller&c=OrcamentoController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = {
		            "CODE" : values.ID_ORCAMENTO
		        };
		        var values = {
		        	"ITENS_ORCAMENTO": '<div onclick="Orcamento.itens('+values.ID_ORCAMENTO+')" class="btn btn-primary" ><span class="glyphicon glyphicon-search"></span></div>',
		        	"CODE"  		 : values.ID_ORCAMENTO,
			        "DATA_ORCAMENTO" : values.DATA_ORCAMENTO,
					"CONFIRMADO"	 : ( values.CONFIRMADO == 0 ) ? 'Nao' : 'Sim',
					"FUNCIONARIO"    : values.FUNCIONARIO,
					"ID_CLIENTE" 	 : values.NOME,
			        "EDIT"  		 : '<div onclick="Orcamento.editar('+values.ID_ORCAMENTO+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		          	"REMOVE"		 : '<div onclick="Orcamento.remover('+values.ID_ORCAMENTO+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
		        };
		        bootTable.addItem(
		            id,
		            header,
		            values
		        );
		    });
		}, 'json');
	},
	
	adicionar:function() {
		$("#myModal2").modal({ 
			"backdrop" : "static",
			"keyboard" : true,
			"show" : true 
		});
	},
	buscarEsquadria : function( id ) {
		var parametros = {
			'metodo' : 'buscarEsquadria'
		};

		Select.remove_all_option('form-orcamento #ID_ESQUADRIA');
		$.post('?m=controller&c=OrcamentoController', parametros, function( data ) {
			var options = '<option value="" ></option>';
			$.each(data, function (key, value) {
				options += '<option value="'+value.ID_ESQUADRIA+'" >'+value.DESCRICAO+'</option>';
		 	});

			$('#form-orcamento #ID_ESQUADRIA').html( options );
		}, 'json');
	},
	itens: function(codigo){
		var id = '#table-itens-orcamento';
		bootTable.clear( id );

		var params = {
			'metodo' : 'buscarItensOrcamento',
			'codigo'  : codigo
		};
		$.post('?m=controller&c=OrcamentoController', params, function( data ) {
			$.each( data, function( key, values ) {
				var cor ='';
				if(values.COR == 0){
					cor = 'fosco'; 
				}else if(values.COR == 1){
					cor = 'chumbo';
				}else if (values.COR == 1){
					cor = 'branco';
				}else{
					cor = 'default';
				}
				
		        var header = {
		            "CODE" : values.ID_ORCAMENTO
		        };
		        var values = {
		        	"ID_ESQUADRIA" 	 : values.DESCRICAO,
		        	"QUANTIDADE"     : values.QUANTIDADE,
		        	"ALTURA" : values.ALTURA,
			        "LARGURA" : values.LARGURA,
					"VALOR_UNITARIO"    : 'R$ ' + Money.formatBr(values.VALOR_UNITARIO),
					"COR" 	 : cor
		        };
		        bootTable.addItem(
		            id,
		            header,
		            values
		        );
		    });
		}, 'json');
		
		
		
		
		
		
		
		
	$("#myModal").modal({ 
		"backdrop" : "static",
		"keyboard" : true,
		"show" : true 
	});

		
	},
	
	buscarFuncionario : function( id ) {
		var parametros = {
			'metodo' : 'buscarFuncionario'
		};

		Select.remove_all_option('form-orcamento #ID_FUNCIONARIO');
		$.post('?m=controller&c=OrcamentoController', parametros, function( data ) {
			var options = '<option value="" ></option>';
			$.each(data, function (key, value) {
				options += '<option value="'+value.ID_FUNCIONARIO+'" >'+value.NOME+'</option>';
		 	});

			$('#form-orcamento #ID_FUNCIONARIO').html( options );
		}, 'json');
	},
	
	buscarCliente : function( id ) {
		var parametros = {
			'metodo' : 'buscarCliente'
		};

		Select.remove_all_option('form-orcamento #ID_CLIENTE');
		$.post('?m=controller&c=OrcamentoController', parametros, function( data ) {
			var options = '<option value="" ></option>';
			$.each(data, function (key, value) {
				options += '<option value="'+value.ID_CLIENTE+'" >'+value.NOME+'</option>';
		 	});

			$('#form-orcamento #ID_CLIENTE').html( options );
		}, 'json');
	},	
	//ativo : function() {
		//$('#table-cliente #ativo').val( ( $('#table-cliente #ativo').is(':checked') ) ? 1 : 0 );
		//Clientes.buscar();
	//},
	limpar : function() {
		$('#panel-orcamento').show('slow');

		jQuery('#form-orcamento input:hidden').val('');
		$('#form-orcamento').each(function() { this.reset(); });

		$('#form-orcamento').find('input:visible,select:visible').first().focus();
	},
	inserir : function() {
		/* abre o panel */
		$('#panel-orcamento').toggle('slow');
		/* limpa o ID hidden */
		jQuery('#form-orcamento input:hidden').val('');
		/* limpa o formulario */
		$('#form-orcamento').each(function() { this.reset(); });
		/* posiciona o cursor */
		$('#form-orcamento').find('input:visible,select:visible').first().focus();
	},
	editar : function( id ) {
		var parametros = {
			'metodo' : 'editar',
			'codigo' : id
		};
		$.post('?m=controller&c=OrcamentoController', parametros, function( data ) {
			$('#panel-orcamento').show('slow');

			$('#form-orcamento #ID_ORCAMENTO').val( data.ID_ORCAMENTO );
			$('#form-orcamento #DATA_ORCAMENTO').val( data.DATA_ORCAMENTO );
			$('#form-orcamento input[name=CONFIRMADO]').filter('[value='+data.CONFIRMADO+']').prop('checked', true);
			$('#form-orcamento #ID_FUNCIONARIO').val(data.ID_FUNCIONARIO);
			$('#form-orcamento #ID_CLIENTE').val(data.ID_CLIENTE);
		}, 'json');
	},
	salvar : function() {
		$('#form-orcamento').validate({
			submitHandler: function( form ) {
				var formulario = $( form ).serialize();
				var params = {
					'metodo' : 'salvar',
					'formulario' : formulario
				};
				$.post('?m=controller&c=OrcamentoController', params, function( data ) {
					Orcamento.buscar();
					Orcamento.inserir();
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
						$.post('?m=controller&c=OrcamentoController', params, function( data ) {
							if ( data == true ) {
								Orcamento.buscar();
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