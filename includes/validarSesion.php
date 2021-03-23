<?php 


    
   //saca variable perfil de la sesion
   $sessionLogin = getSession("Login");
      
if ( $sessionLogin == "") {
	$sbCadena =  "<script language='javascript'>";
	$sbCadena .= "alert('Usuario No Autenticado')";
	$sbCadena .= "</script>";
	echo $sbCadena;

	$sbCadena =  "<script language='javascript'>";
	$sbCadena .= "location.href = '../../index.php'";
	$sbCadena .= "</script>";
	echo $sbCadena;  	
}

?>