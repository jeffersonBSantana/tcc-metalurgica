var Start = {	
	init : function() {
		Start.winner();
		Start.all();
	},
	winner : function() {
		var id = '#table-winners';		
		bootTable.clear( id );		
		
		var params = { 
			'method' : 'winners',
			'active'  : $(id + ' #active').val()
		};
		var total = 0;
		$.post('?m=controller&c=StartController', params, function( data ) {
			$.each( data, function( k, v ) {
				var d = k.split("|"); 
				
				var r1 = d[6];
				var r2 = d[7];

				var winners = v.length;
				var vlr = Number( d[8] );
				total += vlr;
				
				var vlr_winners = 0;
				if ( winners > 0 ) 
					vlr_winners = Number(vlr) / Number(winners);
				
				var tr = '';
				tr += '<tr class="'+Status.color( d[5] )+'" >';
				tr += '<td colspan="2" >'+d[1]+' '+r1+' x '+r2+' '+d[2]+' - '+d[3]+' ás '+d[4]+' - <label>'+Status.descricao( d[5] )+'</label></td>';
				tr += '</tr>';
				
		        $( id ).append( tr );
				$.each( v, function( key, values ) {	
					
					var cls = '';
					if ( (values.RESULT1 == r1) && (values.RESULT2 == r2) )
						cls = 'bg-winner';
					
					var header = { 
			            "CODE" : values.ID_BET,
			            "class" : cls
			        };
			        var values = {
			        	"USER"	 		: values.NAME,
				        "VALUE"			: Money.formatBr( vlr_winners )
			        };
			        bootTable.addItem( 
			            id, 
			            header, 
			            values 
			        );
			    });
				
				var tr = '';
				tr += '<tr>';
				tr += '<td align="right" ><label style="text-align:right; width:100%;" >Valor (R$)</label></td>';
				tr += '<td><label style="text-align:center; width:100%;" >'+Money.formatBr( vlr )+'</label></td>';
				tr += '</tr>';
				
		        $( id ).append( tr );
			});	
			
			$('#table-winners tfoot tr td:nth-child(2) label').text( Money.formatBr(total) ); 			
		}, 'json');
	},
	all : function() {
		var id = '#table-all';		
		bootTable.clear( id );		
		
		var params = { 
			'method' : 'all',
			'active'  : $(id + ' #active').val()
		};
		var total = 0;
		var total_pay = 0;
		$.post('?m=controller&c=StartController', params, function( data ) {
			$.each( data, function( k, v ) {
				var d = k.split("|"); 
				
				var r1 = d[6];
				var r2 = d[7];
				
				var tr = '';
				tr += '<tr class="'+Status.color( d[5] )+'" >';
				tr += '<td colspan="8" >'+d[1]+' '+r1+' x '+r2+' '+d[2]+' - '+d[3]+' ás '+d[4]+' - <label>'+Status.descricao( d[5] )+'</label></td>';
				tr += '</tr>';
				
		        $( id ).append( tr );

		        var vlr = 0;
		        var vlr_pay = 0;
				$.each( v, function( key, values ) {	
					var VALUE = Number(values.VALUE);
					var VALUE_PAY = (values.PAY == 0) ? 0 : VALUE;

					vlr += VALUE;
					vlr_pay += VALUE_PAY;

					var cls = '';
					if ( $('#div-start #id_user').val() == values.ID_USER )
						cls = 'bg-user';
					
					if ( (values.RESULT1 == r1) && (values.RESULT2 == r2) )
						cls = 'bg-winner';
					
					var PAY = (values.PAY == 0) ? 'Não' : 'Sim';
					if ( $('#div-start #access_level').val() == '2' ) {
						var sel = "";
						
						PAY  = '';
						PAY += '<select id="pay_'+values.ID_BET+'" name="pay_'+values.ID_BET+'" class="form-control" onchange="Start.pay_change('+values.ID_BET+')" >';
						
						sel = (values.PAY == 0) ? 'selected' : '';
						PAY += '<option value="0" '+sel+'>Não</option>';	
						
						sel = (values.PAY == 0) ? '' : 'selected';
						PAY += '<option value="1" '+sel+'>Sim</option>';	

						PAY += '</select>';
					}
					
					var header = { 
			            "CODE" : values.ID_BET,
			            "class" : cls
			        };
			        var values = {
			        	"USER"	 		: values.NAME,
			        	"TEAM1" 		: values.TEAM1,
			            "RESULT1" 		: values.RESULT1,
			            "RESULT2" 		: values.RESULT2,
			            "TEAM2" 		: values.TEAM2,
				        "VALUE"			: Money.formatBr(VALUE),
				        "PAY"			: PAY,				        
				        "VALUE_PAY"		: Money.formatBr(VALUE_PAY)
			        };
			        bootTable.addItem( 
			            id, 
			            header, 
			            values 
			        );
			    });
				total += vlr;
				total_pay += vlr_pay;
				
				var tr = '';
				tr += '<tr>';
				tr += '<td colspan="5" align="right" ><label style="text-align:right; width:100%;" >Valor (R$)</label></td>';
				tr += '<td><label style="text-align:center; width:100%;" >'+Money.formatBr(vlr)+'</label></td>';
				tr += '<td align="center" ><label style="text-align:center; width:100%;" >-</label></td>';
				tr += '<td><label style="text-align:center; width:100%;" >'+Money.formatBr(vlr_pay)+'</label></td>';
				tr += '</tr>';
				
		        $( id ).append( tr );
			});	
			
			$('#table-all tfoot tr td:nth-child(2) label').text( Money.formatBr(total) );
			$('#table-all tfoot tr td:nth-child(4) label').text( Money.formatBr(total_pay) ); 			
		}, 'json');
	},
	pay_change : function(id_bet) {		
		var pay = Select.option_select_attr('pay_'+id_bet, 'value');
		var params = { 
			'method' : 'pay_change',
			'form' 	 : {  
				'id_bet' : id_bet,
				'pay' : pay			
			}
		};
		$.post('?m=controller&c=StartController', params, function( data ) {
			if ( data == true ) {
				console.log( 'update ... ' );
			}
		}, 'json');

		return false;  
	}
};