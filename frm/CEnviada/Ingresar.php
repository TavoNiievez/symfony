
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
	$sbRadicado				=  "";
    $sbRadicadoInicial 		=  "";
	$dtFecha				=  "";
	$nuTRD		        	=  "";
	$nuFolio  		      	=  "";
	$nuMedio    			=  "";
	$nuDirigido       		=  "";
	$sbVigencia        		=  "";
	$sbAsunto        		=  "";
	$sbArchivo        		=  "";

	$nuModificar		= 0;
	 
	  //realiza consulta a la base de datos
	 $sqlExterno = "SELECT rte.id, rte.nombre FROM remitentesexternos rte"; 
	 	 $resultExterno=mysqli_query($link,$sqlExterno);
	  
	 //realiza consulta a la base de datos
	 $sqlInterno = "SELECT rti.id, d.descripcion 
			FROM remitentesinternos rti, dependencia d 
			Where rti.dependencia_id = d.id	";
	$resultInterno=mysqli_query($link,$sqlInterno);

	  //realiza consulta a la base de datos
	 $sqlCRecibida = "SELECT cr.radicado FROM c_recibida cr 
	 WHERE cr.estado_id = 1
	 AND (cr.documentos_id = 1 OR cr.documentos_id = 2 OR cr.documentos_id = 5 OR cr.documentos_id = 6)"; 

	 	 //realiza consulta a la base de datos
	$sqlMedios = "SELECT ev.id, ev.descripcion from mediorecepcion ev";	 
		 $resultMedios=mysqli_query($link,$sqlMedios);

	 	 //realiza consulta a la base de datos
	 $sqlInternoRemitente = "SELECT rti.id, d.descripcion
			FROM remitentesinternos rti, dependencia d 
			Where rti.dependencia_id = d.id
			";
	 $resultRemitenteInterno =mysqli_query($link,$sqlInternoRemitente);

	 
	 //consulta informacion al trd
	 $sqlSubserie = "select s.id, s.trd, s.descripcion from  subseries s where estado_id = 1";
	 $resultSubserie =mysqli_query($link,$sqlSubserie);
	 
	 //consulta informacion al remitente
	 $sqlRemitente = "select * from  remitente";
	 $resultRemitente=mysqli_query($link,$sqlRemitente);
	 	  
	 	  
	 
	/*////////////////////////////////////////////////////////
				INICIO	CONSECUTIVOS
	/////////////////////////////////////////////////////////*/

	 $sqlConsecutivo = "select * from  consecutivos";
	 $resultConsecutivo=mysqli_query($link,$sqlConsecutivo);
	 	  
	 
	  //llamo el el consecutivo 
	 $sbYear =date("Y");
	 $Date = date("Y");
	 $nuDate=(int)$Date;
	 $nuConsecutivo=0;
	 $sbConsecutivo="";
	
	while($row=mysqli_fetch_array($resultConsecutivo))
	{ 
		$nufecha=(int)$row[1];
		if ($nuDate > $nufecha  && $row[0]=="CE"){
			$sqlConsecutivo = "insert into consecutivos values ('CE','$nuDate',0) ";
			$InsertarConsecutivo=mysqli_query($link,$sqlConsecutivo);
			//$sbYear=substr($sbYear, -2);
	  }  else{ 
			if($Date==$row[1] && $row[0]=="CE" ){
				//$sbYear=substr($sbYear, -2);
				$nuConsecutivo=$row[2]+1;
			}
		}
	}
	//libera memoria
	mysqli_free_result ($resultConsecutivo);
	//$sbConsecutivo= (string) $nuConsecutivo;
	$sbConsecutivo = str_pad($nuConsecutivo, 5, "0", STR_PAD_LEFT);
	/*if(strlen($nuConsecutivo)==1){
		$sbConsecutivo="00".$nuConsecutivo;
	}
 
	if(strlen($nuConsecutivo)==2){
		$sbConsecutivo="0".$nuConsecutivo;
	}
	if(strlen($nuConsecutivo)>=3){
		$sbConsecutivo="".$nuConsecutivo;
	}*/
	$sbConsecutivoFinal = "CE-".$sbYear.$sbConsecutivo;
	
	/*////////////////////////////////////////////////////////
				FIN	CONSECUTIVOS
	/////////////////////////////////////////////////////////*/

	 
	 /*////////////////////////////////////////////////////////
			INCIO INFORMACION PARA MODIFICAR
	 /////////////////////////////////////////////////////////*/
	 	
	 if($id != 'No'){
	 
	 
	 	 //realiza consulta a la base de datos
	 $sql = "SELECT ce.radicado, ce.radicadoinicial, ce.fecha, ce.subseries_id, ce.folios, ce.medio_id, ce.dirigido, ce.vigencia, ce.asunto
			FROM c_enviada ce
			WHERE ce.radicado =  '$id'
			"; 
	 $result=mysqli_query($link,$sql);
	 

  while($row=mysqli_fetch_array($result))
			    {
			   	  
	//Asigno Variables

	$sbRadicado				=  $row[0];	
    $sbRadicadoInicial 		=  $row[1];	
	$dtFecha				=  $row[2];	
	$nuTRD		        	=  $row[3];	
	$nuFolio  		      	=  $row[4];	
	$nuMedio    			=  $row[5];	
	$nuDirigido       		=  $row[6];	
	$sbVigencia        		=  $row[7];	
	$sbAsunto        		=  $row[8];	
	
	
	 }
		         
	 //libera memoria
	mysqli_free_result ($result);	
	
	$sbConsecutivoFinal = $sbRadicado;
	
	$nuModificar=1;
	
	 $sqlCRecibida = "SELECT cr.radicado FROM c_recibida cr "; 

		 	 
	 }//finalizo el if para modificar
	 
	 $resultCRecibida=mysqli_query($link,$sqlCRecibida);

	 /*////////////////////////////////////////////////////////
			INCIO INFORMACION PARA MODIFICAR
	 /////////////////////////////////////////////////////////*/
	 	
		
		

 $sbHtml ='
