
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
	$sbTrd           		=  "";
	
	
		 $sql = "SELECT id_serie, descripcion, trd
			FROM subseries"; 
	 $result=mysqli_query($link,$sql);
			  	 
	 
$sbHtml='
	<script src="../../js/ListaSubSeries.js">
</script>
	
	
	 <form action="../../reportes/Usuario/Listado.php" method="post" name="listSubSeries" onSubmit= "validarIngreso(this)" enctype="multipart/form-data">
	  <Center><b><h1>LISTADO DE SERIES  </h1></b></Center>
	  <!-- Info General-->  
		<br>
		
				<div id=ConsultaListaMaestro>

		<table align ="center">
		
	<!-- //////////////////////////////// INICIO TITULOS/////////////////////////////////////////-->  
		 	<!-- Titulos de la Tabla-->	 
			 <tr align ="center">
			
						  <input name="txtAgrupacionInfoSQL" type="hidden" id="txtAgrupacionInfoSQL" size="20"  value="" ><br>

			<td width="106">
			<input name="txtCodigo" type="text" id="txtCodigo"   style="width :90px;"  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listSubSeries";   
			$sbHtml.='); return false">
			</td>
			 	  	  
			<td width="266">
			<input name="txtNombre" type="text" id="txtNombre" style="width : 220px; "  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listSubSeries";   
			$sbHtml.='); return false">
			</td>
			
			<td width="106">
			<input name="txtTrd" type="text" id="txtTrd" style="width : 90px; "  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listSubSeries";   
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
			 
			 	
			
			 <TH width="100">
			  <label>CODIGO</label>
 	  	     </TH>
			 <TH width="260">
			  <label>NOMBRE SERIE</label>
 	  	     </TH>
			  <TH width="100">
			  <label>TRD</label>
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
			$sbTrd	        		=  $row[2];
			
			
			$sbHtml.='<tr align ="center" id = "ejemplo">';
			$sbHtml.='<td>'.$sbCodigo.'</td>';
			$sbHtml.='<td>'.$sbNombre.'</td>';
			$sbHtml.='<td>'.$sbTrd.'</td>';
			if($sessionPerfil == "1" || $sessionPerfil == "2" || $sessionPerfil == "11" ){
			
			$sbHtml.='<td><a href="Ingresar.php?id='.$sbTrd.'"><img src = "../../img/editar.png" ></a></td>';
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