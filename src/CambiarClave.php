<?php 

include_once("../src/conexion.php");	 
include_once ("../utils/SessionPhp.php");
	
	 //Conexión con el servidor
	 $link=ConectarseServidor();
	 //Conexión con la base de datos
	 ConectarseBaseDatos($link);
	
	
	//saca variable perfil de la sesion
   $sessionLogin = getSession("Login");
      
	  //Recupero las variables del formulario
	$sbClaveAntigua	  	=  $_REQUEST["txtClaveAntigua"];	
	$sbClaveNueva      	=  $_REQUEST["txtClaveNueva"];
	$sbConfirmarClave	=  $_REQUEST["txtConfirmarClave"];
	
	 //----------------------------------------------------------------------------
	 //Obtiene Id y nombre usuario
	 $sql2 = "select u.id, u.nombre, u.apellido1, u.clave
		      from usuario u
			  where u.login = '$sessionLogin'";
  			 			 
	 $result2=mysqli_query($link,$sql2);
	 $row2=mysqli_fetch_array($result2,MYSQLI_NUM);
	 
	 $nuIdUser       = $row2[0];
	 $sbNombreUser   = $row2[1];
	 $sbApellidoUser = $row2[2];
	 $sbClave		 = $row2[3];	


	if($sbClaveAntigua == $sbClave){
	
		if($sbClaveNueva  == 	$sbConfirmarClave) {
			
		 	$consulta="UPDATE usuario set clave = '$sbClaveNueva' where id = '$nuIdUser' ";
			
			/*Ejecución de la inserción*/
			$respuesta=consultas($consulta);

        
	
			
     	  $sbCadena =  "<script language='javascript'>";
          $sbCadena .= "alert(  'Se ha Cambiado la Clave Correctamente' )";
     	  $sbCadena .= "</script>";
     	  echo $sbCadena;
		  
		  //retorna a la pagina anterior
	      $sbCadena = '<script>window.history.back();</script>';
	      echo $sbCadena;  	
			
		
		}else{
		
		  $sbCadena =  "<script language='javascript'>";
	      $sbCadena .= "alert(  'Error ,Las Clave no conciden' )";
       	      $sbCadena .= "</script>";
              echo $sbCadena;
		 
	      //retorna a la pagina anterior
	      $sbCadena = '<script>window.history.back();</script>';
	      echo $sbCadena;  	
		
		}	
	
	}else{
	
	 $sbCadena =  "<script language='javascript'>";
	      $sbCadena .= "alert(  'Error ,La Clave del Usuario es Incorrecta' )";
       	      $sbCadena .= "</script>";
              echo $sbCadena;
		 
	      //retorna a la pagina anterior
	      $sbCadena = '<script>window.history.back();</script>';
	      echo $sbCadena;  	
	
	}
	 
	 
	/*Función para desconectarse de la base de datos*/
	desconectarse($link);//cierra la conexion

 
	 
?>		