<CENTER>
  <H1><b>CORRESPONDENCIA ENVIADA </b></H1>
  
	<link type= "text/css" rel="stylesheet" href="../../css/jquery-ui-1.9.2.custom.css" />
 
 <script src="../../js/CEnviada.js">
</script>
	
										

	 
   <form name="frmCorrepondenciaEnviada" action="../../src/IngresarCorrespondenciaEnviada.php" method ="post"  onSubmit="return validarIngreso(this)"  enctype="multipart/form-data">

					<TABLE align="center">
						<TR>
						<TD>
								


		<table>
		
	                <input name="txtRadicado" id ="txtRadicado" type="hidden" value="'.$sbConsecutivoFinal.'">
	         
			  <tr>
	            <td>
	               Radicado
	            </td>
				<td><b>:</b></td>

	            <td>
	                '.$sbConsecutivoFinal.'
	            </td>
				
				</tr>
				
			    <tr>
		     <td>
			  <label>Radicado Inicial</label>
 	  	     </td>	 <td><b>:</b> </td> 
  	          <td>
					<!--  AQUI SE LLENA EL SELECT CON remitente-->
		';		
   			 // ------------------------------------------------------------
	 	    			
			  $sbHtml.= "<select name='cmbRadicadoInicial' id='cmbRadicadoInicial' onchange='BuscarRemitente(";  
			 $sbHtml.='"ResultadoRemitente.php"';   
			 $sbHtml.="); return false'> 

			 <option VALUE=''>Seleccionar</option>";
			 
			    while($rowCRecibida=mysqli_fetch_array($resultCRecibida))
			    {
					$sbHtml.="<option ";
					if($rowCRecibida[0]==$sbRadicadoInicial){
						$sbHtml.="selected";
					} 
					$sbHtml.= " value=$rowCRecibida[0]>";
					$sbHtml.= $rowCRecibida[0];
					$sbHtml.="</option>";
			    }
		    // ------------------------------------------------------------	
			
