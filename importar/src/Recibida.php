<?php


/*Código para incluir las librerias*/
 include_once("../../src/conexion.php");


 /*Conexión con el servidor*/
  $link=ConectarseServidor();

 /*Conexión con la base de datos*/
  ConectarseBaseDatos($link);

// Realiza importacion de datos 

$rcVector = file("../archivos/recibida.csv");

for ($i=1; $i<sizeof($rcVector); $i++ ){
  $rc = explode(";",$rcVector[$i]);
   
  $radicado				= $rc[0];
  $remitente_id 		= $rc[1];  
  $remitente_ext_int 	= $rc[2];  
  $destinatario_id 		= $rc[3];  
  $medio_id 			= $rc[4];  
  $folio 				= $rc[5];  
  $asunto 				= $rc[6];  
  $archivo 				= $rc[7];  
  $estado_id 			= $rc[8];  
  $usuario_id 			= $rc[9];  
  $fecha 				= $rc[10];  
  $hora 				= $rc[11];  
  $documentos_id 		= $rc[12];  
  $f_termino 			= $rc[13];  
 
   
  
  $sql    = "INSERT INTO c_recibida values('$radicado', $remitente_id, $remitente_ext_int, $destinatario_id, $medio_id, $folio,'$asunto','$archivo', $estado_id, $usuario_id, $fecha,'$hora', $documentos_id, $f_termino)"; 
   
   if(!mysqli_query($link,$sql)){	 	 
	  $sbCadena =  "<script language='javascript'>";
      $sbCadena .= "alert(  'Error al Insertar  Registros ' )";
      $sbCadena .= "</script>";
      echo $sbCadena;  
	 
   //retorna a la pagina anterior
   $sbCadena = '<script>window.history.back();</script>';
   echo $sbCadena; 	 
   }

}// for

 $sbCadena =  "<script language='javascript'>";
 $sbCadena .= "alert('Proceso Finalizado')";
 $sbCadena .= "</script>";
 echo $sbCadena;
 
 

 /*Función para desconectarse de la base de datos*/
  desconectarse($link);//cierra la conexion

   //retorna a la pagina anterior
   $sbCadena = '<script>window.history.back();</script>';
   echo $sbCadena; 
  
?>