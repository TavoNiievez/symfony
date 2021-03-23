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
 
	//Declaro Variables
	$sbRadicado				=  "";
    $sbRemitente       		=  "";
	$sbEntidad_dependencia 	=  "";
	$sbDestinatorio		 	=  "";
	$nuFolios    			=  "";
	$sbFecha			 	=  "";
	$sbHora				 	=  "";

	
	
  $sql2 = "SELECT DISTINCT c.fecha
		FROM consecutivos c
		ORDER BY  c.fecha DESC
 			";
  $sql = "SELECT lr.radicado, lr.remitente, lr.entidad, lr.destinatario, lr.folios, lr.fecha, lr.hora
			FROM list_recibida lr
			WHERE YEAR(lr.fecha) = '".@date('Y')."' 
			ORDER BY lr.fecha DESC, lr. radicado DESC
 			"; 
	 $result=mysqli_query($link,$sql);
	 $resultVigencia=mysqli_query($link,$sql2);

	 
$sbHtml='
	<script src="../../js/ListaCRecibida.js">
</script>
	
	
	 <form action="../../reportes/Usuario/Listado.php" method="post" name="listCRecibida" onSubmit= "validarIngreso(this)" enctype="multipart/form-data">
	  <Center><b><h1>LISTADO DE CORRESPONDENCIA RECIBIDA  </h1></b></Center>
	  <!-- Info General-->  
		<br>
		
				<div id=ConsultaLista>
		';
 //////////////////VIGENCIA/////////////
		 $sbHtml.='
		 <label> VIGENCIA CORRESPONDENCIA : </label>
		 <select name="cmbVigencia" id="cmbVigencia" onchange="BuscarLista(';  
			 $sbHtml.="'BusquedaLista.php',listCRecibida";   
			 $sbHtml.='); return false"> 

			 <option VALUE="">Seleccionar</option>';
			
			    while($rowVigencia=mysqli_fetch_array($resultVigencia,MYSQLI_NUM))
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

			<td width="76">
			<input name="txtRadicado" type="text" id="txtRadicado"   style="width :50px;"  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCRecibida";   
			$sbHtml.='); return false">
			</td>
			 	  	  
			<td width="87">
			<input name="txtRemitentes" type="text" id="txtRemitentes" style="width :80px; "  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCRecibida";   
			$sbHtml.='); return false">
			</td>
			
			<td width ="216">
			<input name="txtEntidad_Dependencia" type="text" id="txtEntidad_Dependencia"  style="width :150px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCRecibida";   
			$sbHtml.='); return false">
			</td>
			
			<td width="216">
			<input name="txtDestinatario" type="text" id="txtDestinatario"  style="width :150px ; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCRecibida";   
			$sbHtml.='); return false">
			</td> 
			
			<td width ="56">
			<input name="txtFolios" type="text" id="txtFolios"  style="width :40px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCRecibida";   
			$sbHtml.='); return false">
			</td>
			
			<td width="66">
			<input name="txtFecha" type="text" id="txtFecha"  style="width : 50px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCRecibida";   
			$sbHtml.='); return false">
			</td> 
			
			<td width="66">
			<input name="txtHora" type="text" id="txtHora"  style="width : 50px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listCRecibida";   
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
			 <TH width="210">
			  <label>ENTIDAD/DEPENDECIA</label>
 	  	     </TH>
			 <TH width="210">
			  <label>DESTINATARIO</label>
 	  	     </TH>  
			 </TH>
			 <TH width="50">
			  <label>FOLIOS</label>
 	  	     </TH>
			 <TH width="60">
			  <label>FECHA</label>
 	  	     </TH> 
			 <TH width="60">
			  <label>HORA</label>
 	  	     </TH>
			 <th>
			 <label>VER</label>
 	  	     </TH>
			  <TH width="">
			  <label>DESCARGAR</label>
 	  	     </TH>
  		     </tr>';
		
			while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    { 
			   	  
			//Asigno Variables
			
			
			$sbRadicado				=  $row[0];
			$sbRemitente       		=  $row[1];
			$sbEntidad_dependencia 	=  $row[2];
			$sbDestinatorio		 	=  $row[3];
			$nuFolios    			=  $row[4];
			$sbFecha			 	=  $row[5];
			$sbHora				 	=  $row[6];
	
		
	
			$sqlArchivo = "SELECT cr.archivo,  cr.destinatario_id FROM c_recibida cr WHERE cr.radicado = '$sbRadicado'";
			
			$resultArchivo =mysqli_query($link,$sqlArchivo);
			$rowArchivo =mysqli_fetch_array($resultArchivo,MYSQLI_NUM);
			$sbArchivo = $rowArchivo[0];
			$sbDestinoArch      = $rowArchivo[1];
	
			
			$sbHtml.='<tr align="center" id="ejemplo">';
			$sbHtml.='<td>'.$sbRadicado.'</td>';
			$sbHtml.='<td>'.$sbRemitente.'</td>';
		    $sbHtml.='<td>'.$sbEntidad_dependencia.'</td>';
			$sbHtml.='<td>'.$sbDestinatorio.'</td>';
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
			if($sbArchivo != "" && $sbArchivo!=null){
				$sbHtml.='<td><a target="_blank" href="../../archivos/'.$sbDestinoArch.'/'.$sbArchivo.'"><img src = "../../img/descargar.png" ></a></td></tr>';
			}else{
				$sbHtml.='<td>&nbsp;</td></tr>';
			}
			

	    
																
	 }
		         
			  //libera memoria
			  mysqli_free_result ($result);	
			  
			  
	$sbHtml.='
		</table>
	<br>
	</div>
	</form>	</div>';

//echo html
echo ($sbHtml);

?>

<?php include("../../includes/footerForm.php");?>