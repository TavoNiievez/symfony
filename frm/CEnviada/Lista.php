
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
<?php include("../../includes/subMenuFormCorrespondencia.php"); ?>
<?php include("../../includes/validarSesion.php"); ?>


		
<?php
 
	$dtYear = date('Y');
	//Declaro Variables
	$sbRadicado				=  "";
    $sbRadicadoInicial 		=  "";
	$sbRemitente			=  "";
	$sbCorrespondencia	 	=  "";
	$sbDestinatario		 	=  "";
	$nuFolios    			=  "";
	$sbFecha    			=  "";
	$sbHora	    			=  "";
	$sbArchivo				=  "";
	$sbRutaArchivo 			=  "";
	

	
 
  $sql2 = "SELECT DISTINCT c.fecha
		FROM consecutivos c
		ORDER BY  c.fecha DESC
 			"; 
	$sql = "SELECT le.radicado, le.radicadoinicial, le.remitenteinterno, le.correspondencia, le.destinatario, le.folios, le.fecha, le.hora
		FROM list_enviada le
		WHERE YEAR(le.fecha) = '".@date('Y')."' 
		ORDER BY  le.fecha DESC
 			"; 
	 $result=mysqli_query($link,$sql);
	 $resultVigencia=mysqli_query($link,$sql2);
			  	 
	 
$sbHtml='
	<script src="../../js/ListaCEnviada.js">
</script>
	
	
	 <form action="../../reportes/Usuario/Listado.php" method="post" name="listCEnviada" onSubmit= "validarIngreso(this)" enctype="multipart/form-data">
	  <Center><b><h1>LISTADO DE CORRESPONDENCIA ENVIADA  </h1></b></Center>
	  <!-- Info General-->  
		<br>
		
			
		<div id=ConsultaLista>
		';
 //////////////////VIGENCIA/////////////
		 $sbHtml.='
		 <label> VIGENCIA CORRESPONDENCIA : </label>
		 <select name="cmbVigencia" id="cmbVigencia" onchange="BuscarLista(';  
			 $sbHtml.="'BusquedaLista.php',listCEnviada";   
			 $sbHtml.='); return false"> 

			 <option VALUE="">Seleccionar</option>';
			
			    while($rowVigencia=mysqli_fetch_array($resultVigencia))
			    {
				
				$sbHtml.="<option ";
				 
				/* if($rowVigencia[0]==$dtYear){
				  $sbHtml.="selected";
				  }*/ 
				  $sbHtml.= ($rowVigencia[0]==@date('Y')?'selected="selected"':'');
				  $sbHtml.= " value=$rowVigencia[0]>";
				  $sbHtml.= $rowVigencia[0];
				  $sbHtml.="</option>";
			    }

		$sbHtml.='		
			
		</select>
		<br>
		
