<?php

 //Código para incluir las librerias
 include_once("../../src/conexion.php");
 include('../../src/MyFPDF.php');

	//recupero variabkes
	$sbFechaInicial		= $_REQUEST["dtFechaInicial"];
	$sbFechaFinal		= $_REQUEST["dtFechaFinal"];
	
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
	
 //Conexión con el servidor
  $link=ConectarseServidor();

 //Conexión con la base de datos
  ConectarseBaseDatos($link);

	 //realiza consulta a la base de datos
	 $sql = "SELECT le.radicado, le.radicadoinicial, le.remitenteinterno, le.correspondencia, le.destinatario, le.folios, le.fecha, le.hora
			FROM list_enviada le
			WHERE le.fecha >= '$sbFechaInicial'
			AND le.fecha <= '$sbFechaFinal'
			ORDER BY  le.radicado DESC, le.fecha DESC";
     
  $result=mysqli_query($link,$sql);

   //inclusión de rutinas para crear informes PDF
   $pdf=new MyFPDF();
   $pdf->AddPage('L');
   $pdf->SetFont('Arial','B',12);
  $pdf->Cell(0,4,'',0,1,'C');
	  $pdf->Cell(0,4,"",0,1,'C');
   $pdf->Cell(0,4,"LISTADO DE CORRESPONDENCIA ENVIADA",0,0,'C',0);
   $pdf->Cell(0,10,"",0,1,'',0);

    //titulos de las columnas
    $pdf->SetTextColor(0,0,0); //rgb	
	$pdf->SetFont('Arial','B',9);
    $pdf->Cell(20,5,'RADICADO',1,0,'C');
    $pdf->Cell(20,5,'R / INICIAL',1,0,'C');
	$pdf->Cell(20,5,'FECHA',1,0,'C');	 
	$pdf->Cell(20,5,'HORA',1,0,'C');
    $pdf->Cell(75,5,'REMITENTES',1,0,'C');
   	$pdf->Cell(27,5,'DESTINATARIO',1,0,'C');	
	$pdf->Cell(75,5,'ENTIDAD / DEPENDENCIA',1,0,'C');
	$pdf->Cell(18,5,'FOLIOS',1,1,'C');	 
		 
    $pdf->SetFont('Arial','',8);

   while($row=mysqli_fetch_array($result,MYSQLI_NUM))
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
				
    
	$pdf->Cell(20,5,$sbRadicado,1,0,'C');
    $pdf->Cell(20,5,$sbRadicadoInicial,1,0,'C');
	$pdf->Cell(20,5,$sbFecha,1,0,'C');	 
	$pdf->Cell(20,5,$sbHora,1,0,'C');
    $pdf->Cell(75,5,$sbRemitente,1,0,'C');
	$pdf->Cell(27,5,$sbCorrespondencia,1,0,'C');	
	$pdf->Cell(75,5,$sbDestinatario,1,0,'C');	
	$pdf->Cell(18,5,$nuFolios,1,1,'C');	 
	
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
