/* B */
/* Go To the Top of Body With Animate */
var Body = {
	top : function() {
		$('html, body').animate({scrollTop:0}, 'slow');		
		
		return true;
	}
};

/* C */
/* CheckBox checked */
var CheckBox = {
	checked : function(idcheckbox) {
		return document.getElementById(idcheckbox).checked;	
	}
}

/* CNPJ Validate */
var CNPJ = 
{
  validate : function(cnpj) {
		var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
		digitos_iguais = 1;
		if (cnpj.length < 14 && cnpj.length < 15)
			return false;
		for (i = 0; i < cnpj.length - 1; i++)
			if (cnpj.charAt(i) != cnpj.charAt(i + 1))
			{
				digitos_iguais = 0;
				break;
			}
		if (!digitos_iguais)
		{
			tamanho = cnpj.length - 2
			numeros = cnpj.substring(0,tamanho);
			digitos = cnpj.substring(tamanho);
			soma = 0;
			pos = tamanho - 7;
			for (i = tamanho; i >= 1; i--)
			{
				soma += numeros.charAt(tamanho - i) * pos--;
				if (pos < 2)
					pos = 9;
			}
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(0))
				return false;
				
			tamanho = tamanho + 1;
			numeros = cnpj.substring(0,tamanho);
			soma = 0;
			pos = tamanho - 7;
			for (i = tamanho; i >= 1; i--)
			{
				soma += numeros.charAt(tamanho - i) * pos--;
				if (pos < 2)
					pos = 9;
			}
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			
			if (resultado != digitos.charAt(1))
				return false;			

			return true;
		} 
		else return false;	
	}
};

/* CPF Validate */
var CPF =
{
	validate : function(cpf) {
		var numeros, digitos, soma, i, resultado, digitos_iguais;
		digitos_iguais = 1;
		if (cpf.length < 11)
			return false;
		for (i = 0; i < cpf.length - 1; i++)
			if (cpf.charAt(i) != cpf.charAt(i + 1))
			{
				digitos_iguais = 0;
				break;
			}
		if (!digitos_iguais)
		{
			numeros = cpf.substring(0,9);
			digitos = cpf.substring(9);
			soma = 0;
			for (i = 10; i > 1; i--)
				soma += numeros.charAt(10 - i) * i;
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(0))
				return false;
			numeros = cpf.substring(0,10);
			soma = 0;
			for (i = 11; i > 1; i--)
				soma += numeros.charAt(11 - i) * i;
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(1))
				return false;
			return true;
		}
		else
			return false;
	}
};

/* D */
/* returns only the input digits */
var Dig =
{
	only : function(v) {
		return v.replace(/\D/g, '');
	}	
};

/* returns Date format Br or Sql 
 * and time now
 * */
var Data =
{
	nowBr : function() { /* using jquery ui */
		return $.datepicker.formatDate( 'dd/mm/yy', new Date() );
	},	
	nowSql : function() { /* using jquery ui */
		return $.datepicker.formatDate( 'yy-mm-dd', new Date() );
	},
	today : function() { /* using javascript */
		var that = new Date();
	    return ((that.getDate() < 10)?"0":"") + that.getDate() +"/"+(((that.getMonth()+1) < 10)?"0":"") + (that.getMonth()+1) +"/"+ that.getFullYear() 
	},	
	timeNow : function() { /* using javascript */
		var that = new Date();
     	return ((that.getHours() < 10)?"0":"") + that.getHours() +":"+ ((that.getMinutes() < 10)?"0":"") + that.getMinutes() +":"+ ((that.getSeconds() < 10)?"0":"") + that.getSeconds();
	},	
	setAno : function( that ) { /* using javascript */
		var d = new Date();
		var year = d.getFullYear();
		
		if ( that.value.length == 5 ) {
			that.value += '/' + year;
		}
	}	
};

/* positions in specific div */
/* hide all div */
var Div = {
	go : function(id) {
		$('#'+id).slideToggle('slow', function() {
    			$('html, body').animate({scrollTop:$("#"+id).offset().top}, 'slow');	
		});		
		
		return true;
	},
	hideAll: function() {
		$('div[id^="div-"]').hide();
	}
};

/* E */

/* F */
/* Form clear */
var Form = 
{
	clear : function(idform) {
		$('#'+idform).each(function() {
			this.reset();
		});	
	}
};

/* G */
/* H */

/* I */
/* input readonly , enabledField */
var Input = {
	readOnly : function(id) {
		document.getElementById( id ).readOnly = true;
		document.getElementById( id ).style.backgroundColor = "#EEEEEE";		
		// document.getElementById( id ).value = '';
	},
	enabledField : function(id) {
		document.getElementById( id ).readOnly = false;
		document.getElementById( id ).style.backgroundColor = "#FFFFFF";		
		document.getElementById( id ).value = '';
	}
};

