
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
	$sbCodigo			=  "";
    $nuDepencia     	=  "";
	$sbTelefono        	=  "";
	$sbEmail        	=  "";
	
	$nuModificar		= 0;
	 
	

 //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos dependencia
	 $sqlDependencia = "select * from dependencia"; 
	 $resultDependencia =mysqli_query($link,$sqlDependencia);
	
	 
	 	 //informacion para modificar
	 if($id != 0){
	 
	 
	 	 //realiza consulta a la base de datos
	 $sql = "SELECT rti.id, rti.dependencia_id, rti.telefono, rti.email
			FROM remitentesinternos rti 
			WHERE rti.id = '$id'
			"; 
	 $result=mysqli_query($link,$sql);
	 

  while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
			   	  
	//Asigno Variables

	$sbCodigo			=  $row[0];	
    $nuDepencia     	=  $row[1];	
	$sbTelefono        	=  $row[2];	
	$sbEmail        	=  $row[3];	
	
	
	 }
		         
	 //libera memoria
	mysqli_free_result ($result);	
	
	
	
	$nuModificar=1;
		 	 
	 }//finalizo el if para modificar
	 

 $sbHtml ='
<CENTER>
  <H1><b>REGISTRO DE REMITENTE INTERNO</b></H1>
 
 
										
									      
	 
   <form name="frmUsuarios" action="../../src/IngresarRteInterno.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">

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
	            	Dependencia
	            </td>
																	<td><b>:</b></td>

	            <td>
					<!--  AQUI SE LLENA EL SELECT CON 	-->
		';		
   			 // ------------------------------------------------------------
	 	     			
			   $sbHtml.= "<select name='cmbDependencia' id='cmbDependencia'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowDependencia=mysqli_fetch_array($resultDependencia,MYSQLI_NUM))
			    {
				
			   	  $sbHtml.="<option ";
				 
				 if($rowDependencia[0]==$nuDepencia){
				  $sbHtml.="selected";
				  } 
				  
				  $sbHtml.= " value=$rowDependencia[0]>";
				  $sbHtml.= $rowDependencia[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultDependencia);
		    // ------------------------------------------------------------	
$sbHtml.='	 
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
