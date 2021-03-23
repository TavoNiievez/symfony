
<?php include_once ("../../utils/SessionPhp.php"); ?>
<?php include_once("../../src/conexion.php");
//declaro variable

	
	 //Conexión con el servidor
	 $link=ConectarseServidor();
	 //Conexión con la base de datos
	 ConectarseBaseDatos($link);
	
	 ?>
	 
<?php include("../../includes/top_pageForm.php"); ?>
<?php include("../../includes/headerForm.php"); ?>
<?php include("../../includes/menuForm.php"); ?>
<?php include("../../includes/subMenuFormCorrespondencia.php"); ?>
<?php include("../../includes/validarSesion.php"); ?>


		 
 <?php
		 
		 
	//declaro Variables
	
	$id 					=  $_GET['id'];
	$sbRadicado_ce			=  "";
    $nuRadicadoInicial_ce	=  "";
	$sbRemitenteInterno_ce	=  "";
	$dtFecha_ce				=  "";
	$sbTRD_ce	        	=  "";
	$nuFolio_ce 	      	=  "";
	$sbMedio_ce    			=  "";
	$sbDirigido_ce     		=  "";
	$sbReponsable_ce   		=  "";
	$sbVigencia_ce     		=  "";
	$sbAsunto_ce       		=  "";
	$sbArchivo_ce      		=  "";
	$nuUsuarioID_ce			=  "";
	$sbFecha_ce				=  "";
	$sbHora_ce				=  "";
	$sbNombreCompleto		=  "";
	$sbDestinatario_id		=  "";
	$sbDestinatario_ext_int	=  "";
	
	
 
	 //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos Cargo
	 $sql = "SELECT ce.radicado, ce.radicadoinicial, d.descripcion, ce.fecha, ss.trd, ce.folios, md.descripcion, ce.asunto, ce.archivo, ce.usuario_id, ce.fecha, ce.hora, ce.destinatario_id, ce.destinatario_ext_int, ss.descripcion
	FROM c_enviada ce, dependencia d, remitentesinternos rti, mediorecepcion md, usuario u, subseries ss
	WHERE ce.radicado =  '$id'
	AND ce.medio_id = md.id
	AND ce.subseries_id = ss.id
	AND ce.remitente_int = rti.id
	AND rti.dependencia_id = d.id
		
		
	"; 
	 $result=mysqli_query($link,$sql);

	 
	while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
	
	{
	
	
	$sbRadicado_ce			=  $row[0];
    $nuRadicadoInicial_ce	=  $row[1];
    $sbRemitenteInterno_ce	=  $row[2];
	$dtFecha_ce				=  $row[3];
	$sbTRD_ce	        	=  $row[4]." ".$row[14];
	$nuFolio_ce 	      	=  $row[5];
	$sbMedio_ce    			=  $row[6];
	$sbAsunto_ce       		=  $row[7];
	$sbArchivo_ce      		=  $row[8];
	$nuUsuarioID_ce			=  $row[9];
	$sbFecha_ce				=  $row[10];
	$sbHora_ce				=  $row[11];
	$sbDestinatario_id		=  $row[12];
	$sbDestinatario_ext_int	=  $row[13];
	$sbTRD_Archivo        	=  $row[4];
	
	if($sbDestinatario_id == 1){
			
			$sqlExtInt = "SELECT rte.nombre, rte.representante
			FROM remitentesexternos rte
			WHERE rte.id = $sbDestinatario_ext_int
			"; 
			
			$resultInformacion =mysqli_query($link,$sqlExtInt);
			$rowInfo=mysqli_fetch_array($resultInformacion,MYSQLI_NUM);
			$sbCorrespondencia_ce 		= "EXTERNO";  
			$sbDestinatario_ce	 		= $rowInfo[0];  
			$sbResponsable_ce	 		= $rowInfo[1];  
			
			}
			
			if($sbDestinatario_id == 2){
			$sqlExtInt = "SELECT d.descripcion, u.nombre, u.apellido1, u.apellido2
			FROM remitentesinternos rti, dependencia d, usuario u
			WHERE rti.id = $sbDestinatario_ext_int
			AND rti.dependencia_id = d.id
			AND rti.dependencia_id = d.id
			AND d.usuario_id = u.id
			"; 
			$resultInformacion =mysqli_query($link,$sqlExtInt);
			$rowInfo=mysqli_fetch_array($resultInformacion,MYSQLI_NUM);
			$sbCorrespondencia_ce 		= "INTERNO";  
			$sbDestinatario_ce	 		= $rowInfo[0];  
			$sbResponsable_ce	 		= $rowInfo[1].' '.$rowInfo[2].' '.$rowInfo[3];  
			
			}

	
			//Obtiene Id y nombre usuario
			$sql2 = "SELECT u.nombre, u.apellido1, apellido2
			FROM usuario u
			WHERE u.id = '$nuUsuarioID_ce'";
  			 			 
			$result2=mysqli_query($link,$sql2);
			$row2=mysqli_fetch_array($result2,MYSQLI_NUM);
	 
			$sbNombreUser   	= $row2[0];
			$sbApellido1User 	= $row2[1];
			$sbApellido2User 	= $row2[2];
		
	$sbNombreCompleto = $sbNombreUser.' '.$sbApellido1User.' '.$sbApellido2User;
	
	}
     
     mysqli_free_result ($result);


	 
	 if($nuRadicadoInicial_ce != "Ninguno"){
	/*////////////////////////////////////////////////////////
			FIN INFORMACION DE RADICACION INICIAL
	 /////////////////////////////////////////////////////////*/
	 
	 	 //realiza consulta a la base de datos
	 $sqlRadicadoInicial = "SELECT cr.radicado, r.descripcion, d.descripcion, u.nombre, u.apellido1, u.apellido2,  cr.folio,  mr.descripcion, cr.asunto, cr.archivo, cr.remitente_id, cr.remitente_ext_int, cr.usuario_id
			FROM c_recibida cr, remitente r, remitentesinternos rti, dependencia d, usuario u, mediorecepcion mr
			WHERE cr.radicado = '$nuRadicadoInicial_ce' 
			AND cr.remitente_id = r.id
			AND cr.destinatario_id = rti.id
			AND rti.dependencia_id = d.id
			AND d.usuario_id = u.id
			AND cr.medio_id = mr.id
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
	
	
	if($nuRemitente_id == 1){
			
			$sqlExtInt = "SELECT rte.nombre, rte.representante, rte.ciudad
			FROM remitentesexternos rte
			WHERE rte.id = $nuRemitente_ext_int
			"; 
			
			$resultInformacion =mysqli_query($link,$sqlExtInt);
			$rowInfo=mysqli_fetch_array($resultInformacion,MYSQLI_NUM);
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
			$rowInfo=mysqli_fetch_array($resultInformacion,MYSQLI_NUM);
			$sbEntidad_dependencia 		= "Dependencia";  
			$sbNomRemitente		 		= $rowInfo[0];  
			$sbNomRepresentante 		= $rowInfo[1].' '.$rowInfo[2].' '.$rowInfo[3];  
			$sbCiudad			 		= "GINEBRA - VALLE";
			}
	
			
		
	
	}
     
     mysqli_free_result ($resultRadicadoInicial);
	 
	 }
	
	 /*////////////////////////////////////////////////////////
			FIN INFORMACION DE RADICACION INICIAL
	 /////////////////////////////////////////////////////////*/

	 
 $sbHtml ='


 
 <CENTER>
 
										 <H1><b>CORRESPONDENCIA ENVIADA</b></H1>
									      
	 
   <form name="frmUsuarios" action="Sticker.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">

					<TABLE align="center">
						<TR>
						<TD>
								


		<table>
			 <tr>
	            <td><b>
	               Radicado</b>
	            </td>
				<td><b>:</b></td>
	            <td>
				'.$sbRadicado_ce .' 
	            </td>
	        </tr>
			
		</table>
		
		</TD>
		</TR>
		
		<TR>
		<TD>
		<!-- /*////////////////////////////////////////////////////////
			INICIO INFORMACION DE RADICACION INICIAL
	 /////////////////////////////////////////////////////////*/ -->
	
	<br>		
		<B>	Informacion Radicado Inicial	</B>
		<br><br>
		
	<table>';
			 
	 if($nuRadicadoInicial_ce == "Ninguno"){
	 
	 $sbHtml.='<tr>
	            <td>
	               Ninguno
	            </td>
				
	        </tr>';
	 }
	 else{
	 
	$sbHtml.='<tr>
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
	        </tr>';}
			
			$sbHtml.='
			</table>
	
	
	<!-- /*////////////////////////////////////////////////////////
			FIN INFORMACION DE RADICACION INICIAL
	 /////////////////////////////////////////////////////////*/ -->
	
	      </TD></TR>  	

		  	<TR><TD>
		<br>		
		<B>		Informacion General		</B>
		<br><br>
		</TD></TR>
		
		<TR><TD>	
		<table>		
	        <tr>
	            <td>
	               Remitente 
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbRemitenteInterno_ce.' 
	            </td>	            
	        </tr>
			 <tr>
	            <td>
	               Correspondencia 
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbCorrespondencia_ce.' 
	            </td>	            
	        </tr>
			
			
			<tr>
	            <td>
	               Destinatario
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbDestinatario_ce.' 
	            </td>	            
	        </tr>
			
			<tr>
	            <td>
	               Responsable
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbResponsable_ce.' 
	            </td>	            
	        </tr>
			
			<tr>
	            <td>
	               TRD
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbTRD_ce.' 
	            </td>	            
	        </tr>

	        <tr>	            
	            <td>
	                Medio
                </td>
								<td><b>:</b></td>

	            <td>
	                 '.$sbMedio_ce.' 
	            </td>	            
	     		   </tr>
	       	
			<tr>	
	                <td>
	                	Folios
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$nuFolio_ce.' 
	                </td>					
	            </tr>
	        <tr>	
	                <td>
	                	Operario
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$sbNombreCompleto.' 
	                </td>					
	            </tr>

				<tr>	
	                <td>
	                	Fecha de Recepcion
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$sbFecha_ce.' 
	                </td>					
	            </tr>  
				
				<tr>	
	                <td>
	                	Hora de Recepcion
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$sbHora_ce.' 
	                </td>					
	            </tr>
	        
			</table>
			
			</TD></TR>
	<!-- //////////////////////////////// FIN PINICIO PERSONA RESPONSABLE DEL MEMORANDO/////////////////////////////////////////-->  
	
	
	<TR><TD>
		<br>		
		<B>		Asunto del Documento 	</B>
		
		</TD></TR>
		
		<!-- //////////////////////////////// INCIO OBSERVACIONES/////////////////////////////////////////-->  
		
		<TR><TD>
	
		 
			<table border ="0" align="left">
		
		 
  		     <tr>
  		     <td WIDTH="700" >
			<label>'.$sbAsunto_ce.'</label> 	  	 
 	  	     </td>
			 </tr>
					
		</table>
		
	</TD></TR>
		
	<!-- //////////////////////////////// FIN OBSERVACIONES////////////////////////////////////////-->  
		 <TR><TD>
		 	 <input name="txtRadicado" type="hidden" id="txtRadicado"  value="'.$sbRadicado_ce.'" ><br>
		  
  				
		<input type="submit" name="btnIngresar" value="Imprimir Sticker">	
  				
	</center>	
			</TD></TR>	
	</form>
	
	
	 <form name="frmUsuarios" action="ActualizarArchivoCorrespondenciaEnviada.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">
		
	<input name="txtRadicado" type="hidden" id="txtRadicado"  value="'.$sbRadicado_ce.'" ><br>
	<input name="txtTRD" type="hidden" id="txtTRD"  value="'.$sbTRD_Archivo.'" ><br>

		<TR><TD>
		<br>		
		<B>		Adjuntar el Documento		</B>
		<br><br>
		</TD></TR>
	
	<!-- //////////////////////////////// INCIO DE SUBIR ARCHIVO/////////////////////////////////////////-->  
	
	<TR><TD>
				
		<table border ="0" align="left">
			<tr>
			<td>
			  <label>Archivo</label>
 	  	     </td>
  		     <td><b>:</b> </td>
  		     <td>
			  <input name="docArchivo" type="file" id="docArchivo"  ><br>
 	  	     </td>
			 <td>
			  <input type="submit" name="btnIngresar" value="Guardar Archivo">	

			 </td>
			</tr>
		</table>

	</TD></TR>
	
	</form>
	
		</TABLE>


	<!-- //////////////////////////////// FIN DE SUBIR ARCHIVO/////////////////////////////////////////-->  
	
	';
echo  $sbHtml;
?>
	
<?php include("../../includes/footerForm.php");?>