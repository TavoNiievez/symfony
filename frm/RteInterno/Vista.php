
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
	
	$id 				=  $_GET['id'];
	$sbCodigo			=  "";
    $sbDepencia     	=  "";
    $sbNomResposable   	=  "";
    $sbCagResposable   	=  "";
	$sbTelefono        	=  "";
	$sbEmail        	=  "";
	
 
	 //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos Cargo
	 $sql = "SELECT rti.id, d.descripcion, u.nombre, u.apellido1, u.apellido2, c.descripcion, rti.telefono, rti.email
			FROM remitentesinternos rti, dependencia d, usuario u, cargo c
			WHERE rti.id = '$id'
			AND rti.dependencia_id = d.id
			AND d.usuario_id = u.id
			AND u.cargo_id = c.id
			"; 
	 $result=mysqli_query($link,$sql);

	 
	while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
	
	{
	
    $sbCodigo			=  $row[0];
    $sbDepencia     	=  $row[1];
    $sbNomResposable   	=  $row[2].' '.$row[3].' '.$row[4];
    $sbCagResposable   	=  $row[5];
	$sbTelefono        	=  $row[6];
	$sbEmail        	=  $row[7];
	
	
	}
     
     mysqli_free_result ($result);


	 
 $sbHtml ='


 
 <CENTER>
 
										 <H1><b>INFORMACION REMITENTE INTERNO</b></H1>
									      
	 
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
	               Dependencia</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbDepencia.' 
	            </td>	            
	        </tr>
			
			<tr>
	            <td><b>
	               Responsable</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbNomResposable.' 
	            </td>	            
	        </tr>

	        <tr>	            
	            <td><b>
	                Cargo Responsable</b>
                </td>
								<td><b>:</b></td>

	            <td>
	                 '.$sbCagResposable.' 
	            </td>	            
	     		   </tr>
	    	
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