var Status = {
	descricao : function(s) {
		if ( s == 1 ) 
			return 'Apostas Encerradas'
		else if ( s == 2 )  
			return 'Bolão Encerrado'
		else
			return 'Aberto';
	},
	color : function(s) {
		if ( s == 1 ) 
			return 'bg-red'
		else if ( s == 2 )  
			return 'bg-black'
		else
			return 'bg-green';
	}
}