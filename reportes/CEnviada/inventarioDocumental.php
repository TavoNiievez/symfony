<?php
include_once("../../src/conexion.php");

	 //Conexión con el servidor
	 $link=ConectarseServidor();
	 //Conexión con la base de datos
	 ConectarseBaseDatos($link);

//RECUPERO INFORMACION	 
$nuDepencia     	=  $_REQUEST["cmbRemitenteInterno"];	
$_dtFechaInicial    	=  $_REQUEST["dtFechaInicial"];	
$_dtFechaFinal    	=  $_REQUEST["dtFechaFinal"];	
	 
//VARIABLES
$nuConsecutivo=1;
$nuPocision=17;
$sbTRD="";
$sbSubserie="";
$nuTotalFolios=0;
$dtFechaInicial="";
$dtFechaFinal="";
$nuTotalFolios=0;
$sbDependencia="";

	 
//NOMBRES CELDAS
$sbColumna1="NUMERO";
$sbColumna2="CODIGO";
$sbColumna3="TRD";
$sbColumna4="FECHAS EXTREMAS";
$sbColumna4_1="Inicial";
$sbColumna4_2="Final";
$sbColumna5="UNIDAD DE CONSERVACION";
$sbColumna5_1="Caja";
$sbColumna5_2="Legajo";
$sbColumna5_3="Tomo";
$sbColumna5_4="Otro";
$sbColumna6="FOLIOS";
$sbColumna7="SOPORTE";
$sbColumna8="FRECUENCIA DE CONSULTA";
$sbColumna9="NOTAS";

error_reporting(E_ALL);

ini_set('include_path', ini_get('include_path').';../Classes/');
include '../../utils/PHPExcel_1.8.0/Classes/PHPExcel.php';
include '../../utils/PHPExcel_1.8.0/Classes/PHPExcel/Writer/Excel2007.php';

$excel = new PHPExcel();
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Inventario Documental.xls"');
header('Cache-Control: max-age=0');


$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$logo = '../../img/Reporte.png'; // Provide path to your logo file
$objDrawing->setPath($logo);  //setOffsetY has no effect
$objDrawing->setCoordinates('B1');
$objDrawing->setHeight(150); // logo height
$objDrawing->setWorksheet($excel->getActiveSheet()); 

$sql ='SELECT DISTINCT ce.subseries_id, d.descripcion
		FROM c_enviada ce, dependencia d
		WHERE ce.remitente_int =  "'.$nuDepencia.'"
		AND ce.remitente_int = d.id
		AND ce.fecha BETWEEN  "'.$_dtFechaInicial.'" AND  "'.$_dtFechaFinal.'"
		ORDER BY ce.subseries_id';

$result=mysqli_query($link,$sql);

/*
$excel->getDefaultStyle('A10:M16')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
*/

