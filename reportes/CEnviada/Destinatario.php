<?php

 //C�digo para incluir las librerias
 include_once("../../src/conexion.php");
 include('../../src/MyFPDF.php');

  //Conexi�n con el servidor
  $link=ConectarseServidor();

 //Conexi�n con la base de datos
  ConectarseBaseDatos($link);
  
	//recupero variabkes
	$nuDestinatario		= $_REQUEST["cmbDestinatario"];
	$sbFechaInicial		= $_REQUEST["dtFechaInicial"];
	$sbFechaFinal		= $_REQUEST["dtFechaFinal"];
	
	//Declaro Variables
	//Declaro Variables
	$sbRadicado				=  "";
    $sbRemitenteInt	 		=  "";
    $sbRadicadoInicial 		=  "";
	$sbDependencia		 	=  "";
	$nuFolios    			=  "";
	$sbArchivo    			=  "";
	$sbFecha    			=  "";
	$sbHora	    			=  "";
	$sbDestinatario_id		=  "";
	$sbDestinatario_ext_int =  "";
	

	
	
  $sql = "SELECT ce.radicado, ce.radicadoinicial, d.descripcion, ce.folios, ce.archivo, ce.fecha, ce.hora, ce.destinatario_id, ce.destinatario_ext_int
		FROM c_enviada ce, remitentesinternos rti, dependencia d
		WHERE ce.destinatario_id = '$nuDestinatario'
		AND ce.fecha >= '$sbFechaInicial'
		AND ce.fecha <= '$sbFechaFinal'
		AND ce.remitente_int = rti.id
		AND rti.dependencia_id = d.id
		ORDER BY ce.radicado DESC, ce.fecha DESC
 			"; 
	 $result=mysqli_query($link,$sql);
	



   //inclusi�n de rutinas para crear informes PDF
   $pdf=new MyFPDF();
   $pdf->AddPage('L');
   $pdf->SetFont('Arial','B',12);
  $pdf->Cell(0,4,'',0,1,'C');
	  $pdf->Cell(0,4,"",0,1,'C');
   $pdf->Cell(0,4,"LISTADO DE CORRESPONDENCIA ENVIADA",0,0,'C',0);
   $pdf->Cell(0,10,"",0,1,'',0);

    //titulos de las columnas
    $pdf->SetTextColor(0,0,0); //rgb
    $pdf->SetFont('Arial','',9);
	
	 $pdf->Cell(20,5,'RADICADO',1,0,'C');
    $pdf->Cell(20,5,'R / INICIAL',1,0,'C');
    $pdf->Cell(75,5,'REMITENTES',1,0,'C');
   	$pdf->Cell(27,5,'DESTINATARIO',1,0,'C');	
	$pdf->Cell(75,5,'ENTIDAD / DEPENDENCIA',1,0,'C');
	$pdf->Cell(18,5,'FOLIOS',1,0,'C');	 
	$pdf->Cell(20,5,'FECHA',1,0,'C');	 
	$pdf->Cell(20,5,'HORA',1,1,'C');	 
    $pdf->SetFont('Arial','',8);

   while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			    {
			   	  
				
			   	  
			//Asigno Variables
			
			
			$sbRadicado				=  $row[0];
			$sbRadicadoInicial 		=  $row[1];
			$sbRemitenteInt			=  $row[2];
			$nuFolios    			=  $row[3];
			$sbArchivo    			=  $row[4];
			$sbFecha    			=  $row[5];
			$sbHora	    			=  $row[6];
			$sbDestinatario_id		=  $row[7];
			$sbDestinatario_ext_int =  $row[8];
	
			if($sbDestinatario_id == 1){
			$sbCorrespondencia = "Externo";
			$sqlExtInt = "SELECT rte.nombre
			FROM remitentesexternos rte
			WHERE rte.id = $sbDestinatario_ext_int
			"; 
			}
			
			if($sbDestinatario_id == 2){
			$sbCorrespondencia = "Interno";
			$sqlExtInt = "SELECT d.descripcion
			FROM remitentesinternos rti, dependencia d
			WHERE rti.id = $sbDestinatario_ext_int
			AND rti.dependencia_id = d.id
			"; 
			}
	
			$resultInformacion =mysqli_query($link,$sqlExtInt);
			$rowInfo=mysqli_fetch_array($resultInformacion,MYSQLI_NUM);
			$sbEntidad_dependencia = $rowInfo[0];  
    
	$pdf->Cell(20,5,$sbRadicado,1,0,'C');
    $pdf->Cell(20,5,$sbRadicadoInicial,1,0,'C');
    $pdf->Cell(75,5,$sbRemitenteInt,1,0,'C');
	$pdf->Cell(27,5,$sbCorrespondencia,1,0,'C');	
	$pdf->Cell(75,5,$sbEntidad_dependencia,1,0,'C');	
	$pdf->Cell(18,5,$nuFolios,1,0,'C');	 
	$pdf->Cell(20,5,$sbFecha,1,0,'C');	 
	$pdf->Cell(20,5,$sbHora,1,1,'C');
    
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