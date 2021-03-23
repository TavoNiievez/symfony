<?php

 //Código para incluir las librerias
 include_once("../../src/conexion.php");
 include('../../src/MyFPDF.php');

	//recupero variabkes
	$sbFechaInicial		= $_REQUEST["dtFechaInicial"];
	$sbFechaFinal		= $_REQUEST["dtFechaFinal"];
	
	//Declaro Variables
	$sbRadicado				=  "";
    $sbRemitente       		=  "";
	$sbEntidad_dependencia 	=  "";
	$sbDestinatorio		 	=  "";
	$nuFolios    			=  "";
	$sbFecha			 	=  "";
	$sbHora				 	=  "";

	
 //Conexión con el servidor
  $link=ConectarseServidor();

 //Conexión con la base de datos
  ConectarseBaseDatos($link);

	 //realiza consulta a la base de datos
	 $sql = "SELECT lr.radicado, lr.remitente, lr.entidad, lr.destinatario, lr.folios, lr.fecha, lr.hora
			FROM list_recibida lr
			WHERE lr.fecha >= '$sbFechaInicial'
			AND lr.fecha <= '$sbFechaFinal'
			ORDER BY lr.radicado DESC , lr.fecha DESC ";
     
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
	$sbEntidad_dependencia 	=  $row[2];
	$sbDestinatorio		 	=  $row[3];
	$nuFolios    			=  $row[4];
	$sbFecha			 	=  $row[5];
	$sbHora				 	=  $row[6];
				
    
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
