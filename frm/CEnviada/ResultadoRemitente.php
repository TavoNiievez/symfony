<?php //Código para incluir las librerias
	 include_once("../../src/conexion.php");
	 //Conexión con el servidor
	 $link=ConectarseServidor();

	 //Conexión con la base de datosrecepcion
	 ConectarseBaseDatos($link);
 ?>	
 
<?php


 
	//Declaro Variables
	$nuRadicadoInicial 		= $_POST ['cmbRadicadoInicial'];
	
	
	$sbCodigo				=  "";
    $sbNombre        		=  "";
	$sbRepresentate        	=  "";
	$sbCiudad    			=  "";
	
	
	
	if($nuRadicadoInicial !=''){
	 
	 	 //realiza consulta a la base de datos
	 $sqlRadicadoInicial = "SELECT cr.radicado, r.descripcion, d.descripcion, u.nombre, u.apellido1, u.apellido2,  cr.folio,  mr.descripcion, cr.asunto, cr.archivo, cr.remitente_id, cr.remitente_ext_int, cr.usuario_id, doc.descripcion
			FROM c_recibida cr, remitente r, remitentesinternos rti, dependencia d, usuario u, mediorecepcion mr, documentos doc
			WHERE cr.radicado = '$nuRadicadoInicial' 
			AND cr.remitente_id = r.id
			AND cr.destinatario_id = rti.id
			AND rti.dependencia_id = d.id
			AND d.usuario_id = u.id
			AND cr.medio_id = mr.id
			AND cr.documentos_id = doc.id
			";

				 
	 $resultRadicadoInicial=mysqli_query($link,$sqlRadicadoInicial);
	
	
	 	while ($row = mysqli_fetch_array($resultRadicadoInicial,MYSQLI_NUM))
	
	{
	
    $sbRadicado					=   $row[0];
    $sbRemitente       			=   $row[1];
	$sbDestinatorio		 		=   $row[2];
	$sbReponsableDestinatario	=   $row[3].' '.$row[4].' '.$row[5];
	$nuFolios    				=   $row[6];
	$sbMedio    				=   $row[7];
	$sbAsunto    				=   $row[8];
	$sbArchivo    				=   $row[9];
	$nuRemitente_id 			=   $row[10];
	$nuRemitente_ext_int		=   $row[11];
	$nuUsuarioID				=   $row[12];
	$sbDocumento				=   $row[13];
	
	
	if($nuRemitente_id == 1){
			
			$sqlExtInt = "SELECT rte.nombre, rte.representante, rte.ciudad
			FROM remitentesexternos rte
			WHERE rte.id = $nuRemitente_ext_int
			"; 
			
			$resultInformacion =mysqli_query($link,$sqlExtInt);
			$rowInfo=mysqli_fetch_array($resultInformacion);
			$sbEntidad_dependencia 		= "Entidad";  
			$sbNomRemitente		 		= $rowInfo[0];  
			$sbNomRepresentante 		= $rowInfo[1]; 
			$sbCiudad			 		= $rowInfo[2]; 
			}
			
			if($nuRemitente_id == 2){
			$sqlExtInt = "SELECT d.descripcion, u.nombre, u.apellido1, u.apellido2
			FROM remitentesinternos rti, dependencia d, usuario u
			WHERE rti.id = $nuRemitente_ext_int
			AND rti.dependencia_id = d.id
			AND d.usuario_id = u.id
			"; 
			$resultInformacion =mysqli_query($link,$sqlExtInt);
			$rowInfo=mysqli_fetch_array($resultInformacion);
			$sbEntidad_dependencia 		= "Dependencia";  
			$sbNomRemitente		 		= $rowInfo[0];  
			$sbNomRepresentante 		= $rowInfo[1].' '.$rowInfo[2].' '.$rowInfo[3];  
			$sbCiudad			 		= "GINEBRA - VALLE";
			}
	
			//Obtiene Id y nombre usuario
			$sql2 = "SELECT u.nombre, u.apellido1, apellido2
			FROM usuario u
			WHERE u.id = '$nuUsuarioID'";
  			 			 
			$result2=mysqli_query($link,$sql2);
			$row2=mysqli_fetch_array($result2,MYSQLI_NUM);
	 
			$sbNombreUser   	= $row2[0];
			$sbApellido1User 	= $row2[1];
			$sbApellido2User 	= $row2[2];
		
	
	}
     
     mysqli_free_result ($resultRadicadoInicial);
	
	 /*////////////////////////////////////////////////////////
			INICIO INFORMACION DE RADICACION INICIAL
	 /////////////////////////////////////////////////////////*/
	
	$sbHtml ='
	<br>		
		<B>	Informacion Radicado Inicial	</B>
		<br><br>
		
	<table>
			 <tr>
	            <td>
	               Radicado
	            </td>
				<td><b>:</b></td>
	            <td>
				'.$sbRadicado .' 
	            </td>
	        </tr>
	        		
	        <tr>
	            <td>
	               Correspondencia
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbRemitente.' 
	            </td>	            
	        </tr>
			
			
			<tr>
	            <td>
	               '.$sbEntidad_dependencia.'
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbNomRemitente.' 
	            </td>	            
	        </tr>
			<tr>
	            <td>
	               Remitente
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbNomRepresentante.' 
	            </td>	            
	        </tr>
			<tr>
	            <td>
	               Ciudad
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbCiudad.' 
	            </td>	            
	        </tr>
			<tr>
	            <td>
	               Documento
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbDocumento.' 
	            </td>	            
	        </tr>
			
			</table>';
	
	
	 /*////////////////////////////////////////////////////////
			FIN INFORMACION DE RADICACION INICIAL
	 /////////////////////////////////////////////////////////*/
	
	 
echo $sbHtml;}

?>
	