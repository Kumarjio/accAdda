<?php
require('fpdf.php');
include_once('../config/config2.php');
include_once('../function/rupees.php');
		
		


global $company;
$company = $con->query("SELECT * FROM `company_mas` WHERE company_id = '".$_SESSION['company_id']."'")->fetch_object();



class PDF extends FPDF
{
function Header()
{
	$this->Image('../'.$GLOBALS['company']->header_img,0,0,210,45);
    $this->Ln(36);
	$this->SetX(7);
	$this->SetFont('Arial','B',12);
	$this->Cell(196,6,'Trading Report',0,1,'C'); 	
	$this->SetXY(22,53);
	$this->SetFont('Arial','B',10);
	$this->Cell(166,5,'For the Year '.$_SESSION['year'],0,1,'C'); 
	$this->SetXY(7,53);
	
	$this->SetXY(7,53);
	$this->SetFont('Arial','BI',10);
	$this->Cell(10,5,'Dr.',0,1,'L'); 
	$this->SetXY(-17,53);
	$this->SetFont('Arial','BI',10);
	$this->Cell(10,5,'Cr.',0,1,'L'); 
	
	
		$this->SetXY(7,59);

	
	$this->SetXY(7,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(73,6,'Particular','LT',1,'C'); 
	$this->SetXY(7,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(48,205,'','LT',1,'C'); 
	
	
	$this->SetXY(55,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,205,'','LT',1,'C'); 
	
	$this->SetXY(80,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,6,'Rs.','LT',1,'C'); 
	$this->SetXY(80,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,205,'','LT',1,'C'); 
	
	$this->SetXY(105,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(73,6,'Particular','LT',1,'C'); 
	$this->SetXY(105,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(48,205,'','LT',1,'C'); 
	
	$this->SetXY(153,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,205,'','LT',1,'C'); 
	
	$this->SetXY(178,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,6,'Rs.','LTR',1,'C'); 
	$this->SetXY(178,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,205,'','LTR',1,'C'); 
	
}

function Footer()
{
	
	$this->SetY(-17);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	
	$this->Image('../'.$GLOBALS['company']->footer_img,0,287,211,10);
}
}




$pdf = new PDF();
$pdf->AliasNbPages();

	
	$exrd = array();
	$inrd = array();
	$direct_ex = $conn->query("SELECT DISTINCT(gl_code) FROM `9` WHERE c_id='".$_SESSION['company_id']."'");
	$direct_in = $conn->query("SELECT DISTINCT(gl_code) FROM `10` WHERE c_id='".$_SESSION['company_id']."'");
	
	
	
	
	while($direct_exr = $direct_ex->fetch_object())
	{
		array_push($exrd,$direct_exr->gl_code);
	}
	while($direct_inr = $direct_in->fetch_object())
	{
		array_push($inrd,$direct_inr->gl_code);
	}
	

	$dr = count($exrd);
	$crf = count($inrd);
	
	if( $dr > $crf )
	{
		$rows = $dr;
	}
	else
	{
		$rows = $crf;
	}
	if( $rows > 24 )
	{
		$limit = 24; $totald = 0;  $totalc = 0;
		$co = 0; $do = 0;
		for($i = 1; $i <= ceil($rows / 24); $i++ )
		{
			$pdf->AddPage();
			
			
			
			if( $i == 1 )
			{ 
				$start = 0;
				$purchase = $conn->query("SELECT sum(debit_amt) as pur_sum_d from `23` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='2'")->fetch_object();
				$puc_ret = $conn->query("SELECT sum(credit_amt) as pur_sum_c from `23` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='2'")->fetch_object(); 
				
				$sales_ret = $conn->query("SELECT sum(credit_amt) as sal_sum_c from `25` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='3'")->fetch_object(); 
				$sales = $conn->query("SELECT sum(debit_amt) as sal_sum_d from `25` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='3'")->fetch_object(); 
				
				//   purchase
				
				$pdf->SetXY(7,65);
				$pdf->SetFont('Arial','',11);
				$pdf->Cell(48,7,'Purchase',0,1,'L'); 
				
				$pdf->SetXY(55,65);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,7,$purchase->pur_sum_d,'',1,'C'); 
				
				$pdf->SetXY(7,72);
				$pdf->SetFont('Arial','',11);
				$pdf->Cell(48,7,'    - Purchase Return','',1,'L'); 
				
				$pdf->SetXY(55,72);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,7,$puc_ret->pur_sum_c,'',1,'C');  
				$pur_dif = 0;
				if( $purchase->pur_sum_d > $puc_ret->pur_sum_c ){ $pur_dif = $purchase->pur_sum_d - $puc_ret->pur_sum_c; } else { $pur_dif = $puc_ret->pur_sum_c - $purchase->pur_sum_d; }
				
				$pdf->SetXY(80,72);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,7,$pur_dif,'',1,'C'); 

				//   purchase
				
				
				//	Sales 
				
					
				$pdf->SetXY(105,65);
				$pdf->SetFont('Arial','',11);
				$pdf->Cell(48,7,'Sales','',1,'L'); 
				
				$pdf->SetXY(153,65);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,7,$sales_ret->sal_sum_c,'',1,'C'); 
				
				$pdf->SetXY(105,72);
				$pdf->SetFont('Arial','',11);
				$pdf->Cell(48,7,'    - Sales Return','',1,'L'); 
				
				$pdf->SetXY(153,72);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,7,$sales->sal_sum_d,'',1,'C');  
				$sales_dif = 0;
				if($sales_ret->sal_sum_c > $sales->sal_sum_d ){ $sales_dif = $sales_ret->sal_sum_c - $sales->sal_sum_d; } else{ $sales_dif = $sales->sal_sum_d - $sales_ret->sal_sum_c; }
				
				$pdf->SetXY(178,72);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,7,$sales_dif,'',1,'C'); 
				
				
				//	Sales 
				
