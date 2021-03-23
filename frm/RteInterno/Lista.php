
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
    $sbEmail        	=  "";
	
	
		 $sql = "SELECT rti.id, d.descripcion, u.nombre, u.apellido1, u.apellido2, rti.email
			FROM remitentesinternos rti, dependencia d, usuario u, cargo c
			WHERE  rti.dependencia_id = d.id
			AND d.usuario_id = u.id
			AND u.cargo_id = c.id
			"; 
	 $result=mysqli_query($link,$sql);
			  	 
	 
$sbHtml='
	<script src="../../js/ListaRteInternos.js">
</script>
	
	
	 <form action="../../reportes/Usuario/Listado.php" method="post" name="listRteExternos" onSubmit= "validarIngreso(this)" enctype="multipart/form-data">
	  <Center><b><h1>LISTADO DE REMITENTES INTERNOS  </h1></b></Center>
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
			 	  	  
			<td width="256">
			<input name="txtDepedencia" type="text" id="txtDepedencia" style="width : 180px; "  onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listRteExternos";   
			$sbHtml.='); return false">
			</td>
			
			<td width ="226">
			<input name="txtResponsable" type="text" id="txtResponsable"  style="width :180px; " onkeyup = "BuscarLista(';  
			$sbHtml.="'BusquedaLista.php',listRteExternos";   
			$sbHtml.='); return false">
			</td>
			
			<td width="226">
			<input name="txtEmail" type="text" id="txtEmail"  style="width : 180px; " onkeyup = "BuscarLista(';  
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
			 <TH width="250">
			  <label>DEPENDENCIA</label>
 	  	     </TH>
			 <TH width="220">
			  <label>RESPONSABLE</label>
 	  	     </TH>
			 <TH width="220">
			  <label>EMAIL</label>
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
			
			
			$sbCodigo			=  $row[0];
			$sbDepencia     	=  $row[1];
			$sbNomResposable   	=  $row[2].' '.$row[3].' '.$row[4];
			$sbEmail        	=  $row[5];
	
			
			$sbHtml.='<tr align ="center" id = "ejemplo">';
			$sbHtml.='<td>'.$sbCodigo.'</td>';
			$sbHtml.='<td>'.$sbDepencia.'</td>';
			$sbHtml.='<td>'.$sbNomResposable.'</td>';
			$sbHtml.='<td>'.$sbEmail.'</td>';
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