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
	$sbTrd            		=  "";
	
	//SEPARA LA INFORMACION

	$infoSeparada		= explode ("-",$infoAgrupada);
	
	$_sbCodigo				=  $infoSeparada[0];
    $_sbNombre        		=  $infoSeparada[1];
	$_sbTrd         		=  $infoSeparada[2];
	
	 

		 //realiza consulta a la base de datos
	 $sql = "SELECT id_serie, descripcion, trd
			FROM subseries
			WHERE id_serie LIKE '%".$_sbCodigo."%'
			AND descripcion LIKE '%".$_sbNombre."%'
			AND trd LIKE '%".$sbTrd."%'";
				 
	 $result=mysqli_query($link,$sql);
	
  	 
	 
$sbHtml='

		<table  align="center" >
			
		
			
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
			$sbTrd          		=  $row[2];
			
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
	';

echo $sbHtml;

?>
	