/* J */
/* K */
/* L */

/* M */
/* mask for input fields */
var Mask = 
{
	mascara : function(o,f) {
		v_obj = o
		v_fun = f
		setTimeout("Mask.execmascara()", 1)
	},
	execmascara : function() {
		v_obj.value=v_fun(v_obj.value)
	}, 
	mdata : function(v) {
		v=v.replace(/\D/g,"") 
		v=v.replace(/(\d{2})(\d)/,"$1/$2") 
		v=v.replace(/(\d{2})(\d)/,"$1/$2")
		return v
	}, 
	mhora : function(v) {
		v=v.replace(/\D/g,"") 
		v=v.replace(/(\d{2})(\d)/,"$1:$2")
		return v
	},
	mtelefone : function(v) {
		v=v.replace(/\D/g,"")                 
		v=v.replace(/^(\d\d)(\d)/g,"($1) $2") 
		v=v.replace(/(\d{4})(\d)/,"$1 - $2")  
		return v
	}, 
	mcep : function(v) {
		v=v.replace(/\D/g,"")              
		v=v.replace(/(\d{2})(\d)/,"$1.$2")
		v=v.replace(/(\d{3})(\d)/,"$1-$2") 
		return v
	},
	mcpf : function(v) {
		v=v.replace(/\D/g,"")                    
		v=v.replace(/(\d{3})(\d)/,"$1.$2")       
		v=v.replace(/(\d{3})(\d)/,"$1.$2")	 
		v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") 
		return v
	},
	mcnpj : function(v) {
		v=v.replace(/\D/g,"") 
		v=v.replace(/^(\d{2})(\d)/,"$1.$2") 
		v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
		v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
		v=v.replace(/(\d{4})(\d)/,"$1-$2")
		return v
	},
	mnumeros : function(v) {
		return v.replace(/\D/g,"")
	},
	mvalor : function(v) {
		v=v.replace(/\D/g,"") 
		v=v.replace(/(\d)(\d{2})$/,"$1.$2") 
		return v
	},
	mvalorbr : function(v) {
		v=v.replace(/\D/g,"") 
		v=v.replace(/(\d)(\d{2})$/,"$1,$2") 
		return v
	},	
	mfvalorbr : function(v) { /* format valor focus out */
		if ( v.indexOf(',') != -1 ) {
			v=v.split(",");
			var t = v[0].replace(/\D/g,"");
			var d = v[1].replace(/\D/g,"");
			if ( d.length == 1 ) {
				d = d + '0';	
			}
			v = t + ',' + d;
		}
		else {
			v = v.replace(/\D/g,"");
			if ( v == '' ) return '';
			v = v + ',00';
		}
		
		return v;
	}	
};

/* format a number in Brazil or US */
var Money =
{
	formatBrSemPontos: function(num) {
		num = Money.formatBr( num );
		return num.replace(/\./g, "");
	},
	formatBr: function(num) {
	    num = num.toString().replace(/\$|\,/g,'');

	    if(isNaN(num))
	        num = "0";

	    sign = (num == (num = Math.abs(num)));
	    num = Math.floor(num*100+0.50000000001);
	    cents = num%100;
	    num = Math.floor(num/100).toString();

	    if(cents<10)
	        cents = "0" + cents;

	    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	        num = num.substring(0,num.length-(4*i+3))+'.'+ num.substring(num.length-(4*i+3));

	    return (((sign)?'':'-') + num + ',' + cents);
	},	
	formatUs: function(num) {
		return num.replace(/\./g, "").replace(/,/, ".");
	}
}

/* N */
/* O */
/* P */
/* Q */

/* R */
/* return radio checked from form */
var Radio = {
	checked : function(field, form) {
		return $('input[name='+field+']:checked', '#'+form).val();
	}
};

/* S */
/* return a specific attribute, remove an option from select, remove all options from select */
var Select = {
	option_select_attr : function(idselect, attr) {
		return $('option:selected', $('#'+idselect)).attr( attr );
	},
	remove_selected_option : function(idselect) {
		$('#' + idselect + ' option:selected').each(function() {
			$(this).remove();
		});
	},
	remove_all_option : function(idselect) {
		$('#' + idselect + ' option').each(function() {
			$(this).remove();
		});
	},
	remove_all_option_using_class : function(idselect) {
		$('.' + idselect + ' option').each(function() {
			$(this).remove();
		});
	}
};

/* set html Timeout */
var Timeout = {
	set_html : function(href, time) {
		window.setTimeout(function() { window.location.href = href; }, time);
	}
};

