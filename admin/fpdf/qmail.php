<?php


require('fpdf.php');

include_once('../config/config2.php');

include_once('../function/rupees.php');

global $company;

global $data;

global $type , $client;

global $qun ,$total;

$data = $conn->query("SELECT * FROM `n_quat_mst` WHERE s_id = '".$_GET['id']."'")->fetch_object();

$company = $con->query("SELECT * FROM `company_mas` WHERE company_id = '".$data->c_id."'")->fetch_object();

$client = $con->query("SELECT * FROM `client_master` WHERE client_id = '".$data->act_no."'")->fetch_object();

$detail = $conn->query("SELECT * FROM `n_quat_detail_mst` WHERE s_id = '".$data->s_id."'");





class PDF extends FPDF

{

function Header()

{

	$this->Image('../'.$GLOBALS['company']->header_img,0,0,210,45);

    $this->Ln(35);

	$this->SetX(70);

	$this->SetFont('Arial','',12);

	$this->Cell(70,8,'QUATATION',0,1,'C'); 

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

	$this->Cell(24.5,5,'Qu. No :- ',0,'L');

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

	$this->Cell(12,6,'Sr No.','BLR',0,'C');

	$this->SetXY(7,104);

	$this->SetFont('Arial','B',10);

	$this->Cell(12,90,'','LR',1,'L');

	

	$this->SetXY(19,98);

	$this->SetFont('Arial','B',11);

	$this->Cell(70,6,'Description','BR',0,'C');

	$this->SetXY(19,104);

	$this->SetFont('Arial','B',10);

	$this->Cell(70,90,'','R',1,'L');

	

	$this->SetXY(89,98);

	$this->SetFont('Arial','B',11);

	$this->Cell(25,6,'HSN/SAC','BR',0,'C');

	$this->SetXY(89,104);

	$this->SetFont('Arial','B',10);

	$this->Cell(25,90,'','R',1,'L');

	

	$this->SetXY(114,98);

	$this->SetFont('Arial','B',11);

	$this->Cell(9,6,'GST','BR',0,'C');

	$this->SetXY(114,104);

	$this->SetFont('Arial','B',10);

	$this->Cell(9,90,'','R',1,'L');

	

	$this->SetXY(123,98);

	$this->SetFont('Arial','B',11);

	$this->Cell(12,6,'Unit','BR',0,'C');

	$this->SetXY(123,104);

	$this->SetFont('Arial','B',10);

	$this->Cell(12,97,'','R',1,'L');

	

	$this->SetXY(135,98);

	$this->SetFont('Arial','B',10);

	$this->Cell(20,6,'Qty','BR',0,'C');

	$this->SetXY(135,104);

	$this->SetFont('Arial','B',10);

	$this->Cell(20,97,'','R',0,'C');

	

	$this->SetXY(155,98);

	$this->SetFont('Arial','B',10);

	$this->Cell(20,6,'Rate','BR',0,'C');

	$this->SetXY(155,104);

	$this->SetFont('Arial','B',10);

	$this->Cell(20,97,'','R',0,'C');

	

	$this->SetXY(175,98);

	$this->SetFont('Arial','B',11);

	$this->Cell(28,6,'Amount','BR',0,'C');

	$this->SetXY(175,104);

	$this->SetFont('Arial','B',10);

	$this->Cell(28,97,'','R',1,'L');

	

	

}



function Footer()

{

	include_once('../function/rupees.php');

	$this->SetXY(7,194);

		$this->SetFont('Arial','B',10);

		$this->Cell(196,7,'','TBRL',0,'R');

		

		$this->SetXY(7,194);

		$this->SetFont('Arial','B',11);

		$this->Cell(128,7,'Total : - ',0,0,'R');

		

		$this->SetXY(135,194);

		$this->SetFont('Arial','',11);

		$this->Cell(20,7,$GLOBALS['qun'],0,0,'C');

		

		$this->SetXY(175,194);

		$this->SetFont('Arial','',11);

		$this->Cell(28,7,$GLOBALS['total'],0,0,'R');

		

		$this->SetXY(7,201);

		$this->SetFont('Arial','B',10);

		$this->Cell(128,34,'','TBRL',0,'R');

		$this->SetXY(7,201);

		$this->SetFont('Arial','',8);

		$this->Cell(22,5,'Against Form :-','B',0,'L');

		$this->SetXY(29,201);

		$this->SetFont('Arial','',8);

		$this->Cell(70,5,$GLOBALS['data']->agnst,'B',0,'L');

		$this->SetXY(117,201);

		$this->SetFont('Arial','',8);

		$this->Cell(18,5,$GLOBALS['data']->due_date,'B',0,'L');

		$this->SetXY(99,201);

		$this->SetFont('Arial','',8);

		$this->Cell(18,5,'Due Date :- ','B',0,'L');

		

		$this->SetXY(7,207);

		$this->SetFont('Arial','',10);

		$this->Cell(24,8,'GSTIN/UIN :- ','B',0,'L');

		$this->SetXY(31,207);

		$this->SetFont('Arial','',10);

		$this->Cell(104,8,$GLOBALS['company']->gst,'B',0,'L');

		

		$this->SetXY(135,201);

		$this->SetFont('Arial','',10);

		$this->Cell(68,34,'','R',0,'L');

		

		$this->SetXY(135,201);

		$this->SetFont('Arial','B',10);

		$this->Cell(30,7,'Basic Amount :-','T',0,'L');

		$this->SetXY(165,201);

		$this->SetFont('Arial','B',10);

		$this->Cell(38,7,$GLOBALS['total'],'T',0,'R');

		

		if($GLOBALS['data']->cgst != '0.00')

		{

			if($GLOBALS['data']->freight != '0.00')

			{

				$this->SetXY(135,210);

				$this->SetFont('Arial','',10);

				$this->Cell(30,6,'SGST :- ',0,0,'L');

				$this->SetXY(165,210);

				$this->SetFont('Arial','B',10);

				$this->Cell(38,6,$GLOBALS['data']->sgst,0,0,'R');

				$this->SetXY(135,216);

				$this->SetFont('Arial','',10);

				$this->Cell(30,6,'CGST :- ',0,0,'L');

				$this->SetXY(165,216);

				$this->SetFont('Arial','B',10);

				$this->Cell(38,6,$GLOBALS['data']->cgst,0,0,'R');

				$this->SetXY(135,222);

				$this->SetFont('Arial','',10);

				$this->Cell(30,6,'Freight :- ',0,0,'L');

				$this->SetXY(165,222);

				$this->SetFont('Arial','B',10);

				$this->Cell(38,6,$GLOBALS['data']->freight,0,0,'R');

			}else

			{

				$this->SetXY(135,216);

				$this->SetFont('Arial','',10);

				$this->Cell(30,6,'SGST :- ',0,0,'L');

				$this->SetXY(165,216);

				$this->SetFont('Arial','B',10);

				$this->Cell(38,6,$GLOBALS['data']->sgst,0,0,'R');

				$this->SetXY(135,222);

				$this->SetFont('Arial','',10);

				$this->Cell(30,6,'CGST :- ',0,0,'L');

				$this->SetXY(165,222);

				$this->SetFont('Arial','B',10);

				$this->Cell(38,6,$GLOBALS['data']->cgst,0,0,'R');

			}

		}

		else if($GLOBALS['data']->igst != '0.00')

		{

			if($GLOBALS['data']->freight != '0.00')

			{

				$this->SetXY(135,216);

				$this->SetFont('Arial','',10);

				$this->Cell(30,6,'IGST :- ',0,0,'L');

				$this->SetXY(165,216);

				$this->SetFont('Arial','B',10);

				$this->Cell(38,6,$GLOBALS['data']->igst,0,0,'R');

				$this->SetXY(135,222);

				$this->SetFont('Arial','',10);

				$this->Cell(30,6,'Freight :- ',0,0,'L');

				$this->SetXY(165,222);

				$this->SetFont('Arial','B',10);

				$this->Cell(38,6,$GLOBALS['data']->freight,0,0,'R');

			}else

			{

				$this->SetXY(135,222);

				$this->SetFont('Arial','',10);

				$this->Cell(30,6,'IGST :- ',0,0,'L');

				$this->SetXY(165,222);

				$this->SetFont('Arial','B',10);

				$this->Cell(38,6,$GLOBALS['data']->igst,0,0,'R');

			}

		}

		

		

		$this->SetXY(135,228);

		$this->SetFont('Arial','B',10);

		$this->Cell(30,7,'Total Amount :- ','BT',0,'L');

		$this->SetXY(165,228);

		$this->SetFont('Arial','B',10);

		$this->Cell(38,7,$GLOBALS['data']->total_amt,'BT',0,'R');

		$this->SetXY(7,215);

		$this->SetFont('Arial','',8);

		$this->Cell(33,5,'Goods Despatch From :- ','',0,'L');

		$this->SetXY(40,215);

		$this->SetFont('Arial','',8);

		$this->MultiCell(31,5,$GLOBALS['data']->from,'','L');

		

		$this->SetXY(7,225);

		$this->SetFont('Arial','',8);

		$this->Cell(33,5,'Goods Despatch To :- ','',0,'L');

		$this->SetXY(40,225);

		$this->SetFont('Arial','',8);

		$this->MultiCell(31,5,$GLOBALS['data']->to,0,'L');

		

		$this->SetXY(75,225);

		$this->SetFont('Arial','',8);

		$this->Cell(15,5,'Remark :- ','',0,'L');

		$this->SetXY(91,225);

		$this->SetFont('Arial','',8);

		$this->MultiCell(31,5,$GLOBALS['data']->remark,'','L');

		

		

			$this->SetXY(7,235);

			$this->SetFont('Arial','B',10);

			$this->MultiCell(196,5,strtoupper(getIndianCurrency($GLOBALS['data']->total_amt)),0,'L');

			$this->SetXY(7,235);

			$this->SetFont('Arial','',10);

			$this->MultiCell(196,10,'','RL','L');

	

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

	

	$this->Image('../'.$GLOBALS['company']->footer_img,0,287,211,10);

}

}



