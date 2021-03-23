
<?php include_once ("../../utils/Utils.php"); ?>
<?php include_once ("../../utils/SessionPhp.php"); ?>
<?php include_once("../../src/conexion.php");
//declaro variable

	
	 //Conexión con el servidor
	 $link=ConectarseServidor();
	 //Conexión con la base de datos
	 ConectarseBaseDatos($link);
	 
	 	 $sessionPerfil = getSession("Perfil");	

	
	 ?>
	 
<?php include("../../includes/top_pageForm.php"); ?>
<?php include("../../includes/headerForm.php"); ?>
<?php include("../../includes/menuForm.php"); ?>
<?php include("../../includes/validarSesion.php"); ?>


		
<?php
 
	//Declaro Variables
	$sbRadicado				=  "";
    $sbRemitente       		=  "";
    $sbDocumento       		=  "";
    $sbTermino       		=  "";
	$sbEntidad_dependencia 	=  "";
	$sbDestinatorio		 	=  "";
	$sbFecha			 	=  "";
	$sbEstado			 	=  "";
	
	$sbFechaActual			=  "";

	
	
  $sql = "SELECT lr.radicado, lr.remitente, doc.descripcion, lr.termino, lr.entidad, lr.destinatario,  lr.fecha, cr.estado_id
			FROM list_recibida lr, documentos doc, c_recibida cr 
			WHERE lr.documento_id = doc.id
			AND	lr.radicado = cr.radicado
			AND (lr.documento_id = 1 OR lr.documento_id = 2 OR lr.documento_id = 5 OR lr.documento_id = 6)
			ORDER BY cr.estado_id DESC, lr.termino ASC 
 			"; 
	 $result=mysqli_query($link,$sql);
			  	 
	 
$sbHtml='
	<script src="../../js/Trazabilidad.js">
