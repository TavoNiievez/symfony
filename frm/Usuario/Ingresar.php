
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

	$nuModificar		= 0;
	 
	 //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos dependencia
	 $sqlDependencia = "select * from dependencia"; 
	 $resultDependencia =mysqli_query($link,$sqlDependencia);
	 
	  //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos estado
	 $sqlEstado = "select * from estado"; 
	 $resultEstado =mysqli_query($link,$sqlEstado);
	 
	 //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos Cargo
	 $sqlCargo = "select * from cargo"; 
	 $resultCargo=mysqli_query($link,$sqlCargo);

     //-----------------------------------------------------------------------------
	 //realiza consulta a la base de datos Ciudad
	 $sqlCiudad = "select * from municipio"; 
	 $resultCiudad=mysqli_query($link,$sqlCiudad);
		 
	 //-----------------------------------------------------------------------------
	 //realiza consulta a la base 	de datos Perfil
	 $sqlPerfil = "select id, descripcion from perfil order by descripcion"; 
	 $resultPerfil=mysqli_query($link, $sqlPerfil);

	 
	 	 //informacion para modificar
	 if($id != 0){
	 
	 
	 	 //realiza consulta a la base de datos
	 $sql = "select u.id, u.nombre, u.apellido1, u.apellido2, u.direccion, u.telefono, u.celular, u.email, u.fechancto, u.municipio_id, u.sexo, u.dependencia_id, u.cargo_id, u.profesion, u.login, u.perfil_id, u.estado_id
			FROM usuario u, cargo c, perfil p, municipio m, estado e, dependencia d
			WHERE u.id = '$id'
			"; 
	 $result=mysqli_query($link,$sql);
	 

  while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
			   	  
	//Asigno Variables

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
		         
	 //libera memoria
	mysqli_free_result ($result);	
	
	$idUsuario=$id;
	if($sbFechaNacimiento=='0000-00-00'){$sbFechaNacimiento='';}
	
	
	$nuModificar=1;
		 	 
	 }//finalizo el if para modificar
	 

 $sbHtml ='
<CENTER>
  <H1><b>REGISTRO DE USUARIOS</b></H1>
 
 
	 <script src="../../js/Usuarios.js"></script>
									
									      
	 
   <form name="frmUsuarios" action="../../src/IngresarUsuario.php" method ="post"  onSubmit="return validarIngreso(this)"  enctype="multipart/form-data">

					<TABLE align="center">
						<TR>
						<TD>
								


		<table>
			 <tr>
	            <td>
	               Cedula
	            </td>
				<td><b>:</b></td>
	            <td>
	                <input name="txtCedula" id ="txtCedula" type="text" value="'.$sbIdUsuario.'">
	            </td>
	        
	            <td>
	               Nombre
	            </td>
				<td><b>:</b></td>

	            <td>
	                <input name="txtNombre" id ="txtNombre" type="text" value="'.$sbNombre.'">
	            </td>
				
				</tr>
	        		
	        <tr>

	            <td>
	              Primer Apellido
                </td>
								<td><b>:</b></td>

	            <td>
	                <input name="txtApellido1" id ="txtApellido1" type="text" value="'.$sbApellido1.'">
	            </td>	 
				<td>
	              Segungo Apellido
                </td>
								<td><b>:</b></td>

	            <td>
	                <input name="txtApellido2" id ="txtApellido2" type="text" value="'.$sbApellido2.'">
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
	            	Celular
	            </td>
	           	<td><b>:</b></td>
				<td>
	                <input name="txtCelular"  id ="txtCelular" type="text"  onKeyPress="return onlyNumbers(event)" value="'.$sbCelular.'">
	            </td>	            
	       	
	            <td>
	            	Email
	            </td>
													<td><b>:</b></td>

	            <td>
	                <input name="txtEmail" id ="txtEmail" type="text" value="'.$sbEmail.'" >
	            </td>	            
	        </tr>
			<tr>				
	          
	      	
	            <td>
	            	Fecha Nacimiento
	            </td>
																	<td><b>:</b></td>

	            <td>
	               <input type="text" name="dtFechaNac"  id="dtFechaNac"  readonly value="'.$sbFechaNacimiento.'"> 
                   <img src="../../img/calendar.jpg" onclick="popUpCalendar(this, frmUsuarios.dtFechaNac,'; $sbHtml .="'yyyy-mm-dd'"; $sbHtml .=');">
				
	            </td>	

    <td>
	            	Ciudad
	            </td>
																	<td><b>:</b></td>

	            <td>
					<!--  AQUI SE LLENA EL SELECT CON CIUDAD-->
		';		
   			 // ------------------------------------------------------------
	 	    			
			   $sbHtml.= "<select name='cmbCiudad' id='cmbCiudad'>		
			   <option VALUE=''>Seleccionar</option>";
			    while($rowCiudad=mysqli_fetch_array($resultCiudad,MYSQLI_NUM))
			    {
				
				$sbHtml.="<option ";
				 
				 if($rowCiudad[0]==$nuIdCiudad){
				  $sbHtml.="selected";
				  } 
				  
				  $sbHtml.= " value=$rowCiudad[0]>";
				  $sbHtml.= $rowCiudad[1];
				  $sbHtml.="</option>";
			    }		
  		 	 				
		     
		    // ------------------------------------------------------------	
			
