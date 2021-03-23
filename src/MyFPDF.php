<?php

ini_set('memory_limit','100M');
ini_set('max_execution_time',0);

define('FPDF_FONTPATH','../../utils/fpdf/font/');
require('../../utils/fpdf/fpdf.php');

class MyFPDF extends FPDF
{
//Cabecera de p�gina
function Header()
{ 
  /*  $this->SetFont('Arial','B',8);
    //$this->Cell(130,10,'',0,0,'R');
    date_default_timezone_set("America/Bogota");
    $today = date('Y-m-d   H:i:s');   

    $this->Cell(50,10,'Fecha: '.$today,'',1,'R');
    $this->SetTextColor(50,50,150);
    $this->SetFont('Arial','B',12);
    $this->Cell(0,5,'SOFTWARE SANCIONATORIO CDVC',0,1,'C');
    $this->Cell(0,10,'',0,1,'C');*/
	$this->Image('../../img/Encabezado.png',40,10,30);
	$this->Image('../../img/Palabra.png',90,20,120);
	
	 $this->Cell(0,25,'',0,1,'C');
    //$this->Image('../img/logo.jpg',258,5,20); //derecha
}

//Pie de p�gina
function Footer()
{
    //Posici�n: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //N�mero de p�gina
    $this->Cell(0,10,'Pagina '.$this->PageNo().'',0,0,'C');
      //$this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
 }
 
 //Optimizacion de Memoria
 
 function _putpages()
{
    $nb=$this->page;
    if(!empty($this->AliasNbPages))
    {
        //Replace number of pages
        for($n=1;$n<=$nb;$n++)
            $this->pages[$n]=($this->compress) ? gzcompress(str_replace($this->AliasNbPages,$nb,gzuncompress($this->pages[$n]))) : str_replace($this->AliasNbPages,$nb,$this->pages[$n]) ;
    }
    if($this->DefOrientation=='P')
    {
        $wPt=$this->wPt;
        $hPt=$this->hPt;
    }
    else
    {
        $wPt=$this->hPt;
        $hPt=$this->wPt;
    }
    $filter=($this->compress) ? '/Filter /FlateDecode ' : '';
    for($n=1;$n<=$nb;$n++)
    {
        //Page
        $this->_newobj();
        $this->_out('<</Type /Page');
        $this->_out('/Parent 1 0 R');
        if(isset($this->OrientationChanges[$n]))
            $this->_out(sprintf('/MediaBox [0 0 %.2f %.2f]',$hPt,$wPt));
        $this->_out('/Resources 2 0 R');
        if(isset($this->PageLinks[$n]))
        {
            //Links
            $annots='/Annots [';
            foreach($this->PageLinks[$n] as $pl)
            {
                $rect=sprintf('%.2f %.2f %.2f %.2f',$pl[0],$pl[1],$pl[0]+$pl[2],$pl[1]-$pl[3]);
                $annots.='<</Type /Annot /Subtype /Link /Rect ['.$rect.'] /Border [0 0 0] ';
                if(is_string($pl[4]))
                    $annots.='/A <</S /URI /URI '.$this->_textstring($pl[4]).'>>>>';
                else
                {
                    $l=$this->links[$pl[4]];
                    $h=isset($this->OrientationChanges[$l[0]]) ? $wPt : $hPt;
                    $annots.=sprintf('/Dest [%d 0 R /XYZ 0 %.2f null]>>',1+2*$l[0],$h-$l[1]*$this->k);
                }
            }
            $this->_out($annots.']');
        }
        $this->_out('/Contents '.($this->n+1).' 0 R>>');
        $this->_out('endobj');
        //Page content
        $this->_newobj();
        $this->_out('<<'.$filter.'/Length '.strlen($this->pages[$n]).'>>');
        $this->_putstream($this->pages[$n]);
        $this->_out('endobj');
    }
    //Pages root
    $this->offsets[1]=strlen($this->buffer);
    $this->_out('1 0 obj');
    $this->_out('<</Type /Pages');
    $kids='/Kids [';
    for($i=0;$i<$nb;$i++)
        $kids.=(3+2*$i).' 0 R ';
    $this->_out($kids.']');
    $this->_out('/Count '.$nb);
    $this->_out(sprintf('/MediaBox [0 0 %.2f %.2f]',$wPt,$hPt));
    $this->_out('>>');
    $this->_out('endobj');
}

function _endpage()
 {
    //End of page contents
    $this->pages[$this->page] = ($this->compress) ? gzcompress($this->pages[$this->page]) : $this->pages[$this->page];
    $this->state=1;
 }
 
}

//=======================================================================================================