				$pdf->SetXY(7,82);
				$pdf->SetFont('Arial','B',11);
				$pdf->Cell(48,7,'Direct Expenses','B',1,'C');
				
				$pdf->SetXY(105,82);
				$pdf->SetFont('Arial','B',11);
				$pdf->Cell(48,7,'Direct Income','B',1,'C');
				$totald += $pur_dif;
				$totalc += $sales_dif;
				$ex_deb = 0; $in_crdf = 0;
				foreach($exrd as $ers)
				{
					$ersd = $conn->query("SELECT sum(debit_amt) as ersd from `9` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$ers."'")->fetch_object();
					$ersc = $conn->query("SELECT sum(credit_amt) as ersc from `9` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$ers."'")->fetch_object();
					if( $ersd->ersd > $ersc->ersc ){ $d_dif = $ersd->ersd - $ersc->ersc; } else { $d_dif = $ersc->ersc - $ersd->ersd; }
					$ex_deb += $d_dif;
					$totald += $d_dif;
				}
				foreach( $inrd as $inrdf )
				{
					$inrdfc = $conn->query("SELECT sum(credit_amt) as inrdfc from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$inrdf."'")->fetch_object(); 
					$inrdfd = $conn->query("SELECT sum(debit_amt) as inrdfd from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$inrdf."'")->fetch_object(); 
					if($inrdfd->inrdfd > $inrdfc->inrdfc) { $inrdfcc = $inrdfd->inrdfd - $inrdfc->inrdfc; } else { $inrdfcc = $inrdfc->inrdfc - $inrdfd->inrdfd; }
					$totalc += $inrdfcc;
					$in_crdf += $inrdfcc;
				}
				if($totalc > $totald)
				{
					$extra = $totalc - $totald;
					$TOT = $totalc;
				}
				else
				{
					$extra = $totald - $totalc;
					$TOT = $totald;
				}
			}
			else
			{
				$start = ($i - 1) * $limit; 
			}
			$ex = array_slice($exrd,$start,$limit);
			$in = array_slice($inrd,$start,$limit);
			
			if( $i == 2 ){ $c = -23; }else{ $c = 0; }  $to_ex = 0; 
				foreach( $ex as $exr )
				{ $co++;
					$acount = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$exr."'")->fetch_object();
					$pdf->SetXY(7,89 + $c);
					$pdf->SetFont('Arial','',11);
					$pdf->Cell(48,7,$acount->client_name,0,1,'L'); 
					
					$tc_debit = $conn->query("SELECT sum(debit_amt) as tc_de from `9` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$exr."'")->fetch_object();
					$tc_credit = $conn->query("SELECT sum(credit_amt) as tc_cr from `9` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$exr."'")->fetch_object();
					if( $tc_debit->tc_de > $tc_credit->tc_cr ){ $e_dif = $tc_debit->tc_de - $tc_credit->tc_cr; } else { $e_dif = $tc_credit->tc_cr - $tc_debit->tc_de; }
					$pdf->SetXY(55,89 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(25,7,$e_dif,'',1,'C'); 
					$to_ex += $e_dif;
					if( $dr == $co )
					{
						$pdf->SetXY(80,89 + $c);
						$pdf->SetFont('Arial','',10);
						$pdf->Cell(25,7,$ex_deb,'',1,'C');
					}
				
					$c += 7;
				}
	
	
	
	
				if( $i == 2 ){ $d = -23; }else{ $d = 0; }$d = 0; $to_in = 0; 
				foreach($in as $inr)
				{
					$do++;
					$acountd = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$inr."'")->fetch_object();
					
					$pdf->SetXY(105,89 + $d);
					$pdf->SetFont('Arial','',11);
					$pdf->Cell(48,7,$acountd->client_name,'',1,'C');
					
					$sales_inc = $conn->query("SELECT sum(credit_amt) as sales_inc from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$inr."'")->fetch_object(); 
					$sales_incd = $conn->query("SELECT sum(debit_amt) as sales_incd from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$inr."'")->fetch_object(); 
					
					if($sales_incd->sales_incd > $sales_inc->sales_inc) { $dif_inc = $sales_incd->sales_incd - $sales_inc->sales_inc; }else{ $dif_inc = $sales_inc->sales_inc - $sales_incd->sales_incd; }
					
					$pdf->SetXY(153,89 + $d);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(25,7,$dif_inc,'',1,'C');
					
					$to_in += $dif_inc;
					
					if($crf == $do)
					{
						$pdf->SetXY(178,89 + $d);
						$pdf->SetFont('Arial','',10);
						$pdf->Cell(25,7,$in_crdf,'',1,'C');
						
					}
					
					$d += 7;
				}
			
		
		if($crf > 24 )
		{
			if( $i == ceil($rows / 24) )
				{
					if( $totald > $totalc )
					{
						$pdf->SetXY(105,89 + $d + 2);
						$pdf->SetFont('Arial','B',12);
						$pdf->Cell(48,7,'Gross Loss','T',1,'C');
						
						$pdf->SetXY(153,89 + $d +2);
						$pdf->SetFont('Arial','',11);
						$pdf->Cell(25,8,'','T',1,'C');
						
						$pdf->SetXY(178,89 + $d + 2);
						$pdf->SetFont('Arial','',12);
						$pdf->Cell(25,8,$extra,'T',1,'C');
					}
				}
		}else
		{
			if( $totald > $totalc )
					{
						$pdf->SetXY(105,89 + $d + 2);
						$pdf->SetFont('Arial','B',12);
						$pdf->Cell(48,7,'Gross Loss','T',1,'C');
						
						$pdf->SetXY(153,89 + $d +2);
						$pdf->SetFont('Arial','',11);
						$pdf->Cell(25,8,'','T',1,'C');
						
						$pdf->SetXY(178,89 + $d + 2);
						$pdf->SetFont('Arial','',12);
						$pdf->Cell(25,8,$extra,'T',1,'C');
					}
		}
		
		
		if( $dr > 24 )
		{
			if( $i == ceil($rows / 24) )
			{
				if( $totald < $totalc )
				{
					$pdf->SetXY(7,89 + $c + 2);
					$pdf->SetFont('Arial','B',12);
					$pdf->Cell(48,7,'Gross Profit','T',1,'C');
					
					$pdf->SetXY(55,89 + $c +2);
					$pdf->SetFont('Arial','',11);
					$pdf->Cell(25,8,'','T',1,'C');
					
					$pdf->SetXY(80,89 + $c + 2);
					$pdf->SetFont('Arial','',12);
					$pdf->Cell(25,8,$extra,'T',1,'C');
				}
			}
		}else
		{
			if( $totald < $totalc )
				{
					$pdf->SetXY(7,89 + $c + 2);
					$pdf->SetFont('Arial','B',12);
					$pdf->Cell(48,7,'Gross Profit','T',1,'C');
					
					$pdf->SetXY(55,89 + $c +2);
					$pdf->SetFont('Arial','',11);
					$pdf->Cell(25,8,'','T',1,'C');
					
					$pdf->SetXY(80,89 + $c + 2);
					$pdf->SetFont('Arial','',12);
					$pdf->Cell(25,8,$extra,'T',1,'C');
				}
		}
		
	if( $i == ceil($rows / 24) )
	{
			$pdf->SetXY(105,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(48,6,'Total : -',1,1,'C');
			
			$pdf->SetXY(153,270);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(25,6,'','BT',1,'C');
			
			$pdf->SetXY(178,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(25,6,$TOT,1,1,'C');
			
			$pdf->SetXY(7,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(48,6,'Total : -',1,1,'C');
			
			$pdf->SetXY(55,270);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(25,6,'','TB',1,'C');
			
			$pdf->SetXY(80,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(25,6,$TOT,1,1,'C');
		
	}else
		{
			$pdf->SetXY(7,270);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(196,1,'','T',1,'C'); 
		}	
	
		
			
		
			
		}
	}
	else
	{
		$pdf->AddPage();
		
		
	$purchase = $conn->query("SELECT sum(debit_amt) as pur_sum_d from `23` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='2'")->fetch_object();
	$puc_ret = $conn->query("SELECT sum(credit_amt) as pur_sum_c from `23` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='2'")->fetch_object(); 
	
	$sales_ret = $conn->query("SELECT sum(credit_amt) as sal_sum_c from `25` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='3'")->fetch_object(); 
	$sales = $conn->query("SELECT sum(debit_amt) as sal_sum_d from `25` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='3'")->fetch_object(); 
	
	//   purchase
	
	$pdf->SetXY(7,65);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(48,7,'Purchase',0,1,'L'); 
	
	$pdf->SetXY(55,65);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(25,7,$purchase->pur_sum_d,'',1,'C'); 
	
	$pdf->SetXY(7,72);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(48,7,'    - Purchase Return','',1,'L'); 
	
	$pdf->SetXY(55,72);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(25,7,$puc_ret->pur_sum_c,'',1,'C');  
	$pur_dif = 0;
	if( $purchase->pur_sum_d > $puc_ret->pur_sum_c ){ $pur_dif = $purchase->pur_sum_d - $puc_ret->pur_sum_c; } else { $pur_dif = $puc_ret->pur_sum_c - $purchase->pur_sum_d; }
	
	$pdf->SetXY(80,72);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(25,7,$pur_dif,'',1,'C'); 

	//   purchase
	
	
	//	Sales 
	
		
	$pdf->SetXY(105,65);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(48,7,'Sales','',1,'L'); 
	
	$pdf->SetXY(153,65);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(25,7,$sales_ret->sal_sum_c,'',1,'C'); 
	
	$pdf->SetXY(105,72);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(48,7,'    - Sales Return','',1,'L'); 
	
	$pdf->SetXY(153,72);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(25,7,$sales->sal_sum_d,'',1,'C');  
	$sales_dif = 0;
	if($sales_ret->sal_sum_c > $sales->sal_sum_d ){ $sales_dif = $sales_ret->sal_sum_c - $sales->sal_sum_d; } else{ $sales_dif = $sales->sal_sum_d - $sales_ret->sal_sum_c; }
	
	$pdf->SetXY(178,72);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(25,7,$sales_dif,'',1,'C'); 
	
	
	//	Sales 
	
	$pdf->SetXY(7,82);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(48,7,'Direct Expenses','B',1,'C');
	
	$pdf->SetXY(105,82);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(48,7,'Direct Income','B',1,'C');
		
		
	$c = 0; $co = 0; $to_ex = 0; $totald = 0;
	foreach( $exrd as $exr )
	{ $co++;
		$acount = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$exr."'")->fetch_object();
		$pdf->SetXY(7,89 + $c);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(48,7,$acount->client_name,0,1,'L'); 
		
		$tc_debit = $conn->query("SELECT sum(debit_amt) as tc_de from `9` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$exr."'")->fetch_object();
		$tc_credit = $conn->query("SELECT sum(credit_amt) as tc_cr from `9` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$exr."'")->fetch_object();
		if( $tc_debit->tc_de > $tc_credit->tc_cr ){ $e_dif = $tc_debit->tc_de - $tc_credit->tc_cr; } else { $e_dif = $tc_credit->tc_cr - $tc_debit->tc_de; }
		$pdf->SetXY(55,89 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,7,$e_dif,'',1,'C'); 
		$to_ex += $e_dif;
		if( $dr == $co )
		{
			$pdf->SetXY(80,89 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(25,7,$to_ex,'',1,'C');
			$totald += $to_ex;
		}
		$c += 7;
	}
	
	$totald += $pur_dif;
	
	
	$d = 0; $do = 0; $to_in = 0; $totalc = 0;
	foreach($inrd as $inr)
	{
		$do++;
		$acountd = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$inr."'")->fetch_object();
		
		$pdf->SetXY(105,89 + $d);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(48,7,$acountd->client_name,'',1,'C');
		
		$sales_inc = $conn->query("SELECT sum(credit_amt) as sales_inc from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$inr."'")->fetch_object(); 
		$sales_incd = $conn->query("SELECT sum(debit_amt) as sales_incd from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$inr."'")->fetch_object(); 
		
		if($sales_incd->sales_incd > $sales_inc->sales_inc) { $dif_inc = $sales_incd->sales_incd - $sales_inc->sales_inc; }else{ $dif_inc = $sales_inc->sales_inc - $sales_incd->sales_incd; }
		
		$pdf->SetXY(153,89 + $d);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,7,$dif_inc,'',1,'C');
		
		$to_in += $dif_inc;
		
		if($crf == $do)
		{
			$pdf->SetXY(178,89 + $d);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(25,7,$to_in,'',1,'C');
			$totalc += $to_in;
		}
		
		$d += 7;
	}
			$totalc += $sales_dif;
		
		
		if( $totald > $totalc )
		{
			$pdf->SetXY(105,89 + $d + 2);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(48,7,'Gross Loss','T',1,'C');
			
			$pdf->SetXY(153,89 + $d +2);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(25,8,'','T',1,'C');
			
			$pdf->SetXY(178,89 + $d + 2);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(25,8,$totald - $totalc,'T',1,'C');
		}
		if( $totald < $totalc )
		{
			$pdf->SetXY(7,89 + $c + 2);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(48,7,'Gross Profit','T',1,'C');
			
			$pdf->SetXY(55,89 + $c +2);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(25,8,'','T',1,'C');
			
			$pdf->SetXY(80,89 + $c + 2);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(25,8,$totalc - $totald,'T',1,'C');
		}
		
		if($totald > $totalc)
		{
			$TOT = $totald;
		}
		else
		{
			$TOT = $totalc;
		}
			$pdf->SetXY(105,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(48,6,'Total : -',1,1,'C');
			
			$pdf->SetXY(153,270);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(25,6,'','BT',1,'C');
			
			$pdf->SetXY(178,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(25,6,$TOT,1,1,'C');
			
			$pdf->SetXY(7,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(48,6,'Total : -',1,1,'C');
			
			$pdf->SetXY(55,270);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(25,6,'','TB',1,'C');
			
			$pdf->SetXY(80,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(25,6,$TOT,1,1,'C');
		
	}
	

$pdf->Output("Trading Report ".$_SESSION['year'].".pdf", 'D');
?>