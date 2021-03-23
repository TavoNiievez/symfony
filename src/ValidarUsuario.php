<?php  
include_once ("../utils/SessionPhp.php");
?>
<HTML>
<title>
Validar Usuario
</title>

<BODY>
<?php
	/*Código para incluir las librerias*/	
	include_once("conexion.php");	
	
	/*Recuperación de variables*/
	$login = $_POST['login'];
	$clave = $_POST['clave'];
	
	/*Conexión con el servidor*/
	$link=ConectarseServidor();

	/*Conexión con la base de datos*/
	ConectarseBaseDatos($link);

	/*Expresión SQL para validar si un usuario existe*/
 	$consulta="select perfil_id from usuario where login ='$login' and clave ='$clave' and estado_id = 1 ";

	/*Ejecución de la consulta*/
	$respuesta=consultas($consulta);

 	//obtiene respuesta
      $fila = mysqli_fetch_array($respuesta,MYSQLI_NUM);
	  	  

      //guarda el perfil en una variable de sesion
       $sessionName=$fila[0];
       $sessionType="Perfil";
       setSession($sessionType,$sessionName);

	   //saca variable perfil de la sesion
       $sessionPerfil = getSession($sessionType);	   
	   
     if ( $sessionPerfil == "" ) {
			$sbCadena =  "<script language='javascript'>";
			$sbCadena .= "alert('Usuario No Valido')";
			$sbCadena .= "</script>";
			echo $sbCadena;

			$sbCadena = '<script>window.history.back();</script>';
		  	echo $sbCadena;  	
     }
	 else {	
	      
		    //ubica el login en la sesion  		   
		    $sessionName=$login;
            $sessionType="Login";
            setSession($sessionType,$sessionName);
						
			if ( $sessionPerfil != 0 ){ 	
				
				//Muestrta menu	Administrador		
				$sbCadena =  "<script language='javascript'>";
				$sbCadena .= "location.href = '../menu/index.php'";
				$sbCadena .= "</script>";
				echo $sbCadena;
			}
			else if ( $sessionPerfil  == 2 ){ 	
				//Muestrta menu Consulta			
				$sbCadena =  "<script language='javascript'>";
				$sbCadena .= "location.href = '../menu/indexConsulta.php'";
				$sbCadena .= "</script>";
				echo $sbCadena;
			}
			
			//aquie modifique esto
			else if ( $fila[0] == 3 ){ 	
				//Muestra menu Usuario			
				$sbCadena =  "<script language='javascript'>";
				$sbCadena .= "location.href = '../menu/index.php'";
				$sbCadena .= "</script>";
				echo $sbCadena;
			}
	}


	/*Función para desconectarse de la base de datos*/
	desconectarse($link);//cierra la conexion


?>
</BODY>
</HTML>
