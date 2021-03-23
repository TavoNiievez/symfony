    (function( $ ) {
        $.widget( "ui.combobox", {
            _create: function() {
                var input,
                    that = this,
                    select = this.element.hide(),
                    selected = select.children( ":selected" ),
                    value = selected.val() ? selected.text() : "",
                    wrapper = this.wrapper = $( "<span>" )
                        .addClass( "ui-combobox" )
                        .insertAfter( select );
 
                function removeIfInvalid(element) {
                    var value = $( element ).val(),
                        matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
                        valid = false;
                    select.children( "option" ).each(function() {
                        if ( $( this ).text().match( matcher ) ) {
                            this.selected = valid = true;
                            return false;
                        }
                    });
                    if ( !valid ) {
                        $( element )
                            .val( "" )
                            .attr( "title", value + " match any item" )
                            .tooltip( "open" );
                        select.val( "" );
                        setTimeout(function() {
                            input.tooltip( "close" ).attr( "title", "" );
                        }, 2500 );
                        input.data( "autocomplete" ).term = "";
                        return false;
                    }
                }
 
                input = $( "<input>" )
                    .appendTo( wrapper )
                    .val( value )
                    .attr( "title", "" )
                    .addClass( "ui-state-default ui-combobox-input" )
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: function( request, response ) {
                            var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                            response( select.children( "option" ).map(function() {
                                var text = $( this ).text();
                                if ( this.value && ( !request.term || matcher.test(text) ) )
                                    return {
                                        label: text.replace(
                                            new RegExp(
                                                "(?![^&;]+;)(?!<[^<>]*)(" +
                                                $.ui.autocomplete.escapeRegex(request.term) +
                                                ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                            ), "<strong>$1</strong>" ),
                                        value: text,
                                        option: this
                                    };
                            }) );
                        },
                        select: function( event, ui ) {
                            ui.item.option.selected = true;
                            that._trigger( "selected", event, {
                                item: ui.item.option
                            });
                        },
                        change: function( event, ui ) {
                            if ( !ui.item )
                                return removeIfInvalid( this );
                        }
                    })
                    .addClass( "ui-widget ui-widget-content ui-corner-left" );
 
                input.data( "autocomplete" )._renderItem = function( ul, item ) {
                    return $( "<li>" )
                        .data( "item.autocomplete", item )
                        .append( "<a>" + item.label + "</a>" )
                        .appendTo( ul );
                };
 
                $( "<a>" )
                    .attr( "tabIndex", -1 )
                    .attr( "title", "Show All Items" )
                    .tooltip()
                    .appendTo( wrapper )
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    .removeClass( "ui-corner-all" )
                    .addClass( "ui-corner-right ui-combobox-toggle" )
                    .click(function() {
                        // close if already visible
                        if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
                            input.autocomplete( "close" );
                            removeIfInvalid( input );
                            return;
                        }
 
                        // work around a bug (likely same cause as #5265)
                        $( this ).blur();
 
                        // pass empty string as value to search for, displaying all results
                        input.autocomplete( "search", "" );
                        input.focus();
                    });
 
                    input
                        .tooltip({
                            position: {
                                of: this.button
                            },
                            tooltipClass: "ui-state-highlight"
                        });
            },
 
            destroy: function() {
                this.wrapper.remove();
                this.element.show();
                $.Widget.prototype.destroy.call( this );
            }
        });
    })( jQuery );
 
    $(function() {
        $( "#combobox" ).combobox();
        $( "#toggle" ).click(function() {
            $( "#combobox" ).toggle();
        });
    });
	
	var cambiar = {
    
	ejecutar: function(){
	
	
	var x = document.frmUsuarios.cmbRemitente.selectedIndex;
	var valor =document.frmUsuarios.cmbRemitente.options[x].value;
	
	
	if(valor == 0){ this.accion(0,1,2); 	}
	if(valor == 1){	this.accion(1,2,0);	}
	if(valor == 2){	this.accion(2,1,0);	}
	
	},
	accion:  function(mostar, oculto1, oculto2){ this.mostrar(mostar); this.ocultar(oculto1); this.ocultar2(oculto2);},
    ocultar: function(num){ document.getElementById("div"+num).style['display'] = "none"; },
    ocultar2: function(num){ document.getElementById("div"+num).style['display'] = "none"; },
    mostrar: function(num){ document.getElementById("div"+num).style['display'] = "block"; }
 };
	
	function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}//crea la funcion para  validar campos vacios 
function validarIngreso(form){



}//fin de la funcion validarIngreso

function BuscarRemitente(url){
    
	

	divResultado = document.getElementById('ResultadoRemitente');
	
	sbAgrupacionDias = document.getElementById('cmbRemitente').value;
	
	ajax=objetoAjax();
	
	ajax.open("POST", url, true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			document.getElementById('ResultadoRemitente').innerHTML = ajax.responseText;
		}
	}
        
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		 ajax.send('cmbRemitente='+sbAgrupacionDias);
		 //ajax.send('cbxFuncion='+sbFuncion);
}//crea la funcion para  validar campos vacios 


//crea la funcion para  validar campos vacios 
function validarIngreso(form){

  if (form.cmbDestinatario.value=='') {
	alert ('El campo Destinatario es requerido')
    form.cmbDestinatario.focus();
    return false;
  }

  if (form.cmbDocumento.value=='') {
	alert ('El campo Documento es requerido')
    form.cmbDocumento.focus();
    return false;
  }
    /*if (form.dtTermino.value=='') {
	alert ('El campo Termino del Documento es requerido')
    form.dtTermino.focus();
    return false;
  }*/
    
	if (form.cmbMedios.value=='') {
	alert ('El campo Medio es requerido')
    form.cmbMedios.focus();
    return false;
  }

  if (form.txtFolios.value=='') {
	alert ('El campo Folios es requerido')
    form.txtFolios.focus();
    return false;
  }
  
   
  
  if (form.txtAsunto.value=='') {
	alert ('El campo Asunto  es requerido')
    form.txtAsunto.focus();
    return false;
  }


}//fin de la funcion validarIngreso

	
//funcion para llamar proceso que genera reporte en excel
function generarExcel(){

   alert ("Generar Reporte Excel");	

}//fin de la funcion generarExcel


//funcion para llamar proceso que genera reporte en pdf
function generarPDF(){
	
  //llama  la funcion que muestra el reporte en pdf
  parent.location="../reportes/InfCitacionComiteEnlacePDF.php";
  
}//fin de la funcion generarPDF

function oculta(){ document.getElementById("resultadoExterno").style.visibility = "hidden";}
function muestra(){ document.getElementById("resultadoExterno").style.visibility = "visible";}
