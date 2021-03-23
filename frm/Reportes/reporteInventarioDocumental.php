
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
	 

	  
	 //realiza consulta a la base de datos
	 $sqlInterno = "SELECT rti.id, d.descripcion 
			FROM remitentesinternos rti, dependencia d 
			Where rti.dependencia_id = d.id	";
	$resultInterno=mysqli_query($link,$sqlInterno);

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
	 	  
	 	  
	
		
		

 $sbHtml ='
 
 <script type="text/javascript">
function validarIngreso(f) {
  var ok = true;
  var msg = "Debes escribir algo en los campos:\n";
  if(f.elements["cmbRemitenteInterno"].value == "")
  {
    msg += "Dependencia\n";
    ok = false;
  }

  if(f.elements["dtFechaInicial"].value == "")
  {
    msg += "Fecha Inicial \n";
    ok = false;
  }

  if(f.elements["dtFechaFinal"].value == "")
  {
    msg += "Fecha Final \n";
    ok = false;
  }

  if(ok == false)
    alert(msg);
  return ok;
}
</script>

 
<CENTER>
  <H1><b>INVENTARIO DOCUMENTAL </b></H1>
  
	<link type= "text/css" rel="stylesheet" href="../../css/jquery-ui-1.9.2.custom.css" />
 			
   <form name="frmInventarioDocumental" id="frmInventarioDocumental" action="../../reportes/CEnviada/inventarioDocumental.php" method ="post"  onSubmit="return validarIngreso(this)"  enctype="multipart/form-data">

					<TABLE align="center">
						
			
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
	            	Fecha Inicial
	            </td>
																	<td><b>:</b></td>

	            <td>
	               <input type="text" name="dtFechaInicial"  id="dtFechaInicial"  readonly> 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmInventarioDocumental.dtFechaInicial,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
				
	            </td>
				</tr>
						
				<tr>				
	          
	      	
	            <td>
	            	Fecha Final
	            </td>
																	<td><b>:</b></td>

	            <td>
	               <input type="text" name="dtFechaFinal"  id="dtFechaFinal"  readonly > 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmInventarioDocumental.dtFechaFinal,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
				
	            </td>
				</tr>
							
			     
			</table>
			
			</TD></TR>
	<!-- //////////////////////////////// FIN PERSONA ENLACE/////////////////////////////////////////-->  
	
	
	
		  </TABLE>

		  <br><br>
  				
 <input type="submit" name="btnIngresar" value="Generar Reporte">
 <input type="reset" name="btnLimpiar" value="Limpiar">
	</center>	
	</form>
	
	  	<script >
	
	</script>
	';
echo  $sbHtml;
?>

<?php include("../../includes/footerForm.php");?>
