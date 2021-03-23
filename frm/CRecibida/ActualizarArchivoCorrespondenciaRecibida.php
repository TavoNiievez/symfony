<?php include_once ("../../utils/Date.php"); ?>
<?php include_once ("../../utils/SessionPhp.php"); ?>
<?php

	//HAY QUE ORGANIZAR EL CODIGO QUE TIENE MUCHA REBUNDANCIA

	/*Código para incluir las librerias*/
	include_once("../../src/conexion.php");

    $nuRadicado        		=  $_REQUEST["txtRadicado"];	
    $sbDestinoArchivo  		=  $_REQUEST["txtSerie"];	

	////////// DATOS DE LA SUBIDAD DEL ARCHVIO///////
	$sbNomArchivo = $_FILES ['docArchivo']['name'];
	
	
	/*/////////////////////////////	INICIO VALIDAR ARCHIVO////////////////*/
	
		if($sbNomArchivo==""){
	
	$sbCadena =  "<script language='javascript'>";
	      $sbCadena .= "alert(  'Error No Adjunto Ningun Archivo' )";
       	      $sbCadena .= "</script>";
              echo $sbCadena;
		 
	      //retorna a la pagina anterior
	      $sbCadena = '<script>window.history.back();</script>';
	      echo $sbCadena;  	
	
	}/*/////////////////////////////	FIN VALIDAR ARCHIVO////////////////*/
	
	/*/////////////////////////////	INICIO EL ELSE VALIDAR ARCHIVO////////////////*/
	else {
	
	/*Conexión con el servidor*/
	$link=ConectarseServidor();

	/*Conexión con la base de datos*/
	ConectarseBaseDatos($link);
	
	//DATOS DEL OPERARIO
	 //saca variable Login de la sesion
     $sessionLogin = getSession("Login");
	 
	
	//INICIO PROCESO PARA PONER NOMBRE FINAL AL ARCHIVO
	$vecInfoArchivo = explode(".", $sbNomArchivo);
	$sbTipo = $vecInfoArchivo[(count($vecInfoArchivo)-1)];	

	$sbNomFinalArchivo = $nuRadicado.'_'.$sbDestinoArchivo.'.'.$sbTipo;	

	$consulta= "update c_recibida set archivo = '$sbNomFinalArchivo' where radicado = '$nuRadicado'"; 
			
			/*Ejecución de la inserción*/
			$respuesta=consultas($consulta);
			
			//valida que se haya insertado correctamente el registro
			if ( $respuesta == 1  )
			{	
			
			//Traigo el ultimo id ingresado a la base de Datos
			//$ultimo_id = mysqli_insert_id(); 
			
				//header("Location:../frm/frmFotos2.php");				
				$sbCadena =  "<script language='javascript'>";
				$sbCadena .= "alert(  'El archivo Se ha Guardado Correctamente ' )";
				$sbCadena .= "</script>";
				echo $sbCadena;	
			
			
			
				//Con este comando guardo el archivo
				$sbDestino = '../../archivos/'.$sbDestinoArchivo.'/'.$sbNomFinalArchivo;
				
				// compruebo si el directorio existe
				if(!file_exists('../../archivos/'.$sbDestinoArchivo)){
					mkdir('../../archivos/'.$sbDestinoArchivo, 0775);
				}
				
				$bol = copy($_FILES['docArchivo']['tmp_name'],$sbDestino);
				
		 
	            Header("Location:Lista.php");

				
			}
			else
			{	
				$sbCadena =  "<script language='javascript'>";
				$sbCadena .= "alert(  'Error al Guardar el Archivo , Verifique los Datos' )";
				$sbCadena .= "</script>";
				echo $sbCadena;
		 
				//retorna a la pagina anterior
				$sbCadena = '<script>window.history.back();</script>';
				echo $sbCadena;  	    
			}
			
			//Función para desconectarse de la base de datos
			desconectarse($link);//cierra la conexion
	
			
	
			}	/*/////////////////////////////	FIN EL ELSE VALIDAR ARCHIVO////////////////*/


	/*Función para desconectarse de la base de datos*/
	desconectarse($link);//cierra la conexion


?>