$sbHtml.='
		</td>	
		
	        </tr>
			</table>
			</TD></TR>
			
			<TR><TD>
			<div id=ResultadoRemitente>';
			
			if($nuModificar == 1){	
		
		$sbHtml.='
		<br>		
		<B>	Informacion Radicado Inicial	</B>
		<br><br>';
	
					
				}
	
			$sbHtml.='	
			
			
			
			</div>
				</TD></TR>
				
		
		
		
		
		<!-- //////////////////////////////// FIN OBSERVACIONES////////////////////////////////////////-->  
			
		
	<TR><TD>
		<br>		
		<B>		Informacion General		</B>
		<br><br>
		</TD></TR>
	
	<!-- //////////////////////////////// INCIO DE SUBIR ARCHIVO/////////////////////////////////////////-->  
	
	<TR><TD>
				
			<table>
			<tr>	            
	            <td>
	                Remitente
                </td>
								<td><b>:</b></td>

	            <td>';
				
				
	              $sbHtml.="<select name='cmbRemitenteInterno' id='cmbRemitenteInterno'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowRemitenteInterno=mysqli_fetch_array($resultRemitenteInterno))
			    {
				
			   	  $sbHtml.="<option ";
				 
				 
				/* if($rowRemitenteInterno[0]==$nuDestinatario){
				  $sbHtml.="selected";
				  } 
				 */
					  
				  $sbHtml.= " value=$rowRemitenteInterno[0]>";
				  $sbHtml.= $rowRemitenteInterno[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultRemitenteInterno);
	
	
	         $sbHtml.='  </td>	            
	     		
				
				
				</tr>
				
				
							
			     <tr>
		     <td>
			  <label>Correspondencia</label>
 	  	     </td>	 <td><b>:</b> </td> 
  	          <td>
					<!--  AQUI SE LLENA EL SELECT CON remitente-->
		';		
   			 // ------------------------------------------------------------
	 	    			
			  $sbHtml.= "<select name='cmbDestinatario' id='cmbDestinatario' onchange = 'cambiar.ejecutar()' >

			 <option VALUE=0>Seleccionar</option>";
			 
			    while($rowRemitente=mysqli_fetch_array($resultRemitente))
			    {
				
				$sbHtml.="<option ";
				 
				
				  $sbHtml.= " value=$rowRemitente[0]>";
				  $sbHtml.= $rowRemitente[1];
				  $sbHtml.="</option>";
			    }		
  		 	 				
		     
		    // ------------------------------------------------------------	
			
		$sbHtml.='
		</select>
		</td>	
		
	        </tr>	

			
			<tr>
	            <td>
					
	              Destinatario
                </td>
								<td><b>:</b></td>
				
				<td>
			<div id="div1" style="display: none;">
       
     <select id="combobox" name="combobox">
          <option VALUE=0>Seleccionar</option>
				';
			   
			    while($rowExterno=mysqli_fetch_array($resultExterno))
			    {
				
			   	  $sbHtml.="<option ";
				 
					  
				  $sbHtml.= " value=$rowExterno[0]>";
				  $sbHtml.= $rowExterno[1];
				  $sbHtml.="</option>		
";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultExterno);
		    // ------------------------------------------------------------	
$sbHtml.='
</select>
<a href="../RteExterno/Ingresar.php?id=0"><img src = "../../img/nuevo.png" width="20" height="20"></a>

				</div>
				
				<div id="div2" style="display: none;">
				';
				
				$sbHtml.="
	<select name='cmbDependencia' id='cmbDependencia'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowInterno=mysqli_fetch_array($resultInterno))
			    {
				
			   	  $sbHtml.="<option ";
				 
					  
				  $sbHtml.= " value=$rowInterno[0]>";
				  $sbHtml.= $rowInterno[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultInterno);
	
	$sbHtml.='	 
</select>
<a href="../RteInterno/Ingresar.php?id=0"><img src = "../../img/nuevo.png" width="20" height="20"></a>
				</div>
				
				<div id="div0">
				
				<input  type="text" disabled>	
				
				</div>
				
	            </td>
				
				</tr>
				
				
				<tr>	            
	            <td>
	                TRD
                </td>
								<td><b>:</b></td>

	            <td>';
				
				
	              $sbHtml.="<select name='cmbTRD' id='cmbTRD'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowSubSeries=mysqli_fetch_array($resultSubserie))
			    {
				
			   	  $sbHtml.="<option ";
				 
				 if($rowSubSeries[0]==$nuTRD){
				  $sbHtml.="selected";
				  } 
				  
				  $sbHtml.= " value=$rowSubSeries[0]>";
				  $sbHtml.= $rowSubSeries[1].' '.$rowSubSeries[2];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultSubserie);
	
	
	         $sbHtml.='  </td>	            
	    				
				</tr>		
				
				<tr>	            
	            <td>
	                Medio
                </td>
								<td><b>:</b></td>

	            <td>';
				
				
	              $sbHtml.="<select name='cmbMedios' id='cmbMedios'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowMedios=mysqli_fetch_array($resultMedios))
			    {
				
			   	  $sbHtml.="<option ";
				 
				 if($rowMedios[0]==$nuMedio){
				  $sbHtml.="selected";
				  } 
				  
				  $sbHtml.= " value=$rowMedios[0]>";
				  $sbHtml.= $rowMedios[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultMedios);
	
	
	         $sbHtml.='  </td>	            
	     		
				
								
				</tr>
				
				
				<tr>	            
	            <td>
	                Folios
                </td>
								<td><b>:</b></td>

	            <td>
	                <input name="txtFolios"  id ="txtFolios" type="text" value="'.$nuFolio.'">
	            </td>	            
	     		
				</tr>

			</table>
			
			</TD></TR>
	<!-- //////////////////////////////// FIN PERSONA ENLACE/////////////////////////////////////////-->  
	
	
	<TR><TD>
		<br>		
		<B>		Asunto del Documento	</B>
		<br><br>
		</TD></TR>
		
		<!-- //////////////////////////////// INCIO OBSERVACIONES/////////////////////////////////////////-->  
		
		<TR><TD>

			<table border ="0" align="left">
		
					 

  		     <tr>
  		     <td>
			  <textarea  name="txtAsunto" rows="3" cols="52" id="txtAsunto">'.$sbAsunto.'</textarea>
 	  	     </td>
			 </tr>
			
  		   
			
	
		
		</table>

		
	</TD></TR>
		
		
		
		
		<!-- //////////////////////////////// FIN OBSERVACIONES////////////////////////////////////////-->  
			
		
	


		  </TABLE>
		  
		  	<!-- Este input es para ver si es para modificar o para ingresar --> 
	 <input name="txtModificar" type="hidden" id="txtNro"  value="'.$nuModificar.'" ><br>
		  
		  <br><br>
  				
 <input type="submit" name="btnIngresar" value="Ingresar">
		  <input type="reset" name="btnLimpiar" value="Limpiar">
	</center>	
	</form>
	
	  	<script >
	
	</script>
	';
echo  $sbHtml;
?>

<?php include("../../includes/footerForm.php");?>
