<?php include_once ("../../utils/Date.php"); ?>
<?php include_once ("../../utils/SessionPhp.php"); ?>
<?php

	//HAY QUE ORGANIZAR EL CODIGO QUE TIENE MUCHA REBUNDANCIA

	/*C�digo para incluir las librerias*/
	include_once("../../src/conexion.php");

    $nuRadicado     	=  $_REQUEST["txtRadicado"];	
    $sbTrd        		=  $_REQUEST["txtTRD"];	
	$sbSerie			= explode("-", $sbTrd);
	$sbSubSerie			= explode(".", $sbTrd);
	$sbAdicionalDestino	= "";
	
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
	
	/*Conexi�n con el servidor*/
	$link=ConectarseServidor();

	/*Conexi�n con la base de datos*/
	ConectarseBaseDatos($link);

	//DATOS DEL OPERARIO
	 //saca variable Login de la sesion
     $sessionLogin = getSession("Login");
	 
	
	//INICIO PROCESO PARA PONER NOMBRE FINAL AL ARCHIVO
	$vecInfoArchivo = explode(".", $sbNomArchivo);
	$sbTipo = $vecInfoArchivo[(count($vecInfoArchivo)-1)];	

	$sbNomFinalArchivo = $nuRadicado.'_'.$sbTrd.'.'.$sbTipo;	

	$consulta= "update c_enviada set archivo = '$sbNomFinalArchivo' where radicado = '$nuRadicado'"; 
			
			/*Ejecuci�n de la inserci�n*/
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
			
				if(strlen($sbTrd)>7){$sbAdicionalDestino= $sbTrd."/";}	
				
				//Con este comando guardo el archivo
				$sbDestino = '../../archivos/'.$sbSerie[0].'/'.$sbSubSerie[0].'/'.$sbAdicionalDestino.$sbNomFinalArchivo;
				
				// compruebo si el directorio existe serie
				if(!file_exists('../../archivos/'.$sbSerie[0])){
					mkdir('../../archivos/'.$sbSerie[0], 0775);
				}
				// compruebo si el directorio existe subserie
				if(!file_exists('../../archivos/'.$sbSerie[0].'/'.$sbSubSerie[0])){
					mkdir('../../archivos/'.$sbSerie[0].'/'.$sbSubSerie[0], 0775);
				}
				
				if(strlen($sbTrd)>7){
					if(!file_exists('../../archivos/'.$sbSerie[0].'/'.$sbSubSerie[0].'/'.$sbAdicionalDestino)){
						mkdir('../../archivos/'.$sbSerie[0].'/'.$sbSubSerie[0].'/'.$sbAdicionalDestino, 0775);
					}
				}	
				
				//$sbDestino = '../../archivos/100/100-52/'.$sbNomFinalArchivo;
				copy($_FILES['docArchivo']['tmp_name'],$sbDestino);
		
		 
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
			
			//Funci�n para desconectarse de la base de datos
			desconectarse($link);//cierra la conexion
	
			
	
			}	/*/////////////////////////////	FIN EL ELSE VALIDAR ARCHIVO////////////////*/


	/*Funci�n para desconectarse de la base de datos*/
	desconectarse($link);//cierra la conexion


?>