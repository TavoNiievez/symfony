
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
<?php include("../../includes/subMenuForm.php"); ?>
<?php include("../../includes/validarSesion.php"); ?>



		 <?php
 
 //declaro Variables
	
	$id 				=  $_GET['id'];
	$sbCodigo				=  "";
    $sbNombre        		=  "";	
	$nuModificar		= 0;
	 
	

	 
	 	 //informacion para modificar
	 if($id != 0){
	 
	 
	 	 //realiza consulta a la base de datos
	 $sql = "SELECT id, descripcion
			FROM series
			WHERE id = '$id'"; 
	 $result=mysqli_query($link,$sql);
	 

  while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
			   	  
	//Asigno Variables

	$sbCodigo				=  $row[0];	
    $sbNombre        		=  $row[1];	
	
	
	 }
		         
	 //libera memoria
	mysqli_free_result ($result);	
	
	
	
	$nuModificar=1;
		 	 
	 }//finalizo el if para modificar
	 

 $sbHtml ='
<CENTER>
  <H1><b>REGISTRO DE SERIES</b></H1>
 
 
										
									      
	 
   <form name="frmUsuarios" action="../../src/IngresarSeries.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">

					<TABLE align="center">
						<TR>
						<TD>
								


		<table>
			 <tr>
	            <td>
	               Codigo
	            </td>
				<td><b>:</b></td>
	            <td>
	                <input name="txtCodigo" id ="txtCodigo" type="text" value="'.$sbCodigo.'">
	            </td>
	         </tr>
			  <tr>
	            <td>
	               Nombre Serie
	            </td>
				<td><b>:</b></td>

	            <td>
	                <input name="txtNombre" id ="txtNombre" type="text" value="'.$sbNombre.'">
	            </td>
				
				</tr>
	        		
	        
			</table>
			
			</TD>
			</TR>

		  </TABLE>
		  
		  	<!-- Este input es para ver si es para modificar o para ingresar --> 
	 <input name="txtModificar" type="hidden" id="txtNro"  value="'.$nuModificar.'" ><br>
		  
		  <br><br>
  				
 <input type="submit" name="btnIngresar" value="Ingresar">
		  <input type="reset" name="btnLimpiar" value="Limpiar">
	</center>	
	</form>
	';
echo  $sbHtml;
?>

<?php include("../../includes/footerForm.php");?>
