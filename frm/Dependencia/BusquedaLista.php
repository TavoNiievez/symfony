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
    $sbApeResposable   	=  "";
	
	//SEPARA LA INFORMACION

	$infoSeparada		= explode ("-",$infoAgrupada);
	
	$_sbCodigo				=  $infoSeparada[0];
    $_sbDepencia      		=  $infoSeparada[1];
	$_sbNomResposable      	=  $infoSeparada[2];
	$_sbApeResposable 		=  $infoSeparada[3];
	
	 

		 //realiza consulta a la base de datos
	 $sql = "SELECT d.id, d.descripcion, u.nombre, u.apellido1, u.apellido2
			FROM  dependencia d, usuario u
			WHERE   d.usuario_id = u.id
			AND d.usuario_id = u.id
			AND d.id LIKE '%".$_sbCodigo."%'
			AND d.descripcion LIKE '%".$_sbDepencia."%'
			AND u.nombre LIKE '%".$_sbNomResposable."%'
			AND u.apellido1 LIKE '%".$_sbApeResposable."%'";
				 
	 $result=mysqli_query($link,$sql);
	
  	 
	 
$sbHtml='

		<table  align="center" >
			
		
			
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
	';

echo $sbHtml;

?>
	