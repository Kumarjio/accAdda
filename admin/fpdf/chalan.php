<?php
require('fpdf.php');
include_once('../config/config2.php');
global $company;
global $data;
global $type , $client;
$data = $conn->query("SELECT * FROM `quatation_mst` WHERE s_id = '".$_GET['id']."'")->fetch_object();
$company = $con->query("SELECT * FROM `company_mas` WHERE company_id = '".$data->c_id."'")->fetch_object();
$client = $con->query("SELECT * FROM `client_master` WHERE client_id = '".$data->act_no."'")->fetch_object();



//paginating 

//paginating 











class PDF extends FPDF
{
function Header()
{
	$this->Image('../'.$GLOBALS['company']->header_img,0,0,210,45);
    $this->Ln(35);
	$this->SetX(70);
	$this->SetFont('Arial','',12);
	$this->Cell(70,8,'DELIVERY CHALLAN',0,1,'C'); 
	$this->SetX(140);
	$this->SetFont('Arial','',12);
	$this->SetX(7);
	$this->SetFont('Arial','',12);
	$this->Cell(98,45,'',1,0,'C');
	$this->SetX(105);
	$this->SetFont('Arial','',12);
	$this->Cell(98,45,'','TBR',0,'C');
	
	// client info
	
	$this->SetX(7);
	$this->SetFont('Arial','B',10);
	$this->Cell(7,5,'To, ',0,0,'C');
	$this->SetX(14);
	$this->SetFont('Arial','B',10);
	$this->MultiCell(91,5,$GLOBALS['client']->client_name,0,'L');
	$this->SetXY(12,65);
	$this->SetFont('Arial','B',10);
	$this->MultiCell(93,5,$GLOBALS['client']->client_address,0,'L');
	$this->SetXY(8,92);
	$this->SetFont('Arial','',10);
	$this->Cell(25,5,'GSTIN/UIN :-',0,'L');
	$this->SetXY(33,92);
	$this->SetFont('Arial','',10);
	$this->Cell(60,5,$GLOBALS['client']->gst,0,'L');
	
	// client info
	
	// chalan info
	$this->SetXY(105,53);
	$this->SetFont('Arial','B',10);
	$this->Cell(24.5,5,'D.C. No :- ',0,'L');
	$this->SetXY(130,53);
	$this->SetFont('Arial','',10);
	$this->Cell(38,5,$GLOBALS['data']->s_numner,0,'L');
	
	$this->SetXY(169,53);
	$this->SetFont('Arial','B',10);
	$this->Cell(14,5,'Date :-',0,'L');
	$this->SetXY(183,53);
	$this->SetFont('Arial','',10);
	$this->Cell(20,5,$GLOBALS['data']->s_date,0,'L');
	
	$this->SetXY(105,77);
	$this->SetFont('Arial','B',10);
	$this->Cell(26,5,'P.O.No :- ',0,'L');
	$this->SetXY(131,77);
	$this->SetFont('Arial','',10);
	$this->Cell(38,5,$GLOBALS['data']->po_no,0,'L');
	
	$this->SetXY(169,77);
	$this->SetFont('Arial','B',10);
	$this->Cell(14,5,'Date :-',0,'L');
	$this->SetXY(183,77);
	$this->SetFont('Arial','',10);
	$this->Cell(20,5,$GLOBALS['data']->po_date,0,'L');
	
	$this->SetXY(105,82);
	$this->SetFont('Arial','B',10);
	$this->Cell(26,5,'L.R.No :- ',0,'L');
	$this->SetXY(131,82);
	$this->SetFont('Arial','',10);
	$this->Cell(38,5,$GLOBALS['data']->lr_no,0,'L');
	
	$this->SetXY(169,82);
	$this->SetFont('Arial','B',10);
	$this->Cell(14,5,'Date :-',0,'L');
	$this->SetXY(183,82);
	$this->SetFont('Arial','',10);
	$this->Cell(20,5,$GLOBALS['data']->lr_date,0,'L');
	
	$this->SetXY(105,87);
	$this->SetFont('Arial','B',10);
	$this->Cell(26,5,'Transport :- ',0,'L');
	$this->SetXY(131,87);
	$this->SetFont('Arial','',10);
	$this->MultiCell(70,5,$GLOBALS['data']->transport,0,'L');
	
	// chalan info
	
	
	
	$this->SetXY(7,98);
	$this->SetFont('Arial','B',11);
	$this->Cell(15,6,'Sr No.','BLR',0,'C');
	$this->SetXY(7,104);
	$this->SetFont('Arial','B',10);
	$this->Cell(15,127,'','LR',1,'L');
	
	$this->SetXY(22,98);
	$this->SetFont('Arial','B',11);
	$this->Cell(83,6,'Description','BR',0,'C');
	$this->SetXY(22,104);
	$this->SetFont('Arial','B',10);
	$this->Cell(83,127,'','R',1,'L');
	
	$this->SetXY(105,98);
	$this->SetFont('Arial','B',11);
	$this->Cell(18,6,'Unit','BR',0,'C');
	$this->SetXY(105,104);
	$this->SetFont('Arial','B',10);
	$this->Cell(18,134,'','R',1,'L');
	
	$this->SetXY(123,98);
	$this->SetFont('Arial','B',11);
	$this->Cell(30,6,'Qty','BR',0,'C');
	$this->SetXY(123,104);
	$this->SetFont('Arial','B',10);
	$this->Cell(30,134,'','R',1,'L');
	
	$this->SetXY(153,98);
	$this->SetFont('Arial','B',11);
	$this->Cell(50,6,'Remark','BR',0,'C');
	$this->SetXY(153,104);
	$this->SetFont('Arial','B',10);
	$this->Cell(50,127,'','R',1,'L');
	
	
}

function Footer()
{
	
	$this->SetXY(7,238);
	$this->SetFont('Arial','B',10);
	$this->Cell(127,7,'','RL',0,'L');
	$this->SetXY(8,239);
	$this->SetFont('Arial','',10);
	$this->Cell(25,5,'GSTIN/UIN :-',0,'L');
	$this->SetXY(33,239);
	$this->SetFont('Arial','',10);
	$this->Cell(80,5,$GLOBALS['company']->gst,0,'L');
	
	$this->SetXY(134,238);
	$this->SetFont('Arial','B',10);
	$this->Cell(69,7,'','R',0,'L');
	$this->SetXY(134,239);
	$this->SetFont('Arial','',10);
	$this->Cell(28,5,'Against Form :-',0,'L');
	$this->SetXY(162,239);
	$this->SetFont('Arial','',10);
	$this->Cell(41,5,$GLOBALS['data']->agnst,0,'L');
	
	$this->SetXY(134,245);
	$this->SetFont('Arial','B',10);
	$this->Cell(69,38,'',1,0,'L');
	$this->SetXY(7,245);
	$this->SetFont('Arial','B',10);
	$this->Cell(127,38,'','LBT',0,'L');
	
	$this->SetXY(7,244);
	$this->SetFont('Arial','UB',9);
	$this->Cell(127,5,'Terms & Condition :-','',0,'L');
	$this->SetXY(7,249);
	$this->SetFont('Arial','',7);
	$this->Cell(127,3,'# 24 % Interest will be charged for the amount due after one month from the date of delivery.',0,0,'L');
	
	$this->SetXY(7,252);
	$this->SetFont('Arial','',7);
	$this->Cell(127,3,'# Our risk and responsibilities ceases after goods leave godown.',0,0,'L');
	
	$this->SetXY(7,255);
	$this->SetFont('Arial','',7);
	$this->Cell(127,3,'# Goods once sold will not be taken back.',0,0,'L');
	
	$this->SetXY(7,258);
	$this->SetFont('Arial','',7);
	$this->Cell(127,3,'# If any complain please inform us within 24 hours on receipt of bill.',0,0,'L');
	
	$this->SetXY(7,261);
	$this->SetFont('Arial','',8);
	$this->Cell(127,4,'# SUBJECT TO AHMEDABAD JURISDICTION.',0,0,'L');
	
	$this->SetXY(7,278);
	$this->SetFont('Arial','',10);
	$this->Cell(69,5,'Receiver\'s Signature',0,0,'L');
	
	$this->SetXY(134,245);
	$this->SetFont('Arial','',6);
	$this->Cell(69,2,'E.&O.E.',0,0,'C');
	
	$this->SetXY(134,248);
	$this->SetFont('Arial','B',10);
	$this->MultiCell(69,4,$GLOBALS['company']->company_name,0,'C');
	if( !empty($GLOBALS['company']->stamp_img) )
	{		
	$this->Image('../'.$GLOBALS['company']->stamp_img,153.5,253,30,30);
	}
	$this->SetXY(134,281);
	$this->SetFont('Arial','B',7);
	$this->Cell(69,2,'(Authorised Signatory)',0,0,'C');
	
	$this->SetY(-17);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	
	$this->Image('../'.$GLOBALS['company']->footer_img,0,287,211,9);
}
}

