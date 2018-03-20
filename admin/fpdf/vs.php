<?php


require_once('fpdf.php');
include_once('../config/config2.php');
include_once('../function/rupees.php');


global $company;
global $data;
global $type;
$type = $_POST['copy'] = "ORIGINAL COPY";
$data = $conn->query("SELECT * FROM `sales_mst` WHERE s_id = '".$_GET['id']."'")->fetch_object();
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
	$this->Cell(70,8,'SALES INVOICE',0,0,'C'); 
	$this->SetX(140);
	$this->SetFont('Arial','',12);
	$this->Cell(63,8,$GLOBALS['type'],0,0,'R');
	$this->Ln();
}

function Footer()
{
	$this->SetXY(134,245);
	$this->SetFont('Arial','B',10);
	$this->Cell(69,38,'',1,0,'L');
	$this->SetXY(7,245);
	$this->SetFont('Arial','B',10);
	$this->Cell(127,38,'','LBT',0,'L');
	
	$this->SetXY(7,245);
	$this->SetFont('Arial','UB',10);
	$this->Cell(127,6,'Terms & Condition :-','',0,'L');
	$this->SetXY(7,251);
	$this->SetFont('Arial','',7);
	$this->Cell(127,6,'# 24 % Interest will be charged for the amount due after one month from the date of delivery.','',0,'L');
	
	$this->SetXY(7,257);
	$this->SetFont('Arial','',7);
	$this->Cell(127,6,'# Our risk and responsibilities ceases after goods leave godown.','',0,'L');
	
	$this->SetXY(7,263);
	$this->SetFont('Arial','',7);
	$this->Cell(127,6,'# Goods once sold will not be taken back.','',0,'L');
	
	$this->SetXY(7,269);
	$this->SetFont('Arial','',7);
	$this->Cell(127,6,'# If any complain please inform us within 24 hours on receipt of bill.','',0,'L');
	
	$this->SetXY(7,275);
	$this->SetFont('Arial','',10);
	$this->Cell(127,6,'# SUBJECT TO AHMEDABAD JURISDICTION.','',0,'L');
	
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
	$result = $conn->query("SELECT COUNT(*) as row FROM sales_detail_mst WHERE s_id = '".$data->s_id."'");
	$r = $result->fetch_object();
//$row = $conn->query("SELECT COUNT(*) as row FROM `sales_detail_mst` WHERE s_id = '".$data->s_id."'")->fetch_object();
$limit = 5; $start = 0;
if( $r->row > 5 )
{
	for($i = 1; $i <= ceil($r->row / 5); $i++ )
	{   
		$pdf->AddPage();
		$start = ($i - 1) * $limit; 
		$detail = $conn->query("SELECT * FROM `sales_detail_mst` WHERE s_id = '".$data->s_id."' ORDER BY sd_id limit ".$start.",".$limit);
		$pdf->SetFont('Times','',12);
	$pdf->SetX(7);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(98,45,'',1,0,'C');
	$pdf->SetX(105);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(98,45,'','TBR',0,'C');
	
	if( strlen($client->client_name) > 21 ){
		$pdf->SetX(7);
		$pdf->SetFont('Arial','B',10);
		$pdf->MultiCell(98,5,'To, '.$client->client_name,0,'L');
	}
	else
	{
		$pdf->SetX(7);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(98,5,'To, '.$client->client_name,0,1,'L');
		$pdf->SetX(7);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(98,5,'',0,0,'L');
	}
	$pdf->SetXY(12,65);
	$pdf->SetFont('Arial','B',10);
	$pdf->MultiCell(93,5,$client->client_address,0,'L');
	$pdf->SetXY(8,92);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(25,5,'GSTIN/UIN :-',0,'L');
	$pdf->SetXY(33,92);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60,5,$client->gst,0,'L');
	
	
	$pdf->SetXY(105,53);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(24.5,5,'Invoice No :- ',0,'L');
	$pdf->SetXY(130,53);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(38,5,$data->s_numner,0,'L');
	
	$pdf->SetXY(169,53);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(14,5,'Date :-',0,'L');
	$pdf->SetXY(183,53);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,5,$data->s_date,0,'L');
	
	$pdf->SetXY(105,58);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(26,5,'Bill Book No :- ',0,'L');
	$pdf->SetXY(131,58);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,5,$data->billbookno,0,'L');
	
	
	$pdf->SetXY(105,87);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(26,5,'Transport :- ',0,'L');
	$pdf->SetXY(131,87);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(70,5,$data->transport,0,'L');
	
	
	$pdf->SetXY(105,82);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(26,5,'L.R.No :- ',0,'L');
	$pdf->SetXY(131,82);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(38,5,$data->lr_no,0,'L');
	
	
	$pdf->SetXY(105,77);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(26,5,'P.O.No :- ',0,'L');
	$pdf->SetXY(131,77);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(38,5,$data->po_no,0,'L');
	
	$pdf->SetXY(105,63);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(26,5,'Ch.No :-  ',0,'L');
	$pdf->SetXY(130,63);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(60,5,$data->ch_no,0,'L');
	
	
	$pdf->SetXY(169,77);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(14,5,'Date :-',0,'L');
	$pdf->SetXY(183,77);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,5,$data->po_date,0,'L');
	
	$pdf->SetXY(169,82);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(14,5,'Date :-',0,'L');
	$pdf->SetXY(183,82);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,5,$data->lr_date,0	,'L');
	
	
	$pdf->SetXY(7,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(12,5,'Sr No.','BL',0,'L');
	$pdf->SetXY(7,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(12,50,'','LR',1,'L');
	
	$pdf->SetXY(19,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(70,5,'Description','BL',0,'C');
	$pdf->SetXY(19,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(70,50,'','R',0,'C');
	
	$pdf->SetXY(89,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(25,5,'HSN/SAC','BL',0,'C');
	$pdf->SetXY(89,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(25,50,'','R',0,'C');
	
	$pdf->SetXY(114,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(9,5,'GST','BL',0,'C');
	$pdf->SetXY(114,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(9,50,'','R',0,'C');
	
	$pdf->SetXY(123,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(12,5,'Unit','BL',0,'C');
	$pdf->SetXY(123,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(12,50,'','R',0,'C');
	
	$pdf->SetXY(135,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,5,'Qty','BL',0,'C');
	$pdf->SetXY(135,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,50,'','R',0,'C');
	
	$pdf->SetXY(155,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,5,'Rate','BL',0,'C');
	$pdf->SetXY(155,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,50,'','R',0,'C');
	
	$pdf->SetXY(175,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(28,5,'Amount','BRL',0,'C');
	$pdf->SetXY(175,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(28,50,'','R',0,'C');
	
	$q = 0; $total = 0;
	$sr = 1; $c = 5; while($detailr = $detail->fetch_object())
	{
		$pdf->SetXY(7,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(12,10,$sr,'',0,'C');
		if(strlen($detailr->pr_name) > 40)
		{
			$pdf->SetXY(19,98 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->MultiCell(70,5,$detailr->pr_name,'','C');
		}
		else
		{
			$pdf->SetXY(19,98 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(70,10,$detailr->pr_name,'',0,'C');
		}
		$pdf->SetXY(89,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,10,$detailr->HSN,'',0,'C');
		$pdf->SetXY(114,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(9,10,$detailr->grate." %",'',0,'C');
		$pdf->SetXY(123,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(12,10,$detailr->unit,'',0,'C');
		$pdf->SetXY(135,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,10,$detailr->qty,'',0,'C');
		$pdf->SetXY(155,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,10,$detailr->rate,'',0,'C');
		$pdf->SetXY(175,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(28,10,$detailr->amt,'',0,'R');
		
		$total += $detailr->amt; 
		$q += $detailr->qty;
		$c += 10;
		$sr++;
	}
	
		$pdf->SetXY(7,153);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(128,6,'Total :-','BRLT',0,'R');
		$pdf->SetXY(135,153);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,6,$q,'BRT',0,'C');
		$pdf->SetXY(155,153);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,6,'','BT',0,'C');
		$pdf->SetXY(175,153);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(28,6,$total,'BRLT',0,'R');
		
		$pdf->SetXY(7,159);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(128,34,'','BRL',0,'R');
		$pdf->SetXY(7,159);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(22,5,'Against Form :-','B',0,'L');
		$pdf->SetXY(29,159);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(70,5,$data->agnst,'B',0,'L');
		$pdf->SetXY(117,159);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(18,5,$data->due_date,'B',0,'L');
		$pdf->SetXY(99,159);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(18,5,'Due Date :- ','B',0,'L');
		
		$pdf->SetXY(7,164);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(24,8,'GSTIN/UIN :- ','B',0,'L');
		$pdf->SetXY(31,164);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(104,8,$company->gst,'B',0,'L');
		
		$pdf->SetXY(135,159);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(68,34,'','R',0,'L');
		
		$pdf->SetXY(135,159);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,7,'Basic Amount :-',0,0,'L');
		$pdf->SetXY(165,159);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(38,7,$total,0,0,'R');
		
		if($data->cgst != '0.00')
		{
			if($data->freight != '0.00')
			{
				$pdf->SetXY(135,168);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'SGST :- ',0,0,'L');
				$pdf->SetXY(165,168);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->sgst,0,0,'R');
				$pdf->SetXY(135,174);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'CGST :- ',0,0,'L');
				$pdf->SetXY(165,174);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->cgst,0,0,'R');
				$pdf->SetXY(135,180);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'Freight :- ',0,0,'L');
				$pdf->SetXY(165,180);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->freight,0,0,'R');
			}else
			{
				$pdf->SetXY(135,174);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'SGST :- ',0,0,'L');
				$pdf->SetXY(165,174);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->sgst,0,0,'R');
				$pdf->SetXY(135,180);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'CGST :- ',0,0,'L');
				$pdf->SetXY(165,180);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->cgst,0,0,'R');
			}
		}
		else if($data->igst != '0.00')
		{
			if($data->freight != '0.00')
			{
				$pdf->SetXY(135,174);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'IGST :- ',0,0,'L');
				$pdf->SetXY(165,174);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->igst,0,0,'R');
				$pdf->SetXY(135,180);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'Freight :- ',0,0,'L');
				$pdf->SetXY(165,180);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->freight,0,0,'R');
			}else
			{
				$pdf->SetXY(135,180);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'IGST :- ',0,0,'L');
				$pdf->SetXY(165,180);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->igst,0,0,'R');
			}
		}
		
		
		$pdf->SetXY(135,186);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,7,'Total Amount :- ','BT',0,'L');
		$pdf->SetXY(165,186);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(38,7,$data->total_amt,'BT',0,'R');
		$pdf->SetXY(7,172);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(33,5,'Goods Despatch From :- ','',0,'L');
		$pdf->SetXY(40,172);
		$pdf->SetFont('Arial','',8);
		$pdf->MultiCell(31,5,$data->from,'','L');
		
		$pdf->SetXY(7,182);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(33,5,'Goods Despatch To :- ','',0,'L');
		$pdf->SetXY(40,182);
		$pdf->SetFont('Arial','',8);
		$pdf->MultiCell(31,5,$data->to,'','L');
		
		$pdf->SetXY(75,172);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(15,5,'Remark :- ','',0,'L');
		$pdf->SetXY(91,172);
		$pdf->SetFont('Arial','',8);
		$pdf->MultiCell(31,5,$data->remark,'','L');
		
		
			$pdf->SetXY(7,193);
			$pdf->SetFont('Arial','B',10);
			$pdf->MultiCell(196,5,strtoupper(getIndianCurrency($data->total_amt)),'','L');
			
			$pdf->SetXY(7,193);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(196,10,'','LRB','L');
		
			$pdf->SetXY(7,203);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(75,8,'HSN/SAC','LRB',0,'C');
			$pdf->SetXY(82,203);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(39,8,'Taxable Value','LRB',0,'C');
			$pdf->SetXY(121,203);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(41,4,'Central Tax','LB',0,'C');
			$pdf->SetXY(162,203);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(41,4,'State Tax','RLB',0,'C');
			$pdf->SetXY(162,207);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(13,4,'Rate','LB',0,'C');
			$pdf->SetXY(175,207);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(28,4,'Amount','LBR',0,'C');
			$pdf->SetXY(121,207);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(13,4,'Rate','LB',0,'C');
			$pdf->SetXY(134,207);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(28,4,'Amount','LB',0,'C');
			
			
			$pdf->SetXY(7,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(196,20,'','LRB',0,'C');
			$pdf->SetXY(81,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(1,20,'','R',0,'C');
			$detaila = $conn->query("SELECT * FROM `sales_detail_mst` WHERE s_id = '".$data->s_id."' ORDER BY sd_id limit ".$start.",".$limit);
			$ac = 0;
			$tval = 0; $tax = 0;
		while($detailar = $detaila->fetch_object())
			{
				$pdf->SetXY(7,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(75,4,$detailar->HSN,'',0,'L');
				$pdf->SetXY(82,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(39,4,$detailar->amt,'',0,'R');
				$pdf->SetXY(121,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(13,4,$detailar->grate / 2 . ' %','',0,'C');
				$pdf->SetXY(134,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(28,4,$detailar->amt * $detailar->grate / 100 / 2 ,'',0,'R');
				$pdf->SetXY(162,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(13,4,$detailar->grate / 2 . ' %','',0,'C');
				$pdf->SetXY(175,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(28,4,$detailar->amt * $detailar->grate / 100 / 2,'',0,'R');
				$ac += 4;
				$tval += $detailar->amt;
				$tax += $detailar->amt * $detailar->grate / 100;
			}
			$pdf->SetXY(120,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(1,20,'','R',0,'C');
			$pdf->SetXY(133,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(1,20,'','R',0,'C');
			$pdf->SetXY(162,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(1,20,'','L',0,'R');
			$pdf->SetXY(174,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(1,20,'','R',0,'C');
			$pdf->SetXY(7,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(75,5,'Total :-','RLB',0,'R');
			$pdf->SetXY(82,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(39,5,$tval,'RB',0,'R');
			$pdf->SetXY(121,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(13,5,'','RB',0,'R');
			$pdf->SetXY(134,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(28,5,$tax / 2,'RB',0,'R');
			$pdf->SetXY(162,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(13,5,'','RB',0,'R');
			$pdf->SetXY(175,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(28,5,$tax / 2,'RB',0,'R');
			
			
			$pdf->SetXY(7,236);
			$pdf->SetFont('Arial','B',10);
			$pdf->MultiCell(196,4,getIndianCurrency($tax),'','L');
			
			$pdf->SetXY(7,236);
			$pdf->SetFont('Arial','B',10);
			$pdf->MultiCell(196,9,'','LR','L');
	}
}
else
{
	$detail = $conn->query("SELECT * FROM `sales_detail_mst` WHERE s_id = '".$data->s_id."'");
$pdf->AddPage();
$pdf->SetFont('Times','',12);
	$pdf->SetX(7);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(98,45,'',1,0,'C');
	$pdf->SetX(105);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(98,45,'','TBR',0,'C');
	
	if( strlen($client->client_name) > 21 ){
		$pdf->SetX(7);
		$pdf->SetFont('Arial','B',10);
		$pdf->MultiCell(98,5,'To, '.$client->client_name,0,'L');
	}
	else
	{
		$pdf->SetX(7);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(98,5,'To, '.$client->client_name,0,1,'L');
		$pdf->SetX(7);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(98,5,'',0,0,'L');
	}
	$pdf->SetXY(12,65);
	$pdf->SetFont('Arial','B',10);
	$pdf->MultiCell(93,5,$client->client_address,0,'L');
	$pdf->SetXY(8,92);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(25,5,'GSTIN/UIN :-',0,'L');
	$pdf->SetXY(33,92);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60,5,$client->gst,0,'L');
	
	
	$pdf->SetXY(105,53);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(24.5,5,'Invoice No :- ',0,'L');
	$pdf->SetXY(130,53);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(38,5,$data->s_numner,0,'L');
	
	$pdf->SetXY(169,53);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(14,5,'Date :-',0,'L');
	$pdf->SetXY(183,53);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,5,$data->s_date,0,'L');
	
	$pdf->SetXY(105,58);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(26,5,'Bill Book No :- ',0,'L');
	$pdf->SetXY(131,58);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,5,$data->billbookno,0,'L');
	
	
	$pdf->SetXY(105,87);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(26,5,'Transport :- ',0,'L');
	$pdf->SetXY(131,87);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(70,5,$data->transport,0,'L');
	
	
	$pdf->SetXY(105,82);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(26,5,'L.R.No :- ',0,'L');
	$pdf->SetXY(131,82);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(38,5,$data->lr_no,0,'L');
	
	
	$pdf->SetXY(105,77);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(26,5,'P.O.No :- ',0,'L');
	$pdf->SetXY(131,77);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(38,5,$data->po_no,0,'L');
	
	$pdf->SetXY(105,63);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(26,5,'Ch.No :-  ',0,'L');
	$pdf->SetXY(130,63);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(60,5,$data->ch_no,0,'L');
	
	
	$pdf->SetXY(169,77);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(14,5,'Date :-',0,'L');
	$pdf->SetXY(183,77);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,5,$data->po_date,0,'L');
	
	$pdf->SetXY(169,82);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(14,5,'Date :-',0,'L');
	$pdf->SetXY(183,82);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,5,$data->lr_date,0	,'L');
	
	
	$pdf->SetXY(7,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(12,5,'Sr No.','BL',0,'L');
	$pdf->SetXY(7,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(12,50,'','LR',1,'L');
	
	$pdf->SetXY(19,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(70,5,'Description','BL',0,'C');
	$pdf->SetXY(19,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(70,50,'','R',0,'C');
	
	$pdf->SetXY(89,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(25,5,'HSN/SAC','BL',0,'C');
	$pdf->SetXY(89,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(25,50,'','R',0,'C');
	
	$pdf->SetXY(114,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(9,5,'GST','BL',0,'C');
	$pdf->SetXY(114,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(9,50,'','R',0,'C');
	
	$pdf->SetXY(123,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(12,5,'Unit','BL',0,'C');
	$pdf->SetXY(123,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(12,50,'','R',0,'C');
	
	$pdf->SetXY(135,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,5,'Qty','BL',0,'C');
	$pdf->SetXY(135,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,50,'','R',0,'C');
	
	$pdf->SetXY(155,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,5,'Rate','BL',0,'C');
	$pdf->SetXY(155,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,50,'','R',0,'C');
	
	$pdf->SetXY(175,98);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(28,5,'Amount','BRL',0,'C');
	$pdf->SetXY(175,103);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(28,50,'','R',0,'C');
	
	$q = 0; $total = 0;
	$sr = 1; $c = 5; while($detailr = $detail->fetch_object())
	{
		$pdf->SetXY(7,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(12,10,$sr,'',0,'C');
		if(strlen($detailr->pr_name) > 40)
		{
			$pdf->SetXY(19,98 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->MultiCell(70,5,$detailr->pr_name,'','C');
		}
		else
		{
			$pdf->SetXY(19,98 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(70,10,$detailr->pr_name,'',0,'C');
		}
		$pdf->SetXY(89,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,10,$detailr->HSN,'',0,'C');
		$pdf->SetXY(114,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(9,10,$detailr->grate." %",'',0,'C');
		$pdf->SetXY(123,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(12,10,$detailr->unit,'',0,'C');
		$pdf->SetXY(135,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,10,$detailr->qty,'',0,'C');
		$pdf->SetXY(155,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(20,10,$detailr->rate,'',0,'C');
		$pdf->SetXY(175,98 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(28,10,$detailr->amt,'',0,'R');
		
		$total += $detailr->amt; 
		$q += $detailr->qty;
		$c += 10;
		$sr++;
	}
	
		$pdf->SetXY(7,153);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(128,6,'Total :-','BRLT',0,'R');
		$pdf->SetXY(135,153);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,6,$q,'BRT',0,'C');
		$pdf->SetXY(155,153);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,6,'','BT',0,'C');
		$pdf->SetXY(175,153);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(28,6,$total,'BRLT',0,'R');
		
		$pdf->SetXY(7,159);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(128,34,'','BRL',0,'R');
		$pdf->SetXY(7,159);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(22,5,'Against Form :-','B',0,'L');
		$pdf->SetXY(29,159);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(70,5,$data->agnst,'B',0,'L');
		$pdf->SetXY(117,159);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(18,5,$data->due_date,'B',0,'L');
		$pdf->SetXY(99,159);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(18,5,'Due Date :- ','B',0,'L');
		
		$pdf->SetXY(7,164);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(24,8,'GSTIN/UIN :- ','B',0,'L');
		$pdf->SetXY(31,164);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(104,8,$company->gst,'B',0,'L');
		
		$pdf->SetXY(135,159);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(68,34,'','R',0,'L');
		
		$pdf->SetXY(135,159);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,7,'Basic Amount :-',0,0,'L');
		$pdf->SetXY(165,159);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(38,7,$total,0,0,'R');
		
		if($data->cgst != '0.00')
		{
			if($data->freight != '0.00')
			{
				$pdf->SetXY(135,168);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'SGST :- ',0,0,'L');
				$pdf->SetXY(165,168);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->sgst,0,0,'R');
				$pdf->SetXY(135,174);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'CGST :- ',0,0,'L');
				$pdf->SetXY(165,174);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->cgst,0,0,'R');
				$pdf->SetXY(135,180);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'Freight :- ',0,0,'L');
				$pdf->SetXY(165,180);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->freight,0,0,'R');
			}else
			{
				$pdf->SetXY(135,174);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'SGST :- ',0,0,'L');
				$pdf->SetXY(165,174);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->sgst,0,0,'R');
				$pdf->SetXY(135,180);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'CGST :- ',0,0,'L');
				$pdf->SetXY(165,180);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->cgst,0,0,'R');
			}
		}
		else if($data->igst != '0.00')
		{
			if($data->freight != '0.00')
			{
				$pdf->SetXY(135,174);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'IGST :- ',0,0,'L');
				$pdf->SetXY(165,174);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->igst,0,0,'R');
				$pdf->SetXY(135,180);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'Freight :- ',0,0,'L');
				$pdf->SetXY(165,180);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->freight,0,0,'R');
			}else
			{
				$pdf->SetXY(135,180);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30,6,'IGST :- ',0,0,'L');
				$pdf->SetXY(165,180);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(38,6,$data->igst,0,0,'R');
			}
		}
		
		
		$pdf->SetXY(135,186);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,7,'Total Amount :- ','BT',0,'L');
		$pdf->SetXY(165,186);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(38,7,$data->total_amt,'BT',0,'R');
		$pdf->SetXY(7,172);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(33,5,'Goods Despatch From :- ','',0,'L');
		$pdf->SetXY(40,172);
		$pdf->SetFont('Arial','',8);
		$pdf->MultiCell(31,5,$data->from,'','L');
		
		$pdf->SetXY(7,182);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(33,5,'Goods Despatch To :- ','',0,'L');
		$pdf->SetXY(40,182);
		$pdf->SetFont('Arial','',8);
		$pdf->MultiCell(31,5,$data->to,'','L');
		
		$pdf->SetXY(75,172);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(15,5,'Remark :- ','',0,'L');
		$pdf->SetXY(91,172);
		$pdf->SetFont('Arial','',8);
		$pdf->MultiCell(31,5,$data->remark,'','L');
		
		
			$pdf->SetXY(7,193);
			$pdf->SetFont('Arial','B',10);
			$pdf->MultiCell(196,5,strtoupper(getIndianCurrency($data->total_amt)),'','L');
			
			$pdf->SetXY(7,193);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(196,10,'','LRB','L');
		
			$pdf->SetXY(7,203);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(75,8,'HSN/SAC','LRB',0,'C');
			$pdf->SetXY(82,203);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(39,8,'Taxable Value','LRB',0,'C');
			$pdf->SetXY(121,203);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(41,4,'Central Tax','LB',0,'C');
			$pdf->SetXY(162,203);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(41,4,'State Tax','RLB',0,'C');
			$pdf->SetXY(162,207);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(13,4,'Rate','LB',0,'C');
			$pdf->SetXY(175,207);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(28,4,'Amount','LBR',0,'C');
			$pdf->SetXY(121,207);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(13,4,'Rate','LB',0,'C');
			$pdf->SetXY(134,207);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(28,4,'Amount','LB',0,'C');
			
			
			$pdf->SetXY(7,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(196,20,'','LRB',0,'C');
			$pdf->SetXY(81,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(1,20,'','R',0,'C');
			$detaila = $conn->query("SELECT * FROM `sales_detail_mst` WHERE s_id = '".$data->s_id."'");
			$ac = 0;
			$tval = 0; $tax = 0;
		while($detailar = $detaila->fetch_object())
			{
				$pdf->SetXY(7,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(75,4,$detailar->HSN,'',0,'L');
				$pdf->SetXY(82,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(39,4,$detailar->amt,'',0,'R');
				$pdf->SetXY(121,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(13,4,$detailar->grate / 2 . ' %','',0,'C');
				$pdf->SetXY(134,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(28,4,$detailar->amt * $detailar->grate / 100 / 2 ,'',0,'R');
				$pdf->SetXY(162,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(13,4,$detailar->grate / 2 . ' %','',0,'C');
				$pdf->SetXY(175,211 + $ac);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(28,4,$detailar->amt * $detailar->grate / 100 / 2,'',0,'R');
				$ac += 4;
				$tval += $detailar->amt;
				$tax += $detailar->amt * $detailar->grate / 100;
			}
			$pdf->SetXY(120,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(1,20,'','R',0,'C');
			$pdf->SetXY(133,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(1,20,'','R',0,'C');
			$pdf->SetXY(162,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(1,20,'','L',0,'R');
			$pdf->SetXY(174,211);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(1,20,'','R',0,'C');
			$pdf->SetXY(7,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(75,5,'Total :-','RLB',0,'R');
			$pdf->SetXY(82,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(39,5,$tval,'RB',0,'R');
			$pdf->SetXY(121,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(13,5,'','RB',0,'R');
			$pdf->SetXY(134,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(28,5,$tax / 2,'RB',0,'R');
			$pdf->SetXY(162,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(13,5,'','RB',0,'R');
			$pdf->SetXY(175,231);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(28,5,$tax / 2,'RB',0,'R');
			
			
			$pdf->SetXY(7,236);
			$pdf->SetFont('Arial','B',10);
			$pdf->MultiCell(196,4,getIndianCurrency($tax),'','L');
			
			$pdf->SetXY(7,236);
			$pdf->SetFont('Arial','B',10);
			$pdf->MultiCell(196,9,'','LR','L');
}
	

	$pdf->Output("../save/Sales-".$data->s_numner.md5(time()).".pdf", 'F');






?>