$pdf = new PDF();

$pdf->AliasNbPages();



	$qun = 0; $total = 0;

	$result = $conn->query("SELECT COUNT(*) as row FROM n_quat_detail_mst WHERE s_id = '".$data->s_id."'");

	$r = $result->fetch_object(); $limit = 9; $start = 0;

	

	if( $r->row > 9 )

	{ $sr_no = 0;

		 for($i = 1; $i <= ceil($r->row / 9); $i++ )

		 {   $pdf->AddPage();

			

			if( $i == 1 )

			{

				$start = 0; $c = 0;	

				$detail = $conn->query("SELECT * FROM `n_quat_detail_mst` WHERE s_id = '".$data->s_id."' ORDER BY sd_id limit ".$start.",".$limit );

				while($detailr = $detail->fetch_object())

				{ $sr_no++;

						$pdf->SetXY(7,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(12,10,$sr_no,0,0,'C');

							

							

						if( $pdf->GetStringWidth($detailr->pr_name) > 68 )

						{

							$pdf->SetXY(19,104 + $c);

							$pdf->SetFont('Arial','',10);

							$pdf->MultiCell(70,5,$detailr->pr_name,'','C');

						}

						else

						{

							$pdf->SetXY(19,104 + $c);

							$pdf->SetFont('Arial','',10);

							$pdf->Cell(70,10,$detailr->pr_name,'',0,'C');

						}

						

						$pdf->SetXY(89,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(25,10,$detailr->HSN,'',0,'C');

						

						$pdf->SetXY(114,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(9,10,$detailr->grate ." %",'',0,'C');

						

						$pdf->SetXY(123,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(12,10,$detailr->unit,'',0,'C');

						

						$pdf->SetXY(135,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(20,10,$detailr->qty,'',0,'C');



						$pdf->SetXY(155,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(20,10,$detailr->rate,'',0,'C');

						

						$pdf->SetXY(175,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(28,10,$detailr->amt,'',0,'R');

							

							$qun += $detailr->qty;

							$total += $detailr->amt;

							$c += 10;

				}

			}

			else

			{

				$c = 0;

				$start = ($i - 1) * $limit; 

				$detail = $conn->query("SELECT * FROM `n_quat_detail_mst` WHERE s_id = '".$data->s_id."' ORDER BY sd_id limit ".$start.",".$limit );

				while($detailr = $detail->fetch_object())

				{ $sr_no++;

					$pdf->SetXY(7,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(12,10,$sr_no,0,0,'C');

							

							

						if( $pdf->GetStringWidth($detailr->pr_name) > 68 )

						{

							$pdf->SetXY(19,104 + $c);

							$pdf->SetFont('Arial','',10);

							$pdf->MultiCell(70,5,$detailr->pr_name,'','C');

						}

						else

						{

							$pdf->SetXY(19,104 + $c);

							$pdf->SetFont('Arial','',10);

							$pdf->Cell(70,10,$detailr->pr_name,'',0,'C');

						}

						

						$pdf->SetXY(89,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(25,10,$detailr->HSN,'',0,'C');

						

						$pdf->SetXY(114,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(9,10,$detailr->grate ." %",'',0,'C');

						

						$pdf->SetXY(123,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(12,10,$detailr->unit,'',0,'C');

						

						$pdf->SetXY(135,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(20,10,$detailr->qty,'',0,'C');



						$pdf->SetXY(155,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(20,10,$detailr->rate,'',0,'C');

						

						$pdf->SetXY(175,104 + $c);

						$pdf->SetFont('Arial','',10);

						$pdf->Cell(28,10,$detailr->amt,'',0,'R');

							

							$qun += $detailr->qty;

							$total += $detailr->amt;

							$c += 10;

				}

			}

			

		 }

	}

	else

	{

		$sr_no = 0;

		$pdf->AddPage(); $c = 0; $qun = 0; $total = 0;

	while($detailr = $detail->fetch_object())

	{	$sr_no++;

		

		

		$pdf->SetXY(7,104 + $c);

		$pdf->SetFont('Arial','',10);

		$pdf->Cell(12,10,$sr_no,0,0,'C');

		

		

	if( $pdf->GetStringWidth($detailr->pr_name) > 68 )

	{

		$pdf->SetXY(19,104 + $c);

		$pdf->SetFont('Arial','',10);

		$pdf->MultiCell(70,5,$detailr->pr_name,'','C');

	}

	else

	{

		$pdf->SetXY(19,104 + $c);

		$pdf->SetFont('Arial','',10);

		$pdf->Cell(70,10,$detailr->pr_name,'',0,'C');

	}

	

	$pdf->SetXY(89,104 + $c);

	$pdf->SetFont('Arial','',10);

	$pdf->Cell(25,10,$detailr->HSN,'',0,'C');

	

	$pdf->SetXY(114,104 + $c);

	$pdf->SetFont('Arial','',10);

	$pdf->Cell(9,10,$detailr->grate ." %",'',0,'C');

	

	$pdf->SetXY(123,104 + $c);

	$pdf->SetFont('Arial','',10);

	$pdf->Cell(12,10,$detailr->unit,'',0,'C');

	

	$pdf->SetXY(135,104 + $c);

	$pdf->SetFont('Arial','',10);

	$pdf->Cell(20,10,$detailr->qty,'',0,'C');



	$pdf->SetXY(155,104 + $c);

	$pdf->SetFont('Arial','',10);

	$pdf->Cell(20,10,$detailr->rate,'',0,'C');

	

	$pdf->SetXY(175,104 + $c);

	$pdf->SetFont('Arial','',10);

	$pdf->Cell(28,10,$detailr->amt,'',0,'R');

		

		$qun += $detailr->qty;

		$total += $detailr->amt;

		$c += 10;

	}

	}

	

	

	

$to = trim($client->client_email); 
$from = trim($company->comp_email); 
$subject = "Quatation From ".$company->company_name; 
$message = "<p>Please See This Quatation .</p>";

$separator = md5(time());

$eol = PHP_EOL;

$filename = "Quatation - ".$data->s_numner.".pdf";

$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;

$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
$aaaa = mail($to, $subject, $body, $headers);

if($aaaa) 
{
	$_SESSION['msg'] .= " Mail Sent SuccessFully ";
	header('location:../qu_invoice.php?id='.$_GET['id']);
	exit;
}
else
{
	$_SESSION['msg'] .= " Error In Send Mail";
	header('location:../qu_invoice.php?id='.$_GET['id']);
	exit;
}


?>