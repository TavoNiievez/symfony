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
	$sbRadicado				=  "";
    $sbRemitente       		=  "";
	$sbDestinatorio		 	=  "";
	$nuFolios    			=  "";
	$sbFecha    			=  "";
	$sbHora	    			=  "";
	$sbArchivo    			=  "";
	$nuRemitente_id 		=  "";
	$nuRemitente_ext_int	=  "";
	$sbEntidad_dependencia 	=  "";
	
	//SEPARA LA INFORMACION

	$infoSeparada		= explode ("-",$infoAgrupada);
	
    $_sbRadicado				=  $infoSeparada[0];
    $_sbRemitente       		=  $infoSeparada[1];
	$_sbEntidad_dependencia	 	=  $infoSeparada[2];
	$_sbDestinatorio		 	=  $infoSeparada[3];
	$_nuFolios    				=  $infoSeparada[4];
	$_sbFecha	    			=  $infoSeparada[5];
	$_sbHora	    			=  $infoSeparada[6];
	$_sbVigencia    			=  $infoSeparada[7];

	

		 //realiza consulta a la base de datos
	 $sql= "SELECT lr.radicado, lr.remitente, lr.entidad, lr.destinatario, lr.folios, lr.fecha, lr.hora
			FROM list_recibida lr
			WHERE lr.radicado LIKE '%".$_sbRadicado."%'
			AND lr.remitente LIKE '%".$_sbRemitente."%'
			AND lr.entidad LIKE '%".$_sbEntidad_dependencia."%'
			AND lr.destinatario LIKE '%".$_sbDestinatorio."%'
			AND lr.folios LIKE '%".$_nuFolios."%'
			AND lr.fecha LIKE '%".$_sbFecha."%'
			AND lr.hora LIKE '%".$_sbHora."%'";
			if ($_sbVigencia != ''){
			$sql.="AND lr.fecha >= '".$_sbVigencia."-01-01'
			AND lr.fecha <= '".$_sbVigencia."-12-31'";
			}
			$sql.="ORDER BY  lr.fecha DESC, lr.radicado DESC  ";
				 
	 $result=mysqli_query($link,$sql);
	
  	 
	 
$sbHtml='

		<table  align="center" >
			
		
			
			 <tr>
			  <TH width="70">
			  <label>RADICADO</label>
 	  	     </TH>
			 <TH width="80">
			  <label>REMITENTES</label>
 	  	     </TH>
			 <TH width="210">
			  <label>ENTIDAD/DEPENDECIA</label>
 	  	     </TH>
			 <TH width="210">
			  <label>DESTINATARIO</label>
 	  	     </TH>  
			 </TH>
			 <TH width="50">
			  <label>FOLIOS</label>
 	  	     </TH>
			 <TH width="60">
			  <label>FECHA</label>
 	  	     </TH> 
			 <TH width="60">
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
			$sbRemitente       		=  $row[1];
			$sbEntidad_dependencia 	=  $row[2];
			$sbDestinatorio		 	=  $row[3];
			$nuFolios    			=  $row[4];
			$sbFecha			 	=  $row[5];
			$sbHora				 	=  $row[6];
	
		
			$sqlArchivo = "SELECT cr.archivo,  cr.destinatario_id
			FROM c_recibida cr
			WHERE cr.radicado = '$sbRadicado'";
			
			$resultArchivo =mysqli_query($link,$sqlArchivo);
			$rowArchivo =mysqli_fetch_array($resultArchivo,MYSQLI_NUM);
			$sbArchivo = $rowArchivo[0];
			$sbDestinoArch      = $rowArchivo[1];
			
			
			$sbHtml.='<tr align ="center" id = "ejemplo">';
			$sbHtml.='<td>'.$sbRadicado.'</td>';
			$sbHtml.='<td>'.$sbRemitente.'</td>';
			$sbHtml.='<td>'.$sbEntidad_dependencia.'</td>';
			$sbHtml.='<td>'.$sbDestinatorio.'</td>';
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
			$sbHtml.='<td><a href="../../archivos/'.$sbDestinoArch.'/'.$sbArchivo.'"><img src = "../../img/descargar.png" ></a></td></tr>';

	    
																
	 }
		         
			  //libera memoria
			  mysqli_free_result ($result);	
			  
			  
			  
			  
	$sbHtml.='
		</table>
	';

echo $sbHtml;

?>
	