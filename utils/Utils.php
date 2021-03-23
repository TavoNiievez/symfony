<?php
 
 function getFechaActual () {
 
	date_default_timezone_set("America/Bogota");
	$dtFecha		= date('Y-m-d');
	return $dtFecha;
	
 }
 
  function getHoraActual () {
 
	date_default_timezone_set("America/Bogota");
	$dtTime			= date('H:i:s');
	return $dtTime;	
 
 }
 
 function buscarAuditores ($infoAuditores){
 
  //C�digo para incluir las librerias
	 include_once("../../src/conexion.php");
	 //Conexi�n con el servidor
	 $link=ConectarseServidor();

	 //Conexi�n con la base de datosrecepcion
	 ConectarseBaseDatos($link);
 
	$sbInfoAuditor ="";
 
	//Separar la informacion de cinfoAuditoresada Auditor
 	$sbInfoAuditorIndividual = explode (";",$infoAuditores);

	
	//para recore
	for($i=0 ; $i< count($sbInfoAuditorIndividual); $i++){
	
	if($sbInfoAuditorIndividual[$i] != ""){
	
	//Separo las Cedulas
 	list($sbCedula, $Cargo) = explode("-", $sbInfoAuditorIndividual[$i]);

	
		$sql= "SELECT u.nombre, u.apellido1, u.apellido2, u.cargo_id, u.profesion
			FROM usuario u
			WHERE u.id = $sbCedula"; 
		
		$resultAuditor =mysqli_query($link,$sql);
		$row=mysqli_fetch_array($resultAuditor,MYSQLI_NUM);
		$sbInfoAuditor.= $row[0]." ".$row[1]." ".$row[2]."-".$row[3]."-".$row[4]."-".$Cargo.";";	
		mysqli_free_result($resultAuditor);	
		
	}
	
	}

 return $sbInfoAuditor;
 }
 
 
 function buscarResponsableAuditoria ($CedulaResponsable){
 
  //C�digo para incluir las librerias
	 include_once("../../src/conexion.php");
	 //Conexi�n con el servidor
	 $link=ConectarseServidor();

	 //Conexi�n con la base de datosrecepcion
	 ConectarseBaseDatos($link);
 
	$sbInfoResponsable 	="";
	$sbNombreCompleto	="";
 
		
		$sql= "SELECT u.nombre, u.apellido1, u.apellido2, u.cargo_id, u.profesion, u.dependencia_id
			FROM usuario u
			WHERE u.id = $CedulaResponsable"; 
		
		$resultAuditor =mysqli_query($link,$sql);
		$row=mysqli_fetch_array($resultAuditor);
		$sbNombreCompleto = $row[0]." ".$row[1]." ".$row[2];
		$sbInfoResponsable.= $sbNombreCompleto."-".$row[3]."-".$row[4]."-".$row[5];	
		mysqli_free_result ($resultAuditor);	
	

 return $sbInfoResponsable;
 }

   //funcion para cambiar formato fecha
function cambiarFormatoFecha($fecha){
    list($anio,$mes,$dia)=explode("-",$fecha);
    return $dia."-".$mes."-".$anio;
} 		
	
		
//funcion para restar fechas		
function restaFechas($dFecIni, $dFecFin)
{
    $dFecIni = str_replace("-","",$dFecIni);
    $dFecIni = str_replace("/","",$dFecIni);
    $dFecFin = str_replace("-","",$dFecFin);
    $dFecFin = str_replace("/","",$dFecFin);

    preg_match( '/'."([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})".'/', $dFecIni, $aFecIni);
    preg_match( '/'."([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})".'/', $dFecFin, $aFecFin);

    $date1 = mktime(0,0,0,$aFecIni[2], $aFecIni[1], $aFecIni[3]);
    $date2 = mktime(0,0,0,$aFecFin[2], $aFecFin[1], $aFecFin[3]);

    return round(($date2 - $date1) / (60 * 60 * 24));
}
?>
