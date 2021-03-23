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
	//Declaro Variables
	$sbRadicado				=  "";
    $sbRadicadoInicial 		=  "";
	$sbRemitente			=  "";
	$sbCorrespondencia	 	=  "";
	$sbDestinatario		 	=  "";
	$nuFolios    			=  "";
	$sbFecha    			=  "";
	$sbHora	    			=  "";
	$sbArchivo				=  "";
	$sbVigencia				=  "";
	$sbRutaArchivo 			=  "";

	
	//SEPARA LA INFORMACION

	$infoSeparada		= explode ("-",$infoAgrupada);
	
    $_sbRadicado			=  $infoSeparada[0];
    $_sbRadicadoInicial 	=  $infoSeparada[1];
	$_sbRemitente			=  $infoSeparada[2];
	$_sbCorrespondencia	 	=  $infoSeparada[3];
	$_sbDestinatario		=  $infoSeparada[4];
	$_nuFolios    			=  $infoSeparada[5];
	$_sbFecha    			=  $infoSeparada[6];
	$_sbHora	    		=  $infoSeparada[7];
	$_sbVigencia    		=  $infoSeparada[8];
	
	 

		 //realiza consulta a la base de datos
	 $sql= "SELECT le.radicado, le.radicadoinicial, le.remitenteinterno, le.correspondencia, le.destinatario, le.folios, le.fecha, le.hora
		FROM list_enviada le
		WHERE le.radicado LIKE '%".$_sbRadicado."%'
		AND le.radicadoinicial LIKE '%".$_sbRadicadoInicial."%'
		AND  le.remitenteinterno LIKE '%".$_sbRemitente."%'
		AND le.correspondencia LIKE '%".$_sbCorrespondencia."%'
		AND le.destinatario LIKE '%".$_sbDestinatario."%'
		AND le.folios LIKE '%".$_nuFolios."%'
		AND le.fecha LIKE '%".$_sbFecha."%'
		AND le.hora LIKE '%".$_sbHora."%'";
		if ($_sbVigencia != ''){
		$sql.="AND le.fecha >= '".$_sbVigencia."-01-01'
		AND le.fecha <= '".$_sbVigencia."-12-31'";
		}
		$sql.="ORDER BY  le.fecha DESC, le.radicado DESC ";
				 
	 $result=mysqli_query($link,$sql);
	
  	 
	 
$sbHtml='

		<table  align="center" >
			
		
			
			 <tr>
			  	
			 
			 <TH width="67">
			  <label>RADICADO</label>
 	  	     </TH>
			 <TH width="67">
			  <label>R/INICIAL</label>
 	  	     </TH>
			 <TH width="130">
			  <label>REMITENTE</label>
 	  	     </TH>
			 <TH width="97">
			  <label>DESTINATARIO</label>
 	  	     </TH>
			 <TH width="176">
			  <label>ENTIDAD/DEPENDENCIA</label>
 	  	     </TH>
			  <TH width="54">
			  <label>FOLIOS</label>
 	  	     </TH>
			 <TH width="68">
			  <label>FECHA</label>
 	  	     </TH>
			 <TH width="53">
			  <label>HORA</label>
 	  	     </TH>
			 <th>
			 <label>VER</label>
 	  	     </TH>
			  <TH width="">
			  <label>DESCARGAR</label>
 	  	     </TH>
  		     </tr>
			 			 
			 <!-- //////////////////////////////// FIN TITULOS/////////////////////////////////////////-->  
			
			
			
			
			';
		
			while($row=mysqli_fetch_array($result))
			    {
			   	  
			//Asigno Variables
			
			
			$sbRadicado				=  $row[0];
			$sbRadicadoInicial 		=  $row[1];
			$sbRemitente			=  $row[2];
			$sbCorrespondencia	 	=  $row[3];
			$sbDestinatario		 	=  $row[4];
			$nuFolios    			=  $row[5];
			$sbFecha    			=  $row[6];
			$sbHora	    			=  $row[7];
			
			
			$sqlArchivo = "SELECT ce.archivo, ss.trd
			FROM c_enviada ce, subseries ss
			WHERE ce.radicado = '$sbRadicado'
			AND ce.subseries_id = ss.id";
			
			$resultArchivo =mysqli_query($link,$sqlArchivo);
			$rowArchivo =mysqli_fetch_array($resultArchivo,MYSQLI_NUM);
			$sbArchivo = $rowArchivo[0]; 
			$sbTrd      = $rowArchivo[1];
			$sbSerie	= explode("-", $sbTrd);
			$sbSubSerie	= explode(".", $sbTrd);
			$sbAdicionalDestino	= "";
						
						
			$sbHtml.='<tr align ="center" id = "ejemplo">';
			$sbHtml.='<td>'.$sbRadicado.'</td>';
			$sbHtml.='<td>'.$sbRadicadoInicial.'</td>';
			$sbHtml.='<td>'.$sbRemitente.'</td>';
			$sbHtml.='<td>'.$sbCorrespondencia.'</td>';
			$sbHtml.='<td>'.$sbDestinatario.'</td>';
			$sbHtml.='<td>'.$nuFolios.'</td>';
			$sbHtml.='<td>'.$sbFecha.'</td>';
			$sbHtml.='<td>'.$sbHora.'</td>';
			$sbHtml.='<td ><a href="Vista.php?id='.$sbRadicado.'"><img src = "../../img/ver.png" ></a></td>';
			
			/*if($sessionPerfil == "1" || $sessionPerfil == "2" || $sessionPerfil == "11" ){
			
			$sbHtml.='<td><a href="Ingresar.php?id='.$sbRadicado.'"><img src = "../../img/editar.png" ></a></td>';
			}
			else{

			$sbHtml.='<td><img src = "../../img/editar2.png" ></td>';
			}
*/
			if(strlen($sbTrd)>7){$sbAdicionalDestino= $sbTrd."/";}	

			if($sbArchivo != ""){$sbRutaArchivo ='../../archivos/'.$sbSerie[0].'/'.$sbSubSerie[0].'/'.$sbAdicionalDestino.$sbArchivo;}
			
			//$sbHtml.='<td><a href="../../archivos/'.$sbSerie[0].'/'.$sbSubSerie[0].'/'.$sbAdicionalDestino.$sbArchivo.'"><img src = "../../img/descargar.png" ></a></td></tr>';
	    	
			$sbHtml.='<td><a href="'.$sbRutaArchivo.'"><img src = "../../img/descargar.png" ></a></td></tr>';

			
	    
																
	 }
		         
			  //libera memoria
			  mysqli_free_result ($result);	
			  
	$sbHtml.='
		</table>
	';

echo $sbHtml;

?>
	