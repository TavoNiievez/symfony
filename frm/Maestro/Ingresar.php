
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
 
 
		

 $sbHtml ='
<CENTER>
  <H1><b>REGISTRO DE MAESTROS</b></H1>
 
 
										
									      
	 
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
	                <a href="../Dependencia/Lista.php"> Registro de Dependencias</a>
	            </td>
	         </tr>
			  <tr>
	            <td>
	               *
	            </td>
	            <td>
	                <a href="../Series/Lista.php"> Registro de Series</a>
	            </td>
	         </tr>
			  <tr>
	            <td>
	               *
	            </td>
	            <td>
	                <a href="../SubSeries/Lista.php"> Registro de SubSeries</a>
	            </td>
	         </tr>
			 
			 <tr>
	            <td>
	               *
	            </td>
	            <td>
	                <a href="../Cargos/Lista.php"> Registro de Cargos</a>
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
		  
		  	<!-- Este input es para ver si es para modificar o para ingresar --> 
	 <input name="txtModificar" type="hidden" id="txtNro" ><br>
		  
		  <br><br>
  				
 <input type="submit" name="btnIngresar" value="Ingresar">
		  <input type="reset" name="btnLimpiar" value="Limpiar">
	</center>	
	</form>
	';
echo  $sbHtml;
?>

<?php include("../../includes/footerForm.php");?>