/* T */
/* Table Remove, CalculateUs, CalculateBr, */
/* Get Fields For Table and Result ArrayCollection */
/* return columns count radio checked  */
var Table = 
{
	remove : function(idtable) {
		$('#'+idtable).remove();
	},	
	calculateUs : function(idtable, posfield) {
		var vlr = 0;
		$("#"+idtable+" tbody tr > td:nth-child("+posfield+")").each(function(i, el) {
			vlr += Number(el.innerHTML.replace(".", "").replace(",", "."));
		});
		
		return vlr;
	},
	calculateBr : function(idtable, posfield) {
		var vlr = 0;
		$("#"+idtable+" tbody tr > td:nth-child("+posfield+")").each(function(i, el) {
			vlr += Number(el.innerHTML.replace(".", "").replace(",", "."));
		});
		
		return Money.formatBr( vlr );
	},
	getFieldsResultArray : function(idtable) {
		var dados = new Array();
		
		$('#' + idtable + ' tbody tr').each(function(i, el) {
	    	var obj = new Array();
		    
		    $( $(el).children() ).each(function(ii, ell) {
		        var val = $( $(ell).children() ).val();
		        obj[ii] = val;
		    }); 
		    
			dados[i] = obj;
		});
	
		return dados;
	},
	getFieldsTextResultArray : function(idtable) {
		var dados = new Array();
		
		$('#' + idtable + ' tbody tr').each(function(i, el) {
	    	var obj = new Array();
		    
		    $( $(el).children() ).each(function(ii, ell) {
		        var val = $(ell).text();
		        obj[ii] = val;
		    }); 
		    
			dados[i] = obj;
		});
	
		return dados;
	},
	columns_count_radio_checked : function(idtable, posfield) {
		var count = 0;
		$("#"+idtable+" tbody tr > td:nth-child("+posfield+") input").each(function(i, el) {
			if ( $(el).attr('checked') == 'checked' ) {
				count++;
			}
		});
		
		return count;
	}	
};

/* insert btn edit and delete in table google with bootstrap */
var TableGoogle = {	
	btn_search_modal : function (href, func) {
	    var s = '<button class="demo btn btn-primary btn-large" href="#'+href+'" data-toggle="modal" onclick="'+func+'" >';
		s += '<i class="icon-search icon-white"></i>';
		s += '</button>'; 	  
		return s; 
	},
	btn_ok_str : function (func) {
	    var btn_search = '<button type="button" class="btn btn-small btn-success" onclick="'+func+'" >';
		btn_search += '<i class="icon-ok icon-white"></i>';
		btn_search += '</button>'; 	  
		return btn_search; 
	},
	btn_repeat_str : function(func) {		
	    var btn_search = '<button type="button" class="btn btn-small btn-warning" onclick="'+func+'" >';
		btn_search += '<i class="icon-repeat icon-white"></i>';
		btn_search += '</button>'; 	  
		return btn_search; 
	}, 
	btn_perdido_str : function (func) {
	    var btn_search = '<button type="button" class="btn btn-small btn-danger" onclick="'+func+'" >';
		btn_search += '<i class="icon-arrow-down icon-white"></i>';
		btn_search += '</button>'; 	  
		return btn_search; 
	}, 
	btn_desativado_str : function () {
	    var btn_search = '<button type="button" class="btn btn-small btn-danger" >';
		btn_search += '<i class="icon-off icon-white"></i>';
		btn_search += '</button>'; 	  
		return btn_search; 
	}, 
	btn_print_str : function (func) {
	    var btn_search = '<button type="button" class="btn btn-small btn-success" onclick="'+func+'" >';
		btn_search += '<i class="icon-print icon-white"></i>';
		btn_search += '</button>'; 	  
		return btn_search; 
	}, 
	btn_search_str : function (func) {
	    var btn_search = '<button type="button" class="btn btn-small btn-info" onclick="'+func+'" >';
		btn_search += '<i class="icon-search icon-white"></i>';
		btn_search += '</button>'; 	  
		return btn_search; 
	}, 
	btn_edit_str : function (func) {
	    var btn_edit = '<button type="button" class="btn btn-small btn-warning" onclick="'+func+'" >';
		btn_edit += '<i class="icon-pencil icon-white"></i>Editar';
		btn_edit += '</button>'; 	  
		return btn_edit; 
	}, 
	btn_delete_str : function (func) {
		var btn_del = '<button type="button" class="btn btn-small btn-danger" onclick="'+func+'" >';
		btn_del += '<i class="icon-remove icon-white"></i>Deletar';
		btn_del += '</button>';   
		return btn_del; 
	}
};

/* returns trim element */
var Trim = {
	run : function(str) {
		str.replace(/^\s+|\s+$/g,"");
	}
};

/* U */
/* V */
/* X */

/* Z */
/* Zeros add left in input */
var Zeros = {
	add_left : function(str, max) {
		str = String( str );
	
		return ( str.length < max ) ? Zeros.add_left("0" + str, max) : str;
	}
};