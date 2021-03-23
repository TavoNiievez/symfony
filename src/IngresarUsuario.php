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
	$sbIdUsuario			=  $_REQUEST["txtCedula"];	
    $sbNombre        		=  $_REQUEST["txtNombre"];	
	$sbApellido1        	=  $_REQUEST["txtApellido1"];
	$sbApellido2        	=  $_REQUEST["txtApellido2"];
	$sbDireccion        	=  $_REQUEST["txtDireccion"];
	$sbTelefono        		=  $_REQUEST["txtTelefono"];
	$sbCelular       		=  $_REQUEST["txtCelular"];
	$sbEmail        		=  $_REQUEST["txtEmail"];
	$sbFechaNacimiento 		=  $_REQUEST["dtFechaNac"];
	$nuIdCiudad    			=  $_REQUEST["cmbCiudad"];
	$sbSexo          		=  $_REQUEST["cmbSexo"];
	$nuDependencia     		=  $_REQUEST["cmbDependencia"];
	$nuIdCargo        		=  $_REQUEST["cmbCargo"];
	$sbProfesion        	=  $_REQUEST["txtProfesion"];
	$sbLogin        		=  $_REQUEST["txtLogin"];
	$sbClave        		=  $_REQUEST["txtClave"];
	$sbClave2        		=  $_REQUEST["txtClave2"];
	$nuIdPerfil		        =  $_REQUEST["cmbPerfil"];
	$nuIdEstado		        =  $_REQUEST["cmbEstado"];
	//$sbRutaFoto        	=  $_REQUEST["txtRutaFoto"];
	

	//---------------------------------------------------------------------------	
	//realiza la conversion de los datos a mayuscula, para almacenar en la BD		
	$sbNombre   = ucwords( strtolower($sbNombre) );
	$sbApellido1   = ucwords( strtolower($sbApellido1) );
	$sbApellido2   = ucwords( strtolower($sbApellido2) );
	//---------------------------------------------------------------------------
	
	/*Conexión con el servidor*/
	$link=ConectarseServidor();

	/*Conexión con la base de datos*/
	ConectarseBaseDatos($link);

	
	if($sbClave==$sbClave2)
	{
		
			
			//////////////////////////////////////////INCIO SI MODIFICO EL REGISTRO//////////////////////////////////////////////////////////////
			if($nuModificar==1){
	
			$modificar="delete from   usuario where id= '$sbIdUsuario'; ";
	
			consultas($modificar);
	
			$consulta="insert into usuario values( '$sbIdUsuario' ,'$sbNombre','$sbApellido1','$sbApellido2','$sbDireccion', '$sbTelefono', '$sbCelular','$sbEmail', 
	                                        '$sbFechaNacimiento',$nuIdCiudad, '$sbSexo', '$nuDependencia', $nuIdCargo, '$sbProfesion',  '$sbLogin', '$sbClave', $nuIdPerfil,   $nuIdEstado )";
		
			}	//////////////////////////////////////////FIN SI MODIFICO EL REGISTRO//////////////////////////////////////////////////////////////

			else{
		
			$consulta="insert into usuario values( '$sbIdUsuario' ,'$sbNombre','$sbApellido1','$sbApellido2','$sbDireccion', '$sbTelefono', '$sbCelular','$sbEmail', 
	                                        '$sbFechaNacimiento',$nuIdCiudad, '$sbSexo', '$nuDependencia', $nuIdCargo, '$sbProfesion',  '$sbLogin', '$sbClave', $nuIdPerfil,   $nuIdEstado )";
			}
			
			
			//echo "se guardo correctamente";			
						
			/*Ejecución de la inserción*/
			$respuesta=consultas($consulta);
			
			//valida que se haya insertado correctamente el registro
			if ( $respuesta == 1  )
			{	
			
			//Traigo el ultimo id ingresado a la base de Datos
			//$ultimo_id = mysqli_insert_id(); 
			
				//header("Location:../frm/frmFotos2.php");				
				$sbCadena =  "<script language='javascript'>";
				$sbCadena .= "alert(  'Usuario Se ha Creado Correctamente ' )";
				$sbCadena .= "</script>";
				echo $sbCadena;	
				
				//retorna a la pagina anterior
				Header("Location:../frm/Usuario/Vista.php?id=$sbIdUsuario.");
				
			}
			else
			{	
				$sbCadena =  "<script language='javascript'>";
				$sbCadena .= "alert(  'Error al Ingresar Usuario, Verifique los Datos' )";
				$sbCadena .= "</script>";
				echo $sbCadena;
		 
				//retorna a la pagina anterior
				$sbCadena = '<script>window.history.back();</script>';
				echo $sbCadena;  	    
			}
			
			//Función para desconectarse de la base de datos
			desconectarse($link);//cierra la conexion
	}
	else
	{
			$sbCadena =  "<script language='javascript'>";
			$sbCadena .= "alert(  'Las Claves no coinciden' )";
			$sbCadena .= "</script>";
			echo $sbCadena;
			
			//retorna a la pagina anterior
			$sbCadena = '<script>window.history.back();</script>';		echo $sbCadena;  	    
	}		
	
	

	/*Función para desconectarse de la base de datos*/
	desconectarse($link);//cierra la conexion


?>
</BODY>
</HTML>
