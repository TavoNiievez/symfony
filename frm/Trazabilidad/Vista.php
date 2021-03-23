
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
<?php include("../../includes/validarSesion.php"); ?>


		 
 <?php
		 
		 
	//declaro Variables
	
	$id 						=  $_GET['id'];
	$sbRadicado					=  "";
    $sbRemitente       			=  "";
	$sbDestinatorio		 		=  "";
	$sbReponsableDestinatario	=  "";
	$nuFolios    				=  "";
	$sbVigencia    				=  "";
	$sbMedio    				=  "";
	$sbAsunto	    			=  "";
	$sbArchivo    				=  "";
	$nuRemitente_id 			=  "";
	$nuRemitente_ext_int		=  "";
	$nuUsuarioID				=  "";
	$sbFecha					=  "";
	$sbHora						=  "";
	$sbEntidad_dependencia 		=  "";
	$sbNomRemitente		 		=  "";
	$sbNomRepresentante 		=  "";
	$sbCiudad			 		=  "";
	$nuDocumento				=  "";
	$sbDocumento				=  "";
	$sbTermino					=  "";
	
	
	
 
	 //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos Cargo
	 $sql = "SELECT cr.radicado, r.descripcion, d.descripcion, u.nombre, u.apellido1, u.apellido2,  cr.folio, mr.descripcion, cr.asunto, cr.archivo, cr.remitente_id, cr.remitente_ext_int, cr.usuario_id, cr.fecha, cr.hora, cr.documentos_id, cr.f_termino
			FROM c_recibida cr, remitente r, remitentesinternos rti, dependencia d, usuario u, mediorecepcion mr
			WHERE cr.radicado = '$id' 
			AND cr.remitente_id = r.id
			AND cr.destinatario_id = rti.id
			AND rti.dependencia_id = d.id
			AND d.usuario_id = u.id
			AND cr.medio_id = mr.id
			"; 
	 $result=mysqli_query($link,$sql);

	 
	while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
	
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
	$sbFecha					=   $row[13];
	$sbHora						=   $row[14];
	$nuDocumento				=  $row[15];
	$sbTermino					=  $row[16];
	
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
	
			//Obtiene Id y nombre usuario
			$sql2 = "SELECT u.nombre, u.apellido1, apellido2
			FROM usuario u
			WHERE u.id = '$nuUsuarioID'";
  			 			 
			$result2=mysqli_query($link,$sql2);
			$row2=mysqli_fetch_array($result2,MYSQLI_NUM);
	 
			$sbNombreUser   	= $row2[0];
			$sbApellido1User 	= $row2[1];
			$sbApellido2User 	= $row2[2];
		
	if($nuDocumento !=''){

		$sqlDocumt = "SELECT dc.descripcion
			FROM documentos dc
			WHERE dc.id = $nuDocumento
			"; 
			
			$resultDocument =mysqli_query($link,$sqlDocumt);
			$rowInfo=mysqli_fetch_array($resultDocument,MYSQLI_NUM);
			$sbDocumento		 = $rowInfo[0];  
	}
	}
     
     mysqli_free_result ($result);

	 if($sbTermino =='0000-00-00'){ $sbTermino ="Ninguno";}


	 
 $sbHtml ='


 
 <CENTER>
 
										 <H1><b>CORRESPONDENCIA RECIBIDA</b></H1>
	
	<TABLE align="center">							      
	 
   <form name="frmUsuarios" action="Sticker.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">

						<TR>
						<TD>
								


		<table>
			 <tr>
	            <td><b>
	               Radicado</b>
	            </td>
				<td><b>:</b></td>
	            <td>
				'.$sbRadicado .' 
	            </td>
	        </tr>
	        		
	        <tr>
	            <td><b>
	               Correspondencia</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbRemitente.' 
	            </td>	            
	        </tr>
			
			
			<tr>
	            <td><b>
	               '.$sbEntidad_dependencia.'</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbNomRemitente.' 
	            </td>	            
	        </tr>
			<tr>
	            <td><b>
	               Remitente</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbNomRepresentante.' 
	            </td>	            
	        </tr>
			<tr>
	            <td><b>
	               Ciudad</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbCiudad.' 
	            </td>	            
	        </tr>

	        <tr>	            
	            <td><b>
	                Destinatario</b>
                </td>
								<td><b>:</b></td>

	            <td>
	                 '.$sbDestinatorio.' 
	            </td>	            
	     		   </tr>
	        <tr>	
	                <td><b>
	                	Reponsable del Area</b>
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$sbReponsableDestinatario.' 
	                </td>					
	            </tr>
	        	
			<tr>	
	                <td><b>
	                	Documento</b>
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$sbDocumento.' 
	                </td>					
	            </tr>
	        	
			<tr>	
	                <td><b>
	                	Termino Documnt</b>
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$sbTermino.' 
	                </td>					
	            </tr>
	       
			<tr>	
	                <td><b>
	                	Folios</b>
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$nuFolios.' 
	                </td>					
	            </tr>
	        
			<tr>	
	            <td><b>
	            	Medio</b>
	            </td>
					<td><b>:</b></td>
	            <td>
	               '.$sbMedio.' 
	            </td>	            
	        </tr>
					
			<tr>	
	            <td><b>
	            	Operario</b>
	            </td>
					<td><b>:</b></td>
	            <td>
	               '.$sbNombreUser.' '.$sbApellido1User.' '.$sbApellido2User.' 
	            </td>	            
	        </tr>
					
			<tr>	
	            <td><b>
	            	Fecha de Recepcion</b>
	            </td>
					<td><b>:</b></td>
	            <td>
	               '.$sbFecha.'
	            </td>	            
	        </tr>
					
			<tr>	
	            <td><b>
	            	Hora de Recepcion</b>
	            </td>
					<td><b>:</b></td>
	            <td>
	               '.$sbHora.' 
	            </td>	            
	        </tr>
					
			</table>
			
			</TD>
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
			<label>'.$sbAsunto.'</label> 	  	 
 	  	     </td>
			 </tr>
			
	
		
		</table>
		
	</TD></TR>
		
		
		<!-- //////////////////////////////// FIN OBSERVACIONES////////////////////////////////////////-->  
	
	
		</TABLE>

		<br/>
										 <H1><b>CORRESPONDENCIA ENVIADA</b></H1>

	
	';
	
	
	/*//////////////////////////////////////////////////////////////////////////////////////////
									CORRESPONDENCIA ENVIADA
	///////////////////////////////////////////////////////////////////////////////////////////*/
	//declaro Variables
	
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
	 $sql = "SELECT ce.radicado, ce.radicadoinicial, d.descripcion, ce.fecha, ce.subseries_id, ce.folios, md.descripcion, ce.asunto, ce.archivo, ce.usuario_id, ce.fecha, ce.hora, ce.destinatario_id, ce.destinatario_ext_int
		FROM c_enviada ce, dependencia d, remitentesinternos rti, mediorecepcion md, usuario u
		WHERE ce.radicadoinicial =  '$id'
		AND ce.medio_id = md.id
		AND ce.remitente_int = rti.id
		AND rti.dependencia_id = d.id
		
		
		
	"; 
	 $result=mysqli_query($link,$sql);

	if (mysqli_num_rows($result) == 0) { 
	  
	  $sbHtml.='
	<TABLE align="center">
						<TR>
						<TD>
						
						<H2>NO SE HA TRAMITADO LA CORRESPONDENCIA RECIBIDA</H2> 
						
						</TD>
						</TR>
						
	</TABLE>
						 
	 ';
	 }else{
	 
	while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
	
	{
	
	
	$sbRadicado_ce			=  $row[0];
    $nuRadicadoInicial_ce	=  $row[1];
    $sbRemitenteInterno_ce	=  $row[2];
	$dtFecha_ce				=  $row[3];
	$sbTRD_ce	        	=  $row[4];
	$nuFolio_ce 	      	=  $row[5];
	$sbMedio_ce    			=  $row[6];
	$sbAsunto_ce       		=  $row[7];
	$sbArchivo_ce      		=  $row[8];
	$nuUsuarioID_ce			=  $row[9];
	$sbFecha_ce				=  $row[10];
	$sbHora_ce				=  $row[11];
	$sbDestinatario_id		=  $row[12];
	$sbDestinatario_ext_int	=  $row[13];
	
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
	
	
	$sbHtml.='
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
			
		';
			 
	 if($nuRadicadoInicial_ce == "Ninguno"){
	 
	 $sbHtml.='<tr>
	 <td>
	             <b>  Radicado Inicial</b>
	            </td>
				<td><b>:</b></td>
	            <td>
	               Ninguno
	            </td>
				
	        </tr>';
	 }
	 else{
	 
	$sbHtml.='<tr>
	            <td>
	             <b>  Radicado Inicial</b>
	            </td>
				<td><b>:</b></td>
	            <td>
				'.$sbRadicado .' 
	            </td>
	        </tr>
	        ';}		
	       
	$sbHtml.='
	      
	        <tr>
	            <td><b>
	               Remitente </b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbRemitenteInterno_ce.' 
	            </td>	            
	        </tr>
			 <tr>
	            <td>
	               <b>Correspondencia </b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbCorrespondencia_ce.' 
	            </td>	            
	        </tr>
			
			
			<tr>
	            <td>
	              <b> Destinatario</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbDestinatario_ce.' 
	            </td>	            
	        </tr>
			
			<tr>
	            <td>
	               <b>Responsable</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbResponsable_ce.' 
	            </td>	            
	        </tr>
			
			<tr>
	            <td>
	               <b>TRD</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbTRD_ce.' 
	            </td>	            
	        </tr>

	        <tr>	            
	            <td>
	              <b>  Medio</b>
                </td>
								<td><b>:</b></td>

	            <td>
	                 '.$sbMedio_ce.' 
	            </td>	            
	     		   </tr>
	       	
			<tr>	
	                <td>
	                	<b>Folios</b>
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$nuFolio_ce.' 
	                </td>					
	            </tr>
	        <tr>	
	                <td>
	                	<b>Operario</b>
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$sbNombreCompleto.' 
	                </td>					
	            </tr>

				<tr>	
	                <td>
	                	<b>Fecha de Recepcion</b>
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$sbFecha_ce.' 
	                </td>					
	            </tr>  
				
				<tr>	
	                <td>
	                	<b>Hora de Recepcion</b>
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
		
		</TABLE>
		<br/>
		<br/>
	';
	}
echo  $sbHtml;
?>
	
<?php include("../../includes/footerForm.php");?>