<?php
require('fpdf.php');
include_once('../config/config2.php');
include_once('../function/rupees.php');
$whereSQL = '';
$id = $_POST['ac'];
$date = $_POST['today_date'];
global $account_type, $date1 ,$date2, $total_deb, $total_cre;
$account_type = $con->query('select * from account_type where ac_id = "'.$id.'"')->fetch_object();
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
	$this->Cell(196,6,$GLOBALS['account_type']->ac_name,0,1,'C'); 	
	$this->SetXY(22,53);
	$this->SetFont('Arial','B',10);
	$this->Cell(166,5,'Ledger Account for The period from '.$GLOBALS["date1"].' To '.$GLOBALS["date2"] ,0,1,'C'); 
	$this->SetXY(7,53);
 
	
	
	
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
$glcode = array();

$ids = $conn->query("SELECT distinct(gl_code) FROM `".$id."` WHERE c_id='".$_SESSION['company_id']."' ".$whereSQL);
$limit = 7;	
	
	if( $ids->num_rows > 7 )
	{    
		
		$ids1 = $conn->query("SELECT distinct(gl_code) FROM `".$id."` WHERE c_id='".$_SESSION['company_id']."' ".$whereSQL );
			
			while($idsa = $ids->fetch_object())
			{
				array_push($glcode,$idsa->gl_code);
			}
			
		
		for($i = 1; $i <= ceil($ids->num_rows / 7); $i++ )
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
			
			$glcodez = array_slice($glcode,$start,$limit);
			
			$c = 0;
			foreach($glcodez as $debit_ar)
			{
				$account = $con->query("select * from client_master where client_id = '".$debit_ar."'")->fetch_object();
				$debit = $conn->query("SELECT sum(debit_amt) as debittotal FROM `".$id."` WHERE c_id='".$_SESSION['company_id']."' AND credit_amt = '0.00' AND gl_code='".$debit_ar."'")->fetch_object();
				$credit = $conn->query("SELECT sum(credit_amt) as credittotal FROM `".$id."` WHERE c_id='".$_SESSION['company_id']."' AND debit_amt = '0.00' AND gl_code='".$debit_ar."'")->fetch_object();
				if($debit->debittotal > $credit->credittotal)
				{
					$value_big = $debit->debittotal;
					$extra = $debit->debittotal - $credit->credittotal; 
				}
				else
				{
					$value_big = $credit->credittotal;
					$extra = $credit->credittotal - $debit->debittotal;
				}
				
				
				$pdf->SetXY(7,60 + $c);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(98,25,'','LTB',0,'C');
					
					$pdf->SetXY(7,60 + $c);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(196,6,'','LTB',0,'C');
					
					$pdf->SetXY(105,60 + $c);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(68,25,'','R',0,'L');
					
					$pdf->SetXY(7,60 + $c);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(68,25,'','R',0,'L');
					
					$pdf->SetXY(105,60 + $c);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(98,25,'','LTRB',0,'C');
					
					$pdf->SetXY(75,60 + $c);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(30,6,'Debit','L',0,'C');
					
					$pdf->SetXY(7,60 + $c);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(68,6,'Particular','',0,'L');
					
					$pdf->SetXY(105,60 + $c);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(68,6,'Particular','',0,'L');
					
					$pdf->SetXY(173,60 + $c);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(30,6,'Credit','L',0,'C');
					
					if($debit->debittotal < $credit->credittotal){ $debit_a = $extra; }else { $debit_a = "-"; }
					
					if($debit->debittotal > $credit->credittotal){ $credit_a = $extra; } else { $credit_a = "-"; }
					if( $pdf->GetStringWidth($account->client_name) > 60 )
					{
						$pdf->SetXY(7,67 + $c);
						$pdf->SetFont('Arial','',9);
						$pdf->Cell(68,6,$account->client_name,0,0,'L');
					}
					else
					{
						$pdf->SetXY(7,67 + $c);
						$pdf->SetFont('Arial','',11);
						$pdf->Cell(68,6,$account->client_name,0,0,'L');
					}
					$pdf->SetXY(7,73 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(68,6,'Credit : -',0,0,'L');
					
					$pdf->SetXY(7,79 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(68,6,'Total : -',0,0,'L');
					
					$pdf->SetXY(75,73 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(30,6,$debit_a,'',0,'C');
					
					$pdf->SetXY(75,79 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(30,6,$value_big,'',0,'C');
					
					if( $pdf->GetStringWidth($account->client_name) > 60 )
					{
					
						$pdf->SetXY(105,67 + $c);
						$pdf->SetFont('Arial','',9);
						$pdf->Cell(68,6,$account->client_name,'',0,'L');
					
					}
					else
					{
						
						$pdf->SetXY(105,67 + $c);
						$pdf->SetFont('Arial','',11);
						$pdf->Cell(68,6,$account->client_name,'',0,'L');
						
					}
					
					$pdf->SetXY(105,73 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(68,6,'Debit : -','',0,'L');
					
					$pdf->SetXY(173,73 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(30,6,$credit_a,'',0,'C');
					
					$pdf->SetXY(105,79 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(68,6,'Total : -','',0,'L');
					
					$pdf->SetXY(173,79 + $c);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(30,6,$value_big,'',0,'C');
								
								
							$c += 30;	
								
				}
			
			
		}
	}
	else
	{
		$ids = $conn->query("SELECT distinct(gl_code) FROM `".$id."` WHERE c_id='".$_SESSION['company_id']."' ".$whereSQL);
		$pdf->AddPage();
	while($idsa = $ids->fetch_object())
	{
		array_push($glcode,$idsa->gl_code);
	}
	$c = 0;
	foreach($glcode as $debit_ar)
	{
		$account = $con->query("select * from client_master where client_id = '".$debit_ar."'")->fetch_object();
		$debit = $conn->query("SELECT sum(debit_amt) as debittotal FROM `".$id."` WHERE c_id='".$_SESSION['company_id']."' AND credit_amt = '0.00' AND gl_code='".$debit_ar."'")->fetch_object();
		$credit = $conn->query("SELECT sum(credit_amt) as credittotal FROM `".$id."` WHERE c_id='".$_SESSION['company_id']."' AND debit_amt = '0.00' AND gl_code='".$debit_ar."'")->fetch_object();
		if($debit->debittotal > $credit->credittotal)
		{
			$value_big = $debit->debittotal;
			$extra = $debit->debittotal - $credit->credittotal; 
		}
		else
		{
			$value_big = $credit->credittotal;
			$extra = $credit->credittotal - $debit->debittotal;
		}

	$pdf->SetXY(7,60 + $c);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(98,25,'','LTB',0,'C');
	
	$pdf->SetXY(7,60 + $c);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(196,6,'','LTB',0,'C');
	
	$pdf->SetXY(105,60 + $c);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(68,25,'','R',0,'L');
	
	$pdf->SetXY(7,60 + $c);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(68,25,'','R',0,'L');
	
	$pdf->SetXY(105,60 + $c);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(98,25,'','LTRB',0,'C');
	
	$pdf->SetXY(75,60 + $c);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30,6,'Debit','L',0,'C');
	
	$pdf->SetXY(7,60 + $c);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(68,6,'Particular','',0,'L');
	
	$pdf->SetXY(105,60 + $c);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(68,6,'Particular','',0,'L');
	
	$pdf->SetXY(173,60 + $c);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30,6,'Credit','L',0,'C');
	
	if($debit->debittotal < $credit->credittotal){ $debit_a = $extra; }else { $debit_a = "-"; }
	
	if($debit->debittotal > $credit->credittotal){ $credit_a = $extra; } else { $credit_a = "-"; }
	if( $pdf->GetStringWidth($account->client_name) > 60 )
	{
		$pdf->SetXY(7,67 + $c);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(68,6,$account->client_name,0,0,'L');
	}
	else
	{
		$pdf->SetXY(7,67 + $c);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(68,6,$account->client_name,0,0,'L');
	}
	$pdf->SetXY(7,73 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(68,6,'Credit : -',0,0,'L');
	
	$pdf->SetXY(7,79 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(68,6,'Total : -',0,0,'L');
	
	$pdf->SetXY(75,73 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,6,$debit_a,'',0,'C');
	
	$pdf->SetXY(75,79 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,6,$value_big,'',0,'C');
	
	if( $pdf->GetStringWidth($account->client_name) > 60 )
	{
	
		$pdf->SetXY(105,67 + $c);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(68,6,$account->client_name,'',0,'L');
	
	}
	else
	{
		
		$pdf->SetXY(105,67 + $c);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(68,6,$account->client_name,'',0,'L');
		
	}
	
	$pdf->SetXY(105,73 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(68,6,'Debit : -','',0,'L');
	
	$pdf->SetXY(173,73 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,6,$credit_a,'',0,'C');
	
	$pdf->SetXY(105,79 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(68,6,'Total : -','',0,'L');
	
	$pdf->SetXY(173,79 + $c);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,6,$value_big,'',0,'C');
	$c += 30;
	}

	
	}

$pdf->Output("Ledger_".$account_type->ac_name.".pdf", 'D');
?>