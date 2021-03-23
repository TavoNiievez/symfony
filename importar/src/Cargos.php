<?php


/*Código para incluir las librerias*/
 include_once("../../src/conexion.php");


 /*Conexión con el servidor*/
  $link=ConectarseServidor();

 /*Conexión con la base de datos*/
  ConectarseBaseDatos($link);

// Realiza importacion de datos 

$rcVector = file("../archivos/cargos.csv");

for ($i=1; $i<sizeof($rcVector); $i++ ){
  $rc = explode(",",$rcVector[$i]);
   
  $id			= $rc[0];
  $descripcion 	= $rc[1];  
 
   
  
  $sql    = "INSERT INTO cargo values('$id','$descripcion')"; 
   
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