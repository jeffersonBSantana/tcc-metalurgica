var Games = {	
	init : function() {
		Games.all();
		Games.save();
	},
	all : function() {
		var id = '#table-games';		
		bootTable.clear( id );		
		
		var params = { 
			'method' : 'all',
			'active'  : $(id + ' #active').val()
		};
		$.post('?m=controller&c=GamesController', params, function( data ) {
			$.each( data, function( key, values ) {
				var TEAM1 = values.TEAM1;
				var TEAM2 = values.TEAM2; 
				if ( values.FINALIZED == 1 ) {
					TEAM1 = values.TEAM1 + ' - ' + values.RESULT1;	
					TEAM2 = values.TEAM2 + ' - ' + values.RESULT2;	
				}
				
				var header = { 
		            "CODE" : values.ID_GAME,
		            "class" : Status.color( values.STATUS )
		        };
		        var values = {
		        	"CODE"  		 	 : values.ID_GAME,
		        	"TEAM1" 		 	 : TEAM1,
		            "TEAM2"   		 	 : TEAM2,
		            "VALUE" 		 	 : values.VALUE,
		            "DATE"   		 	 : values.DATE,
		            "HOUR"   		 	 : values.HOUR,
		            "STATUS" 	 		 : Status.descricao( values.STATUS ),
		            "ACTIVE"   		 	 : ( values.ACTIVE == '1' ) ? 'Sim' : 'Não',
		            "BTN_FINALIZED_BETS" : '<div onclick="Games.finalized_bets('+values.ID_GAME+')" class="btn btn-success" ><span class="glyphicon glyphicon-arrow-down"></span></div>',
		            "BTN_FINALIZED"		 : '<div onclick="Games.finalized('+values.ID_GAME+',\''+values.TEAM1+'\',\''+values.TEAM2+'\')" class="btn btn-info" ><span class="glyphicon glyphicon-thumbs-up"></span></div>',
		            "BTN_EDIT"  		 : '<div onclick="Games.edit('+values.ID_GAME+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		            "BTN_REMOVE" 		 : '<div onclick="Games.remove('+values.ID_GAME+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
		        };
		        bootTable.addItem( 
		            id, 
		            header, 
		            values 
		        );
		    });  			
		}, 'json');
	},
	active : function() {
		$('#table-games #active').val( ( $('#table-games #active').is(':checked') ) ? 1 : 0 );
		Games.all();
	},
	reset : function() {
		bootForm.resetar('Games');
	},	
	insert : function() {
		bootForm.novo('Games');
	},	
	edit : function( id ) {
		bootForm.editar('Games', id);
	},	
	save : function() {
		bootForm.salvar('Games');
	},	
	remove : function( id ) {
		bootForm.deletar('Games', id);
	},
	finalized_bets : function( id ) {
		var name = 'Games';
		
	    bootbox.dialog({
	    	message : "Deseja encerrar as apostas?",
	    	title : "Atenção",
	    	buttons : {
				success: {
					label: "Sim",
					className: "btn-success",
					callback: function() {
						var params = { 
							'method' : 'finalized_bets',
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
	},
	finalized : function( id, team1, team2 ) {
		$('#modal-finalized').modal('show');
		
		$('#modal-finalized #id_game' ).val ( id );
		$('#modal-finalized #lb-team1').text( team1 );
		$('#modal-finalized #lb-team2').text( team2 );

		$('#form-finalized').validate({
			submitHandler: function( form ) {

				var params = { 
					'method' : 'finalized',
					'form' 	 : $( form ).serialize()
				};
				$.post('?m=controller&c=GamesController', params, function( data ) {
					if ( data == true ) {
						Games.all();
						$('#modal-finalized').modal('hide');
					}
				}, 'json');

				return false;  
	        }  	
		});			
	}
};