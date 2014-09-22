var Medidas = {
	iniciar : function() {
		Medidas.buscar();
		Medidas.buscarEsquadria();
		Medidas.buscarPerfil();

		Medidas.salvar();
	},
	buscar : function() {
		var id = '#table-medida';
		bootTable.clear( id );

		var params = {
			'metodo' : 'buscar',
			'ativo'  : $(id + ' #ativo').val()
		};
		$.post('?m=controller&c=MedidaController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = {
		            "CODE" : values.ID_MEDIDA
		        };
		        var values = {
		        	"CODE"  			: values.ID_MEDIDA,
			        "QUANTIDADE" 		: values.QUANTIDADE,
		          	"DIMINUIR" 			: values.DIMINUIR,
					"AUMENTAR" 			: values.AUMENTAR,
		          	"DIVIDIR" 			: values.DIVIDIR,
		          	"MEDIDA_REFERENCIA"	: ( values.MEDIDA_REFERENCIA == 0 ) ? 'Largura' : 'Altura',
		          	"ID_ESQUADRIA"		: values.DESCRICAO,
					"ID_PERFIL"			: values.DESCRICAO + ' - ' + values.PESO_POR_METRO,
			        "EDIT"  			: '<div onclick="Medidas.editar('+values.ID_MEDIDA+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		          	"REMOVE"			: '<div onclick="Medidas.remover('+values.ID_MEDIDA+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
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

		Select.remove_all_option('form-medida #ID_MEDIDA');
		$.post('?m=controller&c=MedidaController', parametros, function( data ) {
			var options = '<option value="" ></option>';
			$.each(data, function (key, value) {
				options += '<option value="'+value.ID_ESQUADRIA+'" >'+value.DESCRICAO+'</option>';
		 	});

			$('#form-medida #ID_ESQUADRIA').html( options );
		}, 'json');
	},
	
	buscarPerfil : function( id ) {
		var parametros = {
			'metodo' : 'buscarPerfil'
		};

		Select.remove_all_option('form-medida #ID_MEDIDA');
		$.post('?m=controller&c=MedidaController', parametros, function( data ) {
			var options = '<option value="" ></option>';
			$.each(data, function (key, value) {
				options += '<option value="'+value.ID_PERFIL+'" >'+value.DESCRICAO+' - '+value.PESO_POR_METRO+'</option>';
		 	});

			$('#form-medida #ID_PERFIL').html( options );
		}, 'json');
	},	
	//ativo : function() {
		//$('#table-cliente #ativo').val( ( $('#table-cliente #ativo').is(':checked') ) ? 1 : 0 );
		//Clientes.buscar();
	//},
	limpar : function() {
		$('#panel-medida').show('slow');

		jQuery('#form-medida input:hidden').val('');
		$('#form-medida').each(function() { this.reset(); });

		$('#form-medida').find('input:visible,select:visible').first().focus();
	},
	inserir : function() {
		/* abre o panel */
		$('#panel-medida').toggle('slow');
		/* limpa o ID hidden */
		jQuery('#form-medida input:hidden').val('');
		/* limpa o formulario */
		$('#form-medida').each(function() { this.reset(); });
		/* posiciona o cursor */
		$('#form-medida').find('input:visible,select:visible').first().focus();
	},
	editar : function( id ) {
		var parametros = {
			'metodo' : 'editar',
			'codigo' : id
		};
		$.post('?m=controller&c=MedidaController', parametros, function( data ) {
			$('#panel-medida').show('slow');

			$('#form-medida #ID_MEDIDA').val( data.ID_MEDIDA );
			$('#form-medida #QUANTIDADE').val( data.QUANTIDADE );
			$('#form-medida #DIMINUIR').val( data.DIMINUIR );
			$('#form-medida #AUMENTAR').val( data.AUMENTAR );
			$('#form-medida #DIVIDIR').val( data.DIVIDIR );
			$('#form-medida input[name=MEDIDA_REFERENCIA]').filter('[value='+data.MEDIDA_REFERENCIA+']').prop('checked', true);
			$('#form-medida #ID_ESQUADRIA').val(data.ID_ESQUADRIA);
			$('#form-medida #ID_PERFIL').val(data.ID_PERFIL);
		}, 'json');
	},
	salvar : function() {
		$('#form-medida').validate({
			submitHandler: function( form ) {
				var formulario = $( form ).serialize();
				var params = {
					'metodo' : 'salvar',
					'formulario' : formulario
				};
				$.post('?m=controller&c=MedidaController', params, function( data ) {
					Medidas.buscar();
					Medidas.inserir();
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
						$.post('?m=controller&c=MedidaController', params, function( data ) {
							if ( data == true ) {
								Medidas.buscar();
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