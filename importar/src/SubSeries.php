<?php


/*Código para incluir las librerias*/
 include_once("../../src/conexion.php");


 /*Conexión con el servidor*/
  $link=ConectarseServidor();

 /*Conexión con la base de datos*/
  ConectarseBaseDatos($link);

// Realiza importacion de datos 

$rcVector = file("../archivos/sseries_.csv");

for ($i=1; $i<sizeof($rcVector); $i++ ){
  $rc = explode(";",$rcVector[$i]);
   
  $id			= $rc[0];
  $trd 			= $rc[1];
  $descripcion 	= $rc[2];  
 
   
  
  $sql    = "INSERT INTO subseries(id_serie, trd, descripcion) values('$id','$trd','$descripcion')"; 
   
   if(!mysqli_query( $link,$sql)){	 	 
	  $sbCadena =  mysqli_error($link);
	  $sbCadena .=  "<script language='javascript'>";
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