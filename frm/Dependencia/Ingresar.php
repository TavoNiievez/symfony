
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
    $sbDepencia     	=  "";
	$nuUsuario       	=  "";
	
	$nuModificar		= 0;
	 
	

 //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos dependencia
	 $sqlDependencia = "select * from dependencia"; 
	 $resultDependencia =mysqli_query($link,$sqlDependencia);
	 
//-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos usuarios
	 $sqlUsuario = "select u.id, u.nombre, u.apellido1, u.apellido2 from usuario u"; 
	 $resultUsuario =mysqli_query($link,$sqlUsuario);
	
	 
	 	 //informacion para modificar
	 if($id != 0){
	 
	 
	 	 //realiza consulta a la base de datos
	 $sql = "SELECT d.id, d.descripcion, d.usuario_id
			FROM dependencia d 
			WHERE d.id = '$id'
			"; 
	 $result=mysqli_query($link,$sql);
	 

  while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
			   	  
	//Asigno Variables

    $sbCodigo			=  $row[0];
    $sbDepencia     	=  $row[1];
	$nuUsuario       	=  $row[2];
	
	 }
		         
	 //libera memoria
	mysqli_free_result ($result);	
	
	
	
	$nuModificar=1;
		 	 
	 }//finalizo el if para modificar
	 

 $sbHtml ='
<CENTER>
  <H1><b>REGISTRO DE DEPENDENCIAS</b></H1>
 
 
										
									      
	 
   <form name="frmUsuarios" action="../../src/IngresarDependencia.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">

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
	                <input name="txtDependencia" id ="txtDependencia" type="text" value="'.$sbDepencia.'">
	            </td>
	         </tr>
				</tr>
	        	
			  <tr>
	            <td>
	            	Responsable del Area
	            </td>
																	<td><b>:</b></td>

	            <td>
					<!--  AQUI SE LLENA EL SELECT CON 	-->
		';		
   			 // ------------------------------------------------------------
	 	     			
			   $sbHtml.= "<select name='cmbUsuario' id='cmbUsuario'>
			   				  <option VALUE=0>Seleccionar</option>
				";
			   
			    while($rowUsuario=mysqli_fetch_array($resultUsuario))
			    {
				
			   	  $sbHtml.="<option ";
				 
				 if($rowUsuario[0]==$nuUsuario){
				  $sbHtml.="selected";
				  } 
				  
				  $sbHtml.= " value=$rowUsuario[0]>";
				  $sbHtml.= $rowUsuario[0].' - '.$rowUsuario[1].' '.$rowUsuario[2].' '.$rowUsuario[3];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultUsuario);
		    // ------------------------------------------------------------	
$sbHtml.='	 
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
