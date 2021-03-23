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
	$sbIdUsuario			=  "";
    $sbNombre        		=  "";
	$sbApellido1        	=  "";
	$sbApellido2        	=  "";
	$sbDireccion        	=  "";
	$sbTelefono        		=  "";
	$sbCelular       		=  "";
	$sbEmail        		=  "";
	$sbFechaNacimiento 		=  "";
	$nuIdCiudad    			=  "";
	$sbSexo          		=  "";
	$nuDependencia     		=  "";
	$nuIdCargo        		=  "";
	$sbProfesion        	=  "";
	$sbLogin        		=  "";
	$sbClave        		=  "";
	$sbClave2        		=  "";
	$nuIdPerfil		        =  "";
	$nuIdEstado		        =  "";
 
	 //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos Cargo
	 $sql = "select u.id, u.nombre, u.apellido1, u.apellido2, u.direccion, u.telefono, u.celular, u.email, u.fechancto, m.nombre, u.sexo, d.descripcion, c.descripcion, u.profesion, u.login,  p.descripcion, e.descripcion
			FROM usuario u, cargo c, perfil p, municipio m, estado e, dependencia d
			WHERE u.id = '$id'
			AND	u.cargo_id = c.id
			AND u.municipio_id = m.id
			AND u.estado_id = e.id
			AND u.dependencia_id = d.id
			AND u.perfil_id = p.id"; 
	 $result=mysqli_query($link,$sql);

	 
	while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
	
	{
	
	$sbIdUsuario			=  $row[0];
    $sbNombre        		=  $row[1];
	$sbApellido1        	=  $row[2];
	$sbApellido2        	=  $row[3];
	$sbDireccion        	=  $row[4];
	$sbTelefono        		=  $row[5];
	$sbCelular       		=  $row[6];
	$sbEmail        		=  $row[7];
	$sbFechaNacimiento 		=  $row[8];
	$nuIdCiudad    			=  $row[9];
	$sbSexo          		=  $row[10];
	$nuDependencia     		=  $row[11];
	$nuIdCargo        		=  $row[12];
	$sbProfesion        	=  $row[13];
	$sbLogin        		=  $row[14];
	$nuIdPerfil		        =  $row[15];
	$nuIdEstado		        =  $row[16];
	
	}
     
     mysqli_free_result ($result);


	 if($sbFechaNacimiento=='0000-00-00'){$sbFechaNacimiento='';}
	 
 $sbHtml ='


 
 <CENTER>
 
										 <H1><b>INFORMACION INGRESADA</b></H1>
									      
	 
   <form name="frmUsuarios" action="../../src/Usuario.php" method ="post"  onSubmit=  "validarIngreso(this)"  enctype="multipart/form-data">

					<TABLE align="center">
						<TR>
						<TD>
								


		<table>
			 <tr>
	            <td><b>
	               Cedula</b>
	            </td>
				<td><b>:</b></td>
	            <td>
				'.$sbIdUsuario .' 
	            </td>
	        </tr>
	        		
	        <tr>
	            <td><b>
	               Nombre</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbNombre.' '.$sbApellido1.' '.$sbApellido2.' 
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
	                	Telefono</b>
	                </td>
									<td><b>:</b></td>

	                <td>
	                     '.$sbTelefono.' 
	                </td>					
	            </tr>
	        <tr>				
	            <td><b>
	            	Celular</b>
	            </td>
	           	<td><b>:</b></td>
				<td>
	                 '.$sbCelular.' 
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
	           
			      </tr>
	        <tr>	
	      	
	            <td><b>
	            	Fecha Nacimiento</b>
	            </td>
																	<td><b>:</b></td>

	            <td>
	            '.$sbFechaNacimiento.' 
		</td>	
		
	        </tr>		
			  <tr>	
	      	
	            <td><b>
	            	Ciudad</b>
	            </td>
																	<td><b>:</b></td>

	            <td>
	            '.$nuIdCiudad.' 
		</td>	
		
	        </tr>		
			
			<tr>				
	          <td><b>
	            	Sexo
	            </b></td>
																	<td><b>:</b></td>

	          <td>
			    '.$sbSexo.' 
 	  	     </td>	
			    </tr>
	        <tr>	

	
				<td><b>
	            	Dependencia
	            </b></td>
																	<td><b>:</b></td>

	            <td>
					 '.$nuDependencia.' 
	            </td>	      
				</tr>
				<tr>
				<td><b>
	            	Cargo
	            </b></td>
																	<td><b>:</b></td>

	            <td>
					 '.$nuIdCargo.' 
	            </td>	            			 
	        </tr>
			
			<tr>
			<td><b>
	            	Profesion
	            </b></td>
																	<td><b>:</b></td>

	            <td>
					 '.$sbProfesion.' 
	            </td>	            			 
	        </tr>
		</table>
		
			</TD>
			</TR>
		<!--FIN DATOS GENERALES -->
		
		<TR>
		<TD>
		<br>
		<H3><B>Datos de Iniciar Sesion</B></H3>
		</TD>
		</TR>
		
		
		<!-- DATOS DE INICIAR DE SECION -->
		<TR>
		<TD>
		<table>
		<tr>				
	            <td><b>
	            	Longin</b>
	            </td>
				<td><b>:</b></td>

	            <td>
	               '.$sbLogin.' 
	            </td>	            
	       		    </tr>
	        <tr>	

	           
	       		
	            <td><b>
	            	Perfil</b>
	            </td>
				<td><b>:</b></td>
	            <td>
    	 '.$nuIdPerfil.' 
	            </td>	    
				</tr>	
				<tr>
				<td><b>
	            	Estado</b>
	            </td>
				<td><b>:</b></td>
	            <td>
    	 '.$nuIdEstado.' 
	            </td>	            
	        </tr>
			

			
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