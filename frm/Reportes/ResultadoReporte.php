<?php //Código para incluir las librerias
	 include_once("../../src/conexion.php");
	 //Conexión con el servidor
	 $link=ConectarseServidor();

	 //Conexión con la base de datosrecepcion
	 ConectarseBaseDatos($link);
 ?>	
 
<?php


 
	//Declaro Variables
	$nuReporte		= $_POST ['cmbReporte'];
	
	
	$sbCodigo				=  "";
    $sbNombre        		=  "";
	$sbRepresentate        	=  "";
	$sbCiudad    			=  "";
	

	
	
	 /*////////////////////////////////////////////////////////
			INICIO RANGO DE FEHCAS
	 /////////////////////////////////////////////////////////*/
	
	if($nuReporte == 1){
	$sbHtml='

   <form name="frmReporte" action="../../reportes/CRecibida/RangoFechas.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">
		<center>
		<table>
		
	
				<tr>				
	             <td>
	            	Fecha Inicial
	            </td>
				<td><b>:</b></td>

	            <td>
	               <input type="text" name="dtFechaInicial"  id="dtFechaInicial" readonly > 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmReporte.dtFechaInicial,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
				
	            </td>	

				</tr>
				
				<tr>				
	             <td>
	            	Fecha Final
	            </td>
				<td><b>:</b></td>

	            <td>
	               <input type="text" name="dtFechaFinal"  id="dtFechaFinal"  readonly > 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmReporte.dtFechaFinal,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
				
	            </td>	

				</tr>
	</table>
	
	<br>
	
	<input type="submit" name="btnIngresar" value="Generar Reporte">

	
			</center>

	</form>
	';
	
	}
	
	 /*////////////////////////////////////////////////////////
			FIN RANGO DE FECHAS 
	 /////////////////////////////////////////////////////////*/
	
	 /*////////////////////////////////////////////////////////
			INICIO DEPENDENCIA
	 /////////////////////////////////////////////////////////*/
	
	if($nuReporte == 2){
	
	 	 //realiza consulta a la base de datos
	 $sqlInternoDestnatario = "SELECT rti.id, d.descripcion
			FROM remitentesinternos rti, dependencia d 
			Where rti.dependencia_id = d.id
			";
	 $resultDestnatario=mysqli_query($link,$sqlInternoDestnatario);

	
	
	$sbHtml='

   <form name="frmReporte" action="../../reportes/CRecibida/Destinatario.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">
		<center>
		<table>
		
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
				  $sbHtml.= " value=$rowDestinatario[0]>";
				  $sbHtml.= $rowDestinatario[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultDestnatario);
	
	
	         $sbHtml.='  </td>	            
	     				
				</tr>
		
	
				<tr>				
	             <td>
	            	Fecha Inicial
	            </td>
				<td><b>:</b></td>

	            <td>
	               <input type="text" name="dtFechaInicial"  id="dtFechaInicial" readonly > 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmReporte.dtFechaInicial,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
				
	            </td>	

				</tr>
				
				<tr>				
	             <td>
	            	Fecha Final
	            </td>
				<td><b>:</b></td>

	            <td>
	               <input type="text" name="dtFechaFinal"  id="dtFechaFinal"  readonly > 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmReporte.dtFechaFinal,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
				
	            </td>	

				</tr>
	</table>
	
	<br>
	
	<input type="submit" name="btnIngresar" value="Generar Reporte">

	
			</center>

	</form>
	';
	
	}
	
	 /*////////////////////////////////////////////////////////
			FIN DEPENDENCIA
	 /////////////////////////////////////////////////////////*/
	
	 /*////////////////////////////////////////////////////////
			INICIO REMITENTES
	 /////////////////////////////////////////////////////////*/
	
	if($nuReporte == 3){
	
	 //consulta informacion al remitente
	 $sqlRemitente = "select * from  remitente";
	 $resultRemitente=mysqli_query($link,$sqlRemitente);
	
	$sbHtml='

   <form name="frmReporte" action="../../reportes/CRecibida/Remitente.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">
		<center>
		<table>
		
		<tr>	            
	            <td>
	                Remitente
                </td>
								<td><b>:</b></td>

	            <td>';
				
				
	              $sbHtml.="<select name='cmbRemitente' id='cmbRemitente'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowRemitente=mysqli_fetch_array($resultRemitente))
			    {
				
			   	  $sbHtml.="<option ";
				  $sbHtml.= " value=$rowRemitente[0]>";
				  $sbHtml.= $rowRemitente[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultRemitente);
	
	
	         $sbHtml.='  </td>	            
	     				
				</tr>
		
	
				<tr>				
	             <td>
	            	Fecha Inicial
	            </td>
				<td><b>:</b></td>

	            <td>
	               <input type="text" name="dtFechaInicial"  id="dtFechaInicial" readonly > 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmReporte.dtFechaInicial,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
				
	            </td>	

				</tr>
				
				<tr>				
	             <td>
	            	Fecha Final
	            </td>
				<td><b>:</b></td>

	            <td>
	               <input type="text" name="dtFechaFinal"  id="dtFechaFinal"  readonly > 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmReporte.dtFechaFinal,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
				
	            </td>	

				</tr>
	</table>
	
	<br>
	
	<input type="submit" name="btnIngresar" value="Generar Reporte">

	
			</center>

	</form>
	';
	
	}
	
	 /*////////////////////////////////////////////////////////
			FIN REMITENTES
	 /////////////////////////////////////////////////////////*/
	
	
	 /*////////////////////////////////////////////////////////
			INICIO REPORTE DIARIO
	 /////////////////////////////////////////////////////////*/
	
	if($nuReporte == 4){
	
	
	$sbHtml='

   <form name="frmReporte" action="../../reportes/CRecibida/ReporteDiario.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">
		<center>
		<table>
		
		<tr>	            
	            <td>
	                Horario
                </td>
								<td><b>:</b></td>

	            <td>';
				
				
	              $sbHtml.="<select name='cmbHorario' id='cmbHorario'>
			   				<option VALUE=''>Seleccionar</option>
							<option  value='1'>07:30 am - 12:00 pm</option>
							<option  value='2'>02:00 pm - 06:00 pm</option>
						
						</select>
						</td>	            
	     				
				</tr>";
		 $sbHtml.='
	
				<tr>				
	             <td>
	            	Fecha Inicial
	            </td>
				<td><b>:</b></td>

	            <td>
	               <input type="text" name="dtFechaInicial"  id="dtFechaInicial" readonly > 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmReporte.dtFechaInicial,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
				
	            </td>	

				</tr>
				
				<tr>				
	             <td>
	            	Fecha Final
	            </td>
				<td><b>:</b></td>

	            <td>
	               <input type="text" name="dtFechaFinal"  id="dtFechaFinal"  readonly > 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmReporte.dtFechaFinal,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
				
	            </td>	

				</tr>
	</table>
	
	<br>
	
	<input type="submit" name="btnIngresar" value="Generar Reporte">

	
			</center>

	</form>
	';
	
	}
	
	 /*////////////////////////////////////////////////////////
			FIN  REPORTE DIARIO
	 /////////////////////////////////////////////////////////*/
	
	
	
	 /*////////////////////////////////////////////////////////
			INICIO REPORTE POR RADICADO
	 /////////////////////////////////////////////////////////*/
	
	if($nuReporte == 5){
	
	
	$sbHtml='

   <form name="frmReporte" action="../../reportes/CRecibida/ReporteRadicado.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">
		<center>
		<table>
		
		<tr>	            
	            <td>
	                Radicado
                </td>
								<td><b>:</b></td>

	           

	            <td>
	               <input type="text" name="txtRadicado"  id="txtRadicado"  > 
				
	            </td>	

				
				</tr>
	</table>
	
	<br>
	
	<input type="submit" name="btnIngresar" value="Generar Reporte">

	
			</center>

	</form>
	';
	
	}
	
	 /*////////////////////////////////////////////////////////
			FIN  REPORTE POR RADICADO
	 /////////////////////////////////////////////////////////*/
	
	
		 
		 
	 /*////////////////////////////////////////////////////////
			INCIO CAMPO VACIO
	 /////////////////////////////////////////////////////////*/
	if($nuReporte == '' ){
	$sbHtml='';
	}
		 
	 /*////////////////////////////////////////////////////////
			FIN CAMPO VACIO
	 /////////////////////////////////////////////////////////*/
  	 
	
	 
echo $sbHtml;

?>
	