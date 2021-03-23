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
	$sbCodigo			=  "";
    $sbDepencia     	=  "";
    $sbNomResposable   	=  "";
    $sbEmail        	=  "";
	
	
	//SEPARA LA INFORMACION

	$infoSeparada		= explode ("-",$infoAgrupada);
	
	$_sbCodigo				=  $infoSeparada[0];
    $_sbDepencia       		=  $infoSeparada[1];
	$_sbNomResposable      	=  $infoSeparada[2];
	$_sbEmail      			=  $infoSeparada[3];
	
	 

		 //realiza consulta a la base de datos
	 $sql = "SELECT rti.id, d.descripcion, u.nombre, u.apellido1, u.apellido2, rti.email
			FROM remitentesinternos rti, dependencia d, usuario u, cargo c
			WHERE  rti.dependencia_id = d.id
			AND d.usuario_id = u.id
			AND u.cargo_id = c.id
			AND rti.id LIKE '%".$_sbCodigo."%'
			AND d.descripcion LIKE '%".$_sbDepencia."%'
			AND u.nombre LIKE '%".$_sbNomResposable."%'
			AND rti.email LIKE '%".$_sbEmail."%'";
				 
	 $result=mysqli_query($link,$sql);
	
  	 
	 
$sbHtml='

		<table  align="center" >
			
		
			
			 <tr>
			 <TH width="90">
			  <label>CODIGO</label>
 	  	     </TH>
			 <TH width="">
			  <label>DEPENDENCIA</label>
 	  	     </TH>
			 <TH width="">
			  <label>RESPONSABLE</label>
 	  	     </TH>
			 <TH width="">
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
	';

echo $sbHtml;

?>
	