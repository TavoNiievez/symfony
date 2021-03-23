<?php include_once ("../utils/Date.php"); ?>
<?php include_once ("../utils/SessionPhp.php"); ?>
<?php

	//HAY QUE ORGANIZAR EL CODIGO QUE TIENE MUCHA REBUNDANCIA

	/*Código para incluir las librerias*/
	include_once("conexion.php");
	
	
	//Recupero Variable para modificar
	$nuModificar	=  $_REQUEST["txtModificar"];


	/*Recuperación de variables*/
    $nuRadicado        		=  $_REQUEST["txtRadicado"];	
	$nuRemitente        	=  $_REQUEST["cmbRemitente"];	
	$nuDestinatario			=  $_REQUEST["cmbDestinatario"];	
	$nuMedios        		=  $_REQUEST["cmbMedios"];	
	$nuFolios        		=  $_REQUEST["txtFolios"];	
	$sbAsunto       		=  $_REQUEST["txtAsunto"];
	$nuDocumento       		=  $_REQUEST["cmbDocumento"];
	$dtTermino       		=  $_REQUEST["dtTermino"];
	$nuEstado_id			=  1;	
	$dtFecha				=  getFechaActual();
	$dtTime					=  getHoraActual (); 
	$sbArchivo				=  "";	
	
	if($nuRemitente == 1){
	
		$nuDependencia_Entidad	=  $_REQUEST["combobox"];	

	}
	if($nuRemitente == 2){
	
		$nuDependencia_Entidad	=  $_REQUEST["cmbDependencia"];	

	}
	
	
	/*Conexión con el servidor*/
	$link=ConectarseServidor();

	/*Conexión con la base de datos*/
	ConectarseBaseDatos($link);
	
	//DATOS DEL OPERARIO
	 //saca variable Login de la sesion
     $sessionLogin = getSession("Login");
	 
	 	 //----------------------------------------------------------------------------
	 //Obtiene Id y nombre usuario
	 $sql2 = "SELECT u.id
			FROM usuario u
			WHERE u.login =  '$sessionLogin'";
  			 			 
	$result2=mysqli_query($link,$sql2);
	$row2=mysqli_fetch_array($result2,MYSQLI_NUM);
	 
	$nuIdUser  = $row2[0];

	
	
	//////////////////Para ingresar al consecutivo///////////////////////////////
	list($prefijo, $consecutivo) = explode("-", $nuRadicado);
				
	//para sacar el anyo
	$date=date("Y");
	$date=substr($date, 0 , -2);
	$year = substr($consecutivo, 0 ,4);
	$consecutivo = (int)substr($consecutivo, 4);
	//$year=$date.$year;
		 
		 	
	//llama al consecutivo de la BD y le ingreso a la variable $Consecutivo_BD
	$consultaConsecutivo = "select * from consecutivos where fecha= '$year' and prefijo = '$prefijo'"; 
		 
	//ejecuto el sql
	$resultConsecutivo_BD=mysqli_query($link,$consultaConsecutivo);
	
	while($rowConsecutivo=mysqli_fetch_array($resultConsecutivo_BD,MYSQLI_ASSOC))
	{		  
		if($rowConsecutivo["consecutivo"] >= $consecutivo){		
			//Elimino Las Tuplas Donde esta la informacion para ingresar de nuevo
			//de decision y expediente para poder actualizar
		}else{
			//-------------------------------------------------------
		
			 //Esto es para que si me inserte el consecuitivo			
			$nuInsertaConsecutivo= 1;
	 
			 
		}
	}
	mysqli_free_result ($resultConsecutivo_BD);
	//////////////////////////////////////////////////////////////			
	//////////////////////////////////////////INCIO SI MODIFICO EL REGISTRO//////////////////////////////////////////////////////////////
	if($nuModificar==1){
		$modificar="delete from   c_recibida where radicado= '$nuRadicado'; ";	
		consultas($modificar);
		$consulta="insert into c_recibida values('$nuRadicado', $nuRemitente, $nuDependencia_Entidad, $nuDestinatario, $nuMedios, $nuFolios, '$sbAsunto', '$sbArchivo',$nuEstado_id, $nuIdUser, '$dtFecha', '$dtTime', $nuDocumento, '$dtTermino')";
	}	
	//////////////////////////////////////////FIN SI MODIFICO EL REGISTRO//////////////////////////////////////////////////////////////
	else{
		$consulta="insert into c_recibida values('$nuRadicado', $nuRemitente, $nuDependencia_Entidad, $nuDestinatario, $nuMedios, $nuFolios, '$sbAsunto', '$sbArchivo',$nuEstado_id, $nuIdUser, '$dtFecha', '$dtTime', $nuDocumento, '$dtTermino')";
	}
			
	//echo $consulta;exit;
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
					$sbCadena .= "alert(  'la Correspondencia Recibida Se ha Registrado Correctamente ' )";
					$sbCadena .= "</script>";
					echo $sbCadena;	
					
					if($nuInsertaConsecutivo == 1){
			
				$InsertarConsecutivo= "update consecutivos set consecutivo = $consecutivo where fecha = '$year' and prefijo = '$prefijo' "; 
				$respuesta3=consultas($InsertarConsecutivo);
				} 
				
				
				//////////////////////////////INGRESAR INFORMACION A LA LISTA////////////////////////////
				
				if($nuRemitente == 1){
				$sqlExtInt = "SELECT rte.nombre
				FROM remitentesexternos rte
				WHERE rte.id = $nuDependencia_Entidad
				"; 
				}
				
				if($nuRemitente == 2){
				$sqlExtInt = "SELECT d.descripcion
				FROM remitentesinternos rti, dependencia d
				WHERE rti.id = $nuDependencia_Entidad
				AND rti.dependencia_id = d.id
				"; 
				}
		
				$resultInformacion =mysqli_query($link,$sqlExtInt);
				$rowInfo=mysqli_fetch_array($resultInformacion,MYSQLI_NUM);
				$sbEntidad_dependencia = $rowInfo[0];  
				
				
				$sqlDestinatario = "SELECT d.descripcion
				FROM remitentesinternos rti, dependencia d
				WHERE rti.id = $nuDestinatario
				AND rti.dependencia_id = d.id";
				
				$resultInformacionDestinatario =mysqli_query($link,$sqlDestinatario);
				$rowDestinatario =mysqli_fetch_array($resultInformacionDestinatario,MYSQLI_NUM);
				$sbNomDestinatario = $rowDestinatario[0];  
				
				$sqlRemitente = "SELECT r.descripcion
				FROM remitente r
				WHERE r.id = $nuRemitente";
				
				$resultRemitente =mysqli_query($link,$sqlRemitente);
				$rowRemitente =mysqli_fetch_array($resultRemitente,MYSQLI_NUM);
				$sbNomRemitente = $rowRemitente[0];  
				
				$sqlLista = "insert into list_recibida values ('$nuRadicado', '$sbNomRemitente', '$sbEntidad_dependencia', '$sbNomDestinatario', $nuFolios, '$dtFecha', '$dtTime', $nuDocumento, '$dtTermino')";
				mysqli_query($link,$sqlLista);

				//////////////////////////////FIN  INFORMACION A LA LISTA////////////////////////////

			
				//retorna a la pagina anterior
				Header("Location:../frm/CRecibida/Vista.php?id=$nuRadicado");
				
			}
			else
			{	
				$sbCadena =  "<script language='javascript'>";
				$sbCadena .= "alert(  'Error al Registrar la Correspondencia Recibida , Verifique los Datos' )";
				$sbCadena .= "</script>";
				echo $sbCadena;
		 
				//retorna a la pagina anterior
				$sbCadena = '<script>window.history.back();</script>';
				echo $sbCadena;  	    
			}
			
	//Función para desconectarse de la base de datos
	desconectarse($link);
	//cierra la conexion
?>