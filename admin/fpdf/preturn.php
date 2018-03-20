<?php
require('fpdf.php');
include_once('../config/config2.php');
global $company;
global $data;
global $type , $client;
$data = $conn->query("SELECT * FROM `purchase_return_mst` WHERE id = '".$_GET['id']."'")->fetch_object();
$company = $con->query("SELECT * FROM `company_mas` WHERE company_id = '".$data->c_id."'")->fetch_object();
$client = $con->query("SELECT * FROM `client_master` WHERE client_id = '".$data->act_no."'")->fetch_object();





class PDF extends FPDF
{
function Header()
{
	$this->Image('../'.$GLOBALS['company']->header_img,0,0,210,45);
    $this->Ln(35);
	$this->SetX(70);
	$this->SetFont('Arial','',12);
	$this->Cell(70,8,'Purchase Return Invoice',0,1,'C'); 
	$this->SetX(140);
	$this->SetFont('Arial','',12);
	$this->SetX(7);
	$this->SetFont('Arial','',12);
	$this->Cell(98,30,'',1,0,'C');
	$this->SetX(105);
	$this->SetFont('Arial','',12);
	$this->Cell(98,30,'','TBR',0,'C');
	
	$this->SetX(7);
	$this->SetFont('Arial','',10);
	$this->MultiCell(98,5,'To- '.$GLOBALS['client']->client_name,'','L');
	
	$this->SetXY(12,62);
	$this->SetFont('Arial','',10);
	$this->MultiCell(90,4,$GLOBALS['client']->client_address,'','L');
	// client info
	$this->SetXY(105,53);
	$this->SetFont('Arial','B',12);
	$this->Cell(20,6,'Inv No. :- ','',0,'L');
	$this->SetXY(125,53);
	$this->SetFont('Arial','',12);
	$this->Cell(70,6,$GLOBALS['data']->pr_no,'',0,'L');
	$this->SetXY(105,59);
	$this->SetFont('Arial','B',12);
	$this->Cell(20,6,'Date :- ','',0,'L');
	$this->SetXY(125,59);
	$this->SetFont('Arial','',12);
	$this->Cell(70,6,$GLOBALS['data']->pr_date,'',0,'L');
	$this->SetXY(7,83);
	$this->SetFont('Arial','',12);
	$this->Cell(98,6,'NARRATION',1,0,'C');
	$this->SetXY(105,83);
	$this->SetFont('Arial','',12);
	$this->Cell(98,6,'Amount','TBR',0,'C');
	
}

function Footer()
{
	
	
	
	$this->SetY(-17);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	
	$this->Image('../'.$GLOBALS['company']->footer_img,0,287,211,9);
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


$product = $conn->query("select * from purchase_return_detail_mst where s_id = '".$_GET['id']."'");
$c = 0; $t = 0;
while( $productr = $product->fetch_object() )
{ 
	$pdf->SetXY(7,89 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(98,12,'',1,0,'C');
	$pdf->SetXY(7,89 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(98,6,$productr->p_name,0,'L');
	$pdf->SetXY(105,89 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(98,12,$productr->amt,'TBR',0,'L');
	$c += 12;
	$t += $productr->amt;
}

	include_once('../function/rupees.php');
	$pdf->SetXY(7,89 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(196,12,'','BLR',0,'C');
	$pdf->SetXY(7,89 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(196,6,strtoupper(getIndianCurrency($t))." Only",0,'L');
	$c += 12;
	$pdf->SetXY(7,89 + $c);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(196,37,'',"LBR",'C');
	$pdf->SetXY(123,89 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(80,5,'For , '.$company->company_name,0,'L');
	if( !empty($company->stamp_img) )
	{		
	$pdf->Image('../'.$company->stamp_img,175,98 + $c,30,30);
	}


$pdf->Output("Purchase Return ".$data->pr_no.".pdf","D");
?>