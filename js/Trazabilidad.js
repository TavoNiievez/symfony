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

function BuscarLista(url,form){
    
	
	form.txtAgrupacionInfoSQL.value = form.txtRadicado.value +'-'+ form.txtRemitentes.value +'-'+ form.txtDocumento.value +'-'+
					form.txtTermino.value+'-'+ form.txtEntidad_Dependencia.value +'-'+	form.txtDestinatario.value +'-'+	form.txtFecha.value;
	
	divResultado = document.getElementById('Listado');
	
	sbAgrupacionDias = document.getElementById('txtAgrupacionInfoSQL').value;
	
	ajax=objetoAjax();
	
	ajax.open("POST", url, true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			document.getElementById('Listado').innerHTML = ajax.responseText;
		}
	}
        
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		 ajax.send('txtAgrupacionInfoSQL='+sbAgrupacionDias);
		 //ajax.send('cbxFuncion='+sbFuncion);
}//crea la funcion para  validar campos vacios 


//crea la funcion para  validar campos vacios 
function validarIngreso(form){

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


