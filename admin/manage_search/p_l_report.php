<?php
    include_once('../config/config2.php');
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
if( $dexpence > $dincome ) { $gross_loss = $dexpence - $dincome; }else if( $dexpence < $dincome ) { $gross_profit = $dincome - $dexpence ; }


///  trading ----------------------------------------------------


$in_ex_query = $conn->query("SELECT DISTINCT(gl_code) FROM `13` WHERE c_id='".$_SESSION['company_id']."' ");
$misc_query = $conn->query("SELECT DISTINCT(gl_code) FROM `18` WHERE c_id='".$_SESSION['company_id']."' ");

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

$in_in_query = $conn->query("SELECT DISTINCT(gl_code) FROM `14` WHERE c_id='".$_SESSION['company_id']."'");
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
	$_in_ex_query = $conn->query("SELECT DISTINCT(gl_code) FROM `13` WHERE c_id='".$_SESSION['company_id']."'");
	$_misc_query = $conn->query("SELECT DISTINCT(gl_code) FROM `18` WHERE c_id='".$_SESSION['company_id']."'");	
	?>
	<div class="col-md-6">
		<div class="box" style="overflow-x:scroll;">
			<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th colspan="2">Particulars</th>
						<th>Debit</th>
					</tr>
                </thead>
				<tbody>
				<?php if($gross_loss != 0){ ?>
					<tr>
						<th style=" font-size:16px;" colspan="2">Gross Loss</th>
						<th style="text-align:right; font-size:16px;"><?php echo $gross_loss ?></th>
					</tr>
				<?php } $_in_ex_to = 0; $in_ex_cou = 0; if( $_in_ex_query->num_rows > 0 ) { ?>
						<tr>
							<th colspan="3">Indirect Expenses</th>
						</tr>
					<?php 
						while($_in_ex_queryr = $_in_ex_query->fetch_object()){ $in_ex_cou++;
							$acco_in_ex = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$_in_ex_queryr->gl_code."'")->fetch_object();
							$_in_ex_credit = $conn->query("SELECT sum(credit_amt) as in_e_x_c from `13` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_in_ex_queryr->gl_code."'")->fetch_object(); 
							$_in_ex_debit = $conn->query("SELECT sum(debit_amt) as in_e_x_d from `13` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_in_ex_queryr->gl_code."'")->fetch_object(); 
							?>
						<tr>
							<td><?php echo $acco_in_ex->client_name; ?></td>
							<td><?php if( $_in_ex_credit->in_e_x_c > $_in_ex_debit->in_e_x_d ) { echo $_in_ex_sub = $_in_ex_credit->in_e_x_c - $_in_ex_debit->in_e_x_d; } else if($_in_ex_credit->in_e_x_c < $_in_ex_debit->in_e_x_d ) { echo $_in_ex_sub = $_in_ex_debit->in_e_x_d - $_in_ex_credit->in_e_x_c; } ?></td>
							<td><?php $_in_ex_to += $_in_ex_sub; if( $in_ex_cou == $_in_ex_query->num_rows ){ echo $_in_ex_to; } ?></td>
						</tr>
					<?php } } ?>
					<?php if($_misc_query->num_rows > 0 ){  ?>
						<tr>
							<th colspan="3">Misc. Expenses</th>
						</tr>
						<?php $_misc_total = 0; $_misc_co = 0 ;
						while($_misc_queryr = $_misc_query->fetch_object())
						{ $_misc_co++;
							$acco_misc = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$_misc_queryr->gl_code."'")->fetch_object();
							$_misc_credit = $conn->query("SELECT sum(credit_amt) as mis_c_c from `18` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_misc_queryr->gl_code."'")->fetch_object(); 
							$_misc_debit = $conn->query("SELECT sum(debit_amt) as mis_c_d from `18` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_misc_queryr->gl_code."'")->fetch_object(); 
						?>
						<tr>
							<td><?php echo $acco_misc->client_name; ?></td>
							<td><?php if( $_misc_credit->mis_c_c > $_misc_debit->mis_c_d ) { echo $_misc_sub = $_misc_credit->mis_c_c - $_misc_debit->mis_c_d; } else if( $_misc_credit->mis_c_c < $_misc_debit->mis_c_d ) { echo $_misc_sub = $_misc_debit->mis_c_d - $_misc_credit->mis_c_c; } ?></td>
							<td><?php $_misc_total += $_misc_sub; if( $_misc_co ==  $_misc_query->num_rows ) { echo $_misc_total; } ?></td>
						</tr>	
							
					<?php } } ?>
					<?php if( $indirect_expences < $indirect_income ){ ?>
							<tr>
								<th style="font-size:16px;" colspan="2">Net Profit</th>
								<th style="text-align:right; font-size:16px;"><?php echo $indirect_income - $indirect_expences; ?></th>
							</tr>
						<?php } ?>
						<tr>
							<td colspan="2" style="text-align:right; font-size:16px;">Total : - </td>
							<td style="text-align:right; font-size:16px;"><?php echo $total; ?></td>
						</tr>
				</tbody>
			</table>
		</div>
	</div>
	
	<?php $_in_in_query = $conn->query("SELECT DISTINCT(gl_code) FROM `14` WHERE c_id='".$_SESSION['company_id']."'"); ?>
	<div class="col-md-6">
		<div class="box" style="overflow-x:scroll;">
			<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th colspan="2">Particulars</th>
						<th>Credit</th>
					</tr>
                </thead>
				<tbody>
				<?php if($gross_profit != 0){ ?>
					<tr>
						<th style=" font-size:16px;" colspan="2">Gross Profit</th>
						<th style="text-align:right; font-size:16px;"><?php echo $gross_profit ?></th>
					</tr>
				<?php } if($_in_in_query->num_rows > 0 ){ ?>
						<tr>
							<th colspan="3">Indirect Income</th>
						</tr>
						<?php 
							$_indirect_income = 0; $inc_co_unt = 0;
							while($_in_in_queryr = $_in_in_query->fetch_object())
							{ $inc_co_unt++;
								$_acco_in_in = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$_in_in_queryr->gl_code."'")->fetch_object();
								$_in_income_cr = $conn->query("SELECT sum(credit_amt) as in_in_c_r from `14` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_in_in_queryr->gl_code."'")->fetch_object(); 
								$_in_income_de = $conn->query("SELECT sum(debit_amt) as in_in_d_e from `14` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_in_in_queryr->gl_code."'")->fetch_object(); 
								?>
								<tr>
									<td><?php echo $_acco_in_in->client_name; ?></td>
									<td><?php if( $_in_income_cr->in_in_c_r > $_in_income_de->in_in_d_e ) { echo $_in_in_sub = $_in_income_cr->in_in_c_r - $_in_income_de->in_in_d_e; } else { echo $_in_in_sub = $_in_income_de->in_in_d_e - $_in_income_cr->in_in_c_r; } ?></td>
									<td><?php $_indirect_income += $_in_in_sub; if($inc_co_unt == $_in_in_query->num_rows){ echo $_indirect_income; } ?></td>
								</tr>
								
					<?php } } ?>
						<?php if( $indirect_expences > $indirect_income ){ ?>
							<tr>
								<th style="font-size:16px;" colspan="2">Net Loss</th>
								<th style="text-align:right; font-size:16px;"><?php echo $indirect_expences - $indirect_income; ?></th>
							</tr>
						<?php } ?>
						<tr>
							<td colspan="2" style="text-align:right; font-size:16px;">Total : - </td>
							<td style="text-align:right; font-size:16px;"><?php echo $total; ?></td>
						</tr>
				</tbody>
			</table>
		</div>
	</div>
		
		
		
		


