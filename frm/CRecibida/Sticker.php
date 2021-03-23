<?php

 //Código para incluir las librerias
 include_once("../../src/conexion.php");
 include('../../src/MyFPDF_Sticker.php');

 //Declaro Variables
	$id					= $_REQUEST["txtRadicado"];
	$sbRadicado	   		=  "";
	$sbDestinatario		=  "";
	$sbAsunto			=  "";
	$sbFolio	   		=  "";
	$sbFecha	   		=  "";
	$sbHora				=  "";
	$nuRemitente_id 	=  "";
	$nuRemitente_ext_int=  "";
    	
	
 //Conexión con el servidor
  $link=ConectarseServidor();

 //Conexión con la base de datos
  ConectarseBaseDatos($link);

 //realiza consulta a la base de datos
 $sql = "SELECT cr.radicado, d.descripcion, cr.asunto, cr.folio, cr.fecha, cr.hora, cr.remitente_id, cr.remitente_ext_int
			FROM 	c_recibida cr, remitentesinternos rti, dependencia d
			WHERE cr.radicado ='$id'
			AND cr.destinatario_id = rti.id
			AND rti.dependencia_id = d.id";
     
  $result=mysqli_query($link,$sql);
  
  while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
  
	$sbRadicado	   		=  $row[0]; 
	$sbDestinatario		=  $row[1]; 
	$sbAsunto	   		=  $row[2]; 
	$sbFolio	   		=  $row[3]; 
	$sbFecha	   		=  $row[4]; 
	$sbHora				=  $row[5]; 
	$nuRemitente_id 	=  $row[6]; 
	$nuRemitente_ext_int=  $row[7]; 
	
	
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
     
     mysqli_free_result ($result);
			
 

   //inclusión de rutinas para crear informes PDF
   $pdf=new MyFPDF('L','cm',array(3.3,10));
   $pdf->AddPage('L');
   $pdf->SetFont('Arial','B',7);
	$pdf->Cell(0,0,'',0,1,'C'); 
	$pdf->Cell(0,0.35,'PARTIDO DE LA U',0,1,'C');
	$pdf->Cell(0,0.2,'VENTANILLA UNICA',0,1,'C');
	$pdf->Cell(1.9,0.5,'',0,0,'C');
	$pdf->Cell(2.9,0.5,'Radicado : '.$sbRadicado,0,0,'L');
	$pdf->Cell(3,0.5,'     Folios : '.$sbFolio,0,1,'L');
	
    
  $pdf->Cell(1.6,0.3,'Remitente :',0,0,'L');
  $pdf->Cell(6.6,0.3,$sbNomRemitente,0,1,'L');
  $pdf->Cell(1.6,0.3,'Destinatario :',0,0,'L');
  $pdf->Cell(6.6,0.3,$sbDestinatario,0,1,'L');
  $pdf->Cell(1.6,0.3,'Asunto :',0,0,'L');
  $pdf->Cell(1.6,0.3,$sbAsunto,0,1,'L');
  $pdf->Cell(2.5,0.5,'Fecha :  '.$sbFecha,0,0,'L');
  $pdf->Cell(1,0.5,'Hora :  '.$sbHora,0,0,'L');
  $pdf->Cell(1.5,0.5,'',0,1,'L');
  
  
  

    /*impresion de datos obtenidos desde la BD
	 while($row = mysqli_fetch_array($result))
	 {
	$id					=  $row[0];
	$nuNro_pga	   		=  $row[1];
	$sbEntidad__pga		=  $row[2];
	$sbMunicipio_pga	=  $row[3];
	$dtFecha			=  $row[4];
	$sbArchivo			=  $row[5];
    	
    
	$pdf->Cell(20,5,"",0,0,'',0);
	$pdf->Cell(10,5,$id	,1,0,'C');
	$pdf->Cell(50,5,'Nro '.$nuNro_pga.': '.$sbEntidad__pga.' del '.$sbMunicipio_pga,1,0,'C');	
	$pdf->Cell(20,5,$dtFecha,1,0,'C');	
	$pdf->Cell(65,5,$sbArchivo	,1,1,'C');	 
     }//fin del while	
    
     //libera memoria
 	mysqli_free_result ($result);
*/
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
