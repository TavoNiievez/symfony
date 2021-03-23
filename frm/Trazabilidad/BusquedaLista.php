<?php include_once ("../../utils/Utils.php"); ?>
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
    $sbRemitente       		=  "";
    $sbDocumento       		=  "";
    $sbTermino       		=  "";
	$sbEntidad_dependencia 	=  "";
	$sbDestinatorio		 	=  "";
	$sbFecha			 	=  "";
	$sbEstado			 	=  "";
	
	$sbFechaActual			=  "";
	
	//SEPARA LA INFORMACION

	$infoSeparada		= explode ("-",$infoAgrupada);
	
    $_sbRadicado				=  $infoSeparada[0];
    $_sbRemitente       		=  $infoSeparada[1];
	$_sbDocumento			 	=  $infoSeparada[2];
	$_sbTermino				 	=  $infoSeparada[3];
	$_sbEntidad_dependencia		=  $infoSeparada[4];
	$_sbDestinatorio   			=  $infoSeparada[5];
	$_sbFecha	    			=  $infoSeparada[6];
	
	 

		 //realiza consulta a la base de datos
	 $sql= "SELECT lr.radicado, lr.remitente, doc.descripcion, lr.termino, lr.entidad, lr.destinatario,  lr.fecha, cr.estado_id
			FROM list_recibida lr, documentos doc, c_recibida cr 
			WHERE lr.documento_id = doc.id
			AND	lr.radicado = cr.radicado
			AND (lr.documento_id = 1 OR lr.documento_id = 2 OR lr.documento_id = 5 OR lr.documento_id = 6)
			AND lr.radicado LIKE '%".$_sbRadicado."%'
			AND lr.remitente LIKE '%".$_sbRemitente."%'
			AND doc.descripcion LIKE '%".$_sbDocumento."%'
			AND lr.termino LIKE '%".$_sbTermino."%'
			AND lr.entidad LIKE '%".$_sbEntidad_dependencia."%'
			AND lr.destinatario LIKE '%".$_sbDestinatorio."%'
			AND lr.fecha LIKE '%".$_sbFecha."%'
			ORDER BY cr.estado_id DESC, lr.termino ASC ";
				 
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
			  <TH width="110">
			  <label>DOCUMENTO</label>
 	  	     </TH>
			  <TH width="80">
			  <label>TERMINO DOC.</label>
 	  	     </TH>
			 <TH width="239">
			  <label>ENTIDAD/DEPENDECIA</label>
 	  	     </TH>
			 <TH width="99">
			  <label>DESTINATARIO</label>
 	  	     </TH>  
			 <TH width="71">
			  <label>FECHA</label>

			 </TH>
			
			 <TH width="70">
			  <label>ESTADO</label>
 	  	     </TH> 

			 <th>
			 <label>VER</label>
 	  	     </TH>
			     </tr>
			 			 
			 <!-- //////////////////////////////// FIN TITULOS/////////////////////////////////////////-->  
			
			
			
			
			';
			
			$sbFechaActualSistema = getFechaActual();
		
			while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
				  
			//Declaro Variables
			$sbEstadoReal 	= "";
			$dtFechaActual 	= "";
			$dtFechaTermino = "";
			$sbTextoDias	= "";
			$diasFaltantes	= "";
			
			
			//Asigno Variables
			$sbRadicado				=  $row[0];
			$sbRemitente       		=  $row[1];
			$sbDocumento       		=  $row[2];
			$sbTermino       		=  $row[3];
			$sbEntidad_dependencia 	=  $row[4];
			$sbDestinatorio		 	=  $row[5];
			$sbFecha			 	=  $row[6];
			$sbEstado			 	=  $row[7];
	
			if($sbEstado == 0){
			
			$sbEstadoReal = "Tramitado";
			$diasFaltantes = 5;
			
			}else{
			//converite a formato dia.-mes-año
			$dtFechaActual = cambiarFormatoFecha($sbFechaActualSistema);
			$dtFechaTermino = cambiarFormatoFecha($sbTermino);
			
			 //obtiene dias faltantes para vencimiento de queja
			 $diasFaltantes = restaFechas($dtFechaActual,$dtFechaTermino);
			 
			 //valida si es un dia para el texto en singular		
			if ($diasFaltantes ==1){
			  $sbTextoDias = " dia";
			}
			else{
			     $sbTextoDias = " dias";
			}	

			//si faltan menos de 2 dias sale en rojo
			
			 $sbEstadoReal = $diasFaltantes.$sbTextoDias;			   
		   			
		
			}	  
	
			$sqlArchivo = "SELECT cr.archivo
			FROM c_recibida cr
			WHERE cr.radicado = '$sbRadicado'";
			
			$resultArchivo =mysqli_query($link,$sqlArchivo);
			$rowArchivo =mysqli_fetch_array($resultArchivo,MYSQLI_NUM);
			$sbArchivo = $rowArchivo[0]; 
			
			$sbHtml.='<tr align ="center" id = "ejemplo">';
			$sbHtml.='<td>'.$sbRadicado.'</td>';
			$sbHtml.='<td>'.$sbRemitente.'</td>';
			$sbHtml.='<td>'.$sbDocumento.'</td>';
			$sbHtml.='<td>'.$sbTermino.'</td>';
			$sbHtml.='<td>'.$sbEntidad_dependencia.'</td>';
			$sbHtml.='<td bgcolor="#FC484B">'.$sbDestinatorio.'</td>';
			$sbHtml.='<td>'.$sbFecha.'</td>';
			if ($diasFaltantes <= 2 ){
			$sbHtml.='<td id ="Alerta"><b>'.$sbEstadoReal.'</b></td>';
			}else{
			$sbHtml.='<td>'.$sbEstadoReal.'</td>';
			}
			
			$sbHtml.='<td ><a href="Vista.php?id='.$sbRadicado.'"><img src = "../../img/ver.png" ></a></td></tr>';

	    
																
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

