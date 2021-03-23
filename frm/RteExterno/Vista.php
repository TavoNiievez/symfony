
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
<?php include("../../includes/submenuForm.php"); ?>
<?php include("../../includes/validarSesion.php"); ?>


		 
 <?php
		 
		 
	//declaro Variables
	
	$id 					=  $_GET['id'];
	$sbCodigo				=  "";
    $sbNombre        		=  "";
	$sbRepresentate        	=  "";
	$sbDireccion        	=  "";
	$sbCiudad    			=  "";
	$sbTelefono        		=  "";
	$sbEmail        		=  "";
	
 
	 //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos Cargo
	 $sql = "SELECT rte.id, rte.nombre, rte.representante, rte.direccion, rte.ciudad, rte.telefono, rte.email 
			FROM remitentesexternos rte 
			WHERE rte.id = '$id'
			"; 
	 $result=mysqli_query($link,$sql);

	 
	while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
	
	{
	
    $sbCodigo				=  $row[0];
    $sbNombre        		=  $row[1];
	$sbRepresentate        	=  $row[2];
	$sbDireccion        	=  $row[3];
	$sbCiudad    			=  $row[4];
	$sbTelefono        		=  $row[5];
	$sbEmail        		=  $row[6];
	
	
	}
     
     mysqli_free_result ($result);


	 
 $sbHtml ='


 
 <CENTER>
 
										 <H1><b>INFORMACION REMITENTE EXTERNO</b></H1>
									      
	 
   <form name="frmUsuarios" action="../../src/Usuario.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">

					<TABLE align="center">
						<TR>
						<TD>
								


		<table>
			 <tr>
	            <td><b>
	               Codigo</b>
	            </td>
				<td><b>:</b></td>
	            <td>
				'.$sbCodigo .' 
	            </td>
	        </tr>
	        		
	        <tr>
	            <td><b>
	               Nombre Entidad</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbNombre.' 
	            </td>	            
	        </tr>
			
			<tr>
	            <td><b>
	               Representante</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbRepresentate.' 
	            </td>	            
	        </tr>

	        <tr>	            
	            <td><b>
	                Direccion</b>
                </td>
								<td><b>:</b></td>

	            <td>
	                 '.$sbDireccion.' 
	            </td>	            
	     		   </tr>
	        <tr>	
	                <td><b>
	                	Ciudad</b>
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$sbCiudad.' 
	                </td>					
	            </tr>
	        <tr>	
			<tr>	
	                <td><b>
	                	Telefono</b>
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$sbTelefono.' 
	                </td>					
	            </tr>
	        
	        <tr>	
	            <td><b>
	            	Email</b>
	            </td>
					<td><b>:</b></td>
	            <td>
	               '.$sbEmail.' 
	            </td>	            
	        </tr>
			<tr>				
	    			
			</table>
			
			</TD>
			</TR>
					<!-- fin DATOS DE INICIAR DE SECION -->

		  </TABLE>
		  
		  <br><br>
  				
	</center>	
	</form>
	';
echo  $sbHtml;
?>
	
<?php include("../../includes/footerForm.php");?>