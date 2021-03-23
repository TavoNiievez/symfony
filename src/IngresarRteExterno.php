<HTML>
<title>
   Usuario
</title>

<BODY>
<?php
	/*Código para incluir las librerias*/
	include_once("conexion.php");
	
	
	//Recupero Variable para modificar
	$nuModificar	=  $_REQUEST["txtModificar"];


	/*Recuperación de variables*/
    $sbNombre        		=  $_REQUEST["txtNombre"];	
	$sbRepresentate        	=  $_REQUEST["txtRepresentante"];	
	$sbDireccion        	=  $_REQUEST["txtDireccion"];	
	$sbCiudad    			=  $_REQUEST["txtCiudad"];	
	$sbTelefono        		=  $_REQUEST["txtTelefono"];	
	$sbEmail        		=  $_REQUEST["txtEmail"];	
	
	//$sbRutaFoto        	=  $_REQUEST["txtRutaFoto"];
	

	
	
	/*Conexión con el servidor*/
	$link=ConectarseServidor();

	/*Conexión con la base de datos*/
	ConectarseBaseDatos($link);
			
	//////////////////////////////////////////INCIO SI MODIFICO EL REGISTRO//////////////////////////////////////////////////////////////
	if($nuModificar==1){
		$sbCodigo =  $_REQUEST["txtCodigo"];		
		$modificar="delete from   remitentesexternos where id= '$sbCodigo'; ";
		consultas($modificar);
		$consulta="insert into remitentesexternos values( '$sbCodigo','$sbNombre','$sbRepresentate','$sbDireccion','$sbCiudad', '$sbTelefono', '$sbEmail')";
		
	}	
	//////////////////////////////////////////FIN SI MODIFICO EL REGISTRO//////////////////////////////////////////////////////////////
	else{
		$consulta="insert into remitentesexternos values( null,'$sbNombre','$sbRepresentate','$sbDireccion','$sbCiudad', '$sbTelefono', '$sbEmail')";
	}				
	//echo "se guardo correctamente";			
				
	/*Ejecución de la inserción*/
	$respuesta=consultas($consulta);
	
	//valida que se haya insertado correctamente el registro
	if ( $respuesta == 1  )
	{	
			
		//Traigo el ultimo id ingresado a la base de Datos
		$ultimo_id = mysqli_insert_id($link); 
	
		//header("Location:../frm/frmFotos2.php");				
		$sbCadena =  "<script language='javascript'>";
		$sbCadena .= "alert(  'El Remitente Externo Se ha Registrado Correctamente ' )";
		$sbCadena .= "</script>";
		echo $sbCadena;	
		
		//retorna a la pagina anterior
		Header("Location:../frm/RteExterno/Vista.php?id=$ultimo_id");
		
	}
			else
			{	
				$sbCadena =  "<script language='javascript'>";
				$sbCadena .= "alert(  'Error al Registrar Remitente Externo , Verifique los Datos' )";
				$sbCadena .= "</script>";
				echo $sbCadena;
		 
				//retorna a la pagina anterior
				$sbCadena = '<script>window.history.back();</script>';
				echo $sbCadena;  	    
			}
			
			//Función para desconectarse de la base de datos
			desconectarse($link);//cierra la conexion
	
			
	
	

	/*Función para desconectarse de la base de datos*/
	desconectarse($link);//cierra la conexion


?>
</BODY>
</HTML>
