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

function Buscar(url){
    
	

	divResultado = document.getElementById('ResultadoReportes');
	
	sbAgrupacionDias = document.getElementById('cmbReporte').value;
	
	ajax=objetoAjax();
	
	ajax.open("POST", url, true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			document.getElementById('ResultadoReportes').innerHTML = ajax.responseText;
		}
	}
        
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		 ajax.send('cmbReporte='+sbAgrupacionDias);
		 //ajax.send('cbxFuncion='+sbFuncion);
}//crea la funcion para  validar campos vacios 


//crea la funcion para  validar campos vacios 
function validarIngreso(form){

  if (form.cmbRemitente.value=='') {
	alert ('El campo Correspondencia es requerido')
    form.cmbRemitente.focus();
    return false;
  }
  
  
  if (form.cmbDependencia.value=='') {
	alert ('El campo Remitente  es requerido')
    form.cmbDependencia.focus();
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


