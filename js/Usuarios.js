
 	
	var cambiar = {
    
	ejecutar: function(){
	
	
	var x = document.frmCorrepondenciaEnviada.cmbDestinatario.selectedIndex;
	var valor =document.frmCorrepondenciaEnviada.cmbDestinatario.options[x].value;
	
	
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
	
	sbAgrupacionDias = document.getElementById('cmbRadicadoInicial').value;
	
	ajax=objetoAjax();
	
	ajax.open("POST", url, true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			document.getElementById('ResultadoRemitente').innerHTML = ajax.responseText;
		}
	}
        
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		 ajax.send('cmbRadicadoInicial='+sbAgrupacionDias);
		 //ajax.send('cbxFuncion='+sbFuncion);
}//crea la funcion para  validar campos vacios 

function BuscarDestinatario(url){
    
	

	divResultado = document.getElementById('ResultadoDestinatario');
	
	sbAgrupacionDias = document.getElementById('cmbDestinatario').value;
	
	ajax=objetoAjax();
	
	ajax.open("POST", url, true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			document.getElementById('ResultadoDestinatario').innerHTML = ajax.responseText;
		}
	}
        
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		 ajax.send('cmbDestinatario='+sbAgrupacionDias);
		 //ajax.send('cbxFuncion='+sbFuncion);
}//crea la funcion para  validar campos vacios 


//crea la funcion para  validar campos vacios 
function validarIngreso(form){


if (form.txtCedula.value=='') {
	alert ('El campo Cedula es requerido')
    form.txtCedula.focus();
    return false;
  }
  
if (form.txtNombre.value=='') {
	alert ('El campo Nombre es requerido')
    form.txtNombre.focus();
    return false;
  }
  
if (form.txtApellido1.value=='') {
	alert ('El campo Apellido es requerido')
    form.txtApellido1.focus();
    return false;
  }
  
if (form.cmbCiudad.value=='') {
	alert ('El campo Ciudad es requerido')
    form.cmbCiudad.focus();
    return false;
  }
  
  
  if (form.cmbCargo.value=='') {
	alert ('El campo Cargo  es requerido')
    form.cmbCargo.focus();
    return false;
	
  }  
  if (form.rowDependencia.value=='') {
	alert ('El campo Dependencia  es requerido')
    form.rowDependencia.focus();
    return false;
	
  }  
  if (form.cmbEstado.value=='') {
	alert ('El campo Estado  es requerido')
    form.cmbEstado.focus();
    return false;
  }  
  
  if (form.cmbPerfil.value=='') {
	alert ('El campo Perfil  es requerido')
    form.cmbPerfil.focus();
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
  
}//fin de la funcion generarPDF//funcion para llamar proceso que genera reporte en pdf

function ImprimirSticker(){
	
	form.txtAgrupacionInfoSQL.value = form.txtRadicado.value +'-'+ form.txtRadicadoInicial.value +'-'+ form.txtDestinatario.value +'-'+
					form.txtFecha.value+'-'+ form.txtFolios.value +'-'+	form.txtVigencia.value;
	
  //llama  la funcion que muestra el reporte en pdf
  parent.location="Sticker.php";
  
}//fin de la funcion generarPDF

function oculta(){ document.getElementById("resultadoExterno").style.visibility = "hidden";}
function muestra(){ document.getElementById("resultadoExterno").style.visibility = "visible";}