$pdf = new PDF();
$pdf->AliasNbPages();

	
	
	
	$result = $conn->query("SELECT COUNT(*) as row FROM quatation_detail_mst WHERE s_id = '".$data->s_id."'");
	$r = $result->fetch_object(); $limit = 12; $start = 0;
$sr_no = 0; $sub_total = 0;
	if( $r->row > 12 )
	{
		 for($i = 1; $i <= ceil($r->row / 12); $i++ )
		 {
			 $pdf->AddPage();
				if( $i == 1 )
				{
					$start = 0; $c = 0;
					$detail = $conn->query("SELECT * FROM `quatation_detail_mst` WHERE s_id = '".$data->s_id."' limit ".$start.",".$limit);
						while($detailr = $detail->fetch_object())
						{ $sr_no++;
							$pdf->SetXY(7,104 + $c);
								$pdf->SetFont('Arial','',10);
								$pdf->Cell(15,10,$sr_no,0,0,'C');
								if( $pdf->GetStringWidth($detailr->pr_name) > 81 )
								{
									$pdf->SetXY(22,104 + $c);
									$pdf->SetFont('Arial','',10);
									$pdf->MultiCell(83,5,$detailr->pr_name,0,'L');
								}
								else 
								{
									$pdf->SetXY(22,104 + $c);
									$pdf->SetFont('Arial','',10);
									$pdf->Cell(83,10,$detailr->pr_name,0,0,'L');
								}
								
								$pdf->SetXY(105,104 + $c);
								$pdf->SetFont('Arial','',10);
								$pdf->Cell(18,10,$detailr->unit,'',0,'C');
								
								$pdf->SetXY(123,104 + $c);
								$pdf->SetFont('Arial','',10);
								$pdf->Cell(30,10,$detailr->qty,'',0,'C');
								
								if( $pdf->GetStringWidth($detailr->remark) > 48 )
								{
								$pdf->SetXY(153,104 + $c);
								$pdf->SetFont('Arial','',10);
								$pdf->MultiCell(50,5,$detailr->remark,'','C');
								}
								else
								{
								$pdf->SetXY(153,104 + $c);
								$pdf->SetFont('Arial','',10);
								$pdf->Cell(50,10,$detailr->remark,'',0,'C');
								}
								$sub_total += $detailr->qty;
								$c += 10;
						}
						$pdf->SetXY(7,231);
						$pdf->SetFont('Arial','B',11);
						$pdf->Cell(196,7,'','LBTR',0,'C');
						$pdf->SetXY(7,231);
						$pdf->SetFont('Arial','',11);
						$pdf->Cell(116,7,'Total :- ','',0,'R');
						$pdf->SetXY(123,231);
						$pdf->SetFont('Arial','',11);
						$pdf->Cell(30,7,$sub_total,0,0,'C');
				}
				else
				{
					$c = 0;
					$start = ($i - 1) * $limit; 
					$detail = $conn->query("SELECT * FROM `quatation_detail_mst` WHERE s_id = '".$data->s_id."' ORDER BY sd_id limit ".$start.",".$limit );
					while($detailr = $detail->fetch_object())
					{ $sr_no++;
						$pdf->SetXY(7,104 + $c);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(15,10,$sr_no,0,0,'C');
							if( $pdf->GetStringWidth($detailr->pr_name) > 81 )
							{
								$pdf->SetXY(22,104 + $c);
								$pdf->SetFont('Arial','',10);
								$pdf->MultiCell(83,5,$detailr->pr_name,0,'L');
							}
							else 
							{
								$pdf->SetXY(22,104 + $c);
								$pdf->SetFont('Arial','',10);
								$pdf->Cell(83,10,$detailr->pr_name,0,0,'L');
							}
							
							$pdf->SetXY(105,104 + $c);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(18,10,$detailr->unit,'',0,'C');
							
							$pdf->SetXY(123,104 + $c);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(30,10,$detailr->qty,'',0,'C');
							
							if( $pdf->GetStringWidth($detailr->remark) > 48 )
							{
							$pdf->SetXY(153,104 + $c);
							$pdf->SetFont('Arial','',10);
							$pdf->MultiCell(50,5,$detailr->remark,'','C');
							}
							else
							{
							$pdf->SetXY(153,104 + $c);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(50,10,$detailr->remark,'',0,'C');
							}
							$sub_total += $detailr->qty;
							$c += 10; 
							
					}
						$pdf->SetXY(7,231);
						$pdf->SetFont('Arial','B',11);
						$pdf->Cell(196,7,'','LBTR',0,'C');
						$pdf->SetXY(7,231);
						$pdf->SetFont('Arial','',11);
						$pdf->Cell(116,7,'Total :- ','',0,'R');
						$pdf->SetXY(123,231);
						$pdf->SetFont('Arial','',11);
						$pdf->Cell(30,7,$sub_total,0,0,'C');
					}
				}
		 }
	else
{
	
	$pdf->AddPage();
	$detail = $conn->query("SELECT * FROM `quatation_detail_mst` WHERE s_id = '".$data->s_id."'");
	$c = 0; $sr_no = 0; $sub_total = 0;
while($detailr = $detail->fetch_object())
{ $sr_no++;
		$pdf->SetXY(7,104 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(15,10,$sr_no,0,0,'C');
		if( $pdf->GetStringWidth($detailr->pr_name) > 81 )
		{
			$pdf->SetXY(22,104 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->MultiCell(83,5,$detailr->pr_name,0,'L');
		}
		else 
		{
			$pdf->SetXY(22,104 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(83,10,$detailr->pr_name,0,0,'L');
		}
		
		$pdf->SetXY(105,104 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(18,10,$detailr->unit,'',0,'C');
		
		$pdf->SetXY(123,104 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(30,10,$detailr->qty,'',0,'C');
		
		if( $pdf->GetStringWidth($detailr->remark) > 48 )
		{
		$pdf->SetXY(153,104 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(50,5,$detailr->remark,'','C');
		}
		else
		{
		$pdf->SetXY(153,104 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(50,10,$detailr->remark,'',0,'C');
		}
		$sub_total += $detailr->qty;
		$c += 10;
	}
	$pdf->SetXY(7,231);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(196,7,'','LBTR',0,'C');
	$pdf->SetXY(7,231);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(116,7,'Total :- ','',0,'R');
	$pdf->SetXY(123,231);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(30,7,$sub_total,0,0,'C');
}	
	
	

$pdf->Output("Chalan - ".$data->s_numner.".pdf", 'D');

?>