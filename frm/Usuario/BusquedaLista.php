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
	$id 					=  "";
	$sbNombre        		=  "";	
	$sbApellidos        	=  "";
	$sbDependencia     		=  "";
	$sbNomCargo        		=  "";
	$sbLogin        		=  "";
	$sbEstado        		=  "";
	
	//SEPARA LA INFORMACION

	$infoSeparada		= explode ("-",$infoAgrupada);
	
	$_id 					=  $infoSeparada[0];
	$_sbNombre        		=  $infoSeparada[1];
	$_sbApellidos        	=  $infoSeparada[2];
	$_sbDependencia     	=  $infoSeparada[3];
	$_sbNomCargo        	=  $infoSeparada[4];
	$_sbLogin        		=  $infoSeparada[5];
	$_sbEstado        		=  $infoSeparada[6];
	 

		 //realiza consulta a la base de datos
	 $sql = "SELECT u.id, u.nombre, u.apellido1, u.apellido2, d.descripcion, c.descripcion, u.login, e.descripcion
			FROM usuario u, cargo c, dependencia d, estado e
			WHERE u.cargo_id = c.id
			AND u.dependencia_id = d.id
			AND u.estado_id = e.id
			AND u.id LIKE '%".$_id."%'
			AND u.nombre LIKE '%".$_sbNombre."%'
			AND u.apellido1 LIKE '%".$_sbApellidos."%'
			AND d.descripcion LIKE '%".$_sbDependencia."%'
			AND c.descripcion LIKE '%".$_sbNomCargo."%'
			AND u.login LIKE '%".$_sbLogin."%'
			AND e.descripcion LIKE '%".$_sbEstado."%'";
				 
	 $result=mysqli_query($link,$sql);
	
  	 
	 
$sbHtml='

		<table  align="center" >
			
		
			
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
		$sbApellidos        	=  $row[2] .' '.$row[3];
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
	';

echo $sbHtml;

?>
	