class MyFPDF_Membretada extends FPDF
{
//Cabecera de p�gina
function Header()
{ 
    /*$this->SetFont('Arial','B',8);
    //$this->Cell(130,10,'',0,0,'R');
    date_default_timezone_set("America/Bogota");
    $today = date('Y-m-d   H:i:s');   

    $this->Cell(50,10,'Fecha: '.$today,'',1,'R');
    $this->SetTextColor(50,50,150);
    $this->SetFont('Arial','B',12);
    $this->Cell(0,5,'CONTRALORIA DEPARTAMENTAL VALLE DEL CAUCA',0,1,'C');
	$this->Cell(0,5,'R F I',0,1,'C');
    $this->Cell(0,10,'',0,1,'C');
	*/
  

	//  $this->Image('../img/logo.jpg',258,5,20); //derecha
     $this->Image('../../img/Encabezado.png',7,5,70);
	 $this->SetFont('Arial','B',12);
     $this->Cell(0,10,'',0,1,'C');
	 $this->Cell(0,5,'PARTIDO DE LA U',0,1,'C');
	 $this->Cell(0,8,"S O F T W A R E - S I U",0,1,'C');
	 $this->Cell(0,21,'',0,1,'C');

}

//Pie de p�gina
function Footer()
{
   /* //Posici�n: a 1,5 cm del final
    $this->SetY(-15);
  //Arial italic 8
    $this->SetFont('Arial','I',8);
    //N�mero de p�gina
*/
	//=============================================
	$this -> SetY (- 28 ); 
	
//	$imagen = $this->Image('../img/PiePag.png', 05,$this -> SetY (- 15 ),70); 
	$this->Image('../img/PiePag.png',07,$this->GetY(),192,26,null,null);

//$this -> Image ( '../img/PiePag.png' , 7 , 15, 190,-15 ); 
//==============================================

	/* $this->Image('../img/PiePag.png',7,SetY(-15),190);
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
 */
    }
 
 //Optimizacion de Memoria
 
 function _putpages()
{
    $nb=$this->page;
    if(!empty($this->AliasNbPages))
    {
        //Replace number of pages
        for($n=1;$n<=$nb;$n++)
            $this->pages[$n]=($this->compress) ? gzcompress(str_replace($this->AliasNbPages,$nb,gzuncompress($this->pages[$n]))) : str_replace($this->AliasNbPages,$nb,$this->pages[$n]) ;
    }
    if($this->DefOrientation=='P')
    {
        $wPt=$this->wPt;
        $hPt=$this->hPt;
    }
    else
    {
		$wPt=$this->hPt;
        $hPt=$this->wPt;
    }
    $filter=($this->compress) ? '/Filter /FlateDecode ' : '';
    for($n=1;$n<=$nb;$n++)
    {
        //Page
        $this->_newobj();
        $this->_out('<</Type /Page');
        $this->_out('/Parent 1 0 R');
        if(isset($this->OrientationChanges[$n]))
            $this->_out(sprintf('/MediaBox [0 0 %.2f %.2f]',$hPt,$wPt));
        $this->_out('/Resources 2 0 R');
        if(isset($this->PageLinks[$n]))
        {
            //Links
            $annots='/Annots [';
            foreach($this->PageLinks[$n] as $pl)
            {
                $rect=sprintf('%.2f %.2f %.2f %.2f',$pl[0],$pl[1],$pl[0]+$pl[2],$pl[1]-$pl[3]);
                $annots.='<</Type /Annot /Subtype /Link /Rect ['.$rect.'] /Border [0 0 0] ';
                if(is_string($pl[4]))
                    $annots.='/A <</S /URI /URI '.$this->_textstring($pl[4]).'>>>>';
                else
                {
                    $l=$this->links[$pl[4]];
                    $h=isset($this->OrientationChanges[$l[0]]) ? $wPt : $hPt;
                    $annots.=sprintf('/Dest [%d 0 R /XYZ 0 %.2f null]>>',1+2*$l[0],$h-$l[1]*$this->k);
                }
            }
            $this->_out($annots.']');
        }
        $this->_out('/Contents '.($this->n+1).' 0 R>>');
        $this->_out('endobj');
        //Page content
        $this->_newobj();
        $this->_out('<<'.$filter.'/Length '.strlen($this->pages[$n]).'>>');
        $this->_putstream($this->pages[$n]);
        $this->_out('endobj');
    }
    //Pages root
    $this->offsets[1]=strlen($this->buffer);
    $this->_out('1 0 obj');
    $this->_out('<</Type /Pages');
    $kids='/Kids [';
    for($i=0;$i<$nb;$i++)
        $kids.=(3+2*$i).' 0 R ';
    $this->_out($kids.']');
    $this->_out('/Count '.$nb);
    $this->_out(sprintf('/MediaBox [0 0 %.2f %.2f]',$wPt,$hPt));
    $this->_out('>>');
    $this->_out('endobj');
}

function _endpage()
 {
    //End of page contents
    $this->pages[$this->page] = ($this->compress) ? gzcompress($this->pages[$this->page]) : $this->pages[$this->page];
    $this->state=1;
 }
 
}

?>
