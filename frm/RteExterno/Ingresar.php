
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
	$sbRepresentate        	=  "";
	$sbDireccion        	=  "";
	$sbCiudad    			=  "";
	$sbTelefono        		=  "";
	$sbEmail        		=  "";

	$nuModificar		= 0;
	 
	

	 
	 	 //informacion para modificar
	 if($id != 0){
	 
	 
	 	 //realiza consulta a la base de datos
	 $sql = "SELECT rte.id, rte.nombre, rte.representante, rte.direccion, rte.ciudad, rte.telefono, rte.email 
			FROM remitentesexternos rte 
			WHERE rte.id = '$id'
			"; 
	 $result=mysqli_query($link,$sql);
	 

  while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
			   	  
	//Asigno Variables

	$sbCodigo				=  $row[0];	
    $sbNombre        		=  $row[1];	
	$sbRepresentate        	=  $row[2];	
	$sbDireccion        	=  $row[3];	
	$sbCiudad    			=  $row[4];	
	$sbTelefono        		=  $row[5];	
	$sbEmail        		=  $row[6];	
	
	
	 }
		         
	 //libera memoria
	mysqli_free_result ($result);	
	
	
	
	$nuModificar=1;
		 	 
	 }//finalizo el if para modificar
	 

 $sbHtml ='
<CENTER>
  <H1><b>REGISTRO DE REMITENTE EXTERNO</b></H1>
 
 
										
									      
	 
   <form name="frmUsuarios" action="../../src/IngresarRteExterno.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">

					<TABLE align="center">
						<TR>
						<TD>
								


		<table>
		
	                <input name="txtCodigo" id ="txtCodigo" type="hidden" value="'.$sbCodigo.'">
	         
			  <tr>
	            <td>
	               Nombre Entidad
	            </td>
				<td><b>:</b></td>

	            <td>
	                <input name="txtNombre" id ="txtNombre" type="text" value="'.$sbNombre.'">
	            </td>
				
				</tr>
	        		
	        <tr>

	            <td>
	              Representante
                </td>
								<td><b>:</b></td>

	            <td>
	                <input name="txtRepresentante" id ="txtRepresentante" type="text" value="'.$sbRepresentate.'">
	            </td>	
			</tr>
			
			<tr>	            
	            <td>
	                Direccion
                </td>
								<td><b>:</b></td>

	            <td>
	                <input name="txtDireccion"  id ="txtDireccion" type="text" value="'.$sbDireccion.'">
	            </td>	            
	     		
				</tr>
				
				<tr>	            
	            <td>
	                Ciudad
                </td>
								<td><b>:</b></td>

	            <td>
	                <input name="txtCiudad"  id ="txtCiudad" type="text" value="'.$sbCiudad.'">
	            </td>	            
	     		
				</tr>
			<tr>
	                <td>
	                	Telefono
	                </td>
									<td><b>:</b></td>

	                <td>
	                    <input name="txtTelefono" id ="txtTelefono" type="text"  onKeyPress="return onlyNumbers(event)" value="'.$sbTelefono.'">
	                </td>					
	            </tr>
	        <tr>				
	                      
	       	
	            <td>
	            	Email
	            </td>
													<td><b>:</b></td>

	            <td>
	                <input name="txtEmail" id ="txtEmail" type="text" value="'.$sbEmail.'" >
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
