
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
	$sbCodigo			=  "";
    $sbDepencia     	=  "";
    $sbNomResposable   	=  "";
    $sbApeResposable   	=  "";
	
	
		 $sql = "SELECT d.id, d.descripcion, u.nombre, u.apellido1, u.apellido2
			FROM  dependencia d, usuario u
			WHERE   d.usuario_id = u.id
			"; 
	 $result=mysqli_query($link,$sql);
			  	 
	 
$sbHtml='
	<script src="../../js/ListaDependencias.js">
</script>
	
	
	 <form action="../../reportes/Usuario/Listado.php" method="post" name="listDependencias" onSubmit= "validarIngreso(this)" enctype="multipart/form-data">
	  <Center><b><h1>LISTADO DE DEPENDENCIAS  </h1></b></Center>
	  <!-- Info General-->  
		<br>
		
				<div id=ConsultaListaMaestro>

		<table align ="center">
		
	<!-- //////////////////////////////// INICIO TITULOS/////////////////////////////////////////-->  
		 	<!-- Titulos de la Tabla-->	 
			 <tr align ="center">
			
						  <input name="txtAgrupacionInfoSQL" type="hidden" id="txtAgrupacionInfoSQL" size="20"  value="" ><br>

			<td width="65">
			<input name="txtCodigo" type="text" id="txtCodigo"   style="width :60px;"  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listDependencias";   
			$sbHtml.='); return false">
			</td>
			 	  	  
			<td width="170">
			<input name="txtDepedencia" type="text" id="txtDepedencia" style="width : 130px; "  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listDependencias";   
			$sbHtml.='); return false">
			</td>
			
			<td width ="112">
			<input name="txtNombre" type="text" id="txtNombre"  style="width :90px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listDependencias";   
			$sbHtml.='); return false">
			</td>
			
			<td width="141">
			<input name="txtApellido" type="text" id="txtApellido"  style="width : 90px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listDependencias";   
			$sbHtml.='); return false">
			</td> 
			
				<td width="">
			</td>
			
					
			
			</tr>
			</table   >

			</div>
			
				<div id=ListadoMaestro>
			<table   align="center">
			 <tr>
			 
			 	
			
			 <TH width="60">
			  <label>CODIGO</label>
 	  	     </TH>
			 <TH width="170">
			  <label>DEPENDENCIA</label>
 	  	     </TH>
			 <TH width="110">
			  <label>NOMBRE RESP</label>
 	  	     </TH>
			 <TH width="140">
			  <label>APELLIDO RESP </label>
 	  	     </TH>
			 <TH width="">
			  <label>EDITAR</label>
 	  	     </TH>
  		     </tr>
			 			 
			 <!-- //////////////////////////////// FIN TITULOS/////////////////////////////////////////-->  
			
			
			
			
			';
		
			while($row=mysqli_fetch_array($result))
			    {
			   	  
			//Asigno Variables
			
			$sbCodigo			=  $row[0];
			$sbDepencia     	=  $row[1];
			$sbNomResposable   	=  $row[2];
			$sbApeResposable   	=  $row[3].' '.$row[4];
			
	
			
			$sbHtml.='<tr align ="center" id = "ejemplo">';
			$sbHtml.='<td>'.$sbCodigo.'</td>';
			$sbHtml.='<td>'.$sbDepencia.'</td>';
			$sbHtml.='<td>'.$sbNomResposable.'</td>';
			$sbHtml.='<td>'.$sbApeResposable.'</td>';	
			if($sessionPerfil == "1" || $sessionPerfil == "2" || $sessionPerfil == "11" ){
			
			$sbHtml.='<td><a href="Ingresar.php?id='.$sbCodigo.'"><img src = "../../img/editar.png" ></a></td>';
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