</script>
	
	
	 <form action="../../reportes/Usuario/Listado.php" method="post" name="listTrazabilidad" onSubmit= "validarIngreso(this)" enctype="multipart/form-data">
	  <Center><b><h1>TRAZABILIDAD DE DOCUMENTOS </h1></b></Center>
	  <!-- Info General-->  
		<br>
		
				<div id=ConsultaLista>

		<table align ="center">
		
	<!-- //////////////////////////////// INICIO TITULOS/////////////////////////////////////////-->  
		 	<!-- Titulos de la Tabla-->	 
			 <tr align ="center">
			
						  <input name="txtAgrupacionInfoSQL" type="hidden" id="txtAgrupacionInfoSQL" size="20"  value="" ><br>

			<td width="76">
			<input name="txtRadicado" type="text" id="txtRadicado"   style="width :70px;"  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listTrazabilidad";   
			$sbHtml.='); return false">
			</td>
			 	  	  
			<td width="87">
			<input name="txtRemitentes" type="text" id="txtRemitentes" style="width :70px; "  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listTrazabilidad";   
			$sbHtml.='); return false">
			</td>
			
			<td width ="116">
			<input name="txtDocumento" type="text" id="txtDocumento"  style="width :90px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listTrazabilidad";   
			$sbHtml.='); return false">
			</td>
			
			<td width="86">
			<input name="txtTermino" type="text" id="txtTermino"  style="width :70px ; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listTrazabilidad";   
			$sbHtml.='); return false">
			</td> 
			
			<td width ="245">
			<input name="txtEntidad_Dependencia" type="text" id="txtEntidad_Dependencia"  style="width :180px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listTrazabilidad";   
			$sbHtml.='); return false">
			</td>
			
			<td width="105">
			<input name="txtDestinatario" type="text" id="txtDestinatario"  style="width : 95px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listTrazabilidad";   
			$sbHtml.='); return false">
			</td> 
			
			<td width="77">
			<input name="txtFecha" type="text" id="txtFecha"  style="width : 70px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listTrazabilidad";   
			$sbHtml.='); return false">
			</td> 
			
				<td width="">
			</td>
			
					
			
			</tr>
			</table   >

			</div>
			
				<div id=Listado>
			<table   align="center">
			 <tr>
			 
			 	
			
			 <TH width="70">
			  <label>RADICADO</label>
 	  	     </TH>
			 <TH width="80">
			  <label>REMITENTES</label>
 	  	     </TH>
			  <TH width="110">
			  <label>DOCUMENTO</label>
 	  	     </TH>
			  <TH width="80">
			  <label>TERMINO DOC.</label>
 	  	     </TH>
			 <TH width="239">
			  <label>ENTIDAD/DEPENDECIA</label>
 	  	     </TH>
			 <TH width="99">
			  <label>DESTINATARIO</label>
 	  	     </TH>  
			 <TH width="71">
			  <label>FECHA</label>

			 </TH>
			
			 <TH width="70">
			  <label>ESTADO</label>
 	  	     </TH> 

			 <th>
			 <label>VER</label>
 	  	     </TH>
			     </tr>
			 			 
			 <!-- //////////////////////////////// FIN TITULOS/////////////////////////////////////////-->  
			
			
			
			
			';
			
			$sbFechaActualSistema = getFechaActual();
		
			while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
				  
			//Declaro Variables
			$sbEstadoReal 	= "";
			$dtFechaActual 	= "";
			$dtFechaTermino = "";
			$sbTextoDias	= "";
			$diasFaltantes	= "";
			
			
			//Asigno Variables
			$sbRadicado				=  $row[0];
			$sbRemitente       		=  $row[1];
			$sbDocumento       		=  $row[2];
			$sbTermino       		=  $row[3];
			$sbEntidad_dependencia 	=  $row[4];
			$sbDestinatorio		 	=  $row[5];
			$sbFecha			 	=  $row[6];
			$sbEstado			 	=  $row[7];
	
			if($sbEstado == 0){
			
			$sbEstadoReal = "Tramitado";
			$diasFaltantes = 5;
			
			}else{
			//converite a formato dia.-mes-año
			$dtFechaActual = cambiarFormatoFecha($sbFechaActualSistema);
			//$dtFechaTermino = cambiarFormatoFecha($sbTermino);
			$dtFechaTermino = cambiarFormatoFecha($sbFecha);
			
			 //obtiene dias faltantes para vencimiento de queja
			 $diasFaltantes = restaFechas($dtFechaActual,$dtFechaTermino);
			 
			 //valida si es un dia para el texto en singular		
			if ($diasFaltantes ==1){
			  $sbTextoDias = " dia";
			}
			else{
			     $sbTextoDias = " dias";
			}	

			//si faltan menos de 2 dias sale en rojo
			
			 $sbEstadoReal = $diasFaltantes.$sbTextoDias;			   
		   			
		
			}	  
	
			$sqlArchivo = "SELECT cr.archivo
			FROM c_recibida cr
			WHERE cr.radicado = '$sbRadicado'";
			
			$resultArchivo =mysqli_query($link,$sqlArchivo);
			$rowArchivo =mysqli_fetch_array($resultArchivo,MYSQLI_NUM);
			$sbArchivo = $rowArchivo[0]; 
			
			$sbHtml.='<tr align ="center" id = "ejemplo">';
			$sbHtml.='<td>'.$sbRadicado.'</td>';
			$sbHtml.='<td>'.$sbRemitente.'</td>';
			$sbHtml.='<td>'.$sbDocumento.'</td>';
			$sbHtml.='<td>'.$sbTermino.'</td>';
			$sbHtml.='<td>'.$sbEntidad_dependencia.'</td>';
			$sbHtml.='<td bgcolor="#FC484B">'.$sbDestinatorio.'</td>';
			$sbHtml.='<td>'.$sbFecha.'</td>';
			if ($diasFaltantes <= 2 ){
			$sbHtml.='<td id ="Alerta"><b>'.$sbEstadoReal.'</b></td>';
			}else{
			$sbHtml.='<td>'.$sbEstadoReal.'</td>';
			}
			
			$sbHtml.='<td ><a href="Vista.php?id='.$sbRadicado.'"><img src = "../../img/ver.png" ></a></td></tr>';

	    
																
	 }
		         
			  //libera memoria
			  mysqli_free_result ($result);	
			  
			  
	$sbHtml.='
		</table>
	<br>
	</div>
	</form>	</div>
	
	
		
	
';

echo $sbHtml;

?>

<?php include("../../includes/footerForm.php");?>