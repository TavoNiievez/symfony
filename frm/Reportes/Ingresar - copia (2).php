
<?php include_once("../../utils/SessionPhp.php");?>
<?php include_once("../../src/conexion.php");
//declaro variable

	
	 //Conexión con el servidor
	 $link=ConectarseServidor();
	 //Conexión con la base de datos
	 ConectarseBaseDatos($link);
	
	 ?>
	 
<?php include("../../includes/top_pageForm.php");?>
<?php include("../../includes/headerForm.php");?>
<?php include("../../includes/menuForm.php");?>
<?php include("../../includes/validarSesion.php");?>



		 <?php
 
 
		

 $sbHtml ='
<CENTER>
  <H1><b>GENERAR REPORTES</b></H1>
 
 
										
									      
	 
   <form name="frmUsuarios" action="../../src/IngresarRteInterno.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">

					<TABLE align="center">
						<TR>
						<TD>
								


	<table>
			 <tr>
	            <td>
	               *
	            </td>
	            <td>
	                <a href="../Dependencia/Lista.php"> Correspondencia Recibida</a>
	            </td>
	         </tr>
			  <tr>
	            <td>
	               *
	            </td>
	            <td>
	                <a href="../Series/Lista.php"> Correspondencia Enviada</a>
	            </td>
	         </tr>
			 
			
			</table>
			
			</TD>
			</TR>
			
			<TR>
			<TD>
			<div id="RegistroMaestros">
			
			
			</div>
			</TD>
			</TR>
			

		  </TABLE>
		  
		  
	</center>	
	</form>
	';
echo  $sbHtml;
?>

<?php include("../../includes/footerForm.php");?>
