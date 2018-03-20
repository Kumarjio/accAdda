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
	$this->Cell(196,6,'PROFIT AND LOSS Report',0,1,'C'); 	
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
	
	
if($GLOBALS['gross_loss'])
{
	$this->SetXY(7,65);
	$this->SetFont('Arial','B',12);
	$this->Cell(48,7,'Gross Loss','',1,'C'); 
	
	$this->SetXY(80,65);
	$this->SetFont('Arial','',12);
	$this->Cell(25,7,$GLOBALS['gross_loss'],'',1,'C'); 
}
if( $GLOBALS['gross_profit'] )
{
	$this->SetXY(105,65);
	$this->SetFont('Arial','B',12);
	$this->Cell(48,7,'Gross Profit','',1,'C'); 
	
	$this->SetXY(178,65);
	$this->SetFont('Arial','',12);
	$this->Cell(25,7,$GLOBALS['gross_profit'],'',1,'C');
}		

	$this->SetXY(7,71);
	$this->SetFont('Arial','',12);
	$this->Cell(196,1,'','B',1,'C');
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
$pdf->SetAutoPageBreak(false);

	$_in_ex_query = $conn->query("SELECT DISTINCT(gl_code) FROM `13` WHERE c_id='".$_SESSION['company_id']."'");
	$_misc_query = $conn->query("SELECT DISTINCT(gl_code) FROM `18` WHERE c_id='".$_SESSION['company_id']."'");
	$_in_in_query = $conn->query("SELECT DISTINCT(gl_code) FROM `14` WHERE c_id='".$_SESSION['company_id']."'");
	
	$pdf->AddPage();
	if( $_in_ex_query->num_rows > 0 )
	{
		$c = 0; $in_ex_sub = 0; $inex = 0; $misc_ex = 0;
		$pdf->SetXY(7,72);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(48,6,'Indirect Expenses','B',1,'C');
		while($_in_ex_queryr = $_in_ex_query->fetch_object()){ 
			$inex++;
			$acco_in_ex = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$_in_ex_queryr->gl_code."'")->fetch_object();
			$_in_ex_credit = $conn->query("SELECT sum(credit_amt) as in_e_x_c from `13` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_in_ex_queryr->gl_code."'")->fetch_object(); 
			$_in_ex_debit = $conn->query("SELECT sum(debit_amt) as in_e_x_d from `13` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_in_ex_queryr->gl_code."'")->fetch_object(); 
			
			$pdf->SetXY(7,78 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(48,6,$acco_in_ex->client_name,'',1,'C');
			if( $_in_ex_credit->in_e_x_c > $_in_ex_debit->in_e_x_d ) { $_in_ex_sub = $_in_ex_credit->in_e_x_c - $_in_ex_debit->in_e_x_d; } else { $_in_ex_sub = $_in_ex_debit->in_e_x_d - $_in_ex_credit->in_e_x_c; }
			
			$pdf->SetXY(55,78 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(25,6,$_in_ex_sub,'',1,'C');
			
			$in_ex_sub += $_in_ex_sub;
			if($_in_ex_query->num_rows == $inex)
			{
				$pdf->SetXY(80,78 + $c);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,6,$in_ex_sub,'',1,'C'); 
			}
			$c += 6;
		}
	}
	
	$misc_c = 0;
	if( $_misc_query->num_rows > 0 )
	{
		$pdf->SetXY(7,78 + $c);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(48,6,'Misc. Expenses','BT',1,'C');
		while($_misc_queryr = $_misc_query->fetch_object())
		{ $misc_c++;
			$c += 6;
			$acco_misc = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$_misc_queryr->gl_code."'")->fetch_object();
			$_misc_credit = $conn->query("SELECT sum(credit_amt) as mis_c_c from `18` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_misc_queryr->gl_code."'")->fetch_object(); 
			$_misc_debit = $conn->query("SELECT sum(debit_amt) as mis_c_d from `18` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_misc_queryr->gl_code."'")->fetch_object();
			
			$pdf->SetXY(7,78 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(48,6,$acco_misc->client_name,'',1,'C');

			if( $_misc_credit->mis_c_c > $_misc_debit->mis_c_d ) { $_misc_sub = $_misc_credit->mis_c_c - $_misc_debit->mis_c_d; } else { $_misc_sub = $_misc_debit->mis_c_d - $_misc_credit->mis_c_c; }
			
			$pdf->SetXY(55,78 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(25,6,$_misc_sub,'',1,'C');
			
			$misc_ex += $_misc_sub;
			if($_misc_query->num_rows == $misc_c)
			{
				$pdf->SetXY(80,78 + $c);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,6,$misc_ex,'',1,'C'); 
			}
			
		}
	}
	
	$_in_in_query = $conn->query("SELECT DISTINCT(gl_code) FROM `14` WHERE c_id='".$_SESSION['company_id']."'");
	$in_in_co = 0; $div = 0; $incom_c = 0; $miscin_ex = 0;
	if( $_in_in_query->num_rows > 0 )
	{ 
		$pdf->SetXY(105,72);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(48,6,'Indirect Income','B',1,'C'); 
		while($_in_in_queryr = $_in_in_query->fetch_object())
		{ $incom_c++;
			$_acco_in_in = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$_in_in_queryr->gl_code."'")->fetch_object();
			$_in_income_cr = $conn->query("SELECT sum(credit_amt) as in_in_c_r from `14` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_in_in_queryr->gl_code."'")->fetch_object(); 
			$_in_income_de = $conn->query("SELECT sum(debit_amt) as in_in_d_e from `14` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_in_in_queryr->gl_code."'")->fetch_object(); 
			
			
			$pdf->SetXY(105,78 + $div);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(48,6,$_acco_in_in->client_name,'',1,'C');
			if( $_in_income_cr->in_in_c_r > $_in_income_de->in_in_d_e ) { $_in_in_sub = $_in_income_cr->in_in_c_r - $_in_income_de->in_in_d_e; } else if( $_in_income_cr->in_in_c_r < $_in_income_de->in_in_d_e ) { $_in_in_sub = $_in_income_de->in_in_d_e - $_in_income_cr->in_in_c_r; }
			
			$pdf->SetXY(153,78 + $div);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(25,6,$_in_in_sub,'',1,'C');
			$miscin_ex += $_in_in_sub;
			
			if($_in_in_query->num_rows == $incom_c)
			{
				$pdf->SetXY(179,78 + $div);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,6,$miscin_ex,'',1,'C'); 
			}
			
			$div += 6;
		}
		
	}
	
	
	if( isset($Netprofit))
	{
		$pdf->SetXY(7,80 + 7 + $c);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(48,7,'Net Profit','TB',1,'C'); 
		
		$pdf->SetXY(80,80 + 7 + $c);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(25,7,$Netprofit,'TB',1,'C'); 
	}
	if(isset($NetLoss))
	{
		$pdf->SetXY(105,80 + $div);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(48,7,'Net Loss','TB',1,'C'); 
		
		$pdf->SetXY(178,80 + $div);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(25,7,$NetLoss,'TB',1,'C');
	}		
		
			$pdf->SetXY(105,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(48,6,'Total : -',1,1,'C');
			
			$pdf->SetXY(153,270);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(25,6,'','BT',1,'C');
			
			$pdf->SetXY(178,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(25,6,$total,1,1,'C');
			
			$pdf->SetXY(7,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(48,6,'Total : -',1,1,'C');
			
			$pdf->SetXY(55,270);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(25,6,'','TB',1,'C');
			
			$pdf->SetXY(80,270);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(25,6,$total,1,1,'C');
		

$pdf->Output("Profit & Loss Report " .$_SESSION['year'].".pdf", 'D');
?>