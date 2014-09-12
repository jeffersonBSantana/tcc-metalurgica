var Funcionarios = {	
	iniciar : function() {
		Funcionarios.todos();
		Funcionarios.salvar();
	},
	todos : function() {
		var id = '#table-funcionario';		
		bootTable.clear( id );		
		
		var params = { 
			'method' : 'all',
			'active' : $(id + ' #active').val()
		};
		$.post('?m=controller&c=UsersController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = { 
		            "CODE" : values.ID_FUNCIONARIO
		        };
		        var values = {
		        	"CODE"  		: values.ID_FUNCIONARIO,
			        "NOME" 			: values.NOME,
		            "CPF"   		: values.CPF,
			        "EMAIL"		  	: values.EMAIL,
					"CELULAR"		: values.CELULAR,
					"RUA"		  	: values.RUA,
					"NUMERO"		: values.NUMERO,
					"BAIRRO"		: values.BAIRRO,
					"CEP"		  	: values.CEP,
					
		            "EDIT"  		: '<div onclick="Funcionarios.editar('+values.ID_FUNCIONARIO+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		            "REMOVE" 		: '<div onclick="Funcionarios.remover('+values.ID_FUNCIONARIO+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
		        };
		        bootTable.addItem( 
		            id, 
		            header, 
		            values 
		        );
		    });  			
		}, 'json');
	},
	ativo : function() {
		// $('#table-funcionario #active').val( ( $('#table-funcionario #active').is(':checked') ) ? 1 : 0 );
		// Users.all();
	},
	limpar : function() {
		// bootForm.resetar('Users');
	},	
	inserir : function() {
		$('#panel-funcionario').toggle('slow'); // abre o panel

		jQuery('#form-funcionario input:hidden').val(''); // limpa o ID
		$('#form-funcionario').each(function() { this.reset(); });	 // limpa tudo

		$('#form-funcionario').find('input:visible,select:visible').first().focus(); // posiciona o cursor				
	},	
	editar : function( id ) {
		var parametros = { 
			'method' : 'editar',
			'codigo' : id 
		};
		$.post('?m=controller&c=UsersController', parametros, function( data ) {
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
		}, 'json');
	},	
	salvar : function() {
		// bootForm.salvar('Users');
		
		$('#form-funcionario').validate({
			submitHandler: function( form ) {
			
				/*alterar*/
				// var uc = [];
				// $(':checkbox:not(:checked)', form).each(function() {
				//	uc.push(encodeURIComponent(this.name) + '=0');
				// });
				var f = $( form ).serialize(); // + (uc.length ? '&'+uc.join('&').replace(/%20/g, "+") : '');				
				
				var params = { 
					'method' : 'salvar',
					'formulario' : f
				};
				$.post('?m=controller&c=UsersController', params, function( data ) {
					//if ( typeof data == 'string' ) {
						//Alert.show( data );
					//} 
					// else {
						Funcionarios.todos();
						Funcionarios.inserir();
					//}
				}, 'json');

				return false; 
				/*alterar*/
				
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
						
						/* alterou */
						var params = { 
							'method' : 'remover',
							'codigo' : id			
						};						
						$.post('?m=controller&c=UsersController', params, function( data ) {
							if ( data == true ) {
								Funcionarios.todos();
							}
						}, 'json');
						/* alterou */
						
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