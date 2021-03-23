
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
		 date_default_timezone_set('America/Bogota');
 
 //declaro Variables
	
	$id 					=  $_GET['id'];
	$sbRadicado				=  "";
    $nuCorrespondencia 		=  "";
	$nuRemitente        	=  "";
	$nuDestinatario        	=  "";
	$nuMedio    			=  "";
	$sbVigencia        		=  "";
	$nuFolio        		=  "";
	$sbAsunto        		=  "";

	$nuModificar		= 0;
	 
	 
	  
	 //realiza consulta a la base de datos
	 $sqlInterno = "SELECT rti.id, d.descripcion 
			FROM remitentesinternos rti, dependencia d 
			Where rti.dependencia_id = d.id	";
	$resultInterno=mysqli_query($link,$sqlInterno);

	
	  //realiza consulta a la base de datos
	 $sqlExterno = "SELECT rte.id, rte.nombre FROM remitentesexternos rte order by rte.nombre"; 
	 	 $resultExterno=mysqli_query($link,$sqlExterno);

	 //consulta informacion al trd
	 $sqlSubserie = "select s.id, s.trd, s.descripcion from  subseries s where estado_id = 1";
	 $resultSubserie =mysqli_query($link,$sqlSubserie);
	 
		 //realiza consulta a la base de datos
	 $sqlDocumento = "SELECT dc.id, dc.descripcion FROM documentos dc order by dc.id"; 
	 	 $resultDocumento=mysqli_query($link,$sqlDocumento);

	 	 //realiza consulta a la base de datos
	$sqlMedios = "SELECT ev.id, ev.descripcion from mediorecepcion ev";	 
		 $resultMedios=mysqli_query($link,$sqlMedios);

	 	 //realiza consulta a la base de datos
	 $sqlInternoDestnatario = "SELECT rti.id, d.descripcion
			FROM remitentesinternos rti, dependencia d 
			Where rti.dependencia_id = d.id
			ORDER BY d.descripcion";
	 $resultDestnatario=mysqli_query($link,$sqlInternoDestnatario);

	 
	 //consulta informacion al remitente
	 $sqlRemitente = "select * from  remitente";
	 $resultRemitente=mysqli_query($link,$sqlRemitente);
	 	  
	 
	/*////////////////////////////////////////////////////////
				INICIO	CONSECUTIVOS
	/////////////////////////////////////////////////////////*/

	$sqlConsecutivo = "select * from  consecutivos";
	$resultConsecutivo=mysqli_query($link,$sqlConsecutivo);
	 	  
	 
	//llamo el el consecutivo 
	$sbYear =@date("Y");
	$Date = @date("Y");
	$nuDate=(int)$Date;
	$nuConsecutivo=0;
	$sbConsecutivo="";
	
	while($row=mysqli_fetch_array($resultConsecutivo))
	{ 
		$nufecha=(int)$row[1];
					
		if ($nuDate > $nufecha  && $row[0]=="CR"){
				   
			$sqlConsecutivo = "insert into consecutivos values ('CR','$nuDate',0) ";
			$InsertarConsecutivo=mysqli_query($link,$sqlConsecutivo);
			//$sbYear=substr($sbYear, -2);
		  
		}  else{
			if($Date==$row[1] && $row[0]=="CR" ){
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
	 
	$sbConsecutivoFinal = "CR-".$sbYear.$sbConsecutivo;
	
	/*////////////////////////////////////////////////////////
				FIN	CONSECUTIVOS
	/////////////////////////////////////////////////////////*/

	 
	 /*////////////////////////////////////////////////////////
			INCIO INFORMACION PARA MODIFICAR
	 /////////////////////////////////////////////////////////*/
	 	
	 if($id != 'No'){
	 
	 
	 	 //realiza consulta a la base de datos
	 $sql = "SELECT cr.radicado, cr.remitente_id, cr.remitente_ext_int, cr.destinatario_id, cr.medio_id, cr.vigencia, cr.folio, cr.asunto
			FROM c_recibida cr
			WHERE cr.radicado = '$id'
			"; 
	 $result=mysqli_query($link,$sql);
	 

  while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
			   	  
	//Asigno Variables

    $sbRadicado				=  $row[0];	
    $nuCorrespondencia 		=  $row[1];	
	$nuRemitente        	=  $row[2];	
	$nuDestinatario        	=  $row[3];	
	$nuMedio    			=  $row[4];	
	$sbVigencia        		=  $row[5];	
	$nuFolio        		=  $row[6];	
	$sbAsunto        		=  $row[7];	
	
	
	 }
		         
	 //libera memoria
	mysqli_free_result ($result);	
	
	$sbConsecutivoFinal = $sbRadicado;
	
	$nuModificar=1;
		 	 
	 }//finalizo el if para modificar
	 
	  
	 /*////////////////////////////////////////////////////////
			INCIO INFORMACION PARA MODIFICAR
	 /////////////////////////////////////////////////////////*/
	 	
		
		

 $sbHtml ='
<CENTER>
  <H1><b>CORRESPONDENCIA RECIBIDA </b></H1>
  
	<link type= "text/css" rel="stylesheet" href="../../css/jquery-ui-1.9.2.custom.css" />
	


 <script src="../../js/CRecibida.js">
</script>
	
										

	 
   <form name="frmUsuarios" action="../../src/IngresarCorrespondenciaRecibida.php" method ="post"  onSubmit="return validarIngreso(this)"  enctype="multipart/form-data">

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
			  <label>Correspondencia</label>
 	  	     </td>	 <td><b>:</b> </td> 
  	          <td>
					<!--  AQUI SE LLENA EL SELECT CON remitente-->
		';		
   			 // ------------------------------------------------------------
	 	    			
			  $sbHtml.= "<select name='cmbRemitente' id='cmbRemitente' onchange = 'cambiar.ejecutar()' >
			 <option VALUE=0>Seleccionar</option>";
			 
			    while($rowRemitente=mysqli_fetch_array($resultRemitente))
			    {
				
				$sbHtml.="<option ";
				 
				 if($rowRemitente[0]==$nuCorrespondencia){
				  $sbHtml.="selected";
				  } 
				  
				  $sbHtml.= " value=$rowRemitente[0]>";
				  $sbHtml.= $rowRemitente[1];
				  $sbHtml.="</option>";
			    }		
  		 	 				
		     
		    // ------------------------------------------------------------	
			
$sbHtml.='</select>
		</td>	
		
	        </tr>	
		  
	        		
	        <tr>
	            <td>
							

	              Remitente
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
				</td>';
							

	
			$sbHtml.='			</tr>
				
				
			<tr>	            
	            <td>
	                Destinatario
                </td>
								<td><b>:</b></td>

	            <td>';
				
				
	              $sbHtml.="<select name='cmbDestinatario' id='cmbDestinatario'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowDestinatario=mysqli_fetch_array($resultDestnatario))
			    {
				
			   	  $sbHtml.="<option ";
				 
				 
				 if($rowDestinatario[0]==$nuDestinatario){
				  $sbHtml.="selected";
				  } 
				 
					  
				  $sbHtml.= " value=$rowDestinatario[0]>";
				  $sbHtml.= $rowDestinatario[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultDestnatario);
	
	
	         $sbHtml.=' </select> </td>	            
	     		
				
				
				</tr>
				
				<tr>	            
	            <td>
	                Documento
                </td>
								<td><b>:</b></td>

	            <td>';
				
				
	              $sbHtml.="<select name='cmbDocumento' id='cmbDocumento'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowDocumentos=mysqli_fetch_array($resultDocumento))
			    {
				
			   	  $sbHtml.="<option ";
				 
				 
				/* if($rowDestinatario[0]==$nuDestinatario){
				  $sbHtml.="selected";
				  } 
				 */
					  
				  $sbHtml.= " value=$rowDocumentos[0]>";
				  $sbHtml.= $rowDocumentos[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultDocumento);
	
	
	         $sbHtml.=' </select> </td>	            
	     		
				</tr>
			
				<tr>				
	        	      	
	            <td>
	            	Termino Document
	            </td>
																	<td><b>:</b></td>

	            <td>
	             
					<input type="text" name="dtTermino"  id="dtTermino"  readonly value=""> 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmUsuarios.dtTermino,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
	            </td>	

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
	
	
	         $sbHtml.=' </select> </td>	            
	     		
				
				
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
 	  	     </tr>
			
	
		
		</table>
		
	</TD></TR>
				
		<!-- //////////////////////////////// FIN OBSERVACIONES////////////////////////////////////////-->  
			
		  </TABLE>
		  
		  	<!-- Este input es para ver si es para modificar o para ingresar --> 
	 <input name="txtModificar" type="hidden" id="txtNro"  value="'.$nuModificar.'" ><br>
		  
		  <br><br>
  				
			<input type="submit" name="btnIngresar" value="Registrar">
			<input type="reset" name="btnLimpiar" value="Limpiar">
	</center>	
	</form>
	
	  	<script >
	
	</script>
	';
echo  $sbHtml;
?>

<?php include("../../includes/footerForm.php");?>
