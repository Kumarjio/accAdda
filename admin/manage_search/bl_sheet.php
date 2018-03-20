<?php
    include_once('../config/config2.php');
	$purchase = $conn->query("SELECT sum(debit_amt) as pur_sum_d from `23` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='2'")->fetch_object();
	$puc_ret = $conn->query("SELECT sum(credit_amt) as pur_sum_c from `23` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='2'")->fetch_object(); 
	$direct_ex = $conn->query("SELECT DISTINCT(gl_code) FROM `9` ");
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
	
	
	$_direct_in = $conn->query("SELECT DISTINCT(gl_code) FROM `10` ");
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
if( $dexpence > $dincome ) { $gross_loss = $dexpence - $dincome; }else if( $dexpence < $dincome ) { $gross_profit = $dincome - $dexpence ; }


///  trading ----------------------------------------------------


$in_ex_query = $conn->query("SELECT DISTINCT(gl_code) FROM `13` ");
$misc_query = $conn->query("SELECT DISTINCT(gl_code) FROM `18` ");

$in_ex_total = 0;
while($in_ex_queryr = $in_ex_query->fetch_object())
{
	$in_ex_credit = $conn->query("SELECT sum(credit_amt) as in_ex_c from `13` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$in_ex_queryr->gl_code."'")->fetch_object(); 
	$in_ex_debit = $conn->query("SELECT sum(debit_amt) as in_ex_d from `13` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$in_ex_queryr->gl_code."'")->fetch_object(); 
	if( $in_ex_credit->in_ex_c > $in_ex_debit->in_ex_d ) { $in_ex_sub = $in_ex_credit->in_ex_c - $in_ex_debit->in_ex_d; } else if( $in_ex_credit->in_ex_c < $in_ex_debit->in_ex_d ) { $in_ex_sub = $in_ex_debit->in_ex_d - $in_ex_credit->in_ex_c; }
	$in_ex_total += $in_ex_sub;  
}

$misc_total = 0;
while($misc_queryr = $misc_query->fetch_object())
{
	$misc_credit = $conn->query("SELECT sum(credit_amt) as misc_c from `18` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$misc_queryr->gl_code."'")->fetch_object(); 
	$misc_debit = $conn->query("SELECT sum(debit_amt) as misc_d from `18` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$misc_queryr->gl_code."'")->fetch_object(); 
	if( $misc_credit->misc_c > $misc_debit->misc_d ) { $misc_sub = $misc_credit->misc_c - $misc_debit->misc_d; } else if( $misc_credit->misc_c < $misc_debit->misc_d ) { $misc_sub = $misc_debit->misc_d - $misc_credit->misc_c; }
	$misc_total += $misc_sub;  
}
$indirect_expences = $misc_total + $in_ex_total + $gross_loss;

//// indirect expences ------------------------------------------------------------------------

$in_in_query = $conn->query("SELECT DISTINCT(gl_code) FROM `14` ");
$indirect_income = 0;
$indirect_income += $gross_profit ;

while($in_in_queryr = $in_in_query->fetch_object())
{
	$in_income_cr = $conn->query("SELECT sum(credit_amt) as in_in_cr from `14` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$in_in_queryr->gl_code."'")->fetch_object(); 
	$in_income_de = $conn->query("SELECT sum(debit_amt) as in_in_de from `14` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$in_in_queryr->gl_code."'")->fetch_object(); 
	if( $in_income_cr->in_in_cr > $in_income_de->in_in_de ) { $in_in_sub = $in_income_cr->in_in_cr - $in_income_de->in_in_de; } else if( $in_income_cr->in_in_cr < $in_income_de->in_in_de ) { $in_in_sub = $in_income_de->in_in_de - $in_income_cr->in_in_cr; }
	$indirect_income += $in_in_sub;  
}



//// indirect_  income  ------------------------------------------------------------------------

$total = 0;
if( $indirect_expences > $indirect_income ){ $total = $indirect_expences; }else if( $indirect_expences < $indirect_income ){ $total = $indirect_income; }

if( $indirect_expences > $indirect_income ){ $NetLoss = $indirect_expences - $indirect_income; } else if( $indirect_expences < $indirect_income ) { $Netprofit = $indirect_income - $indirect_expences; }

?>
<?php
////  balance sheet  -------------------------------------
?>
<div class="col-md-6">
		<div class="box" style="overflow-x:scroll;">
			<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th style="font-size:16px" colspan="2">Liabilities</th>
						<th>Amount</th>
					</tr>
                </thead>
				<tbody>
<?php   $sub_total_lia = 0; $ftotal = 0;
$bd = $con->query("select ac_id,ac_name from account_type WHERE `prifix`='BC'");
while($bdr = $bd->fetch_object())
{	$gl_code_d = $conn->query("SELECT DISTINCT(gl_code) FROM `" .$bdr->ac_id. "`"); $lia_count = 0; $sub_total_lia = 0;  if( $gl_code_d->num_rows > 0 ){ ?>
		<tr>
			<th colspan="3"><?php echo $bdr->ac_name; ?></th>
		</tr>
<?php	 
		while($gl_code_dr = $gl_code_d->fetch_object())
		{ $lia_count++;
		$ac_b_lia = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$gl_code_dr->gl_code."'")->fetch_object();
		$lia_c = $conn->query("SELECT sum(credit_amt) as lia_c from `".$bdr->ac_id."` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$gl_code_dr->gl_code."'")->fetch_object(); 
		$lia_d = $conn->query("SELECT sum(debit_amt) as lia_d from `".$bdr->ac_id."` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$gl_code_dr->gl_code."'")->fetch_object();
		
	?>
			<tr>
				<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ac_b_lia->client_name; ?></td>
				<td><?php if($lia_c->lia_c > $lia_d->lia_d){ echo $lia_sub = $lia_c->lia_c - $lia_d->lia_d; }else { echo $lia_sub = $lia_d->lia_d - $lia_c->lia_c; } ?></td>
				<td style="text-align:right;"><?php $sub_total_lia += $lia_sub;   if($lia_count == $gl_code_d->num_rows){ echo $sub_total_lia; } ?></td>
			</tr>
<?php } $ftotal += $sub_total_lia; }  } ?>
			
			
			<?php if(isset($Netprofit)){ ?>
					<tr>
						<th colspan="2" style="font-size:16px;">Net Profit : - </th>
						<th style="text-align:right; font-size:16px;"><?php echo $Netprofit; ?></th>
					</tr>
					
				<?php $ftotal += $Netprofit; } ?>	
			
			<tr>
				<td colspan="2" style="text-align:right; font-size:16px;">Total : - </td>
				<td style="text-align:right; font-size:16px;"><?php echo $ftotal; ?></td>
			</tr>
				
				</tbody>
			</table>
		</div>
	</div>
	
	
	<div class="col-md-6">
		<div class="box" style="overflow-x:scroll;">
			<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th style="font-size:16px" colspan="2">Assets</th>
						<th>Amount</th>
					</tr>
                </thead>
				<tbody>
	<?php $bc = $con->query("select ac_id,ac_name from account_type WHERE `prifix`='BD'");  $assf_total = 0;
			while($bcr = $bc->fetch_object())
			{ 	$cou_ass = 0;
				$glcode_c = $conn->query("SELECT DISTINCT(gl_code) FROM `" .$bcr->ac_id. "`"); $asst_count = 0; $ass_total = 0; if($glcode_c->num_rows > 0){  ?>
					<tr>
						<th colspan="3"><?php echo $bcr->ac_name; ?></th>
					</tr>
	<?php   while($glcode_cr = $glcode_c->fetch_object()){  $cou_ass++;  
				$ac_b_ass = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$glcode_cr->gl_code."'")->fetch_object();
				$ass_c = $conn->query("SELECT sum(credit_amt) as ass_c from `".$bcr->ac_id."` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$glcode_cr->gl_code."'")->fetch_object(); 
				$ass_d = $conn->query("SELECT sum(debit_amt) as ass_d from `".$bcr->ac_id."` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$glcode_cr->gl_code."'")->fetch_object();
				
	
	?>
					
					<tr>
						<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ac_b_ass->client_name; ?></td>
						<td><?php if( $ass_c->ass_c > $ass_d->ass_d ){ echo $sub_asse = $ass_c->ass_c - $ass_d->ass_d; }else { echo $sub_asse = $ass_d->ass_d - $ass_c->ass_c;  } ?></td>
						<td style="text-align:right;"><?php  $ass_total += $sub_asse; if($cou_ass == $glcode_c->num_rows) { echo $ass_total; } ?></td>
					</tr>
					
	<?php } $assf_total += $ass_total;	} } ?>
				
				<?php if(isset($NetLoss)){ ?>
					<tr>
						<th colspan="2" style="font-size:16px;">Net Loss : - </th>
						<th style="text-align:right; font-size:16px;"><?php echo $NetLoss; ?></th>
					</tr>
					
				<?php $assf_total += $NetLoss; } ?>	
					
					
					<tr>
						<td colspan="2" style="text-align:right; font-size:16px;">Total : - </td>
						<td style="text-align:right; font-size:16px;"><?php echo $assf_total; ?></td>
					</tr>
	
	
				</tbody>
			</table>
		</div>
	</div>






<?php ////  balance sheet  ------------------------------------- ?>











