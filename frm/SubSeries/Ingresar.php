
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
	$sbTrd	        		=  "";	
	$nuModificar		= 0;
	 
	

	 
	 	 //informacion para modificar
	 if($id != 0){
	 
	 
	 	 //realiza consulta a la base de datos
	 $sql = "SELECT id_serie, descripcion, trd
			FROM subseries
			WHERE trd = '$id'"; 
	 $result=mysqli_query($link,$sql);
	 

  while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
			   	  
	//Asigno Variables

	$sbCodigo				=  $row[0];	
    $sbNombre        		=  $row[1];	
	$sbTrd	        		=  $row[2];	
	
	
	 }
		         
	 //libera memoria
	mysqli_free_result ($result);	
	
	
	
	$nuModificar=1;
		 	 
	 }//finalizo el if para modificar
	 

 $sbHtml ='
<CENTER>
  <H1><b>REGISTRO DE SUBSERIES</b></H1>
 
 
										
									      
	 
   <form name="frmUsuarios" action="../../src/IngresarSubSeries.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">

					<TABLE align="center">
						<TR>
						<TD>
								


		<table>
			 <tr>
	            <td>
	               Codigo Serie
	            </td>
				<td><b>:</b></td>
	            <td>
	                <input name="txtCodigo" id ="txtCodigo" type="text" value="'.$sbCodigo.'">
	            </td>
	         </tr>
			  <tr>
	            <td>
	               Nombre SubSerie
	            </td>
				<td><b>:</b></td>

	            <td>
	                <input name="txtNombre" id ="txtNombre" type="text" value="'.$sbNombre.'">
	            </td>
				
				</tr>
	        <tr>
	            <td>
	              TRD
	            </td>
				<td><b>:</b></td>

	            <td>
	                <input name="txtTrd" id ="txtTrd" type="text" value="'.$sbTrd.'">
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
