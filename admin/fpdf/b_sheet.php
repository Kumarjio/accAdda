<?php
require('fpdf.php');
include_once('../config/config2.php');
include_once('../function/rupees.php');
		
	global $gross_profit,$gross_loss;	
$purchase = $conn->query("SELECT sum(debit_amt) as pur_sum_d from `23` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='2'")->fetch_object();
	$puc_ret = $conn->query("SELECT sum(credit_amt) as pur_sum_c from `23` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='2'")->fetch_object(); 
	$direct_ex = $conn->query("SELECT DISTINCT(gl_code) FROM `9` WHERE c_id='".$_SESSION['company_id']."'");
 if( $purchase->pur_sum_d > $puc_ret->pur_sum_c ){ $pur_dif = $purchase->pur_sum_d - $puc_ret->pur_sum_c; } else { $pur_dif = $puc_ret->pur_sum_c - $purchase->pur_sum_d; }	

	$fri_fi = 0;
	while($direct_exr = $direct_ex->fetch_object())
	{
		$fri_c = $conn->query("SELECT sum(credit_amt) as fr_c from `9` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$direct_exr->gl_code."'")->fetch_object(); 
		$fri_d = $conn->query("SELECT sum(debit_amt) as fr_d from `9` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$direct_exr->gl_code."'")->fetch_object(); 
		if( $fri_c->fr_c > $fri_d->fr_d ){ $fri = $fri_c->fr_c - $fri_d->fr_d; }else if( $fri_c->fr_c < $fri_d->fr_d ){ $fri = $fri_d->fr_d - $fri_c->fr_c; }
				$fri_fi += $fri;
	}
	
$dexpence = $fri_fi + $pur_dif;
	
	
	$_direct_in = $conn->query("SELECT DISTINCT(gl_code) FROM `10` WHERE c_id='".$_SESSION['company_id']."'");
	$_sales_ret = $conn->query("SELECT sum(credit_amt) as sal_sum_c from `25` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='3'")->fetch_object(); 
	$_sales = $conn->query("SELECT sum(debit_amt) as sal_sum_d from `25` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='3'")->fetch_object(); 
	if( $_sales_ret->sal_sum_c > $_sales->sal_sum_d ){ $_sal_sum = $_sales_ret->sal_sum_c - $_sales->sal_sum_d; }else { $_sal_sum = $_sales->sal_sum_d - $_sales_ret->sal_sum_c; }
	$_tot_in = 0;		while($_direct_inr = $_direct_in->fetch_object()){
			$_sales_inc = $conn->query("SELECT sum(credit_amt) as sales_inc from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_direct_inr->gl_code."'")->fetch_object(); 
			$_sales_incd = $conn->query("SELECT sum(debit_amt) as sales_incd from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_direct_inr->gl_code."'")->fetch_object(); 
			if($_sales_incd->sales_incd > $_sales_inc->sales_inc) { $_dif_inc = $_sales_incd->sales_incd - $_sales_inc->sales_inc; }else{ $_dif_inc = $_sales_inc->sales_inc - $_sales_incd->sales_incd; }
			$_tot_in += $_dif_inc;
		}
		$_tot_in += $_sal_sum;
$dincome = $_tot_in;
$gross_loss = 0; $gross_profit = 0;	
if( $dexpence > $dincome ) { $gross_loss = $dexpence - $dincome; }else { $gross_profit = $dincome - $dexpence ; }


///  trading ----------------------------------------------------


$in_ex_query = $conn->query("SELECT DISTINCT(gl_code) FROM `13` WHERE c_id='".$_SESSION['company_id']."' ");
$misc_query = $conn->query("SELECT DISTINCT(gl_code) FROM `18` WHERE c_id='".$_SESSION['company_id']."' ");

$in_ex_total = 0;
while($in_ex_queryr = $in_ex_query->fetch_object())
{
	$in_ex_credit = $conn->query("SELECT sum(credit_amt) as in_ex_c from `13` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$in_ex_queryr->gl_code."'")->fetch_object(); 
	$in_ex_debit = $conn->query("SELECT sum(debit_amt) as in_ex_d from `13` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$in_ex_queryr->gl_code."'")->fetch_object(); 
	if( $in_ex_credit->in_ex_c > $in_ex_debit->in_ex_d ) { $in_ex_sub = $in_ex_credit->in_ex_c - $in_ex_debit->in_ex_d; } else { $in_ex_sub = $in_ex_debit->in_ex_d - $in_ex_credit->in_ex_c; }
	$in_ex_total += $in_ex_sub;  
}

$misc_total = 0;
while($misc_queryr = $misc_query->fetch_object())
{
	$misc_credit = $conn->query("SELECT sum(credit_amt) as misc_c from `18` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$misc_queryr->gl_code."'")->fetch_object(); 
	$misc_debit = $conn->query("SELECT sum(debit_amt) as misc_d from `18` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$misc_queryr->gl_code."'")->fetch_object(); 
	if( $misc_credit->misc_c > $misc_debit->misc_d ) { $misc_sub = $misc_credit->misc_c - $misc_debit->misc_d; } else { $misc_sub = $misc_debit->misc_d - $misc_credit->misc_c; }
	$misc_total += $misc_sub;  
}
$indirect_expences = $misc_total + $in_ex_total + $gross_loss;

//// indirect expences ------------------------------------------------------------------------

$in_in_query = $conn->query("SELECT DISTINCT(gl_code) FROM `14` WHERE c_id='".$_SESSION['company_id']."'");
$indirect_income = 0;
$indirect_income += $gross_profit ;

while($in_in_queryr = $in_in_query->fetch_object())
{
	$in_income_cr = $conn->query("SELECT sum(credit_amt) as in_in_cr from `14` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$in_in_queryr->gl_code."'")->fetch_object(); 
	$in_income_de = $conn->query("SELECT sum(debit_amt) as in_in_de from `14` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$in_in_queryr->gl_code."'")->fetch_object(); 
	if( $in_income_cr->in_in_cr > $in_income_de->in_in_de ) { $in_in_sub = $in_income_cr->in_in_cr - $in_income_de->in_in_de; } else{ $in_in_sub = $in_income_de->in_in_de - $in_income_cr->in_in_cr; }
	$indirect_income += $in_in_sub;  
}



//// indirect_  income  ------------------------------------------------------------------------

$total = 0;
if( $indirect_expences > $indirect_income ){ $total = $indirect_expences; }else { $total = $indirect_income; }

if( $indirect_expences > $indirect_income ){ $NetLoss = $indirect_expences - $indirect_income; } else { $Netprofit = $indirect_income - $indirect_expences; }


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
	$this->Cell(196,6,'Balance Sheet Report',0,1,'C'); 	
	$this->SetXY(22,53);
	$this->SetFont('Arial','B',10);
	$this->Cell(166,5,'For the Year '.$_SESSION['year'],0,1,'C'); 
	$this->SetXY(7,53);
	
	$this->SetXY(7,53);
	$this->SetFont('Arial','BI',10);
	$this->Cell(10,5,'Cr.',0,1,'L'); 
	$this->SetXY(-17,53);
	$this->SetFont('Arial','BI',10);
	$this->Cell(10,5,'Dr.',0,1,'L'); 
	
	
		$this->SetXY(7,59);

	
	$this->SetXY(7,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(73,6,'Liabilities','LT',1,'C'); 
	$this->SetXY(7,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(48,205,'','LT',1,'C'); 
	
	
	$this->SetXY(55,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,205,'','LT',1,'C'); 
	
	$this->SetXY(80,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,6,'Amount','LT',1,'C'); 
	$this->SetXY(80,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,205,'','LT',1,'C'); 
	
	$this->SetXY(105,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(73,6,'Assets','LT',1,'C'); 
	$this->SetXY(105,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(48,205,'','LT',1,'C'); 
	
	$this->SetXY(153,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,205,'','LT',1,'C'); 
	
	$this->SetXY(178,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,6,'Amount','LTR',1,'C'); 
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

$aasets_to = 0 ; $lia_to = 0;

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
	$c = 0;
	$bd = $con->query("select ac_id,ac_name from account_type WHERE `prifix`='BC'");
	while($bdr = $bd->fetch_object())
	{	
		$gl_code_d = $conn->query("SELECT DISTINCT(gl_code) FROM `" .$bdr->ac_id. "` where c_id = '".$_SESSION['company_id']."'"); 
			if( $gl_code_d->num_rows > 0 )
			{
				
				$pdf->SetXY(7,65 + $c);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(48,6,$bdr->ac_name,'B',1,'C');
				$c += 6; $count_bc = 0; $ftotal = 0;
				while($gl_code_dr = $gl_code_d->fetch_object())
				{ $count_bc++;
					$ac_b_lia = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$gl_code_dr->gl_code."'")->fetch_object();
					$lia_c = $conn->query("SELECT sum(credit_amt) as lia_c from `".$bdr->ac_id."` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$gl_code_dr->gl_code."'")->fetch_object(); 
					$lia_d = $conn->query("SELECT sum(debit_amt) as lia_d from `".$bdr->ac_id."` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$gl_code_dr->gl_code."'")->fetch_object();
					
					if($lia_c->lia_c > $lia_d->lia_d){ $lia_sub = $lia_c->lia_c - $lia_d->lia_d; }else { $lia_sub = $lia_d->lia_d - $lia_c->lia_c; }
					$ftotal += $lia_sub;
					if( $pdf->GetStringWidth($ac_b_lia->client_name) > 46 )
					{
						$pdf->SetXY(7,65 + $c);
						$pdf->SetFont('Arial','',10);
						$pdf->MultiCell(48,6,$ac_b_lia->client_name,'','C');
						$pdf->SetXY(55,65 + $c);
						$pdf->SetFont('Arial','',10);
						$pdf->Cell(25,12,$lia_sub,'',1,'C');
						
						if( $count_bc == $gl_code_d->num_rows )
						{
							$pdf->SetXY(80,65 + $c);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(25,12,$ftotal,'',1,'C');
							$lia_to += $ftotal;
						}
						
						$c += 6;
					}
					else
					{
					$pdf->SetXY(7,65 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(48,6,$ac_b_lia->client_name,'',1,'C');
					$pdf->SetXY(55,65 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(25,6,$lia_sub,'',1,'C');
						if( $count_bc == $gl_code_d->num_rows )
						{
							$pdf->SetXY(80,65 + $c);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(25,6,$ftotal,'',1,'C');
							$lia_to += $ftotal;
						}
					}
					
					
					
					
							
					$c += 6;
				}
			}
	}
	
	
	$d = 0; 
	$bc = $con->query("select ac_id,ac_name from account_type WHERE `prifix`='BD'");
	while($bcr = $bc->fetch_object())
	{
	
		$glcode_c = $conn->query("SELECT DISTINCT(gl_code) FROM `" .$bcr->ac_id. "` where c_id = '".$_SESSION['company_id']."'");
		if($glcode_c->num_rows > 0){
			
				$pdf->SetXY(105,65 + $d);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(48,6,$bcr->ac_name,'B',1,'C');
				$d += 6; $count_bd = 0; $dtotal = 0; 
			while($glcode_cr = $glcode_c->fetch_object()){   $count_bd++;
				$ac_b_ass = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$glcode_cr->gl_code."'")->fetch_object();
				$ass_c = $conn->query("SELECT sum(credit_amt) as ass_c from `".$bcr->ac_id."` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$glcode_cr->gl_code."'")->fetch_object(); 
				$ass_d = $conn->query("SELECT sum(debit_amt) as ass_d from `".$bcr->ac_id."` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$glcode_cr->gl_code."'")->fetch_object();
				if( $ass_c->ass_c > $ass_d->ass_d ){ $sub_asse = $ass_c->ass_c - $ass_d->ass_d; }else { $sub_asse = $ass_d->ass_d - $ass_c->ass_c;  }
				$dtotal += $sub_asse;
				
				if( $pdf->GetStringWidth($ac_b_ass->client_name) > 46 )
					{
						$pdf->SetXY(105,65 + $d);
						$pdf->SetFont('Arial','',10);
						$pdf->MultiCell(48,6,$ac_b_ass->client_name,'','C');
						$pdf->SetXY(153,65 + $d);
						$pdf->SetFont('Arial','',10);
						$pdf->Cell(25,12,$sub_asse,'',1,'C');
						
						if( $count_bd == $glcode_c->num_rows )
						{
							$pdf->SetXY(179,65 + $d);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(25,12,$dtotal,'',1,'C');
							$aasets_to += $dtotal;
						}
						
						$d += 6;
					}
					else
					{
						$pdf->SetXY(105,65 + $d);
						$pdf->SetFont('Arial','',10);
						$pdf->Cell(48,6,$ac_b_ass->client_name,'',1,'C');
						$pdf->SetXY(153,65 + $d);
						$pdf->SetFont('Arial','',10);
						$pdf->Cell(25,6,$sub_asse,'',1,'C');
						if( $count_bd == $glcode_c->num_rows )
						{
							$pdf->SetXY(179,65 + $d);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(25,6,$dtotal,'',1,'C');
							$aasets_to += $dtotal;
						}
					}
			
				
				$d += 6;
			}
		}
	
	}
	
	
	if( isset($Netprofit) )
	{
		$pdf->SetXY(7,80 + $c);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(48,7,'Net Profit','TB',1,'C'); 
		
		$pdf->SetXY(80,80 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,7,$Netprofit,'TB',1,'C');
		$lia_to += $Netprofit;
	}	
	if(isset($NetLoss))
	{
		$pdf->SetXY(105,80 + $d);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(48,7,'Net Loss','TB',1,'C'); 
		
		$pdf->SetXY(178,80 + $d);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,7,$NetLoss,'TB',1,'C');
		$aasets_to += $NetLoss;
	}		
	
	
	
			$pdf->SetXY(105,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(48,6,'Total : -',1,1,'C');
			
			$pdf->SetXY(153,270);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(25,6,'','BT',1,'C');
			
			$pdf->SetXY(178,270);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(25,6,$aasets_to,1,1,'C');
			
			$pdf->SetXY(7,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(48,6,'Total : -',1,1,'C');
			
			$pdf->SetXY(55,270);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(25,6,'','TB',1,'C');
			
			$pdf->SetXY(80,270);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(25,6,$lia_to,1,1,'C');
	
	
	
$pdf->Output("Balance Sheet Report " .$_SESSION['year'].".pdf", 'D');
?>