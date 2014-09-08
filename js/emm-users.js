var Users = {	
	init : function() {
		Users.all();
		Users.save();
	},
	all : function() {
		var id = '#table-users';		
		bootTable.clear( id );		
		
		var params = { 
			'method' : 'all',
			'active' : $(id + ' #active').val()
		};
		$.post('?m=controller&c=UsersController', params, function( data ) {
			$.each( data, function( key, values ) {
		        var header = { 
		            "CODE" : values.ID_USER
		        };
		        var values = {
		        	"CODE"  		: values.ID_USER,
			        "NAME" 			: values.NAME,
		            "EMAIL"   		: values.EMAIL,
			        "USERNAME" 		: values.USERNAME,
		            "PASSWORD"   	: values.PASSWORD,
		            "ACCESS_LEVEL" 	: NivelAcesso.descricao( values.ACCESS_LEVEL ),
		            "ACTIVE"   		: ( values.ACTIVE == '1' ) ? 'Sim' : 'Não',
		            "EDIT"  		: '<div onclick="Users.edit('+values.ID_USER+')" class="btn btn-warning" ><span class="glyphicon glyphicon-pencil"></span></div>',
		            "REMOVE" 		: '<div onclick="Users.remove('+values.ID_USER+')" class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></div>'
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
		$('#table-users #active').val( ( $('#table-users #active').is(':checked') ) ? 1 : 0 );
		Users.all();
	},
	reset : function() {
		bootForm.resetar('Users');
	},	
	insert : function() {
		bootForm.novo('Users');
	},	
	edit : function( id ) {
		// Input.readOnly('email');
		// Input.readOnly('usuario');

		bootForm.editar('Users', id);
	},	
	save : function() {
		bootForm.salvar('Users');
	},	
	remove : function( id ) {
		bootForm.deletar('Users', id);
	}
//	,
//	access_level : function(value) {
//		alert(value);
//	}
};