<!-- //////////////////////////////// FIN VIGENCIA/////////////////////////////////////////-->  
	
		<table align ="center">
		
	<!-- //////////////////////////////// INICIO TITULOS/////////////////////////////////////////-->  
		 	<!-- Titulos de la Tabla-->	 
			 <tr align ="center">
			
						  <input name="txtAgrupacionInfoSQL" type="hidden" id="txtAgrupacionInfoSQL" size="20"  value="" ><br>

			<td width="73">
			<input name="txtRadicado" type="text" id="txtRadicado"   style="width :70PX;"  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCEnviada";   
			$sbHtml.='); return false">
			</td>
			 	  	  
			<td width="73">
			<input name="txtRadicadoInicial" type="text" id="txtRadicadoInicial" style="width :70PX; "  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCEnviada";   
			$sbHtml.='); return false">
			</td>
			
			<td width ="136">
			<input name="txtRemitente" type="text" id="txtRemitente"  style="width :130PX; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCEnviada";   
			$sbHtml.='); return false">
			</td>
			
			<td width ="103">
			<input name="txtDestinatario" type="text" id="txtDestinatario"  style="width :90PX; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCEnviada";   
			$sbHtml.='); return false">
			</td>
			
			<td width ="182">
			<input name="txtEntidad" type="text" id="txtEntidad"  style="width :150PX; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCEnviada";   
			$sbHtml.='); return false">
			</td>
			
			<td width ="60">
			<input name="txtFolios" type="text" id="txtFolios"  style="width :50PX; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCEnviada";   
			$sbHtml.='); return false">
			</td>
			
			<td width="74">
			<input name="txtFecha" type="text" id="txtFecha"  style="width : 50PX; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCEnviada";   
			$sbHtml.='); return false">
			</td>

			<td width="59">
			<input name="txtHora" type="text" id="txtHora"  style="width : 50PX; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCEnviada";   
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
			 
			 	
			
			 <TH width="67">
			  <label>RADICADO</label>
 	  	     </TH>
			 <TH width="67">
			  <label>R/INICIAL</label>
 	  	     </TH>
			 <TH width="130">
			  <label>REMITENTE</label>
 	  	     </TH>
			 <TH width="97">
			  <label>DESTINATARIO</label>
 	  	     </TH>
			 <TH width="176">
			  <label>ENTIDAD/DEPENDENCIA</label>
 	  	     </TH>
			  <TH width="54">
			  <label>FOLIOS</label>
 	  	     </TH>
			 <TH width="68">
			  <label>FECHA</label>
 	  	     </TH>
			 <TH width="53">
			  <label>HORA</label>
 	  	     </TH>
			 <th>
			 <label>VER</label>
 	  	     </TH>
			  <TH width="">
			  <label>DESCARGAR</label>
 	  	     </TH>
  		     </tr>
			 			 
			 <!-- //////////////////////////////// FIN TITULOS/////////////////////////////////////////-->  
			
			
			
			
			';
		
			while($row=mysqli_fetch_array($result))
			    {
			   	  
			//Asigno Variables
			
			
			$sbRadicado				=  $row[0];
			$sbRadicadoInicial 		=  $row[1];
			$sbRemitente			=  $row[2];
			$sbCorrespondencia	 	=  $row[3];
			$sbDestinatario		 	=  $row[4];
			$nuFolios    			=  $row[5];
			$sbFecha    			=  $row[6];
			$sbHora	    			=  $row[7];
			
			
			$sqlArchivo = "SELECT ce.archivo, ss.trd
			FROM c_enviada ce, subseries ss
			WHERE ce.radicado = '$sbRadicado'
			AND ce.subseries_id = ss.id";
			
			$resultArchivo =mysqli_query($link,$sqlArchivo);
			$rowArchivo =mysqli_fetch_array($resultArchivo,MYSQLI_NUM);
			$sbArchivo 	= $rowArchivo[0]; 
			$sbTrd      = $rowArchivo[1];
			$sbSerie	= explode("-", $sbTrd);
			$sbSubSerie	= explode(".", $sbTrd);
			$sbAdicionalDestino	= "";
						
			$sbHtml.='<tr align ="center" id = "ejemplo">';
			$sbHtml.='<td>'.$sbRadicado.'</td>';
			$sbHtml.='<td>'.$sbRadicadoInicial.'</td>';
			$sbHtml.='<td>'.$sbRemitente.'</td>';
			$sbHtml.='<td>'.$sbCorrespondencia.'</td>';
			$sbHtml.='<td>'.$sbDestinatario.'</td>';
			$sbHtml.='<td>'.$nuFolios.'</td>';
			$sbHtml.='<td>'.$sbFecha.'</td>';
			$sbHtml.='<td>'.$sbHora.'</td>';
			$sbHtml.='<td ><a href="Vista.php?id='.$sbRadicado.'"><img src = "../../img/ver.png" ></a></td>';
			
			/*if($sessionPerfil == "1" || $sessionPerfil == "2" || $sessionPerfil == "11" ){
			
			$sbHtml.='<td><a href="Ingresar.php?id='.$sbRadicado.'"><img src = "../../img/editar.png" ></a></td>';
			}
			else{

			$sbHtml.='<td><img src = "../../img/editar2.png" ></td>';
			}
*/

			if(strlen($sbTrd)>7){$sbAdicionalDestino= $sbTrd."/";}	

			
			if($sbArchivo != ""){$sbRutaArchivo ='../../archivos/'.$sbSerie[0].'/'.$sbSubSerie[0].'/'.$sbAdicionalDestino.$sbArchivo;}

			//$sbHtml.='<td><a href="../../archivos/'.$sbSerie[0].'/'.$sbSubSerie[0].'/'.$sbAdicionalDestino.$sbArchivo.'"><img src = "../../img/descargar.png" ></a></td></tr>';
			if($sbArchivo != "" && $sbArchivo!=null){
				$sbHtml.='<td><a target="_blank" href="'.$sbRutaArchivo.'"><img src = "../../img/descargar.png" ></a></td></tr>';
			}else{
				$sbHtml.='<td>&nbsp;</td></tr>';
			}
	    	//$sbHtml.='<td><a href="'.$sbRutaArchivo.'"><img src = "../../img/descargar.png" ></a></td></tr>';

																
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