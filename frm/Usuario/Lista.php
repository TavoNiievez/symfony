
<?php include_once ("../../utils/SessionPhp.php"); ?>
<?php include_once("../../src/conexion.php");
//declaro variable

	
	 //Conexión con el servidor
	 $link=ConectarseServidor();
	 //Conexión con la base de datos
	 ConectarseBaseDatos($link);
	 
	 	 $sessionPerfil = getSession("Perfil");	

	
	 ?>
	 
<?php include("../../includes/top_pageForm.php"); ?>
<?php include("../../includes/headerForm.php"); ?>
<?php include("../../includes/menuForm.php"); ?>
<?php include("../../includes/subMenuForm.php"); ?>
<?php include("../../includes/validarSesion.php"); ?>


		
<?php
 
	//Declaro Variables
	$id 					=  "";
	$sbNombre        		=  "";	
	$sbApellidos        	=  "";
	$sbDependencia     		=  "";
	$sbNomCargo        		=  "";
	$sbLogin        		=  "";
	$sbEstado        		=  "";
	
		 $sql = "SELECT u.id, u.nombre, u.apellido1, u.apellido2,  d.descripcion, c.descripcion, u.login, e.descripcion
			FROM usuario u, cargo c, dependencia d, estado e
			WHERE u.cargo_id = c.id
			AND u.dependencia_id = d.id
			AND u.estado_id = e.id"; 
	 $result=mysqli_query($link,$sql);
			  	 
	 
$sbHtml='
	<script src="../../js/ListaUsuario.js">
</script>
	
	
	 <form action="../../reportes/Usuario/Listado.php" method="post" name="listUsuario" onSubmit= "validarIngreso(this)" enctype="multipart/form-data">
	  <Center><b><h1>LISTADO DE USUARIOS  </h1></b></Center>
	  <!-- Info General-->  
		<br>
		
				<div id=ConsultaLista>

		<table align ="center">
		
	<!-- //////////////////////////////// INICIO TITULOS/////////////////////////////////////////-->  
		 	<!-- Titulos de la Tabla-->	 
			 <tr align ="center">
			
						  <input name="txtAgrupacionInfoSQL" type="hidden" id="txtAgrupacionInfoSQL" size="20"  value="" ><br>

			<td width="118">
			<input name="txtId" type="text" id="txtId"   style="width : 90px;"  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listUsuario";   
			$sbHtml.='); return false">
			</td>
			 	  	  
			<td width="97">
			<input name="txtNombre" type="text" id="txtNombre" style="width : 90px; "  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listUsuario";   
			$sbHtml.='); return false">
			</td>
			
			<td width ="145">
			<input name="txtApellidos" type="text" id="txtApellidos"  style="width : 130px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listUsuario";   
			$sbHtml.='); return false">
			</td>
			
			<td width="175">
			<input name="txtDepeden" type="text" id="txtDepeden"  style="width : 140px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listUsuario";   
			$sbHtml.='); return false">
			</td> 
			
				<td width="147">
			<input name="txtCargo" type="text" id="txtCargo"  style="width : 75px;" onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listUsuario";   
			$sbHtml.='); return false">
			</td>
			
			
			<td width="68">
			<input name="txtLogin" type="text" id="txtLogin"  style="width : 45px;" onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listUsuario";   
			$sbHtml.='); return false">
			</td>
			
			<td width="55">
			<input name="txtEstado" type="text" id="txtEstado"  style="width : 45px;" onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listUsuario";   
			$sbHtml.='); return false">
			</td>
				<td width="">
			</td>
			
					
			
			</tr>
			</table   >

			</div>
			
				<div id=Listado>
			<table   align="center">
			 <tr>
			 
			 	
			
			 <TH width="112">
			  <label>IDENTIFICACION</label>
 	  	     </TH>
			 <TH width="90">
			  <label>NOMBRE</label>
 	  	     </TH>
			 <TH width="140">
			  <label>APELLIDOS</label>
 	  	     </TH>
			 <TH width="170">
			  <label>DEPENDENCIA</label>
 	  	     </TH>
			 <TH width="140">
			  <label>CARGO</label>
 	  	     </TH>
			 <TH width="40">
			  <label>LOGIN</label>
 	  	     </TH>
			 <TH width="40">
			  <label>ESTADO</label>
 	  	     </TH>
			 <TH width="32">
			  <label>VER</label>
 	  	     </TH>
			  <TH width="32">
			  <label>EDITAR</label>
 	  	     </TH>
  		     </tr>
			 			 
			 <!-- //////////////////////////////// FIN TITULOS/////////////////////////////////////////-->  
			
			
			
			
			';
		
			while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
			   	  
			//Asigno Variables
			
			
			$id						=  $row[0];
			$sbNombre        		=  $row[1];
			$sbApellidos        	=  $row[2].' '.$row[3];
			$sbDependencia     		=  $row[4];
			$sbNomCargo        		=  $row[5];
			$sbLogin        		=  $row[6];
			$sbEstado        		=  $row[7];
			
			$sbHtml.='<tr align ="center" id = "ejemplo">';
			$sbHtml.='<td>'.$id.'</td>';
			$sbHtml.='<td>'.$sbNombre.'</td>';
			$sbHtml.='<td>'.$sbApellidos.'</td>';
			$sbHtml.='<td>'.$sbDependencia.'</td>';
			$sbHtml.='<td>'.$sbNomCargo.'</td>';
			$sbHtml.='<td>'.$sbLogin.'</td>';
			$sbHtml.='<td>'.$sbEstado.'</td>';
			$sbHtml.='<td ><a href="Vista.php?id='.$id.'"><img src = "../../img/ver.png" ></a></td>';
			
			if($sessionPerfil == "1" || $sessionPerfil == "2" || $sessionPerfil == "11" ){
			
			$sbHtml.='<td><a href="Ingresar.php?id='.$id.'"><img src = "../../img/editar.png" ></a></td>';
			}
			else{

			$sbHtml.='<td><img src = "../../img/editar2.png" ></td>';
			}
	    
																
	 }
		         
			  //libera memoria
			  mysqli_free_result ($result);	
			  
			  
	$sbHtml.='
		</table>
	<br>
	</div>
	</form>	</div>
	
	
		
	
';

echo $sbHtml;

?>

<?php include("../../includes/footerForm.php");?>