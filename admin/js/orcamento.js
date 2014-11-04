var Orcamento = {
	iniciar : function() {
		$('#ID_ADICIONARITENS').val( 0 );
		bootTable.hide('#table-orcamento-cadastro');

		Orcamento.buscar();
		Orcamento.buscarFuncionario();
		Orcamento.buscarCliente();
		Orcamento.buscarEsquadria();
		Orcamento.calcular();

		Orcamento.salvar();
	},
	calcular : function() {
		// Funcao Calcular
		function calc() {
		  var ESQUADRIA    = Number( Select.option_select_attr('form-orcamento #ID_ESQUADRIA', 'valor'));
		  var QUANTIDADE   = Money.formatUs($('#form-orcamento #QUANTIDADE').val());
		  var ALTURA       = Money.formatUs($('#form-orcamento #ALTURA').val());
		  var LARGURA      = Money.formatUs($('#form-orcamento #LARGURA').val());

		  var valor = ALTURA * LARGURA;
		  valor = valor * ESQUADRIA;
		  valor = valor * QUANTIDADE;

		  $('#form-orcamento #VALOR_UNITARIO').val(Money.formatBr(valor));
		}
		
		$('#form-orcamento #VALOR_UNITARIO').val('0,00');
		$('#form-orcamento #ID_ESQUADRIA').change(function(e) {
		  calc();
		});
		$('#form-orcamento #QUANTIDADE').change(function(e) {
		  calc();
		});
		$('#form-orcamento #ALTURA').change(function(e) {
		  calc();
		});
		$('#form-orcamento #LARGURA').change(function(e) {
		  calc();
		});	
	},
	
	relatorio : function(id) {
		var last = document.URL.lastIndexOf('/');
		var url = document.URL.slice(0, last);
		
		window.open(url + '/?m=report&c=index&t=orcamento&id=' + id, '_blank');
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
		        	"REL_ORCAMENTO"  : '<div onclick="Orcamento.relatorio('+values.ID_ORCAMENTO+')" class="btn btn-primary" ><span class="glyphicon fa fa-file-pdf-o"></span></div>',
		        	"ITENS_ORCAMENTO": '<div onclick="Orcamento.buscarItens('+values.ID_ORCAMENTO+')" class="btn btn-primary" ><span class="glyphicon glyphicon-search"></span></div>',
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
	buscarItens: function(codigo){
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
				}else if (values.COR == 2){
					cor = 'branco';
				}else{
					cor = 'preto';
				}

				var header = {
						"CODE" : values.ID_ORCAMENTO
				};
				var values = {
					"ID_ESQUADRIA" 	: values.DESCRICAO,
					"QUANTIDADE"    : values.QUANTIDADE,
					"ALTURA" 		: Money.formatBr(values.ALTURA),
					"LARGURA" 		: Money.formatBr(values.LARGURA),
					"VALOR_UNITARIO": 'R$ ' + Money.formatBr(values.VALOR_UNITARIO),
					"COR" 	 		: cor
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

	adicionarItens:function() {
		var esquadria_descricao = Select.option_select_attr('form-orcamento #ID_ESQUADRIA', 'descricao');
		var id_esquadria = $('#form-orcamento #ID_ESQUADRIA').val();
		var qtde = $('#form-orcamento #QUANTIDADE').val();
		var altura = $('#form-orcamento #ALTURA').val();
		var largura = $('#form-orcamento #LARGURA').val();
		var valor_unitario = $('#form-orcamento #VALOR_UNITARIO').val();
		var cor = Radio.checked('COR', 'form-orcamento');
		var cor_descricao = "";
		if(cor == 0){
			cor_descricao = 'fosco';
		}else if(cor == 1){
			cor_descricao = 'chumbo';
		}else if (cor == 2){
			cor_descricao = 'branco';
		}else{
			cor_descricao = 'preto';
		}

		if ( id_esquadria == 0 ) {
			alert('Esquadria precisa ser informada!');
			$('#form-orcamento #ID_ESQUADRIA').focus();
			return;
		}
		if ( Number(qtde) == 0 ) {
			alert('quantidade precisa ser informada!');
			$('#form-orcamento #QUANTIDADE').focus();
			return;
		}
		if ( Number(altura) == 0 ) {
			alert('Altura precisa ser informada!');
			$('#form-orcamento #ALTURA').focus();
			return;
		}
		if ( Number(largura) == 0 ) {
			alert('Largura precisa ser informada!');
			$('#form-orcamento #LARGURA').focus();
			return;
		}
		if ( Number(valor_unitario) == 0 ) {
			alert('Valor precisa ser informado!');
			$('#form-orcamento #VALOR_UNITARIO').focus();
			return;
		}

		var linha = Number($('#ID_ADICIONARITENS').val()) + 1;
		$('#ID_ADICIONARITENS').val( linha );

		var id = '#table-orcamento-cadastro';
    var header = {
		"id" 				: linha,
		"id_item_orcamento" : 0,
        "id_esquadria" 		: id_esquadria,
        "qtde" 				: qtde,
        "altura" 			: altura,
        "largura" 			: largura,
        "valor_unitario" 	: valor_unitario,
        "cor" 				: cor
    };
    var values = {
      "esquadria_descricao" : esquadria_descricao,
      "qtde" 				: qtde,
      "altura" 				: altura,
      "largura" 			: largura,
      "valor_unitario" 		: valor_unitario,
      "cor" 				: cor_descricao,
	  "REMOVE"		 		: '<div onclick="Orcamento.removerItens('+linha+','+0+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
    };
    bootTable.addItem(
        id,
        header,
        values
    );
	},
	removerItens : function( linha, id_item_orcamento) {
		bootbox.dialog({
				message : "Deseja deletar o item orcamento?",
				title : "Atenção",
				buttons : {
				success: {
					label: "Sim",
					className: "btn-success",
					callback: function() {
						var params = {
							'metodo' : 'removerItemOrcamento',
							'codigo' : id_item_orcamento
						};

						$('#table-orcamento-cadastro tbody tr#'+linha).remove();
						if ( id_item_orcamento > 0 ) {
							$.post('?m=controller&c=OrcamentoController', params, function( data ) {
								console.log( data );
							}, 'json');
						}
					}
				},
				main: {
					label: "Não",
					className: "btn-primary"
				}
				}
		});
	},
	buscarEsquadria : function( id ) {
		var parametros = {
			'metodo' : 'buscarEsquadria'
		};

		Select.remove_all_option('form-orcamento #ID_ESQUADRIA');
		$.post('?m=controller&c=OrcamentoController', parametros, function( data ) {
			var options = '<option value="" descricao="" ></option>';
			$.each(data, function (key, value) {
				options += '<option value="'+value.ID_ESQUADRIA+'" descricao="'+value.DESCRICAO+'" valor="'+value.VALOR+'">'+value.DESCRICAO+'</option>';
		 	});

			$('#form-orcamento #ID_ESQUADRIA').html( options );
		}, 'json');
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
	limpar : function() {
		$('#panel-orcamento').show('slow');

		jQuery('#form-orcamento input:hidden').val('');
		$('#form-orcamento').each(function() { this.reset(); });

		$('#form-orcamento').find('input:visible,select:visible').first().focus();

		$('#ID_ADICIONARITENS').val( 0 );
		var id = '#table-orcamento-cadastro';
		bootTable.clear( id );
		bootTable.hide( id );
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

		$('#ID_ADICIONARITENS').val( 0 );
		var id = '#table-orcamento-cadastro';
		bootTable.clear( id );
		bootTable.hide( id );
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

			var parametros = {
				'metodo' : 'editarItens',
				'codigo' : id
			};
			$.post('?m=controller&c=OrcamentoController', parametros, function( data ) {
				var id = '#table-orcamento-cadastro';
				bootTable.clear( id );

				$.each( data, function( key, values ) {

					var cor = values.COR;
					var cor_descricao = "";
					if(cor == 0){
						cor_descricao = 'fosco';
					}else if(cor == 1){
						cor_descricao = 'chumbo';
					}else if (cor == 2){
						cor_descricao = 'branco';
					}else{
						cor_descricao = 'preto';
					}

					var linha = Number($('#ID_ADICIONARITENS').val()) + 1;
					$('#ID_ADICIONARITENS').val( linha );

					var header = {
						"id" 				: linha,
						"id_item_orcamento" : values.ID_ITEM_ORCAMENTO,
						"id_esquadria" 		: values.ID_ESQUADRIA,
						"qtde" 				: values.QUANTIDADE,
						"altura" 			: values.ALTURA,
						"largura" 			: values.LARGURA,
						"valor_unitario" 	: values.VALOR_UNITARIO,
						"cor" 				: values.COR
					};
					var values = {
						"esquadria_descricao" : values.ID_ESQUADRIA,
						"qtde" 				  : values.QUANTIDADE,
						"altura" 			  : values.ALTURA,
						"largura" 			  : values.LARGURA,
						"valor_unitario" 	  : values.VALOR_UNITARIO,
						"cor" 			      : cor_descricao,
						"REMOVE"		 	  : '<div onclick="Orcamento.removerItens('+linha+','+values.ID_ITEM_ORCAMENTO+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
					};
					bootTable.addItem(
							id,
							header,
							values
					);

				});
			}, 'json');
		}, 'json');
	},
	salvar : function() {
		$('#form-orcamento').validate({
			submitHandler: function( form ) {

				if ( $('#table-orcamento-cadastro tbody tr').length == 0 ) {
					alert('Não pode ser salvo um orçamento sem seus Itens. Verifique!');
					return;
				}

				var tabela = [];
				$('#table-orcamento-cadastro tr').each(function(i) {
				  var id_item_orcamento = $(this).attr('id_item_orcamento');
				  var id_esquadria = $(this).attr('id_esquadria');
				  var cor = $(this).attr('cor');
				  var qtde = $(this).attr('qtde');
				  var altura = $(this).attr('altura');
				  var largura = $(this).attr('largura');
				  var valor_unitario = $(this).attr('valor_unitario');

				  if ( typeof id_esquadria != 'undefined' ) {
				    var obj = {};
					obj.id_item_orcamento = id_item_orcamento;
				    obj.cor = cor;
				    obj.id_esquadria = id_esquadria;
				    obj.qtde = qtde;
				    obj.altura = altura;
				    obj.largura = largura;
				    obj.valor_unitario = valor_unitario;

				    tabela.push( obj );
				  }
				});

				var formulario = $( form ).serialize();
				var params = {
					'metodo' : 'salvar',
					'formulario' : formulario,
					'tabela' : tabela
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
