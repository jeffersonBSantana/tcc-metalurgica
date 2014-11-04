/* 
 * Version : 0.0.1
 * Development : Eduardo Malherbi Martins
 * 
 * FOR TABLE
 * 
 * */  
var bootTable = 
{
    clear : function(id) {
        $( id + ' tbody' ).remove();
    },
    hide : function(id) {
        if ( $( id + ' tbody tr:visible').length == 0 ) 
            $( id ).hide('slow');   
    },
    addItem : function( id, header, values ) {
        var arr = [];
        $.each(header, function(i, v) {                    
            arr.push( i + "='" + v + "'" );
        });
        var join = arr.join(" ");
        
        var tr = "";
        tr += "<tr " + join + " >";
        
        $.each(values, function(i, v) {  
            tr += "<td>" + v + "</td>";
        });
        tr += "</tr>";    

        $( id ).append( tr );
        $( id ).show('slow');   
    }
};