//STYLO Q ME PONES LOS BORDES
$styleArrayBorders = array(
	'borders' => array( 'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN))
);

//STYLO Q PONGA EL CENTRADO
$styleArrayCenter = array(
	'font' => array('bold' => true,),
	'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
);

//PARTE SUPERIOR
$excel->setActiveSheetIndex(0)
		->mergeCells('A10:B10')
        ->setCellValue('A10', 'OFICINA PRODUCTORA:')
        ->setCellValue('A11', 'OBJETO!')
		->mergeCells('C10:H10')
		->mergeCells('C11:D11')
		->mergeCells('E11:F11')
		->mergeCells('G11:H11')
		->mergeCells('C12:E12')
		->mergeCells('F12:H12')		
		->setCellValue('C11', 'Transferencia Primaria')
		->setCellValue('E11', 'Transferencia Secundaria')
		->setCellValue('G11', 'Inventario Individual')
		->setCellValue('C12', 'Valoracion Fondos Acumulados')
		->setCellValue('F12', 'Fusion y Supresion Entidades o Dependencias')

		->mergeCells('J10:M10')
		->setCellValue('J10', 'REGISTRO DE ENTRADA:')
		->setCellValue('J11', 'AAAA')
		->setCellValue('K11', 'MM')
		->setCellValue('L11', 'DD')
		->setCellValue('M11', 'N.T.')
		->mergeCells('J13:M13')
		->setCellValue('J13', 'N.T.=Numero de Transferencia ');

$excel->getActiveSheet()->getStyle('C10:H12')->applyFromArray($styleArrayBorders);
$excel->getActiveSheet()->getStyle('J10:M12')->applyFromArray($styleArrayBorders);
$excel->getActiveSheet()->getStyle('J10:M12')->applyFromArray($styleArrayCenter);


//TABLA GENERAL - ENCABEZADOS
$excel->setActiveSheetIndex(0)
		->mergeCells('A15:A16')
		->mergeCells('B15:B16')
		->mergeCells('C15:C16')
        ->setCellValue('A15', $sbColumna1)
        ->setCellValue('B15', $sbColumna2)
        ->setCellValue('C15', $sbColumna3)
		->mergeCells('D15:E15')
		->setCellValue('D15', $sbColumna4)
        ->setCellValue('D16', $sbColumna4_1)
        ->setCellValue('E16', $sbColumna4_2)
		->mergeCells('F15:I15')
		->setCellValue('F15', $sbColumna5)
		->setCellValue('F16', $sbColumna5_1)
		->setCellValue('G16', $sbColumna5_2)
		->setCellValue('H16', $sbColumna5_3)
		->setCellValue('I16', $sbColumna5_4)
		->mergeCells('J15:J16')
		->mergeCells('K15:K16')
		->mergeCells('L15:M16')
		->mergeCells('N15:N16')
		->setCellValue('J15', $sbColumna6)
		->setCellValue('K15', $sbColumna7)
        ->setCellValue('L15', $sbColumna8)
        ->setCellValue('N15', $sbColumna9)
		;

$excel->getActiveSheet()->getStyle('A15:N16')->applyFromArray($styleArrayCenter);

//INFORMACION DE LA BASE DE DATOS
while($row=mysqli_fetch_array($result,MYSQLI_NUM)){

   $sbDependencia=$row[1];
   
   $sql2='SELECT DISTINCT ss.trd, ss.descripcion, ce.fecha, ce.folios
			FROM  c_enviada ce, subseries ss
			WHERE ce.subseries_id = ss.id
			AND ce.remitente_int =  "'.$nuDepencia.'"
			AND ce.fecha BETWEEN  "'.$_dtFechaInicial.'" AND  "'.$_dtFechaFinal.'"
			AND ce.subseries_id =  "'.$row[0].'"
			ORDER BY ce.fecha';
   
   $result2=mysqli_query($link,$sql2);

   
   //WHILE INTERNO
   while($row2=mysqli_fetch_array($result2,MYSQLI_NUM)){
   
		//INFO TRD
		$sbTRD=$row2[0];    
		//INFO subserie
		$sbSubserie=$row2[1];  	
		//SUMATORIA DE FOLIOS
		$nuTotalFolios+=$row2[3];

		if($dtFechaInicial == ""){
				$dtFechaInicial=$row2[2];
				$dtFechaFinal=$row2[2];
		}
		if($dtFechaFinal<$row2[2] ){
			$dtFechaFinal=$row2[2];
		}
		
   }//FIN WHIL INTERNO
	
	
   //TABLA GENERAL - ENCABEZADOS
   $excel->setActiveSheetIndex(0)
			->setCellValue('A'.$nuPocision, $nuConsecutivo)
			->setCellValue('B'.$nuPocision, $sbTRD)
			->setCellValue('C'.$nuPocision, $sbSubserie)
			->setCellValue('D'.$nuPocision, $dtFechaInicial)
			->setCellValue('E'.$nuPocision, $dtFechaFinal)
			->setCellValue('J'.$nuPocision, $nuTotalFolios);

	$nuPocision+=1;
	$nuConsecutivo++;
	$dtFechaInicial= ""; 
	$dtFechaFinal = ""; 
	$nuTotalFolios = 0; 
	
}//FIN WHILW INFORMACION DE LA BASE DE DATOS
		
$excel->getActiveSheet()->getStyle('A15:N'.($nuPocision-1))->applyFromArray($styleArrayBorders);
		
$nuPocision+=2;

//PARTE INFERIOR		
$excel->setActiveSheetIndex(0)
        ->setCellValue('C10',$sbDependencia )
		->mergeCells('A'.$nuPocision.':B'.$nuPocision)
		->mergeCells('A'.($nuPocision+1).':B'.($nuPocision+1))
		->mergeCells('A'.($nuPocision+2).':B'.($nuPocision+2))
		->mergeCells('A'.($nuPocision+3).':B'.($nuPocision+3))
		->mergeCells('A'.($nuPocision+4).':B'.($nuPocision+4))
        ->setCellValue('A'.$nuPocision, 'ELABORADO POR:')
        ->setCellValue('A'.($nuPocision+1), 'CARGO:')
        ->setCellValue('A'.($nuPocision+2), 'FIRMA:')
        ->setCellValue('A'.($nuPocision+3), 'LUGAR:')
        ->setCellValue('A'.($nuPocision+4), 'FECHA:')
		->mergeCells('C'.$nuPocision.':D'.$nuPocision)
		->mergeCells('C'.($nuPocision+1).':D'.($nuPocision+1))
		->mergeCells('C'.($nuPocision+2).':D'.($nuPocision+2))
		->mergeCells('C'.($nuPocision+3).':D'.($nuPocision+3))
		->mergeCells('C'.($nuPocision+4).':D'.($nuPocision+4))
		
		->mergeCells('F'.$nuPocision.':G'.$nuPocision)
		->mergeCells('F'.($nuPocision+1).':G'.($nuPocision+1))
		->mergeCells('F'.($nuPocision+2).':G'.($nuPocision+2))
		->mergeCells('F'.($nuPocision+3).':G'.($nuPocision+3))
		->mergeCells('F'.($nuPocision+4).':G'.($nuPocision+4))
        ->setCellValue('F'.$nuPocision, 'ENTREGADO POR:')
        ->setCellValue('F'.($nuPocision+1), 'CARGO:')
        ->setCellValue('F'.($nuPocision+2), 'FIRMA:')
        ->setCellValue('F'.($nuPocision+3), 'LUGAR:')
        ->setCellValue('F'.($nuPocision+4), 'FECHA:')
		->mergeCells('H'.$nuPocision.':I'.$nuPocision)
		->mergeCells('H'.($nuPocision+1).':I'.($nuPocision+1))
		->mergeCells('H'.($nuPocision+2).':I'.($nuPocision+2))
		->mergeCells('H'.($nuPocision+3).':I'.($nuPocision+3))
		->mergeCells('H'.($nuPocision+4).':I'.($nuPocision+4))		
		
		->mergeCells('K'.$nuPocision.':L'.$nuPocision)
		->mergeCells('K'.($nuPocision+1).':L'.($nuPocision+1))
		->mergeCells('K'.($nuPocision+2).':L'.($nuPocision+2))
		->mergeCells('K'.($nuPocision+3).':L'.($nuPocision+3))
		->mergeCells('K'.($nuPocision+4).':L'.($nuPocision+4))
        ->setCellValue('K'.$nuPocision, 'RECIBIDO POR:')
        ->setCellValue('K'.($nuPocision+1), 'CARGO:')
        ->setCellValue('K'.($nuPocision+2), 'FIRMA:')
        ->setCellValue('K'.($nuPocision+3), 'LUGAR:')
        ->setCellValue('K'.($nuPocision+4), 'FECHA:')
		->mergeCells('M'.$nuPocision.':N'.$nuPocision)
		->mergeCells('M'.($nuPocision+1).':N'.($nuPocision+1))
		->mergeCells('M'.($nuPocision+2).':N'.($nuPocision+2))
		->mergeCells('M'.($nuPocision+3).':N'.($nuPocision+3))
		->mergeCells('M'.($nuPocision+4).':N'.($nuPocision+4));
// Do your stuff here

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');

// This line will force the file to download
$writer->save('php://output');

?>