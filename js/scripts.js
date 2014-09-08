var OperadoresNovo = {
	show : function() {
		$('#modal-operadores-novo').modal('show');
	},
	salvar : function() {
		$('#form-operadores-novo').validate({
			submitHandler: function( form ) {
				var params = { 
					'method' : 'salvar',
					'form' : $("#form-operadores-novo").serialize()		
				};
				$.post('?m=controller&c=OperadoresController', params, function( data ) {
					if ( typeof data == 'string' ) {
						Alert.show( data );
					} 
					else {
						$('#modal-operadores-novo'  ).modal('hide');
						$('#modal-operadores-salvar').modal('show');
					}
				}, 'json');
				
				return false;
			}  	
		});			
	}
};

$(document).ready(function() {	
	Login.init();
	
	Menu.init('start'); 
	Start.init();		 

	$('#menu-start').click(function() { 
		Menu.init('start'); 
		Start.init();		 
	});		
	
	$('#menu-games').click(function() { 
		Menu.init('games'); 
		Games.init();		 
	});

	$('#menu-users').click(function() { 
		Menu.init('users'); 
		Users.init();
	});	
	
	$('#menu-bets').click(function() { 
		Menu.init('bets'); 
		Bets.init();
	});
});