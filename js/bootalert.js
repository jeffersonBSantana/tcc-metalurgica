/* 
 * Version : 0.0.2
 * Development : Eduardo Malherbi Martins
 * 
 * MODAL ALERT
 * - USING BOOTSTRAP VS.3.0.1 + BOOTBOX VS.4.2.0
 * 
 * -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
 * 
 * vs 0.0.2
 * - ADD IF ALERT EXIST
 *
 * vs 0.0.1
 * - CREATE ALERT 
 * 
 * */
var Alert = {
	show : function(msg) {
		if ( $('#divAlert').length == 0 ) {
			var str = '';
			str += '<div id="divAlert" class="modal fade">';
			str += '<div class="modal-dialog">';
			str += '<div class="modal-content">';
			str += '<div class="modal-header" >';
			str += '<h3>Informação</h3>';
			str += '</div>';
			str += '<div class="modal-body" >';
			str += '<p>Informação...</p>';
			str += '</div>';
			str += '<div class="modal-footer"><button type="button" class="btn btn-danger">Fechar</button></div>';
			str += '</div>';
			str += '</div>';
			str += '</div>';
			$('html body').append( str );
		}
		
		$('#divAlert').modal('show');
		$('#divAlert .modal-body p').text(msg);
		
		$('#divAlert .modal-footer button').click(function() {
			$('#divAlert').modal('hide');
		});
	}
};