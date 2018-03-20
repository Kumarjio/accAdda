<?php
require('fpdf.php');
include_once('../config/config2.php');
include_once('../function/rupees.php');
$whereSQL = '';
$id = $_POST['id_add_pay_hidden'];
$date = $_POST['today_date'];
global $account_type, $date1 ,$date2, $total_deb, $total_cre;
$account_type = $con->query('select * from client_master where client_id = "'.$id.'"')->fetch_object();
		if(!empty($date)){
			$dates = explode("-", $date);
			$date1 = trim($dates[0]);
			$date2 = trim($dates[1]);
			$whereSQL = "AND l_date between '".$date1."' AND '".$date2."'";
		}
		else
		{
			$date1 = '01/03/'.date('Y');
			$date2 = date('d/m/Y');
		}
		
		


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
	$this->Cell(196,6,$GLOBALS['account_type']->client_name,0,1,'C'); 	
	$this->SetXY(22,53);
	$this->SetFont('Arial','B',10);
	$this->Cell(166,5,'Ledger Account for The period from '.$GLOBALS["date1"].' To '.$GLOBALS["date2"] ,0,1,'C'); 
	$this->SetXY(7,53);
	$this->SetFont('Arial','BI',10);
	$this->Cell(10,5,'Dr.',0,1,'L'); 
	$this->SetXY(-17,53);
	$this->SetFont('Arial','BI',10);
	$this->Cell(10,5,'Cr.',0,1,'L'); 
	
	$this->SetXY(7,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(19,6,'Date','LT',1,'C'); 
	$this->SetXY(7,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(19,205,'','LT',1,'C'); 
	
	$this->SetXY(26,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(13,6,'inv no','LT',1,'C'); 
	$this->SetXY(26,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(13,205,'','LT',1,'C'); 
	
	$this->SetXY(39,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(41,6,'Particular','LT',1,'C'); 
	$this->SetXY(39,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(41,205,'','LT',1,'C'); 
	
	$this->SetXY(80,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,6,'Amount','LT',1,'C'); 
	$this->SetXY(80,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,205,'','LT',1,'C'); 
	
	$this->SetXY(105,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(19,6,'Date','LT',1,'C'); 
	$this->SetXY(105,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(19,205,'','LT',1,'C'); 
	
	$this->SetXY(124,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(13,6,'inv no','LT',1,'C'); 
	$this->SetXY(124,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(13,205,'','LT',1,'C'); 
	
	$this->SetXY(137,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(41,6,'Particular','LT',1,'C'); 
	$this->SetXY(137,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(41,205,'','LT',1,'C'); 
	
	$this->SetXY(178,59);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,6,'Amount','LTR',1,'C'); 
	$this->SetXY(178,65);
	$this->SetFont('Arial','B',10);
	$this->Cell(25,205,'','LTR',1,'C'); 
	
}

function Footer()
{
	
	$this->SetXY(7,270);
    $this->SetFont('Arial','I',10);
    $this->Cell(196,7,'',1,0,'C');
	
	$this->SetXY(7,270);
    $this->SetFont('Arial','',11);
    $this->Cell(73,7,'Total : - ',0,0,'R');
	
	$this->SetXY(80,270);
    $this->SetFont('Arial','',11);
    $this->Cell(25,7,$GLOBALS['total_deb'],0,0,'C');
	
	$this->SetXY(105,270);
    $this->SetFont('Arial','',11);
    $this->Cell(73,7,'Total : - ',0,0,'R');
	
	$this->SetXY(178,270);
    $this->SetFont('Arial','',11);
    $this->Cell(25,7,$GLOBALS['total_cre'],0,0,'C');
	
	$this->SetY(-17);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	
	$this->Image('../'.$GLOBALS['company']->footer_img,0,287,211,10);
}
}




$pdf = new PDF();
$pdf->AliasNbPages();

$c = 0;


	$query = $conn->query("SELECT  COUNT(*) as rowd FROM `".$account_type->client_ac_type."` WHERE c_id='".$_SESSION['company_id']."' AND credit_amt = '0.00' AND gl_code = '".$id."'" .$whereSQL)->fetch_object();
	$query_c = $conn->query("SELECT COUNT(*) as row FROM `".$account_type->client_ac_type."` WHERE c_id='".$_SESSION['company_id']."' AND  debit_amt = '0.00' AND gl_code = '".$id."'" .$whereSQL)->fetch_object();
	
	if( $query->rowd > $query_c->row )
	{
		$rows = $query->rowd;
	}
	else if( $query->rowd < $query_c->row )
	{
		$rows = $query_c->row;
	}
	else
	{
		$rows = $query_c->row;
	}
		
	$start = 0;
	$limit = 20;
	if( $rows > 20 )
	{
		for($i = 1; $i <= ceil($rows / 20); $i++ )
		{
			$pdf->AddPage();
			if( $i == 1 )
			{ 
				$start = 0; 
			}
			else
			{
				$start = ($i - 1) * $limit; 
			}
			
			$query = $conn->query("SELECT * FROM `".$account_type->client_ac_type."` WHERE c_id='".$_SESSION['company_id']."' AND credit_amt = '0.00' AND gl_code = '".$id."'" .$whereSQL."ORDER BY id limit ".$start.",".$limit);
			
			while($queryr = $query->fetch_object())
			{
				$pdf->SetXY(7,65 + $c);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(19,10,$queryr->l_date,0,1,'C'); 
				
				
				if($pdf->GetStringWidth($queryr->inv_id) > 12)
				{
					$pdf->SetXY(26,65 + $c);
					$pdf->SetFont('Arial','',8);
					$pdf->MultiCell(13,3,$queryr->inv_id,'','L'); 
				}
				else
				{
					$pdf->SetXY(26,65 + $c);
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(13,10,$queryr->inv_id,'',1,'L');
				}
				
				$client = $con->query("SELECT * FROM `client_master` WHERE client_id = '".$queryr->debit_name."'")->fetch_object();
				if(!empty( $client->client_name) )
				{ $deb_name = $client->client_name; } 
				else 
				{ $deb_name = ''; }
			
				if($pdf->GetStringWidth($deb_name) > 39)
				{
					$pdf->SetXY(39,65 + $c);
					$pdf->SetFont('Arial','',9);
					$pdf->MultiCell(41,5,$deb_name,'','C'); 
				}
				else
				{
					$pdf->SetXY(39,65 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(41,10,$deb_name,'',1,'C'); 
				}
				$pdf->SetXY(80,65 + $c);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,10,$queryr->debit_amt,'',1,'C'); 
				
				$c += 10;
				$total_deb += $queryr->debit_amt;
			}
			
			
			
			$query_cdd = $conn->query("SELECT * FROM `".$account_type->client_ac_type."` WHERE c_id='".$_SESSION['company_id']."' AND  debit_amt = '0.00' AND gl_code = '".$id."'" .$whereSQL ."ORDER BY id limit ".$start.",".$limit);
	$cr = 0;		while($query_cr = $query_cdd->fetch_object())
			{
				$pdf->SetXY(105,65 + $cr);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(19,10,$query_cr->l_date,'',1,'C'); 
				
				if($pdf->GetStringWidth($query_cr->inv_id) > 12)
				{
					$pdf->SetXY(124,65 + $cr);
					$pdf->SetFont('Arial','',8);
					$pdf->MultiCell(13,3,$query_cr->inv_id,'','L'); 
				}
				else
				{
					$pdf->SetXY(124,65 + $cr);
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(13,10,$query_cr->inv_id,'',1,'L');
				}
				
				
				$clientc = $con->query("SELECT * FROM `client_master` WHERE client_id = '".$query_cr->credit_name."'")->fetch_object();
				if(!empty( $clientc->client_name) )
				{ $cr_name = $clientc->client_name; } 
				else 
				{ $cr_name = ''; }
				
				if($pdf->GetStringWidth($cr_name) > 39)
				{
					$pdf->SetXY(137,65 + $cr);
					$pdf->SetFont('Arial','',9);
					$pdf->MultiCell(41,5,$cr_name,'','C'); 
				}
				else
				{
					$pdf->SetXY(137,65 + $cr);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(41,10,$cr_name,'',1,'C'); 
				}
				$pdf->SetXY(178,65 + $cr);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,10,$query_cr->credit_amt,'',1,'C');
				$total_cre += $query_cr->credit_amt;
				
				
				
				$cr += 10;
			}
			
		}
	}
	else
	{
		$pdf->AddPage();
		$query = $conn->query("SELECT * FROM `".$account_type->client_ac_type."` WHERE c_id='".$_SESSION['company_id']."' AND credit_amt = '0.00' AND gl_code = '".$id."'" .$whereSQL);
		$query_c = $conn->query("SELECT * FROM `".$account_type->client_ac_type."` WHERE c_id='".$_SESSION['company_id']."' AND  debit_amt = '0.00' AND gl_code = '".$id."'" .$whereSQL);
		
		
		$c = 0;


	while($queryr = $query->fetch_object())
	{
		$pdf->SetXY(7,65 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(19,10,$queryr->l_date,0,1,'C'); 
		
		
		if($pdf->GetStringWidth($queryr->inv_id) > 12)
		{
			$pdf->SetXY(26,65 + $c);
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(13,3,$queryr->inv_id,'','L'); 
		}
		else
		{
			$pdf->SetXY(26,65 + $c);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(13,10,$queryr->inv_id,'',1,'L');
		}
		
		$client = $con->query("SELECT * FROM `client_master` WHERE client_id = '".$queryr->debit_name."'")->fetch_object();
		if(!empty( $client->client_name) )
		{ $deb_name = $client->client_name; } 
		else 
		{ $deb_name = ''; }
	
		if($pdf->GetStringWidth($deb_name) > 39)
		{
			$pdf->SetXY(39,65 + $c);
			$pdf->SetFont('Arial','',9);
			$pdf->MultiCell(41,5,$deb_name,'','C'); 
		}
		else
		{
			$pdf->SetXY(39,65 + $c);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(41,10,$deb_name,'',1,'C'); 
		}
		$pdf->SetXY(80,65 + $c);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,10,$queryr->debit_amt,'',1,'C'); 
		
		$c += 10;
		$total_deb += $queryr->debit_amt;
	}
	
	
	

	$cr = 0;
	while($query_cr = $query_c->fetch_object())
	{
		$pdf->SetXY(105,65 + $cr);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(19,10,$query_cr->l_date,'',1,'C'); 
		
		if($pdf->GetStringWidth($query_cr->inv_id) > 12)
		{
			$pdf->SetXY(124,65 + $cr);
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(13,3,$query_cr->inv_id,'','L'); 
		}
		else
		{
			$pdf->SetXY(124,65 + $cr);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(13,10,$query_cr->inv_id,'',1,'L');
		}
		
		
		$clientc = $con->query("SELECT * FROM `client_master` WHERE client_id = '".$query_cr->credit_name."'")->fetch_object();
		if(!empty( $clientc->client_name) )
		{ $cr_name = $clientc->client_name; } 
		else 
		{ $cr_name = ''; }
		
		if($pdf->GetStringWidth($cr_name) > 39)
		{
			$pdf->SetXY(137,65 + $cr);
			$pdf->SetFont('Arial','',9);
			$pdf->MultiCell(41,5,$cr_name,'','C'); 
		}
		else
		{
			$pdf->SetXY(137,65 + $cr);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(41,10,$cr_name,'',1,'C'); 
		}
		$pdf->SetXY(178,65 + $cr);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(25,10,$query_cr->credit_amt,'',1,'C');
		$total_cre += $query_cr->credit_amt;
		
		
		
		
		$cr += 10;
	}
		
	}

$pdf->Output($account_type->client_name." Ledger.pdf", 'D');

?>