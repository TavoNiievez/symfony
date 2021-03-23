
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
	$sbCodigo				=  "";
    $sbNombre        		=  "";
	$sbRepresentate        	=  "";
	$sbCiudad    			=  "";
	
	
		 $sql = "SELECT rte.id, rte.nombre, rte.representante, rte.ciudad
			FROM remitentesexternos rte "; 
	 $result=mysqli_query($link,$sql);
			  	 
	 
$sbHtml='
	<script src="../../js/ListaRteExternos.js">
</script>
	
	
	 <form action="../../reportes/Usuario/Listado.php" method="post" name="listRteExternos" onSubmit= "validarIngreso(this)" enctype="multipart/form-data">
	  <Center><b><h1>LISTADO DE REMITENTES EXTERNOS  </h1></b></Center>
	  <!-- Info General-->  
		<br>
		
				<div id=ConsultaLista>

		<table align ="center">
		
	<!-- //////////////////////////////// INICIO TITULOS/////////////////////////////////////////-->  
		 	<!-- Titulos de la Tabla-->	 
			 <tr align ="center">
			
						  <input name="txtAgrupacionInfoSQL" type="hidden" id="txtAgrupacionInfoSQL" size="20"  value="" ><br>

			<td width="96">
			<input name="txtCodigo" type="text" id="txtCodigo"   style="width :90px;"  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listRteExternos";   
			$sbHtml.='); return false">
			</td>
			 	  	  
			<td width="306">
			<input name="txtNombre" type="text" id="txtNombre" style="width : 180px; "  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listRteExternos";   
			$sbHtml.='); return false">
			</td>
			
			<td width ="275">
			<input name="txtRepresentante" type="text" id="txtRepresentante"  style="width :180px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listRteExternos";   
			$sbHtml.='); return false">
			</td>
			
			<td width="126">
			<input name="txtCiudad" type="text" id="txtCiudad"  style="width : 110px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listRteExternos";   
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
			 
			 	
			
			 <TH width="90">
			  <label>CODIGO</label>
 	  	     </TH>
			 <TH width="300">
			  <label>NOMBRE ENTIDAD</label>
 	  	     </TH>
			 <TH width="270">
			  <label>REPRESENTANTE</label>
 	  	     </TH>
			 <TH width="120">
			  <label>CIUDAD</label>
 	  	     </TH>
			 <th>
			 <label>VER</label>
 	  	     </TH>
			  <TH width="">
			  <label>EDITAR</label>
 	  	     </TH>
  		     </tr>
			 			 
			 <!-- //////////////////////////////// FIN TITULOS/////////////////////////////////////////-->  
			
			
			
			
			';
		
			while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
			   	  
			//Asigno Variables
			
			
			$sbCodigo				=  $row[0];
			$sbNombre        		=  $row[1];
			$sbRepresentate        	=  $row[2];
			$sbCiudad    			=  $row[3];
	
			
			$sbHtml.='<tr align ="center" id = "ejemplo">';
			$sbHtml.='<td>'.$sbCodigo.'</td>';
			$sbHtml.='<td>'.$sbNombre.'</td>';
			$sbHtml.='<td>'.$sbRepresentate.'</td>';
			$sbHtml.='<td>'.$sbCiudad.'</td>';
			$sbHtml.='<td ><a href="Vista.php?id='.$sbCodigo.'"><img src = "../../img/ver.png" ></a></td>';
			
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