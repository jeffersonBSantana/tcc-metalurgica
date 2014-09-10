/* 
 * Version : 0.0.1
 * Development : Eduardo Malherbi Martins
 * 
 * FORM
 * - USING BOOTSTRAP VS.3.0.1 + BOOTBOX VS.4.2.0 + JQUERY VALIDATION VS.1.9.0
 * 
 * */  
var bootForm = {
	novo : function(name) {
		var n = name.toLowerCase();
		$('#panel-'+n).toggle('slow');
		
		jQuery('#form-'+n+' input:hidden').val('');
		$('#form-'+n).each(function() { this.reset(); });	

		$('#form-'+n).find('input:visible,select:visible').first().focus();		
	},
	resetar : function(name) {
		var n = name.toLowerCase();
		$('#panel-'+n).show('slow');
		
		jQuery('#form-'+n+' input:hidden').val('');
		$('#form-'+n).each(function() { this.reset(); });	

		$('#form-'+n).find('input:visible,select:visible').first().focus();		
	},
	editar : function(name, id) {
		var n = name.toLowerCase();
		var params = { 
			'method' : 'edit',
			'code' : id 
		};
		$.post('?m=controller&c='+name+'Controller', params, function( data ) {
			$('#panel-'+n).show('slow');
			bootForm.editarReturn('#form-'+n, data);
		}, 'json');		
	},
	editarReturn : function(form, data) {
		$(form + ' label').map(function() {
		    if ( this.id != '' ) {
				var myElement = $(form + ' #'+this.id);
			    var key = myElement.attr('editar');

			    if ( data.hasOwnProperty( key ) ) {
			    	myElement.text( data[key] );          
			    }
		    }
		}).get().join();

		$(form + ' input').map(function() {
			var myElement = $(form + ' #'+this.id);
		    var key = myElement.attr('editar');
		                 
		    if ( data.hasOwnProperty( key ) ) {
		    	myElement.val( data[key] );          
		    }
		}).get().join();
		  
		$(form + ' input[type=checkbox]').map(function() {
		    var myElement = $(form + ' #'+this.id);
		    var key = myElement.attr('editar');
		             
		    if ( data.hasOwnProperty( key ) ) { 
		        var checked = ( data[key] == 0 ) ? false : true;                    
		        myElement.attr('checked', checked);         
		        myElement.val( data[key] );          
		    }
		}).get().join();
		  
		$(form + ' select').map(function() {
		    var myElement = $(form + ' #'+this.id);
		    var key = myElement.attr('editar');
		    
		    if ( data.hasOwnProperty( key ) ) {
		    	myElement.val( data[key] );
		    }
	    }).get().join();        
		  
		$(form + ' textarea').map(function() {
		    var myElement = $(form + ' #'+this.id);
		    var key = myElement.attr('editar');
		             
		    if ( data.hasOwnProperty( key ) ) {
		        myElement.val( data[key] );          
		    }
		}).get().join(); 		
	},
	salvar : function(name) {
		var n = name.toLowerCase();
		$('#form-'+n).validate({
			submitHandler: function( form ) {
				var uc = [];
				$(':checkbox:not(:checked)', form).each(function() {
					uc.push(encodeURIComponent(this.name) + '=0');
				});
				var serialize = $( form ).serialize() + (uc.length ? '&'+uc.join('&').replace(/%20/g, "+") : '');				
				
				var params = { 
					'method' : 'save',
					'form' 	 : serialize
				};
				$.post('?m=controller&c='+name+'Controller', params, function( data ) {
					if ( typeof data == 'string' ) {
						Alert.show( data );
					} 
					else {
						var o = eval(name);
						o.all();
						o.insert();
					}
				}, 'json');

				return false;  
	        }  	
		});			
	},
	deletar : function(name, id) {
	    bootbox.dialog({
	    	message : "Deseja deletar o registro?",
	    	title : "Atenção",
	    	buttons : {
				success: {
					label: "Sim",
					className: "btn-success",
					callback: function() {
						var params = { 
							'method' : 'remove',
							'code' : id			
						};						
						$.post('?m=controller&c='+name+'Controller', params, function( data ) {
							if ( data == true ) {
								var o = eval(name);
								o.all();
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
}