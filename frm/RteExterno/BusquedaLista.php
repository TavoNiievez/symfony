<?php include_once ("../../utils/SessionPhp.php"); ?>
<?php //Código para incluir las librerias
	 include_once("../../src/conexion.php");
	 //Conexión con el servidor
	 $link=ConectarseServidor();

	 //Conexión con la base de datosrecepcion
	 ConectarseBaseDatos($link);
 ?>	
 
<?php

	$sessionPerfil = getSession("Perfil");	
 
	//Declaro Variables
	$infoAgrupada 		= $_POST ['txtAgrupacionInfoSQL'];
	$sbCodigo				=  "";
    $sbNombre        		=  "";
	$sbRepresentate        	=  "";
	$sbCiudad    			=  "";
	
	
	//SEPARA LA INFORMACION

	$infoSeparada		= explode ("-",$infoAgrupada);
	
	$_sbCodigo				=  $infoSeparada[0];
    $_sbNombre        		=  $infoSeparada[1];
	$_sbRepresentate       	=  $infoSeparada[2];
	$_sbCiudad    			=  $infoSeparada[3];
	
	 

		 //realiza consulta a la base de datos
	 $sql = "SELECT rte.id, rte.nombre, rte.representante, rte.ciudad
			FROM remitentesexternos rte 
			WHERE rte.id LIKE '%".$_sbCodigo."%'
			AND rte.nombre LIKE '%".$_sbNombre."%'
			AND rte.representante LIKE '%".$_sbRepresentate."%'
			AND rte.ciudad LIKE '%".$_sbCiudad."%'";
				 
	 $result=mysqli_query($link,$sql);
	
  	 
	 
$sbHtml='

		<table  align="center" >
			
		
			
			 <tr>
			 <TH width="">
			  <label>CODIGO</label>
 	  	     </TH>
			 <TH width="">
			  <label>NOMBRE ENTIDAD</label>
 	  	     </TH>
			 <TH width="">
			  <label>REPRESENTANTE</label>
 	  	     </TH>
			 <TH width="">
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
		
			while($row=mysqli_fetch_array($result))
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
	';

echo $sbHtml;

?>
	