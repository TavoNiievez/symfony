<HTML>
<title>
   Usuario
</title>

<BODY>
<?php
	/*C�digo para incluir las librerias*/
	include_once("conexion.php");
	
	
	//Recupero Variable para modificar
	$nuModificar	=  $_REQUEST["txtModificar"];


	/*Recuperaci�n de variables*/
    $sbCodigo			=  $_REQUEST["txtCodigo"];	
    $sbDepencia     	=  $_REQUEST["txtDependencia"];	
	$nuUsuario       	=  $_REQUEST["cmbUsuario"];	
	
	//$sbRutaFoto        	=  $_REQUEST["txtRutaFoto"];
	

	
	
	/*Conexi�n con el servidor*/
	$link=ConectarseServidor();

	/*Conexi�n con la base de datos*/
	ConectarseBaseDatos($link);

	
	
			
			//////////////////////////////////////////INCIO SI MODIFICO EL REGISTRO//////////////////////////////////////////////////////////////
			if($nuModificar==1){
	
			$modificar="delete from   dependencia where id= '$sbCodigo'; ";
	
			consultas($modificar);
	
			$consulta="insert into dependencia values( $sbCodigo ,'$sbDepencia',$nuUsuario)";
		
			}	//////////////////////////////////////////FIN SI MODIFICO EL REGISTRO//////////////////////////////////////////////////////////////

			else{
		
			$consulta="insert into dependencia values( $sbCodigo ,'$sbDepencia',$nuUsuario)";
			}
			
			
			//echo "se guardo correctamente";			
						
			/*Ejecuci�n de la inserci�n*/
			$respuesta=consultas($consulta);
			
			//valida que se haya insertado correctamente el registro
			if ( $respuesta == 1  )
			{	
			
			//Traigo el ultimo id ingresado a la base de Datos
			//$ultimo_id = mysqli_insert_id(); 
			
				//header("Location:../frm/frmFotos2.php");				
				$sbCadena =  "<script language='javascript'>";
				$sbCadena .= "alert(  'La Dependencia Se ha Registrado Correctamente ' )";
				$sbCadena .= "</script>";
				echo $sbCadena;	
				
				//retorna a la pagina anterior
				Header("Location:../frm/Dependencia/Lista.php");
				
			}
			else
			{	
				$sbCadena =  "<script language='javascript'>";
				$sbCadena .= "alert(  'Error al Registrar la Dependencia  , Verifique los Datos' )";
				$sbCadena .= "</script>";
				echo $sbCadena;
		 
				//retorna a la pagina anterior
				$sbCadena = '<script>window.history.back();</script>';
				echo $sbCadena;  	    
			}
			
			//Funci�n para desconectarse de la base de datos
			desconectarse($link);//cierra la conexion
	
			
	
	

	/*Funci�n para desconectarse de la base de datos*/
	desconectarse($link);//cierra la conexion


?>
</BODY>
</HTML>
