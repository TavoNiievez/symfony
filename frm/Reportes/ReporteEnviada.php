
<?php include_once("../../utils/SessionPhp.php");?>
<?php include_once("../../src/conexion.php");
//declaro variable

	
	 //Conexi�n con el servidor
	 $link=ConectarseServidor();
	 //Conexi�n con la base de datos
	 ConectarseBaseDatos($link);
	
	 ?>
	 
<?php include("../../includes/top_pageForm.php");?>
<?php include("../../includes/headerForm.php");?>
<?php include("../../includes/menuForm.php");?>
<?php include("../../includes/validarSesion.php");?>



		 <?php
 
 
		

 $sbHtml ='
<CENTER>
  <H1><b>GENERAR REPORTES CORRESPONDENCIA ENVIADA</b></H1>
 
 <script src="../../js/ReportesEnviada.js">
</script>
										
									      
	 

					<TABLE align="center">
						<TR>
						<TD>
								


	<table>
			 <tr>
	            <td>
	               Tipo de Reporte
	            </td>
				<td><b>:</b></td>
	            <td>
	          <select name="cmbReporte" id="cmbReporte" onchange="Buscar(';  
			 $sbHtml.="'ResultadoReporteEnviada.php'";   
			 $sbHtml.='); return false"> 
	            <option VALUE="">Seleccionar</option>
	            <option VALUE="1">Rango de Fechas</option>
				<option VALUE="2">Remitente</option>
				<option VALUE="3">Destinatario</option>
				<option VALUE="4">Radicado Inicial</option>
				<option VALUE="5">Reporte Diario</option>
	         </tr>
			  
			</table>
			
			</TD>
			</TR>
			
			<TR>
			<TD>
			<div id="ResultadoReportes">
			
			
			</div>
			</TD>
			</TR>
			

		  </TABLE>
		  
		  
	</center>	
	';
echo  $sbHtml;
?>

<?php include("../../includes/footerForm.php");?>