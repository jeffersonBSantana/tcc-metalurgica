var Orcamento = {
	iniciar : function() {
		Orcamento.limpar();
		Orcamento.buscarEsquadria();
		Orcamento.calcular();
		Orcamento.salvar();
	},
	
	limpar : function() {
		$('#form-orcamento #btn-enviar').hide('fast');

		jQuery('#form-orcamento input:hidden').val('');
		$('#form-orcamento').each(function() { this.reset(); });

		$('#ID_ADICIONARITENS').val( 0 );
		var id = '#table-orcamento-cadastro';
		bootTable.clear( id );
		bootTable.hide( id );		
	},
	
	buscarEsquadria : function( id ) {
		var parametros = {
			'metodo' : 'buscarEsquadria'
		};

		Select.remove_all_option('form-orcamento #ID_ESQUADRIA');
		$.post('?c=OrcamentoController', parametros, function( data ) {
			var options = '<option value="0" descricao="" selected disabled >Informe o Produto</option>';
			$.each(data, function (key, value) {
				options += '<option value="'+value.ID_ESQUADRIA+'" descricao="'+value.DESCRICAO+'" valor="'+value.VALOR+'">'+value.DESCRICAO+'</option>';
		 	});

			$('#form-orcamento #ID_ESQUADRIA').html( options );
		}, 'json');
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
				$.post('?c=OrcamentoController', params, function( id ) {
					// Limpar Tudo
					Orcamento.limpar();					
					// Abrir relatorio
					Orcamento.relatorio( id );					
				}, 'json');

				return false;
	    	}
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
			cor_descricao = 'Fosco';
		}else if(cor == 1){
			cor_descricao = 'Bronze';
		}else if (cor == 2){
			cor_descricao = 'Branco';
		}else{
			cor_descricao = 'Preto';
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
	    
  		$('#form-orcamento #btn-enviar').show('fast');
	},
	
	removerItens : function( linha, id_item_orcamento) {
		bootbox.dialog({
				message : "Deseja deletar esse Produto?",
				title : "Atenção",
				buttons : {
				success: {
					label: "Sim",
					className: "btn-success",
					callback: function() {
						$('#table-orcamento-cadastro tbody tr#'+linha).remove();
						bootTable.hide('#table-orcamento-cadastro');
						if ( $('#table-orcamento-cadastro tbody tr:visible').length == 0 ) {
							$('#form-orcamento #btn-enviar').hide('fast');	
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
	
	relatorio : function(id) {
		var last = document.URL.lastIndexOf('/');
		var url = document.URL.slice(0, last);
		url = url.replace('site', 'admin');
		
		window.open(url + '/?m=report&c=index&t=orcamento&id=' + id, '_blank');
	}
};
