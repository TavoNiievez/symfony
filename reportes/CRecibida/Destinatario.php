<?php

 //Código para incluir las librerias
 include_once("../../src/conexion.php");
 include('../../src/MyFPDF.php');

  //Conexión con el servidor
  $link=ConectarseServidor();

 //Conexión con la base de datos
  ConectarseBaseDatos($link);
  
	//recupero variabkes
	$nuDestinatario		= $_REQUEST["cmbDestinatario"];
	$sbFechaInicial		= $_REQUEST["dtFechaInicial"];
	$sbFechaFinal		= $_REQUEST["dtFechaFinal"];
	
	//Declaro Variables
	$sbRadicado				=  "";
    $sbRemitente       		=  "";
	$sbDestinatorio		 	=  "";
	$nuFolios    			=  "";
	$sbVigencia    			=  "";
	$sbArchivo    			=  "";
	$nuRemitente_id 		=  "";
	$nuRemitente_ext_int	=  "";
	$sbEntidad_dependencia 	=  "";
	$sbFecha			 	=  "";
	$sbHora				 	=  "";

	
	
  $sql = "SELECT cr.radicado, r.descripcion, d.descripcion, cr.folio, cr.archivo, cr.remitente_id, cr.remitente_ext_int, cr.fecha, cr.hora
		FROM c_recibida cr, remitente r, remitentesinternos rti, dependencia d
		WHERE cr.destinatario_id = '$nuDestinatario'
		AND cr.remitente_id = r.id
		AND cr.destinatario_id = rti.id
		AND rti.dependencia_id = d.id
		ORDER BY cr.fecha, cr.hora DESC
 			"; 
	 $result=mysqli_query($link,$sql);
	



   //inclusión de rutinas para crear informes PDF
   $pdf=new MyFPDF();
   $pdf->AddPage('L');
   $pdf->SetFont('Arial','B',12);
  $pdf->Cell(0,4,'',0,1,'C');
	  $pdf->Cell(0,4,"",0,1,'C');
   $pdf->Cell(0,4,"LISTADO DE CORRESPONDENCIA RECIBIDA",0,0,'C',0);
   $pdf->Cell(0,10,"",0,1,'',0);

    //titulos de las columnas
    $pdf->SetTextColor(0,0,0); //rgb	
	$pdf->SetFont('Arial','B',9);
    $pdf->Cell(25,5,'RADICADO',1,0,'C');
	$pdf->Cell(25,5,'FECHA',1,0,'C');	 
	$pdf->Cell(20,5,'HORA',1,0,'C');
    $pdf->Cell(25,5,'REMITENTES',1,0,'C');
    $pdf->Cell(80,5,'ENTIDAD / DEPENDENCIA',1,0,'C');
	$pdf->Cell(80,5,'DESTINATARIO',1,0,'C');	
	$pdf->Cell(20,5,'FOLIOS',1,1,'C');	 
		 
    $pdf->SetFont('Arial','',8);

   while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
			   	  
				
			   	  
			//Asigno Variables
			
			
			$sbRadicado				=  $row[0];
			$sbRemitente       		=  $row[1];
			$sbDestinatorio		 	=  $row[2];
			$nuFolios    			=  $row[3];
			$sbArchivo    			=  $row[4];
			$nuRemitente_id 		=  $row[5];
			$nuRemitente_ext_int	=  $row[6];
			$sbFecha				=  $row[7];
			$sbHora					=  $row[8];
	
			if($nuRemitente_id == 1){
			$sqlExtInt = "SELECT rte.nombre
			FROM remitentesexternos rte
			WHERE rte.id = $nuRemitente_ext_int
			"; 
			}
			
			if($nuRemitente_id == 2){
			$sqlExtInt = "SELECT d.descripcion
			FROM remitentesinternos rti, dependencia d
			WHERE rti.id = $nuRemitente_ext_int
			AND rti.dependencia_id = d.id
			"; 
			}
	
			$resultInformacion =mysqli_query($link,$sqlExtInt);
			$rowInfo=mysqli_fetch_array($resultInformacion,MYSQLI_NUM);
			$sbEntidad_dependencia = $rowInfo[0];  
    
	$pdf->Cell(25,5,$sbRadicado,1,0,'C');
	$pdf->Cell(25,5,$sbFecha,1,0,'C');	 
	$pdf->Cell(20,5,$sbHora,1,0,'C');
    $pdf->Cell(25,5,$sbRemitente,1,0,'C');
    $pdf->Cell(80,5,$sbEntidad_dependencia,1,0,'C');
	$pdf->Cell(80,5,$sbDestinatorio,1,0,'C');	
	$pdf->Cell(20,5,$nuFolios,1,1,'C');	 
	
    
	}//fin del while	
    
     //libera memoria
 	mysqli_free_result ($result);

 //genera el PDF en el Navegador
	$pdf->Output();  
	//generar reporte por ruta
  
  $sbCadena =  "<script language='javascript'>";
          $sbCadena .= "alert(  'Se genero el reporte Autos en la unidad D:' )";
     	  $sbCadena .= "</script>";
     	  echo $sbCadena;
  
  //retorna a la pagina anterior
   $sbCadena = '<script>window.history.back();</script>';
  echo $sbCadena;    
?>