$sbHtml.='
		</td>	
		
	        </tr>		
			
			<tr>				
	          <td>
	            	Sexo
	            </td>
																	<td><b>:</b></td>

	          <td>
			   <select option name="cmbSexo" id="cmbSexo">
				  <option VALUE="">Seleccionar</option>';
				  
				  $sbHtml.="<option ";
				 if('Hombre'==$sbSexo){$sbHtml.="selected";}   
				  $sbHtml.= ' VALUE="Hombre">Hombre</option>';
				 
				 $sbHtml.="<option ";
				  if('Mujer'==$sbSexo){ $sbHtml.="selected"; } 
				  $sbHtml.= ' VALUE="Mujer">Mujer</option>
			   </select>
 	  	     </td>	
					
					<td>
	            	Profesion
	            </td>
	           	<td><b>:</b></td>
				<td>
	                <input name="txtProfesion"  id ="txtProfesion" type="text"   value="'.$sbProfesion.'">
	            </td>	
				

	        </tr>
			
			<tr>
							<td>
	            	Cargo
	            </td>
																	<td><b>:</b></td>

	            <td>
					<!--  AQUI SE LLENA EL SELECT CON CARGO	-->
		';		
   			 // ------------------------------------------------------------
	 	     			
			   $sbHtml.= "<select name='cmbCargo' id='cmbCargo'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowCargo=mysqli_fetch_array($resultCargo,MYSQLI_NUM))
			    {
				
			   	  $sbHtml.="<option ";
				 
				 if($rowCargo[0]==$nuIdCargo){
				  $sbHtml.="selected";
				  } 
				  
				  $sbHtml.= " value=$rowCargo[0]>";
				  $sbHtml.= $rowCargo[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultCargo);
		    // ------------------------------------------------------------	
$sbHtml.='	 
	            </td>	            			 
			 
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
				 
				 if($rowDependencia[0]==$nuDependencia){
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
	            	Estado
	            </td>
																	<td><b>:</b></td>

	            <td>
					<!--  AQUI SE LLENA EL SELECT CON Estado	-->
		';		
   			 // ------------------------------------------------------------
	 	     			
			   $sbHtml.= "<select name='cmbEstado' id='cmbEstado'>
			   				  <option VALUE=''>Seleccionar</option>
				";
			   
			    while($rowEstado=mysqli_fetch_array($resultEstado,MYSQLI_NUM))
			    {
				
			   	  $sbHtml.="<option ";
				 
				 if($rowEstado[0]==$nuIdEstado){
				  $sbHtml.="selected";
				  } 
				  
				  $sbHtml.= " value=$rowEstado[0]>";
				  $sbHtml.= $rowEstado[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultEstado);
		    // ------------------------------------------------------------	
$sbHtml.='	 
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
	            <td>
	            	Login
	            </td>
				<td><b>:</b></td>

	            <td>
	                <input name="txtLogin"   id ="txtLogin" type="text" value="'.$sbLogin.'">
	            </td>	            
	       		
	            <td>
	            	Clave 
	            </td>
				<td><b>:</b></td>
	            <td>
	                <input name="txtClave"  id ="txtClave"  type="password" value="'.$sbClave.'">
	            </td>	            
	        </tr>
			<tr>				
	            <td>
				Confirmar Clave
	            </td>
				<td><b>:</b></td>
	            <td>
	                <input name="txtClave2"  id ="txtClave2"  type="password" value="'.$sbClave.'">
	            </td>	            
	       		
	            <td>
	            	Perfil
	            </td>
				<td><b>:</b></td>
	            <td>
    	<!--  AQUI SE LLENA EL SELECT CON PERFIL-->
		';		
   			 // ------------------------------------------------------------
	 	       //libera memoria
			 mysqli_free_result ($resultCiudad);
			   $sbHtml.= "<select name='cmbPerfil' id='cmbPerfil'>				 
			   <option VALUE=''>Seleccionar</option>";
			    while($rowPerfil=mysqli_fetch_array($resultPerfil,MYSQLI_NUM))
			    {
			   	  $sbHtml.="<option ";
				 
				 if($rowPerfil[0]==$nuIdPerfil){
				  $sbHtml.="selected";
				  } 
				  
				  $sbHtml.= " value=$rowPerfil[0]>";
				  $sbHtml.= $rowPerfil[1];
				  $sbHtml.="</option>";
			    }		       
  
			  //libera memoria
			  mysqli_free_result ($resultPerfil);
		    // ------------------------------------------------------------	
			
$sbHtml.='
	            </td>	            
	        </tr>
			

			
			</table>
			
			</TD>
			</TR>
					<!-- fin DATOS DE INICIAR DE SECION -->

		  </TABLE>
		  
		  	<!-- Este input es para ver si es para modificar o para ingresar --> 
	 <input name="txtModificar" type="hidden" id="txtModificar"  value="'.$nuModificar.'" ><br>
		  
		  <br><br>
  				
 <input type="submit" name="btnIngresar" value="Ingresar">
		  <input type="reset" name="btnLimpiar" value="Limpiar">
	</center>	
	</form>
	';
echo  $sbHtml;
?>

<?php include("../../includes/footerForm.php");?>
