/* 
 * Version : 0.0.1
 * Development : Eduardo Malherbi Martins
 * 
 * CONTROLLER FOR MENU 
 * 
 * -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
 * 
 * vs 0.0.1
 * - CREATE MENU CONTROL 
 * 
 * */
var Menu =
{
    hideAll: function() {
		$('#menu ul li').removeClass(); /* remove all .active */
        $('div[id^="div-"]').hide();
    },
    show: function(id) {	
		$('#menu ul li a#menu-'+id).parent().addClass('active'); /* set class .active */
        $('#div-'+id).show('slow');
    },
    init: function(id) {
        Menu.hideAll();
        Menu.show(id);
    },
    menuTitle: function(id, text) {
        $('#'+id).text(text);
    }
}