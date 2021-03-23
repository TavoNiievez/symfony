<?php

 //Código para incluir las librerias
 include_once("../../src/conexion.php");
 include('../../src/MyFPDF_Sticker.php');

 //Declaro Variables
	$id						= $_REQUEST["txtRadicado"];
	$sbRadicado_ce 			=  "";
	$sbRadicadoInicial_ce	=  "";
	$sbRemitenteInterno_ce	=  "";
	$sbAsunto_ce			=  "";
	$sbFolio_ce	   			=  "";
	$sbFecha_ce	   			=  "";
	$sbHora_ce				=  "";
	$nuRemitente_id_ce 		=  "";
	$nuRemitente_ext_int_ce	=  "";
	$sbNomDestinatario_ce	=  "";
	$sbTRD_ce	=  "";
	
 //Conexión con el servidor
  $link=ConectarseServidor();

 //Conexión con la base de datos
  ConectarseBaseDatos($link);

 //realiza consulta a la base de datos
 $sql = "SELECT ce.radicado, ce.radicadoinicial, d.descripcion, ce.asunto, ce.folios, ce.fecha, ce.hora, ce.destinatario_id, ce.destinatario_ext_int, ss.trd
			FROM c_enviada ce, dependencia d, remitentesinternos rti, mediorecepcion md, usuario u, subseries ss  
			WHERE ce.radicado ='$id'
			AND ce.remitente_int = rti.id
			AND rti.dependencia_id = d.id
			and ce.subseries_id = ss.id
			";
     
  $result=mysqli_query($link,$sql);
  
  while ($row = mysqli_fetch_array($result)){
  
	$sbRadicado_ce 			=  $row[0]; 
	$sbRadicadoInicial_ce	=  $row[1]; 
	$sbRemitenteInterno_ce	=  $row[2]; 
	$sbAsunto_ce			=  $row[3]; 
	$sbFolio_ce	   			=  $row[4]; 
	$sbFecha_ce	   			=  $row[5]; 
	$sbHora_ce				=  $row[6]; 
	$nuRemitente_id_ce 		=  $row[7]; 
	$nuRemitente_ext_int_ce	=  $row[8]; 
	$sbTRD_ce	=  $row[9]; 
	
	
	if($nuRemitente_id_ce == 1){
			
				$sqlExtInt = "SELECT rte.nombre
			FROM remitentesexternos rte
			WHERE rte.id = $nuRemitente_ext_int_ce
			"; 
			
			$resultInformacion =mysqli_query($link,$sqlExtInt);
			$rowInfo=mysqli_fetch_array($resultInformacion,MYSQLI_NUM);
			$sbNomDestinatario_ce	= $rowInfo[0];  
			
			}
			
			if($nuRemitente_id_ce == 2){
				$sqlExtInt = "SELECT d.descripcion
				FROM remitentesinternos rti, dependencia d, usuario u
				WHERE rti.id = $nuRemitente_ext_int_ce
				AND rti.dependencia_id = d.id
				AND d.usuario_id = u.id
				"; 
				$resultInformacion = mysqli_query($link,$sqlExtInt);
				$rowInfo=mysqli_fetch_array($resultInformacion);
				$sbNomDestinatario_ce = $rowInfo[0];  
			}
			
		}
     
     mysqli_free_result ($result);
			
 
 /*////////////////////////////////////////////////////////
			FIN INFORMACION DE RADICACION INICIAL
	 /////////////////////////////////////////////////////////*/
	 
	 	 //realiza consulta a la base de datos
	 $sqlRadicadoInicial = "SELECT cr.radicado, r.descripcion, d.descripcion, u.nombre, u.apellido1, u.apellido2,  cr.folio,  mr.descripcion, cr.asunto, cr.archivo, cr.remitente_id, cr.remitente_ext_int, cr.usuario_id
			FROM c_recibida cr, remitente r, remitentesinternos rti, dependencia d, usuario u, mediorecepcion mr
			WHERE cr.radicado = '$sbRadicadoInicial_ce' 
			AND cr.remitente_id = r.id
			AND cr.destinatario_id = rti.id
			AND rti.dependencia_id = d.id
			AND d.usuario_id = u.id
			AND cr.medio_id = mr.id
			";

				 
	 $resultRadicadoInicial=mysqli_query($link,$sqlRadicadoInicial);
	
	
	 	while ($row = mysqli_fetch_array($resultRadicadoInicial,MYSQLI_NUM))
	
	{
	
    $sbRadicado					=   $row[0];
    $sbRemitente       			=   $row[1];
	$sbDestinatorio		 		=   $row[2];
	$sbReponsableDestinatario	=   $row[3].' '.$row[4].' '.$row[5];
	$nuFolios    				=   $row[6];
	$sbMedio    				=   $row[7];
	$sbAsunto    				=   $row[8];
	$sbArchivo    				=   $row[9];
	$nuRemitente_id 			=   $row[10];
	$nuRemitente_ext_int		=   $row[11];
	$nuUsuarioID				=   $row[12];
	
	
	if($nuRemitente_id == 1){
			
			$sqlExtInt = "SELECT rte.nombre
			FROM remitentesexternos rte
			WHERE rte.id = $nuRemitente_ext_int
			"; 
			
			$resultInformacion =mysqli_query($link,$sqlExtInt);
			$rowInfo=mysqli_fetch_array($resultInformacion,MYSQLI_NUM);
			$sbNomRemitente		 		= $rowInfo[0];  
			
			}
			
			if($nuRemitente_id == 2){
			$sqlExtInt = "SELECT d.descripcion
			FROM remitentesinternos rti, dependencia d, usuario u
			WHERE rti.id = $nuRemitente_ext_int
			AND rti.dependencia_id = d.id
			AND d.usuario_id = u.id
			"; 
			$resultInformacion =mysqli_query($link,$sqlExtInt);
			$rowInfo=mysqli_fetch_array($resultInformacion,MYSQLI_NUM);
			$sbNomRemitente		 		= $rowInfo[0];  
			}
	
			
		
	
	}
     
     mysqli_free_result ($resultRadicadoInicial);
	
	 /*////////////////////////////////////////////////////////
			FIN INFORMACION DE RADICACION INICIAL
	 /////////////////////////////////////////////////////////*/

   //inclusión de rutinas para crear informes PDF
   $pdf=new MyFPDF('L','cm',array(3.3,10));
   $pdf->AddPage('L');
   $pdf->SetFont('Arial','B',7);
	$pdf->Cell(0,0,'',0,1,'C'); 
	$pdf->Cell(0,0.35,'PARTIDO DE LA U',0,1,'C');
	$pdf->Cell(0,0.2,'VENTANILLA UNICA',0,1,'C');
	$pdf->Cell(1.9,0.5,'',0,0,'C');
	$pdf->Cell(2.9,0.5,'Radicado : '.$sbRadicado_ce,0,0,'L');
	$pdf->Cell(1.7,0.5,'     Folios : '.$sbFolio_ce,0,0,'L');
	$pdf->Cell(1,0.5,'TRD : '.$sbTRD_ce,0,1,'L');
	/*$pdf->Cell(1.2,0.5,'',0,0,'C');
	$pdf->Cell(1.5,0.5,'  R / Inicial : '.$sbRadicadoInicial_ce,0,1,'L');*/
  
  $pdf->Cell(1.6,0.3,'Remitente :',0,0,'L');
  $pdf->Cell(6.6,0.3,$sbRemitenteInterno_ce,0,1,'L');
  $pdf->Cell(1.6,0.3,'Destinatario :',0,0,'L');
  $pdf->Cell(6.6,0.3,$sbNomDestinatario_ce,0,1,'L');
  $pdf->Cell(1.6,0.3,'Asunto :',0,0,'L');
  $pdf->Cell(1.6,0.3,$sbAsunto_ce,0,1,'L');
  $pdf->Cell(2.5,0.5,'Fecha :  '.$sbFecha_ce,0,0,'L');
  $pdf->Cell(1,0.5,'Hora :  '.$sbHora_ce,0,0,'L');
  $pdf->Cell(1.5,0.5,'',0,1,'L');
  
  

    
 //genera el PDF en el Navegador
	$pdf->Output();  
	//generar reporte por ruta
   //$pdf->Output('Listado Estudios al Comite.pdf','D'); 
  
  $sbCadena =  "<script language='javascript'>";
          $sbCadena .= "alert(  'Se genero el Sticker' )";
     	  $sbCadena .= "</script>";
     	  echo $sbCadena;
  
  //retorna a la pagina anterior
   $sbCadena = '<script>window.history.back();</script>';
  echo $sbCadena;    
?>