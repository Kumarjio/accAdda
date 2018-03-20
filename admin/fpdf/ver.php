<?php
require('fpdf.php');
include_once('../config/config2.php');
include_once('../function/rupees.php');
global $company;
global $data;
global $type , $client;
global $qun ,$total;
$data = $conn->query("SELECT * FROM `ver_mst` WHERE id = '".$_GET['id']."'")->fetch_object();
$company = $con->query("SELECT * FROM `company_mas` WHERE company_id = '".$data->c_id."'")->fetch_object();



class PDF extends FPDF
{
function Header()
{
	$this->Image('../'.$GLOBALS['company']->header_img,0,0,210,45);
    $this->Ln(35);
}

function Footer()
{
	
	
	$this->Image('../'.$GLOBALS['company']->footer_img,0,287,211,10);
}
}

$pdf = new PDF();
$pdf->AliasNbPages();

$pdf->AddPage();
	
	$pro = $con->query("select * from project_master where project_id = '".$data->project_name."'")->fetch_object();
	$pdf->SetX(7);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(196,12,'Date : -   '.$data->c_date,0,1,'L'); 
	$pdf->Ln(5);
	$pdf->SetX(7);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(196,12,'To : -  '.$data->toa,0,1,'L');
	$pdf->Ln(5);
	$pdf->SetX(7);
	$pdf->SetFont('Arial','',13);
	$pdf->MultiCell(196,6,'Sub : Verification For '.$pro->project_name,0,'C');
	
	$pdf->Ln(10);
	$pdf->SetX(7);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(196,6,'Project Name : - '.$pro->project_name,1,'C');
	
	
	$pdf->SetX(7);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(15,10,'Sr No.',1,0,'C');
	
	$pdf->SetX(22);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(25,10,'Date','TBR',0,'C');
	
	$pdf->SetX(47);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(45,10,'Desc.','TBR',0,'C');
	
	$pdf->SetX(92);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(17,10,'Side','TBR',0,'C');
	
	$pdf->SetX(109);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(25,10,'Channage','TBR',0,'C');
	
	$pdf->SetX(133);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(25,10,'Qty','TBR',0,'C');
	
	$pdf->SetX(158);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(45,10,'Remarks','TBR',0,'C');
	
	$d = $conn->query("SELECT * FROM `ver_detail_mst` WHERE ver_id = '".$data->id."'");
	$c = 0; $a = 0;
	
	while( $de = $d->fetch_object() )
	{ $c++;
		$pdf->SetXY(7,111 + $a);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(15,10,$c,'BLR',0,'C');
		
		$pdf->SetXY(22,111 + $a);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,10,$de->vdate,'BR',0,'C');
		if( $pdf->GetStringWidth( $de->product ) > 43 )
		{
			$pdf->SetXY(47,111 + $a);
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(45,5,$de->product,'','C');
			$pdf->SetXY(47,111 + $a);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(45,10,'','BR',0,'C');
		}
		else
		{
			$pdf->SetXY(47,111 + $a);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(45,10,$de->product,'BR',0,'C');
		}
		$pdf->SetXY(92,111 + $a);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(17,10,$de->side,'BR',0,'C');
		if( $pdf->GetStringWidth( $de->chanage ) > 23 )
		{
			$pdf->SetXY(109,111 + $a);
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(25,5,$de->chanage,'','C');
			$pdf->SetXY(109,111 + $a);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(25,10,'','BR',0,'C');
		}
		else
		{
			$pdf->SetXY(109,111 + $a);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(25,10,$de->chanage,'BR',0,'C');
		}
		$pdf->SetXY(133,111 + $a);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,10,$de->qty,'BR',0,'C');
		
		
		if( $pdf->GetStringWidth( $de->remark ) > 43 )
		{
			$pdf->SetXY(158,111 + $a);
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(45,5,$de->remark,'',0,'C');
			$pdf->SetXY(158,111 + $a);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(45,10,'','BR',0,'C');
		}
		else
		{
			$pdf->SetXY(158,111 + $a);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(45,10,$de->remark,'BR',0,'C');
		}
		$a += 10;
	}
	
			$pdf->SetXY(7,200);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(196,8,'Verified By: -',0,0,'L');
			
			$pdf->SetXY(7,208);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(196,8,'','B',0,'L');
			
			$pdf->SetXY(7,216);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(40,8,'','B',0,'L');
			
			$pdf->SetXY(7,230);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(40,5,'Thank You : - ',0,0,'L');
			
			$pdf->SetXY(7,235);
			$pdf->SetFont('Arial','',12);
			$pdf->MultiCell(196,6,$company->company_name,0,'L');
			
			if( !empty($GLOBALS['company']->stamp_img) )
			{		
				$pdf->Image('../'.$company->stamp_img,7,247,25,25);
			}	
			
			$pdf->SetXY(7,271);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(60,5,'( Authorised Signatory )',0,0,'L');


$pdf->Output("Verification - ".$pro->project_name.".pdf", 'D');
?>