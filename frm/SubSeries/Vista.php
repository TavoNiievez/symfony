
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
	$sbTrd	        		=  "";
	
 
	 //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos Cargo
	 $sql = "SELECT id_serie, descripcion, trd
			FROM  subseries
			WHERE trd = '$id'
			"; 
	 $result=mysqli_query($link,$sql);

	 
	while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
	
	{
	
    $sbCodigo				=  $row[0];
    $sbNombre        		=  $row[1];
	$sbTrd 	        		=  $row[2];
		
	}
     
     mysqli_free_result ($result);


	 
 $sbHtml ='


 
 <CENTER>
 
										 <H1><b>INFORMACION SUBSERIES</b></H1>
									      
	 
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
	               Nombre Serie</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbNombre.' 
	            </td>	            
	        </tr>
			<tr>
	            <td><b>
	               TRD</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbTrd.' 
	            </td>	            
	        </tr>
	    			
			</table>
			
			</TD>
			</TR>
					<!-- fin DATOS DE INICIAR DE SESION -->

		  </TABLE>
		  
		  <br><br>
  				
	</center>	
	</form>
	';
echo  $sbHtml;
?>
	
<?php include("../../includes/footerForm.php");?>